<?php if (!isset($_SESSION)) session_start();?>
<!DOCTYPE html>
<html lang="">
<head>

	<meta charset="UTF-8">
	<meta name="description" content=" Divisima | eCommerce Template">
	<meta name="keywords" content="divisima, eCommerce, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

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

<style>
.card{
  padding: 10px;
  margin:100px;
  height: auto;
  border: 2px solid red;

}
.img{
  height:200px;
  width:200px;
}
.card-writing{
  padding: 15px;
}
</style>
</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

<?php include('header.php') ?>

	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Promotion</h4>
			<div class="site-pagination">
				<a href="index.php">Home</a> /
				<a href="promotion.php">Promotion</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->
 <?php include_once('config.php');

 $query="SELECT * from promo";
 $result = mysqli_query($db,$query);
 if($result){

 while ($item=mysqli_fetch_array($result)) {

 ?>
<div class="card" style="border: 1px outset gray 0.7;border-radius: 25px;">
  <div class="col-md-8">
  <div class="col-md-3">
  <img src="img/promo/<?php if($item['Promo_Img']!=""){echo $item['Promo_Img'];} else{  echo 'default.png';}?>" class="img"/>
  </div>
  <div class="card-writing">
  <div class="col-md-6">
    <h4><?php echo $item['Promo_Name'];?></h4>
      <p><?php echo $item['Promo_Details'];?></p>
  </div>
  </div>
</div>
</div>
<?php }}?>


<?php
$query="SELECT * from books where DiscountPercentage!=0";
$result = mysqli_query($db,$query);
if($result){

while ($item=mysqli_fetch_array($result)) {

?>
<div class="card" style="border: 1px outset gray 0.7;border-radius: 25px;">
 <div class="col-md-8">
 <div class="col-md-3">
 <img src="img/product/<?php if($item['BookImage']!=""){echo $item['BookImage'];} else{  echo 'default.png';}?>" class="img"/>
 </div>
 <div class="card-writing">
<div class="col-md-6">
<h3 class="p-price">Discount Offer!<p style="color:red;"><?php echo $item['DiscountPercentage']?>% off<p></h3>
<h4><?php echo $item['BookName'];?></h4>
<?php $price=$item["BookPrice"]-($item["BookPrice"]*($item["DiscountPercentage"]/100));?>

<h3 class="p-price"><strike>৳<?php echo $item["BookPrice"];?></strike></h3>
<h3 class="p-price">৳<?php echo $price;?></h3>
 </div>
 </div>
</div>
</div>
<?php }}?>

  </br>
  </br>
  <?php include "footer.php";?>

  	<!--====== Javascripts & Jquery ======-->
  	<script src="js/jquery-3.2.1.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
  	<script src="js/jquery.slicknav.min.js"></script>
  	<script src="js/owl.carousel.min.js"></script>
  	<script src="js/jquery.nicescroll.min.js"></script>
  	<script src="js/jquery.zoom.min.js"></script>
  	<script src="js/jquery-ui.min.js"></script>
  	<script src="js/main.js"></script>

  	</body>
  </html>
