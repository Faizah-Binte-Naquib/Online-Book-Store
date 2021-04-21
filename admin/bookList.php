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

          <h1 id="heading">Book List</h1>

          <div class="search-container">
            <form class="form-inline md-form mr-auto mb-4" action="bookList.php" method="post">
              <button class="btn btn-outline-dark btn-rounded btn-sm my-0" style="margin-right:10px;" type="submit" name="refresh">
                <i class="fas fa-sync-alt"></i>
              </button>
              <input type="text" name="search_text" id="search_text" placeholder="Search by Book Details" class="form-control" />
            </form>
          </div>

          <div class="listTable">
            <table class="table table-responsive-xl table-bordered">
              <thead>
                <tr>
                <th scope="col">#</th>
                  <th scope="col">Book Name</th>
                  <th scope="col">Depertment</th>
                  <th scope="col">Category</th>
                  <th scope="col">Author</th>
                  <th scope="col">ISBN Number</th>
                  <th scope="col">Quantity</th>
                  <th scope="col"></th>
                </tr>
              </thead>

              <tbody id="result"> </tbody>

            </table>
          </div>

        </div>

      </div>

  </body>
</html>

<script>
    $(document).ready(function(){

        load_data();
        function load_data(query){
            $.ajax({
                url:"php/fetch_allBook.php",
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
    });
</script>

<script src="https://www.jqueryscript.net/demo/Dialog-Modal-Dialogify/dist/dialogify.min.js"></script>



<script>
  $(document).ready(function(){

   $(document).on('click', '.viewBook', function(){
    var id = $(this).attr('id');
    var options = {
     ajaxPrefix: '',
     ajaxData: {id:id},
     ajaxComplete:function(){
      this.buttons([{
       type: Dialogify.BUTTON_PRIMARY
      }]);
     }
    };
    new Dialogify('php/fetch_singleBookInfo.php', options)
     .showModal();
   });



  });
</script>





