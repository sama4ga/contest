<?php
require_once("connect.php");
$page = "Contact";
include_once("header.php");

if (isset($_POST['btnSend'])) {
  $name = $_POST['txtName'];
  $phone = $_POST['txtPhoneNo'];
  $email = $_POST['txtEmail'];
  $message = $_POST['txtMessage'];

  $stmt = $con->prepare("INSERT INTO `contactUs`(
    `name`,phoneNumber,email,`message`) 
    VALUES(?,?,?,?);");
  $stmt->bind_param("ssss",$name,$phone,$email,$message);
  $stmt->execute();
  if ($stmt->errno) {
    echo "<div class='error'>An error occurred while sending your message</div>";
  }else{
    echo "<div class='success'>Message successfully sent</div>"; 
  }
  echo "<a href='javascript:history.back();' class='btn btn-md btn-success'>Back</a>";
  die();
}
//<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>
?>

<div class="border">
  <h1 class="text-center text-muted my-4">CONTACT US</h1>
  <form action="mailto:missglobalafricainternational@gmail.com" class="form" method="POST">
    <div class="form-group">
      <label for="txtName" class="control-label sr-only">Name</label>
      <input type="text" class="form-control" id="txtName" name="txtName" placeholder="Name" required />
    </div>
    <div class="form-group">
      <label for="txtEmail" class="control-label sr-only">Email</label>
      <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="Email" required />
    </div>
    <div class="form-group">
      <label for="txtPhoneNo" class="control-label sr-only">Phone Number</label>
      <input type="tel" class="form-control" id="txtPhoneNo" name="txtPhoneNo" placeholder="+2238080000000" required />
    </div>
    <div class="form-group">
      <label for="txtMessage" class="control-label sr-only">Message</label>
      <textarea class="form-control" id="txtessage" name="txtMessage" rows="15" cols="20" placeholder="Message" required></textarea>
    </div>
    <div class="from-group">
      <input type="submit" class="btn btn-md btn-success form-control" value="Send" id="btnSend" name="btnSend" />
    </div>
  </form>
</div>


<<?php
require_once("footer.php");
?>