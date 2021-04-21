<?php session_start();
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
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

<?php include "header.php" ?>

<?php include_once('config.php'); ?>
	<!-- Page info -->
	<div class="page-top-info">
		<div class="container">
			<h4>Shop</h4>
			<div class="site-pagination">
				<a href="index.php">Home</a> /
				<a href="shop.php">Shop</a>
			</div>
		</div>
	</div>
	<!-- Page info end -->

  <!-- Category section -->
	<section class="category-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 order-2 order-lg-1">
					<div class="filter-widget">
						<h2 class="fw-title">Categories</h2>
						<ul class="category-menu">
							<?php
							if(!isset($_SESSION)){
							//session_start();
						}


								$query="SELECT * from category";
								$result = mysqli_query($db,$query);

								$row_number=mysqli_num_rows($result);

								if ($row_number>0) {
									while ($category =mysqli_fetch_array($result)) {



								?>
							<li><h3><a href="shop.php?department=0&category=<?php echo $category['CategoryID'];?>" style="font-weight:bold;"><?php echo $category['CategoryName'];?></a></h3>
								<?php
								$categoryid=$category['CategoryID'];
								$query2="SELECT * from department where CategoryID=$categoryid";
								$result2= mysqli_query($db,$query2);

								$row_number2=mysqli_num_rows($result2);

								if ($row_number2>0) {

								?>
								<ul class="sub-menu">
									<?php while ($department =mysqli_fetch_array($result2)){ ?>
									<li><a href="shop.php?department=<?php echo $department['DepertmentID'];?>&category=<?php echo $category['CategoryID'];?>"><?php echo $department['DepertmentName']; ?></a></li>
								<?php }}?>
								</ul>
							</li>
              </br>

						<?php }}?>

						</ul>
					</div>



<?php


$department_id = $_GET["department"];
$category_id= $_GET["category"];

 ?>

				</div>


				<?php if(!empty($_GET['department'])||!empty($_GET['category'])){?>

				<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
					<?php
					if($department_id==0){
						$query3= "SELECT * from books where BookDepartment IN (SELECT DepertmentID from department where CategoryID=$category_id)";
						$result3 = mysqli_query($db,$query3);

						if($result3){
						$row_number3=mysqli_num_rows($result3);

						if ($row_number3>0) {
					?>
					<div class="row">
						<?php while ($item =mysqli_fetch_array($result3)){ ?>
						<div class="col-lg-4 col-sm-6">
							<div class="product-item">
								<div class="pi-pic">
									<?php if($item['DiscountPercentage']!=0){ ?>
									<div class="tag-sale">ON SALE</div><?php } else{}?>
								<a href="product.php?productid=<?php echo $item['BookID'];?>"><img src="img/product/<?php echo $item['BookImage'];?>" alt=""></a>
									<div class="pi-links">
										<a href="add_cart.php?id=<?php echo $item['BookID'];?>" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
									</div>
								</div>
								<div class="pi-text">
									<?php if($item['DiscountPercentage']!=0){$price=$item["BookPrice"]-($item["BookPrice"]*($item["DiscountPercentage"]/100));}else{$price=$item['BookPrice'];}?>
									<h6><?php echo  '৳'.$price;?></h6>
									<p><?php echo $item['BookName'];?></p>
								</div>
							</div>
						</div>
					<?php }
					?>




						<div class="text-center w-100 pt-3">
							<button class="site-btn sb-line sb-dark">LOAD MORE</button>
						</div>
					</div>
				<?php } }}
				 else if($department_id!=0){
					$query3= "SELECT * from books where BookDepartment=$department_id";
					$result3 = mysqli_query($db,$query3);

					$row_number3=mysqli_num_rows($result3);

					if ($row_number3>0) {
				?>
				<div class="row">
					<?php while ($item =mysqli_fetch_array($result3)){ ?>
					<div class="col-lg-4 col-sm-6">
						<div class="product-item">
							<div class="pi-pic">
								<div class="tag-sale">ON SALE</div>
							<a href="product.php?productid=<?php echo $item['BookID'];?>"><img src="img/product/<?php echo $item['BookImage'];?>" alt=""></a>
								<div class="pi-links">
									<a href="add_cart.php?id=<?php echo $item["BookID"]?>" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
								</div>
							</div>
							<div class="pi-text">
								<?php if($item['DiscountPercentage']!=0){$price=$item["BookPrice"]-($item["BookPrice"]*($item["DiscountPercentage"]/100));}else{$price=$item['BookPrice'];}?>
								<h6><?php echo  '৳'.$price;?></h6>
								<p><?php echo $item['BookName'];?></p>
							</div>
						</div>
					</div>
				<?php } ?>




					<div class="text-center w-100 pt-3">
						<button class="site-btn sb-line sb-dark">LOAD MORE</button>
					</div>
				</div>
				<?php }
			}				 else{
								$query3= "SELECT * from books where BookDepartment=1";
								$result3 = mysqli_query($db,$query3) or die(mysql_error());

								$row_number3=mysqli_num_rows($result3);

								if ($row_number3>0) {

							?>
							<div class="row">
								<?php while ($item =mysqli_fetch_array($result3)){ ?>
								<div class="col-lg-4 col-sm-6">
									<div class="product-item">
										<div class="pi-pic">
											<div class="tag-sale">ON SALE</div>
										<a href="product.php?productid=<?php echo $item['BookID'];?>"><img src="img/product/<?php echo $item['BookImage'];?>" alt=""></a>
											<div class="pi-links">
												<a href="add_cart.php?id=<?php echo $item['BookID'];?>" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
											</div>
										</div>
										<div class="pi-text">
											<?php if($item['DiscountPercentage']!=0){$price=$item["BookPrice"]-($item["BookPrice"]*($item["DiscountPercentage"]/100));}else{$price=$item['BookPrice'];}?>
											<h6><?php echo  '৳'.$price;?></h6>
											<p><?php echo $item['BookPrice'];?></p>
										</div>
									</div>
								</div>
							<?php } ?>

              </div>


								<div class="text-center w-100 pt-3">
									<button class="site-btn sb-line sb-dark">LOAD MORE</button>
								</div>

							<?php }
}}else{?>

	<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
<?php
  $query3= "SELECT * from books";
	$result3 = mysqli_query($db,$query3);

	if($result3){
	$row_number3=mysqli_num_rows($result3);

	if ($row_number3>0) {
?>
<div class="row">
	<?php while ($item =mysqli_fetch_array($result3)){ ?>
	<div class="col-lg-4 col-sm-6">
		<div class="product-item">
			<div class="pi-pic">
				<?php if($item['DiscountPercentage']!=0){ ?>
				<div class="tag-sale">ON SALE</div><?php } else{}?>
			<a href="product.php?productid=<?php echo $item['BookID'];?>"><img src="img/product/<?php echo $item['BookImage'];?>" alt=""></a>
				<div class="pi-links">
					<a href="add_cart.php?id=<?php echo $item['BookID'];?>" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a>
				</div>
			</div>
			<div class="pi-text">
				<?php if($item['DiscountPercentage']!=0){$price=$item["BookPrice"]-($item["BookPrice"]*($item["DiscountPercentage"]/100));}else{$price=$item['BookPrice'];}?>
				<h6><?php echo  '৳'.$price;?></h6>
				<p><?php echo $item['BookName'];?></p>
			</div>
		</div>
	</div>
<?php }
?>




	<div class="text-center w-100 pt-3">
		<button class="site-btn sb-line sb-dark">LOAD MORE</button>
	</div>
</div>
<?php } }?>

<?php }
				?>


				</div>
			</div>
		</div>
	</section>


</br>
</br>
<?php include "footer.php"?>

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
