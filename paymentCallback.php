<?php
session_start();

//squad 

$error = false;
$curl = curl_init();
$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
if(!$reference){
  die('No reference supplied');
	$error = true;
}

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "authorization: Bearer sk_test_35e842e527a13bd2ff2ee70a52d7a44b424724bd",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
    // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
	$error = true;
}

$tranx = json_decode($response); 
//var_dump($tranx);

if(!$tranx->status){
  // there was an error from the API
  die('API returned error: ' . $tranx->message);
	$error = true;
}

if('success' == $tranx->data->status){
  // transaction was successful...
  // please check other things like whether you already gave value for this ref
  // if the email matches the customer who owns the product etc
  // Give value
  $i = $_REQUEST['i'];
  $n = $_REQUEST['n'];
  $e = $_REQUEST['e'];
  $v = $_REQUEST['v'];
  $t = $tranx->data->reference;
	header("Location:recordVote.php?i=$i&n=$n&v=$v&e=$e&t=$t");
}


// $tranx response for bank payment
// object(stdClass)#1 (3) { ["status"]=> bool(true) ["message"]=> string(23) "Verification successful" ["data"]=> object(stdClass)#2 (30) { ["id"]=> int(2139435622) ["domain"]=> string(4) "test" ["status"]=> string(7) "success" ["reference"]=> string(10) "igkpaq7mtj" ["amount"]=> int(2000000) ["message"]=> string(11) "madePayment" ["gateway_response"]=> string(8) "Approved" ["paid_at"]=> string(24) "2022-09-29T07:10:21.000Z" ["created_at"]=> string(24) "2022-09-29T07:08:21.000Z" ["channel"]=> string(4) "bank" ["currency"]=> string(3) "NGN" ["ip_address"]=> string(12) "102.88.2.138" ["metadata"]=> string(0) "" ["log"]=> object(stdClass)#3 (9) { ["start_time"]=> int(1664435313) ["time_spent"]=> int(113) ["attempts"]=> int(1) ["authentication"]=> string(13) "payment_token" ["errors"]=> int(0) ["success"]=> bool(true) ["mobile"]=> bool(false) ["input"]=> array(0) { } ["history"]=> array(9) { [0]=> object(stdClass)#4 (3) { ["type"]=> string(6) "action" ["message"]=> string(27) "Set payment method to: bank" ["time"]=> int(8) } [1]=> object(stdClass)#5 (3) { ["type"]=> string(6) "action" ["message"]=> string(27) "Set payment method to: ussd" ["time"]=> int(9) } [2]=> object(stdClass)#6 (3) { ["type"]=> string(6) "action" ["message"]=> string(27) "Set payment method to: bank" ["time"]=> int(75) } [3]=> object(stdClass)#7 (3) { ["type"]=> string(5) "input" ["message"]=> string(33) "Filled this field: account number" ["time"]=> int(78) } [4]=> object(stdClass)#8 (3) { ["type"]=> string(6) "action" ["message"]=> string(34) "Attempted to pay with bank account" ["time"]=> int(78) } [5]=> object(stdClass)#9 (3) { ["type"]=> string(4) "auth" ["message"]=> string(33) "Authentication Required: birthday" ["time"]=> int(79) } [6]=> object(stdClass)#10 (3) { ["type"]=> string(4) "auth" ["message"]=> string(43) "Authentication Required: registration_token" ["time"]=> int(94) } [7]=> object(stdClass)#11 (3) { ["type"]=> string(4) "auth" ["message"]=> string(38) "Authentication Required: payment_token" ["time"]=> int(103) } [8]=> object(stdClass)#12 (3) { ["type"]=> string(7) "success" ["message"]=> string(35) "Successfully paid with bank account" ["time"]=> int(113) } } } ["fees"]=> int(40000) ["fees_split"]=> NULL ["authorization"]=> object(stdClass)#13 (13) { ["authorization_code"]=> string(15) "AUTH_5o98suv7nh" ["bin"]=> string(6) "000XXX" ["last4"]=> string(4) "X000" ["exp_month"]=> string(2) "12" ["exp_year"]=> string(4) "9999" ["channel"]=> string(4) "bank" ["card_type"]=> string(0) "" ["bank"]=> string(11) "Zenith Bank" ["country_code"]=> string(2) "NG" ["brand"]=> string(19) "Centralpay Emandate" ["reusable"]=> bool(false) ["signature"]=> NULL ["account_name"]=> NULL } ["customer"]=> object(stdClass)#14 (9) { ["id"]=> int(50551156) ["first_name"]=> NULL ["last_name"]=> NULL ["email"]=> string(24) "mauriceoscar58@gmail.com" ["customer_code"]=> string(19) "CUS_umafsvdq8ec3ty5" ["phone"]=> NULL ["metadata"]=> NULL ["risk_action"]=> string(7) "default" ["international_format_phone"]=> NULL } ["plan"]=> NULL ["split"]=> object(stdClass)#15 (0) { } ["order_id"]=> NULL ["paidAt"]=> string(24) "2022-09-29T07:10:21.000Z" ["createdAt"]=> string(24) "2022-09-29T07:08:21.000Z" ["requested_amount"]=> int(2000000) ["pos_transaction_data"]=> NULL ["source"]=> NULL ["fees_breakdown"]=> NULL ["transaction_date"]=> string(24) "2022-09-29T07:08:21.000Z" ["plan_object"]=> object(stdClass)#16 (0) { } ["subaccount"]=> object(stdClass)#17 (0) { } } }
