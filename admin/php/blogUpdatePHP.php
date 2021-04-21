
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


if(isset($_POST['doneBlog'])){
  $idid = $_POST['idid'];

  $sql = "SELECT Blog_Image FROM blog where Blog_ID = $idid";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);

      $stmt = $conn->prepare("UPDATE blog SET Blog_Title=?,Blog_Description=?,Blog_Image=?,Blog_Date=? WHERE Blog_ID=?");
      $stmt->bind_param("ssssi", $name, $detail, $image, $date, $idid);

      $name = $_REQUEST['blogName'];
      $detail = $_REQUEST['blogDetail'];
      $date = $_REQUEST['blogDate'];

      //------------ moving image to main folder --------------------
      if($checkImg == 1)
      {
        unlink('../../img/blog/'.$row['Blog_Image']);
        $image = $_SESSION["ext"];
        $location = '../../img/blog/'.$image;
        rename($_SESSION["loc"],$location);
      }
      else {
        $image = $row['Blog_Image'];
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
       $_SESSION["blogmessage"] = "Data updated";
       header("Location:../blogUpdate.php?blogid=$idid");
  
}
  ?>
