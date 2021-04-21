<?php
  session_start();
  if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
  }
include_once 'php/databaseConnect.php';

if(isset($_POST['save'])){
  if(isset($_POST['check'])){

    $checkbox = $_POST['check'];
    
    for($i=0;$i<count($checkbox);$i++){
      $del_id = $checkbox[$i]; 
      $reset = 0;
      $stmt = $conn->prepare("UPDATE books SET DiscountPercentage = ? WHERE BookID = ?;");
        $stmt->bind_param("ii", $reset,$del_id);
        $stmt->execute();
        
    }
    $stmt->close();
    $conn->close();
  }
}

if(isset($_POST['refresh'])){
  header("Location:discountList.php");
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

          <h1 id="heading">Discount List</h1>


           <div class="search-container">
            <form class="form-inline md-form mr-auto mb-4" action="discountList.php" method="post">
              <button class="btn btn-outline-dark btn-rounded btn-sm my-0" style="margin-right:10px;" type="submit" name="refresh">
                <i class="fas fa-sync-alt"></i>
              </button>
              <input type="text" name="search_text" id="search_text" placeholder="Search Book Name or Discount Amount" class="form-control" />
            </form>
          </div>
          


            <div class="listTable">
            <form  action="discountList.php" method="post">
              <table class="table table-responsive-xl table-bordered discountTable">
                <thead>
                  <tr>
                  <th scope="col"><input type="checkbox" id="checkAl"></th>
                    <th scope="col">Book Name</th>
                    <th scope="col">Original Price</th>
                    <th scope="col">Discount Ammount</th>
                    <th scope="col">Discounted Price</th>
                    <th scope="col"></th>

                  </tr>
                </thead>

                <tbody id="result"> </tbody>

              </table>
              <button  type="submit" class="btn btn-dark btn-rounded" name="save" onClick="javascript: return confirm('Are you sure you want to remove this discount?');">Delete Selected row(s)</button>
              </form>
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
      $.ajax({
        url:"php/fetch_alldiscount.php",
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


   $(document).on('click', '.view', function(){
    var id = $(this).attr('id');
    var action = "up";
    var options = {
     ajaxPrefix: '',
     ajaxData: {id:id,action:action},
    };
    new Dialogify('php/fetch_singleBookInfo.php', options)
    .buttons([
      {
        text:'Edit',
        type:Dialogify.BUTTON_PRIMARY,
        click:function(e){
          var data = $('#updatedDiscount').val();
          var id = $('#updateID').val();
          $.ajax({
            url:"php/updateDiscount.php",
            method:"POST",
            data:{id:id, data:data},
            dataType:'json',
            success:function(data){
            if(data.error != ''){
              alert('Somthing went wrong');
              window.location.replace("discountList.php");
              }
              else if(data.success != ''){
                alert(data.success);
                window.location.replace("discountList.php");
              }
              
            }
          });
        }
      },
      {
       text:'Cancel',
       click:function(e){
        this.close();
       }
      }
    ])
     .showModal();
   });
   
  });
</script>

