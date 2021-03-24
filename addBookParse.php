<?php
	$fname=basename($_FILES["fname"]["name"]);
	$target_dir = "bookImages/";
	$target_file = $target_dir.$fname;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	$erroR=1;
	if ($_FILES["fname"]["size"] > 524288){
		$dispmsg="fileSize";
		$erroR=0;
	}	
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"){ 
		$dispmsg="fileType";
		$erroR=0;
	}	
	if($erroR==1){
		$con=mysqli_connect('localhost','root','','brs');
		if(!$con){
			die("CONNECTION NOT FOUND".mysqli_error());
		}
		$bname=mysqli_real_escape_string($con,$_POST['bname']);
		$author=mysqli_real_escape_string($con,$_POST['author']);
		$desc=mysqli_real_escape_string($con,$_POST['desc']);
		$price=mysqli_real_escape_string($con,$_POST['price']);
		$qty=mysqli_real_escape_string($con,$_POST['qty']);
		$no=rand(1000,9999);
		$id=$bname.$no;
		$fileName=$id.".".$imageFileType;
		$targetDir=$target_dir.$fileName;
		if($qty <= 0)
			$dispmsg="qtyError";
		else{
			$q1="select * from book where name='$bname'";
			$q1_run=mysqli_query($con,$q1);
			$rows=mysqli_num_rows($q1_run);
			if($rows > 0)
				$dispmsg="bookExist";
			else{	
				if (move_uploaded_file($_FILES["fname"]["tmp_name"], $targetDir)){
					$q="insert into book values('$fileName','$bname','$author','$desc','$price','available','$qty')";
					$q_run=mysqli_query($con,$q);
					if($q_run)
						$dispmsg='true';
					else	
						$dispmsg='error';
				}	
				else 
					$dispmsg="fileUploadError";
			}
		}
		mysqli_close($con);
	}
	echo json_encode($dispmsg);
?>