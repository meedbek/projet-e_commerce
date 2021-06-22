<?php
session_start();
$json = json_decode($_SESSION['data'],true);
$type = $json[0];
$data = $json[1];

if($type == 'billet')
{
    $unit_amount = $data['price']*100;
    $currency = 'mad';
    $name = 'billet avion';
    $images = ["https://lh3.googleusercontent.com/proxy/HeCTOW4Uql16jb1mQfrF1dB_83Kjcb5dzZYVuvjIRfRZmsp-ag7MCJxiRnIMFQOs9AYQGUH1HIEJJoj4TeTZxVbNvkAQkDT2p9hrlwE"];
}
else
{
    $unit_amount = $data['price']*100;
    $currency = $data['currency'];
    $name = 'hotel';
    $images = ["https://www.clipartkey.com/mpngs/m/40-408605_transparent-hotel-clipart-black-and-white-hotel-icon.png"];
}

include './stripe-php/init.php';
//require 'vendor/autoload.php';
\Stripe\Stripe::setApiKey('sk_test_51J4PDVFAmzYgltFNKddsq3d47t9XVdiWwQuLUgu7gIfG40dbOuyKR6Md5f6BXCrkag7fbMbIhQVY83gyewcLvtus002qnIqaRn');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost/e_commmerce/stripe/';

$checkout_session = \Stripe\Checkout\Session::create([
  'payment_method_types' => ['card'],
  'line_items' => [[
    'price_data' => [
      'currency' => $currency,
      'unit_amount' => $unit_amount,
      'product_data' => [
        'name' => $name,
        'images' => $images,
      ],
    ],
    'quantity' => 1,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.php',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.php',
]);

echo json_encode(['id' => $checkout_session->id]);