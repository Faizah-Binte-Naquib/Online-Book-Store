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

          <h1 id='heading'>Add New Blog</h1>

           <div class="container">
             <form class="row" name="addForm" action="php/blogAddPHP.php" method="post" enctype="multipart/form-data">

              <div class="col-md-1">
              </div>

              <div class="shadow p-3 mb-5 bg-white rounded col-11 col-md-5 leftside">

                  <div class="form-group">
                    <label for="">Blog Image</label><br>
                    <span id="uploaded_image" style="margin-left:20px ;">
                    <img src="image\bookImage.png" height="150" width="300" class="img-thumbnail" /></span>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file"  name="file" id="file" class="custom-file-input" required>
                      <label class="custom-file-label" style="font-weight:normal;font-size: 18px;">Choose file</label>
                    </div>
                  </div>
                  </div>

              </div>

              <div class="shadow p-3 mb-5 bg-white rounded col-11 col-md-5 rightside">


                <div class="form-group">
                  <label for="">Blog Title</label>
                  <input class="form-control form-control-lg" type="text" name="blogName" placeholder="Enter Name" required>
                </div>

                <div class="form-group">
                  <label for="">Blog Details</label>
                  <textarea class="form-control" name="blogDetail" placeholder="Enter Details" required rows="3"></textarea>
                </div>

                <div >
                  <button class="btn btn-dark btn-rounded btn-lg " type="submit" name="doneBlog">Done</button>
                </div>

              </div>
             </form>
           </div>

        </div>
      </div>


      <script>

      $(document).ready(function() {
        if (!<?php echo isset($_SESSION['blogmessage'])?'true':'false'; ?>) {
          console.log("empty session");
        } else {

          var msg = "<?php echo $_SESSION['blogmessage'];?>";
          alert(msg);
        }
      });

        </script>

  </body>
</html>

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
    url:"php/blogAddPHP.php",
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

</script>

<?php
  unset($_SESSION["blogmessage"]);
 ?>
