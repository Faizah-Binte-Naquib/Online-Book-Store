<?php

	session_start();
	unset($_SESSION['rent_qty_array'][$key]);

	if(isset($_POST['save'])){
		foreach($_POST['indexes_rent'] as $key){
			$_SESSION['rent_qty_array'][$key] = $_POST['qty_'.$key];
		
			echo $_SESSION['rent_qty_array'][$key];
		}


	$_SESSION['message'] = 'Cart updated successfully';

	header('location: view_cart.php');
	exit();



	}
?>
