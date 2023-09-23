<?php 


$server_db="localhost";
$username_db="root";
$password_db="";
$db="ws2_db1";



if ($_SERVER["REQUEST_METHOD"] == "GET") {

    if (isset($_GET["username"])) {

        $measurementID = $_GET["measurementID"];
        $username = $_GET["username"];
        $devicename = $_GET["devicename"];
        $manufacturer = $_GET["manufacturer"];
        $capacity = $_GET["capacity"];
        $nominalvoltage = $_GET["nominalvoltage"];
        $numberofcells = $_GET["numberofcells"];
        $type = $_GET["type"];
        $voltage = $_GET["voltage"];
        $temperature = $_GET["temperature"];



        // Create connection
        $conn = new mysqli($server_db, $username_db, $password_db, $db);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //insert value
        $sql = "INSERT INTO measurements (measurementID,username,devicename,voltage,temperature,manufacturer,capacity,nominalvoltage,numberofcells,type)
       VALUES ('$measurementID','$username','$devicename','$voltage','$temperature','$manufacturer','$capacity','$nominalvoltage','$numberofcells','$type')";

        echo $sql;


        if ($conn->query($sql) === TRUE) {
            // echo "New record created successfully";
        } else {
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}



   
?>