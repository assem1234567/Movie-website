<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
include 'connection.php';
$name=$_SESSION['person']['name'];
$sql ="SELECT img FROM person WHERE name='$name'";
$see = $conn->query($sql);
$img=NULL;
foreach ($see as $v1)
{
    foreach ($v1 as $v2)
    {
        $img=$v2;
        break;
    }
    break;
}
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

<!-- userprofile14:04-->
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
    <img class="logo" src="images/logo1.png" alt="" width="119" height="58">
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
</header>
<!-- END | Header -->

<div class="hero user-hero">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="hero-ct">
                    <h1><?=$name?>’s profile</h1>
                    <ul class="breadcumb">
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="page-single">
    <div class="container">
        <div class="row ipad-width">
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
                <div class="form-style-1 user-pro" action="#">
                    <form action="#" class="user" method="post" enctype="multipart/form-data">
                        <h4>01. Profile details</h4>
                        <div class="row">
                            <div class="col-md-6 form-it">
                                <label>Username</label><br>
                                <p><?php echo strtoupper($_SESSION['person']['name']); ?></p>
                            </div>
                            <div class="col-md-6 form-it">
                                <label>Email Address</label>
                                <p><?php echo $_SESSION['person']['email']; ?></p>
                            </div>
                        </div>
                        <label>change poster</label><br>
                        <input class="redbtn" type="file" name="img" id="img" style="display: none">
                        <label class="redbtn" for="img">Uploud</label><br><br>
                        <div class="col-md-2">
                            <input class="submit" type="submit" name="submit" value="save">
                        </div>
                    </form>
                    <?php
                    if($_POST['submit']&&$_FILES['img']['name']) {

                        $img_name = $_FILES['img']['name'];
                        $tmp_name = $_FILES['img']['tmp_name'];
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_exlc = strtolower($img_ex);
                        $newimgname = uniqid("IMG-", true) . '.' . $img_exlc;
                        $imguploudpath = 'images/' . $newimgname;
                        move_uploaded_file($tmp_name, $imguploudpath);
                        //$name=$_SESSION['person']['name'];
                        $up = "UPDATE person SET img='$newimgname' WHERE name='$name'";
                        $conn->query($up);
                    }
                    ?>
                    <?php
                        if(isset($_POST['password']))
                        {
                            $stm="SELECT * FROM person WHERE name='$name'";
                            $q=$conn->prepare($stm);
                            $q->execute();
                            $data=$q->fetch();
                            $error="";
                            $oldpassword=filter_var($_POST['oldpassword'], FILTER_SANITIZE_STRING);
                            $newpassword=filter_var($_POST['newpassword'], FILTER_SANITIZE_STRING);
                            $renewpassword=filter_var($_POST['renewpassword'], FILTER_SANITIZE_STRING);
                            if($oldpassword!==$data['password_hash']) {
                                $error="please write your correct password";
                            }
                            else if($newpassword !== $renewpassword)
                                $error="password must match";
                            else
                            {
                                $sql="UPDATE person SET password_hash='$newpassword' WHERE name='$name'";
                                $conn->query($sql);
                            }

                        }
                    ?>
                    <form action="userprofile.php" method="post" class="password">
                        <h4>02. Change password</h4>
                        <div class="row">
                            <div class="col-md-6 form-it">
                                <label>Old Password</label>
                                <input type="text" name="oldpassword">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-it">
                                <label>New Password</label>
                                <input type="text"  name="newpassword">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 form-it">
                                <label>Confirm New Password</label>
                                <input type="text" name="renewpassword">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <input class="submit" type="submit" value="change" name="password">
                            </div>
                        </div>
                    </form>

                </div>
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

<!-- userprofile14:04-->
</html>