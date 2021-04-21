
<?php

include('config.php');
session_start();


if(isset($_POST['address'])&&isset($_POST['phone'])&&isset($_POST['university']))
{
  $address=$_POST['address'];
  $phone=$_POST['phone'];
  $university=$_POST['university'];
  $sql= "Update customer set Customer_address='".$address."',Customer_phone='".$phone."',Customer_university='".$university."' where Customer_ID='".$_SESSION['login_user']."' ";
  $result = mysqli_query($db,$sql);
  if(!$result)
  {
    $_SESSION['phone_message'] = 1;
  }
  if($_SESSION['in_rent']==0){
    header("location:checkout.php");
   }
   else {
     header("location:rent_checkout.php");
   }
}

if(isset($_POST['submit_address']))
{
  if(isset($_POST['address'])){
  $address=$_POST['address'];
  $sql= "Update customer set Customer_address='".$address."' where Customer_ID='".$_SESSION['login_user']."' ";
  $result = mysqli_query($db,$sql);
  if($_SESSION['in_rent']==0){
    header("location:checkout.php");
   }
   else {
     header("location:rent_checkout.php");
   }
  //die();

  }
}

if(isset($_POST['submit_phone']))
{

  if(isset($_POST['phone'])){
  $phone=$_POST['phone'];
  $sql= "Update customer set Customer_phone='".$phone."' where Customer_ID='".$_SESSION['login_user']."' ";
  $result = mysqli_query($db,$sql);
  if(!$result)
  {
    $_SESSION['phone_message'] = 1;
  }

  if($_SESSION['in_rent']==0){
    header("location:checkout.php");
   }
   else {
     header("location:rent_checkout.php");
   }

  }
}



if(isset($_POST['submit_university']))
{

  if(isset($_POST['university'])){
  $university=$_POST['university'];
  $sql= "Update customer set Customer_university='".$university."' where Customer_ID='".$_SESSION['login_user']."' ";
  $result = mysqli_query($db,$sql);


  if($_SESSION['in_rent']==0){
    header("location:checkout.php");
   }
   else {
     header("location:rent_checkout.php");
   }

  }
}
?>
