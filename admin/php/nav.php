<?php
  include 'php/databaseConnect.php';
 ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <!-- Font Awesome JS -->
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
    <title>Boi Prokosholi</title>
</head>

<body>
    <!-- Sidebar  -->
    <nav id="sidebar" >
        <div class="sidebar-header">
            <h3>Boi Prokosholi</h3>
        </div>

        <ul class="list-unstyled components">
            <li>
                <a href="customer.php">Members</a>
            </li>

            <li>
                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Books</a>
                <ul class="collapse list-unstyled" id="homeSubmenu">
                    <li>
                        <a href="bookList.php">Book List</a>
                    </li>
                    <li>
                        <a href="addBook.php">Add New Book</a>
                    </li>
                    <li>
                        <a href="updateDept.php?value=2">Add New Category</a>
                    </li>
                    <li>
                        <a href="updateDept.php?value=1">Add New Department</a>
                    </li>
                </ul>
            </li>
            
            <li>
                <a href="#discountSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Discount</a>
                <ul class="collapse list-unstyled" id="discountSubmenu">
                    <li>
                        <a href="discountList.php">Discount List</a>
                    </li>
                    <li>
                        <a href="discountAdd.php">Add Discount</a>
                    </li>
                    
                </ul>
            </li>

            <li>
                <a href="#promoSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Promotion</a>
                <ul class="collapse list-unstyled" id="promoSubmenu">
                    <li>
                        <a href="promoList.php">Promotion List</a>
                    </li>
                    <li>
                        <a href="promoAdd.php">Add Promotion</a>
                    </li>
                    
                </ul>
            </li>

            <li>
                <a href="#blogSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Blog</a>
                <ul class="collapse list-unstyled" id="blogSubmenu">
                    <li>
                        <a href="blogList.php">Blog List</a>
                    </li>
                    <li>
                        <a href="blogAdd.php">Add Blog</a>
                    </li>
                    
                </ul>
            </li>

            <li>
                <a href="#rentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Rent Book</a>
                <ul class="collapse list-unstyled" id="rentSubmenu">
                    <li>
                        <a href="rentPendingBook.php">Pendding Books</a>
                    </li>
                    <li>
                        <a href="rentReturnBook.php">Return Books</a>
                    </li>
                    <li>
                        <a href="rentNon-ReturnBook.php">Non-return Books</a>
                    </li>
                    <li>
                        <a href="rentUniversity.php">University Availability</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#orderSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Order</a>
                <ul class="collapse list-unstyled" id="orderSubmenu">
                    <li>
                        <a href="orderPending.php">Pending order</a>
                    </li>
                    <li>
                        <a href="orderDelivered.php">Finished order</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="contact.php">Messages</a>
            </li>
        </ul>
    </nav>

   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <!-- Popper.JS -->
  <!  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script> 
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });
    </script>
</body>

</html>
