<?php





include('config.php');
session_start();

  //mysqli_close($db);



$sql = "SELECT * FROM books WHERE BookID IN (".implode(',',$_SESSION['rent']).")";
$query = mysqli_query($db,$sql);
while ($row=mysqli_fetch_array($query)) {
  // code...
  //echo $row['BookName'];
}


//$conn = new mysqli('localhost', 'root', '', 'boi prokousholi draft');
$sql="SELECT * FROM rents where Customer_ID='".$_SESSION['login_user']."' ORDER BY Rent_Number DESC  LIMIT 1; ";
$result=mysqli_query($db,$sql);

if(mysqli_num_rows($result) > 0)
{

  while ($row=mysqli_fetch_array($result)) {
    $order_number=$row['Rent_Number']+1;
  }
}
else{

  $order_number=1;
}

$index=0;
//echo  $order_number;
$date = date("Y-m-d");
$sql = "SELECT * FROM books WHERE BookID IN (".implode(',',$_SESSION['rent']).")";
$query = mysqli_query($db,$sql);
while($row = $query->fetch_assoc()){
if($_SESSION['rent_month'][$index]==4){
$return_date = date('Y/m/d', strtotime('+ 4 month'));
}
else {
  $return_date = date('Y/m/d', strtotime('+ 6 month'));
}
//echo $return_date;
$sql="insert into rents(Customer_ID,Book_ID,Rent_Number,Quantity,Rent_Date,Rent_Return_Date) values('".$_SESSION['login_user']."','".$row['BookID']."',$order_number,'".$_SESSION['rent_qty_array'][$index]."','".$date."','".$return_date."') ";
$result=mysqli_query($db,$sql);
$index++;
}

mysqli_close($db);

unset ($_SESSION['rent']);
unset ($_SESSION['rent_qty_array']);
unset ($_SESSION['rent_total']);
unset ($_SESSION['rent_month']);

$_SESSION['message'] = 'YOUR ORDER IS IN PROCESS, CHECK ORDER DETAILS IN YOUR PROFILE TO KEEP TRACK!';

header("location:view_cart.php");


?>
