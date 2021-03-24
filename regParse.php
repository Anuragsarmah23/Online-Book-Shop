<?php
	//RADHEY
	$con=mysqli_connect('localhost','root','','brs');
	if(!$con){
		die("CONNECTION NOT FOUND".mysqli_error());
	}
	$fn=mysqli_real_escape_string($con,$_POST['fname']);
	$ln=mysqli_real_escape_string($con,$_POST['lname']);
	$email=mysqli_real_escape_string($con,$_POST['email']);
	$cno=mysqli_real_escape_string($con,$_POST['cno']);
	$address=mysqli_real_escape_string($con,$_POST['address']);
	$pass=mysqli_real_escape_string($con,$_POST['password']);
	$cnfpass=mysqli_real_escape_string($con,$_POST['cnfpass']);
	$idR=rand(1000,9999);
	$id=$fn.$idR;
	if($pass==$cnfpass){
		$q="select * from user WHERE email='$email'";
		$q_run=mysqli_query($con,$q);
		if(mysqli_num_rows($q_run)>0)
			$dispmsg='emailError';
		else{
			$q="insert into user values('$id','$fn','$ln','$email','$cno','$address','$pass')";
			$q_run=mysqli_query($con,$q);
			if($q_run)
				$dispmsg=$id;	
			else	
				$dispmsg='error';
		}	
	}else
		$dispmsg='passError';
	mysqli_close($con);
	echo json_encode($dispmsg);
?>