<?php
require_once("../connect.php");
include_once("header.php");

$msg = array();

if (isset($_POST['btnCreate'])) {
  $name = mysqli_real_escape_string($con,$_POST['txtName']);
  $date = $_POST['dtpContestDate'];
  $startDate = $_POST['dtpStartDate'];
  $endDate = $_POST['dtpEndDate'];
  $year = date_format(date_create($date),"Y");

  if ((strtotime($endDate)-strtotime($startDate)) < 0) $msg[] = "Registration start date cannot be greter than registration end date";
  if ((strtotime($date)-strtotime($endDate)) < 0) $msg[] = "Contest cannot start before registration ends";
  if ((strtotime($date)-strtotime($startDate)) < 0) $msg[] = "Contest cannot start before registration starts";
  
  if(empty($msg)){
    $result = $con->query("INSERT INTO `contest`(
      `contestName`,`contestYear`,`contestDate`,registrationStartDate,registrationEndDate
      ) 
      VALUES('$name',$year,'$date','$startDate','$endDate');");
    if($result){
      echo "<div class='success'>Contest successfully created</div>
            <div>
              <a href='javascript:history.back();' class='btn btn-md btn-success'>Back</a>
            </div>";
    }else{
      echo "<div class='error'>An error occurred while creating contest</div>
            <a href='javascript:history.back();' class='btn btn-md btn-success'>Back</a>".$con->error;
    }
    die();
  }else{
    foreach ($msg as $key => $value) {
      echo "<div class='error'>".$value."</div>";
    }
    echo "<a href='javascript:history.back();' class='btn btn-md btn-success'>Back</a>";
  }
}

?>

<div class="border" style="border-radius:10px;">
  <form action="" method="POST" class="form" autocomplete="off">
    <div class="mb-3">
      <label for="txtName" class="form-label ">Name of Contest</label>
      <input type="text" id="txtName" name="txtName" class="form-control" placeholder='name of contest' required="required"/>
    </div>
    <div class="mb-3">
      <label for="dtpContestDate" class="form-label">Contest Date</label>
      <input type="date" id="dtpContestDate" name="dtpContestDate" class="form-control"  required="required"/>
    </div>
    <div class="mb-3">
      <label for="dtpStartDate" class="form-label ">Registration Start Date</label>
      <input type="date" id="dtpStartDate" name="dtpStartDate" class="form-control" required="required"/>
    </div>
    <div class="mb-3">
      <label for="dtpEndDate" class="form-label ">Registration End Date</label>
      <input type="date" id="dtpEndDate" name="dtpEndDate" class="form-control"  required="required"/>
    </div> 
    <div class="mb-3">
      <input type="submit" name="btnCreate" id="btnCreate" value="Create Contest" class="form-control btn btn-md btn-success"  />
    </div>
  </form>
</div>