<?php
	session_start();
?>
<html>
<head>
	<title>BRS|EDIT BOOK</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/form.css" rel='stylesheet' type='text/css' />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	
</head>	

<body>
	<?php
		$con=mysqli_connect('localhost','root','','brs');
		if(!$con)
 			die("CONNECTION NOT FOUND".mysqli_error());
		$id=$_GET["id"];
		$_SESSION["id"]=$id;
		$q="select * from book where id='$id'";
		$q_run=mysqli_query($con,$q);
		$row=mysqli_fetch_assoc($q_run);
	?>
	<div class="main">
		<div class="formMain">
			<div class="regFormElements">
				<div class="card-header">
					Update Book Info
					<hr>
				</div>
				<form method="post" class="regForm" id="validateIt" action="updateBookUser.php">
					<div class="row">
					  <div class="form-group col-md-6">
						<label for="bname" class="labelElements">Name</label>
						<input type="text" name="bname" data-rule-required="true" data-msg-required="Please Enter Book Name" class="form-control" id="bname" placeholder="Enter Book Name" value="<?php echo $row['name']; ?>">
					  </div>
					  <div class="form-group col-md-6">
						<label for="author" class="labelElements">Author</label>
						<input type="text" name="author" data-rule-required="true" data-msg-required="Please Enter Author Name" class="form-control" id="author" placeholder="Enter Author Name" value="<?php echo $row['author']; ?>">
					  </div>
					</div>
					<div class="row">
					  <div class="form-group col-md-6">
						<label for="price" class="labelElements">Price(Rs.)</label>
						<input type="text" name="price" data-rule-numbersonly="true" data-rule-numbersonly="Add the amount in numbers" data-rule-required="true" data-msg-required="Please Enter Book Price" class="form-control" id="price" placeholder="Enter Price" value="<?php echo $row['price']; ?>">
					  </div>
					  <div class="form-group col-md-6">
						<label for="cno" class="labelElements">Description</label>
						<textarea name="desc" data-rule-required="true" data-msg-required="Please Enter Your Contact Number" class="form-control" id="cno" placeholder="Add some description"><?php echo $row['description']; ?></textarea>
					  </div>
					</div>  
					<div class="row">
						<div class="form-group col-md-6">
							<label for="qty" class="labelElements">Quantity</label>
							<input type="number" name="qty" data-rule-required="true" data-msg-required="Please Enter Quantity" class="form-control" id="qty" placeholder="Enter Quantity" value="<?php echo $row['quantity']; ?>">
							<button type="submit" class="btn sub2 col-md-6">Update</button>
						</div>  
					</div>  
					 <br><br>
				  <div id="cnfmsg">Success</div>
				  <div id="errormsg">Something went wrong...Please try again</div>  
				</form>
			</div>
		</div>
	</div>
	<div class="test"></div>

	<script>
		jQuery.validator.addMethod("numbersonly", function(value, element) {
			return this.optional(element) || /^[0-9]+$/i.test(value);
		}, "Enter Number");
	</script>
		
	<script>
		$('#validateIt').validate();
	</script>
		
	<script>
			$(document).ready(function() {
				$('.regForm').submit(function() {	
					var datastr=$(".regForm").serialize();
					$.ajax({
						type: "POST",
						url: "updateBookUser.php",
						data: datastr,
						dataType: "json",
						encoded: "true",
						success: function(msg) {
							if (msg == 'true') {
								$("#cnfmsg").addClass("show");
								$("#errormsg").removeClass("show");
								setTimeout(function () {
									location.href="bookList.php"; 
								}, 1000);
							}
							else {
								$("#cnfmsg").removeClass("show");
								$("#errormsg").addClass("show");
								setTimeout(function () {
									location.reload(true); 
								}, 1000);
							}
						}
					});
					return false;
				
				});
			});
	</script>		
	
</body>

</html>