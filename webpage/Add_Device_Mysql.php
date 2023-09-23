<!--/**

This script serves for taking information about device.
Data will be checked and stored in database.
User will be consequently redirected back to the "available
devices" page.


*/-->

<!DOCTYPE html>

<html>
<head>
  <link rel="stylesheet" href="styles.css">
</head>

<?php
//setup navigation

if(isset($_GET['username'])){

$username = $_GET['username'];

  echo "
<div class=topnav>
  <a class=active href=/webservice/Devices.php?username=$username>Devices</a>
  <a href=/webservice/Users.php?username=$username>Users</a>
  <a href=/webservice/Login.php>Logout</a>
</div>";



}
?>

<body>


<h1>Add new device</h1>



<div class="ContainerOne">

<p2>Please add credentials:</p2>

<br>
<br>


<form action="#" method="post">
  <label for="ipaddress">IP address:</label><br>
  <input type="text" id="ipaddress" name="ipaddress"><br>
  <label for="dname">Device name:</label><br>
  <input type="text" id="dname" name="dname"><br><br>
  <input type="submit" value="Add">
</form>

</div>

</body>





</html>

<?php
//prevzatie vstupných dát potrebných na prihlasenie
if(isset($_POST["ipaddress"]) && isset($_POST["dname"])&& isset($_GET["username"])){

    $ipaddress = $_POST["ipaddress"];
    $deviceName = $_POST["dname"];
    $current_user = $_GET["username"];


 //add data to database
        echo "<div class=ContainerTwo>";

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
    
    
        // Create new user
        $sql = "INSERT INTO ws2_db1.devices (devicename, ipaddress, username)
                VALUES ('$deviceName', '$ipaddress', '$current_user')";

    
    
        if ($conn->query($sql) === TRUE) {
            echo "Data inserted successfully";
        } else {
            echo "Error inserting data: " . $conn->error;
        }
    
    
        $conn->close();
      
        echo "</div>";

        //Redirect back

        header("Location: /webservice/Devices.php?username=$current_user");
        
        exit;



    }
    
      








?>

