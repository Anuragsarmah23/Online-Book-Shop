<?php
	session_start();
	if(!isset($_SESSION["userID"])){
		echo '<script>alert("Login is required to purchase or sell book")</script>';
		echo '<script>setTimeout(function (){location.href="login.php";});</script>';
		die();
	}	
	$con=mysqli_connect('localhost','root','','brs');
	if(!$con){
		die("CONNECTION NOT FOUND".mysqli_error());
	}
	$bid=$_POST["bookID"];
	$uid=$_SESSION["userID"];
	$bookA=$_POST["bookA"];
	$cQty=$_POST["cartQty"];
	$totalA=$bookA*$cQty;
	$q="insert into cart(bookID,UID,cartQty,BaseAmount,TotalAmount) values('$bid','$uid','$cQty','$bookA','$totalA')";
	$q_run=mysqli_query($con,$q);
	if($q_run){
		echo '<script>alert("Book added to cart")</script>';
		echo '<script>setTimeout(function (){location.href="cart.php";});</script>';
	}	
	else
		echo '<script>alert("Something went wrong..please try again..")</script>';