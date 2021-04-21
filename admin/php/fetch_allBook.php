<?php
//fetch.php
include_once 'databaseConnect.php';
$output = '';
if(isset($_POST["query"])){
 $search = mysqli_real_escape_string($conn, $_POST["query"]);
 $query = "
 SELECT * FROM books LEFT JOIN department ON books.BookDepartment = department.DepertmentID 
 LEFT JOIN category ON department.CategoryID = category.CategoryID 
 where books.BookName LIKE '%".$search."%' OR books.ISBNNumber LIKE '%".$search."%' 
 OR books.BookAuthor LIKE '%".$search."%' OR category.CategoryName LIKE '%".$search."%'
 OR department.DepertmentName LIKE '%".$search."%';
 ";
}
else{
 $query = "
 SELECT * FROM books LEFT JOIN department ON books.BookDepartment = department.DepertmentID LEFT JOIN category ON department.CategoryID = category.CategoryID ;
 ";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0){
  $i=1;
 while($row = mysqli_fetch_array($result)){

  if($row['DepertmentName'] == null){ 
    $deptNAME = "<td style='color:red;'>Unavailable</td> <td style='color:red;'>Unavailable</td>";
  }else {
    
    $deptNAME = "<td>".$row['DepertmentName']."</td> <td>" . $row['CategoryName'] . "</td> ";
  }

  $output .= '
  <tr>
  <td>'.$i.'</td>
  <td><div id="'.$row['BookID'].'" class="booknameDesign viewBook"> ' . $row['BookName'] . '</div></td>
  ' . $deptNAME. '
  <td>' . $row['BookAuthor'] . '</td>
  <td>' . $row['ISBNNumber'] . '</td> 
  <td>' . $row['BookQuantity'] . '</td> 
  <td>
  <a href="updateBook.php?bookid='.$row['BookID'].'" class="btn btn-outline-dark btn-rounded btn-sm"><i class="fas fa-edit"></i></a>
  </td>
    </tr>
  ';

  $i =$i+1;
 }
 echo $output;
}
else{
 echo '<td colspan="6" style="text-align: center;">Data Not Found</td>';
}

?>