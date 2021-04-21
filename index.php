<?php
if (!isset($_SESSION)) session_start();
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




<?php include "header.php";?>

<?php if(isset($_SESSION['just_registered'])){  if($_SESSION['just_registered']=1){echo '<script>alert("LOGIN NOW TO START SHOPPING!")</script>';unset($_SESSION['just_registered']);}} ?>

<div id="carouselExampleInterval" class="carousel slide" data-ride="carousel" style="margin-top:-18px;">
  <div class="carousel-inner">
    <div class="carousel-item active" data-interval="4000">
      <img src="img/slider1.jpg"  class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-interval="4000">
      <img src="img/slider2.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item" data-interval="4000">
      <img src="img/slider3.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>


<!-- Features section -->
<div class="row">
<div class="col-md-2"></div>
<div class="col-md-8 col-sm-2">
<section class="features-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-4 p-0 feature">
        <div class="feature-inner">
          <div class="feature-icon">
            <img src="img/icons/1.png" alt="#">
          </div>
          <h2>Engineering and BBA Books</h2>
        </div>
      </div>
      <div class="col-md-4 p-0 feature">
        <div class="feature-inner">
          <div class="feature-icon">
            <img src="img/icons/2.png" alt="#">
          </div>
          <h2 style="color:white;">Buy/Rent/Lend Services</h2>
        </div>
      </div>
      <div class="col-md-4 p-0 feature">
        <div class="feature-inner">
          <div class="feature-icon">
            <img src="img/icons/3.png" style="padding:20px;" alt="#">
          </div>
          <h2>Fastest Delivery</h2>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
</div>
<!-- Features section end -->



<!--Item slider text-->
<div class="container">
  <div class="row" id="slider-text">
    <div class="col-md-6" >
      <h2 style="color:#282828">BEST SELLERS</h2>
    </div>
  </div>
</div>

<!-- Item slider-->
<div style="background-image: url(img/blackbook.jpg);padding:20px;">
    <div class="container-fluid">

      <?php
        //session_start();
        include_once('config.php');
        $query="SELECT * FROM books where BookID in (Select BookID from buys GROUP by BookID Order By COUNT(BookID) desc)LIMIT 20";
        $result = mysqli_query($db,$query);
        $row_number=mysqli_num_rows($result);
        $i = 0;
      ?>

      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

          <div class="carousel carousel-showmanymoveone slide" id="itemslider">

            <div class="carousel-inner">
              <?php
                if ($row_number>0) {
                  while ($item =mysqli_fetch_array($result)) {
                    $i++;
              ?>
                <div class="item <?php if($i==1)echo 'active';?>">
                  <div class="col-xs-12 col-sm-6 col-md-2">
                    <div class="hovereffect">
                        <a href="#"><img src="img/product/<?php echo $item['BookImage']?>" class="img-fluid" class="img-responsive center-block"></a>
                        <div class="overlay">
                          <a class="info" href="product.php?productid=<?php echo $item['BookID']?>">SEE DETAILS</a>
                          <a class="info" href="add_cart.php?id=<?php echo $item["BookID"]?>">ADD TO CART</a>
                          <a class="info" href="product.php?productid=<?php echo $item['BookID']?>">ADD TO RENT</a>
                        </div>
                    </div>
                    <br>
                    <h4 class="text-center"><?php echo $item['BookName'] ?></h4>
                    <h5 class="text-center"><?php echo $item['BookPrice'] ?></h5>
                  </div>
                </div>
              <?php } ?>
						<?php }else{
							$query="SELECT * FROM books";
							$result = mysqli_query($db,$query);
							while ($item =mysqli_fetch_array($result)) {
								$i++; ?>
							<div class="item <?php if($i==1)echo 'active';?>">
								<div class="col-xs-12 col-sm-6 col-md-2">
									<div class="hovereffect">
											<a href="#"><img src="img/product/<?php echo $item['BookImage']?>" class="img-fluid" class="img-responsive center-block"></a>
											<div class="overlay">
												<a class="info" href="product.php?productid=<?php echo $item['BookID']?>">SEE DETAILS</a>
												<a class="info" href="add_cart.php?id=<?php echo $item["BookID"]?>">ADD TO CART</a>
												<a class="info" href="product.php?productid=<?php echo $item['BookID']?>">ADD TO RENT</a>
											</div>
									</div>
									<br>
									<h4 class="text-center"><?php echo $item['BookName'] ?></h4>
									<h5 class="text-center"><?php echo $item['BookPrice'] ?></h5>
								</div>
							</div><?php }} ?>
            </div>
            <div id="slider-control">
              <a class="left carousel-control" href="#itemslider" data-slide="prev"><img src="https://cdn0.iconfinder.com/data/icons/website-kit-2/512/icon_402-512.png" alt="Left" class="img-responsive"></a>
              <a class="right carousel-control" href="#itemslider" data-slide="next"><img src="http://pixsector.com/cache/81183b13/avcc910c4ee5888b858fe.png" alt="Right" class="img-responsive"></a>
           </div>

          </div>

        </div>

      </div>

    </div>
</div>
<!-- Item slider end-->
<br/><br/>


<!--Item slider text-->
<div class="container">
  <div class="row" id="slider-text">
    <div class="col-md-6" >
      <h2 style="color:#282828">SALE 30% OFF</h2>
    </div>
  </div>
</div>
<!-- Item slider-->
<div style="">
    <div class="container-fluid">

      <?php
        //session_start();
        include_once('config.php');
        $query="SELECT * FROM books where DiscountPercentage=0.3";
        $result = mysqli_query($db,$query);
        $row_number=mysqli_num_rows($result);
        $i = 0;
      ?>

      <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

          <div class="carousel carousel-showmanymoveone slide" id="itemslider2">

            <div class="carousel-inner">
              <?php
                if ($row_number>0) {
                  while ($item =mysqli_fetch_array($result)) {
                    $i++;
              ?>
                <div class="item <?php if($i==1)echo 'active';?>">
                  <div class="col-xs-12 col-sm-6 col-md-2">
                    <div class="hovereffect">
                        <a href="#"><img src="img/product/<?php echo $item['BookImage']?>" class="img-fluid" class="img-responsive center-block"></a>
                        <div class="overlay">
                          <a class="info" href="product.php?productid=<?php echo $item['BookID']?>">SEE DETAILS</a>
                          <a class="info" href="add_cart.php?id=<?php echo $item["BookID"]?>">ADD TO CART</a>
                          <a class="info" href="product.php?productid=<?php echo $item['BookID']?>">ADD TO RENT</a>
                        </div>
                    </div>
                    <br>
                    <h4 class="text-center"><?php echo $item['BookName'] ?></h4>
                    <h5 class="text-center"><?php echo $item['BookPrice'] ?></h5>
                  </div>
                </div>
              <?php } ?>
						<?php }else{
							$query="SELECT * FROM books where DiscountPercentage!=0";
							$result = mysqli_query($db,$query);
							while ($item =mysqli_fetch_array($result)) {
								$i++; ?>
							<div class="item <?php if($i==1)echo 'active';?>">
								<div class="col-xs-12 col-sm-6 col-md-2">
									<div class="hovereffect">
											<a href="#"><img src="img/product/<?php echo $item['BookImage']?>" class="img-fluid" class="img-responsive center-block"></a>
											<div class="overlay">
												<a class="info" href="product.php?productid=<?php echo $item['BookID']?>">SEE DETAILS</a>
												<a class="info" href="add_cart.php?id=<?php echo $item["BookID"]?>">ADD TO CART</a>
												<a class="info" href="product.php?productid=<?php echo $item['BookID']?>">ADD TO RENT</a>
											</div>
									</div>
									<br>
									<h4 class="text-center"><?php echo $item['BookName'] ?></h4>
									<h5 class="text-center"><?php echo $item['BookPrice'] ?></h5>
								</div>
							</div><?php }} ?>
            </div>
            <div id="slider-control2">
              <a class="left carousel-control" href="#itemslider2" data-slide="prev"><img src="https://cdn0.iconfinder.com/data/icons/website-kit-2/512/icon_402-512.png" alt="Left" class="img-responsive"></a>
              <a class="right carousel-control" href="#itemslider2" data-slide="next"><img src="http://pixsector.com/cache/81183b13/avcc910c4ee5888b858fe.png" alt="Right" class="img-responsive"></a>
           </div>

          </div>

        </div>

      </div>

    </div>
</div>
<!-- Item slider end-->
<br/><br/>

<hr>

<div class="row" style="margin-left:90px;">

	<div class="col-md-2" style="border-radius: 25px;">
		<img src="img/bookpile.png" style="padding:30px"/>
		<p  style="padding-left:12px;font-family:Optima, sans-serif;font-size:17px;font-weight:bold;"> Immediate delivery</p>
		<div class="row">
		<div class="col-md-12">
		<p style="font-size:12px">We stock over 10,000+ books for immediate delivery</p>
		</div>
	  </div>
	</div>
<div class="col-md-2"></div>
	<div class="col-md-2" style="border-radius: 25px;">
		<img src="img/mouseclick.png"style="padding:30px"/>
		<p  style="padding-left:12px;font-family:Optima, sans-serif;font-size:17px;font-weight:bold;">Variation of Books</p>
		<div class="row">
		<div class="col-md-12">
	  <p style="font-size:12px"> You get to choose different books from different department</p>
		</div>
	  </div>
	</div>
	<div class="col-md-2"></div>

	<div class="col-md-2" style="border-radius: 25px;">
		<img src="img/search.png"style="padding:30px"/>
		<p  style="padding-left:12px;font-family:Optima, sans-serif;font-size:17px;font-weight:bold;">Find what you need</p>
		<div class="row">
		<div class="col-md-12">
		<p style="font-size:12px"> We will help you to find the exact book you need, which no other book store has </p>
		</div>
		</div>
	</div>
</div>
</br>
<div class="box">
	<div class="row" style="margin-left:60px;">
		<div class="col-md-12" style="height:400px;">
			<div class="col-md-5">
				<img src="img/silhouette-of-man.jpg" style="height:400px;width:600px;"/>
			</div>
			<div class="col-md-6" style="background:#F2F2F2;height:400px;opacity:0.7">
			<div style="padding:20%;">
      <h3 style="font-family:Optima, sans-serif	;">Its more than just a bookstore!</h3>
			<p>buy, rent your own text-books!</p>
    <a href="index.php"><button class="w3-button w3-black w3-border w3-round-large">Browse</button></a>
		</div>
			</div>
		</div>
	</div>
</div>

</br>
<?php include "footer.php";?>


<script type="text/javascript">
  $(document).ready(function(){

  $('#itemslider').carousel({ interval: 4000 });

  $('.carousel-showmanymoveone .item').each(function(){
  var itemToClone = $(this);

  for (var i=1;i<6;i++) {
  itemToClone = itemToClone.next();

  if (!itemToClone.length) {
  itemToClone = $(this).siblings(':first');
  }

  itemToClone.children(':first-child').clone()
  .addClass("cloneditem-"+(i))
  .appendTo($(this));
  }
  });
  });
</script>








<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
