<?php
	session_start();
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
			if($rows > 0){
				$row2=mysqli_fetch_assoc($q1_run);
				$Quantity=$row2["quantity"];
				$bookID=$row2["id"];
				$Nquantity=$Quantity+1;
				$q2="update book set quantity='$Nquantity' where id='$bookID'";
				$q2_run=mysqli_query($con,$q2);
				if($q2_run){
					if($row2["status"] == "not available"){
						$q3="update book set status='available' where id='$bookID'";
						$q3_run=mysqli_query($con,$q3);
					}
					$no1=rand(100,999);
					$uid=$_SESSION["userID"];
					$tid=$uid.$no1;
					$amount=$row2["price"]*60/100;
					$q6="insert into transaction(id,uid,bid,type,Amount,status) values('$tid','$uid','$bookID','sell','$amount','pending')";
					$q6_run=mysqli_query($con,$q6);
					if($q6_run)
						$dispmsg=$tid;
					else
						$dispmsg='error';
				}
				else
					$dispmsg='error';
			}	
			else{	
				if (move_uploaded_file($_FILES["fname"]["tmp_name"], $targetDir)){
					$q="insert into book values('$fileName','$bname','$author','$desc','$price','available','$qty')";
					$q_run=mysqli_query($con,$q);
					if($q_run){
						$no1=rand(100,999);
						$uid=$_SESSION["userID"];
						$tid=$uid.$no1;
						$amount=$price*60/100;
						$q5="insert into transaction(id,uid,bid,type,Amount,status) values('$tid','$uid','$fileName','sell','$amount','pending')";
						$q5_run=mysqli_query($con,$q5);
						if($q5_run)
							$dispmsg=$tid;
						else
							$dispmsg='error';	
					}	
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