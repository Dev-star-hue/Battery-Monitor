<!--/**

This script shows current users devices.
It also redirect user to script which enables 
add a new devices. Devices are destinguished by
usernames and devicenames.Sql relation is "one to n" 
it means that one user should be able 
to manage multiple devices and each of those devices 
should have its own measurements.

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


<h1>Users Devices</h1>

<div class="ContainerOne">

<p1>Here is a list of devices and some intel about them. After creating device you can proceed to adding or viewing certain measurements.</p1>

<br>
<br>

<p2>Please add new device to the list or chose your device:</p2>

<br>
<br>


</div>

</body>


</html>

<?php


if (isset($_GET['username'])) {


  $username = $_GET['username'];


  echo "<div class=ContainerTwo>";
  echo "<a href=/webservice/Add_Device_Mysql.php?username=$username>Add new device now!</a><br>";
  echo "<p1>Welcome user:  $username</p1>";

  $server_db = "localhost";
  $username_db = "root";
  $password_db = "";
  $db = "ws2_db1";

  // Create connection
  $conn = new mysqli($server_db, $username_db, $password_db, $db);
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $sql = "SELECT ipaddress, devicename, timeanddate FROM devices WHERE username='$username'";

  echo '<table cellspacing="5" cellpadding="5">
      
       <tr> 
        <td>IP address</td> 
        <td>Device name</td> 
        <td>Timestamp</td> 
        <td>Options</td>  

      </tr>';

  if ($result = $conn->query($sql)) {

    while ($row = $result->fetch_assoc()) {
      $row_ipaddress = $row["ipaddress"];
      $row_devicename = $row["devicename"];
      $row_timestamp = $row["timeanddate"];


      echo '<tr> 
                <td>' . $row_ipaddress . '</td> 
                <td><a href="/webservice/Measurements.php?username=' . $username . '&devicename=' . $row_devicename . '">' . $row_devicename . '</a></td>
                <td>' . $row_timestamp . '</td> 
                <td><a href="/webservice/Delete_Device_Mysql.php?username=' . $username . '&devicename=' . $row_devicename . '">Delete</a></td>
              </tr>';

    }

    $result->free();
  }

  $conn->close();

  echo "</div>";



}



?>