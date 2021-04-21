<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once 'config.php';
if ($_SESSION["login_user"]) {
    $id = intval($_SESSION["login_user"]);
    $sql = "SELECT * FROM customer where Customer_ID = $id";
    $result = mysqli_query($db, $sql);
    $row1 = mysqli_fetch_assoc($result);

    $uniuni = $row1['Customer_university'];
    $sql2 = "SELECT * FROM university where University_ID = $uniuni;";
    $result2 = mysqli_query($db, $sql2);
    if($result2){
    $row2 = mysqli_fetch_assoc($result2);
    $univer = $row2['University_Name'];
    }else{
      $univer = "NULL";
    }

} else {
    header("location:signin.php");
}
?>

<!DOCTYPE html>
<html lang="zxx">
<head>
	<title></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
 <!-- Font Awesome JS -->
 <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
 <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

</head>
<body class="bg">

<style>

.orderInfo{
  height:300px;
  margin-top:100px;
}
.orderInfo a{
  color: #373b3f;
  text-decoration: underline;

}
.orderInfo p{
  font-size:15px;
  padding: 10px
}
.orderInfo #heading{
  font-size: 25px;
  padding-top: 20px;
  text-align: center;
  background-color: #373b3f;
  color: white;
  border-radius: 3%;
}

.userInfo{
  height:550px;
}
.userInfo a{
  color: #373b3f;
  text-decoration: underline;
}
.userInfo .info{
  padding:10px;
}

.userInfo .info label{
  font-size:18px;

}

.bg {

  background-image: url("img/profileBG.jpg");

  height: 100%;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}

.select-css {
    display: block;
    font-size: 16px;
    font-family: sans-serif;
    font-weight: 700;
    color: #444;
    line-height: 1.3;
    padding: .6em 1.4em .5em .8em;
    width: 100%;
    max-width: 100%;
    box-sizing: border-box;
    margin: 0;
    border: 1px solid #aaa;
    box-shadow: 0 1px 0 1px rgba(0,0,0,.04);
    border-radius: .5em;
    -moz-appearance: none;
    -webkit-appearance: none;
    appearance: none;
    background-color: #fff;
    background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
      linear-gradient(to bottom, #ffffff 0%,#e5e5e5 100%);
    background-repeat: no-repeat, repeat;
    background-position: right .7em top 50%, 0 0;
    background-size: .65em auto, 100%;
}
.select-css::-ms-expand {
  display: none;
}
.select-css:hover {
  border-color: #888;
}
.select-css:focus {
    border-color: #aaa;
    box-shadow: 0 0 1px 3px rgba(59, 153, 252, .7);
    box-shadow: 0 0 0 3px -moz-mac-focusring;
    color: #222;
    outline: none;
}
.select-css option {
    font-weight:normal;
}


</style>

<?php include "header.php";?>

<div ></div>

<div class="container-fluid ">

  <form class="row" action="profile.php" method="post" style="margin-top: 30px;">

    <div class="shadow p-3 mb-5 bg-white rounded col-2 orderInfo">
      <p id="heading">Shortcuts</p>
      <p><a href="blog.php" ><i class="fas fa-book-open"></i>  Blog</a></p>
      <p><a href="view_cart.php"><i class="fas fa-book-open"></i>  Cart</a></p>
      <p><a href="orderdetails.php" ><i class="fas fa-book-open"></i>  My Order</a></p>
    </div>

    <div class="col-1"></div>

    <div class="col-9 userInfo">

      <div class="col-12">
      <div class="row" >
        <div class ="col-3"><img src="img/propic.png" style="width: 150px; border-radius: 40%;"></div>
        <div class="col-9">

          <div class="row" style="margin-top: 30px;">
            <div style="font-size: 40px;margin-bottom: 10px;text-transform: capitalize;"><?php echo $row1['Customer_name']; ?></div>

              <div class="col-12">
                <button type="button" name="view" id="<?php echo $_SESSION["login_user"];?>" class="btn btn-dark view">Edit Information</button>
                <button type="button" name="view" id="<?php echo $_SESSION["login_user"];?>" class="btn btn-dark viewPass">Change Password</button>

              </div>
            </div>
          </div>
        </div>
      </div>


      <div class="col-12" style="margin-top: 30px;">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#home" data-toggle="tab">Personal Information</a></li>
          <li><a href="#profile" data-toggle="tab">Academic Information</a></li>
        </ul>
        <div id="myTabContent" class="tab-content">
          <div class="tab-pane active in" id="home">
            <div id="tab" style="margin: 40px 0px;">

            <div class="row info">
                <label class="col-4">NID</label>
                <?php 
                
                  if($row1['NID'] == NULL){
                    $nid = "NULL";
                  } else{
                    $nid = $row1['NID'];
                  }
                ?>
                <div class="col-6"><?php echo $nid; ?></div>
               
              </div>

              <div class="row info">
                <label class="col-4">Phone</label>
                <?php 
                
                  if($row1['Customer_phone'] == NULL){
                    $phone = "NULL";
                  } else{
                    $phone = $row1['Customer_phone'];
                  }
                ?>
                <div class="col-6"><?php echo $phone; ?></div>
              </div>

              <div class="row info">
                <label class="col-4" >Email address</label>
                <?php 
                
                  if($row1['Customer_email'] == NULL){
                    $emaill = "NULL";
                  } else{
                    $emaill = $row1['Customer_email'];
                  }
                ?>
                <div class="col-6"><?php echo $emaill; ?></div>
              </div>


              <div class="row info">
                <label class="col-4">Primary Address</label>
                <?php 
                
                  if($row1['Customer_address'] == NULL){
                    $addresss = "NULL";
                  } else{
                    $addresss = $row1['Customer_address'];
                  }
                ?>
                <div class="col-4"><?php echo $addresss; ?></div>
              </div>

              <div class="row info">
                <label class="col-4">Secondary address</label>
                <?php 
                
                  if($row1['Customer_secondary_address'] == NULL){
                    $saddresss = "NULL";
                  } else{
                    $saddresss = $row1['Customer_secondary_address'];
                  }
                ?>
                <div class="col-4"><?php echo $saddresss; ?></div>
              </div>

            </div>

          </div>
          <div class="tab-pane fade" id="profile">
            <div id="tab2" style="margin: 40px 0px;">

            <div class="row info">
                  <label class="col-4">Student ID</label>
                  <?php 
                
                  if($row1['Customer_studentID'] == NULL){
                    $sid = "NULL";
                  } else{
                    $sid = $row1['Customer_studentID'];
                  }
                ?>
                  <div class="col-6"><?php echo $sid; ?></div>
              </div>

            <div class="row info">
                  <label class="col-4">Semester</label>
                  <?php 
                
                  if($row1['Customer_semester'] == '0-0'){
                    $sem = "NULL";
                    $yer = "";
                  } else{
                    $semesterYear = $row1['Customer_semester'];
                    $finalSem = explode("-",$semesterYear); 
                    $yer = $finalSem[0];
                    $sem = $finalSem[1];
                    if($yer == 1){
                      $yer = "1st year";
                    }else if($yer == 2){
                      $yer = "2nd year";
                    }else if($yer == 3){
                      $yer = "3rd year";
                    }else{
                      $yer = $yer."th year";
                    }

                    if($sem == 1){
                      $sem = "1st semester";
                    }else if($sem == 2){
                      $sem = "2nd semester";
                    }else if($sem == 3){
                      $sem = "3rd semester";
                    }else{
                      $sem = $sem."th semester";
                    }
                    
                  }
                ?>
                  <div class="col-6"><?php echo $yer; ?> <?php echo $sem; ?></div>
              </div>

              <div class="row info">
                  <label class="col-4">Department</label>
                  <?php 
                
                  if($row1['Customer_department'] == NULL){
                    $deptt = "NULL";
                  } else{
                    $deptt = $row1['Customer_department'];
                  }
                ?>
                  <div class="col-6"><?php echo $deptt; ?></div>
              </div>

              <div class="row info">
                  <label class="col-4">University</label>
                  <div class="col-4"><?php echo $univer; ?></div>
                </div>

            </div>
          </div>
        </div>
      </div>

    </div>

  </form>

</div>




<!-- Footer section -->
<section class="footer-section">
		<div class="container">
			<div class="footer-logo text-center">
			<h1>Boi Prokashoni</h1>
			</div>
			<div class="row">
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2>About</h2>
						<p>Write something</p>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2> Links</h2>
						<ul>
							<li><a href="">Terms of Use</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget about-widget">
						<h2>Have a Question?</h2>
						<ul>
							<li><a href="">+880 1552-655253 </a></li>
							<li><a href="">boiprcom@gmail.com</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-sm-6">
					<div class="footer-widget contact-widget">
						<h2>Follow us on</h2>
           <a href="" class="facebook"><i class="fa fa-facebook"></i><span>    facebook</span></a>
					</div>
				</div>
			</div>
		</div>
	</section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- Popper.JS -->
  <!  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</body>

</html>


<script src="https://www.jqueryscript.net/demo/Dialog-Modal-Dialogify/dist/dialogify.min.js"></script>


<script  type="text/javascript" language="javascript">
  $(document).ready(function(){

   $(document).on('click', '.view', function(){
    var id = $(this).attr('id');
    var options = {
     ajaxPrefix: '',
     ajaxData: {id:id},
    };
    new Dialogify('fetch_userInfo.php', options)
    .buttons([
      {
        text:'Edit',
        type:Dialogify.BUTTON_PRIMARY,
        click:function(e){
            var form_data = new FormData();
            form_data.append('id', $('#id').val());
            form_data.append('name', $('#name').val());
            form_data.append('studentID', $('#studentID').val());
            form_data.append('year', $('#year').val());
            form_data.append('semester', $('#semester').val());
            form_data.append('university', $('#university').val());
            form_data.append('depertment', $('#depertment').val());
            form_data.append('nid', $('#nid').val());
            form_data.append('phone', $('#phone').val());
            form_data.append('address', $('#address').val());
            form_data.append('secondaryAddress', $('#secondaryAddress').val());

          $.ajax({
            url:"update_userInfo.php",
            method:"POST",
            data:form_data,
            dataType:'json',
            processData: false,
            contentType: false,
            success:function(data){
              if(data.error != ''){
                alert(data.error);
                window.location.replace("profile.php");
              }
            },
            complete: function () {
              alert("update Successful.");
              window.location.replace("profile.php");
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

   $(document).on('click', '.viewPass', function(){
    var id = $(this).attr('id');
    var action = "show";
    var options = {
     ajaxPrefix: '',
     ajaxData: {id:id,action:action},
    };
    new Dialogify('changePassword.php', options)
    .buttons([
      {
        text:'Change',
        type:Dialogify.BUTTON_PRIMARY,
        click:function(e){
          var id = $('#old').val();
          var data = $('#new').val();
          $.ajax({
            url:"changePassword.php",
            method:"POST",
            data:{id:id, data:data},
            dataType:'json',
            success:function(data){
              if(data.error != ''){
                alert(data.error);
                window.location.replace("profile.php");
              }
            },
            complete: function () {
              alert("update Successful.");
              window.location.replace("profile.php");
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
