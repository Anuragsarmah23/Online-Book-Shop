<?php
	session_start();
	$con=mysqli_connect('localhost','root','','brs');
	if(!$con){
		die("CONNECTION NOT FOUND".mysqli_error());
	}
	$uid=$_SESSION["userID"];
	$q5="select * from cart where UID='$uid'";
	$q5_run=mysqli_query($con,$q5);
	$id='';
	$totalA=0;
	$no=rand(100,999);
	$tid=$uid.$no;
	while($row5=mysqli_fetch_assoc($q5_run)){	
		$cid=$row5["id"];
		$bid=$row5["bookID"];
		$totalAmount=$row5["TotalAmount"];
		$q="insert into transaction(id,uid,bid,type,Amount,status) values('$tid','$uid','$bid','buy','$totalAmount','pending')";
		$q_run=mysqli_query($con,$q);
		if($q_run){	
			$qty=$row5["cartQty"];
			$totalA=$totalA+$row5["TotalAmount"];
			$q2="select * from book where id='$bid'";
			$q2_run=mysqli_query($con,$q2);
			$row2=mysqli_fetch_assoc($q2_run);
			$quantity=$row2["quantity"];
			$Nquantity=$quantity-$qty;
			$q3="update book set quantity='$Nquantity' where id='$bid'";
			$q3_run=mysqli_query($con,$q3);
			if($Nquantity == 0){
				$q4="update book set status='not available' where id='$bid'";
				$q4_run=mysqli_query($con,$q4);
			}
			$q6="delete from cart where id='$cid'";
			$q6_run=mysqli_query($con,$q6);
			
		}else{
			echo '<script>alert("Something went wrong..Please try again..");</script>';
			echo '<script>
					setTimeout(function (){
						location.href="cart.php";
					});
				  </script>';
			die();
		}
	
	}	
?>		
<script>var tid="<?php echo $tid; ?>";</script>
<script>var amount="<?php echo $totalA; ?>";</script>
<script>alert("Book Order Confirmed with transaction ID: "+tid+"\n with total amount: "+amount)</script>';
<script>
	setTimeout(function (){
		location.href="transHistory.php?id="+tid;
	});
</script>
