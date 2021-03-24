<?php
	session_start();
	if(!isset($_SESSION["userID"]))
		header("location:index.php");
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BRS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />
	
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>

</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="main.php" style="color:#939393;font-size:14px;"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
					<li class="menu-title">
						<a href="editUsers.php" style="color:#939393;font-size:14px;"><i class="menu-icon fa fa-user-circle-o"></i>Edit Profile</a>
					</li>
                    <li class="menu-title">
						<a href="sellBook.php" style="color:#939393;font-size:14px;"><i class="menu-icon fa fa-address-book"></i>Sell Book</a>
					</li>
                    <li class="menu-title">
                        <a href="transHistory.php" style="color:#939393;font-size:14px;"><i class="menu-icon fa fa-history"></i>Transactions</a>
                    </li>
					<li class="menu-title">
                        <a href="cart.php" style="color:#939393;font-size:14px;"><i class="menu-icon fa fa-cart-plus"></i>Cart</a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">BRS</a>
                </div>
            </div>
			<div class="top-right">
				<div class="header-menu">	
                    <div class="searchAreaM">
                        <form method="get">
                            <input type="text" placeholder="Search ..." class="searchMain" name="searchQ" required>
                            <button class="searchBtnM" type="submit" name="searchSub"><i class="fa fa-search"></i></button>
						</form>
						<div class="dropdown">
							<div class="dropdown-toggle" data-toggle="dropdown" style="margin-top:-13.5%;margin-left:82%;">
								<i class="fa fa-user-circle-o" style="font-size:25px;color:#129945;cursor:pointer;"></i>
							</div>
							<div class="dropdown-menu" style="font-size:14px;margin-left:70%;margin-top:10%;color:#129945;cursor:pointer;">
								<a class="dropdown-item"  href="logout.php">Log Out</a>
							</div>
						</div>
						<!--Enables cart icon on nav-->
						<!--<div class="nav-item" style="margin-top:-10%;margin-left:-10%;font-size:25px;">
						<a href="cart.php" class="nav-link" style="color:#129945;">
							<i class="fa fa-cart-plus"></i>
						</a>
						</div>-->
                    </div>
				</div>	
			</div>
        </header>
        <!-- /#header -->
		<?php
			$con=mysqli_connect('localhost','root','','brs');
			if(!$con){
				die("CONNECTION NOT FOUND".mysqli_error());
			}
		?>
        <!-- Content -->
       <div class="content" style="min-height:100vh;">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card" style="background:#555 !important;">
                           <div class="contentM">
							<?php 	
								if(isset($_GET["searchSub"])){	
									$searchQ=$_GET["searchQ"];
									$q4="select * from book where name like '$searchQ%'";
									$q4_run=mysqli_query($con,$q4);
									$rows5=mysqli_num_rows($q4_run);
									if($rows5 > 0){
										echo'<div style="padding:10px;height:100vh;margin-top:2%;">';
										while($row5=mysqli_fetch_assoc($q4_run)){
											$imageID=$row5['id'];
											$imageN=$row5['name'];
											echo '<a href="viewBook.php?name='.$imageN.'"><img src="bookImages/'.$imageID.'" alt='.$imageN.' height="200" width="200" style="margin-right:2.5%;margin-bottom:5%;"></a>';
										}	
										echo '</div>';
									}else{
										echo'<div style="padding:10px;font-size:20px;">';
										echo "No Results Found";
										echo '</div></div>';
									}
								}else{	
									$q="select * from book where price >= 120";
									$q_run=mysqli_query($con,$q);
									$q1="select * from book where quantity > 1";
									$q1_run=mysqli_query($con,$q1);
									$q2="select * from book";
									$q2_run=mysqli_query($con,$q2);
									$q3="select * from book where status='not available'";
									$q3_run=mysqli_query($con,$q3);
									$q4="select distinct bid from transaction where type='sell'";
									$q4_run=mysqli_query($con,$q4);
									
							?>		
							<div style="width:90%;">
								<div class="featured-section" id="books" style="margin-left:-5%;margin-bottom:-5%;background:transparent !important;">
									<div class="container">
										<!-- tittle heading -->
										<h3 class="tittle-w3l" style="color:#939393;font-size:25px !important;margin-top:-5%;">SECOND HAND BOOKS</h3>
										<!-- //tittle heading -->
										<div class="content-bottom-in" style="color:#939393 !important">
											<ul id="flexiselDemo5">
											<?php 
												while($row4=mysqli_fetch_assoc($q4_run)){
													$bookID=$row4["bid"];
													$q5="select * from book where id='$bookID'";
													$q5_run=mysqli_query($con,$q5);
													while($row5=mysqli_fetch_assoc($q5_run)){
											?>
													<li>
														<div class="w3l-specilamk">
															<div class="speioffer-agile">
																<a href="viewBook.php?name=<?php echo $row5['name'];?>">
																	<img src="bookImages/<?php echo $row5['id'];  ?>" alt="" height="200" width="200">
																</a>
															</div>
															<div class="product-name-w3l">
																<h4>
																	<a href="viewBook.php?name=<?php echo $row5['name'];?>"><?php echo $row5['name']; ?></a>
																</h4>
																<div class="w3l-pricehkj">
																	<strike><p style="color:#939393 !important;">Price:Rs. <?php echo $row5['price']; $newPrice=$row5['price']*60/100?></strike></p>
																	<p style="color:#939393 !important;">Price:Rs. <?php echo $newPrice; ?></p>
																</div>
															</div>
														</div>
													</li>
											<?php 
													}
												}
											?>
											</ul>
										</div>
									</div>
								</div>
								<div class="featured-section" id="books" style="margin-left:-5%;margin-bottom:-5%;background:transparent !important;">
									<div class="container">
										<!-- tittle heading -->
										<h3 class="tittle-w3l" style="color:#939393;font-size:25px !important;margin-top:-5%;">COSTLY BOOKS</h3>
										<!-- //tittle heading -->
										<div class="content-bottom-in" style="color:#939393 !important">
											<ul id="flexiselDemo1">
											<?php 
												while($row=mysqli_fetch_assoc($q_run)){
											?>
													<li>
														<div class="w3l-specilamk">
															<div class="speioffer-agile">
																<a href="viewBook.php?name=<?php echo $row['name'];?>">
																	<img src="bookImages/<?php echo $row['id'];  ?>" alt="" height="200" width="200">
																</a>
															</div>
															<div class="product-name-w3l">
																<h4>
																	<a href="viewBook.php?name=<?php echo $row['name'];?>"><?php echo $row['name']; ?></a>
																</h4>
																<div class="w3l-pricehkj">
																	<p style="color:#939393 !important;">Price:Rs. <?php echo $row['price']; ?></p>
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
								<div class="featured-section" id="books" style="margin-left:-5%;margin-bottom:-5%;background:transparent !important;">
									<div class="container">
										<!-- tittle heading -->
										<h3 class="tittle-w3l" style="color:#939393;font-size:25px !important;margin-top:-5%;">UMPTEEN BOOKS</h3>
										<!-- //tittle heading -->
										<div class="content-bottom-in" style="color:#939393 !important">
											<ul id="flexiselDemo2">
											<?php 
												while($row1=mysqli_fetch_assoc($q1_run)){
											?>
													<li>
														<div class="w3l-specilamk">
															<div class="speioffer-agile">
																<a href="viewBook.php?name=<?php echo $row1['name'];?>">
																	<img src="bookImages/<?php echo $row1['id'];  ?>" alt="" height="200" width="200">
																</a>
															</div>
															<div class="product-name-w3l">
																<h4>
																	<a href="viewBook.php?name=<?php echo $row1['name'];?>"><?php echo $row1['name']; ?></a>
																</h4>
																<div class="w3l-pricehkj">
																	<p style="color:#939393 !important;">Price:Rs. <?php echo $row1['price']; ?></p>
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
								<div class="featured-section" id="books" style="margin-left:-5%;margin-bottom:-5%;background:transparent !important;">
									<div class="container">
										<!-- tittle heading -->
										<h3 class="tittle-w3l" style="color:#939393;font-size:25px !important;margin-top:-5%;">STOCKS</h3>
										<!-- //tittle heading -->
										<div class="content-bottom-in" style="color:#939393 !important">
											<ul id="flexiselDemo3">
											<?php 
												while($row2=mysqli_fetch_assoc($q2_run)){
											?>
													<li>
														<div class="w3l-specilamk">
															<div class="speioffer-agile">
																<a href="viewBook.php?name=<?php echo $row2['name'];?>">
																	<img src="bookImages/<?php echo $row2['id'];  ?>" alt="" height="200" width="200">
																</a>
															</div>
															<div class="product-name-w3l">
																<h4>
																	<a href="viewBook.php?name=<?php echo $row2['name'];?>"><?php echo $row2['name']; ?></a>
																</h4>
																<div class="w3l-pricehkj">
																	<p style="color:#939393 !important;">Price:Rs. <?php echo $row2['price']; ?></p>
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
								<div class="featured-section" id="books" style="margin-left:-5%;margin-bottom:-5%;background:transparent !important;">
									<div class="container">
										<!-- tittle heading -->
										<h3 class="tittle-w3l" style="color:#939393;font-size:25px !important;margin-top:-5%;">OUT OF STOCKS</h3>
										<!-- //tittle heading -->
										<div class="content-bottom-in" style="color:#939393 !important">
											<ul id="flexiselDemo4">
											<?php 
												while($row3=mysqli_fetch_assoc($q3_run)){
											?>
													<li>
														<div class="w3l-specilamk">
															<div class="speioffer-agile">
																<a href="viewBook.php?name=<?php echo $row3['name'];?>">
																	<img src="bookImages/<?php echo $row3['id'];  ?>" alt="" height="200" width="200">
																</a>
															</div>
															<div class="product-name-w3l">
																<h4>
																	<a href="viewBook.php?name=<?php echo $row3['name'];?>"><?php echo $row3['name']; ?></a>
																</h4>
																<div class="w3l-pricehkj">
																	<p style="color:#939393 !important;">Price:Rs. <?php echo $row3['price']; ?></p>
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
								</div><br><br>
								</div>
							<?php
								} 
							?>	
						   </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div>
        <!-- /.content -->
        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2018 BRS
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
	<script src="js/jquery.flexisel.js"></script>
	<script src="js/pagination.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!--  Chart js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js"></script>

    <!--Chartist Chart-->
    <script src="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartist-plugin-legend@0.6.2/chartist-plugin-legend.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/jquery.flot@0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-pie@1.0.0/src/jquery.flot.pie.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flot-spline@0.0.1/js/jquery.flot.spline.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/simpleweather@3.1.0/jquery.simpleWeather.min.js"></script>
    <script src="assets/js/init/weather-init.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/moment@2.22.2/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.js"></script>
    <script src="assets/js/init/fullcalendar-init.js"></script>

    <!--Local Stuff-->
	<script>
		$(window).load(function () {
			$("#flexiselDemo1").flexisel({
				visibleItems: 4,
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
	<script>
		$(window).load(function () {
			$("#flexiselDemo2").flexisel({
				visibleItems: 4,
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
	<script>
		$(window).load(function () {
			$("#flexiselDemo3").flexisel({
				visibleItems: 4,
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
	<script>
		$(window).load(function () {
			$("#flexiselDemo4").flexisel({
				visibleItems: 4,
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
	<script>
		$(window).load(function () {
			$("#flexiselDemo5").flexisel({
				visibleItems: 4,
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
	
</body>
</html>
