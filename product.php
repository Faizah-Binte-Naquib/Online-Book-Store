
<?php
	session_start();
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
	unset($_SESSION['qty_array']);
	unset($_SESSION['rent_qty_array']);

?>



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

</head>
<body>
	<!--Page Preloder -->
	<div id="preloder">
	<div class="loader"></div>
	</div>

<?php include "header.php";?>


	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Product</h4>
			<div class="site-pagination">
				<a href="index.php">Home</a> /
				<a href="shop.php?department=&category=1">Shop</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->

  <!-- product section -->
	<section class="product-section">
		<div class="container">
			<div class="back-link">
			<!--	<a href="./shop.php"> &lt;&lt; Back to Category</a>-->
			</div>
			<?php
	//	session_start();
	 include_once('config.php');
	 if(isset($_GET["productid"]))
   {
		$id = $_GET["productid"];
   }
	 $query="SELECT * from books where BookID=$id";
	 $result = mysqli_query($db,$query);

	 $row_number=mysqli_num_rows($result);?>
			<div class="row">
				<?php
		    if ($row_number>0) {
			  while ($item =mysqli_fetch_array($result)) {


				?>
				<div class="col-lg-6">
					<div class="product-pic">
						<img class="" src="img/product/<?php echo $item["BookImage"];?>" alt="">
						<?php
						$sql="Select DiscountPercentage from books where BookID='".$item['BookID']."'AND DiscountPercentage!=0";
					  $result2=mysqli_query($db,$sql);
						$row_number2=mysqli_num_rows($result2);
						?>
					</div>
				</div>
				<div class="col-lg-6 product-details">
					<h2 class="p-title"><?php echo $item["BookName"];?></h2>
					<?php
					if($row_number2!=0)
					{
						while ($row =mysqli_fetch_array($result2))
						{
							$price=$item["BookPrice"]-($item["BookPrice"]*($item["DiscountPercentage"]/100));?>

					<h3 class="p-price"><strike>৳<?php echo $item["BookPrice"];?></strike></h3>
					<h3 class="p-price">৳<?php echo $price;?></h3>

				<?php }
			        }
							else {
								?><h3 class="p-price">৳<?php echo $item["BookPrice"];?></h3>
							<?php }?>

					<h4 class="p-stock">Available: <span><?php if($item["BookQuantity"]!=0){echo "In stock";} else echo "Unavailable";?></span></h4>

				  <a href="add_cart.php?id=<?php echo $item["BookID"]?>" class="site-btn">ADD TO CART</a>



					<hr>

					<h3>Rental Information</h3>

					<div class="col-md-12">
						<div class="col-md-3"><h4 class="p-price">৳<?php echo $item['RentPrice_4'];?> /</h4></div>
						<div class="col-md-6" ><h4 class="p-price" style="font-size:15px;padding-top:8px;margin-left:;">4 months</h4></div>
					</div>
					<div class="col-md-12">
						<div class="col-md-3"><h4 class="p-price">৳<?php echo $item['RentPrice_6'];?> /</h4></div>
						<div class="col-md-6" ><h4 class="p-price" style="font-size:15px;padding-top:8px;margin-left:;">6 months</h4></div>
					</div>

					<br>
					<form action="rent_add_cart.php?id=<?php echo $item["BookID"]?>" method="post" style="width:50px;">
					<select name="month" style="width:190px;font:Arial;color:gray;border-radius: 25px;border: 2px solid grey;padding: 10px;height: 50px;">
					<option value="4">4 months</option>
					<option value="6">6 months</option>
					</select>
					<div><br></div>
				  <input type="submit" name="submit" value="RENT NOW" class="site-btn"/></a>
				  </form>

					<div id="accordion" class="accordion-area">
						<div class="panel">
							<div>
								<div class="panel-body">
									<h3>Book Details</h3>
									<p><h5 style="font-weight:bold;">Book Author:</h5> <?php echo $item['BookAuthor'] ?></p>
									<p><h5 style="font-weight:bold;">Book Edition:</h5> <?php echo $item['BookEdition'] ?></p>
								</div>
							</div>
						</div>
					<?php

							}} ?>

					</div>

				</div>
			</div>
		</div>
	</section>
	<!-- product section end -->




	<!--add quantity and product id to cart-->


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
