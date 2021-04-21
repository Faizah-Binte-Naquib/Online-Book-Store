<?php
	session_start();
	$_SESSION['in_rent'] = 0;
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

	<?php include "header.php";?>




    	<!-- checkout section  -->
    	<section class="checkout-section spad">
    		<div class="container">
    			<div class="row">
    				<div class="col-lg-8 order-2 order-lg-1">
    					<form class="checkout-form" action="update_customer_info.php" method="post">
    						<div class="cf-title">Billing Address</div>

    						<div class="row address-inputs">
                  <?php


									if(isset($_SESSION['login_user'])){



									$sql= "Select * from customer where Customer_ID='".$_SESSION['login_user']."' AND Customer_address IS NOT NULL AND Customer_university IS NOT NULL";
									$result = mysqli_query($db,$sql);
									$count=mysqli_fetch_array($result);

									if (!$count) {

									 ?>
    							<div class="col-md-12">
    								<input type="text" placeholder="Address" name="address">
    							</div>
    							<div class="col-md-12">
    								<input type="text" placeholder="Phone no." name="phone">
    							</div>
								<?php
									$sql="Select * from university where status like 'TRUE'";
									$result=mysqli_query($db,$sql);
									$row_number=mysqli_num_rows($result);
									?>
									<div class="col-md-12">
                   <select name="university" style="width:100%;font:Arial;color:gray;border-radius: 25px;border: 2px solid grey;padding: 10px;height: 50px;">
										 <?php if($row_number!=0){
 											while ($row =mysqli_fetch_array($result)) {
 												// code...
 										?>
									 <option value="<?php echo $row['University_ID']; ?>"><?php echo $row['University_Name'] ?></option>
								 <?php }}?>
                  </select>

								</div>
								<div class="col-md-12">
									<form class="" action="" method="post">
	     						<input class="site-btn submit-order-btn" style="margin-top:50px;" name="submit" type="submit" value="Save Changes"/>
	     					</form>
								</div>

							<?php }
								else {
									$sql= "Select * from customer where Customer_ID='".$_SESSION['login_user']."'";
									$result = mysqli_query($db,$sql);
									if ($result) {
									while ($row=mysqli_fetch_array($result)) {
									  ?>
										<?php if(!isset($_GET['change'])||$_GET['change']!=1){?>
										<div class="col-md-12">
											<h5> <b>Address</b>: <?php echo $row['Customer_address'];?></h5><a href="checkout.php?change=1">change</a>
										</div><?php }?>
											<?php if(isset($_GET['change'])){
												if($_GET['change']==1)
												{?>
													<form action="update_customer_info.php" method="post">
													<div class="col-md-12">
														<div class="col-md-8">
														<input type="text" placeholder="Address" name="address">
													  </div>
														<div class="col-md-4">
														<input type="submit" name="submit_address" value="change" style="padding:5px;margin-top:5px;">
													  </div>
													</div>
												</form>
											<?php	}
											}?>

										<div class="col-md-6">
											<h5> <b> Email Address</b>: <?php echo $row['Customer_email'];?></h5>
										</div>
                    <?php if(!isset($_GET['change'])||$_GET['change']!=2){?>
										<div class="col-md-6">
											<h5><b>Phone Number</b>: <?php echo $row['Customer_phone'];?></h5><a href="checkout.php?change=2">change</a>
										</div>
										<?php } ?>
										<?php
										if(isset($_GET['change']))
										{
											if($_GET['change']==2)
											{?>
												<form action="update_customer_info.php" method="post">
												<div class="col-md-6">
													<div class="col-md-5">
													<input type="text" placeholder="Phone Number" name="phone">
													</div>
													<div class="col-md-1">
													<input type="submit" name="submit_phone" value="change" style="padding:5px;margin-top:5px;">
													</div>
												</div>
											</form>
										<?php	}
										}
										if(isset($_SESSION['phone_message'])){
											if($_SESSION['phone_message']==1){
										  echo "<script type='text/javascript'>alert('The phone number you have entered is invalid!');</script>";
											$_SESSION['phone_message']=0;
									     }
									  }
										?>
										<?php if(!isset($_GET['change'])||$_GET['change']!=3){?>
										<div class="col-md-12">
											<h5> <b>University</b>: <?php $sql= "select * from university where University_ID='".$row['Customer_university']."'";
											$result2=mysqli_query($db,$sql);
											while (($university_name=mysqli_fetch_array($result2))) {
												echo $university_name['University_Name'];
											}?></h5><a href="checkout.php?change=3">change</a>
										</div>
									<?php } ?>
										<?php
										if(isset($_GET['change']))
										{
											if($_GET['change']==3)
											{?>

												<form action="update_customer_info.php" method="post">
													<?php
														$sql="Select * from university where status like 'TRUE'";
														$result=mysqli_query($db,$sql);
														$row_number=mysqli_num_rows($result);
														?>
														<div class="col-md-12">
															<div class="col-md-10">
					                   <select name="university" style="width:100%;font:Arial;color:gray;border-radius: 25px;border: 2px solid grey;padding: 10px;height: 50px;margin-top:20px;margin-left:-20px;">
															 <?php if($row_number!=0){
					 											while ($row =mysqli_fetch_array($result)) {
					 												// code...
					 										?>
														 <option value="<?php echo $row['University_ID']; ?>"><?php echo $row['University_Name'] ?></option>
													 <?php }}?>
												 </select></div>
														<div class="col-md-2">
															<input type="submit" name="submit_university" value="change" style="padding:5px;margin-top:25px;">
														</div>

													</div>
											</form>

								<?php
							}}
									}
									}
								}
							}
							?>
    						</div>



    						<div class="cf-title">Payment</div>
                <div class="col-md-6">
                <h5>Cash on Delivery</h5>
                </div>
<br><br><br><br><br><br><br><br>
<?php if(!empty($_SESSION['cart'])){?>
								<a href="checkoutphp.php" class="site-btn submit-order-btn">Place Order</a>
<?php }?>
    				</div>


    				<div class="col-lg-4 order-1 order-lg-2">
    					<div class="checkout-cart">
    						<h3>Your Cart</h3>
    						<ul class="product-list">
									<?php
										//initialize total
										$total = 0;
										if(!empty($_SESSION['cart'])){
										//connection
										//$conn = new mysqli('localhost', 'root', '', 'boi prokousholi draft');
										//create array of initail qty which is 1
				 						$index = 0;
				 						if(!isset($_SESSION['qty_array'])){
				 							$_SESSION['qty_array'] = array_fill(0, count($_SESSION['cart']), 1);
				 						}
										$sql = "SELECT * FROM books WHERE BookID IN (".implode(',',$_SESSION['cart']).")";
										$query = mysqli_query($db,$sql);
											while($row = $query->fetch_assoc()){
												$sql2="Select DiscountPercentage from books where BookID='".$row['BookID']."'AND DiscountPercentage!=0";
												$query2=mysqli_query($db,$sql2);
												while($row2=$query2->fetch_assoc()){
													$discount=$row2['DiscountPercentage'];
												}

												?>
    							<li>
    								<div class="pl-thumb"><img src="img/product/<?php echo $row['BookImage']?>" alt=""></div>
    								<h6><?php echo $row['BookName']?></h6>
    								<p><?php //echo number_format($row['BookPrice'], 2); ?></p>
										<p><?php
										if($row['DiscountPercentage']!=0)
										{
											$price= $row["BookPrice"]-($row["BookPrice"]*($row['DiscountPercentage']/100));
										}
										else {
												$price=$row['BookPrice'];
										}
										echo number_format($_SESSION['qty_array'][$index] * $price, 1); ?></p>
    							</li>
								<?php $index ++;} }
								else {

								}?>
    						</ul>
    						<ul class="price-list">
									<?php if(isset($_SESSION['total'])){?>
    							<li>Total<span>৳<?php if(isset($_SESSION['total'])){ echo $_SESSION['total'];}?></span></li>
    							<li>Shipping<span>৳30</span></li>
    							<li class="total">Total<span>৳<?php echo $_SESSION['total']+30?></span></li>

									<?php
									$_SESSION['checkout_amount']= $_SESSION['total']+30;
								}else {
									echo 'YOUR CART IS EMPTY';
								}
									?>
    						</ul>
    					</div>
    				</div>
    			</div>
    		</div>
    	</section>
    	<!-- checkout section end -->


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
