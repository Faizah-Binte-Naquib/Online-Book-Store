<?php

include_once 'config.php';

if(isset($_GET["id"])){

    $id = intval($_GET["id"]);
    $query = " 
    SELECT * FROM customer WHERE Customer_ID = $id;";
    $result = mysqli_query($db, $query);
    $sql1 = "SELECT * FROM university";
    $result1 = mysqli_query($db, $sql1);
    $queryresult1 = mysqli_num_rows($result1);

    $output = '';
   
    $queryresult = mysqli_num_rows($result);
   
       while ($row = mysqli_fetch_assoc($result)) {
           $semesterYear = $row['Customer_semester'];
           $finalSem = explode("-",$semesterYear); 

           $output .= '
           <p class="h4 mb-4">Update Information</p>
           <input type="hidden" class="form-control" id="id" name="id" value="'.$row['Customer_ID'].'">
           <div class="form-group">
               <label for="name">Name</label>
               <input type="text" class="form-control" id="name" name="name" value="'.$row['Customer_name'].'">
           </div>
           <div class="form-group">
               <label for="depertment">Student ID</label>
               <input type="text" class="form-control" id="studentID" name="depertment" value="'.$row['Customer_studentID'].'">
           </div>
           <div class="form-group row">
                <div class="col-6">
                    <label for="depertment">Year</label>
                    <input type="text" class="form-control" id="year" name="year" value="'.$finalSem[0].'">
                </div>
                <div class="col-6">
                    <label for="depertment">Semester</label>
                    <input type="text" class="form-control" id="semester" name="semester" value="'.$finalSem[1].'">
                </div>
                <div style="padding: 10px 20px 20px 20px;color: gray;">* Enter numbers for year and semester.</div>
            </div>

           <div class=" row"> 
           </div>

           <div class="form-group">
               <label for="depertment">Depertment</label>
               <input type="text" class="form-control" id="depertment" name="depertment" value="'.$row['Customer_department'].'">
           </div>
           <div class="form-group">
                <label for="">Select University</label>
                <select id="university" name="university" class="select-css">
                
           ';
           if($row['Customer_university'] == null){
            $output .='<option value="0">- Select -</option>';
           }else{
                $uniuni = $row['Customer_university'];
                $sql2 = "SELECT * FROM university where University_ID = $uniuni;";
                $result2 = mysqli_query($db, $sql2);
                $row2 = mysqli_fetch_assoc($result2);
            $output .='
                <option value="'.$row2['University_ID'].'">'.$row2['University_Name'].' </option>
                ';
           }

            if($queryresult1>0){
                while ($row1 = mysqli_fetch_assoc($result1)) {
                $output .='
                <option value="'.$row1['University_ID'].'"> '.$row1['University_Name'].' </option>
                ';
                }
            }
 
           $output .='
                </select>
           </div>

           <div class="form-group">
               <label for="email">E-mail</label>
               <input type="text" class="form-control" id="email" name="email" value="'.$row['Customer_email'].'" disabled>
           </div>
           <div class="form-group">
               <label for="nid">NID</label>
               <input type="text" class="form-control" id="nid" name="nid" value="'.$row['NID'].'">
           </div>
           <div class="form-group">
               <label for="phone">Phone Number</label>
               <input type="text" class="form-control" id="phone" name="phone" value="'.$row['Customer_phone'].'">
           </div>
           <div class="form-group">
               <label for="address">Address</label>
               <input type="text" class="form-control" id="address" name="address" value="'.$row['Customer_address'].'">
           </div>
           <div class="form-group">
               <label for="secondaryAddress">Secondary Address</label>
               <input type="text" class="form-control" id="secondaryAddress" name="secondaryAddress" value="'.$row['Customer_secondary_address'].'">
           </div>
           ';
       }
    echo $output;
   }


?>