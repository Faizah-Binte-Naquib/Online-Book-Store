<?php

include_once 'databaseConnect.php';

if(isset($_GET['id']) && isset($_GET['status'])){
  $id = intval($_GET['id']);
  $status = $_GET['status'];
  $stmt = $conn->prepare("UPDATE university SET Status = ? WHERE University_ID = ?;");
  $stmt->bind_param("si", $status,$id);
  $stmt->execute();
  $stmt->close();
  $conn->close();
}

if(isset($_POST['doneUniversity'])){
  $stmt = $conn->prepare("INSERT INTO university (University_Name,Status) VALUES (?,?)");
  $stmt->bind_param("ss", $uname, $ustatus);
  $uname = $_REQUEST['universityNmae'];
  $ustatus = "false";
  $stmt->execute();
  $stmt->close();
  $conn->close();
}

if(isset($_POST['updateUniversity'])){
  $stmt = $conn->prepare("UPDATE university SET University_Name = ? WHERE University_ID = ?;");
  $stmt->bind_param("si", $upname,$id);
  $upname = $_REQUEST['updateUniversityName'];
  $id = $_REQUEST['updateID'];
  echo $id;
  echo $upname;
  $stmt->execute();
  $stmt->close();
  $conn->close();
}

if(isset($_GET['id']) && isset($_GET['action'])){
    $id = intval($_GET['id']);
    $action = $_GET['action'];
    if($action == "delete"){
        $sql = "DELETE FROM university WHERE University_ID = $id;" ;
        $result = mysqli_query($conn, $sql);
    }
}
header("Location:../rentUniversity.php");

 ?>