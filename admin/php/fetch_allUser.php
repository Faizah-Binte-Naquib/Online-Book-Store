<?php
//fetch.php
include_once 'databaseConnect.php';
$output = '';
if(isset($_POST["query"])){
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
  SELECT * FROM customer 
  WHERE Customer_password != '000block000'
  AND (Customer_name LIKE '%".$search."%'
  OR Customer_email LIKE '%".$search."%' 
  OR Customer_university LIKE '%".$search."%' 
  OR Customer_phone LIKE '%".$search."%' 
  OR Customer_department LIKE '%".$search."%'
  OR Customer_address LIKE '%".$search."%' 
  OR Customer_secondary_address LIKE '%".$search."%'
  OR NID LIKE '%".$search."%');
 ";
}
else{
 $query = "
  SELECT * FROM customer where Customer_password != '000block000' ORDER BY Customer_ID
 ";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
 while($row = mysqli_fetch_array($result)){
  $output .= '
  <div class="col-12 col-sm-6 col-xl-4 customerDiv" >
  <div class="shadow p-3 mb-5 bg-white rounded">
      <div class="row">
          <div class="col-4">
          <img id="userImg" src="image/user-icon.png">
          </div>

          <div class="col-8">
          <div id="name">' . $row['Customer_name'] . '</div>
          <div>' . $row['Customer_phone'] . '</div>
          <div>' . $row['Customer_email'] . '</div>
          </div>

          <div class="col-2">
          </div>

          <div class="col-10">
          <a href="customer.php?cusid='.$row['Customer_ID'].'&&action=del" class="btn btn-sm a1" onClick="javascript: return confirm(\'Are you sure you want to remove this member?\');" ><i class="fas fa-trash-alt"></i>  Remove</a>
          <span> | </span>
          <button type="button" name="view" id="'.$row['Customer_ID'].'" class="btn btn-sm btn-link view"><i class="fas fa-file-alt"></i> Details</button>
          </div>
      </div>
      
  </div>
</div>
  ';
 }
 echo $output;
}
else{
 echo '<div style="padding-left: 25px;"><h6>No data available.</h6></div>';
}

?>