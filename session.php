<?php
   include('config.php');
   session_start();

   $user_check = $_SESSION['login_user'];
   $ses_sql = "select Customer_ID from customer where Customer_email = '$user_check' ";
   $result = mysqli_query($db,$ses_sql);
   if (!$result) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

   $login_session = $row['Customer_ID'];

   if(!isset($_SESSION['login_user'])){
      header("location:process.php");
      die();
   }
?>
