<?php
require_once("../connect.php");

if (isset($_POST['btnLogin'])) {
  $email = $_POST['txtEmail'];
  $password = $_POST['txtPassword'];

  $email = mysqli_real_escape_string($con, $email);
  $result = $con->query("SELECT `password` FROM `admin` WHERE `email`='$email'");
  if ($result) {
    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc()[0];
      $hpassword =  $row['password'];
      if (password_verify($password, $hpassword)) {
        $isValidated = true;
      }
    }
  }
}

?>

<form action="" method="post">
  <div>
    <div class="form-group">
      <label for="txtEmail">Email</label>
      <input type="email" name="txtEmail" id="txtEmail">
    </div>
    <div class="form-group">
      <label for="txtPassword">Email</label>
      <input type="password" name="txtPassword" id="txtPassword">
    </div>
    <div class="form-group">
      <input type="submit" name="btnLogin" value="Login">
    </div>
  </div>
</form>