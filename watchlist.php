<?php
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7 no-js" lang="en-US">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 no-js" lang="en-US">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html lang="en" class="no-js">

<!-- userfavoritegrid13:40-->
<head>
	<!-- Basic need -->
	<title>Open Pediatrics</title>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<link rel="profile" href="#">

    <!--Google Font-->
    <link rel="stylesheet" href='http://fonts.googleapis.com/css?family=Dosis:400,700,500|Nunito:300,400,600' />
	<!-- Mobile specific meta -->
	<meta name=viewport content="width=device-width, initial-scale=1">
	<meta name="format-detection" content="telephone-no">

	<!-- CSS files -->
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/style.css">

</head>
<body>
<!--preloading-->
<div id="preloader">
    <img class="logo" src="images/logo3.png" alt="" width="119" height="58">
    <div id="status">
        <span></span>
        <span></span>
    </div>
</div>
<!--end of preloading-->
<!--login form popup-->


<!-- BEGIN | Header -->
<header class="ht-header">
    <div class="container">
        <nav class="navbar navbar-default navbar-custom">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header logo">
                <div class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <div id="nav-icon1">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <a href="home.php"><img class="logo" src="images/logo3.png" alt="" width="70" height="40"></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse flex-parent" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav flex-child-menu menu-left">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>

                    <li class="dropdown first">
                        <a href="userprofile.php">
                            profile
                        </a>

                    </li>
                    <li class="dropdown first">
                        <a href="watchlist.php" >
                            Watchlist
                        </a>

                    </li>
                    <li class="dropdown first">
                        <a href="all_reviews.php">
                        </a>

                    </li>

                </ul>
                <ul class="nav navbar-nav flex-child-menu menu-right">
                    <?php
                    if($_SESSION['person']['name']=="abdullah_alawad_")
                    {
                        ?>
                        <li class="dropdown first">
                            <a class="btn btn-default dropdown-toggle lv1" data-toggle="dropdown" data-hover="dropdown">
                                admin choices <i class="fa fa-angle-down" aria-hidden="true"></i>
                            </a>
                            <ul class="dropdown-menu level1">
                                <li><a href="admin_add.php">add movie</a></li>
                                <li><a href="admin_delet.php">delete movie</a></li>
                                <li><a href="admin_modify.php">update movie</a></li>
                            </ul>

                        </li>
                        <?php
                    }
                    ?>
                    <li ><a href="logout.php">logout</a></li>
                    <li class="btn signupLink"> <a href="userprofile.php"> <?php echo $_SESSION['person']['name']?> </a> </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>



    </div>
</header><!-- END | Header -->

<div class="hero user-hero">
	<div class="container">
		<div class="row">

		</div>
	</div>
</div>
<div class="page-single">
	<div class="container" >
		<div class="row ipad-width2" style="margin-left: -350px; " >
			<div class="col-md-3 col-sm-12 col-xs-12">

			</div>
			<div class="col-md-9 col-sm-12 col-xs-12">
				<div class="topbar-filter user">
					<p>Found <span><?php
					        $x=$_SESSION['person']['name'];
                            $stm="SELECT count(movie_name) FROM watchlist WHERE person_name='$x'";
                            $see=$conn->query($stm);
                            $num="";
                            foreach ($see as $val)
                            {
                                foreach ($val as $val1)
                                {
                                    $num=$val1;
                                    break;
                                }
                                break;
                            }
                                echo $num;
                            ?> movies</span> in total</p>

				</div>
				<div class="flex-wrap-movielist grid-fav">
                    <?php
                    $stm="SELECT movie_name FROM watchlist WHERE person_name='$x'";
                    $see=$conn->query($stm);
                    foreach ($see as $val1) {
                        $cnt1 = 1;
                        foreach ($val1 as $val2) {
                            if ($cnt1 & 1) {
                                $inf = [];
                                $stm = "SELECT * FROM movie WHERE name='$val2'";
                                $data = $conn->query($stm);
                                foreach ($data as $val3) {
                                    $cnt2 = 1;
                                    foreach ($val3 as $val4) {
                                        if ($cnt2 & 1) {
                                            $inf[] = $val4;
                                        }
                                        $cnt2++;
                                    }
                                }
                                ?>

                                    <div class="movie-item-style-2 movie-item-style-1 style-3">
							            <img src="images/<?=$inf[1];?>" alt="">
                                        <div class="hvr-inner">
	            				        <a  href="moviesingle.php?movie_name=<?=$inf[0];?>"> Read more <i class="ion-android-arrow-dropright"></i> </a>
	            			             </div>
							            <div class="mv-item-infor">
								        <h6><a href="moviesingle.php"><?=$inf[0];?></a></h6>
								        <p class="rate"><i class="ion-android-star"></i><span><?=$inf[5];?></span> /5</p>
							            </div>
						             </div>
                                <?php
                            }
                            $cnt1++;
                        }
                    }


                    ?>
			</div>
		</div>
	</div>
</div>
<!-- footer section-->
    <footer class="ht-footer">
        <div class="container">
            <div class="flex-parent-ft">
                <div class="flex-child-ft item1">
                    <a href="home.php"><img class="logo" src="images/logo3.png" alt="" width="200px"></a>
                    <p>brazia beside romi construction plant<br>
                    <p>Call us: <a href="#">+963957275976</a></p>
                </div>
                <div class="flex-child-ft item2">
                    <h4>if you want</h4>

                    <ul>
                        <li><a href="home.php">home</a></li>
                        <li><a href="watchlist.php">Watchlist</a></li>
                    </ul>
                </div>

                <div class="flex-child-ft item3">
                    <?php
                    if($_SESSION['person']['name']=="abdullah_alawad_"){
                        ?>
                        <h4>admin choices</h4>
                        <ul>
                            <li><a href="admin_add.php">add movie</a></li>
                            <li><a href="admin_delet.php">delete movie</a></li>
                            <li><a href="admin_modify.php">update movie</a></li>
                        </ul>
                    <?php } ?>
                </div>
                <div class="flex-child-ft item4">

                </div>
                <div class="flex-child-ft item5">

                </div>
            </div>
        </div>
        <div class="ft-copyright">
            <div class="ft-left">
            </div>
            <div class="backtotop">
            </div>
        </div>
    </footer>
    <!-- end of footer section-->

    <script src="js/jquery.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/plugins2.js"></script>
    <script src="js/custom.js"></script>
</body>

<!-- moviegridfw07:38-->
</html>