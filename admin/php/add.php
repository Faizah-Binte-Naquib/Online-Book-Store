
<?php
include_once 'databaseConnect.php';
session_start();

if(file_exists($_FILES["file"]["tmp_name"]))
{

  $test = explode('.', $_FILES["file"]["name"]);
  $ext = end($test);
  $name = rand(100, 999) . '.' . $ext;
  $location = '../tmpImag/' . $name;

  $_SESSION["ext"] = $ext;
  $_SESSION["loc"] =$location;

  move_uploaded_file($_FILES["file"]["tmp_name"], $location);
  echo '<img src="./tmpImag/'.$name.'" height="250px" width="300px" class="img-thumbnail" />';
}
else {
  echo "behhh";
}


if(isset($_POST['done'])){
  $check= $_POST['isbn'];;
  if ($check != "") {

    $query = $conn->prepare("SELECT 1 FROM books WHERE ISBNNumber=?");
    $query->bind_param('i', $check);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();

    if($row){
      $_SESSION["message"] = "ISBN Number already exist.";
      header("Location:../addBook.php");
    }

    else {
      $stmt = $conn->prepare("INSERT INTO books (BookName,BookImage, BookDepartment,BookEdition, BookAuthor, ISBNNumber, BookQuantity, BookPrice, Date, RentPrice_4, RentPrice_6) VALUES (?,?,?,?,?,?,?,?,?,?,?)");
      $stmt->bind_param("ssiissiisii", $bookname, $image, $Depertment,$edition,$author,$isbn,$quantity,$price,$date,$fourprice,$sixprice);

      $bookname = $_REQUEST['name'];
      $Depertment = $_POST['selectedDEPT'];
      $isbn= $_REQUEST['isbn'];
      $edition =$_REQUEST['edition'];
      $author =$_REQUEST['author'];
      $quantity =$_REQUEST['quantity'];
      $price =$_REQUEST['price'];
      $fourprice =$_REQUEST['fourmonth'];
      $sixprice =$_REQUEST['sixmonth'];
      $date = date("Y-m-d");

      //------------ moving image to main folder --------------------
      $image = $isbn. '.' . $_SESSION["ext"];
      $location = '../../img/product/'.$image;
      rename($_SESSION["loc"],$location);

      $stmt->execute();
      $stmt->close();
      $conn->close();

      //-------------temp image delete --------------------------
      $files = glob('../tmpImag/*');
      foreach($files as $file){
       if(is_file($file))
         unlink($file);
       }

       unset($_SESSION["ext"]);
       unset($_SESSION["loc"]);
       //session_destroy();
       $_SESSION["message"] = "New data added";
       header("Location:../addBook.php");
      }

  }else { }
}
  ?>
