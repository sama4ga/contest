<?php
  $page = "Login";
?>
<div style="border:2px solid rgba(0,0,0,0.1);padding:30px;max-width:500px;min-width:200px;">
  <h2 class="text-muted text-center">Login</h2>
  <form action="login.php" method="post">
    <div class="mb-3">
      <label class="sr-only">Email</label>
      <input type="email" class="form-control" placeholder="email" id="txtEmail" name="txtEmail">
    </div>
    <div class="mb-3">
      <label class="form-label sr-only">Password</label>
      <input type="password" class="form-control" placeholder="password" id="txtPassword" name="txtPassword">
    </div>
    <div class="mb-3 form-check">
      <input type="checkbox" id="rememberMe" class="form-check-input" id="chkRemember" name="chkRemember"/>
      <label for="rememberMe">Remember me</label>
    </div>
    <div class="mb-3">
      <a href="forgotPassword.php" class="text-right">Forgot Password</a>
    </div>
    <div class="mb-3">
      <input type="submit" class="form-control btn btn-md btn-primary right" value="Login" id="btnLogin" name="btnLogin"/>
    </div>
  </form>

  <div>
    Not yet registered? <a href="register.html">click here to register</a>
  </div>
</div>