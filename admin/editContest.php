<?php
ini_set("timezone","Africa/Lagos");
require_once("../connect.php");
include_once("header.php");

$cId = $_REQUEST['id'];

$result = $con->query("SELECT `contestName`,`contestDate`,registrationStartDate,`contestStatus`,registrationEndDate,registrationStatus FROM contest WHERE contestId=$cId");
if ($result) {
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $status = $row['contestStatus'];
    $startDate = $row['registrationStartDate'];
    $endDate = $row['registrationEndDate'];
    $regStatus = $row['registrationStatus'];
    $date = $row['contestDate'];
    $name = $row['contestName'];
  }
}


if (isset($_POST['btnEdit'])) {
    $status = $_POST['cmbStatus'];
    $startDate = $_POST['dtpStartDate'];
    $endDate = $_POST['dtpEndDate'];
    $date = $_POST['dtpContestDate'];
    $name = mysqli_real_escape_string($con,$_POST['txtName']);
    $year = date_format(date_create($date),"Y");
    $regStatus =(strtotime($endDate)-strtotime($startDate)) > 0 ? "Open" : "Closed";

  $result = $con->query("UPDATE `contest` SET 
    `contestName`='$name',`contestYear`=$year,`contestDate`='$date',registrationStartDate='$startDate',
    registrationEndDate='$endDate',`contestStatus`='$status',registrationStatus='$regStatus' WHERE contestId =$cId;");
  if ($result) {
    echo "<div class='success'>Contest successfully updated</div>
          <a href='viewContests.php' class='btn btn-md btn-warning'>View Contests</a>
          <a href='createNewContest.php' class='btn btn-md btn-success'>Create Another Contest</a>";
          die();
  } else {
    echo "<div class='error'>An error occurred while editing contest</div>
          <a href='javascript:history.back();' class='btn btn-md btn-warning'>Back</a>".$con->error;
  }
  
}
?>

<div>
  <form action="<?PHP echo htmlspecialchars($_SERVER['PHP_SELF']).'?id='.$cId; ?>" method="POST">
    <div class="mb-3">
      <label for="" class="form-label">Name of Contest</label>
      <input type="text" id="txtName" name="txtName" value="<?php echo $name; ?>" class="form-control"  required="required"/>
    </div>
    <div class="mb-3">
      <label for="" class="form-label">Contest Date</label>
      <input type="date" id="dtpContestDate" name="dtpContestDate"  value="<?php echo $date; ?>" class="form-control"  required="required"/>
    </div>
    <div class="mb-3">
      <label for="" class="form-label">Registration Start Date</label>
      <input type="date" id="dtpStartDate" name="dtpStartDate"  value="<?php echo $startDate; ?>" class="form-control" required="required"/>
    </div>
    <div class="mb-3">
      <label for="" class="form-label">Registration End Date</label>
      <input type="date" id="dtpEndDate" name="dtpEndDate"  value="<?php echo $endDate; ?>" class="form-control"  required="required"/>
    </div> 
    <!--<div class="mb-3">
      <label for="" class="form-label">Registration Status</label>
      <select name="cmbStatus" class="form-select">
        <option value="Open">Open</option>
        <option value="Closed">Closed</option>
      </select>-->
    </div> 
    <div class="mb-3 border">
      <label for="" class="form-label">Status</label>
      <select name="cmbStatus" class="form-select">
        <?php
          if ($status == "Active") {
            echo "<option value='Active' selected='selected'>Active</option>
            <option value='Ended'>Ended</option>";
          }else {
            echo "<option value='Active'>Active</option>
            <option value='Ended' selected='selected'>Ended</option>";
          }
        ?>
      </select>
    </div> 
    <div class="mb-3">
      <input type="submit" name="btnEdit" value="Update Contest" class="form-control btn btn-md btn-success"  />
    </div>
  </form>
</div>