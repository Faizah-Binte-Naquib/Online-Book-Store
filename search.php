
<?php include "header.php"?>
<!--Search--->

<style>
img:hover{
  opacity:0.8;
}
</style>

<div style="margin-top:20px;margin-bottom:20px;">
<?php

if(isset($_POST['search']))

{
include('config.php');
$searchq = $_POST['search'];
$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
$query="SELECT * from books where BookName like '%$searchq%' OR BookAuthor like '%$searchq%'";
$result = mysqli_query($db,$query)or die("cant find user in database");

$count=mysqli_num_rows($result);


if($count == 0){
?><h4 style="font-weight:bold;color:white;background-color:black;"><?php $output = 'There was no search results !! Please contact us here +880 1552-655253 or boiprcom@gmail.com for informations on the  book you are looking for.';
   echo $output;?></h4>
<?php}
else
{?>
<div class="row">
<?php
while($row = mysqli_fetch_array($result)){
?>
<div class="col-md-3" style="margin-left:50px;">
  <a href="product.php?productid=<?php echo $row['BookID']?>"><img src="img/product/<?php echo $row['BookImage'];?>" style="width:250px;height:320px;"/></a>
  <h5><?php echo $row['BookName']?></h5>
  <h5>৳<?php echo $row['BookPrice']?></h5>
</div>

<?php
}
?>
</div>
<?php
}
}
?>
</div>

<br>
<br>
<?php include "footer.php"?>
