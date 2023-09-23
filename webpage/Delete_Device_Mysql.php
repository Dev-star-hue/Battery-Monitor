<!--/**

This script should delete certain device and 
every measurement connected with this device.
After completion user will be redirected back 
to the list of all available devices.

*/-->

<?php

echo "Clearing...<br>";

if (isset($_GET["devicename"])&&isset($_GET["username"])) {

    $devicename = $_GET["devicename"];
    $current_user = $_GET["username"];

    //Set up credentials
    $servername_db = "localhost";
    $username_db = "root";
    $password_db = "";

    // Create connection
    $conn = new mysqli($servername_db, $username_db, $password_db);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

     // delete all measurments created with device
     $sql = "DELETE FROM ws2_db1.measurements WHERE devicename='$devicename' AND username='$current_user'";



     if ($conn->query($sql) === TRUE) {
         echo "Data deleted successfully";
     } else {
         echo "Error in processing request: " . $conn->error;
     }


    // delete device
    $sql = "DELETE FROM ws2_db1.devices WHERE devicename='$devicename' AND username='$current_user'";



    if ($conn->query($sql) === TRUE) {
        echo "Data deleted successfully";
    } else {
        echo "Error in processing request: " . $conn->error;
    }


    $conn->close();

    header("Location: /webservice/Devices.php?username=$current_user");
        
    exit;
}

?>