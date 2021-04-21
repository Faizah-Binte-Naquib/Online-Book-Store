<?php
//fetch.php
include_once 'databaseConnect.php';
session_start();

if(isset($_GET['id']) && isset($_GET['status'])){
  $id = intval($_GET['id']);

  $sql = "SELECT * FROM books where BookID = $id";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_array($result)){
      $opercentage = $row['DiscountPercentage'];
  }

  $upPercentage = $_GET['status'];
  $stmt = $conn->prepare("UPDATE books SET DiscountPercentage = ? WHERE BookID = ?;");
  $stmt->bind_param("ii", $upPercentage,$id);
  $stmt->execute();
  $stmt->close();
  $conn->close();
}

//--------------------------------discount add page ----------------------------------

else if(isset($_POST['action'])){
  $output = '';
  if(isset($_POST["query"])){
  $search = mysqli_real_escape_string($conn, $_POST["query"]);
  $query = "
  SELECT * FROM books where DiscountPercentage = 0 
  AND (books.BookName LIKE '%".$search."%' OR books.BookID LIKE '%".$search."%') ;
  ";
  }
  else{
  $query = "
  SELECT * FROM books where DiscountPercentage = 0;
  ";
  }
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) > 0){
    $i = 1 ;
    while($row = mysqli_fetch_array($result)){
      $oprice = $row['BookPrice'];
      $output .= '
        <tr>
          <td>'.$row['BookID'].'</td>
          <td><div id="'.$row['BookID'].'" class="name viewBook"> ' . $row['BookName'] . '</div></td>
          <td>' . $row['BookPrice']. ' /=</td> 
          <td><button type="submit" name="addForDiscount" value="'.$row['BookID'].'" class="btn btn-outline-dark btn-sm">Add to Discount</button></td>
        </tr>
      ';
      $i = $i + 1 ;
    }
    echo $output;
  }
  else{
    echo '<td colspan="6" style="text-align: center;">Data Not Found</td>';
  }
  
}

//------------------------------------ Discount List page ------------------------------

else {

  $output = '';
  if(isset($_POST["query"])){
    $search = mysqli_real_escape_string($conn, $_POST["query"]);
    $query = "
      SELECT * FROM books where DiscountPercentage!= 0 
      AND (books.BookName LIKE '%".$search."%' OR books.DiscountPercentage LIKE '%".$search."%') ;
    ";
  }
  else{
    $query = "
      SELECT * FROM books where DiscountPercentage!= 0;
    ";
  }
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_array($result)){
      $oprice = $row['BookPrice'];
      $percentage = $row['DiscountPercentage'];
      $dprice = $oprice + ($oprice * ($percentage/100));
      $output .= '
        <tr>
          <td><input type="checkbox" id="checkItem" name="check[]" value="'.$row['BookID'].'" ></td>
          <td><div id="'.$row['BookID'].'" class="name viewBook"> ' . $row['BookName'] . '</div></td>
          <td>' . $oprice. ' /=</td> 
          <td>' . $percentage . ' %</td> 
          <td>' . $dprice . ' /=</td>
          <td>
          <button type="button" name="view" id="'.$row['BookID'].'" class="btn  btn-outline-dark btn-rounded btn-sm view"><i class="fas fa-edit"></i></button>
          </td>
        </tr>
      ';
    }
    echo $output;
  }
  else{
    echo '<td colspan="6" style="text-align: center;">Data Not Found</td>';
  }
}

?>