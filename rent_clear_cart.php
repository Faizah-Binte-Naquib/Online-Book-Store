<?php
	session_start();
	unset($_SESSION['rent']);
	$_SESSION['message'] = 'Rent Cart cleared successfully';
	header('location: view_cart.php');
?>
