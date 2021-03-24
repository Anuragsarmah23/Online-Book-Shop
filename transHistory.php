<?php
	session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>BRS|Transactions</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->

</head>
<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="menu-title">
                        <a href="main.php"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
					<li class="menu-title">
						<a href="editUsers.php"><i class="menu-icon fa fa-user-circle-o"></i>Edit Profile</a>
					</li>
                    <li class="menu-title">
						<a href="sellBook.php"><i class="menu-icon fa fa-address-book"></i>Sell Book</a>
					</li>
                    <li class="active">
                        <a href="transHistory.php"><i class="menu-icon fa fa-history"></i>Transactions</a>
                    </li>
					<li class="menu-title">
                        <a href="cart.php" style="color:#939393;font-size:14px;"><i class="menu-icon fa fa-cart-plus"></i>Cart</a>
                    </li>
                </ul>
            </div>
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./">BRS</a>
                </div>
            </div>
			<div class="top-right">
				<div class="header-menu">	
                    <div class="searchAreaM">
						<div class="dropdown">
							<div class="dropdown-toggle" data-toggle="dropdown" style="margin-left:82%;">
								<i class="fa fa-user-circle-o" style="font-size:25px;color:#129945;cursor:pointer;"></i>
							</div>
							<div class="dropdown-menu" style="font-size:14px;margin-left:70%;margin-top:10%;color:#129945;cursor:pointer;">
								<a class="dropdown-item"  href="logout.php">Log Out</a>
							</div>
						</div>
					</div>
				</div>	
			</div>
						
        </header><!-- /header -->
        <!-- Header-->

        <div class="content" style="min-height:100vh;">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Book List</strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
								<?php
									$con=mysqli_connect('localhost','root','','brs');
									if(!$con)
											die("CONNECTION NOT FOUND".mysqli_error());
									$uid=$_SESSION["userID"];	
									$q="select * from transaction where uid='$uid'";
									$q_run=mysqli_query($con,$q);
								?>
                                    <thead>
                                        <tr>
                                            <th>Transaction ID</th>
											<th>Book Name</th>
                                            <th>Type</th>
											<th>Amount(Rs.)</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php while($row=mysqli_fetch_assoc($q_run)){ 
											$bid=$row["bid"];
												$q123="select * from book where id='$bid'";
												$q123_run=mysqli_query($con,$q123);
												$row123=mysqli_fetch_assoc($q123_run);
									?>
                                        <tr>
                                            <td><?php echo $row["id"]; ?></td>
											<td><?php echo $row123["name"]; ?></td>
                                            <td><?php echo $row["type"]; ?></td>
											<td><?php echo $row["Amount"]; ?></td>
                                            <td><?php echo $row["status"]; ?></td>
                                        </tr>
									<?php } ?>
									
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div><!-- .animated -->
        </div><!-- .content -->


        <div class="clearfix"></div>

        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2018 BRS
                    </div>
                </div>
            </div>
        </footer>

    </div><!-- /#right-panel -->

    <!-- Right Panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="assets/js/lib/data-table/datatables.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="assets/js/lib/data-table/jszip.min.js"></script>
    <script src="assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="assets/js/init/datatables-init.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();
      } );
  </script>


</body>
</html>
