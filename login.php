<html>
<head>
	<title>BRS|Login Form</title>
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
			<div class="formElements">
				<div class="card-header">
					Login Form
					<hr>
				</div>
				<form method="post" class="loginForm" id="validateIt" action="loginParse.php">
				  <div class="form-group">
					<label for="uid" class="labelElements">Enter Your User ID</label>
					<input type="text" name="uid" data-rule-required="true" data-msg-required="Please Enter Your User ID" class="form-control" id="uid" placeholder="Enter ID">
				  </div>
				  <div class="form-group">
					<label for="password" class="labelElements">Enter Your Password</label>
					<input type="password" name="password" data-rule-required="true" data-msg-required="Please Enter Your Password" class="form-control" id="password" placeholder="Password">
				  </div>
				  <a href="register.php" style="text-decoration:none;">Create Account</a>
				  <div id="cnfmsg">Success</div>
				  <div id="idmsg">User ID is invalid</div>
				  <div id="passmsg">Invalid password</div>
				  <div id="errormsg">Something went wrong...Please try again</div>
				  
				  <button type="submit" class="btn sub">Login</button>
				</form>
			</div>
		</div>
	</div>
	<script>
		$('#validateIt').validate();
	</script>
		
	<script>
			$(document).ready(function() {
				$('.loginForm').submit(function() {
					$('#uid').valid();
					$('#password').valid();	
					var datastr=$('.loginForm').serialize();
					$.ajax({
						type: "POST",
						url: "loginParse.php",
						data: datastr,
						dataType: "json",
						encoded: "true",
						success: function(msg) {
							if (msg == 'true') {
								$("#cnfmsg").addClass("show");
								$("#idmsg").removeClass("show");
								$("#passmsg").removeClass("show");
								$("#errormsg").removeClass("show");
								setTimeout(function () {
									location.href="main.php"; 
								}, 1000);
							}
							else if (msg == 'admin'){
								$("#cnfmsg").addClass("show");
								$("#idmsg").removeClass("show");
								$("#passmsg").removeClass("show");
								$("#errormsg").removeClass("show");
								setTimeout(function () {
									location.href="dashAdmin.php"; 
								}, 1000);
							}
							 else if (msg == 'idError'){
								$("#cnfmsg").removeClass("show");
								$("#idmsg").addClass("show");
								$("#passmsg").removeClass("show");
								$("#errormsg").removeClass("show");
							}
							else if (msg == 'passError'){
								$("#cnfmsg").removeClass("show");
								$("#idmsg").removeClass("show");
								$("#passmsg").addClass("show");
								$("#errormsg").removeClass("show");
							}
							else {
								$("#cnfmsg").removeClass("show");
								$("#idmsg").removeClass("show");
								$("#passmsg").removeClass("show");
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