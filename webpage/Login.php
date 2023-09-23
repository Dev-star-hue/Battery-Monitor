<!--/**

This script serves for taking login data 
input like name and password from user.
Data will be checked in database.If user 
exists, access will be granted else rejected.
It also redirect user to another script which 
serves for creating a new user.

*/-->

<!DOCTYPE html>

<html>
<head>
  <link rel="stylesheet" href="styles.css">
</head>

<body>


<h1>Battery monitor</h1>



<div class="ContainerOne">

<p2>Please add your credentials or create a new user:</p2>

<br>
<br>


<form action="#" method="post">
  <label for="user">User:</label><br>
  <input type="text" id="user" name="user"><br>
  <label for="password">Password:</label><br>
  <input type="text" id="password" name="password"><br><br>
  <input type="submit" value="Login">
</form>

<br>
<a href="/webservice/Add_User_Mysql.php">Create new user now!</a>

</div>

</body>





</html>

<?php

//Input data check

if(isset($_POST["user"]) && isset($_POST["password"])){

    $loginName = $_POST["user"];
    $password = $_POST["password"];


         //Set up credentials
         $servernamesql = "localhost";
         $usernamesql = "root";
         $passwordsql = "";
       
     
    
     // Create connection
     $conn = new mysqli($servernamesql, $usernamesql, $passwordsql);

     // Check connection
     if ($conn->connect_error) {

         die("Connection failed: " . $conn->connect_error);
     }

     $sql = "SELECT username,loginname,password FROM ws2_db1.users WHERE loginname='$loginName' AND password='$password'";

     $result = $conn->query($sql);



     if ($result->num_rows > 0) {

      while ($row = $result->fetch_assoc()) {

      $row_username = $row["username"];

    }


        header("Location: /webservice/Devices.php?username=$row_username");
        
        

       }else {
      
        echo "User does not exist or check password!";
        }
 
     $conn->close();
     


}



?>