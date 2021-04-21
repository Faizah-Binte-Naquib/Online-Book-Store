<?php
include('config.php');
$username = $_POST['username'];
$password = $_POST['password'];
$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
$password_decrypted= base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $password, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
session_start();

//echo "Hex formed by md5 function is ".$password_decrypted;

 if($_SERVER["REQUEST_METHOD"] == "POST"){

$username = stripcslashes($username);
$password = stripcslashes($password);


$username = mysqli_real_escape_string($db, $_POST['username']);
$password = mysqli_real_escape_string($db, $_POST['password']);

$cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
$password_decrypted= base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $password, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );


$sql ="SELECT Customer_ID from customer where Customer_email='$username' and Customer_password like '$password_decrypted'";


$result = mysqli_query($db,$sql);

while($row=mysqli_fetch_array($result))
{

 $_SESSION["cid"]=$row["Customer_ID"];
}
//  echo $_SESSION["cid"];
 $count = mysqli_num_rows($result);


      // If result matched $myusername and $mypassword, table row must be 1 row

      if($count == 1) {
		     //$_COOKIE['user']=$username;
         $_SESSION["login_user"] =$_SESSION["cid"];
		     include('index.php');

      }else {
         echo '<script>alert("Your Email  or Password is incorrect!")</script>';
         include('signin.php');

      }
 }

?>
