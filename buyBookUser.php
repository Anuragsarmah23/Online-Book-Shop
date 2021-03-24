<?php
	session_start();
	$name=$_SESSION["bookName"];
	$ID=$_SESSION["bookID"];
	$amount=$_SESSION["amount"];
?>
<html>
	<head>
		<title><?php echo $name; ?>|Buy Book</title>
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
								<th class="head">PRICE</th>
								<td class="data">Rs. <?php echo $amount; ?></td>
							</tr>
							<tr class="rowData">
								<th class="head">STATUS</th>
								<td class="data"><?php echo $row['status']; ?> To Purchase</td>
							</tr>
							<tr class="rowData">
								<th class="head">DESCRIPTION</th>
								<td class="data"><?php echo $row['description']; ?></td>
							</tr>
							<tr class="rowData">
								<th class="head">Quantity Available</th>
								<td class="data"><?php echo $row['quantity']; ?></td>
							</tr>
						</table>
						<?php
							if($row["quantity"] > 0){
						?>
						<form method="post" action="buyBookParse.php">
							<input type="hidden" name="bookID" value="<?php echo $row['id']; ?>">
							<input type="hidden" name="bookN" value="<?php echo $row['name']; ?>">
							<input type="hidden" name="bookP" value="<?php echo $row['price']; ?>">
							<input type="hidden" name="bookA" value="<?php echo $amount; ?>">
							<select name="quantity" style="background:transparent;font-size:16px;border:none;outline:none;border-bottom:2px solid blue;">
								<option vlaue="" disabled selected>Select Quantity You Need To Purchase</option>
								<?php
									for($i=1;$i<=$row['quantity'];$i++){
								?>
								<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
								<?php }  ?>
							</select><br><br>
							<input type="submit" value="BUY" class="btn"><br><br><br>
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