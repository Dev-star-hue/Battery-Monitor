<!--/**

This script shows all users accounts.
It is possible to delete users but only if current 
user is admin else acces won't be granted.

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


<h1>All users:</h1>

<div class="ContainerOne">

<p2>Please manage users information:</p2>

<br>
<br>


</div>

</body>


</html>


<?php

if (isset($_GET['username'])) {

  $username = $_GET['username'];

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

  $sql = "SELECT username,timeanddate FROM ws2_db1.users";


  echo "<div class=ContainerTwo>";
  echo '<table cellspacing="5" cellpadding="5">
      
       <tr> 
        <td>Username</td> 
        <td>Timestamp</td> 
        <td>Options</td>  

      </tr>';

  if ($result = $conn->query($sql)) {

    while ($row = $result->fetch_assoc()) {

      $row_username = $row["username"];
      $row_timestamp = $row["timeanddate"];


      echo '<tr> 
                <td>' . $row_username . '</td>
                <td>' . $row_timestamp . '</td>
                <td><a href="/webservice/Delete_User_Mysql.php?username=' . $username . '&delete=' . $row_username . '">Delete</a></td>
              </tr>';


    }

    $result->free();
  }

  $conn->close();
  echo "</div>";


}
?>