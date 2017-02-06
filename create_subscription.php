<?php // Create a customer using a Stripe token

// If you're using Composer, use Composer's autoload:
require_once('C:\xampp\htdocs\beClaimsFree\Stripe\Stripe\init.php');

// Be sure to replace this with your actual test API key
// (switch to the live key later)
\Stripe\Stripe::setApiKey("sk_test_zCmKCeXfiBL4vpD6c2P5eeXZ");

try
{
    $customer = \Stripe\Customer::create(array(
    'email' => $_POST['stripeEmail'],
    'source'  => $_POST['stripeToken'],
    'plan' => 'YearSub'
  ));

  header('Location: thankyou.html');
  exit;
}
catch(Exception $e)
{
  header('Location:home.php');
  error_log("unable to sign up customer:" . $_POST['stripeEmail'].
    ", error:" . $e->getMessage());
    
}