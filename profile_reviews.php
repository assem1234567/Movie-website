<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include 'connection.php';
$pr_name=$_SESSION['person']['name'];
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

<!-- userrate14:04-->
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

<!--end of signup form popup-->

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
</header>
<!-- END | Header -->

<div class="hero user-hero">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="hero-ct">
                    <h1><?php echo $pr_name=$_SESSION['person']['name']; ?></h1>
                    <ul class="breadcumb">

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$name=$_SESSION['person']['name'];
$sql="SELECT img FROM person WHERE name='$name'";
$data=$conn->query($sql);
$img="";
foreach ($data as $v1)
{
    foreach ($v1 as $v2)
    {
        $img=$v2;break;
    }
    break;
}
?>
<div class="page-single">
    <div class="container">
        <div class="row ipad-width2">
            <div class="col-md-3 col-sm-12 col-xs-12">
                <div class="user-information">
                    <div class="user-img">
                        <img src="images/<?php echo $img;?>" alt=""><br>
                    </div>
                    <div class="user-fav">
                        <p>Account Details</p>
                        <ul>
                            <li class="active"><a href="userprofile.php">Profile</a></li>
                            <li><a href="watchlist.php">Watch list</a></li>
                            <li><a href="profile_reviews.php">Reviews</a></li>
                        </ul>
                    </div>
                    <?php
                    if($_SESSION['person']['name']=="abdullah_alawad_")
                    {
                        ?>
                        <div class="user-fav">
                            <p>Others</p>
                            <ul>
                                <li class="active"><a href="admin_add.php">add movie</a></li>
                                <li><a href="admin_delet.php">delet movie</a></li>
                                <li><a href="admin_modify.php">modify movie</a></li>

                            </ul>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-9 col-sm-12 col-xs-12">
                <?php
                $see="SELECT COUNT(movie_name) FROM reviews WHERE person_name='$name'";
                $data=$conn->query($see);
                foreach ($data as $item) {
                    foreach ($item as $item1){
                        $num=$item1;break;
                    }
                    break;
                }
                ?>
                				<div class="topbar-filter">
                					<p>Found <span><?php echo $num; ?> Reviews</span> in total</p>
                				</div>
                <?php
                $see="SELECT * FROM reviews WHERE person_name='$pr_name'";
                $data = $conn->query($see);
                foreach ($data as $v1){
                $cnt=1;
                $inf=[];
                $indx=0;
                foreach ($v1 as $v2) {
                    if ($cnt & 1)
                        $inf[$indx++] = $v2;
                    $cnt++;
                }
                $see ="SELECT * FROM movie WHERE name='$inf[1]'";
                $see2 = $conn->query($see);
                $cnt=1;
                $inf2=[];
                $indx=0;
                foreach ($see2 as $item) {
                    foreach ($item as $v2) {
                        if ($cnt & 1)
                            $inf2[$indx++] = $v2;
                        $cnt++;
                    }
                }

                ?>
                <div class="movie-item-style-2 userrate">
                    <img src="images/<?php echo $inf2[1]; ?>" alt="" img="width:100px;height:100px;background-size:cover;">
                    <div class="mv-item-infor">
                        <h6><a href="#"><?php echo $inf[1]; ?> <span>(<?php echo $inf2[2]; ?>)</span></a></h6>
                        <p class="time sm-text">your rate:</p>
                        <p class="rate"><i class="ion-andro id-star"></i><span><?php if($inf2[4]!=0){ echo $inf2[5]/$inf2[4];}else echo 0; ?></span> /5</p>
                        <p class="time sm-text">your reviews:</p>
                        <h6><?php echo $inf[2]; ?></h6>
                        <p class="time sm"><?php echo $inf[3]; ?></p>
                        <p><?php echo $inf2[3]; ?></p>
                    </div>
                </div>
                <?php
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

<!-- userrate14:04-->
</html>