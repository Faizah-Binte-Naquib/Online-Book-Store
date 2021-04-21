<?php
session_start();
$name = $_POST['name'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirmpassword = $_POST['confirmpassword'];
include('config.php');


$name = mysqli_real_escape_string($db, $_POST['name']);
$username= mysqli_real_escape_string($db, $_POST['username']);
$password= mysqli_real_escape_string($db, $_POST['password']);
$confirmpassword= mysqli_real_escape_string($db, $_POST['confirmpassword']);
$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
$password_encrypted= base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $password, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
$sql="select Customer_email from customer where name='".username."'";
$result = mysqli_query($db,$sql);
if($result==NULL)
{

if(strcasecmp($password,$confirmpassword)==0){


$sql ="INSERT INTO customer (Customer_name,Customer_email,Customer_password) VALUES ('".$name."', '".$username."', '".$password_encrypted."')";


$result = mysqli_query($db,$sql);
mysqli_close($db);
}
 else{
    echo '<script>alert("Your password does not match!")</script>';
    header('location:signup.php');
    die();
 }
}
else {
  echo '<script>alert("This email already exists!")</script>';
  header('location:signup.php');
  die();
}

$_SESSION['just_registered']=1;
header('location:index.php');
?>
