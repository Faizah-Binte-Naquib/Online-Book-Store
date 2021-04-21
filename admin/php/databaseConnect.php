<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "boi prokousholi draft";
$conn = mysqli_connect($server, $username, $password, $dbname);
$connect = new PDO( 'mysql:host=localhost;dbname=boi prokousholi draft', $username, $password );

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

 ?>
