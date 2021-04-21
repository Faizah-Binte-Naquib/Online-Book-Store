<?php

include_once 'databaseConnect.php';

if(isset($_GET["id"])){

 $id = intval($_GET["id"]);
 $query = "SELECT * FROM customer WHERE Customer_ID = $id;";
 $result = mysqli_query($conn, $query);
 $output = '';

 $queryresult = mysqli_num_rows($result);

    while ($row = mysqli_fetch_assoc($result)) {
        $semesterYear = $row['Customer_semester'];
        $finalSem = explode("-",$semesterYear); 
        $yer = $finalSem[0];
        $sem = $finalSem[1];
        if($yer == 1){
          $yer = "1st year";
        }else if($yer == 2){
          $yer = "2nd year";
        }else if($yer == 3){
          $yer = "3rd year";
        }else{
          $yer = $yer."th year";
        }

        if($sem == 1){
          $sem = "1st semester";
        }else if($sem == 2){
          $sem = "2nd semester";
        }else if($sem == 3){
          $sem = "3rd semester";
        }else{
          $sem = $sem."th semester";
        }

        $uniuni = $row['Customer_university'];
        $sql2 = "SELECT * FROM university where University_ID = $uniuni;";
        $result2 = mysqli_query($conn, $sql2);
        if($result2){
        $row2 = mysqli_fetch_assoc($result2);
        $univer = $row2['University_Name'];
        }else{
        $univer = "NULL";
        }


        
        $output .= '
            <div class="memberInfo">
            <h3>Member Details</h3>
            <p id="cusname">'.$row["Customer_name"].'</p>
            <p><span>University : </span>'.$univer.'</p>
            <p><span>Department : </span>'.$row["Customer_department"].'</p>
            <p><span>Semester : </span>'.$yer.' '.$sem.'</p>
            <p><span>Student ID : </span>'.$row["Customer_studentID"].'</p>
            <br />
            <br />

            <p><span>Personal Information :</span></p>
            <p><span>Phone : </span>'.$row["Customer_phone"].'</p>
            <p><span>Address : </span>'.$row["Customer_address"].'</p>
            <p><span>Secondary Address : </span>'.$row["Customer_secondary_address"].'</p>
            <p><span>NID Number : </span>'.$row["NID"].'</p>
            </div>
        ';
    }
 echo $output;
}
?>