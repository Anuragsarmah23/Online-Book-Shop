<?php
	//RADHEY
	session_start();
	$con=mysqli_connect('localhost','root','','brs');
	if(!$con){
		die("CONNECTION NOT FOUND".mysqli_error());
	}
	$id1=$_SESSION["userID"];
	$fn=mysqli_real_escape_string($con,$_POST['fname']);
	$ln=mysqli_real_escape_string($con,$_POST['lname']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$cno=mysqli_real_escape_string($con,$_POST['cno']);
	$address=mysqli_real_escape_string($con,$_POST['address']);
	$pass=mysqli_real_escape_string($con,$_POST['password']);
	$q="update user set fname='$fn', lname='$ln', email='$email', contact='$cno', address='$address', password='$pass' where id='$id1'";
	$q_run=mysqli_query($con,$q);
	if($q_run)
		$dispmsg='true';
	else	
		$dispmsg='error';	
	mysqli_close($con);
	echo json_encode($dispmsg);
?>