<?php

include('config.php');
session_start();

if($_SESSION['login_user']==NULL)
{

    echo '<script type="text/javascript"> ';
    //echo 'var inputname = prompt("Please enter your name", "");';
    echo 'alert you must be logged in in oreder to proceed purchase;';
    echo '</script>';

}

else{

}
  //mysqli_close($db);


$sql = "SELECT * FROM books WHERE BookID IN (".implode(',',$_SESSION['cart']).")";
$query = mysqli_query($db,$sql);
while ($row=mysqli_fetch_array($query)) {
  // code...
  echo $row['BookName'];
}


//$conn = new mysqli('localhost', 'root', '', 'boi prokousholi draft');
$sql="SELECT Order_Number FROM buys where Customer_ID='".$_SESSION['login_user']."' ORDER BY Order_Number DESC  LIMIT 1; ";
$result=mysqli_query($db,$sql);

if(mysqli_num_rows($result) > 0)
{
  while ($row=mysqli_fetch_array($result)) {
    $order_number=$row['Order_Number']+1;
  }
}
else{
  $order_number=1;
}

$index=0;
$date = date("Y-m-d");
$sql = "SELECT * FROM books WHERE BookID IN (".implode(',',$_SESSION['cart']).")";
$query = mysqli_query($db,$sql);
while($row = $query->fetch_assoc()){
$sql="insert into buys(Customer_ID,BookID,Order_Number,Quantity,Order_date) values('".$_SESSION['login_user']."','".$row['BookID']."',$order_number,'".$_SESSION['qty_array'][$index]."','".$date."') ";
$result=mysqli_query($db,$sql);
$index++;
}

mysqli_close($db);

unset ($_SESSION['cart']);
unset ($_SESSION['qty_array']);
unset ($_SESSION['total']);

$_SESSION['message'] = 'YOUR ORDER IS IN PROCESS, CHECK ORDER DETAILS IN YOUR PROFILE TO KEEP TRACK!';

header("location:view_cart.php");


?>
