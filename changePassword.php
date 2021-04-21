<?php
session_start();
include_once 'config.php';

if(isset($_GET["id"]) && isset($_GET["action"])){

    $id = intval($_GET["id"]);
    $output = '';
        $output .= '
        <p class="h4 mb-4">Change Password </p>

        <div class="form-group">
            <label for="old">Enter old Password</label>
            <input type="text" class="form-control" id="old" name="old" value="">
        </div>
        <div class="form-group">
            <label for="new">Enter New Password</label>
            <input type="text" class="form-control" id="new" name="new" value="">
        </div>
        ';
    echo $output;
}

else{

    $error = '';
    $success = '';
    $old = '';
    $new = '';

    $id = $_SESSION["login_user"];

    if(empty($_POST["id"])){
    $error .= 'Old Password is Required. ';
    }
    else{
    $old = $_POST["id"];
    }

    if(empty($_POST["data"])){
    $error .= 'New Password is Required';
    }
    else{
    $new = $_POST["data"];
    }


    $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
    $password_encrypted_old= base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $old, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    $password_encrypted= base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $new, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );


    $query = "SELECT Customer_ID FROM customer where Customer_password = '".$password_encrypted_old."' and Customer_ID = $id";
    $result = mysqli_query($db, $query);

    if($error == ''){
        if(mysqli_num_rows($result) > 0){
            $stmt = $db->prepare("UPDATE customer SET Customer_password = ? WHERE Customer_ID = ? ;");
            $stmt->bind_param("si", $password_encrypted,$id);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            $success ='New Password is set';
            $error ="";
        }
        else{
            $error ="Old password is incorrect.";
        }
    }
    

    $output = array(
        'success'  => $success,
        'error'   => $error
    );

    echo json_encode($output);
    

}


?>