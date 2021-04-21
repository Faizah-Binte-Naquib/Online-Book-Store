<?php
	session_start();



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Allerta+Stencil">
	<title>Simple Shopping Cart using Session in PHP</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

	<style>
  .w3-allerta {
		color: white;
  font-family: "Allerta Stencil", Sans-serif;
  }
  </style>
</head>
<body>


<?php include "header.php";?>


<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<?php
			if(isset($_SESSION['qty_array'][0]));
			if(isset($_SESSION['rent_qty_array'][0]));
			if(isset($_SESSION['rent_month'][0]));
			if(isset($_SESSION['message'])){
				?>
				<div class="alert alert-info text-center">
					<?php echo $_SESSION['message']; ?>
				</div>
				<?php
				unset($_SESSION['message']);
			}

			?>
      </br>
			<div class="w3-container w3-black w3-center w3-allerta">
			  <p class="w3-xlarge">PRODUCTS FOR BUY</p>
			</div>

			<form method="POST" action="save_cart.php">
			<table class="table table-bordered table-striped">
				<thead>
					<th></th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal</th>
				</thead>
				<tbody>
					<?php
					if(isset($_SESSION['qty_array'][0]));
						//initialize total
						$total = 0;
						if(!empty($_SESSION['cart'])){
						//connection
						$conn = new mysqli('localhost', 'root', '', 'boi prokousholi draft');
						//create array of initail qty which is 1
 						$index = 0;
 						if(!isset($_SESSION['qty_array'])){
 							$_SESSION['qty_array']= array_fill(0, count($_SESSION['cart']), 1);
 						}

						$sql = "SELECT * FROM books WHERE BookID IN (".implode(',',$_SESSION['cart']).")";
						$query = $conn->query($sql);

							while($row = $query->fetch_assoc()){
								?>
								<tr>
									<td>
										<a href="delete_item.php?id=<?php echo $row['BookID']; ?>&index=<?php echo $index; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>

									</td>
									<td><?php echo $row['BookName']; ?></td>
									<td><?php echo number_format($row['BookPrice'], 2); ?></td>
									<input type="hidden" name="indexes[]" value="<?php echo $index; ?>">
									<td><input type="text" class="form-control" value="<?php echo $_SESSION['qty_array'][$index]; ?>" name="qty_<?php echo $index;?>"></td>
									<td><?php $discount=$row['DiscountPercentage'];
									if(isset($discount)||$discount!=0)
									{
										$bookprice=$row['BookPrice']-($row['BookPrice']*($discount/100));
										$discount=0;
									}
									else {
										$bookprice=$row['BookPrice'];
									}
									echo ($_SESSION['qty_array'][$index]*$bookprice);?></td>

									<?php $total += $_SESSION['qty_array'][$index]*$bookprice;
									$_SESSION['total']=$total;
									//echo $_SESSION['total']; ?>
								</tr>
								<?php
								$index ++;
							}
						}
						else{
							?>
							<tr>
								<td colspan="4" class="text-center">No Item in Cart</td>
							</tr>
							<?php
						}

					?>
					<tr>
						<td colspan="4" align="right"><b>Total</b></td>
						<td><b><?php echo number_format($total, 2); ?></b></td>
					</tr>
				</tbody>
			</table>




			<a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
			<button type="submit" class="btn btn-success" name="save" action="save_cart.php">Save Changes</button>
			<a href="clear_cart.php" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Clear Cart</a>
			<a href="<?php if(isset($_SESSION['login_user'])){echo 'checkout.php';}else{echo 'signin.php';}?>" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Checkout</a>
			</form>
		</div>
	</div>


<!--FOR RENT-->


<div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<?php
			if(isset($_SESSION['qty_array'][0]));
			if(isset($_SESSION['rent_qty_array'][0]));
			if(isset($_SESSION['message'])){
				?>
				<div class="alert alert-info text-center">
					<?php echo $_SESSION['message']; ?>
				</div>
				<?php
				unset($_SESSION['message']);
			}

			?>
      </br>
			<div class="w3-container w3-black w3-center w3-allerta">
			  <p class="w3-xlarge">PRODUCTS FOR RENT</p>
			</div>

			<form method="POST" action="rent_save_cart.php">
			<table class="table table-bordered table-striped">
				<thead>
					<th></th>
					<th>Name</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal</th>
					<th>Months</th>
				</thead>
				<tbody>
					<?php
					if(isset($_SESSION['rent_qty_array'][0]));
					if(isset($_SESSION['rent_month'][0]));

						//initialize total
						$total = 0;
						if(!empty($_SESSION['rent'])){
						//connection
						$conn = new mysqli('localhost', 'root', '', 'boi prokousholi draft');
						//create array of initail qty which is 1
 						$index_rent = 0;
 						if(!isset($_SESSION['rent_qty_array'])){
 							$_SESSION['rent_qty_array'] = array_fill(0, count($_SESSION['rent']), 1);
 						}

						if(!isset($_SESSION['rent_month'])){
							$_SESSION['rent_month'] = array_fill(4, count($_SESSION['rent']), 1);
						}


						$sql = "SELECT * FROM books WHERE BookID IN (".implode(',',$_SESSION['rent']).")";
						$query = $conn->query($sql);

							while($row = $query->fetch_assoc()){
								?>
								<tr>
									<td>
										<a href="rent_delete_item.php?id=<?php echo $row['BookID']; ?>&index=<?php echo $index_rent; ?>" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-trash"></span></a>

									</td>
									<input type="hidden" name="indexes_rent[]" value="<?php echo $index_rent; ?>">
									<td><?php echo $row['BookName']; ?></td>
									<td><?php if($_SESSION['rent_month'][$index_rent]==4){echo number_format($row['RentPrice_4'], 2);}
									else {
										echo number_format($row['RentPrice_6'], 2);
									}
									 ?></td>

									<td><input type="text" class="form-control" value="<?php echo $_SESSION['rent_qty_array'][$index_rent]; ?>" name="qty_<?php echo $index_rent;?>"></td>
									<td><?php

									if($_SESSION['rent_month'][$index_rent] == 4){
										$bookprice=$row['RentPrice_4'];
									}
									else {
										$bookprice=$row['RentPrice_6'];
									}

									echo number_format($_SESSION['rent_qty_array'][$index_rent]*$bookprice, 2);?></td>
									<td><?php echo $_SESSION['rent_month'][$index_rent]?></td>

									<?php $total += $_SESSION['rent_qty_array'][$index_rent]*$bookprice;
									$_SESSION['rent_total']=$total;
									//echo $_SESSION['rent_total']=$total; ?>
								</tr>
								<?php
								$index_rent ++;
							}
						}
						else{
							?>
							<tr>
								<td colspan="4" class="text-center">No Item in Cart</td>
							</tr>
							<?php
						}

					?>
					<tr>
						<td colspan="4" align="right"><b>Total</b></td>
						<td><b><?php echo number_format($total, 2); ?></b></td>
					</tr>
				</tbody>
			</table>




			<a href="index.php" class="btn btn-primary"><span class="glyphicon glyphicon-arrow-left"></span> Back</a>
			<button type="submit" class="btn btn-success" name="save" action="save_cart.php">Save Changes</button>
			<a href="rent_clear_cart.php" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Clear Cart</a>
			<a href="<?php if(isset($_SESSION['login_user'])){echo 'rent_checkout.php';}else{echo 'signin.php';}?>" class="btn btn-success"><span class="glyphicon glyphicon-check"></span> Checkout</a>
			</form>
		</div>
	</div>





<?php include "footer.php"?>
</body>
</html>
