<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

error_reporting(E_STRICT | E_ALL);
date_default_timezone_set('Africa/Lagos');

/**
 * Returns PHPMailer for eternal use
 */
function GetMail(){

  //Load Composer's autoloader
  require 'vendor/autoload.php';

  //Instantiation and passing `true` enables exceptions
  $mail = new PHPMailer(true);

  //Server settings
  $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
  $mail->isSMTP();                                            //Send using SMTP
  $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
  $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
  $mail->Username   = 'mauriceoscar58@gmail.com';                     //SMTP username
  $mail->Password   = 'ybfhhrycnbtuxaxf';                               //SMTP password
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
  $mail->Port       = 465; //587 465                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

  return $mail;

}

function SendSingleEmail($to,$subject,$body,$altBody="",$recipientName="",$from="",$senderName="",$replyTo="",$cc="",$bcc="",$attachment=""){

  $mail = GetMail();

  try {
      
      $from = "primewalkerentertainment@gmail.com";
      $replyTo = $replyTo == "" ? $from : $replyTo;
      $senderName = $senderName == "" ? "Prime Walker Entertainment" : $senderName;

      //Recipients
      $mail->setFrom($from, $senderName);
      $mail->addAddress($to, $recipientName);     //Add a recipient
      //$mail->addAddress('ellen@gmail.com');               //Name is optional
      $mail->addReplyTo($replyTo, $senderName);
      if($cc != ""){$mail->addCC($cc);}
      if($bcc != ""){$mail->addBCC($bcc);}

      //Attachments
      if($attachment != ""){$mail->addAttachment($attachment);}         //Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

      //Content
      $mail->isHTML(true);       
      $mail->CharSet = 'UTF-8';
      $mail->Encoding = 'base64';                           //Set email format to HTML
      $mail->Subject = $subject;
      $mail->msgHTML($body);
      if($altBody != ""){$mail->AltBody = $altBody;}
      

      $mail->send();
      //echo 'Message has been sent';
      return true;
  } catch (Exception $e) {
      //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      return false;
  }
}

function SendMultipleMail($body){
  $mail = GetMail();
  $mail->SMTPKeepAlive = true; //SMTP connection will not close after each email sent, reduces SMTP overhead
  $mail->msgHTML($body);
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!';

  // try {
  //   $mail->addAddress($row['email'], $row['full_name']);
  // } catch (Exception $e) {
  //     echo 'Invalid address skipped: ' . htmlspecialchars($row['email']) . '<br>';
  //     continue;
  // }
  // if (!empty($row['photo'])) {
  //     //Assumes the image data is stored in the DB
  //     //$mail->addStringAttachment($row['photo'], 'YourPhoto.jpg');
  //     $mail->addAttachment($row['photo'], 'YourPhoto.jpg');
  // }

  // try {
  //     $mail->send();
  //     echo 'Message sent to :' . htmlspecialchars($row['full_name']) . ' (' .
  //         htmlspecialchars($row['email']) . ')<br>';
  //     //Mark it as sent in the DB
  //     mysqli_query(
  //         $mysql,
  //         "UPDATE mailinglist SET sent = TRUE WHERE email = '" .
  //         mysqli_real_escape_string($mysql, $row['email']) . "'"
  //     );
  // } catch (Exception $e) {
  //     echo 'Mailer Error (' . htmlspecialchars($row['email']) . ') ' . $mail->ErrorInfo . '<br>';
  //     //Reset the connection to abort sending this message
  //     //The loop will continue trying to send to the rest of the list
  //     $mail->getSMTPInstance()->reset();
  // }
  // //Clear all addresses and attachments for the next iteration
  // $mail->clearAddresses();
  // $mail->clearAttachments();
}