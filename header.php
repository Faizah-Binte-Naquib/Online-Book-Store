<!DOCTYPE html>
<html lang="zxx">
<head>
	<title></title>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="keywords" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="" rel="shortcut icon"/>

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,300i,400,400i,700,700i" rel="stylesheet">


	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/flaticon.css"/>
	<link rel="stylesheet" href="css/slicknav.min.css"/>
	<link rel="stylesheet" href="css/jquery-ui.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.min.css"/>
	<link rel="stylesheet" href="css/animate.css"/>
	<link rel="stylesheet" href="css/style.css"/>

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300,400,700&subset=latin-ext" rel="stylesheet">




</head>


<body>




<!-- Header section -->
<header class="header-section">
  <div class="header-top">
    <div class="container">
      <div class="row">
				<div class="col-lg-2 text-center text-lg-left">
					<!-- logo -->
					<a href="./index.php" class="site-logo" style="">
						<img src="img/logo.jpg" alt="" style="width:120px;height:90px;border-radius:50%;text-align:center;">
					</a>
				</div>
        <div class="col-lg-2 text-center text-lg-left" style="padding-top:10px;">
            <p style="font-family: times, Times New Roman, times-roman, georgia, serif; font-size: 27px;line-height: 44px;letter-spacing: -2px;font-weight: bold;">Boi Prokousholi</p>
						<p style="font-family: times, Times New Roman, times-roman, georgia, serif; font-size: 15px;line-height: 12px;letter-spacing: -1px;font-weight: bold;">Your Online Store for Books</p>
        </div>
        <div class="col-xl-5 col-lg-5" style="padding:22px;">
          <form class="header-search-form" method="post" action="search.php" style="">
            <input type="text" placeholder="Search on Boi Prokousholi...." name="search">
            <button type="submit"><i class="flaticon-search"></i></button>
          </form>
        </div>


        <div class="col-xl-3 col-lg-5"  style="padding:22px;">
          <div class="user-panel">
            <div class="up-item">
							<div class="dropdown">
              <i class="flaticon-profile"></i>
							<?php
							if(isset($_SESSION['login_user']))
							{
							?><a href="profile.php" class="dropbtn">Profile</a>
							<?php
						}else {
							?>
							<a href="signin.php" class="dropbtn">Sign-In</a>
							<?php
						  }
							?>

							<?php if(isset($_SESSION['login_user'])){?>
							<div class="dropdown-content">
								<?php
								if(!isset($_SESSION))
								{
							  }
							  require_once ('config.php');
								if(empty($_SESSION["login_user"])){
								?>
	            <a href="orderdetails.php">Order Details</a>
	            <a href="profile.php">Login/Security</a>
							<a href="logout.php">Logout</a>
						<?php }else{ ?>
								<a href="profile.php"><?php
								$query="SELECT * from customer where Customer_ID='".$_SESSION["login_user"]."'";

								$result = mysqli_query($db,$query);
								//$row = mysqli_fetch_assoc($result);
								$row_number=mysqli_num_rows($result);
								if($row_number>0){while ($email=mysqli_fetch_array($result)) {echo $email["Customer_email"];}} ?></a>
								<div class="dropdown-divider"></div>
								<a href="orderdetails.php">Order Details</a>
								<a href="profile.php">Login/Security</a>
								<a href="logout.php">Logout</a>
							<?php } ?>
						</div> <?php }?>
						  </div>
            </div>
            <div class="up-item">
              <div class="shopping-card">
                <i class="flaticon-bag"></i>
								<?php
   //	session_start();
	//initialize cart if not set or is unset
	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}
	if(!isset($_SESSION['rent'])){
		$_SESSION['rent'] = array();
	}
	if(!isset($_SESSION['rent_month'])){
		$_SESSION['rent_month'] = array();
	}
	//unset quantity
//	unset($_SESSION['qty_array']);
?>
                <span><?php if(count($_SESSION['cart'])==0 && count($_SESSION['rent'])==0){echo 0;} else echo count($_SESSION['cart'])+count($_SESSION['rent']);?></span>
              </div>
              <a href="view_cart.php">Shopping Cart</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
  <nav class="main-navbar">
    <div class="container">
      <!-- menu -->
      <div class="col-md-2"></div>
      <div class="col-md-8">
      <ul class="main-menu">
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="shop.php?department=&category=">Store</a></li>
        <li><a href="promotion.php">Promotion
        </a></li>
        <li><a href="blog.php">Blog</a>
        </li>
        <li><a href="contact.php">Contact</a>
        </li>
      </ul></div>
    </div>
  </nav>
  </div>
  </div>
</header>
</body>
</html>
