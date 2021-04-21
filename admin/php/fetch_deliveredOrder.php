<?php
//fetch.php
include_once 'databaseConnect.php';
$output = '';
if(isset($_POST["query"])){
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = " 
  SELECT * FROM buys LEFT JOIN books ON buys.BookID = books.BookID
  LEFT JOIN customer ON buys.Customer_ID = customer.Customer_ID
  WHERE buys.Status != 0 AND (books.BookName LIKE '%".$search."%' or customer.Customer_name LIKE '%".$search."%'
  or customer.Customer_address LIKE '%".$search."%' or buys.Order_Date LIKE '%".$search."%') ORDER BY buys.Order_ID DESC;
 ";
}
else{
 $query = "
 select * from buys,books,customer WHERE buys.BookID = books.BookID and buys.Customer_ID = customer.Customer_ID and buys.Status = 1 ORDER BY buys.Order_ID DESC";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
  $i=1;
 while($row = mysqli_fetch_array($result)){
   $price = $row['Quantity'] * $row['BookPrice'];
    $output .= '
      <tr>
        <td>' . $i . '</td>
        <td><div id="'.$row['BookID'].'" class="booknameDesign viewBook"> ' . $row['BookName'] . '</div></td>
        <td><button type="button" name="view" id="'.$row['Customer_ID'].'" class="btn btn-sm btn-link viewUser booknameDesign"> ' . $row['Customer_name'] . '</button></td> 
        <td>' . $row['Customer_address'] . '</td> 
        <td>' . $row['Quantity'] . '</td>
        <td>' . $price. '</td> 
        <td>' . $row['Order_date'] . '</td>
      </tr>
    ';
    $i = $i + 1;
 }
 echo $output;
}
else{
 echo '<td colspan="6" style="text-align: center;">Data Not Found</td>';
}

?>