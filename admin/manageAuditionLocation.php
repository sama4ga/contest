<?php
require_once("../connect.php");
include_once("header.php");

if (isset($_POST['btnEdit'])) {
  $loc = $_POST['txtLoc'];
  $locId = $_POST['txtLocId'];

  $result = $con->query("UPDATE `auditionLocation` SET `location`='$loc' WHERE `locationId`=$locId;");
  if ($result) {
    echo "<div class='success'>Edit successful</div>";
  }else{
    echo "<div class='error'>Error while editing</div>".$con->error;
  }
}


if (isset($_POST['btnAdd'])) {
  $loc = mysqli_real_escape_string($con,$_POST['txtLocation']);

  $result = $con->query("INSERT INTO `auditionLocation`(`location`) VALUES('$loc');");
  if ($result) {
    echo "<div class='success'>$loc successfully added</div>";
  }else{
    echo "<div class='error'>Error while adding $loc</div>".$con->error;
  }
}


if (isset($_POST['btnDelete'])) {
  $loc = $_POST['txtLoc'];
  $locId = $_POST['txtLocId'];
  $result = $con->query("DELETE FROM `auditionLocation` WHERE `locationId`=$locId;");
  if ($result) {
    echo "<div class='success'>$loc successfully removed</div>";
  }else{
    echo "<div class='error'>Error while removing $loc</div>".$con->error;
  }
}

echo "<h2 class='text-center text-muted my-3'>Audition Locations</h2>";
$result = $con->query("SELECT `locationId`,`location` FROM `auditionLocation`;");
if ($result) {
  if ($result->num_rows > 0) {
    $count = 0;
    echo "<table class='table banded center' style='font-size:14px;max-width:500px;padding: 0 20px 0 40px;' id='list'>
            <thead>
              <th>S/N</th>
              <th>Location</th>
              <th>Action</th>
            </thead>
            <tbody>";
    while ($row = $result->fetch_assoc()) {
      ++$count;
      $loc = $row['location'];
      $locId = $row['locationId'];
      echo "<tr>
              <td>".$count."</td>
              <td>".$loc."</td>
              <td>
                <a href=\"javascript: editLoc('$loc',$locId);\" class='btn btn-sm btn-success'>Edit</a>
                <form action='' method='post' style='display:inline;' onsubmit=\"return confirmAction('delete','$loc from the list of audition locations')\">
                  <input type='hidden' name='txtLoc' value='$loc' />
                  <input type='hidden' name='txtLocId' value='$locId' />
                  <input type='submit' name='btnDelete' class='btn btn-sm btn-danger' value='Delete'/>
                </form>
              </td>
            </tr>";
    }
    echo "</tbody>
          </table>
          <div class='my-3'>
            <button class='btn btn-lg btn-success' onclick=\"printList('list')\">Print List</button>
            <button class='btn btn-lg btn-success' onclick='addLocation()'>Add Audition Location</button>
          </div>";
  }else{
    echo "<div>No record found</div>";
  }
}else{
  echo "<div class='error'>Error fetching record: </div>".$con->error;
}
?>

<!--<div class="modal fade" id="bsModal" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" id="close">&times;</button>
        <h4 class="title">Edit Audition Location Form</h4>
      </div>
      <div class="modal-body" style="background-color: white;">
        <form method="POST">
          <div>
            <input type="text" name="txtLoc" id="txtLoc" />
            <input type="hidden" name="txtLocId" id="txtLocId" />
          </div>
        </form>
      </div>  
      <div class="modal-footer" style="background-color: green;display: flex;">
        <input type="submit" name="btnEdit" id="btnEdit" value="Edit" class="btn btn-success form-control"/>
        <input type="submit" name="btnCancel" id="btCancel" value="Cancel" class="btn btn-warning form-control"/>
      </div>
    </div>
  </div>
</div>-->

<div id="editLocForm" style="display:none;">
  <div class="mymodal-content">
    <h4 class="title text-center text-muted" style="margin-top:20px;">Edit Audition Location Form</h4>
    <form method="POST" action='' id='frmEditLoc'>
      <div style="padding:20px 10px;margin:auto;width:80%;">
        <input type="text" name="txtLoc" id="txtLoc" style="padding:10px;outline:none;border:3px solid rgba(0,0,0,0.2);border-radius:30px;" />
        <input type="hidden" name="txtLocId" id="txtLocId" />
      </div>
    </form>  
    <div class="mymodal-footer" style="background-color: green;display: flex;">
      <input type="submit" form='frmEditLoc' name="btnEdit" id="btnEdit" value="Edit" class="btn btn-success form-control" onclick='closeEditForm();'/>
      <input type="reset" form='frmEditLoc' name="btnCancel" id="btnCancel" value="Cancel" class="btn btn-warning form-control" onclick='closeEditForm();'/>
    </div>
  </div>
</div>

<div id="addLocForm" style="display:none;">
  <div class="mymodal-content">
    <h4 class="title text-center text-muted" style="margin-top:20px;">Add Audition Location Form</h4>
    <form method="POST" action='' id='frmAddLoc'>
      <div style="padding:20px 10px;margin:auto;width:80%;">
        <input type="text" name="txtLocation" id="txtLocation" placeholder="Enter location E.g Uyo" style="padding:10px;outline:none;border:3px solid rgba(0,0,0,0.2);border-radius:30px;" />
      </div>
    </form>  
    <div class="mymodal-footer" style="background-color: green;display: flex;">
      <input type="submit" form='frmAddLoc' name="btnAdd" id="btnAdd" value="Add" class="btn btn-success form-control" onclick='closeAddForm();'/>
      <input type="reset" form='frmAddLoc' value="Cancel" class="btn btn-warning form-control" onclick='closeAddForm();'/>
    </div>
  </div>
</div>

<script>
  var editForm = document.getElementById("editLocForm");
  var addForm = document.getElementById("addLocForm");

  function editLoc(loc,locId) {
    editForm.style.display = "block";
    document.getElementById("txtLoc").value = loc;
    document.getElementById("txtLocId").value = locId;
  }

  function addLocation() {
    addForm.style.display = "block";
    document.getElementById("txtLocation").value = "";
  }

  function closeEditForm(){
    editForm.style.display = "none";
  }

  function closeAddForm(){
    addForm.style.display = "none";
  }

  // var close = document.getElementById('close');
  // close.onclick = function () {
  //   modal.style.display = "none";
  // }
  // window.onclick = function (event) {
  //   if (event.target == modal) {
  //     modal.style.display = "none";
  //   }
  // }

</script>

<?php
include_once("footer.php");
?>