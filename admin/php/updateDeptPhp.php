<?php
include_once 'databaseConnect.php';
session_start();


if (isset($_POST['doneDepartment'])) {
  $stmt = $conn->prepare("INSERT INTO department (DepertmentName,CategoryID) VALUES (?,?)");
  $stmt->bind_param("si", $Dname,$category);
  $Dname = $_REQUEST['department'];
  $category = $_POST['selectedCategory'];

  $stmt->execute();
  $stmt->close();
  $conn->close();
  $_SESSION["messagedept"] = "New depertment added.";
  header("Location:../updateDept.php?value=1");
}
if (isset($_POST['doneCategory'])) {
  $stmt = $conn->prepare("INSERT INTO category (CategoryName) VALUES (?)");
  $stmt->bind_param("s", $Cname);
  $Cname = $_REQUEST['category'];
  $stmt->execute();

  $query = "SELECT CategoryID FROM category ORDER BY CategoryID DESC LIMIT 1;"; 
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_array($result);

  $stmt = $conn->prepare("INSERT INTO department (DepertmentName,CategoryID) VALUES (?,?)");
  $stmt->bind_param("si", $Cname,$category);
  $Cname = $_REQUEST['category'];
  $category = $row['CategoryID'];

  $stmt->execute();
  $stmt->close();
  $conn->close();
  $_SESSION["messagecat"] = "New category added.";
  header("Location:../updateDept.php?value=2");

}

?>
