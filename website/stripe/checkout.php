<?php
session_start();
require("../mysql.php");
if(isset($_POST["add_to_cart"]))
{
	 if(isset($_SESSION["shopping_cart"]))
	 {
				$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
				if(!in_array($_GET["id"], $item_array_id))
				{
						 $count = count($_SESSION["shopping_cart"]);
						 $item_array = array(
									'item_id'               =>     $_GET["id"],
									'item_name'               =>     (isset($_POST["titel"]) ? $_POST["titel"] : null),
									'item_price'          =>     (isset($_POST["pricing"]) ? $_POST["pricing"] : null),
									'item_quantity'          =>     $_POST["quantity"]
						 );
						 $_SESSION["shopping_cart"][$count] = $item_array;
				}
				else
				{
						$item_array = array(
								 'item_id'               =>     $_GET["id"],
								 'item_name'               =>     (isset($_POST["titel"]) ? $_POST["titel"] : null),
								 'item_price'          =>     (isset($_POST["pricing"]) ? $_POST["pricing"] : null),
								 'item_quantity'          =>     $_POST["quantity"]
						);
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
								 if($values["item_id"] == $_GET["id"])
								 {
											$_SESSION["shopping_cart"][$keys]['item_quantity'] = $_SESSION["shopping_cart"][$keys]['item_quantity'] + $_POST["quantity"];

								 }
						}

				}
	 }
	 else
	 {
				$item_array = array(
						 'item_id'               =>     $_GET["id"],
						 'item_name'               =>     (isset($_POST["titel"]) ? $_POST["titel"] : null),
	 					'item_price'          =>     (isset($_POST["pricing"]) ? $_POST["pricing"] : null),
						 'item_quantity'          =>     $_POST["quantity"]
				);
				$_SESSION["shopping_cart"][0] = $item_array;
	 }
}
if(isset($_GET["action"]))
{
	 if($_GET["action"] == "delete")
	 {
				foreach($_SESSION["shopping_cart"] as $keys => $values)
				{
						 if($values["item_id"] == $_GET["id"])
						 {
									unset($_SESSION["shopping_cart"][$keys]);
						 }
				}
	 }
}
?>
<!DOCTYPE html>
<html>
	 <head>

				<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    		<link href="../style/shoppingcart.css" rel="stylesheet">
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
        <script src="https://js.stripe.com/v3/"></script>
				<link rel="shortcut icon" href="../upload/plug.png">
	 </head>
	 <body>
				<br />
				<div class="container" style="width:700px;">
						 <div style="clear:both"></div>
						 <br />
						 <h3>Order Details</h3>
						 <div class="table-responsive">
									<table class="table table-bordered">
											 <tr>
														<th width="40%">Item Name</th>
														<th width="10%">Quantity</th>
														<th width="20%">Price</th>
														<th width="15%">Total</th>
														<th width="5%">Action</th>
											 </tr>
											 <?php
											 $total = 0;
											 if(!empty($_SESSION["shopping_cart"]))
											 {
														$total = 0;
														foreach($_SESSION["shopping_cart"] as $keys => $values)
														{
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
														<td></td>
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

              <h5>€<?php  echo number_format($total, 2); ?></h5>

            </div>

          </div>
 					<form method="post">
          	<button name="checkout" id="checkout-button">Checkout</button>
					</form>
        </section>

<?php
if(isset($_POST["checkout"])) {
	foreach($_SESSION["shopping_cart"] as $values)
	{
					require("../mysql.php");
					$stmt = $mysql->prepare("INSERT INTO orders (id, ORDERNUMBER, BUYER, PLUGINID) VALUES (0, :ordernumber, :buyer, :pluginid)");
					$today = date("Ymd");
					$rand = strtoupper(substr(uniqid(sha1(time())),0,4));
   				$unique = $today . $rand;
					$stmt->bindParam(":ordernumber", $unique, PDO::PARAM_STR);
					$stmt->bindParam(":buyer", $_SESSION["username"],  PDO::PARAM_STR);
					$stmt->bindParam(":pluginid", $values["item_id"],  PDO::PARAM_STR);
					$stmt->execute();
				}
}

 ?>

  <script type="text/javascript">

    // Create an instance of the Stripe object with your publishable API key

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

          // If redirectToCheckout fails due to a browser or network

          // error, you should display the localized error message to your

          // customer using error.message.

          if (result.error) {

            alert(result.error.message);

          }

        })

        .catch(function (error) {

          console.error("Error:", error);

        });

    });

  </script>

</body>
</html>
