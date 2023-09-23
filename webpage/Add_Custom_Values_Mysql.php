<!--/**

This script serves for uploading data from a .csv file.
Data will be checked and stored in database.
User will be consequently redirected back to the 
"measurement" page.


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


<h1>Add new values</h1>



<div class="ContainerOne">

<p2>Please browse a file to upload:</p2>

<br>
<br>

<form enctype='multipart/form-data' action='#' method='post'>
		
<br>
<input size='50' type='file' name='filename'>
<br>
<br>
<label>Please add aditional information:</label>
<br>
<br>

  <label for="manufacturer">Manufacturer:</label><br>
  <input type="text" id="manufacturer" name="manufacturer"><br>
  <label for="capacity">Capacity:</label><br>
  <input type="text" id="capacity" name="capacity"><br>  
  <label for="voltage">Voltage:</label><br>
  <input type="text" id="voltage" name="voltage"><br>  
  <label for="numberofcells">Number of cells:</label><br>
  <input type="text" id="numberofcells" name="numberofcells"><br>  
  <label for="type">Type:</label><br>
  <input type="text" id="type" name="type"><br>  
 
 
<br>
<input type='submit' name='submit' value='Upload Products'>
 
</form>

</div>

</body>

<?php

if (isset($_POST['submit'])&&isset($_GET['username'])&&isset($_GET['devicename'])) 
	{

     echo "<div class=ContainerTwo>";
     
    //open and store all rows into array
    $handle = fopen($_FILES['filename']['tmp_name'], "r");
    $array = array();

		while (($data = fgetcsv($handle)) !== FALSE) 
		{

        $array[] = $data;


		}

fclose($handle);

//get rid of first value in csv what should be a name of rows
unset($array[0]);

//generate uid
    $measurementID = uniqid();


    $devicename = $_GET['devicename'];
    $username = $_GET['username'];

    $manufacturer = $_POST['manufacturer'];
    $capacity = $_POST['capacity'];
    $nominalvoltage = $_POST['voltage'];
    $numberofcells = $_POST['numberofcells'];
    $type = $_POST['type'];


    //database

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


    foreach ($array as $element) {

        
        $temperature = $element[0];
        $voltage = $element[1];
      

        echo '<pre>';
        echo $measurementID . "  " . $devicename . "  " . $temperature . " " . $voltage . " " . $username;
        echo '<pre>';




        // Create new record
        $sql = "INSERT INTO ws2_db1.measurements (measurementID, devicename, temperature, voltage, username,manufacturer, capacity, nominalvoltage, numberofcells, type)
                VALUES ('$measurementID', '$devicename', '$temperature', '$voltage', '$username', '$manufacturer', '$capacity', '$nominalvoltage','$numberofcells', '$type')";



        if ($conn->query($sql) === TRUE) {
            echo "Data inserted successfully";
        } else {
            echo "Error inserting data: " . $conn->error;
        }


    }
    
    
        $conn->close();
      
        echo "</div>";

        //Redirect back


       header("Location: /webservice/Measurements.php?username=$username&devicename=$devicename");
        
        exit;






	}


    


?>