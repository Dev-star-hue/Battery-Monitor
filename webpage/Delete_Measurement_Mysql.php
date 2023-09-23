<!--/**

This script should delete selected measurement and all
its data stored on database.After completion user will 
be redirected back to the
list of all measurement.

*/-->


<?php

echo "Clearing...<br>";

if (isset($_GET["measurementID"]) && isset($_GET["devicename"]) && isset($_GET["username"])) {


    $devicename = $_GET["devicename"];
    $username = $_GET["username"];
    $measurementID = $_GET["measurementID"];

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
    
     $sql = "DELETE FROM ws2_db1.measurements WHERE devicename='$devicename' AND username='$username' AND measurementID='$measurementID'";


     if ($conn->query($sql) === TRUE) {
         echo "Data deleted successfully";
     } else {
         echo "Error in processing request: " . $conn->error;
     }





    $conn->close();

    header("Location: /webservice/Measurements.php?username=$username&devicename=$devicename");
        
    exit;
}

?>