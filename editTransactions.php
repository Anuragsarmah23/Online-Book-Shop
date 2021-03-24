<?php
	session_start();
?>
<html>
<head>
	<title>BRS|EDIT TRANSACTIONS</title>
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
		$_SESSION["TID"]=$id;
		$q="select * from transaction where id='$id'";
		$q_run=mysqli_query($con,$q);
		$row=mysqli_fetch_assoc($q_run);
		$bid=$row["bid"];
		$q2="select * from book where id='$bid'";
		$q2_run=mysqli_query($con,$q2);
		$row2=mysqli_fetch_assoc($q2_run);
	?>
	<div class="main">
		<div class="formMain">
			<div class="regFormElements">
				<div class="card-header">
					Edit Profile
					<hr>
				</div>
				<form method="post" class="regForm" id="validateIt" action="updateTransactions.php">
				<div class="row">
					  <div class="form-group col-md-6">
						<label for="id" class="labelElements">ID</label>
						<input type="text" style="background:transparent;" name="id" class="form-control" id="id" readonly value="<?php echo $row["id"]; ?>">
					  </div>
					  <div class="form-group col-md-6">
						<label for="bname" class="labelElements">Book Name</label>
						<input type="text" style="background:transparent;" name="bname" class="form-control" id="bname" readonly value="<?php echo $row2['name']; ?>">
					  </div>
				</div>	  
				<div class="row">	  
					  <div class="form-group col-md-6">
						<label for="Type" class="labelElements">Type</label>
						<input type="text" style="background:transparent;" name="Type"  class="form-control" id="lname" readonly value="<?php echo $row['type']; ?>">
					  </div>
					  <div class="form-group col-md-6">
						<label for="status" class="labelElements">Status</label>
						<input type="text" name="status" data-rule-required="true" data-msg-required="Please Enter Status" class="form-control" id="status" placeholder="Enter Current Status" value="<?php echo $row['status']; ?>">
					  </div>
				</div>
					<button type="submit" class="btn sub2">Update</button>	<br><br>
				  <div id="cnfmsg">Success</div>
				  <div id="errormsg">Something went wrong...Please try again</div> 
				</form>
			</div>
		</div>
	</div>
	
	<script>
		$('#validateIt').validate();
	</script>
		
	<script>
			$(document).ready(function() {
				$('.regForm').submit(function() {	
					var datastr=$(".regForm").serialize();
					$.ajax({
						type: "POST",
						url: "updateTransactions.php",
						data: datastr,
						dataType: "json",
						encoded: "true",
						success: function(msg) {
							if (msg == 'true') {
								$("#cnfmsg").addClass("show");
								$("#errormsg").removeClass("show");
								setTimeout(function () {
									location.href="transHistoryAdmin.php"; 
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