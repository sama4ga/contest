<?php
session_start();
$page = "Register";
include_once("header.php");


$contestantId = $_SESSION['contestantId'];
$contestantName = $_SESSION['contestantName'];
$contestantPic = $_SESSION['contestantPic'];
$contestantEmail = $_SESSION['contestantEmail'];
$contestantPhone = $_SESSION['contestantPhone'];

$i = $_REQUEST['i'];
$e = $_REQUEST['e'];
$n = $_REQUEST['n'];

// function GetClientMac(){
//   $macAddr=false;
//   $arp=`arp -n`;
//   $lines=explode("\n", $arp);

//   foreach($lines as $line){
//       $cols=preg_split('/\s+/', trim($line));

//       if ($cols[0]==$_SERVER['REMOTE_ADDR']){
//           $macAddr=$cols[2];
//       }
//   }

//   return $macAddr;
// }


// function GetMAC(){
//   ob_start();
//   system('getmac');
//   $Content = ob_get_contents();
//   ob_clean();
//   return substr($Content, strpos($Content,'\\')-20, 17);
// }

// $string=exec('getmac');
// $mac=substr($string, 0, 17); 
//echo "<br/>1:".$mac;

// $macAddress = $mac;
//echo  "<br/>2:$macAddress";
//echo "<br/>3:".$_SERVER['REMOTE_ADDR'];
//var_dump($_SERVER);


// function customErrorHandler($errorevel, $errorMessage, $errorFile,$errorLine,$errorContext){
//    error_log($errorMessage,0,"mauriceoscar58@gmail.com","From: webmaster@example.com");
// }

//set_error_handler(customErrorHandler,E_ALL);


?>

<div class="container-fluid">
<section class="mx-auto card my-4 p-4" style="width:80%; max-width:500px;">
  <h1 class="text-center">Congratulations!!!</h1>
  <div class="text-center mb-4">
    You are just a step away from completing the registration.<br />
    Pay a non-refundable fee to complete your registration.
  </div>
  <form method="POST" action="paymentInitRegistration.php">
    <input type="hidden" name="i" value="<?php echo $i; ?>">
    <input type="hidden" name="n" value="<?php echo $n; ?>">
    <input type="hidden" name="e" value="<?php echo $e; ?>">
    <div class="form-group">
      <label>Amount</label>
      <input type="number" name="txtAmount" class="form-control" placeholder="Enter registration amount" min="100" />
    </div>
    <div>
      <button type="submit" name="btnPay" class="btn btn-md btn-outline-success">Pay</a>
    </div>
  </form>
</section>
</div>
  
<!-- <script src="https://checkout.flutterwave.com/v3.js"></script> -->

<script>

  function uniqueID() {
    return Math.floor(Math.random() * Date.now());
  }
  //import {v4 as uuidv4 } from "uuid";
  //const {v4: uuidv4 } = require('uuid');

  var mac,id,email,phone,uname,ref;
  id = Number('<?php echo $contestantId; ?>');
  mac = '<?php echo $macAddress; ?>';
  email = '<?php echo $contestantEmail; ?>';
  uname = '<?php echo $contestantName; ?>';
  phone = '<?php echo $contestantPhone; ?>';
  //ref = uuidv4();
  //console.log(uuidv4()+" hello");
  ref = uniqueID();


  function makePayment() {
    FlutterwaveCheckout({
      public_key: "FLWPUBK-46ebcc877680ddf1588482d2390ad08a-X",
      tx_ref: ref,
      amount: 2000,
      currency: "NGN",
      country: "NG",
      payment_options: "card, mobilemoneyghana, ussd, mobilemoneyrwanda,mobilemoneyfranco, mobilemoneyzambia, mobilemoneyuganda, mobilemoneytanzania, payattitude,paga, account, credit, barter,1voucher,qr,mpesa,banktransfer",
      redirect_url: // specified redirect URL
        "",
      meta: {
        consumer_id: id,
        consumer_mac: mac,
      },
      customer: {
        email: email,
        phone_number: phone,
        name: uname,
      },
      callback: function (data) {
        console.log(data);
      },
      onclose: function() {
        // close modal
      },
      customizations: {
        title: "Miss Global Africa",
        description: "Contest Registration Fee",
        logo: "http://localhost/contest/images/logo.jpg",
      },
    });
  }

</script>



<?php

// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/123456/verify",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "GET",
//   CURLOPT_HTTPHEADER => array(
//     "Content-Type: application/json",
//     "Authorization: Bearer FLWSECK-843df72d6e64ff40cf1c5c71258cb847-X"
//   ),
// ));

// $response = curl_exec($curl);

// curl_close($curl);

// echo $response;


/*$response = json_decode('{
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
}');

$data = $response->data;

if ($data->status == "successful") {
  $result = $con->query("UPDATE `contestant` SET `status`='Complete' WHERE `cId`=$contestantId;");
  if ($result) {
    echo "<div class='alert alert-success alert-dismissible fade show'><button class='close' data-dismiss='alert'>&times;</button>Registration completed</div>";
  }else{
    echo "<div class='alert alert-danger alert-dismissible fade show'><button class='close' data-dismiss='alert'>&times;</button>Payment not successful</div>";
  }
}
*/
include_once("footer.php");
?>