<?php
	session_start();
	if(!isset($_SESSION["adminID"]))
		header("location:index.php");
?><html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BRS|Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

   <style>
        .traffic-chart {
            min-height: 335px;
        }
       
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
		}
    </style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="dashAdmin.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">
						<a href="userList.php"><i class="menu-icon fa fa-users"></i>User List</a>
					</li>
                    <li class="menu-title">
						<a href="bookList.php"><i class="menu-icon fa fa-book"></i>Book List</a>
					</li>
                    <li class="menu-title">
                        <a href="addBook.php"><i class="menu-icon fa fa-address-book"></i>Add Book </a>
                    </li>
                    <li class="menu-title">
						<a href="register.php"><i class="menu-icon fa fa-user"></i>Add User</a>
					</li>
					<li class="menu-title">
						<a href="transHistoryAdmin.php"><i class="menu-icon fa fa-history"></i>Transactions</a>
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
						<div class="dropdown">
							<span class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-user-circle-o" style="font-size:25px;margin-top:2%;margin-left:75%;color:#129945;cursor:pointer;"></i>
							</span>
							<div class="dropdown-menu" style="font-size:14px;margin-top:9%;margin-left:50%;color:#129945;cursor:pointer;">
								<a class="dropdown-item"  href="logout.php">Log Out</a>
							</div>
						</div>
					</div>
				</div>	
			</div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                <!-- Widgets  -->
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-1">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
										<?php
											$con=mysqli_connect("localhost","root","","brs");
											if(!$con)
												die("CONNECTION NOT FOUND".mysqli_error());
											$q1="select * from user";
											$q1_run=mysqli_query($con,$q1);
											$rows1=mysqli_num_rows($q1_run);
										?>
                                            <div class="stat-text"><span class="count"><?php echo $rows1; ?></span></div>
                                            <div class="stat-heading">Users</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-2">
                                        <i class="fa fa-book"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
										<?php
											$q2="select * from book";
											$q2_run=mysqli_query($con,$q2);
											$rows2=mysqli_num_rows($q2_run);
										?>
                                            <div class="stat-text"><span class="count"><?php echo $rows2; ?></span></div>
                                            <div class="stat-heading">Books</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-five">
                                    <div class="stat-icon dib flat-color-3">
                                        <i class="fa fa-shopping-cart"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="text-left dib">
										<?php
											$q3="select * from transaction";
											$q3_run=mysqli_query($con,$q3);
											$rows3=mysqli_num_rows($q3_run);
										?>
                                            <div class="stat-text"><span class="count"><?php echo $rows3; ?></span></div>
                                            <div class="stat-heading">Transactions</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Widgets -->
                <!--  Traffic  -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">BRS </h4>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="card-body">
                                        <!-- <canvas id="TrafficChart"></canvas>   -->
                                        <div id="traffic-chart" class="traffic-chart"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="card-body">
                                        <div class="progress-box progress-1">
                                            <h4 class="por-title">Registered</h4>
                                            <div class="por-txt"><?php echo $rows1; ?> Users</div>
											<hr style="border:2px solid #11eeca;">
                                        </div>
                                        <div class="progress-box progress-2">
                                            <h4 class="por-title">Books Available</h4>
                                            <div class="por-txt"><?php echo $rows2; ?> Books</div>
											<hr style="border:2px solid #11eeca;">
                                        </div>
                                        <div class="progress-box progress-2">
                                            <h4 class="por-title">Transactions</h4>
                                            <div class="por-txt"><?php echo $rows3; ?> transactions</div>
											<hr style="border:2px solid #11eeca;">
                                        </div>
                                    </div> <!-- /.card-body -->
                                </div>
                            </div> <!-- /.row -->
                            <div class="card-body"></div>
                        </div>
                    </div><!-- /# column -->
                </div>
                <!--  /Traffic -->
                <div class="clearfix"></div>
            <!-- /#add-category -->
            </div>
            <!-- .animated -->
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
        jQuery(document).ready(function($) {
            "use strict";
			<?php
				$q12="select * from transaction where type='buy'";
				$q12_run=mysqli_query($con,$q12);
				$q13="select * from transaction where type='sell'";
				$q13_run=mysqli_query($con,$q13);
				$rows4=mysqli_num_rows($q12_run);
				$rows5=mysqli_num_rows($q13_run);
			?>
			var user="<?php echo $rows1; ?>";
			var book="<?php echo $rows2; ?>";
			var transaction="<?php echo $rows3; ?>";
			var buy="<?php echo $rows4; ?>";
			var sell="<?php echo $rows5; ?>";
            // Traffic Chart using chartist
            if ($('#traffic-chart').length) {
                var chart = new Chartist.Line('#traffic-chart', {
                  labels: ['BRS','Transactions','sell','Purchased','User', 'BRS'],
                  series: [
                  [0, transaction, sell, buy, user, 0]
                  ]
              }, {
                  low: 0,
                  showArea: true,
                  showLine: false,
                  showPoint: false,
                  fullWidth: true,
                  axisX: {
                    showGrid: true
                }
            });

                chart.on('draw', function(data) {
                    if(data.type === 'line' || data.type === 'area') {
                        data.element.animate({
                            d: {
                                begin: 2000 * data.index,
                                dur: 2000,
                                from: data.path.clone().scale(1, 0).translate(0, data.chartRect.height()).stringify(),
                                to: data.path.clone().stringify(),
                                easing: Chartist.Svg.Easing.easeOutQuint
                            }
                        });
                    }
                });
            }
            // Traffic Chart using chartist End
            //Traffic chart chart-js
            if ($('#TrafficChart').length) {
                var ctx = document.getElementById( "TrafficChart" );
                ctx.height = 150;
                var myChart = new Chart( ctx, {
                    type: 'line',
                    data: {
                        labels: ['BRS','Transactions','sell','Purchased', 'User', 'BRS' ],
                        datasets: [
                        {
                            label: "Total",
                            borderColor: "rgba(245, 23, 66, 0.9)",
                            borderWidth: "1",
                            backgroundColor: "rgba(245, 23, 66,.5)",
                            pointHighlightStroke: "rgba(245, 23, 66,.5)",
                            data: [ 0, transaction, sell, buy, user, 0 ]
                        },
                     
                        ]
                    },
                    options: {
                        responsive: true,
                        tooltips: {
                            mode: 'index',
                            intersect: false
                        },
                        hover: {
                            mode: 'nearest',
                            intersect: true
                        }

                    }
                } );
            }
            //Traffic chart chart-js  End
        });
    </script>
</body>
</html>
