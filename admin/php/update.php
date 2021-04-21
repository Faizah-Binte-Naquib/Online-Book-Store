
<?php
include_once 'databaseConnect.php';
session_start();
$checkImg = 0;

if(file_exists($_FILES["file"]["tmp_name"]))
{
  echo "";
  $checkImg = 1;
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
  $check= $_POST['isbn'];
  $except = $_POST['multiisbn'];
  if ($check != "") {

    $query = $conn->prepare("SELECT 1 FROM books WHERE BookID != ? AND ISBNNumber = ?");
    $query->bind_param('ii',$except, $check);
    $query->execute();
    $result = $query->get_result();
    $row = $result->fetch_assoc();

    if($row){
      $_SESSION["messageUpdate"] = "ISBN Number already exist.";
      header("Location:../updateBook.php?bookid=".$except);
    }

    else {
      $imgID = $_POST['multiisbn'];
      $sql = "SELECT BookImage,ISBNNumber FROM books where BookID = $imgID";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);

      $stmt = $conn->prepare("UPDATE books SET BookName=?,BookImage=?, BookDepartment=?,BookEdition=?, BookAuthor=?,ISBNNumber=?, BookQuantity=?, BookPrice=?, Date=?, RentPrice_4=?, RentPrice_6=? WHERE BookID=?");
      $stmt->bind_param("ssiissiisiii", $bookname, $image, $Depertment,$edition,$author,$isbn,$quantity,$price,$date,$fourprice,$sixprice,$except);

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
      if($checkImg == 1)
      {
        unlink('../../img/product/'.$row['BookImage']);
        $image = $isbn. '.' . $_SESSION["ext"];
        $location = '../../img/product/'.$image;
        rename($_SESSION["loc"],$location);
      }
      else {
        $image = $row['BookImage'];
      }

      $stmt->execute();
      $stmt->close();
      $conn->close();

      //-------------temp image delete --------------------------
      $files = glob('../tmpImag/*');
      foreach($files as $file){
       if(is_file($file)){
         unlink($file);
       }
       }

       unset($_SESSION["ext"]);
       unset($_SESSION["loc"]);
       $_SESSION["messageUpdate"] = "Data updated";
       header("Location:../updateBook.php?bookid=$except");
      }

  }
}
  ?>
