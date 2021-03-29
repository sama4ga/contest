<?php
session_start();
date_default_timezone_set('Africa/Lagos');

  require_once("connect.php");
  $page = "Register";
  include_once("header.php");

  if (isset($_SESSION['contestId'])) {
    $contestId = $_SESSION['contestId'];
  } else {
    echo "<div class='info'>There is no open contest at the moment</div>";
    echo "<div style='margin:50px 0'><a href='index.php' class='btn btn-lg btn-warning center'>Back</a></div>";
    include_once("footer.php");
    die();
  }

  $msg = array();
  $success = "";

  if (isset($_POST['btnRegister'])) {
    $firstName = mysqli_real_escape_string($con,$_POST['txtFirstName']);
    $surname = mysqli_real_escape_string($con,$_POST['txtLastName']);
    $email = mysqli_real_escape_string($con,$_POST['txtEmail']);
    $dob = $_POST['dtpDOB'];
    $phone = $_POST['txtPhoneNumber'];
    $file = $_FILES['btnPic'];
    $category = $_POST['cmbCategory'];
    $countryId = $_POST['cmbCountry'];
    $locationId = $_POST['cmbLocation'];
    $facebookLink = mysqli_real_escape_string($con,$_POST['txtFacebookLink']);
    $instagramLink = mysqli_real_escape_string($con,$_POST['txtInstagramLink']);
    $twitterLink = mysqli_real_escape_string($con,$_POST['txtTwitterLink']);
    
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
    /*if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$facebookLink)) {
      $msg[] = "Invalid facebook link supplied";
    }*/
    if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
      $msg[] = "Invalid email supplied";
    }

    //$age = floor((time() - strtotime($dob))/(365*24*60*60));
    //if($age < 18)$msg[] = "You are less than 18 years. You are therefore not eligible to register for the contest";
    //if($age > 28)$msg[] = "You are older than 28 years. You are therefore not eligible to register for the contest";
    $year = date("Y");

    if (empty($msg)) {
      $stmt = $con->prepare("INSERT INTO `contestant`(
        contestId,firstName,surname,email,phoneNumber,dob,category,countryId,`year`,locationId,
        facebookLink,twitterLink) 
        VALUES(?,?,?,?,?,?,?,?,?,?,?,?);");
      $stmt->bind_param("ssssssssssss",$contestId,$firstName,$surname,$email,
        $phone,$dob,$category,$countryId,$year,$locationId,$facebookLink,$twitterLink);
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
        $_SESSION['contestantId'] = $contestantId;
        session_write_close();
        header("location: payContestFees.php");
        // echo "<div class='success'><b>Congratulation!!!</b> Your registration is successful</div>";
        // echo "<div><a href='index.php' class='btn btn-md btn-success'>Continue browsing</a></div>";
        // exit();
      }
    }
    $stmt->close();
  }

  $con->close();
  }
?>


<div class="my-3 center mycard">
  <h2 class="text-muted text-center my-3">Register</h2>
  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data" autocomplete="off" class="form needs-validation"><!-- onsubmit="return validate(this);"-->
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
    <!--<div class="mb-3">
      <label for="txtPassword" class="form-label sr-only">Password</label>
      <input type="password" class="form-control" placeholder="password" id="txtPassword" name="txtPassword"/>
    </div>-->
    <div class="mb-3">
      <label for="dtpDOB" class="form-label sr-only">Date of Birth</label>
      <input type="date" class="form-control" id="dtpDOB" name="dtpDOB" required="required"/>
      <div class="invalid-feedback">Your date of birth is required</div>
    </div>
    <div class="mb-3">
      <label for="txtPhoneNumber" class="form-label sr-only">Phone Number (WhatsApp enabled)</label>
      <input type="tel" class="form-control" id="txtPhoneNumber" name="txtPhoneNumber" placeholder="Phone Number (WhatsApp enabled)" required="required"/>
      <div class="invalid-feedback">Enter your phone number to proceed</div>
    </div>
    <div class="mb-3">
      <label for="btnPic" class="form-label sr-only">Picture</label>
      <input type="file" class="form-control" id="btnPic" name="btnPic" aria-describedby="fileSize" required="required" accept="Images|.jpg,.jpeg,.png"/>
      <div id="fileSize" style="color:red;font-size:small;">Maximum file size is 2Mb. Accepted formats are jpeg, jpg, and png </div>
      <div class="invalid-feedback">Upload your picture to proceed</div>
    </div>
    <div class="mb-3">
      <label for="cmbCategory" class="form-label sr-only">Category</label>
      <select class="form-control" id="cmbCategory" name="cmbCategory" required="required">
        <option selected disabled value="default">select category</option>
        <option value="pageantry">Miss Global Africa International Pageantry</option>
        <option value="tourFestival">Miss Global Africa International Tour Festival</option>
        <option value="talentShow">Miss Global Africa International Talent Show</option>
        <option value="foodFestival">Miss Global Africa International Food Festival</option>
        <option value="fashionShow">Miss Global Africa International Fashion Show</option>
      </select>
      <div class="invalid-feedback">Select a contest to proceed</div>
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
      <select class="form-control" id="cmbState" name="cmbState"></select>
    </div>
    <div class="mb-3">
      <label for="cmbLocation" class="form-label sr-only">Audition Location</label>
      <select class="form-control" id="cmbLocation" name="cmbLocation" required="required">
        <?php include_once("getLocations.php"); ?>
      </select>
      <div class="invalid-feedback">Select an audition location to proceed</div>
    </div>

    <div class="mb-3" id="mediaLinks">
      <label class="form-label">Social Media Links</label>
      <div class="mb-3">
        <label class="form-label sr-only">FaceBook Links</label>
      <!--<input type="url" class="form-control" name="txtSocialMedialLinks[]" />-->
        <input type="text" class="form-control" name="txtFacebookLink" placeholder="Facebook link"/>
      </div>
      <div class="mb-3">
        <label class="form-label sr-only">Instagram Links</label>
        <input type="text" class="form-control" name="txtInstagramLink" placeholder="Instagram link"/>
      </div>
      <div class="mb-3">
        <label class="form-label sr-only">Twitter Links</label>
        <input type="text" class="form-control" name="txtTwitterLink" placeholder="Twitter link"/>
      </div>
    </div>
    <!--<a href="javascript:addSocialMediaLink()" class="mb-3" style="float:right;">
      <i class="fa fa-plus"></i>
    </a><span style="clear:both;"></span>-->

    <div class="mb-3 btn-group justify-content-center g-3">
      <input type="submit" class="btn btn-success right" value="Register" id="btnRegister" name="btnRegister"/>
      <a href='index.php' class='btn btn-outline-success'>Back</a>
    </div>
  </form>

  <!--<div class="text-center">
    Already registered? <a href="login.html">click here to login</a>
  </div>-->
</div>
<script src="../Bootstrap/bootstrap-4.6.0-dist/js/jquery-3.51.min.js"></script>
<!-- <script type="text/html" id="mediaLinkBlock">
  <div class="mb-3">
    <input type="url" class="form-control" name="txtSocialMedialLinks[]" />
    <a href="#" onclick="removeSocialMediaLink(this);" class="mb-3" style="float:right;">
      <i class="fa fa-minus"></i>
    </a><span style="clear:both;"></span>
  </div>
</script> -->
<script>
  $(document).ready(function(){
    /* function addSocialMediaLink() {
      const link = document.querySelector("#mediaLinkBlock").innerHTML;
      document.querySelector("#mediaLinks").insertAdjacentHTML("beforeend",link);
    }
    function removeSocialMediaLink(element) {
      const parent = element.parentNode;
      parent.parentNode.removeChild(parent);
    } */
    $("#cmbCountry").on("change",function() {
      let country = $(this).val();
      $("#cmbState").load("getStates.php?id="+country);
      //$.post("getStae")
    });

    $("#btnRegister").click(function() {
      $(this).disabled();
    });

  });
</script>



<?php
include_once("footer.php");
?>