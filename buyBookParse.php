<?php
	session_start();
	$con=mysqli_connect('localhost','root','','brs');
	if(!$con){
		die("CONNECTION NOT FOUND".mysqli_error());
	}
	$uid=$_SESSION["userID"];
	$bid=$_SESSION["bookID"];
	$amount=$_SESSION["amount"];
	$bname=$_SESSION["bookName"];
	$qty=$_POST["quantity"];
	$totalAmount=$amount*$qty;
	$no=rand(100,999);
	$tid=$uid.$no;
	$q="insert into transaction(id,uid,bid,type,Amount,status) values('$tid','$uid','$bid','buy','$totalAmount','pending')";
	$q_run=mysqli_query($con,$q);
	if($q_run){
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
?>		<script>var tid="<?php echo $tid; ?>";</script>
		<script>var amount="<?php echo $totalAmount; ?>";</script>
		<script>alert("Book Order Confirmed with transaction ID: "+tid+"\n with total amount: "+amount)</script>';
		<script>
			setTimeout(function (){
				location.href="transHistory.php?id="+tid;
			});
		</script>
<?php	
	}	
	else{
?>		
		<script>var bname="<?php echo $bname ;?>";</script>
		<script>alert("Something went wrong..Please try again..");</script>
		<script>
			setTimeout(function (){
				location.href="viewBook.php?name="+bname;
			});
		</script>
<?php		
	}	
?>	