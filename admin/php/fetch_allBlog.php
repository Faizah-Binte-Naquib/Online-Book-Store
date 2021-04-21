<?php
//fetch.php
include_once 'databaseConnect.php';
$output = '';
if(isset($_POST["query"])){
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
 SELECT * FROM blog where Blog_Title LIKE '%".$search."%' OR Blog_Date LIKE '%".$search."%';
 ";
}
else{
 $query = "
 SELECT * FROM blog;
 ";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
    $i = 1;
 while($row = mysqli_fetch_array($result)){
  $output .= '
  <tr>
        <td>' . $i . '</td> 
        <td><img src="../img/blog/' . $row['Blog_Image'] . '" alt="No Available Image" style="height: 130px;width: 130px;"></td> 
        <td>' . $row['Blog_Title'] . '</td>
        <td ><div>' . $row['Blog_Description'] .'</div></td>
        <td>' . $row['Blog_Date'] . '</td>
        <td>
           <a href="blogList.php?blogid='.$row['Blog_ID'].'" class="btn btn-outline-dark btn-rounded btn-sm" onClick="javascript: return confirm(\'Are you sure you want to remove this blog?\');"><i class="fas fa-trash-alt" ></i></a>
           <a href="blogUpdate.php?blogid='.$row['Blog_ID'].'" class="btn btn-outline-dark btn-rounded btn-sm"><i class="fas fa-edit" ></i></a>
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