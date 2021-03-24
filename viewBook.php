<?php
	if(!$_GET["name"]){
		header("location:index.php");
	}	
	session_start();
	$name=$_GET["name"];
?>
<html>
	<head>
		<title><?php echo $name; ?>|Book Detail</title>
		<link rel="stylesheet" href="css/viewBook.css">
	</head>
	<body>
		<div class="container">
			<div class="nav">
				<div class="nav-logo">
					<a href="index.php"><span>BRS</span></a>
				</div>
			</div>
			<div class="mainContent" style="height:75vh;">
				<div class="content">
					<?php 
						$con=mysqli_connect('localhost','root','','brs');
						if(!$con){
							die("CONNECTION NOT FOUND".mysqli_error());
						}
						$q="select * from book where name='$name'";
						$q_run=mysqli_query($con,$q);
						$row=mysqli_fetch_assoc($q_run);
						$bookID=$row["id"];
						$bookP=$row["price"];
						$q1="select * from transaction where bid='$bookID' and type='sell' limit 1";
						$q1_run=mysqli_query($con,$q1);
						$rows=mysqli_num_rows($q1_run);
						if($rows > 0)
							$amount=$bookP*60/100;	
						else
							$amount=$bookP;			
					?>
					<div class="contentImage">
						<img src="bookImages/<?php echo $row['id']; ?>" height="300" width="300" alt="Harry Potter" style="margin-right:45px;margin-top:50px;">
					</div>
					<div class="detailContent">
						<table style="border-spacing:0 25px;">
							<tr>
								<th class="head">NAME</th>
								<td class="data"><?php echo $row['name']; ?></td>
							</tr>
							<tr class="rowData">
								<th class="head">AUTHOR</th>
								<td class="data"><?php echo $row['author']; ?></td>
							</tr>
							<tr class="rowData">
								<th class="head">ORIGINAL PRICE</th>
								<td class="data">Rs. <?php echo $row['price']; ?></td>
							</tr>
							<tr class="rowData">
								<th class="head">STATUS</th>
								<td class="data"><?php echo $row['status']; ?> To Purchase</td>
							</tr>
							<tr class="rowData">
								<th class="head">DESCRIPTION</th>
								<td class="data"><?php echo $row['description']; ?></td>
							</tr>
						</table>
						<?php
							if($row["quantity"] > 0){
						?>
						<form method="post" action="buyBook.php">
							<input type="hidden" name="bookID" value="<?php echo $row['id']; ?>">
							<input type="hidden" name="bookN" value="<?php echo $row['name']; ?>">
							<input type="hidden" name="bookP" value="<?php echo $row['price']; ?>">
							<input type="hidden" name="bookA" value="<?php echo $amount; ?>">
							<input type="submit" value="BUY" class="btn">
						</form>
						<form method="post" action="addCartParse.php">
							<input type="hidden" name="bookID" value="<?php echo $row['id']; ?>">
							<input type="hidden" name="bookN" value="<?php echo $row['name']; ?>">
							<input type="hidden" name="bookP" value="<?php echo $row['price']; ?>">
							<input type="hidden" name="bookA" value="<?php echo $amount; ?>">
							<select name="cartQty" style="background:transparent;font-size:16px;border:none;outline:none;border-bottom:2px solid blue;">
								<option value="" disabled selected>Select quantity to be added to cart</option>
								<?php for($i=1;$i<=$row['quantity'];$i++){ ?>
										<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php } ?>
							</select><br><br>
							<input type="submit" value="ADD TO CART" class="btn">
						</form>
						<?php
							}else{
								echo '<p style="font-size:20px;">Currently Out Of Stock</p>';
							}
						?>
					</div>
				</div>
			</div>
			<div class="footer">
				Copyright &copy; 2018 BRS
			</div>
		</div>
	</body>
</html>