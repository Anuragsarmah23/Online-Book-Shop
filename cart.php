<?php
	session_start();
	$userID=$_SESSION["userID"];
?>
<html>
	<head>
		<title>BRS|Cart</title>
		<link rel="stylesheet" href="css/viewBook.css">
	</head>
	<body>
		<div class="container">
			<div class="nav">
				<div class="nav-logo">
					<a href="index.php"><span>BRS</span></a>
				</div>
			</div>
			<div class="mainContent" style="height:75vh;overflow:auto;">
				<div class="content">
					<?php 
						$con=mysqli_connect('localhost','root','','brs');
						if(!$con){
							die("CONNECTION NOT FOUND".mysqli_error());
						}
						$q="select * from cart where UID='$userID'";
						$q_run=mysqli_query($con,$q);	
						$rowsC=mysqli_num_rows($q_run);
					?>
					<div>
						<img src="bookImages/cart.png" height="50" width="50" alt="Cart" style="float:left;margin-right:45px;">
						<p style="float:right;font-size:20px;color:1122ee;">ITEMS IN CART</p>
					</div>
					<div style="padding-top:60px;">
					<?php if($rowsC > 0){ ?>
						<table style="border-spacing:35px 25px;">
							<tr>
								<th class="head">SL.NO.</th>
								<th class="head">Book Name</th>
								<th class="head">Quantity</th>
								<th class="head">Base Amount</th>
								<th class="head">Total Amount</th>
								<th class="head">Remove From Cart</th>
							</tr>
							<?php 
									$i=0;
									$totalAmount=0;
									while($row=mysqli_fetch_assoc($q_run)){ 
									$i++;
									$cid=$row["id"];
									$bookID=$row["bookID"];
									$q2="select * from book where id='$bookID'";
									$q2_run=mysqli_query($con,$q2);
									$row2=mysqli_fetch_assoc($q2_run);						
							?>
								
							<tr class="rowData">
								<td class="data"><?php echo $i; ?></td>
								<td class="data"><?php echo $row2['name']; ?></td>
								<td class="data"><?php echo $row['cartQty']; ?></td>
								<td class="data"><?php echo $row['BaseAmount']; ?></td>
								<td class="data"><?php echo $row['TotalAmount']; ?></td>
								<td class="data"><a style="text-decoration:none;color:red;background:#22ffcb;padding:5px;" href="removeCartItem.php?id=<?php echo $cid; ?>">Remove</a></td>
							</tr>
							<?php 
								$totalAmount=$totalAmount+$row['TotalAmount'];
								} 
							?>
						</table>
						<p style="padding-left:35px;">Total Amount To Be Paid: <b>Rs. <?php echo $totalAmount; ?></b> </p>
						<form method="post" action="buyCartParse.php" style="padding-left:35px;">
							<input type="hidden" name="bookID" value="<?php echo $row['id']; ?>">
							<input type="hidden" name="bookN" value="<?php echo $row['name']; ?>">
							<input type="hidden" name="bookP" value="<?php echo $row['price']; ?>">
							<input type="hidden" name="bookA" value="<?php echo $amount; ?>">
							<input type="submit" value="BUY" class="btn"><br><br><br>
							<a href="main.php" style="text-decoration:none;font-size:20px;">Add More Books</a>
						</form>
						<?php }else{ ?>
							<center><p style="font-size:25px;"><b>Nothing added to cart</b></p>
							<a href="main.php" style="text-decoration:none;font-size:20px;">Buy Books</a></center>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="footer">
				Copyright &copy; 2018 BRS
			</div>
		</div>
	</body>
</html>