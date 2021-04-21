<?php
//fetch.php
include_once 'databaseConnect.php';
$output = '';
if(isset($_POST["query"])){
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
 SELECT * FROM promo where Promo_Name LIKE '%".$search."%';
 ";
}
else{
 $query = "
 SELECT * FROM promo;
 ";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
   $i=1;
 while($row = mysqli_fetch_array($result)){
  $output .= '
  <tr>
        <td>' . $i. '</td>
        <td>' . $row['Promo_Name'] . '</td>
        <td ><div>' . $row['Promo_Details'] .'</div></td> 
        <td><img src="../img/promo/' . $row['Promo_Img'] . '" alt="No Available Image" style="height: 130px;width: 130px;"></td> 
        <td>
           <a href="promoList.php?promoid='.$row['Promo_ID'].'" class="btn btn-outline-dark btn-rounded btn-sm" onClick="javascript: return confirm(\'Are you sure you want to remove this promotion?\');"><i class="fas fa-trash-alt" ></i></a>
        </td>
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