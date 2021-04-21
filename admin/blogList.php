<?php
  session_start();
  if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
  }

  include_once 'php/databaseConnect.php';
  if (!isset($_POST['submit-search'])) {

    if(isset($_GET['blogid'])){

      $id = intval($_GET['blogid']);
      $sql2 = "SELECT * FROM blog WHERE Blog_ID = $id;";
      $result2 = mysqli_query($conn, $sql2);
      while ($row2 = mysqli_fetch_assoc($result2)) {
        $imageDelete = '../img/blog/' .$row2["Blog_Image"];
      }

      $sql1 = "DELETE FROM blog WHERE Blog_ID = $id;" ;
      $result1 = mysqli_query($conn, $sql1);

      //image delete
      unlink($imageDelete);
      header("Location:blogList.php");

    }
  }
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <link rel="stylesheet" href="css/BookList.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
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

          <h1 id="heading">Blog List</h1>

          <div class="search-container">
            <form class="form-inline md-form mr-auto mb-4" action="blogList.php" method="post">
              <button class="btn btn-outline-dark btn-rounded btn-sm my-0" style="margin-right:10px;" type="submit" name="refresh">
                <i class="fas fa-sync-alt"></i>
              </button>
              <input type="text" name="search_text" id="search_text" placeholder="Search by Blog Name" class="form-control" />
              <input type="text" id="datepicker" placeholder="Search by Blog Date" class="form-control" />
            </form>
          </div>

          <div class="listTable">
            <table class="table table-responsive-xl table-bordered">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Blog Image</th>
                  <th scope="col">Blog Title</th>
                  <th scope="col">Blog Details</th>
                  <th scope="col">Blog Date</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>

              <tbody id="result"> </tbody>

            </table>
          </div>

        </div>

      </div>

  </body>
</html>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script>
    $(document).ready(function(){

        load_data();
        function load_data(query){
            $.ajax({
                url:"php/fetch_allBlog.php",
                method:"POST",
                data:{query:query},
                success:function(data){
                    $('#result').html(data);
                }
            });
        }
        $('#search_text').keyup(function(){
            var search = $(this).val();
            if(search != ''){
                load_data(search);
            }
            else{
                load_data();
            }
        });

        $('#datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            onClose: function(date, datepicker) {
                if (date != "") {
                    var search = $(this).val();
                    if(search != ''){
                    load_data(search);
                    }
                    else{
                    load_data();
                    }
                }
            }
        });
    });
</script>
