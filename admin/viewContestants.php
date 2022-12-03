<?php
require_once("../connect.php");
$page = "View Contestant List";
include_once("header.php");

echo "<h1 class='text-center text-muted my-3'>List of contestants</h1>";

if(isset($_REQUEST['id'])){
  $result = $con->query("SELECT ct.cId,concat(firstName,' ',surname) AS `name`,
    email,phoneNumber,dob,picture,country,`year`
    FROM `contestant` ct
    JOIN country c ON c.countryId=ct.countryId;");
}else{
  $result = $con->query("SELECT ct.cId,concat(firstName,', ',surname) AS `name`,
    email,phoneNumber,dob,picture,country,`year`
    FROM `contestant` ct
    JOIN country c ON c.countryId=ct.countryId;");
}

if ($result) {
  if ($result->num_rows > 0) {
    $count = 0;
    echo "<div id='status'></div>
          <div class='my-4 mx-auto'>
            <div class='form-horizontal'>
              <div class='form-group row'>             
                <label for='searchBy' class='control-label col-xs-2'>Search By</label>
                <div class='col-xs-4'>  
                  <select id='searchBy' name='searchBy' onchange='searchByChanged(this.value)' class='form-control'>
                    <option value='1'>Name</option>
                    <option value='2'>Email</option>
                    <option value='3'>Phone Number</option>
                    <option value='4'>Date of Birth</option>
                    <option value='7'>Country</option>
                    <option value=''>State</option>
                  </select>
                </div>
                <div class='col-xs-6'>
                  <input type='search' oninput=\"searchChanged('list','search')\" id='search' class='form-control' placeholder='enter your search term here'/>
                </div>
              </div>
            </div>
          </div>
          <table class='table banded' style='font-size:12px' id='list'>
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
              <th onclick=\"sortTable('list',2)\">
                Email
                <span class='pl-2 float-right'>
                  <i class='fa fa-sort'></i>
                </span>
              </th>
              <th onclick=\"sortTable('list',3)\">
                Phone Number (WhatsApp)
                <span class='pl-2 float-right'>
                  <i class='fa fa-sort'></i>
                </span>
              </th>
              <th onclick=\"sortTable('list',4)\">
                Date of Birth
                <span class='pl-2 float-right'>
                  <i class='fa fa-sort'></i>
                </span>
              </th>
              <th>Picture</th>
              <th onclick=\"sortTable('list',6)\">
                Country
                <span class='pl-2 float-right'>
                  <i class='fa fa-sort'></i>
                </span>
              </th>
            </thead>
            <tbody>";
    while ($row = $result->fetch_assoc()) {
      ++$count;
      echo "<tr>
              <td>".$count."</td>
              <td>".$row['name']."</td>
              <td>".$row['email']."</td>
              <td>".$row['phoneNumber']."</td>
              <td>".$row['dob']."</td>
              <td><img src='../".$row['picture']."' alt='contestant_".$row['cId']."' width='75' height='50' /></td>
              <td>".$row['country']."</td>             
            </tr>";
    }
    echo "</tbody>
        </table>
        <div class='my-3 btn-group'>
          <button class='btn btn-success' onclick=\"printList('list')\">Print List</button>
          <button class='btn btn-warning' onclick=\"printPhoneNumbers()\">Print Phone Numbers</button>
          <button class='btn btn-danger' onclick=\"showForm()\">Send Bulk Email</button>
        </div>";
  } else {
    echo "<div class='text-center'>No record found</div>";
  }
}else {
  echo "Error: ".$con->error;
}
?>

<div id="form" class="border" style="display: none;">
  <h2 class="text-muted text-center my-4">EMAIL FORM</h2>
  <div class="form-group">
    <label for="txtTitle" class="control-label sr-only">Title</label>
    <input type="text" class="form-control" id="txtTitle" name="txtTitle" placeholder="Title" required/>
  </div>
  <div class="form-group">
    <label for="txtMessage" class="control-label sr-only">Message</label>
    <textarea class="form-control" id="txtMessage" name="txtMessage" rows="10" cols="20" placeholder="Message" required></textarea>
  </div>
  <div>
    <button type="button" onclick="hideForm()" class="btn btn-md btn-success float-right">Send</button>
  </div>
</div>

<?php
echo "<script src='../scripts/tables.js'></script>";
echo "
  <script>
    function printPhoneNumbers(){
      var phoneNumbers = getPhoneNumbers('list',3);
      exportDataAsCSV(phoneNumbers,'phoneNumber','contestantPhoneNumbers');
    }

    var searchBy = 1;
    function searchChanged(tableId,searchId){
      searchTable(tableId,searchBy,searchId);
    }

    function searchByChanged(value){
      searchBy = value;
    }

    function showForm(){
      $('#form').show();
    }

    function hideForm(){
      sendMail();
      $('#form').hide();
    }

    function sendMail(){
      var emails,title,message;
      emails = getEmails('list',2);
      title = $('#txtTitle').val();
      message = $('#txtMessage').val();

      //send email via ajax
      // $('#status').load('sendMail.php',JSON.stringify(emails),function(responseTxt,statusTxt,xhr) {
      //   if (statusTxt == 'success') {
          
      //   }
      // });
      $.post(
        '../admin/sendMail.php',
        {
          emails:JSON.stringify(emails),
          title: title,
          message: message
        },
        function(data,status) {
          $('#status').text(data);
        }
      );

      title = '' ;$('#txtTitle').val('');
      message = ''; $('#txtMessage').val('');
    }
  </script>
";
include_once("footer.php");
?>