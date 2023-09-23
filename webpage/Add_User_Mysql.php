<!--/**

This script serves for taking informatons about user. 
Those informations include name, address, username, password.
Data will be checked and stored in database. 
User will be consequently redirected back to the login page. 
Be carefull no duplicity accepted!!!

*/-->

<!DOCTYPE html>

<html>
<head>
  <link rel="stylesheet" href="styles.css">
</head>

<body>


<h1>Create a new user</h1>



<div class="ContainerOne">

<p2>Please add credentials:</p2>

<br>
<br>


<form action="#" method="post">
  <label for="uname">Name:</label><br>
  <input type="text" id="uname" name="uname"><br>
  <label for="uaddress">Address:</label><br>
  <input type="text" id="uaddress" name="uaddress"><br>
  <label for="lname">Login name:</label><br>
  <input type="text" id="lname" name="lname"><br>
  <label for="npassword">New password:</label><br>
  <input type="text" id="npassword" name="npassword"><br>
  <label for="rpassword">Retype new password:</label><br>
  <input type="text" id="rpassword" name="rpassword"><br>
  <br>
  <input type="submit" value="Create">
</form>

</div>

</body>





</html>

<?php
//prevzatie vstupných dát potrebných na prihlasenie
if(isset($_POST["uname"]) && isset($_POST["uaddress"]) && isset($_POST["lname"]) && isset($_POST["npassword"]) && isset($_POST["rpassword"])){

    $userName = $_POST["uname"];
    $userAddress = $_POST["uaddress"];
    $loginName = $_POST["lname"];
    $newPassword = $_POST["npassword"];
    $retypedPassword = $_POST["rpassword"];

    echo "<div class=ContainerTwo>";

    //kontrola dat s datami v databaze

    if($newPassword == $retypedPassword && $userName != null && $userAddress != null && $loginName != null ){


        //Set up credentials
        $servername = "localhost";
        $username = "root";
        $password = "";
    
        // Create connection
        $conn = new mysqli($servername, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
    
        // Create new user
        $sql = "INSERT INTO ws2_db1.users (username, useraddress, loginname, password)
                VALUES ('$userName', '$userAddress', '$loginName', '$newPassword')";
    
        if ($conn->query($sql) === TRUE) {
            echo "Data inserted successfully";
        } else {
            echo "Error inserting data: " . $conn->error;
        }
    
    
        $conn->close();
      
        echo "</div>";


        //Redirect


        header("Location: /webservice/Login.php");
        
        exit;



    } else{
     
        echo "Please try again!";

    }
    
      

}






?>

