<?php
	session_start();

	//check if product is already in the cart
	if(!in_array($_GET['id'], $_SESSION['rent'])){
		array_push($_SESSION['rent'], $_GET['id']);
		$_SESSION['message'] = 'Product added to cart';
	}
	else{
		$_SESSION['message'] = 'Product already in cart';
	}

	if(isset($_POST['submit']))
	{
		echo $_POST['month'];
		if(!in_array($_POST['rent'], $_SESSION['rent_month'])){
			array_push($_SESSION['rent_month'], $_POST['month']);
			//$_SESSION['message'] = 'Product added to cart';
		}
	}


	header('location: view_cart.php');
?>
