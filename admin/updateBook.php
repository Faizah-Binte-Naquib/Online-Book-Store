<?php
  session_start();
  if(!(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)){
    header("location: login.php");
    exit;
  }
  include_once 'php/databaseConnect.php';
  $id = intval($_GET['bookid']);
  $sql = "SELECT * FROM books where BookID = $id";
  $result = mysqli_query($conn, $sql);
  $row1 = mysqli_fetch_assoc($result);

  $DEPTID = $row1['BookDepartment'];
  if($DEPTID != null){
    $sql2 = "SELECT * FROM department INNER JOIN category ON department.CategoryID = category.CategoryID WHERE DepertmentID = $DEPTID";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $checkDEPT = 0;
  }else {
    $checkDEPT = 1;
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

        <script>
          function validation()
          {
            var isbnNumber = document.forms["addForm"]["isbn"];
            var bEdition = document.forms["addForm"]["edition"];
            var bQuantity = document.forms["addForm"]["quantity"];
            var bPrice =  document.forms["addForm"]["price"];

            if (isNaN(isbnNumber.value))
            {
                document.getElementById("isbnError").innerHTML = "Please enter numbers only";
                isbnNumber.focus();
                return false;
            }

            if (isNaN(bEdition.value))
            {
                document.getElementById("editionError").innerHTML = "Please enter numbers only";
                bEdition.focus();
                return false;
            }

            if (isNaN(bQuantity.value))
            {
                document.getElementById("quantityError").innerHTML = "Please enter numbers only";
                bQuantity.focus();
                return false;
            }

            if (isNaN(bPrice.value))
            {
                document.getElementById("priceError").innerHTML = "Please enter numbers only";
                bPrice.focus();
                return false;
            }

            return true;
          }
        </script>

        <div id="content">

          <div>
            <button type="button" id="sidebarCollapse" class="btn btn-dark">
                <i class="fas fa-align-left"></i>
            </button>
            <a href="php/logout.php" class="btn btn-dark" style="float: right;color: white;">Log out</a>
          </div>

          <h1 id="heading">Update Book</h1>

          <div class="container">
            <form class="row" name="addForm" action="php/update.php" onsubmit="return validation()" method="post" enctype="multipart/form-data">

             <div class="col-md-1">
             </div>

             <div class="shadow p-3 mb-5 bg-white rounded col-11 col-md-5 leftside">

                 <div class="form-group">
                   <label for="">Book Name</label>
                   <input class="form-control form-control-lg" type="text" name="name" value="<?php echo $row1['BookName']; ?>" required>
                 </div>

                 <div class="form-group">
                   <label for="">Book Image</label><br>
                   <span id="uploaded_image" style="margin-left:20px ;">
                   <img src="../img/product/<?php echo $row1['BookImage']; ?>" height="150" width="300" class="img-thumbnail" /></span>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file"  name="file" id="file" class="custom-file-input" >
                        <label class="custom-file-label" style="font-weight:normal;font-size: 18px;">Choose file</label>
                      </div>
                    </div>
                 </div>

                 <div class="form-group">
                    <label for="">Author Name</label>
                    <input class="form-control form-control-lg" type="text" name="author" value="<?php echo $row1['BookAuthor']; ?>" required>
                 </div>

                 <div class="form-group">
                   <label for="">ISBN Number</label>
                   <input class="form-control form-control-lg" type="text" name="isbn" value="<?php echo $row1['ISBNNumber']; ?>" maxlength="13" required>
                   <input type="hidden" name="multiisbn" value="<?php echo $row1['BookID']; ?>" >
                   <div style="font-size: 14px;color: gray;">* ISBN number should contain  1 to 13 digits.</div>
                   <div id="isbnError" ></div>
                 </div>

                 <div class="form-group">
                   <label for="">Book Edition</label>
                   <input class="form-control form-control-lg" type="text" name="edition" value="<?php echo $row1['BookEdition']; ?>" required>
                   <div style="font-size: 14px;color: gray;">* Enter numbers only.</div>
                   <div id="editionError"></div>
                 </div>

             </div>

             <div class="shadow p-3 mb-5 bg-white rounded col-11 col-md-5 rightside">

             <?php if($checkDEPT == 0){ ?>
                <div class="form-group radioButton">
                 <label for="" style="font-weight: 600;font-size: 20px;">Book Category</label>
                 <a href="updateDept.php?value=2" class="btn btn-outline-dark btn-rounded btn-sm"><i class="fas fa-plus-circle"></i></a>
                  <br>

                  <select id="sel_depart" class="select-css" required>
                    <option value="<?php echo $row2['CategoryID']; ?>"><?php echo $row2['CategoryName']; ?></option>
                    <?php
                      $cat = $row2['CategoryID'];
                      $sql_department = "SELECT * FROM category where CategoryID != $cat";
                      $department_data = mysqli_query($conn,$sql_department);
                      while($row = mysqli_fetch_assoc($department_data) ){
                        $departid = $row['CategoryID'];
                        $depart_name = $row['CategoryName'];
                        echo "<option value='".$departid."' >".$depart_name."</option>";
                      }
                    ?>
                 </select>
               </div>

               <div class="form-group radioButton">
                 <label for="" style="font-weight: 600; font-size: 20px;">Book Department</label>
                 <a href="updateDept.php?value=1" class="btn btn-outline-dark btn-rounded btn-sm"><i class="fas fa-plus-circle"></i></a>
                  <br>

                  <select id="sel_user" name="selectedDEPT" class="select-css" required>
                     <option value="<?php echo $row2['DepertmentID']; ?>"><?php echo $row2['DepertmentName']; ?></option>
                  </select>

               </div>

              <?php } ?>

              <?php if($checkDEPT == 1){ ?>
               <div class="form-group radioButton">
                  <label for="" style="font-weight: 600;font-size: 20px;">Book Category</label>
                  <a href="updateDept.php?value=2" class="btn btn-outline-dark btn-rounded btn-sm"><i class="fas fa-plus-circle"></i></a>
                  <br>
                  <select id="sel_depart" class="select-css" required>
                    <option value="0">- Select -</option>
                    <?php

                    $sql_department = "SELECT * FROM category";
                    $department_data = mysqli_query($conn,$sql_department);
                    while($row = mysqli_fetch_assoc($department_data) ){
                      $departid = $row['CategoryID'];
                      $depart_name = $row['CategoryName'];

                      echo "<option value='".$departid."' >".$depart_name."</option>";
                    }
                    ?>
                 	</select>
                </div>

                <div class="form-group radioButton">
                  <label for="" style="font-weight: 600; font-size: 20px;">Book Department</label>
                  <a href="updateDept.php?value=1" class="btn btn-outline-dark btn-rounded btn-sm"><i class="fas fa-plus-circle"></i></a>
                   <br>

                   <select id="sel_user" name="selectedDEPT" class="select-css" required>
                      <option value="0">- Select -</option>
                   </select>

                </div>
               
              <?php }?>


               <div class="form-group">
                 <label for="">Book Quantity</label>
                 <input class="form-control form-control-lg" type="text" name="quantity" value="<?php echo $row1['BookQuantity']; ?>" required>
                 <div style="font-size: 14px;color: gray;">* Enter numbers only.</div>
                 <div id="quantityError"></div>
               </div>

               <div class="form-group">
                  <label for="">Rent Price (4 Months)</label>
                  <input class="form-control form-control-lg" type="text" name="fourmonth" value="<?php echo $row1['RentPrice_4']; ?>" required>
                  <div style="font-size: 14px;color: gray;">* Enter numbers only.</div>
                </div>

                <div class="form-group">
                  <label for="">Rent Price (6 Months)</label>
                  <input class="form-control form-control-lg" type="text" name="sixmonth" value="<?php echo $row1['RentPrice_6']; ?>" required>
                  <div style="font-size: 14px;color: gray;">* Enter numbers only.</div>
                </div>

               <div class="form-group">
                 <label for="">Book Price</label>
                 <input class="form-control form-control-lg" type="text" name="price" value="<?php echo $row1['BookPrice']; ?>" required>
                 <div style="font-size: 14px;color: gray;">* Enter numbers only.</div>
                 <div id="priceError"></div>
               </div>

               <div >
                 <button class="btn btn-dark btn-rounded btn-lg " type="submit" name="done" >Done</button>
               </div>

             </div>

             
            </form>
          </div>

        </div>
      </div>

  </body>
</html>

<script>
/*--------------------- error message ---------------------------*/

$(document).ready(function() {
  if (!<?php echo isset($_SESSION['messageUpdate'])?'true':'false'; ?>) {
    console.log("empty session");
  } else {

    var msg = "<?php echo $_SESSION['messageUpdate'];?>";
    alert(msg);
  }
});

</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script>

/* ------------------ upload picture temp -------------------------*/

$(document).ready(function(){
 $(document).on('change', '#file', function(){
  var name = document.getElementById("file").files[0].name;
  var form_data = new FormData();
  var ext = name.split('.').pop().toLowerCase();
  if(jQuery.inArray(ext, ['gif','png','jpg','jpeg']) == -1)
  {
   alert("Invalid Image File");
  }
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("file").files[0]);
  var f = document.getElementById("file").files[0];
  var fsize = f.size||f.fileSize;
  if(fsize > 2000000)
  {
   alert("Image File Size is very big");
  }
  else
  {
   form_data.append("file", document.getElementById('file').files[0]);
   $.ajax({
    url:"php/update.php",
    method:"POST",
    data: form_data,
    contentType: false,
    cache: false,
    processData: false,
    beforeSend:function(){
     $('#uploaded_image').html("<label class='text-success'>Image Uploading...</label>");
    },
    success:function(data)
    {
     $('#uploaded_image').html(data);
    }
   });
  }
 });
});

/* ---------------- get depertment for combo box -------------------    */

$(document).ready(function(){

    $("#sel_depart").change(function(){
        var deptid = $(this).val();

        $.ajax({
            url: 'getUsers.php',
            type: 'post',
            data: {depart:deptid},
            dataType: 'json',
            success:function(response){

                var len = response.length;

                $("#sel_user").empty();
                for( var i = 0; i<len; i++){
                    var id = response[i]['id'];
                    var name = response[i]['name'];

                    $("#sel_user").append("<option value='"+id+"'>"+name+"</option>");

                }
            }
        });
    });

});
</script>



<?php
  unset($_SESSION["messageUpdate"]);
 ?>