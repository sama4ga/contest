<?php
require_once("../connect.php");
include_once("header.php");

echo "<h1 class='text-center text-muted my-3'>List of Contests</h1>";

$result = $con->query("SELECT contestId,`contestName`,`contestDate`,registrationStartDate,
  `contestStatus`,registrationEndDate,registrationStatus FROM `contest`; ");
if ($result) {
  if ($result->num_rows > 0) {
    $count = 0;
    echo "<table class='table banded' style='font-size:12px' id='list'>
            <thead>
              <th>S/N</th>
              <th>Name</th>
              <th>Contest Date</th>
              <th>Registration Start Date</th>
              <th>Registration End Date</th>
              <th>Registration Status</th>
              <th>Contest Status</th>
              <th>Action</th>
            </thead>
            <tbody>";
    while ($row = $result->fetch_assoc()) {
      ++$count;
      echo "<tr>
              <td>".$count."</td>
              <td>".$row['contestName']."</td>
              <td>".$row['contestDate']."</td>
              <td>".$row['registrationStartDate']."</td>
              <td>".$row['registrationEndDate']."</td>
              <td>".$row['registrationStatus']."</td>
              <td>".$row['contestStatus']."</td>
              <td>
                <a href='viewContestants.php?id=".$row['contestId']."' class='btn btn-sm btn-success'>View&nbsp;Contestants</a>
                <a href='editContest.php?id=".$row['contestId']."' class='btn btn-sm btn-warning'>Edit</a>
                <a onclick=\"return confirmAction('delete','this record')\" href='deleteContest.php?id=".$row['contestId']."' class='btn btn-sm btn-danger'>Delete</a>
              </td>
            </tr>";
    }
    echo "</tbody>
          </table>
          <div class='my-3'>
            <button class='btn btn-lg btn-success' onclick=\"printList('list')\">Print List</button>
            <a href='createNewContest.php' class='btn btn-lg btn-success'>Create Another Contest</a>
          </div>";
  } else {
    echo "<div>No record found</div>";
  }  
} else {
  echo "<div class='error'>Error fetching record: </div>".$con->error;
}


include_once("footer.php");
?>