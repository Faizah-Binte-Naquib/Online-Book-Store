<?php

include_once 'databaseConnect.php';

if(isset($_GET["id"]) && isset($_GET["action"])){

    $id = intval($_GET["id"]);
    $query = " 
    SELECT * FROM books WHERE BookID = $id;";
    $result = mysqli_query($conn, $query);
    $output = '';
   
    $queryresult = mysqli_num_rows($result);
   
       while ($row = mysqli_fetch_assoc($result)) {
           $output .= '
               <div class="update-discount">
               <h3>Update Discount</h3>
               <div class="form-group">
                   <input type="text" class="form-control" id="updatedDiscount" name="updatedDiscount" value="'.$row['DiscountPercentage'].'">
                   <input type="hidden" class="form-control" id="updateID" name="updateID" value="'.$row['BookID'].'">
               </div>
               </div>
           ';
       }
    echo $output;
   }

else if(isset($_GET["id"])){

 $id = intval($_GET["id"]);
 $query = " 
 SELECT * FROM books LEFT JOIN department ON books.BookDepartment = department.DepertmentID 
 LEFT JOIN category ON department.CategoryID = category.CategoryID WHERE BookID = $id;";
 $result = mysqli_query($conn, $query);
 $output = '';

 $queryresult = mysqli_num_rows($result);

    while ($row = mysqli_fetch_assoc($result)) {
        if($row['DepertmentName'] == null){ 
            $deptNAME = "<p><span>Category : </span>Unavailable</p>
            <p><span>Depertment : </span>Unavailable</p>";
        }else {    
            $deptNAME = "<p><span>Category : </span>".$row["CategoryName"]."</p>
            <p><span>Depertment : </span>".$row["DepertmentName"]."</p>";
        }
        $output .= '
        <div class="container-fluid bookInformation">
        <h3>Book Details</h3>
        <p id="cusname" style="font-size: 20px;text-align: center;">'.$row["BookName"].'</p>
        <div class="row">

          <div class="col-4">
            <img src="../img/product/'.$row["BookImage"].'" alt="image unavailable">
          </div>

          <div class="col-8">
            '.$deptNAME.'
            <p><span>Author : </span>'.$row["BookAuthor"].'</p>
            <p><span>Edition : </span>'.$row["BookEdition"].'</p>
            <p><span>ISBN Number : </span>'.$row["ISBNNumber"].'</p>
            <p><span>Book Price : </span>'.$row["RentPrice_6"].'/=</p>
            <p><span>Rent Price (4 months) : </span>'.$row["BookPrice"].'/=</p>
            <p><span>Rent Price (6 months) : </span>'.$row["RentPrice_4"].'/=</p>
            
          </div>
    
        </div>
      </div>
        ';
    }
 echo $output;
}
?>