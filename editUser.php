<?php
	session_start();
?>
<html>
<head>
	<title>BRS|EDIT USER</title>
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
		$_SESSION["userID"]=$id;
		$q="select * from user where id='$id'";
		$q_run=mysqli_query($con,$q);
		$row=mysqli_fetch_assoc($q_run);
	?>
	<div class="main">
		<div class="formMain">
			<div class="regFormElements">
				<div class="card-header">
					Edit Profile
					<hr>
				</div>
				<form method="post" class="regForm" id="validateIt" action="updateUser.php">
				<div class="row">
					  <div class="form-group col-md-6">
						<label for="id" class="labelElements">ID</label>
						<input type="text" style="background:transparent;" name="id" class="form-control" id="id" readonly value="<?php echo $row["id"]; ?>">
					  </div>
					  <div class="form-group col-md-6">
						<label for="fname" class="labelElements">Enter Your First Name</label>
						<input type="text" name="fname" data-rule-lettersonly="true" data-msg-lettersonly="Name should not include numbers or spaces" data-rule-required="true" data-msg-required="Please Enter Your First Name" class="form-control" id="fname" placeholder="Enter First Name" value="<?php echo $row['fname']; ?>">
					  </div>
				</div>	  
				<div class="row">	  
					  <div class="form-group col-md-6">
						<label for="lname" class="labelElements">Enter Your Last Name</label>
						<input type="text" name="lname" data-rule-lettersonly="true" data-msg-lettersonly="Name should not include numbers or spaces" data-rule-required="true" data-msg-required="Please Enter Your Last Name" class="form-control" id="lname" placeholder="Enter Last Name" value="<?php echo $row['lname']; ?>">
					  </div>
					  <div class="form-group col-md-6">
						<label for="email" class="labelElements">Enter Your Email ID</label>
						<input type="email" name="email" data-rule-email="true" data-msg-email="Please enter a valid email address" data-rule-required="true" data-msg-required="Please Enter Your Email ID" class="form-control" id="email" placeholder="Enter Email ID" value="<?php echo $row['email']; ?>">
					  </div>
				</div>
				<div class="row">
					  <div class="form-group col-md-6">
						<label for="cno" class="labelElements">Enter Your Contact Number</label>
						<input type="text" name="cno" data-rule-minlength="10" data-rule-maxlength="10" data-rule-numbersonly="true" data-msg-numbersonly="Contact number do not expects any alphabet" data-rule-required="true" data-msg-required="Please Enter Your Contact Number" class="form-control" id="cno" placeholder="Enter Contact Number" value="<?php echo $row['contact']; ?>">
					  </div>
					  <div class="form-group col-md-6">
						<label for="address" class="labelElements">Enter Your Address</label>
						<input type="text" name="address" data-rule-required="true" data-msg-required="Please Enter Your Address" class="form-control" id="address" placeholder="Enter Address" value="<?php echo $row['address']; ?>">
					  </div>
				</div>
				<div class="row">
					  <div class="form-group col-md-6">
						<label for="password" class="labelElements">Enter Your Password</label>
						<input type="password" name="password" data-rule-password="true" data-msg-password="Enter combination of numbers and letters of minimum 8 characters" data-rule-required="true" data-msg-required="Please Enter Your Password" class="form-control" id="password" placeholder="Password" value="<?php echo $row['password']; ?>">
					  </div>  
						<button type="submit" class="btn sub2 col-md-6">Update</button>	
				</div>
				  <div id="cnfmsg">Success</div>
				  <div id="errormsg">Something went wrong...Please try again</div> 
				</form>
			</div>
		</div>
	</div>
	
	<script>
		jQuery.validator.addMethod("lettersonly", function(value, element) {
			return this.optional(element) || /^[A-Za-z]+$/i.test(value);
		}, "Letters only please");
	</script>
	<script>
		jQuery.validator.addMethod("numbersonly", function(value, element) {
			return this.optional(element) || /^[0-9]+$/i.test(value);
		}, "Enter Number");
	</script>
		
	<script>
		jQuery.validator.addMethod("password", function(value, element) {
			return this.optional(element) || /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/i.test(value);
		}, "Enter combination of numbers and alphabets");
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
						url: "updateUser.php",
						data: datastr,
						dataType: "json",
						encoded: "true",
						success: function(msg) {
							if (msg == 'true') {
								$("#cnfmsg").addClass("show");
								$("#errormsg").removeClass("show");
								setTimeout(function () {
									location.href="userList.php"; 
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