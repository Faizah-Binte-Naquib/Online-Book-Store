<?php
session_start();
include_once 'databaseConnect.php';

if(isset($_POST["refresh"])){
    header("Location:../discountAdd.php");
}

if(isset($_POST['resetDiscount'])){
    if(isset($_SESSION['discountBookID'])){
        unset($_SESSION['discountBookID']);
        header("Location:../discountAdd.php");
    }
}

if(isset($_POST['addForDiscount'])){
    $data = $_POST['addForDiscount'];
    $exist = 0;
    if(isset($_SESSION['discountBookID'])){
        foreach($_SESSION['discountBookID'] as $key=>$value){
            if($value == $data){
                $exist = 1;
                break;
            }
        }
        if($exist == 0){
            array_push($_SESSION['discountBookID'],$data);
        }  
    }
    else {
        $my_array=array();
        $_SESSION['discountBookID']=$my_array;
        array_push($_SESSION['discountBookID'],$data);
    }
    header("Location:../discountAdd.php");
}

if(isset($_POST['doneDiscount'])){
    if(isset($_SESSION['discountBookID'])){
        $discountData = $_POST['discount'];

        foreach($_SESSION['discountBookID'] as $key=>$value){
            $stmt = $conn->prepare("UPDATE books SET DiscountPercentage = ? WHERE BookID = ?;");
            $stmt->bind_param("ii", $discountData,$value);
            $stmt->execute();            
        }
        $stmt->close();
        $conn->close();
        unset($_SESSION['discountBookID']);
        $_SESSION['discountMessage'] = "discount added";
        header("Location:../discountAdd.php");
    }
}



header("Location:../discountAdd.php");

?>

