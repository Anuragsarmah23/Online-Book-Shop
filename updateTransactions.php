<?php
	//RADHEY
	session_start();
	$con=mysqli_connect('localhost','root','','brs');
	if(!$con){
		die("CONNECTION NOT FOUND".mysqli_error());
	}
	$tid=$_SESSION["TID"];
	$status=mysqli_real_escape_string($con,$_POST['status']);
	$q="update transaction set status='$status' where id='$tid'";
	$q_run=mysqli_query($con,$q);
	if($q_run)
		$dispmsg='true';
	else	
		$dispmsg='error';	
	mysqli_close($con);
	echo json_encode($dispmsg);
?>