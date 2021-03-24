<html>
<head>
	<title>BRS|Registration Form</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/form.css" rel='stylesheet' type='text/css' />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
	
</head>	

<body>
	<div class="main">
		<div class="formMain">
			<div class="regFormElements">
				<div class="card-header">
					Registration Form
					<hr>
				</div>
				<form method="post" class="regForm" id="validateIt" action="regParse.php">
				<div class="row">
					  <div class="form-group col-md-6">
						<label for="fname" class="labelElements">Enter Your First Name</label>
						<input type="text" name="fname" data-rule-lettersonly="true" data-msg-lettersonly="Name should not include numbers or spaces" data-rule-required="true" data-msg-required="Please Enter Your First Name" class="form-control" id="fname" placeholder="Enter First Name">
					  </div>
					  <div class="form-group col-md-6">
						<label for="lname" class="labelElements">Enter Your Last Name</label>
						<input type="text" name="lname" data-rule-lettersonly="true" data-msg-lettersonly="Name should not include numbers or spaces" data-rule-required="true" data-msg-required="Please Enter Your Last Name" class="form-control" id="lname" placeholder="Enter Last Name">
					  </div>
				  </div>
				  <div class="row">
					  <div class="form-group col-md-6">
						<label for="email" class="labelElements">Enter Your Email ID</label>
						<input type="email" name="email" data-rule-email="true" data-msg-email="Please enter a valid email address" data-rule-required="true" data-msg-required="Please Enter Your Email ID" class="form-control" id="email" placeholder="Enter Email ID">
					  </div>
					  <div class="form-group col-md-6">
						<label for="cno" class="labelElements">Enter Your Contact Number</label>
						<input type="text" name="cno" data-rule-minlength="10" data-rule-maxlength="10" data-rule-numbersonly="true" data-msg-numbersonly="Contact number do not expects any alphabet" data-rule-required="true" data-msg-required="Please Enter Your Contact Number" class="form-control" id="cno" placeholder="Enter Contact Number">
					  </div>
				  </div>
				  <div class="row">
					  <div class="form-group col-md-6">
						<label for="address" class="labelElements">Enter Your Address</label>
						<input type="text" name="address" data-rule-required="true" data-msg-required="Please Enter Your Address" class="form-control" id="address" placeholder="Enter Address">
					  </div>
					  <div class="form-group col-md-6">
						<label for="password" class="labelElements">Enter Your Password</label>
						<input type="password" name="password" data-rule-password="true" data-msg-password="Enter combination of numbers and letters of minimum 8 characters" data-rule-required="true" data-msg-required="Please Enter Your Password" class="form-control" id="password" placeholder="Password">
					  </div>
				  </div>
				  <div class="row">
					  <div class="form-group col-md-6">
						<label for="cnfpass" class="labelElements">Confirm Your Password</label>
						<input type="password" name="cnfpass" data-rule-password="true" data-msg-password="Enter combination of numbers and letters of minimum 8 characters" data-rule-required="true" data-msg-required="Please Confirm Your Password" class="form-control" id="cnfpass" placeholder="Confirm Password">
					  </div>
					  <button type="submit" class="btn sub2 col-md-6">Register</button>
				  </div> 
				  <a href="login.php" style="text-decoration:none;">Already have an account?</a>
				  <div id="cnfmsg">Success</div>
				  <div id="emailmsg">Email already exist</div>
				  <div id="passmsg">Passwords do not matched</div>
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
						url: "regParse.php",
						data: datastr,
						dataType: "json",
						encoded: "true",
						success: function(msg) {
							if (msg == 'error') {
								$("#cnfmsg").removeClass("show");
								$("#emailmsg").removeClass("show");
								$("#passmsg").removeClass("show");
								$("#errormsg").addClass("show");	
								setTimeout(function () {
									location.reload(true); 
								}, 1000);
							}
							 else if (msg == 'emailError'){
								$("#cnfmsg").removeClass("show");
								$("#emailmsg").addClass("show");
								$("#passmsg").removeClass("show");
								$("#errormsg").removeClass("show");
							}
							else if (msg == 'passError'){
								$("#cnfmsg").removeClass("show");
								$("#emailmsg").removeClass("show");
								$("#passmsg").addClass("show");
								$("#errormsg").removeClass("show");
							}
							else {
								$("#cnfmsg").addClass("show");
								$("#emailmsg").removeClass("show");
								$("#passmsg").removeClass("show");
								$("#errormsg").removeClass("show");
								alert("Your User ID is: "+msg+" .It will be used for login so please remember it");
								setTimeout(function () {
									location.href="login.php"; 
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