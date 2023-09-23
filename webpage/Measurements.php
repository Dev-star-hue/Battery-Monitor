<!--/**

This script shows current measurements available 
on specific device.It also contains link which 
enables user to delete measurements individually
or to load new data from a .csv file.


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


<h1>Users Measurements</h1>

<div class="ContainerOne">

<p2>Please choose measurement form table below or upload your values:</p2>

<br>
<br>




</div>

</body>


</html>


<?php

if (isset($_GET["devicename"])&&isset($_GET["username"])) {


  $devicename = $_GET["devicename"];
  $current_user = $_GET["username"];


    echo "<div class=ContainerTwo>";
    echo "<a href=/webservice/Add_Custom_Values_Mysql.php?username=$current_user&devicename=$devicename>Upload your values!</a><br>";
    echo "<p1>Your device is:  $devicename </p1><br>";
    echo "<p1>Mesurements on this device are as followed:</p1><br>";





$server_db="localhost";
$username_db="root";
$password_db="";
$db="ws2_db1";

// Create connection
$conn = new mysqli($server_db, $username_db, $password_db, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT DISTINCT measurementID FROM measurements WHERE username='$current_user' AND devicename='$devicename'";

echo '<table cellspacing="5" cellpadding="5">
      
       <tr> 
        <td>measurementID</td> 
        <td>Options</td>  

      </tr>';
 
if ($result = $conn->query($sql)) {

    while ($row = $result->fetch_assoc()) {
      
        $row_measurementId = $row["measurementID"];
    
       
        
        echo '<tr> 
                <td><a href="/webservice/Graphs.php?devicename='.$devicename.'&username='.$current_user.'&measurementID='.$row_measurementId.'">'.$row_measurementId.'</a></td>
    
                <td><a href="/webservice/Delete_Measurement_Mysql.php?devicename='.$devicename.'&username='.$current_user.'&measurementID='.$row_measurementId.'">Delete</a></td>
              </tr>';


    }

    $result->free();
}

$conn->close();

echo "</div>";

}



?>