<?php session_start(); ?>

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


  <!-- Page info -->
  	<div class="page-top-info">
  		<div class="container">
  			<h4>Blog</h4>
  			<div class="site-pagination">
  				<a href="index.php">Home</a> /
  				<a href="blog.php">Blog</a>
  			</div>
  		</div>
  	</div>
  	<!-- Page info end -->


<div class="row">
<?php include_once('config.php');?>
<?php
   $query="SELECT * from blog";
	 $result = mysqli_query($db,$query);

   if($result){
		 while($row=mysqli_fetch_array($result)){
?>
  <div class="col-md-4">
    <div class="blog-card" style="height:auto;padding:2px;">
      <img src="img/blog/<?php echo $row['Blog_Image'];?>"/>
      <div class="col-md-4">
        <div class="blog-date" style="width:80px;">
          <h5 style="padding:4%;width:100px;"><?php echo $row['Blog_Date'];?></h5>
        </div>
      </div>
      <div class="title">
        <h4><?php echo $row['Blog_Title']?></h4>
      </div>
      <div class="details">
				<p style="padding:3px;">
					<?php
					$firstdesc=substr($row['Blog_Description'], 0, 160);
					echo $firstdesc;
					if(isset($_POST['myBtn_'.$row['Blog_ID']]))
					{
						echo $row['Blog_Description'];
					}
					?>
				</p>
      </div>
			<form action='blog.php' method="post">
			<?php if(!isset($_POST['myBtn_'.$row['Blog_ID']])){ ?>
      <button class="button" name="myBtn_<?php echo $row['Blog_ID'];?>">Read More</button>
		<?php }?>
		</form>
	    </div>
  </div>
<?php }
}?>

</div>


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
