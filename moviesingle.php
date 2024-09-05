<?php
session_start();
error_reporting(E_ERROR | E_PARSE);
include 'connection.php';
$pr_name=$_SESSION['person']['name'];
$mv_name=$_GET['movie_name'];
$see ="SELECT person_name FROM reviews WHERE person_name='$pr_name'&&movie_name='$mv_name'";
$see2 =$conn->query($see);
$var=0;
foreach ($see2 as $item) {
    foreach ($item as $item2) {

        if ($item2 == $pr_name) $var = 1;
    }
}
//include 'home.php';
$x=$_GET['movie_name'];
$see="SELECT * FROM movie WHERE name='$x'";
$data=$conn->query($see);
$inf=[];
$cnt=1;
$ind=0;
foreach ($data as $val)
{
    if($cnt&1)
        $inf[$ind++]=$val;
    $cnt++;
}
$error1="";
$error2="";
$person_name=$_SESSION['person']['name'];
$movie_name=$_GET['movie_name'];
if(isset($_GET['movie_rate']))
{
    $rate=$_GET['movie_rate'];
    $stm = "SELECT person_name,movie_name FROM rate WHERE person_name ='$person_name' and movie_name='$movie_name'";
    $q = $conn->prepare($stm);
    $q->execute();
    $data = $q->fetch();
    // var_dump($data);
    if($data)
        $error1="you already rate this movie";

    if(empty($error1)) {
        $stm = "INSERT INTO rate values ('$person_name','$movie_name','$rate')";
        $conn->query($stm);
        $sl = "UPDATE movie SET rate_cnt=rate_cnt+1,rate_sum=rate_sum+'$rate' WHERE name='$mv_name'";
        $conn->query($sl);
        // $_GET['movie_name']=$inf[0][0];
    }

}
if(isset($_GET['watchlist']))
{
    $stm = "SELECT person_name,movie_name FROM watchlist WHERE person_name ='$person_name' and movie_name='$movie_name'";
    $q = $conn->prepare($stm);
    $q->execute();
    $data = $q->fetch();
    if($data)
        $error2="you already add this movie";
    if(empty($error2)) {
        $stm = "INSERT INTO watchlist values ('$person_name','$movie_name')";
        $conn->query($stm);
        // $_GET['movie_name']=$inf[0][0];
    }

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

<!-- moviesingle07:38-->
<head>
	<!-- Basic need -->
	<title>syrbest</title>
	<link rel="shortcut icon" href="./images/favicon.ico" type="image/png">
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<link rel="profile" href="#">
<!--    <link rel="stylesheet" href="style_login.css">-->
    <?php
    if(!empty($errors))
    {?>
        <style>.error{display: block}</style><?php
    }
    ?>
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

<div class="hero mv-single-hero">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

			</div>
		</div>
	</div>
</div>
<div class="page-single movie-single movie_single">
	<div class="container">
		<form class="row ipad-width2" >
			<div class="col-md-4 col-sm-12 col-xs-12">
				<div class="movie-img sticky-sb">
					<img src="images/<?=$inf[0][1];?>" alt="">
					<div class="movie-btn">	
						<div class="btn-transform transform-vertical red">
							<div><a href="#" class="item item-1 redbtn"> <i class="ion-play"></i> Watch movie</a></div>
							<div><a href="https://www.youtube.com/embed/o-0hcF97wy0" class="item item-2 redbtn fancybox-media hvr-grow"><i class="ion-play"></i></a></div>
						</div>

					</div>
				</div>
			</div>
			<div class="col-md-8 col-sm-12 col-xs-12">
				<div class="movie-single-ct main-content">
					<h1 class="bd-hd"><?=$inf[0][0];?> <span><?=$inf[0][2]?></span></h1>
                    <p>
                        <?php
                        $see="SELECT * FROM tags WHERE movie_name='$x'";
                        $data=$conn->query($see);
                        $tg=[];
                        $cnt=1;
                        $ind=0;
                        foreach ($data as $item) {
                            foreach ($item as $val) {
                                if ($cnt==3) {
                                    $tg[$ind++] = $val;
                                    break;
                                }
                                $cnt++;
                            }
                            $cnt=1;
                        }
                        foreach ($tg as $item) {
                            ?>
                            <span class="rv"><?php echo '#'.$item; ?></span>
                            <?php
                        }
                        ?></p>
					<div class="social-btn">

				    <button class="parent-btn" name="watchlist" style="background: transparent;
                                                      outline: none;border: none;
                                                       color: #fff;
                                                        letter-spacing: 1px;
                                                         font-size: 1em;"   ><i class="ion-heart""></i> Add to watchlist</button>
					</div>
                    <p class="error" ">
                        <?php
                        echo $error2;
                        ?>
                    </p>
					<div class="movie-rate">
						<div class="rate">
							<i class="ion-android-star"></i>
                            <p><span><?php if($inf[0][4]!=0){ echo $inf[0][5]/$inf[0][4];}else echo 0; ?></span> /5<br>
								<span class="rv"><?php
                                    $see="SELECT COUNT(movie_name) FROM reviews WHERE movie_name='$mv_name'";
                                    $coun=$conn->query($see);
                                    $x;
                                    foreach ($coun as $val)
                                    {
                                        foreach ($val as $val1)
                                        {
                                            $x=$val1;
                                            echo $val1;break;
                                        }
                                        break;
                                    }
                                    ?>
                                    Reviews</span>
							</p>
						</div>

                        <form class="rate-star" style="margin-left: 20px;" action="moviesingle.php" method="post">
                            <p>rate this movie :<input type="range" min="0" max="5" step="1" value="0" name="movie_rate" /></p>
                            <input type="submit" style="background: #0066A2;color: white;" >
                            <input name="movie_name" type="hidden" value="<?php echo isset($inf[0][0]) ? htmlspecialchars($inf[0][0], ENT_QUOTES) : ''; ?>"   >
                            <p class="error">
                                <?php
                                echo $error1;
                                ?>
                            </p>
                        </form>
						<form class="rate-star">

                            <?php
                            $x = "SELECT rate FROM rate WHERE person_name ='$person_name' and movie_name='$movie_name'";
                            $see=$conn->query($x);
                            $num="";
                            foreach($see as $v1){
                                foreach ($v1 as $v2) {
                                    $num=$v2;break;
                                }
                                break;
                            }
                            for($i=0;$i<$num;$i++){
                            ?>
							<i class="ion-ios-star"></i><?php } ?>
                            <?php for($i=$num;$i<5;$i++){?>
							<i class="ion-ios-star-outline"></i><?php }?>
        </form>
    </div>
    <div class="movie-tabs">
        <div class="tabs">
            <ul class="tab-links tabs-mv">
                <li class="active"><a href="#overview">Overview</a></li>
								<li><a href="#reviews"> Reviews</a></li>
                <?php if(!$var){ ?><li><a href="#cast">  Write Reviews </a></li><?php } ?>

							</ul>
						    <div class="tab-content">
						        <div id="overview" class="tab active">
						            <div class="row">
						            	<div class="col-md-8 col-sm-12 col-xs-12">
                                            <p><?php echo $inf[0][3]; ?></p>


											<!-- movie user review -->
											<div class="mv-user-review-item">

											</div>
						            	</div>
						            	<div class="col-md-4 col-xs-12 col-sm-12">

						            	</div>
						            </div>
						        </div>
                                <div id="reviews" class="tab review">
                                    <div class="row">
                                        <div class="rv-hd">
                                            <div class="div">
                                                <!-- <h3>Related Movies To</h3> -->
                                                <h2><?php echo $movie_name; ?></h2>
                                            </div>
                                            <!--							            	<a href="#" class="redbtn">Write Review</a>-->
                                        </div>
                                        <?php
                                        $sql1 ="SELECT * FROM reviews WHERE movie_name='$mv_name'";
                                        $see1 =$conn->query($sql1);

                                        foreach ($see1 as $item) {
                                            $cnt=1;
                                            $rev=[];
                                            $indx=0;
                                            foreach ($item as $v2) {
                                                if ($cnt & 1)
                                                    $rev[$indx++] = $v2;
                                                $cnt++;
                                            }
                                            $sql2="SELECT * FROM person WHERE name='$rev[0]'";
                                            $see2=$conn->query($sql2);
                                            $cnt=1;
                                            $indx=0;
                                            $pr=[];
                                            foreach ($see2 as $item) {
                                                foreach ($item as $v2) {
                                                    if ($cnt & 1)
                                                        $pr[$indx++] = $v2;
                                                    $cnt++;
                                                }
                                            }
                                            $sql3="SELECT * FROM rate WHERE person_name='$rev[0]'&& movie_name='$rev[1]'";
                                            $see3=$conn->query($sql3);
                                            $cnt=1;
                                            $indx=0;
                                            $rt=[];
                                            $rt[2]=0;
                                            foreach ($see3 as $item) {
                                                foreach ($item as $v2) {
                                                    if ($cnt & 1)
                                                        $rt[$indx++] = $v2;
                                                    $cnt++;
                                                }
                                            }
                                            ?>

                                            <div class="mv-user-review-item">
                                                <div class="user-infor">
                                                    <img src="images/<?php echo $pr[3]; ?>" alt="">
                                                    <div>
                                                        <h3><?php echo $pr[0]; ?></h3>
                                                        <div class="no-star">
                                                            <p class="rate"><i class="ion-andro id-star"></i><span> pesonal rate :<?php echo "$rt[2]"; ?></span> / 5</p>
                                                        </div>
                                                        <p class="time">
                                                            <?php echo $rev[3]; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <p><?php echo $rev[2]; ?></p>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div id="cast" class="tab">
                                    <div class="row">
                                        <?php
                                        $rev1=$_POST['comments'];
                                        $date=date('20y-m-d');
                                        if(!$var)
                                        {
                                            ?>
                                            <form action="#" class="user" method="post" enctype="multipart/form-data">
                                                <h3>WRITE YOUR REVIEWS</h3>
                                                <textarea class="form-style-1 user-pro" name="comments" rows="5" cols="100" name="comments" id="comments" minlength="1" maxlength="10000"></textarea><br>
                                                <div class="col-md-2"><input class="redbtn" type="submit" name="submit" value="save"></div>
                                            </form>
                                            <?php
                                            if($_POST['submit']) {
                                                $sql="INSERT INTO reviews values('$pr_name','$mv_name','$rev1','$date')";
                                                $conn->query($sql);
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div id="media" class="tab">
                                    <div class="row">
                                        <div class="rv-hd">
                                            <div>
                                                <h3>Videos & Photos of</h3>
                                                <h2>Skyfall: Quantum of Spectre</h2>
                                            </div>
                                        </div>
                                        <div class="title-hd-sm">
                                            <h4>Videos <span>(8)</span></h4>
                                        </div>
                                        <div class="mvsingle-item media-item">
                                            <div class="vd-item">
                                                <div class="vd-it">
                                                    <img class="vd-img" src="images/uploads/vd-item1.jpg" alt="">
                                                    <a class="fancybox-media hvr-grow"  href="https://www.youtube.com/embed/o-0hcF97wy0"><img src="images/uploads/play-vd.png" alt=""></a>
                                                </div>
                                                <div class="vd-infor">
                                                    <h6> <a href="#">Trailer:  Watch New Scenes</a></h6>
                                                    <p class="time"> 1: 31</p>
                                                </div>
                                            </div>
                                            <div class="vd-item">
                                                <div class="vd-it">
                                                    <img class="vd-img" src="images/uploads/vd-item2.jpg" alt="">
                                                    <a class="fancybox-media hvr-grow" href="https://www.youtube.com/embed/o-0hcF97wy0"><img src="images/uploads/play-vd.png" alt=""></a>
                                                </div>
                                                <div class="vd-infor">
                                                    <h6> <a href="#">Featurette: “Avengers Re-Assembled</a></h6>
                                                    <p class="time"> 1: 03</p>
                                                </div>
                                            </div>
                                            <div class="vd-item">
                                                <div class="vd-it">
                                                    <img class="vd-img" src="images/uploads/vd-item3.jpg" alt="">
                                                    <a class="fancybox-media hvr-grow" href="https://www.youtube.com/embed/o-0hcF97wy0"><img src="images/uploads/play-vd.png" alt=""></a>
                                                </div>
                                                <div class="vd-infor">
                                                    <h6> <a href="#">Interview: Robert Downey Jr</a></h6>
                                                    <p class="time"> 3:27</p>
                                                </div>
                                            </div>
                                            <div class="vd-item">
                                                <div class="vd-it">
                                                    <img class="vd-img" src="images/uploads/vd-item4.jpg" alt="">
                                                    <a class="fancybox-media hvr-grow" href="https://www.youtube.com/embed/o-0hcF97wy0"><img src="images/uploads/play-vd.png" alt=""></a>
                                                </div>
                                                <div class="vd-infor">
                                                    <h6> <a href="#">Interview: Scarlett Johansson</a></h6>
                                                    <p class="time"> 3:27</p>
                                                </div>
                                            </div>
                                            <div class="vd-item">
                                                <div class="vd-it">
                                                    <img class="vd-img" src="images/uploads/vd-item1.jpg" alt="">
                                                    <a class="fancybox-media hvr-grow" href="https://www.youtube.com/embed/o-0hcF97wy0"><img src="images/uploads/play-vd.png" alt=""></a>
                                                </div>
                                                <div class="vd-infor">
                                                    <h6> <a href="#">Featurette: Meet Quicksilver & The Scarlet Witch</a></h6>
                                                    <p class="time"> 1: 31</p>
                                                </div>
                                            </div>
                                            <div class="vd-item">
                                                <div class="vd-it">
                                                    <img class="vd-img" src="images/uploads/vd-item2.jpg" alt="">
                                                    <a class="fancybox-media hvr-grow" href="https://www.youtube.com/embed/o-0hcF97wy0"><img src="images/uploads/play-vd.png" alt=""></a>
                                                </div>
                                                <div class="vd-infor">
                                                    <h6> <a href="#">Interview: Director Joss Whedon</a></h6>
                                                    <p class="time"> 1: 03</p>
                                                </div>
                                            </div>
                                            <div class="vd-item">
                                                <div class="vd-it">
                                                    <img class="vd-img" src="images/uploads/vd-item3.jpg" alt="">
                                                    <a class="fancybox-media hvr-grow" href="https://www.youtube.com/embed/o-0hcF97wy0"><img src="images/uploads/play-vd.png" alt=""></a>
                                                </div>
                                                <div class="vd-infor">
                                                    <h6> <a href="#">Interview: Mark Ruffalo</a></h6>
                                                    <p class="time"> 3:27</p>
                                                </div>
                                            </div>
                                            <div class="vd-item">
                                                <div class="vd-it">
                                                    <img class="vd-img" src="images/uploads/vd-item4.jpg" alt="">
                                                    <a class="fancybox-media hvr-grow" href="https://www.youtube.com/embed/o-0hcF97wy0"><img src="images/uploads/play-vd.png" alt=""></a>
                                                </div>
                                                <div class="vd-infor">
                                                    <h6> <a href="#">Official Trailer #2</a></h6>
                                                    <p class="time"> 3:27</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="title-hd-sm">
                                            <h4>Photos <span> (21)</span></h4>
                                        </div>
                                        <div class="mvsingle-item">
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image11.jpg" ><img src="images/uploads/image1.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery"  href="images/uploads/image21.jpg" ><img src="images/uploads/image2.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image31.jpg" ><img src="images/uploads/image3.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image41.jpg" ><img src="images/uploads/image4.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image51.jpg" ><img src="images/uploads/image5.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image61.jpg" ><img src="images/uploads/image6.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image71.jpg" ><img src="images/uploads/image7.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image81.jpg" ><img src="images/uploads/image8.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image91.jpg" ><img src="images/uploads/image9.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image101.jpg" ><img src="images/uploads/image10.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image111.jpg" ><img src="images/uploads/image1-1.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image121.jpg" ><img src="images/uploads/image12.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image131.jpg" ><img src="images/uploads/image13.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image141.jpg" ><img src="images/uploads/image14.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image151.jpg" ><img src="images/uploads/image15.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image161.jpg" ><img src="images/uploads/image16.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image171.jpg" ><img src="images/uploads/image17.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image181.jpg" ><img src="images/uploads/image18.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image191.jpg" ><img src="images/uploads/image19.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image201.jpg" ><img src="images/uploads/image20.jpg" alt=""></a>
                                            <a class="img-lightbox"  data-fancybox-group="gallery" href="images/uploads/image211.jpg" ><img src="images/uploads/image2-1.jpg" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                                <div id="moviesrelated" class="tab">
                                    <div class="row">
                                        <h3>Related Movies To</h3>
                                        <h2>Skyfall: Quantum of Spectre</h2>
                                        <div class="topbar-filter">
                                            <p>Found <span>12 movies</span> in total</p>
                                            <label>Sort by:</label>
                                            <select>
                                                <option value="popularity">Popularity Descending</option>
                                                <option value="popularity">Popularity Ascending</option>
                                                <option value="rating">Rating Descending</option>
                                                <option value="rating">Rating Ascending</option>
                                                <option value="date">Release date Descending</option>
                                                <option value="date">Release date Ascending</option>
                                            </select>
                                        </div>
                                        <div class="movie-item-style-2">
                                            <img src="images/uploads/mv1.jpg" alt="">
                                            <div class="mv-item-infor">
                                                <h6><a href="#">oblivion <span>(2012)</span></a></h6>
                                                <p class="rate"><i class="ion-android-star"></i><span>8.1</span> /10</p>
                                                <p class="describe">Earth's mightiest heroes must come together and learn to fight as a team if they are to stop the mischievous Loki and his alien army from enslaving humanity...</p>
                                                <p class="run-time"> Run Time: 2h21’    .     <span>MMPA: PG-13 </span>    .     <span>Release: 1 May 2015</span></p>
                                                <p>Director: <a href="#">Joss Whedon</a></p>
                                                <p>Stars: <a href="#">Robert Downey Jr.,</a> <a href="#">Chris Evans,</a> <a href="#">  Chris Hemsworth</a></p>
                                            </div>
                                        </div>
                                        <div class="movie-item-style-2">
                                            <img src="images/uploads/mv2.jpg" alt="">
                                            <div class="mv-item-infor">
                                                <h6><a href="#">into the wild <span>(2014)</span></a></h6>
                                                <p class="rate"><i class="ion-android-star"></i><span>7.8</span> /10</p>
                                                <p class="describe">As Steve Rogers struggles to embrace his role in the modern world, he teams up with a fellow Avenger and S.H.I.E.L.D agent, Black Widow, to battle a new threat...</p>
                                                <p class="run-time"> Run Time: 2h21’    .     <span>MMPA: PG-13 </span>    .     <span>Release: 1 May 2015</span></p>
                                                <p>Director: <a href="#">Anthony Russo,</a><a href="#">Joe Russo</a></p>
                                                <p>Stars: <a href="#">Chris Evans,</a> <a href="#">Samuel L. Jackson,</a> <a href="#">  Scarlett Johansson</a></p>
                                            </div>
                                        </div>
                                        <div class="movie-item-style-2">
                                            <img src="images/uploads/mv3.jpg" alt="">
                                            <div class="mv-item-infor">
                                                <h6><a href="#">blade runner  <span>(2015)</span></a></h6>
                                                <p class="rate"><i class="ion-android-star"></i><span>7.3</span> /10</p>
                                                <p class="describe">Armed with a super-suit with the astonishing ability to shrink in scale but increase in strength, cat burglar Scott Lang must embrace his inner hero and help...</p>
                                                <p class="run-time"> Run Time: 2h21’    .     <span>MMPA: PG-13 </span>    .     <span>Release: 1 May 2015</span></p>
                                                <p>Director: <a href="#">Peyton Reed</a></p>
                                                <p>Stars: <a href="#">Paul Rudd,</a> <a href="#"> Michael Douglas</a></p>
                                            </div>
                                        </div>
                                        <div class="movie-item-style-2">
                                            <img src="images/uploads/mv4.jpg" alt="">
                                            <div class="mv-item-infor">
                                                <h6><a href="#">Mulholland pride<span> (2013)  </span></a></h6>
                                                <p class="rate"><i class="ion-android-star"></i><span>7.2</span> /10</p>
                                                <p class="describe">When Tony Stark's world is torn apart by a formidable terrorist called the Mandarin, he starts an odyssey of rebuilding and retribution.</p>
                                                <p class="run-time"> Run Time: 2h21’    .     <span>MMPA: PG-13 </span>    .     <span>Release: 1 May 2015</span></p>
                                                <p>Director: <a href="#">Shane Black</a></p>
                                                <p>Stars: <a href="#">Robert Downey Jr., </a> <a href="#">  Guy Pearce,</a><a href="#">Don Cheadle</a></p>
                                            </div>
                                        </div>
                                        <div class="movie-item-style-2">
                                            <img src="images/uploads/mv5.jpg" alt="">
                                            <div class="mv-item-infor">
                                                <h6><a href="#">skyfall: evil of boss<span> (2013)  </span></a></h6>
                                                <p class="rate"><i class="ion-android-star"></i><span>7.0</span> /10</p>
                                                <p class="describe">When Tony Stark's world is torn apart by a formidable terrorist called the Mandarin, he starts an odyssey of rebuilding and retribution.</p>
                                                <p class="run-time"> Run Time: 2h21’    .     <span>MMPA: PG-13 </span>    .     <span>Release: 1 May 2015</span></p>
                                                <p>Director: <a href="#">Alan Taylor</a></p>
                                                <p>Stars: <a href="#">Chris Hemsworth,  </a> <a href="#">  Natalie Portman,</a><a href="#">Tom Hiddleston</a></p>
                                            </div>
                                        </div>
                                        <div class="topbar-filter">
                                            <label>Movies per page:</label>
                                            <select>
                                                <option value="range">5 Movies</option>
                                                <option value="saab">10 Movies</option>
                                            </select>
                                            <div class="pagination2">
                                                <span>Page 1 of 2:</span>
                                                <a class="active" href="#">1</a>
                                                <a href="#">2</a>
                                                <a href="#"><i class="ion-arrow-right-b"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        </div>
    </div>
                </div>
            </div>
        </form>
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

<!-- moviesingle11:03-->
</html>