<?php
require_once("connect.php");
$countryId = $_REQUEST['id'];
$result = $con->query("SELECT `stateId`,`state` from `state` WHERE `countryId`=$countryId");
if ($result) {
  echo "<option selected disabled value='default'>select state</option>";
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<option value='".$row['stateId']."'>".$row['state']."</option>";
    }
  }
}

?>