<?php 
session_start();
if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
  header("location: login.php");
  exit;
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

          <h1 id="heading">University for Renting Book</h1>

          <?php if (isset($_GET["action"]) && $_GET["action"] === "update") {
            $updateID = intval($_GET['id']);
            $sql = "SELECT * FROM university WHERE University_ID = $updateID;";
            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result) ){
              $prevname = $row['University_Name'];
            }
            ?>

            <div class="row">
              <div class="col-2"></div>

              <div class="shadow p-3 mb-5 bg-white rounded col-8 leftside" style="height: 300px;">
                <h3 id="universityID">Update University</h3>
                <form action="php/rentUniversityPHP.php" method="post">
                  <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="updateUniversityName" value="<?php echo $prevname; ?>" required>
                    <input type="hidden" name="updateID" value="<?php echo $updateID?>">
                  </div>

                  <div >
                    <button onClick="javascript: return confirm('Are you sure you want to update <?php echo $prevname; ?>?');" class="btn btn-dark btn-rounded btn-lg " type="submit" name="updateUniversity">Update</button>
                  </div>

                </form>
              </div>

              <div class="col-2"></div>

            </div>
          <?php }?>

          <?php if(!isset($_GET["action"])) {?>

            <div class="row">
            <div class="col-2"></div>

            <div class="shadow p-3 mb-5 bg-white rounded col-8 leftside" style="height: 300px;">
              <h3 id="universityID">Add New University</h3>
              <form action="php/rentUniversityPHP.php" method="post">
                <div class="form-group">
                  <input class="form-control form-control-lg" type="text" name="universityNmae" placeholder="Enter University Name" required>
                </div>

                <div >
                  <button onClick="javascript: return confirm('Are you sure you want to add this university?');" class="btn btn-dark btn-rounded btn-lg " type="submit" name="doneUniversity">Add</button>
                </div>

              </form>
            </div>

            <div class="col-2"></div>

            <div class="col-12 rightside">
              <h3 id="universityID" style="padding-top:35px;">University List</h3>
              <table class="table table-responsive-xl table-bordered ">

                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">University Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    <th scope="col"></th>
                  </tr>
                </thead>

                <tbody>
                  <?php
                    $sql = "SELECT * FROM university;";
                    $result = mysqli_query($conn, $sql);
                    $queryresult = mysqli_num_rows($result);

                    if ($queryresult > 0) {
                      $i = 1;
                      while ($row = mysqli_fetch_assoc($result)) {
                        if ($row['Status'] == "true") {
                          echo "
                            <tr bgcolor='#ABD9BE'>";
                        } 
                        else {
                          echo "
                            <tr bgcolor=''>";
                        }

                        echo "
                            <th scope='row'>" . $i . "</th>
                            <td>" . $row['University_Name'] . "</td>";

                        if ($row['Status'] == "false") {
                          echo "
                            <td>Not Available</td>
                            <td id='actionButton'>
                              <a href='php/rentUniversityPHP.php?status=true&id=" . $row['University_ID'] . "' class='btn btn-outline-dark btn-rounded '><i class='fas fa-check'></i></a>
                            </td>";
                        } 
                        else {
                          echo "
                            <td>Available</td>
                            <td id='actionButton'>
                              <a href='php/rentUniversityPHP.php?status=false&id=" . $row['University_ID'] . "' class='btn btn-outline-dark btn-rounded '><i class='fas fa-times'></i></a>
                            </td>";
                        }
                        echo "
                          <td id='actionButton'>
                            <a  href='rentUniversity.php?action=update&id=" . $row['University_ID'] . "' class='btn btn-outline-dark btn-rounded '>Update</a>
                            <a onClick=\"javascript: return confirm('Are you sure you want to remove this university?');\" href='php/rentUniversityPHP.php?action=delete&id=" . $row['University_ID'] . "' class='btn btn-outline-dark btn-rounded '>Detete</a>
                          </td>
                          </tr>";
                        $i++;
                      }
                    }
                  ?>
                </tbody>

              </table>
            </div>
          </div>
        <?php } ?>
        

      </div>
    </div>
  </body>
</html>
