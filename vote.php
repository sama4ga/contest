<?php
$page = "Vote";
require_once("connect.php");
include_once("header.php");

if (isset($_REQUEST['i'])) {
	$id = $_REQUEST['i'];
  $cId = intval(base64_decode($id,true));
	$sql = "SELECT c.`cId`,concat(`surname`,', ',`firstName`) as 'name',`picture`,sum(`vote`) as 'votes' 
		FROM `contestant` c 
		LEFT JOIN `vote` v ON c.`cId`=v.`cId` 
		WHERE c.`cId`=$cId;";
}else{
  $sql = "SELECT c.`cId`,concat(`surname`,', ',`firstName`) as 'name',`picture`,sum(`vote`) as 'votes' 
		FROM `contestant` c 
		LEFT JOIN `vote` v ON c.`cId`=v.`cId`
		WHERE `status`='Complete'
		GROUP BY c.`cId`
		ORDER BY `votes` DESC ;";
}
$result = $con->query($sql);
if($result){
	if($result->num_rows == 1){
		$row = $result->fetch_assoc();
		$cId = $row['cId'];
		$id = base64_encode($cId); $n = base64_encode($row['name']);
		//$link = "https://www.missglobalafrica.org/vote.php?n=$n&i=".$id;
		$link = "vote.php?n=$n&i=".$id;
echo "<div class='container-fluid mt-4 mb-4'>
			<div class='w-50 card mx-auto'>
				<div class='card-img'>
					<img src='".$row['picture']."' class='circle' width='100%' height='300' />
				</div>
				<div class='card-body text-center'>
					<div class='text-muted text-xx-large'><strong>".$row['name']."</strong></div>
					<div>Votes : ".$row['votes']."</div>
					<div>Share this voting link <br /><a href='$link' class='text-primary'>https://www.missglobalafrica.org/$link</a></div>
				</div>
				<div class='card-footer'>
					<button type='button' class='btn btn-outline-success text-center w-100' data-id='$id'>Vote</button>
				</div>
			</div>
		</div>";
	}elseif ($result->num_rows > 0){
		echo "<div class='container-fluid row mt-4 mb-4'>";
		while($row = $result->fetch_assoc()){
			$cId = $row['cId'];
			$id = base64_encode($cId); $n = base64_encode($row['name']);
			//$link = "https://www.missglobalafrica.org/vote.php?n=$n&i=".$id;
			$link = "vote.php?n=$n&i=".$id;
echo "
			<div class='col-md-3 card mx-3'>
				<div class='card-img'>
					<img src='".$row['picture']."' class='rounded-circle' width='100%' height='300' />
				</div>
				<div class='card-body text-center'>
					<div class='text-muted'><strong>".$row['name']."</strong></div>
					<div>Votes : ".$row['votes']."</div>
					<div><small>Share this voting link <br /><a href='$link' class='text-primary'>https://www.missglobalafrica.com.ng/$link</a></small></div>
				</div>
				<div class='card-footer'>
					<button type='button' class='btn btn-outline-success text-center w-100' data-id='$id' data-name='$n'>Vote</button>
				</div>
			</div>
			";
		}
		echo "</div>";
		
		
	}else{
		echo "<div class='alert alert-info'>No contestant found</div>";
	}
}else{
	echo "<div class='alert alert-danger'>Error occured while getting contestant detail </div>".$con->error;
}

include_once("footer.php");
?>

<div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="payModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title">Supply Email</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
			<form method="POST" action="paymentInit.php">
				<div class="modal-body">
					<div class="form-group">
						<input type='hidden' name='i' id='i' />
						<input type='hidden' name='n' id='n' />
						<label for="txtEmail">Email</label>
						<input type="email" name="txtEmail" id="txtEmail" placeholder="email" aria-label="txtEmailHelp" class="form-control" required="required"/>
						<small class="help-text" id="txtEmailHelp">We will use the email to send you a notification on the state of your payment</small>
					</div>
					<div class="form-group">
						<label for="txtEmail">Numbe of Votes</label>
						<input type="number" name="txtNoVotes" id="txtNoVotes" placeholder="number of votes" aria-label="txtNoVotesHelp" class="form-control" required="required" min="1"/>
						<small class="help-text" id="txtNoVotesHelp">Each vote cost <span style="text-decoration: line-through double;">N</span>100</small>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group">
						<input type="submit" name="btnPay" id="btnPay" value="Proceed to payment" class="btn btn-success"/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!--<script src="https://js.paystack.co/v1/inline.js"></script>-->
<script>
	$("button").on("click",function(){
		var i = $(this).data("id");
		var n = $(this).data("name");
		$("#i").val(i);
		$("#n").val(n);
		$("#payModal").modal();
	});

	switchMenuItem(4);
</script>