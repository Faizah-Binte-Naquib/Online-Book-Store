
<?php
    include_once 'config.php';

    if (isset($_POST["name"])) {
        $error = '';
        $success = '';

        $id = $_POST["id"];
        $name = $_POST["name"];
        $studentID = $_POST["studentID"];
        $year = $_POST["year"];
        $semester = $_POST["semester"];
        if(empty($_POST["university"])){
            $university = NULL;
        }else{
        $university = $_POST["university"];
        }
        $depertment = $_POST["depertment"];
        $nid = $_POST["nid"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $secondaryAddress = $_POST["secondaryAddress"];
        
        $yersem = $year.'-'.$semester;


        if($error == ''){
        $stmt = $db->prepare("UPDATE customer SET Customer_name = ? , Customer_phone = ? , Customer_university = ? , Customer_department = ? ,Customer_semester = ?,Customer_studentID = ?, Customer_address = ? , Customer_secondary_address = ? , NID = ? WHERE Customer_ID = ? ;");
        $stmt->bind_param("ssisssssii", $name, $phone, $university, $depertment,$yersem,$studentID, $address, $secondaryAddress, $nid,$id);
        
        $stmt->execute();
        $stmt->close();
        $db->close();
        $success ="Updated Successfully.";
        $error ="";
        }
        
    }

    $output = array(
        'success'  => $success,
        'error'   => $error
    );

    echo json_encode($output);

 ?>