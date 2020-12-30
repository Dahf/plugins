<?php
session_start();
require("../mysql.php");
if(isset($_POST["add_to_cart"])){
	$quantity = $_POST["quantity"];
 	if($quantity < 1){ 																														// Falls die Menge negativ oder 0 ist wird sie 1 gesetzt
		$quantity = 1;
 	}
	if(isset($_SESSION["shopping_cart"])){ 																				// Falls es eine Session shopping_cart existiert
		$item_array_id = array_column($_SESSION["shopping_cart"], "item_id"); 			// Array Nutzer --> IDs
		if(!in_array($_GET["id"], $item_array_id)){ 																// Wenn Nutzer nicht in $item_array_id ist
			$count = count($_SESSION["shopping_cart"]);
			$item_array = array(
			'item_id'       =>     $_GET["id"],
			'item_name'     =>     (isset($_POST["titel"]) ? $_POST["titel"] : null),
			'item_price'    =>     (isset($_POST["pricing"]) ? $_POST["pricing"] : null),
			'item_quantity' =>     $quantity
			);
			$_SESSION["shopping_cart"][$count] = $item_array; 												// Warenkorb wird aktualisiert mit dem oberen Array
			header('Location:'.$_SERVER['HTTP_REFERER']); 														// Wird zu der vorherigen Seite gesendet
		}
		else{																																				// Wenn Nutzer im $item_array_id ist
			$item_array = array(
			'item_id'       =>     $_GET["id"],
			'item_name'     =>     (isset($_POST["titel"]) ? $_POST["titel"] : null),
			'item_price'    =>     (isset($_POST["pricing"]) ? $_POST["pricing"] : null),
			'item_quantity' =>    $quantity
			);
			foreach($_SESSION["shopping_cart"] as $keys => $values){									// Falls gleiche Items im Warenkorb hinzugefügt werden
				if($values["item_id"] == $_GET["id"]){
					$_SESSION["shopping_cart"][$keys]['item_quantity'] = $_SESSION["shopping_cart"][$keys]['item_quantity'] + $quantity;
				}																																				// Quantity wird zu der vorherigen addiert
			}
			header('Location:'.$_SERVER['HTTP_REFERER']);
		}
	}
	else{
		$item_array = array(
		'item_id'         =>     $_GET["id"],
		'item_name'       =>     (isset($_POST["titel"]) ? $_POST["titel"] : null),
	 	'item_price'      =>     (isset($_POST["pricing"]) ? $_POST["pricing"] : null),
		'item_quantity'   =>     $quantity
		);
		$_SESSION["shopping_cart"][0] = $item_array;
		header('Location:'.$_SERVER['HTTP_REFERER']);
	}
}
if(isset($_GET["action"])){
	if($_GET["action"] == "delete"){
		foreach($_SESSION["shopping_cart"] as $keys => $values){										// Für alles was im Warenkorb ist
			if($values["item_id"] == $_GET["id"]){
				unset($_SESSION["shopping_cart"][$keys]);																// wird gelöscht
			}
		}
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>
		<link rel="shortcut icon" href="../upload/plug.png">
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
		<title>Checkout</title>
		<link href="../style/checkout.css" rel="stylesheet">
	</head>
	<body>
		<!---------------- JAVASCRIPT ---------------->
  	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/js/all.min.js"></script>
  	<script>
  		AOS.init();
  	</script>
		<!---------------- HEADER ---------------->
  	<div id="header">
    	<a class="headerwri"href="../index.php">
      	<div data-aos="zoom-in" aos-duration="500" id="animation">
        	<b>PluginStore</b>
      	</div>
    	</a>
  	</div>
		<!---------------- NAVBAR ---------------->
  	<div id="navbar">
    	<div id="links_navbar">
      	<a class="navlink" href="../spigot.php"><b>SPIGOT</b></a>
      	<a class="navlink" href="../bungeecord.php"><b>BUNGEECORD</b></a>
      	<?php if (!isset($_SESSION['username'])): ?>
        	<a class="navlink" href="../login/login.php"><b>LOGIN</b></a>
      	<?php endif; ?>
      	<?php if (isset($_SESSION['username'])): ?>
        	<a class="navlink" href="../login/dashboard.php"><b>ACCOUNT</b></a>
      	<?php endif; ?>
    	</div>
    	<div class="shopping-cart">
      	<a class="shopping-btn" href="checkout.php">
        	<i class="fas fa-shopping-cart"></i>
      	</a>
    	</div>
    	<div class="search-box">
      	<input type="text" name="" class="search-txt" placeholder="Type..."/>
        	<a class="search-btn">
          	<i class="fas fa-search"></i>
        	</a>
    	</div>
		</div>
		<!---------------- FOOTER ---------------->
		<div id="footer">
  		<div id="links_footer">
    		<a class="footer" href="../impressum.php">Impressum</a>
    		<a class="footer" href="../datenschutz.php">Datenschutz</a>
    		<a class="footer" href="../kontaktformular.php">Kontaktformular</a>
    		<p class="copyright">© 2020 SilasBeckmann.de</a>
  		</div>
		</div>
	</body>
</html>
	<!---------------- MAINBODY ---------------->
	<div	id="checkout">
		<br />
		<div class="container" style="width:700px;">
			<br />
			<h3>Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<div id="headrow">
							<th width="40%">Item Name</th>
							<th width="10%">Quantity</th>
							<th width="20%">Price</th>
							<th width="15%">Total</th>
							<th width="5%">Action</th>
						</div>
					</tr>
					<?php
					$total = 0;
					if(!empty($_SESSION["shopping_cart"])){
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values){
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td><?php echo $values["item_quantity"]; ?></td>
						<td>€ <?php echo $values["item_price"]; ?></td>
						<td>€ <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
						<td><a href="checkout.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
						$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td colspan="3" align="right">Total</td>
						<td align="right">€ <?php echo number_format($total, 2); ?></td>

					</tr>
					<?php
					}
					?>
				</table>
			</div>
		</div>
		<br />
		<section>
			<div class="product">
				<div class="description">
					<h3></h3>
					<h5>Pay €<?php  echo number_format($total, 2); ?>?</h5>
				</div>
			</div>
			<form method="post">
				<button name="checkout" id="checkout-button">Yes!</button>
				<button name="checkout" id="checkout-button">Yes!</button>
			</form>
		</section>
		<?php
		if(isset($_POST["checkout"])){
			if(!empty($_SESSION["shopping_cart"])){
				foreach($_SESSION["shopping_cart"] as $values){
					require("../mysql.php");
					$stmt = $mysql->prepare("INSERT INTO orders (id, ORDERNUMBER, BUYER, PLUGINID) VALUES (0, :ordernumber, :buyer, :pluginid)");
					$today = date("Ymd");
					$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
					$unique = $today . $rand;
					$stmt->bindParam(":ordernumber", $unique, PDO::PARAM_STR);
					$stmt->bindParam(":buyer", $_SESSION["username"],  PDO::PARAM_STR);
					$stmt->bindParam(":pluginid", $values["item_id"],  PDO::PARAM_STR);
					$stmt->execute();
					unset($_SESSION["shopping_cart"]);
					header("Location: ../index.php");
				}
			}
		}

		?>
		<?php
		/*
		* @author Stripe Documentation
		*
		* Offezielle Documentation von Stripe kopiert
		*/
		 ?>
		<script type="text/javascript"> 																					
			var stripe = Stripe("pk_test_51HsnB4DY5IWlezcdkJZutTwqTjOo6djcvDWgjjsuaSw4FYL8XjIO7RrPaxdBfFRrCcfrQfz7HB6v8BUQDctR3QEo00jL0Ctxeu");
			var checkoutButton = document.getElementById("checkout-button");
			checkoutButton.addEventListener("click", function () {
				fetch("create-session.php", {
					method: "POST",
				})
				.then(function (response) {
					return response.json();
				})
				.then(function (session) {
					return stripe.redirectToCheckout({ sessionId: session.id });
				})
				.then(function (result) {
					if (result.error) {
						alert(result.error.message);
					}
				})
				.catch(function (error) {
					console.error("Error:", error);
				});
			});
		</script>
	</div>
