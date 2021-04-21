<?php
session_start();
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$message = $_POST['message'];
include('config.php');


$name = mysqli_real_escape_string($db, $_POST['name']);
$email= mysqli_real_escape_string($db, $_POST['email']);
$phone= mysqli_real_escape_string($db, $_POST['phone']);
$message= mysqli_real_escape_string($db, $_POST['message']);



$sql ="INSERT INTO contact(Contact_name,Contact_email,Contact_phone,Message) VALUES ('".$name."', '".$email."', '".$phone."', '".$message."')";


$result = mysqli_query($db,$sql);
mysqli_close($db);

$_SESSION['complain_sent']='Your complaint has been sent to the admin! They will contact you as soon as possible';
header('location:contact.php');
?>
