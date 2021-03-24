<?php
	//RADHEY
	session_start();
	if(!isset($_SESSION["userID"])){
		echo '<script>alert("Login is required to purchase or sell book")</script>';
		echo '<script>setTimeout(function (){location.href="login.php";});</script>';
		die();
	}	
	$con=mysqli_connect('localhost','root','','brs');
	if(!$con){
		die("CONNECTION NOT FOUND".mysqli_error());
	}
	$bookID=$_POST["bookID"];
	$_SESSION["bookID"]=$bookID;
	$bookN=$_POST["bookN"];
	$_SESSION["bookName"]=$bookN;
	$bookP=$_POST["bookP"];	
	$bookA=$_POST["bookA"];
	$_SESSION["amount"]=$bookA;
	
?>	
	<script>
		var price=<?php echo $bookA; ?>;
		var confirmation=confirm("Are you sure you want to buy this book at Rs."+price+"..\npress ok to buy or cancel to abort..");
		var booKN="<?php echo $bookN; ?>";
		if(confirmation == false){
			setTimeout(function (){
				location.href="viewBook.php?name="+booKN;
			});	
		}	
		else
			setTimeout(function (){
				location.href="buyBookUser.php";
			});
			
	</script>

	