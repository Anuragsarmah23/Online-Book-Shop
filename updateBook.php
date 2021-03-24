<?php
	//RADHEY
	session_start();
	$con=mysqli_connect('localhost','root','','brs');
	if(!$con){
		die("CONNECTION NOT FOUND".mysqli_error());
	}
	$id1=$_SESSION["id"];
	$bname=mysqli_real_escape_string($con,$_POST['bname']);
	$author=mysqli_real_escape_string($con,$_POST['author']);
	$price=mysqli_real_escape_string($con,$_POST['price']);
	$desc=mysqli_real_escape_string($con,$_POST['desc']);
	$qty=mysqli_real_escape_string($con,$_POST['qty']);
	if($qty == 0){
		$q1="update book set status='not available' where id='$id1'";
		$q1_run=mysqli_query($con,$q1);
	}
	else if($qty > 0){
		$q2="update book set status='available' where id='$id1'";
		$q2_run=mysqli_query($con,$q2);
	}	
	$q="update book set name='$bname', author='$author', description='$desc', price='$price', quantity='$qty' where id='$id1'";
	$q_run=mysqli_query($con,$q);
	if($q_run)
		$dispmsg='true';
	else	
		$dispmsg='error';	
	mysqli_close($con);
	echo json_encode($dispmsg);
?>