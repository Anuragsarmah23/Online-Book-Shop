<html>
<head>
	<title>BRS|ADD Book</title>
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
					Book Description
					<hr>
				</div>
				<form method="post" class="regForm" id="validateIt" action="addBookParse.php" enctype="multipart/form-data">
					<div class="row">
					  <div class="form-group col-md-6">
						<label for="bname" class="labelElements">Name</label>
						<input type="text" name="bname" data-rule-required="true" data-msg-required="Please Enter Book Name" class="form-control" id="bname" placeholder="Enter Book Name">
					  </div>
					  <div class="form-group col-md-6">
						<label for="author" class="labelElements">Author</label>
						<input type="text" name="author" data-rule-required="true" data-msg-required="Please Enter Author Name" class="form-control" id="author" placeholder="Enter Author Name">
					  </div>
					</div>
					<div class="row">
					  <div class="form-group col-md-6">
						<label for="price" class="labelElements">Price(Rs.)</label>
						<input type="text" name="price" data-rule-numbersonly="true" data-rule-numbersonly="Add the amount in numbers" data-rule-required="true" data-msg-required="Please Enter Book Price" class="form-control" id="price" placeholder="Enter Price">
					  </div>
					  <div class="form-group col-md-6">
						<label for="cno" class="labelElements">Description</label>
						<textarea name="desc" data-rule-required="true" data-msg-required="Please Enter Your Contact Number" class="form-control" id="cno" placeholder="Add some description"></textarea>
					  </div>
					</div>  
					<div class="row">
						<div class="form-group col-md-6">
							<label for="File" class="labelElements">Image</label>
							<input type="file" name="fname" data-rule-required="true" data-msg-required="Please Select An Image" class="custom-file-input form-control" id="File">
						</div>
						<div class="form-group col-md-6">
							<label for="qty" class="labelElements">Quantity</label>
							<input type="number" name="qty" data-rule-required="true" data-msg-required="Please Enter Quantity" class="form-control" id="qty" placeholder="Enter Quantity">
						</div>  
					</div>  
					<button type="submit" class="btn sub2">ADD</button> <br><br>
				  <div id="cnfmsg">Success</div>
				  <div id="bookExistMsg">Book Already Exist.. Please update the quantity of the book.</div>
				  <div id="fileSizeMsg">Image size is too large.. Input smaller size</div>
				  <div id="fileTypeMsg">Type of the file should be jpg or png..</div>
				  <div id="qtyMsg">Quantity should be at least 1</div>
				  <div id="fileUploadErrorMsg">Something went wrong while uploading image.. try again..</div>
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
					$.ajax({
						type: "POST",
						url: "addBookParse.php",
						data: new FormData(this),
						dataType: "json",
						encoded: "true",
						cache: false,
						contentType: false,
						processData: false,
						success: function(msg) {
							if (msg == 'true') {
								$("#cnfmsg").addClass("show");
								$("#bookExistMsg").removeClass("show");
								$("#fileSizeMsg").removeClass("show");
								$("#fileTypeMsg").removeClass("show");
								$("#fileUploadErrorMsg").removeClass("show");
								$("#qtyMsg").removeClass("show");
								$("#errormsg").removeClass("show");
								setTimeout(function () {
									location.href="bookList.php"; 
								}, 1000);
							}
							else if (msg == 'bookExist') {
								$("#cnfmsg").removeClass("show");
								$("#bookExistMsg").addClass("show");
								$("#fileSizeMsg").removeClass("show");
								$("#fileTypeMsg").removeClass("show");
								$("#fileUploadErrorMsg").removeClass("show");
								$("#qtyMsg").removeClass("show");
								$("#errormsg").removeClass("show");
								setTimeout(function () {
									location.href="bookList.php"; 
								}, 1000);
							}
							else if (msg == 'fileSize') {
								$("#cnfmsg").removeClass("show");
								$("#bookExistMsg").removeClass("show");
								$("#fileSizeMsg").addClass("show");
								$("#fileTypeMsg").removeClass("show");
								$("#fileUploadErrorMsg").removeClass("show");
								$("#qtyMsg").removeClass("show");
								$("#errormsg").removeClass("show");
							}
							else if (msg == 'fileType') {
								$("#cnfmsg").removeClass("show");
								$("#bookExistMsg").removeClass("show");
								$("#fileSizeMsg").removeClass("show");
								$("#fileTypeMsg").addClass("show");
								$("#fileUploadErrorMsg").removeClass("show");
								$("#qtyMsg").removeClass("show");
								$("#errormsg").removeClass("show");
							}
							else if (msg == 'fileUploadError') {
								$("#cnfmsg").removeClass("show");
								$("#bookExistMsg").removeClass("show");
								$("#fileSizeMsg").removeClass("show");
								$("#fileTypeMsg").removeClass("show");
								$("#fileUploadErrorMsg").addClass("show");
								$("#qtyMsg").removeClass("show");
								$("#errormsg").removeClass("show");
							}
							else if (msg == 'qtyError') {
								$("#cnfmsg").removeClass("show");
								$("#bookExistMsg").removeClass("show");
								$("#fileSizeMsg").removeClass("show");
								$("#fileTypeMsg").removeClass("show");
								$("#fileUploadErrorMsg").addClass("show");
								$("#qtyMsg").addClass("show");
								$("#errormsg").removeClass("show");
							}
							else {
								$("#cnfmsg").removeClass("show");
								$("#bookExistMsg").removeClass("show");
								$("#fileSizeMsg").removeClass("show");
								$("#fileTypeMsg").removeClass("show");
								$("#fileUploadErrorMsg").removeClass("show");
								$("#qtyMsg").removeClass("show");
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