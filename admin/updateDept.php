<?php
include_once 'php/databaseConnect.php';
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
  header("location: login.php");
  exit;
}
if(isset($_SESSION["messagecat"])){
  echo "<script type='text/javascript'>alert('New category added');</script>";
  unset($_SESSION["messagecat"]);
}
if(isset($_SESSION["messagedept"])){
  echo "<script type='text/javascript'>alert('New depertment added');</script>";
  unset($_SESSION["messagedept"]);
}

if (!isset($_GET['value'])) {
    header("Location:updateDept.php?value=1");
}

if(isset($_GET['delid']) && isset($_GET['value'])){
  $id = intval($_GET['delid']);
  $val=$_GET['value'];

  if ($val == '1') {
    
    $sql1 = "DELETE from department WHERE DepertmentID = $id" ;
    $result1 = mysqli_query($conn, $sql1);
    header("Location:updateDept.php?value=1");

  }

  if ($val == '2') {

    $sql1 = "DELETE from department WHERE CategoryID = $id" ;
    $result1 = mysqli_query($conn, $sql1);

    $sql2 = "DELETE from category WHERE CategoryID = $id" ;
    $result2 = mysqli_query($conn, $sql2);

    header("Location:updateDept.php?value=2");
  }

}

 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <link rel="stylesheet" href="css/BookList.css">
</head>
  <body>
    <div class="wrapper">

        <?php include 'php/nav.php';?>

        <div id="content">
          <div>
            <button type="button" id="sidebarCollapse" class="btn btn-dark">
                <i class="fas fa-align-left"></i>
            </button>
            <a href="php/logout.php" class="btn btn-dark" style="float: right;color: white;">Log out</a>
          </div>

          <?php if($_GET["value"] === "1"){?>

            <h1 id='heading'>Add New Depertment</h1>

            <form class="row" action="php/updateDeptPhp.php" method="post">
              <div class=" col-11 col-md-6 leftside" style="margin-left:15px;">
                <table class="table table-hover table-bordered ">

                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Department</th>
                      <th scope="col">Category</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                      $sql = "SELECT * FROM department LEFT JOIN category ON department.CategoryID = category.CategoryID order by DepertmentName;";
                      $result = mysqli_query($conn, $sql);
                      $queryresult = mysqli_num_rows($result);

                      if($queryresult>0){
                        $i=1;
                        while ($row = mysqli_fetch_assoc($result)) {
                          if($row['CategoryName'] != $row['DepertmentName']){
                          echo "
                          <tr>
                          <th scope='row'>".$i."</th>
                          <td>".$row['DepertmentName']."</td>
                          <td>".$row['CategoryName']."</td>
                          <td id='actionButton'>
                            <a href='updateDept.php?value=1&delid=".$row['DepertmentID']."' class='btn btn-outline-dark btn-rounded btn-sm' onClick=\"javascript: return confirm('Are you sure you want to remove this depertment?');\" ><i class='fas fa-trash-alt'></i></a>
                          </td>
                          </tr>";
                          $i++;
                          }
                        }
                      }
                     ?>
                  </tbody>

                </table>
              </div>

              <div class="shadow p-3 mb-5 bg-white rounded col-11 col-md-5 rightside" style="height:400px;" >

                <div class="form-group">
                  <label for="">Select Category</label>
                  <select name="selectedCategory" class="select-css" required>
                    <?php
                    $sql = "SELECT * FROM category";
                    $result = mysqli_query($conn, $sql);
                    $queryresult = mysqli_num_rows($result);

                    if($queryresult>0){
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo "
                        <option value='".$row['CategoryID']."'>".$row['CategoryName']." </option>
                        ";
                      }
                    }
                   ?>
                  </select>
                </div>

                <div class="form-group">
                  <label for="">Department Name</label>
                  <input class="form-control form-control-lg" type="text" name="department" placeholder="Enter Department" required>
                </div>

                <div >
                  <button class="btn btn-dark btn-rounded btn-lg " type="submit" name="doneDepartment">Add</button>
                </div>

              </div>
            </form>
          <?php }?>

<!----------------------------------------------------------------------------------------------------------------->

          <?php if($_GET["value"] === "2"){?>

            <h1 id='heading'>Add New Category</h1>

            <form class="row" action="php/updateDeptPhp.php" method="post">
              <div class=" col-11 col-md-6 leftside" style="margin-left:15px;">
                <table class="table table-hover table-bordered ">

                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Category</th>
                      <th scope="col">Book Amount</th>
                    </tr>
                  </thead>

                  <tbody>
                    <?php
                      $sql = "SELECT COUNT(department.CategoryID) as countt, category.CategoryName,category.CategoryID FROM books INNER JOIN department ON books.BookDepartment = department.DepertmentID RIGHT JOIN category ON department.CategoryID = category.CategoryID GROUP by category.CategoryName ;";
                      $result = mysqli_query($conn, $sql);
                      $queryresult = mysqli_num_rows($result);

                      if($queryresult>0){
                        $i=1;
                        while ($row = mysqli_fetch_assoc($result)) {
                          echo "
                          <tr>
                          <th scope='row'>".$i."</th>
                          <td>".$row['CategoryName']."</td>
                          <td>".$row['countt']."</td>
                          <td id='actionButton'>
                            <a href='updateDept.php?value=2&delid=".$row['CategoryID']."' class='btn btn-outline-dark btn-rounded btn-sm' onClick=\"javascript: return confirm('Are you sure you want to remove this category?');\"><i class='fas fa-trash-alt'></i></a>
                          </td>
                          </tr>";
                          $i++;
                        }
                      }
                     ?>
                  </tbody>

                </table>
              </div>

              <div class="shadow p-3 mb-5 bg-white rounded col-11 col-md-5 rightside" style="height:300px;" >

                <div class="form-group">
                  <label for="">Category Name</label>
                  <input class="form-control form-control-lg" type="text" name="category" placeholder="Enter Category" required>
                </div>

                <div >
                  <button class="btn btn-dark btn-rounded btn-lg " type="submit" name="doneCategory">Add</button>
                </div>
              </div>

            </form>
          <?php }?>

        </div>
      </div>

  </body>
</html>

