
<?php
    include_once 'databaseConnect.php';

    if (isset($_POST["id"]) && isset($_POST["data"])) {
        $id = intval($_POST["id"]);
        $data = intval($_POST["data"]);
        $stmt = $conn->prepare("UPDATE books SET DiscountPercentage = ? WHERE BookID = ?;");
        $stmt->bind_param("ii", $data,$id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        $success ="Updated Successfully.";
        $error ="";
        
    }
    else {
        $error ="error";
        $success ="";
    }
    
    $output = array(
        'success'  => $success,
        'error'   => $error
       );
       echo json_encode($output);

 ?>