<?php
session_start();

date_default_timezone_set('Africa/Lagos');

  require_once("connect.php");
  $page = "Register";
  include_once("header.php");

  // if (isset($_SESSION['contestId'])) {
  //   $contestId = $_SESSION['contestId'];
  // } else {
  //   echo "<div class='info'>There is no open contest at the moment</div>";
  //   echo "<div style='margin:50px 0'><a href='index.php' class='btn btn-lg btn-warning center'>Back</a></div>";
  //   include_once("footer.php");
  //   die();
  // }

  $msg = array();
  $success = "";

  if (isset($_POST['btnRegister'])) {
    $firstName = mysqli_real_escape_string($con,$_POST['txtFirstName']);
    $surname = mysqli_real_escape_string($con,$_POST['txtLastName']);
    $email = mysqli_real_escape_string($con,$_POST['txtEmail']);
    $dob = $_POST['dtpDOB'];
    $phone = $_POST['txtPhoneNumber'];
    $file = $_FILES['btnPic'];
    $countryId = $_POST['cmbCountry'];
    $stateId = $_POST['cmbState'];
    //perform file upload
    $accepted_formats = array("jpeg","jpg","png");
    $fileName = basename($file['name']);
    $fileExt = pathinfo($fileName,PATHINFO_EXTENSION);
    if (!in_array($fileExt,$accepted_formats)) {
      $msg[] = "File type not supported";
    }
    if ($file['size'] > 2000000) {
      $msg[] = "File too large";
    }
    if ($file['tmp_name'] == "") {
      $msg[] = "Invalid file uploaded";
    }

    if (!preg_match("/^[a-zA-Z]*$/",$firstName)) {
      $msg[] = "Invalid firstname supplied";
    }
    if (!preg_match("/^[a-zA-Z]*$/",$surname)) {
      $msg[] = "Invalid last name supplied";
    }
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
      $msg[] = "Invalid email supplied";
    }
    $year = date("Y");

    if (empty($msg)) {

      // check if already registered
      $stmt = $con->prepare("SELECT `status`,`firstName`, `surname`,`email`,`cId` FROM `contestant` WHERE `firstName`=? AND `surname`=? AND `email`=? AND `phoneNumber`=? AND `countryId`=? AND `stateId`=? AND `year`=$year;");
      $stmt->bind_param("ssssss", $firstName, $surname, $email, $phone, $countryId, $stateId);
      $stmt->execute();
      if (!$stmt->errno) {
        // include_once("header.php");
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
          //check if status is complete
          $row =$result->fetch_assoc();
          if ($row['status'] == "Incomplete") {
            $i = base64_encode($row['cId']);
            $e = base64_encode($row['email']);
            $n = base64_encode($row['surname'].", ".$row['firstName']);

            echo "<div class='alert alert-info mx-auto my-4'>You have an incomplete registration. Visit <a href='payContestFees.php?n=$n&e=$e&i=$i'>Make payment</a> to complete your registration</div>";
            return;
          }else{
            echo "<div class='alert alert-info'>You are already registered</div>";
            return;
          }
        }
      }else{
        echo "<div class='alert alert-danger'>Error checking registration</div>".$con->error;
      }

      $stmt = $con->prepare("INSERT INTO `contestant`(firstName,`surname`,`email`,phoneNumber,`dob`,countryId,stateId,`year`) 
        VALUES(?,?,?,?,?,?,?,?);");
      $stmt->bind_param("ssssssss",$firstName,$surname,$email,
        $phone,$dob,$countryId,$stateId,$year);
      $stmt->execute();
    if ($stmt->errno) {
      $msg[] = "Error encountered: ".$stmt->error;
    }else{
      $contestantId = $stmt->insert_id;
      if (!file_exists("images")) {
        mkdir("images");
      }
      $filename = "images/constestant_".$contestantId.".".$fileExt;
      if(move_uploaded_file($file['tmp_name'],$filename)){        
        $result = $con->query("UPDATE `contestant` SET `picture`='$filename' WHERE `cId`='$contestantId';");
        if (!$result) {
          $msg[] = "Error uploading picture: ".$con->error;
        }
      }else{
        $msg[] = "Error uploading image";
      }

      if (empty($msg)) {
        $n = base64_encode($surname.", ".$firstName);
        $i = base64_encode($contestantId);
        $e = base64_encode($email);
        // $_SESSION['contestantId'] = $contestantId;
        // $_SESSION['contestantName'] = $name;
        // $_SESSION['contestantEmail'] = $email;
        // $_SESSION['contestantPic'] = $filename;
        // $_SESSION['contestantPhone'] = $phone;
        // session_write_close();
        echo "<meta http-equiv='refresh' content='0; url=payContestFees.php?n=$n&e=$e&i=$i'";
        // echo "<div class='success'><b>Congratulation!!!</b> Your registration is successful</div>";
        // echo "<div><a href='index.php' class='btn btn-md btn-success'>Continue browsing</a></div>";
        exit();
      }
    }
    $stmt->close();
  }

  $con->close();
  }

  
  // include_once("header.php");
?>


<div class="my-3 center mycard">
  <h2 class="text-muted text-center my-3">Register</h2>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" autocomplete="on" class="form needs-validation"><!-- onsubmit="return validate(this);"-->
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
  ?>
  <div class="row">
    <div class="mb-3 col-6">
      <label for="txtFirstName" class="form-label sr-only">First Name</label>
      <input type="text" class="form-control" placeholder="First name" id="txtFirstName" name="txtFirstName" required="required"/>
      <div class="invalid-feedback">Please supply a first name to proceed</div>
    </div>
    <div class="mb-3 col-6">
      <label for="txtLastName" class="form-label sr-only">Last Name</label>
      <input type="text" class="form-control" placeholder="Last name" id="txtLastName" name="txtLastName" required="required"/>
      <div class="invalid-feedback">Please supply a last name to proceed</div>
    </div>
  </div>
    <div class="mb-3">
      <label for="txtEmail" class="form-label sr-only">Email</label>
      <input type="email" class="form-control" placeholder="email" id="txtEmail" name="txtEmail" required="required"/>
      <div class="invalid-feedback">Please supply a valid email to proceed</div>
    </div>
    <div class="mb-3">
      <label for="dtpDOB" class="form-label sr-only">Date of Birth</label>
      <input type="date" class="form-control" id="dtpDOB" name="dtpDOB" required="required"/>
      <div class="invalid-feedback">Your date of birth is required</div>
    </div>
    <div class="mb-3">
      <label for="txtPhoneNumber" class="form-label sr-only">Phone Number (WhatsApp enabled)</label>
      <input type="tel" class="form-control" id="txtPhoneNumber" name="txtPhoneNumber" placeholder="Phone Number (WhatsApp enabled) e.g +2348000000000" required="required"/>
      <div class="invalid-feedback">Enter your phone number to proceed</div>
    </div>
    <div class="mb-3">
      <label for="btnPic" class="form-label sr-only">Picture</label>
      <input type="file" class="form-file-control" id="btnPic" name="btnPic" aria-describedby="fileSize" required="required" accept="Images|.jpg,.jpeg,.png"/>
      <div id="fileSize" style="color:red;font-size:small;">Maximum file size is 2Mb. Accepted formats are jpeg, jpg, and png </div>
      <div class="invalid-feedback">Upload your picture to proceed</div>
    </div>
    <div class="mb-3">
      <label for="cmbCountry" class="form-label sr-only">Country</label>
      <select class="form-control" id="cmbCountry" name="cmbCountry" required="required">
      <?php include_once("getCountries.php"); ?>
      </select>
      <div class="invalid-feedback">Select your country</div>
    </div>
    <div class="mb-3">
      <label for="cmbState" class="form-label sr-only">State</label>
      <select class="form-control" id="cmbState" name="cmbState" required="required"></select>
      <div class="invalid-feedback">Select your state to proceed</div>
    </div>

    <div class="mb-3 mt-4 btn-group">
      <a href='index.php' class='btn btn-outline-success w-50 pl-4 pr-4'>Back</a>
      <input type="submit" class="btn btn-success w-50 pl-4 pr-4" value="Register" id="btnRegister" name="btnRegister"/>
    </div>
  </form>
</div>

<script src="../Bootstrap/bootstrap-4.6.0-dist/js/jquery-3.51.min.js"></script>
<script>
  $(document).ready(function(){
    $("#cmbCountry").on("change",function() {
      let country = $(this).val();
      $("#cmbState").load("getStates.php?id="+country);
    });
  });
</script>



<?php
include_once("footer.php");
?>

<script>
  switchMenuItem(2);
</script>