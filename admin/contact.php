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
      mysqli_query($conn,"DELETE FROM contact WHERE Contact_ID ='".$del_id."'");
      header("Location:contact.php");
    }
  }
}

if(isset($_POST['refresh'])){
  header("Location:contact.php");
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

          <h1 id="heading">Messages</h1>
          <div class="container">
            <form class="row" method="post" action="">
            <div class='col-11 contact-infoo'>
              <span class="btn" id="checkboxUI"><input type="checkbox" id="checkAl"> Select All</span>
              <button  type="submit" class="btn  btn-outline-dark btn-rounded" name="save" onClick="javascript: return confirm('Are you sure you want to remove this message?');"><i class='fas fa-trash-alt'></i></button>
              <button class="btn btn-outline-dark btn-rounded " style="margin-right:10px;" type="submit" name="refresh">
                <i class="fas fa-sync-alt"></i>
              </button>
            </div>
            <?php
            $sql = "SELECT * FROM contact order by Contact_ID desc;";
            $result = mysqli_query($conn, $sql);
            $queryresult = mysqli_num_rows($result);
            if ($queryresult > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo "
                <div class='col-11 contact-info'>
                <span><input type='checkbox' id='checkItem' name='check[]' value='".$row['Contact_ID']."' ></span>
                <button type='button' name='view' id='".$row['Contact_ID']."' class='btn btn-link view'>
                  <span style='font-weight:bold'>".$row['Contact_email']." </span>
                  <span>  |  </span>
                  <span> ".$row['Contact_phone']."</span>
                 </button>
                 </div>
                ";
              }
            }
            else {
              echo "<div class='col-11 contact-info' style='text-align:center;'> No message availabe. </div>";
            }
            ?>

          </form>          
          </div>

        </div>
      </div>

  </body>
</html>


<script>
  $("#checkAl").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
  });

</script>

<script type="text/javascript" language="javascript" >
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
  new Dialogify('php/fetch_messageInfo.php', options)
   .showModal();
 });

});
</script>