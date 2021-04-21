<?php 
   session_start();
   if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
     header("location: login.php");
     exit;
   }

 if(isset($_SESSION['discountMessage'])){
  echo "<script type='text/javascript'>alert('Discount added.');</script>";
  unset($_SESSION["discountMessage"]);
 }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <link rel="stylesheet" href="css/customer.css">

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

        <h1 id="heading">Add New Discount</h1>

        <div class="row">

          <div class="shadow p-3 mb-5 bg-white rounded col-11 col-md-4 leftside">

            <form action="php/addDiscount.php" method="post">
              <div class="form-group"> 
                <label for="bookIDs" style="font-size:18px">Selected Book ID's :</label>
                <button class="btn btn-outline-dark btn-rounded btn-sm" type="submit" name="resetDiscount" style="float:right;margin-bottom:8px;"><i class="fas fa-sync-alt"></i></button>
                  <?php 
                  echo "<textarea class='form-control' id='bookIDs' rows='2' disabled>";
                    if(isset($_SESSION['discountBookID'])){
                      foreach($_SESSION['discountBookID'] as $key=>$value){
                        echo $value.", ";
                      }
                    }
                    else{
                      echo 'No ID is selected. Select ID from the table.';
                    }
                    echo "</textarea>";
                  ?>  
                
              </div>
              </form>
              <form action="php/addDiscount.php" method="post">

              <div class="form-group">
                <input class="form-control form-control-lg" type="text" name="discount" placeholder="Enter Discount Amount" required>
              </div>

              <div class="form-group">
                <button class="btn btn-dark btn-rounded btn-lg " type="submit" name="doneDiscount">Add</button>
              </div>
            </form>
          </div>

          <div class=" col-11 col-md-7 rightside">
            <form action="php/addDiscount.php" method="post">
              <div class="search-container-discount">
                  <button class="btn btn-outline-dark btn-rounded btn-sm" style="margin-right:10px;" type="submit" name="refresh">
                    <i class="fas fa-sync-alt"></i>
                  </button>
                  <input type="text" name="search_text" id="search_text" placeholder="Search by Book ID or Name" class="form-control" />
              </div>

              <div class="listTable">
                <table class="table table-responsive-xl table-bordered discountTable">
                  <thead>
                    <tr>
                      <th scope="col">Book ID</th>
                      <th scope="col">Book Name</th>
                      <th scope="col">Book Price</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody id="result"> </tbody>
                </table>
              </div>
            </form>
          </div>

        </div>
    
      </div>
    </div>

  </body>
</html>
  <script src="https://www.jqueryscript.net/demo/Dialog-Modal-Dialogify/dist/dialogify.min.js"></script>

  <script>
  $("#checkAl").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
  });

</script>

<script>
  $(document).ready(function(){

    load_data();
    function load_data(query){
      var action = "add";
      $.ajax({
        url:"php/fetch_alldiscount.php",
        method:"POST",
        data:{query:query,action:action},
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

