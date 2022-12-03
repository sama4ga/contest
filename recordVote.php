<?php
session_start();
$page = "Vote";
require_once("connect.php");
include_once("header.php");

if(isset($_REQUEST['i'])){ //var_dump($_SESSION);
	// var_dump($_REQUEST);
	$i = $_REQUEST['i'];
	$n = $_REQUEST['n'];
	$e = $_REQUEST['e'];
	$v = $_REQUEST['v'];
	$t = $_REQUEST['t'];
	$cId = intval(base64_decode($i,true));
	$cName = (base64_decode($n,true));
	

	// check that the transaction reference is unique
	$result = $con->query("SELECT *  FROM `vote` WHERE `tnxRef`='$t';");
	if ($result && $result->num_rows == 0) {
		$sql = "INSERT INTO `vote`(`cId`,`voterEmail`, `tnxRef`,`vote`) VALUES($cId,'$e','$t',$v);";
		$result = $con->query($sql);
		//var_dump($result);echo $cId;echo $sql;
		if($result){
			echo "<div class='container-fluid'>";
			echo "<div class='alert alert-success fade show'>$v vote(s) successfully cast</div>";
			$to = $e;
			$subject = "Vote casting successful";
			$body = "Hello Voter,<p>This is to thank you for voting in the Miss Global Africa contest.</p>
			<p>Your $v vote(s) was/were successfully cast for <b>$cName</b> with voting link <a href='https://www.missglobalafrica.org/vote.php?n=$n&i=$i'>https://www.missglobalafrica.org/vote.php?n=$n&i=$i</a></p>
			<p>Feel free to copy and share the link above on social media links for more people to vote</p>
			<p></p><p>Prime Walker Entertainment</p>";
			include("admin/sendMail.php");
			if(SendSingleEmail($to,$subject,$body,$altBody="",$recipientName="",$from="",$senderName="",$replyTo="",$cc="",$bcc="",$attachment="")){
				echo "<div class='alert alert-success fade show'>An email has been sent to your mail at $to</div>";
			}
	//		echo "success";
		}else{
			echo "<div class='alert alert-danger fade show'>Error occured while casting vote</div>";
	//		echo "error";
		}		
	}
	echo "<div class='my-4'><a href='vote.php'>Go back...</a></div>";
		echo "</div>";
}

unset($_SESSION['n']);
unset($_SESSION['i']);
unset($_SESSION['e']);
include_once("footer.php");
?>