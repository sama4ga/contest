<?php
require_once("connect.php");
$result = $con->query("SELECT `locationId`,`location` from `auditionlocation`");
if ($result) {
  echo "<option selected disabled value='default'>select audition location</option>";
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<option value='".$row['locationId']."'>".$row['location']."</option>";
    }
  }
}

?>