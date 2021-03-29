<?php
  require_once("../connect.php");
  include_once("header.php");

  $cId = $_REQUEST['id'];

  $result = $con->query("DELETE FROM `contest` WHERE cId=$cId;");
  if ($result) {
    echo "<div class='success'>Contest successfully deleted</div>
          <a href='viewContests.php' class='btn btn-md btn-success'>View Contests</a>";
  } else {
    echo "<div class='error'>An error occurred while deleting contest</div>
          <a href='javascript:history.back();' class='btn btn-md btn-success'>Back</a>".$con->error;
  }
?>
