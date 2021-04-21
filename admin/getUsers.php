<?php

include "php/databaseConnect.php";
$departid = $_POST['depart'];   // category id

$sql1 = "SELECT categoryName FROM category WHERE CategoryID=".$departid;
$result1 = mysqli_query($conn,$sql1);
$row = mysqli_fetch_array($result1);
$catagoryName = $row['categoryName'];

$sql = "SELECT DepertmentID,DepertmentName FROM department WHERE CategoryID=".$departid;
$result = mysqli_query($conn,$sql);

$users_arr = array();
$queryresult = mysqli_num_rows($result);
if($queryresult>1){
    while( $row = mysqli_fetch_array($result) ){
        $userid = $row['DepertmentID'];
        $name = $row['DepertmentName'];
        if($name != $catagoryName){
            $users_arr[] = array("id" => $userid, "name" => $name);
        }   
    }
}
else {
    while( $row = mysqli_fetch_array($result) ){
        $userid = $row['DepertmentID'];
        $name = $row['DepertmentName'];
        $users_arr[] = array("id" => $userid, "name" => $name);
    }
}


echo json_encode($users_arr);

 ?>
