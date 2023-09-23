<!--/**

This script should delete certain user his devices and 
every measurement connected with a specific device.
After completition user will be redirected back to the
list of all users.

*/-->

<?php

echo "Clearing...<br>";

if (isset($_GET["username"]) && isset($_GET["delete"])) {

    $username = $_GET["username"];
    $delete = $_GET["delete"];

    if ($username == "admin" && $delete != "admin") {

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
        $sql = "DELETE FROM ws2_db1.measurements WHERE username='$delete'";


        if ($conn->query($sql) === TRUE) {
            echo "Data deleted successfully";
        } else {
            echo "Error in processing request: " . $conn->error;
        }


        // delete device
        $sql = "DELETE FROM ws2_db1.devices WHERE username='$delete'";



        if ($conn->query($sql) === TRUE) {
            echo "Data deleted successfully";
        } else {
            echo "Error in processing request: " . $conn->error;
        }

        // delete user
        $sql = "DELETE FROM ws2_db1.users WHERE username='$delete'";



        if ($conn->query($sql) === TRUE) {
            echo "Data deleted successfully";
        } else {
            echo "Error in processing request: " . $conn->error;
        }

        $conn->close();

        header("Location: /webservice/Users.php?username=$username");

        exit;

    }else{

        echo "You can't do that! Please login as admin!";
        header( "refresh:2; url=/webservice/Users.php?username=$username" );
    
    }

}else{

    header("Location: /webservice/Users.php");

    exit;

}

?>