<?php
session_start();
$page = "Register";
include_once("header.php");


$contestantId = $_SESSION['contestantId'];

function customErrorHandler($errorevel, $errorMessage, $errorFile,$errorLine,$errorContext){
  // error_log($errorMessage,0,"mauriceoscar58@gmail.com","From: webmaster@example.com");
}

//set_error_handler(customErrorHandler,E_ALL);


?>


<section>
  <div >Congratulations!!!</div>
  <div>You are just a step away from completing the registration.</div>
  <div>Pay a non-refundable fee of <i class="naira">N</i>2,000</div>
<form>
  <button type="button" onClick="makePayment()" class="btn btn-md btn-outline-success">Pay</button>
</form>
  <script src="https://checkout.flutterwave.com/v3.js"></script>

<script>
  function makePayment() {
    FlutterwaveCheckout({
      public_key: "FLWPUBK-8e9283d197e801d8f247a68354a65ff9-X",
      tx_ref: "hooli-tx-1920bbtyt",
      amount: 2000,
      currency: "NGN",
      country: "NG",
      payment_options: "card, mobilemoneyghana, ussd, mobilemoneyrwanda,mobilemoneyfranco, mobilemoneyzambia, mobilemoneyuganda, mobilemoneytanzania, payattitude,paga, account, credit, barter,1voucher,qr,mpesa,banktransfer",
      redirect_url: // specified redirect URL
        "",
      meta: {
        consumer_id: 23,
        consumer_mac: "92a3-912ba-1192a",
      },
      customer: {
        email: "user@gmail.com",
        phone_number: "08102909304",
        name: "yemi desola",
      },
      callback: function (data) {
        console.log(data);
      },
      onclose: function() {
        // close modal
      },
      customizations: {
        title: "iss Global Africa",
        description: "Registration fee",
        logo: "https://assets.piedpiper.com/logo.png",
      },
    });
  }
</script>
</section>


<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/123456/verify",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: Bearer {{FLWSECK-18cd10c4d53125ed3b829cce1b2040f3-X}}"
  ),
));

$response = curl_exec($curl);

curl_close($curl);

echo $response;


/*sample output
{
  "status": "success",
  "message": "Transaction fetched successfully",
  "data": {
    "id": 1163068,
    "tx_ref": "akhlm-pstmn-blkchrge-xx6",
    "flw_ref": "FLW-M03K-02c21a8095c7e064b8b9714db834080b",
    "device_fingerprint": "N/A",
    "amount": 3000,
    "currency": "NGN",
    "charged_amount": 3000,
    "app_fee": 1000,
    "merchant_fee": 0,
    "processor_response": "Approved",
    "auth_model": "noauth",
    "ip": "pstmn",
    "narration": "Kendrick Graham",
    "status": "successful",
    "payment_type": "card",
    "created_at": "2020-03-11T19:22:07.000Z",
    "account_id": 73362,
    "amount_settled": 2000,
    "card": {
      "first_6digits": "553188",
      "last_4digits": "2950",
      "issuer": " CREDIT",
      "country": "NIGERIA NG",
      "type": "MASTERCARD",
      "token": "flw-t1nf-f9b3bf384cd30d6fca42b6df9d27bd2f-m03k",
      "expiry": "09/22"
    },
    "customer": {
      "id": 252759,
      "name": "Kendrick Graham",
      "phone_number": "0813XXXXXXX",
      "email": "user@example.com",
      "created_at": "2020-01-15T13:26:24.000Z"
    }
  }
}
*/

include_once("footer.php");
?>