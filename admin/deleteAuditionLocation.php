<?php
include_once("connect.php");

 if (isset($_REQUEST['btnDelete'])) {
  $loc = $_REQUEST['txtLoc'];
  $locId = $_REQUEST['txtLocId'];
  $result = $con->query("DELETE FROM `auditionLocation` WHERE `locationId`=$locId;");
  if ($result) {
    echo "<div class='success'>$loc successfully removed</div>";
  }else{
    echo "<div class='error'>Error while removing $loc</div>".$con->error;
  }
}

?>