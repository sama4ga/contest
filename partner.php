<?php
  require_once("connect.php");
  $page = "Partner/Sponsor";
  include_once("header.php");

  $msg = array();
  $success = "";

  if (isset($_POST['btnRegister'])) {
    $name = mysqli_real_escape_string($con,$_POST['txtName']);
    $email = $_POST['txtEmail'];
    $industry = mysqli_real_escape_string($con,$_POST['txtIndustry']);
    $phone = $_POST['txtPhoneNo'];
    $method = mysqli_real_escape_string($con,$_POST['txtMethod']);
    $type = isset($_POST['rdType'])?$_POST['rdType']:"";
    if ($type == "") $msg[] = "Choose a sponsorship type to proceed";

    if (empty($msg)){
      $stmt = $con->prepare("INSERT INTO `partner`(`name`,industry,`type`,email,phoneNumber,method) 
        VALUES(?,?,?,?,?,?);");
      $stmt->bind_param("ssssss",$name,$industry,$type,$email,$phone,$method);
      $stmt->execute();
      if ($stmt->errno) {
        $msg[] = "Error encountered: ".$stmt->error;
      }else{
        $success = "Registration successful.<p>Thank you for registering as a partner/sponsor</p>";
      }
    }
  }

?>


<div class="my-3 center border">
  <h2 class="text-muted text-center my-3">Partner/Sponsor Registration form</h2>
  <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
  <?php 
    if(!empty($msg)){
      echo "
          <div class='error'>
            <ul>";
      foreach ($msg as $key => $value) {
        echo "<li>$value</li>";
      }
      echo "</ul>
          </div>
      ";
    }
    if($success != "")echo "<div class'success'>$success</div>";
  ?>
    <div class="mb-3">
      <label for="txtName" class="form-label">Name of Sponsor</label>
      <input type="name" class="form-control" id="txtName" name="txtName" placeholder="name of sponsor" required="required"/>
    </div>
    <div class="mb-3">
      <label for="txtEmail" class="form-label">Email of Sponsor</label>
      <input type="email" class="form-control" id="txtEmail" name="txtEmail" placeholder="email of sponsor" required="required"/>
    </div>
    <div class="mb-3">
      <label for="txtPhoneNo" class="form-label">Phone Number of Sponsor</label>
      <input type="tel" class="form-control" id="txtPhoneNo" name="txtPhoneNo" placeholder="phone number of sponsor" required="required"/>
    </div>
    <div class="mb-3">
      <label for="txtIndustry" class="form-label">Industry of Sponsor</label>
      <input type="text" class="form-control" id="txtIndustry" name="txtIndustry" placeholder="industry of sponsor" required="required"/>
    </div>
    <div class="mb-3">
      <label class="form-label">Sponsorship Type</label><br />
      <input type="radio" class="form-radio-input" id="rdBrand" name="rdType" value="Brand"/>
      <label for="rdBrand" class="form-label">Brand</label>
      
      <input type="radio" class="form-radio-input" id="rdIndividual" name="rdType" value="Individual" />
      <label for="rdIndividual" class="form-label">Individual</label>
    </div>
    <div class="mb-3">
      <label for="txtMethod">How do you want to Partner/Sponsor</label>
      <textarea class="form-control" id="txtMethod" name="txtMethod" rows="10" required="required"></textarea>
    </div>
    <div class="mb-3">
      <input type="submit" class="form-control btn btn-md btn-success" id="btnRegister" name="btnRegister" value="Register"/>
    </div>
  </form>
</div>

<?php
  include_once("footer.php");
?>