<?php
  $page = "Login";
  require_once("connect.php");
  include_once("header.php");

  if (isset($_POST["btnLogin"])) {
    $email = $_POST["txtEmail"];
    $password = $_POST["txtPassword"];

    /* $password_hash = password_hash($password,PASSWORD_DEFAULT);
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
      echo "<div class='alert alert-danger>
              <h4 class='alert-heading'>Error</h4>
              <p class='alert-body'>Invalid email supplied</p>
            </div>";
    }

    if (empty($msg)) {
      $stmt = $con->prepare("INSERT INTO `admin`(email,`password`) 
        VALUES(?,?);");
      $stmt->bind_param("ss",$email,$password_hash);
      $stmt->execute();
      if ($stmt->errno) {
        echo "<div class='alert alert-danger>
              <h4 class='alert-heading'>Error</h4>
              <p class='alert-body'>Error encountered: ".$stmt->error".</p>
            </div>";
      }else{
        echo "<div class='alert alert-success'>
                <h4 class='alert-heading'>Success</h4>
                <p class='alert-body'>Registration successful</p>
              </div>";
      }      
    } 
    
    
    $stmt = $conn->prepare("SELECT name FROM customers LIMIT ?");
    $stmt->bind_param("s", $obj->limit);
    $stmt->execute();
    $result = $stmt->get_result();
    $outp = $result->fetch_all(MYSQLI_ASSOC);
    
    */

    $result = $con->query("SELECT `password` FROM `admin` WHERE `email`='$email';");
    if ($result) {
      if ($result->num_rows == 1) {
        $password_hash = $result->fetch_assoc()["password"];
        if (password_verify($password,$password_hash)) {
          header("Location:admin/");
          echo "<div class='alert alert-success'>
                  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  <h4 class='alert-heading'>Success</h4>
                  <p class='alert-body'>Login successful</p>
                </div>";
          die();
        }
      }
    }

    echo "<div class='alert alert-danger'>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            <h4 class='alert-heading'>Error</h4>
            <p class='alert-body'>Invalid email and/or password supplied</p>
          </div>";
  }

?>


<div class="mycard">
  <h2 class="text-muted text-center">Login</h2>
  <form action="login.php" method="post">
    <div class="mb-3 form-floating">
      <input type="email" class="form-control" placeholder="email" id="txtEmail" name="txtEmail" required="required" />
      <label for="txtEmail" class="sr-only">Email</label>
    </div>
    <div class="mb-3 input-group form-floating">
      <input type="password" class="form-control" placeholder="password" id="txtPassword" name="txtPassword" required="required" />
      <label for="txtPassword" class="sr-only">Password</label>
      <div class="input-group-text"><i class="fa fa-eye" id="togglePassword" onclick="toggleShowPassword(this);"></i></div>
    </div>
    <div class="form-check">
      <input type="checkbox" id="rememberMe" class="form-check-input" id="chkRemember" name="chkRemember"/>
      <label for="rememberMe">Remember me</label>
    </div>
    <div class="mb-3 text-right">
      <a href="forgotPassword.php" class="text-dark">Forgot Password</a>
    </div>
    <div class="mb-3">
      <input type="submit" class="form-control btn btn-md btn-success right" value="Login" id="btnLogin" name="btnLogin"/>
    </div>
  </form>

  <div>
    Not yet registered? <a href="register.html">click here to register</a>
  </div>
</div>


<script>
  //document.getElementById("togglePassword").addEventListener("click",toggleShowPassword);
  var clickCount = 0;
  function toggleShowPassword(element){
    if(clickCount % 2 == 0){
      document.getElementById("txtPassword").type = "text";
      element.classList.remove("fa-eye");
      element.classList.add("fa-eye-slash");
    }else{
      element.classList.remove("fa-eye-slash");
      element.classList.add("fa-eye");
      document.getElementById("txtPassword").type = "password";
    }
    clickCount++;
  }
</script>

<?php include_once("footer.php"); ?>