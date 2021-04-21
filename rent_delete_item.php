<?php
	session_start();

	//remove the id from our cart array
	$key = array_search($_GET['id'], $_SESSION['rent']);
	unset($_SESSION['rent'][$key]);

	unset($_SESSION['rent_qty_array'][$_GET['index']]);
	//rearrange array after unset
	$_SESSION['rent_qty_array'] = array_values($_SESSION['rent_qty_array']);

	$_SESSION['message'] = "Product deleted from cart";
	header('location: view_cart.php');
?>
