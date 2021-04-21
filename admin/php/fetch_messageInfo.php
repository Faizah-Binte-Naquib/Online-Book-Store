<?php

include_once 'databaseConnect.php';

if(isset($_GET["id"])){

 $id = intval($_GET["id"]);
 $query = "SELECT * FROM contact WHERE Contact_ID = $id;";
 $result = mysqli_query($conn, $query);
 $output = '';

 $queryresult = mysqli_num_rows($result);

    while ($row = mysqli_fetch_assoc($result)) {
        $output .= '
            <div class="messageInfo">
            <h3>'.$row["Contact_name"].'</h3>
            <p><span>Phone Number : </span>'.$row["Contact_phone"].'</p>
            <br />
            <div>Message:</div>
            <p>'.$row["Message"].'</p>
            <br />
            </div>
        ';
    }
 echo $output;
}
?>