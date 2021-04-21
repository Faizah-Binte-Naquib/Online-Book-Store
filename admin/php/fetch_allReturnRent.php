<?php

include_once 'databaseConnect.php';
$output = '';
if(isset($_POST["query"])){
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = " 
 SELECT * FROM rents LEFT JOIN books ON rents.Book_ID = books.BookID LEFT JOIN 
 customer ON rents.Customer_ID = customer.Customer_ID where rents.Status = 1 and 
 (books.BookName LIKE '%".$search."%' OR customer.Customer_name LIKE '%".$search."%' OR 
 rents.Rent_Date LIKE '%".$search."%' OR rents.Rent_Return_Date LIKE '%".$search."%') 
 ORDER BY rents.Rent_ID DESC ";
}
else{
 $query = "
 SELECT * FROM rents LEFT JOIN books ON rents.Book_ID = books.BookID 
  LEFT JOIN customer ON rents.Customer_ID = customer.Customer_ID where rents.Status = 1 ORDER BY rents.Rent_ID DESC";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
  $i=1;
 while($row = mysqli_fetch_array($result)){

  $datetime1 = strtotime($row['Rent_Return_Date']);
  $datetime2 = strtotime($row['Rent_Date']);
  $secs = $datetime1 - $datetime2;
  $months = intval(($secs / 86400)/30);

  $cost = 0;
  $quant = $row['Quantity'];
  if($months == 6 ){
    $cost = $row['RentPrice_6'] * $quant;
  }else if($months == 4 ){
    $cost = $row['RentPrice_4'] * $quant;
  }
  
    $output .= '
      <tr>
      <td>' . $i . '</td>
      <td><div id="'.$row['BookID'].'" class="booknameDesign viewBook"> ' . $row['BookName'] . '</div></td>
        <td><button type="button" name="view" id="'.$row['Customer_ID'].'" class="btn btn-sm btn-link viewUser booknameDesign"> ' . $row['Customer_name'] . '</button></td> 
        <td>'.$months.' months</td> 
        <td>' . $row['Rent_Date'] . '</td>
        <td>' . $row['Rent_Return_Date'] . '</td>
        <td>' . $row['Quantity'] . '</td>
        <td>'. $cost.'</td>
        <td > <div style="text-align:center; background-color: rgb(54, 173, 54); color: white; padding: 5px;">Returned</div></td>

      </tr>
    ';
    $i = $i + 1;
 }
 echo $output;
}
else{
 echo '<td colspan="8" style="text-align: center;">Data Not Found</td>';
}

?>