<?php 
$page = "Result";
require_once("../connect.php");
include_once("header.php");

if (isset($_POST['btnAddVote'])) {
 $v = $_POST['txtNoVotes'];
 $cId = $_REQUEST['cId'];
 $sql = "INSERT INTO `vote`(`cId`,`voterEmail`, `tnxRef`,`vote`) VALUES($cId,'Admin','Admin',$v);";
 $result = $con->query($sql);
 if (!$result) {
  echo "<div class='alert alert-danger fade show'>Could not add $v votes</div>";
}else{
   echo "<div class='alert alert-success fade show'>$v votes successfully added</div>";
 }
}

echo "<h1 class='text-center text-muted my-3'>Contest Result</h1>";

$sql = "SELECT c.`cId`,concat(`surname`,', ',`firstName`) as 'name',`picture`,sum(`vote`) as 'votes', `country`
		FROM `contestant` c 
		LEFT JOIN `vote` v ON c.`cId`=v.`cId`    
    LEFT JOIN country co ON co.countryId=c.countryId
		GROUP BY c.`cId`;";
// $sql = "SELECT c.`cId`,concat(`surname`,', ',`firstName`) as 'name',`picture`,`vote` as 'votes', `country`, `voterEmail`, v.`tnxRef`, `date`
// 		FROM `contestant` c 
// 		LEFT JOIN `vote` v ON c.`cId`=v.`cId`    
//     LEFT JOIN country co ON co.countryId=c.countryId;";

$result = $con->query($sql);
if ($result){
  if ($result->num_rows > 0) {
    $count = 0;
    echo "<table class='table banded' style='font-size:12px' id='list'>
            <thead>
              <th onclick=\"sortTable('list',0)\">
                S/N
                <span class='pl-2 float-right'>
                  <i class='fa fa-sort'></i>
                </span>
              </th>
              <th onclick=\"sortTable('list',1)\">
                Name
                <span class='pl-2 float-right'>
                  <i class='fa fa-sort'></i>
                </span>
              </th>
              <th>Picture</th>
              <th onclick=\"sortTable('list',3)\">
                Country
                <span class='pl-2 float-right'>
                  <i class='fa fa-sort'></i>
                </span>
              </th>
              <th onclick=\"sortTable('list',4)\">
                Vote
                <span class='pl-2 float-right'>
                  <i class='fa fa-sort'></i>
                </span>
              </th>
              <th></th>
            </thead>
            <tbody>";
    while ($row = $result->fetch_assoc()) {
      ++$count;
      echo "<tr>
              <td>".$count."</td>
              <td>".$row['name']."</td>
              <td><img src='../".$row['picture']."' alt='contestant_".$row['cId']."' width='75' height='50' /></td>
              <td>".$row['country']."</td>
              <td>".$row['votes']."</td>
              <td>
                <form method='post' action='viewContestResult.php?cId=".$row['cId']."'>
                  <input type='number' name='txtNoVotes' id='txtNoVotes' required min='1' />
                  <input type='submit' name='btnAddVote' value='Add Votes' class='btn btn-sm btn-primary' />
                </form>
              </td>
            </tr>";
    }
    echo "</tbody>
        </table>";
  }else{
    echo "<div class='alert alert-info fade show'>No record found</div>>";
  }
}else{
  echo "<div class='alert alert-danger fade show'>Error fetching results</div>";
}
?>