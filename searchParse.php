<?php
	$con=mysqli_connect('localhost','root','','brs');
	if(!$con)
 			die("CONNECTION NOT FOUND".mysqli_error());
	$name=$_POST["search"];
	$q="select * from book where name like '$name%'";
	$q_run=mysqli_query($con,$q);
	if(mysqli_num_rows($q_run)>0){
		while($row=mysqli_fetch_assoc($q_run)){
			$data[]=array($row["name"],$row["author"],$row["description"],$row["price"],$row["status"]);
		}
	}
	else{
		$author=$_POST["search"];
		$q="select * from book where author like '$author%'";
		$q_run=mysqli_query($con,$q);
		if(mysqli_num_rows($q_run)>0)
			while($row=mysqli_fetch_assoc($q_run)){
			$data[]=array($row["name"],$row["author"],$row["description"],$row["price"],$row["status"]);
		}
		else
			$data="false";
	}
	echo json_encode($data);
?>