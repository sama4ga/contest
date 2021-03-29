<?php
require_once("connect.php");
$result = $con->query("SELECT `countryId`,`country` from `country` WHERE `continentId`=1;");
if ($result) {
  echo "<option value='default'>select country</option>";
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<option value='".$row['countryId']."'>".$row['country']."</option>";
    }
  }
}

?>