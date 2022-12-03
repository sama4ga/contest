<?php
include_once("connect.php");
$page = "Register";
include_once("header.php");

$i = intval(base64_decode($_REQUEST['i']));
$n = base64_decode($_REQUEST['n']);
$e = base64_decode($_REQUEST['e']);
$a = $_REQUEST['a'];
$t = $_REQUEST['t'];

// var_dump($_REQUEST);

$result = $con->query("UPDATE `contestant` SET `tnxRef`='$t', `status`='Complete',`amount`=$a WHERE `cId`=$i;");

if ($result) {
  echo "<div class='alert alert-success fade show text-center'>
          <h1>Congratullations!!!</h1>
          <p>Payment successfull<br />
          Registration complete</p>
          <p class='text-sm'>You will be redirected in 10secs.</p>
          <p>Click <a href='register.php'>here</a> if you are not automatically redirected</p>
        </div>";
  $to = $e;
  $subject = "Vote casting successful";
  $body = "Hello $n,<p>This is to thank you for registering at the Miss Global Africa contest.</p>
  <p>Your registration was successfully completed and registration fee of <i style='text-decoration:line-through double;font-style:normal;'>N<i>$a received.
  <p></p><p>Prime Walker Entertainment</p>";
  include("admin/sendMail.php");
  if(SendSingleEmail($to,$subject,$body,$altBody="",$recipientName="",$from="",$senderName="",$replyTo="",$cc="",$bcc="",$attachment="")){
    echo "<div class='alert alert-success fade show'>An email has been sent to your mail at $to</div>";
  }
  echo '<meta http-equiv="refresh" content="10; url=register.php">';
}else{
  echo "<div class='alert alert-danger fade show'>Error updating payment</div>".$con->error;
}

include_once("footer.php");
?>