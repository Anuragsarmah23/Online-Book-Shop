<?php
	//RADHEY
	session_start();
	$con=mysqli_connect('localhost','root','','brs');
	if(!$con){
		die("CONNECTION NOT FOUND".mysqli_error());
	}
	$id=$_GET["id"];
	$q="delete from book where id='$id'";
	$q_run=mysqli_query($con,$q);
	if($q_run)
		header("location:bookList.php");
	else	
		echo '<script>alert("Something went wrong.. Please try again..")</script>';	
	mysqli_close($con);
?>