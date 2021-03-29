<?php
//require_once("../connect.php");

$emails = json_decode($_REQUEST['emails']);//var_dump($emails);
$title = $_REQUEST['title'];echo $title;
$message = $_REQUEST['message'];echo $message;

require_once("SMTP.php");

foreach ($emails as $key => $email) {
  $response = sendEmail($email,$message,$title,"Contestant");
  if($response){
    echo "Email successfully sent";
  }else {
    echo $response;
  }
}

?>