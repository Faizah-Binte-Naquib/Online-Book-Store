
<?php
include_once 'databaseConnect.php';
session_start();

if(file_exists($_FILES["file"]["tmp_name"]))
{

  $test = explode('.', $_FILES["file"]["name"]);
  $ext = end($test);
  $iname = rand(100, 999) . '.' . $ext;
  $location = '../tmpImag/' . $iname;

  $_SESSION["promoext"] = $iname;
  $_SESSION["promoloc"] =$location;

  move_uploaded_file($_FILES["file"]["tmp_name"], $location);
  echo '<img src="./tmpImag/'.$iname.'" height="250px" width="300px" class="img-thumbnail" />';

}
else {
  echo "behhh";
}


if(isset($_POST['donePromo'])){


      $stmt = $conn->prepare("INSERT INTO promo (Promo_Name, Promo_Details, Promo_Img) VALUES (?, ?, ?);");
      $stmt->bind_param("sss", $name, $details, $image);

      $name = $_REQUEST['promoName'];
      $details = $_POST['promoDetail'];


      //------------ moving image to main folder --------------------
      $image = $_SESSION["promoext"];
      $location = '../../img/promo/'.$image;
      rename($_SESSION["promoloc"],$location);

      $stmt->execute();
      $stmt->close();
      $conn->close();

      //-------------temp image delete --------------------------
      $files = glob('../tmpImag/*');
      foreach($files as $file){
       if(is_file($file))
         unlink($file);
       }

       unset($_SESSION["promoext"]);
       unset($_SESSION["promoloc"]);
       //session_destroy();
       $_SESSION["promomessage"] = "New data added";
       header("Location:../promoAdd.php");
      

}
  ?>
