<?php

require '../../../../vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51HsnB4DY5IWlezcdJHapWWwhXtufMNsGdnP2Y29oT28kdqtIpn6yy2akONC4qZTt7lSPfIvAyrlaXjpH3rPg6WMm00xif4Ru6p');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:8000';

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => 'eur',
      'unit_amount' => 2000,
      'product_data' => [
        'name' => 'Minecraft Plugins',
        'images' => ["https://i.imgur.com/EHyR2nP.png"],
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '../index.php',
  'cancel_url' => $YOUR_DOMAIN . '../index.php',
]);

echo json_encode(['id' => $checkout_session->id]);
