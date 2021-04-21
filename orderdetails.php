<?php
if (!isset($_SESSION)) session_start();
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

<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Order ID</th>
      <th scope="col">Order Number</th>
      <th scope="col">Order</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>

    <?php
    $query="SELECT * from buys where Customer_ID='".$_SESSION['login_user']."'";
    $result = mysqli_query($db,$query);
    $row_number=mysqli_num_rows($result);?>
    <?php
    if ($row_number>0) {
    while ($item =mysqli_fetch_array($result)) {
    ?>
    <tr>
      <th scope="row"><?php echo $item['Order_ID']; ?></th>
      <td><?php echo $item['Order_Number'];?></td>
      <?php $sql="Select * from books where BookID='".$item['BookID']."'"; $query1=mysqli_query($db,$sql);
      if($result){
        while ($book=mysqli_fetch_array($query1)) {
          // code...
        ?>
      <td><?php echo $book['BookName'];?></td>
      <td><?php
      if($book['DiscountPercentage'])
      {
        $price= ($book['BookPrice']-($book['BookPrice']*($book['DiscountPercentage']/100)))*$item['Quantity'];
        echo  $price;
      }
      else {
        echo $book['BookPrice']*$item['Quantity'];
      }

      ?></td>

    <?php }
  }?>
      <td><?php echo $item['Quantity'];?></td>
      <td><?php if($item['Status']==0){?> <div style="color:red"><?php echo 'ORDER PENDING';} else {?></div><div style="color:green"><?php echo 'ORDER RECIEVED';}?></div></td>
    </tr>
  <?php }
        }?>
  </tbody>
</table>

<br><br>


<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">Rent ID</th>
      <th scope="col">Rent Number</th>
      <th scope="col">Order</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
			<th scope="col">Rented Date</th>
			<th scope="col">Return Date</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>

    <?php
    $query="SELECT * from rents where Customer_ID='".$_SESSION['login_user']."'";
    $result = mysqli_query($db,$query);
    $row_number=mysqli_num_rows($result);?>
    <?php
    if ($row_number>0) {
    while ($item =mysqli_fetch_array($result)) {
    ?>
    <tr>
      <th scope="row"><?php echo $item['Rent_ID']; ?></th>
      <td><?php echo $item['Rent_Number'];?></td>
      <?php $sql="Select * from books where BookID='".$item['Book_ID']."'"; $query1=mysqli_query($db,$sql);
      if($result){
        while ($book=mysqli_fetch_array($query1)) {
          // code...
        ?>
      <td><?php echo $book['BookName'];?></td>
      <td><?php
        echo $book['BookPrice']*$item['Quantity'];
      ?></td>

    <?php }
  }?>
      <td><?php echo $item['Quantity'];?></td>
			<td><?php echo $item['Rent_Date'];?></td>
			<td><?php echo $item['Rent_Return_Date'];?></td>
      <td><?php if($item['Status']==0){?> <div style="color:red"><?php echo 'PENDING';} else {?></div><div style="color:green"><?php echo 'SUBMITTED';}?></div></td>
    </tr>
  <?php }
        }?>
  </tbody>
</table>

<?php include "footer.php";?>

</body>
</html>
