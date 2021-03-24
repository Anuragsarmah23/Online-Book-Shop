<html>
<head>
	<title>BRS|Home Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="js/jquery.validate.min.js"></script>
</head>		

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
	<div class="main-banner-agile" id="home">
		<!-- header -->
		<div class="header-w3layouts">
			<!-- Navigation -->
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container">
					<div class="navbar-header page-scroll">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
							<span class="sr-only">BRS</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1>
							<a class="navbar-brand" href="index.html">BRS</a>
						</h1>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse navbar-ex1-collapse">
						<ul class="nav navbar-nav navbar-right">
							<!-- Hidden li included to remove active class from about link when scrolled up past about section -->
							<li class="hidden">
								<a class="page-scroll" href="#page-top"></a>
							</li>
							<li class="active">
								<a class="page-scroll scroll" href="#home">Home</a>
							</li>
							<li>
								<a class="page-scroll scroll" href="#books">Books</a>
							</li>
							<li>
								<a class="page-scroll scroll" href="#about">About Us</a>
							</li>
							<li>
								<a class="page-scroll scroll" href="#contact">Contact Us</a>
							</li>
							<li>
								<button class="searchBtn"><i class="fa fa-search"></i></button>
							</li>
						</ul>
					</div>
					<!-- /.navbar-collapse -->
				</div>
				<!-- /.container -->
			</nav>
		</div>
		<!-- //header -->
		
		<!-- Search Area -->
		<div class="searchArea">
			<div class="searchElements">
				<button class="closeBtn"><i class="fa fa-times"></i></button>
				<form method="post" class="searchForm" action="searchParse.php" id="validateIt">
					<div class="row">
						<div class="form-group col-md-9">
							<label for="search" class="labelSearchElements">Search Books</label>
							<input type="text" required name="search" class="form-control searchInput" id="search" placeholder="Enter Book Name Or Author Name">
						</div>
						<div class="form-group col-md-3">
							<button type="submit" name="subSearch" class="btn search">Search</button>
						</div>
					</div>
				</form>
				<div class="searchResults">
					
				</div>
			</div>
		</div>
		
		<!-- banner -->
		<div class="main-banner">
		<div class="banner-w3l">
			<div class="banner-left-wthree">
				<h6>Welcome here</h6><br>
				<h2>Book Re-Selling Website</h2><br><br>
				<p class="para-banner">Sell or Purchase book here in efficient way at reasonable price</p>
				<p>We are here 24X7 providing you support</p><br><br><br><br><br><br>
				<p>Maintain your transactions by 
					<a class="nav-link-Custom" href="login.php">Signing In</a>
				</p><br>
				<p>If you do not have an account here.
					<a class="nav-link-Custom" href="register.php">Create account</a>
				</p>
			</div>
			<div class="clearfix"></div>
		</div>
		</div>
		<!-- //banner -->
	</div>
    <!-- Book Retrieval from DB -->
	<?php
		$con=mysqli_connect('localhost','root','','brs');
		if(!$con)
 			die("CONNECTION NOT FOUND".mysqli_error());
		$q="select * from book order by quantity desc limit 4";
		$q_run=mysqli_query($con,$q);
	?>
	<!-- Books -->
	<div class="featured-section" id="books">
		<div class="container">
			<!-- tittle heading -->
			<h3 class="tittle-w3l">My Books</h3>
			<!-- //tittle heading -->
			<div class="content-bottom-in">
				<ul id="flexiselDemo1">
				<?php 
					while($row=mysqli_fetch_assoc($q_run)){
						$bookID=$row["id"];
						$q1="select * from transaction where type='buy' and bid='$bookID'";
						$q1_run=mysqli_query($con,$q1);
				?>
						<li>
							<div class="w3l-specilamk">
								<div class="speioffer-agile">
									<a href="viewBook.php?name=<?php echo $row['name'];?>">
										<img src="bookImages/<?php echo $row['id'];  ?>" alt="" height="254" width="200">
									</a>
								</div>
								<div class="product-name-w3l">
									<h4>
										<a href="viewBook.php?name=<?php echo $row['name'];?>"><?php echo $row['name']; ?></a>
									</h4>
									<div class="w3l-pricehkj">
										<?php
											if(mysqli_num_rows($q1_run) > 0){
												$row2=mysqli_fetch_assoc($q1_run);
										?>
										<strike><p>Price:Rs. <?php echo $row['price']; ?></p></strike>
										<p>Price:Rs. <?php echo $row2['Amount']; ?></p>
										<?php
											}else{
										?>
											<p>Price:Rs. <?php echo $row['price']; ?></p>
											<?php } ?>	
									</div>
								</div>
							</div>
						</li>
				<?php 
					}
				?>
				</ul>
			</div>
		</div>
	</div>

	<!-- //Books -->

	<!-- about -->
	<div class="about" id="about">
		<div class="container">
			<h3 class="tittle-w3l">About Us</h3>
			<div class="about-agileinfo">
				<div class="col-md-4 about-left ">
					<img src="images/book1.png" height="300px" alt="" />
				</div>
				<div class="col-md-8 about-right wthree">
					<h3>BRS</h3>
					<h4>Book Re-Selling</h4>
					<p>We established in March 16, 2019.This organization is founded by *****. Our vision is to benefit a learner by making the availability of book at least price.</p>
					<br><br><p>Most important source of knowledge is book.It do not discriminate between first hand or second hand.Sell or Purchase book here and get benefited accordingly.</p>
					
				</div>
			</div>
		</div>
	</div>
	<!-- //about -->

	<!-- contact -->
	<div class="w3ls_map" id="contact">
		<div class="w3ls_map_color">
			<div class="contact-bottom-grids">
				<div class="container">
					<div class="col-md-4 col-xs-4 contact-bottom-grid">
						<div class="dot">
							<span>
								<i class="fa fa-map-marker" aria-hidden="true"></i>
							</span>
						</div>
						<h4>Panbazar,Guwahati-781007
							<span>Assam</span>
						</h4>
					</div>
					<div class="col-md-4 col-xs-4 contact-bottom-grid">
						<div class="dot">
							<span>
								<i class="fa fa-envelope-o" aria-hidden="true"></i>
							</span>
						</div>
						<a href="#">****@gmail.com</a>
					</div>
					<div class="col-md-4 col-xs-4 contact-bottom-grid">
						<div class="dot">
							<span>
								<i class="fa fa-phone" aria-hidden="true"></i>
							</span>
						</div>
						<h4>+91 8912765489
							<span>+361 22679012</span>
						</h4>
					</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
		<div class="mail">
			<div class="container">
				<div class="w3l_contact_grids">
					<form action="#" method="post">
						<div class="col-md-6 col-xs-6 w3l_contact_grid_left">
							<input type="text" placeholder="Name" name="Name" required="" />
							<input type="text" placeholder="Phone" name="Phone" required="" />
						</div>
						<div class="col-md-6 col-xs-6 w3l_contact_grid_left">
							<input type="email" placeholder="Email" name="Email" required="" />
							<input type="text" placeholder="Subject" name="Subject" required="" />
						</div>
						<div class="clearfix"> </div>
						<textarea name="Message" placeholder="Type Message Here...." required=""></textarea>
						<input type="submit" value="Submit Now" />
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- //contact -->

	<!-- footer -->
	<div class="footer-bot">
		<div class="container">
			<div class="logo2">
				<h3>
					<a href="index.html">BRS</a>
				</h3>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	<!-- copyright -->
	<div class="copy-right">
		<div class="container">
			<p> &copy; 2018 BRS. All Rights Reserved </p>
		</div>
	</div>
	<!-- //copyright -->
	<!-- //footer -->


	<!-- js -->
	<script src="js/jquery-2.1.4.min.js"></script>
	<!-- //js -->

	<!-- for bootstrap working -->
	<script src="js/bootstrap.js"></script>
	<!-- //for bootstrap working -->

	<!-- stats numscroller-js-file -->
	<script src="js/numscroller-1.0.js"></script>
	<!-- //stats numscroller-js-file -->

	<!--  light box js -->
	<script src="js/lightbox-plus-jquery.min.js"></script>
	<!-- //light box js-->

	<!-- flexisel (for special offers) -->
	<script src="js/jquery.flexisel.js"></script>
	
	<script src="js/pagination.min.js"></script>
	
	
	<script>
		$(document).ready(function(){
			$(".searchBtn").click(function(){
				$(".searchArea").addClass("show");
			});
			$(".closeBtn").click(function(){
				$(".searchArea").removeClass("show");
			});	
		});
	</script>
	
	<script>
			$(document).ready(function() {
				$('.searchForm').submit(function() {	
					var datastr=$('.searchForm').serialize();
					$.ajax({
						type: "POST",
						url: "searchParse.php",
						data: datastr,
						dataType: "json",
						success: function(msg) {
							var j=msg.length;
							$('.searchResults').html("");
							$('.searchResults').css('overflow-y','auto');
							$('.searchResults').append("<table>"); 
								$('.searchResults').append( '<tr>'); 
									$('.searchResults').append( '<th class="searchHead">' + 'Book Title' + '</th>' );
									$('.searchResults').append( '<th class="searchHead">' + 'Author Name' + '</th>' );
									$('.searchResults').append( '<th class="searchHead">' + 'Description' + '</th>' );
									$('.searchResults').append( '<th class="searchHead">' + 'Price(Rs.)' + '</th>' );
									$('.searchResults').append( '<th class="searchHead">' + 'Status' + '</th>' );
								$('.searchResults').append( '</tr>');
								for(i=0;i<j;i++){	
									$('.searchResults').append( '<tr>');
										for(k=0;k<5;k++){
											$('.searchResults').append( '<td class="searchTable"><a href="viewBook.php?name='+msg[i][0]+'">' +msg[i][k]+ '</a></td>');
										}
									$('.searchResults').append( '</tr>');
								}

							$('.searchResults').append(  '</table>' );
							

							if (msg == 'false'){
								$(".searchResults").html("<span style='font-size:25px;'>No Results Found");
							}
						}
					});
					return false;
				
				});
			});
	</script>	
	
	<script>
		$(window).load(function () {
			$("#flexiselDemo1").flexisel({
				visibleItems: 3,
				animationSpeed: 1000,
				autoPlay: true,
				autoPlaySpeed: 3000,
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
				responsiveBreakpoints: {
					portrait: {
						changePoint: 480,
						visibleItems: 1
					},
					landscape: {
						changePoint: 640,
						visibleItems: 2
					},
					tablet: {
						changePoint: 768,
						visibleItems: 2
					}
				}
			});

		});
	</script>
	<!-- //flexisel (for special offers) -->

	<!-- pricing-tablel -->
	<script src="js/jquery.magnific-popup.js"></script>
	<script>
		$(document).ready(function () {
			$('.popup-with-zoom-anim').magnificPopup({
				type: 'inline',
				fixedContentPos: false,
				fixedBgPos: true,
				overflowY: 'auto',
				closeBtnInside: true,
				preloader: false,
				midClick: true,
				removalDelay: 300,
				mainClass: 'my-mfp-zoom-in'
			});

		});
	</script>
	<!-- //pricing-tablel -->

	<!-- smooth scrolling -->
	<script src="js/SmoothScroll.min.js"></script>
	<!-- //smooth scrolling -->

	<!-- start-smoth-scrolling -->
	<script src="js/move-top.js"></script>
	<script src="js/easing.js"></script>
	<script>
		jQuery(document).ready(function ($) {
			$(".scroll").click(function (event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1000);
			});
		});
	</script>
	<!-- start-smoth-scrolling -->

	<!-- smooth scrolling-bottom-to-top -->
	<script>
		$(document).ready(function () {
			/*
				var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
				};
			*/
			$().UItoTop({
				easingType: 'easeOutQuart'
			});
		});
	</script>
	<a href="#" id="toTop" style="display: block;">
		<span id="toTopHover" style="opacity: 1;"> </span>
	</a>
	<!-- //smooth scrolling-bottom-to-top -->

</body>

</html>