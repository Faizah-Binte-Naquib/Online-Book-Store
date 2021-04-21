
<?php
include_once 'databaseConnect.php';
session_start();

if(file_exists($_FILES["file"]["tmp_name"]))
{
  $test = explode('.', $_FILES["file"]["name"]);
  $ext = end($test);
  $iname = rand(100, 999) . '.' . $ext;
  $location = '../tmpImag/' . $iname;

  $_SESSION["blogext"] = $iname;
  $_SESSION["blogloc"] =$location;

  move_uploaded_file($_FILES["file"]["tmp_name"], $location);
  echo '<img src="./tmpImag/'.$iname.'" height="250px" width="300px" class="img-thumbnail" />';

}
else {
  echo "behhh";
}


if(isset($_POST['doneBlog'])){

      $stmt = $conn->prepare("INSERT INTO blog (Blog_Title, Blog_Description, Blog_Image, Blog_Date) VALUES (?,?, ?, ?);");
      $stmt->bind_param("ssss", $name, $details, $image, $date);

      $name = $_REQUEST['blogName'];
      $details = $_POST['blogDetail'];
      $date = date("Y-m-d");


      //------------ moving image to main folder --------------------
      $image = $_SESSION["blogext"];
      $location = '../../img/blog/'.$image;
      rename($_SESSION["blogloc"],$location);
      $stmt->execute();
      $stmt->close();
      $conn->close();

      echo $location;
      //-------------temp image delete --------------------------
      $files = glob('../tmpImag/*');
      foreach($files as $file){
       if(is_file($file))
         unlink($file);
       }

       unset($_SESSION["blogext"]);
       unset($_SESSION["blogloc"]);
       //session_destroy();
       $_SESSION["blogmessage"] = "New data added";
       header("Location:../blogAdd.php");
      

}
  ?>
