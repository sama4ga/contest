<?php
session_start();

if(isset($_POST['btnPay'])){
	
	$curl = curl_init();
	$error = false;

	$e = $_REQUEST['txtEmail'];
	$v = $_REQUEST['txtNoVotes'];
	$i = $_REQUEST['i'];
	$n = $_REQUEST['n'];
	$_SESSION['v'] = $v;
	$_SESSION['e'] = $e;
	$_SESSION['i'] = $i;
	$_SESSION['n'] = $n;
	session_write_close();
	
	$amount = 100000*$v;  //the amount in kobo. This value is actually NGN 100

	// url to go to after payment
	$callback_url = "http://localhost/contest/paymentCallback.php?i=$i&n=$n&v=$v&e=$e";  
//	$callback_url = 'https://www.missglobalafrica.com.ng/paymentCallback.php?i=$i&n=$n&v=$v&e=$e';  

	curl_setopt_array($curl, array(
		CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS => json_encode([
			'amount'=>$amount,
			'email'=>$e,
			'callback_url' => $callback_url
		]),
		CURLOPT_HTTPHEADER => [
			"authorization: Bearer sk_test_35e842e527a13bd2ff2ee70a52d7a44b424724bd", //replace this with your own test key
			"content-type: application/json",
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

	$tranx = json_decode($response, true);

	if(!$tranx['status']){
		// there was an error from the API
		print_r('API returned error: ' . $tranx['message']);
		$error = true;
	}

	if(!$error){
		// comment out this line if you want to redirect the user to the payment page
		print_r($tranx);
		// redirect to page so User can pay
		// uncomment this line to allow the user redirect to the payment page
		header('Location: ' . $tranx['data']['authorization_url']);
	}else{
		echo "<h2>Error occurred during payment.<p>Vote casting was not successfull</p></h2>";
	}
}
