<?php
  session_start();
  if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
  }
include_once 'php/databaseConnect.php';
if(isset($_GET['cusid']) && isset($_GET['action'])){
    $id = intval($_GET['cusid']);
    $action = $_GET['action'];
    if($action == "del"){
      $id = intval($_GET['cusid']);
        $data = "000block000";
        $stmt = $conn->prepare("UPDATE customer SET Customer_password = ? WHERE Customer_ID = ?;");
        $stmt->bind_param("si", $data,$id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
      
        header("Location:customer.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <link rel="stylesheet" href="css/customer.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://www.jqueryscript.net/demo/Dialog-Modal-Dialogify/dist/dialogify.min.js"></script>
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

        <h1 id="heading">Member List</h1>

        <div class="form-group" style="padding-bottom:20px;">
          <div class="input-group" >
            <input type="text" name="search_text" id="search_text" placeholder="Search by Member Details" class="form-control" style="border:2px solid black;" />
          </div>
        </div>

        <div id="result" class="row"></div>
       
      </div>
    </div>
  </body>
</html>

<script>
    $(document).ready(function(){

        load_data();
        function load_data(query){
            $.ajax({
                url:"php/fetch_allUser.php",
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

<script>
$(document).ready(function(){
 $(document).on('click', '.view', function(){
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
  new Dialogify('php/fetch_singleUserInfo.php', options)
   .showModal();
 });

});
</script>


