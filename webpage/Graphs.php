<!--/**

This script retrieve all necessary measured data from database.
Consequently data ,temperature,voltage and battery information
will be printed out using CanvasJS grafs and table.


*/-->

<?php


$dataPoints = array();
$dataPoints1 = array();


if (isset($_GET['devicename']) && isset($_GET['username']) && isset($_GET['measurementID'])) {


    $devicename = $_GET["devicename"];
    $username = $_GET["username"];
    $measurementID = $_GET["measurementID"];


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

    $sql = "SELECT voltage,temperature,manufacturer,capacity,nominalvoltage,numberofcells,type FROM measurements WHERE username='$username' AND devicename='$devicename' AND measurementID='$measurementID'";


    if ($result = $conn->query($sql)) {

        $index = 0;

		echo '<table cellspacing="5" cellpadding="5">
      
		<tr> 
		 
		 <td>Manufacturer</td> 
		 <td>Capacity</td> 
		 <td>Nominal voltage</td> 
		 <td>Number of cells</td>
		 <td>Type</td>   

	   </tr>';
       

        while ($row = $result->fetch_assoc()) {

         if($index == 0){

			$row_manufacturer = $row["manufacturer"];
			$row_capacity = $row["capacity"];
			$row_nominalvoltage = $row["nominalvoltage"];
			$row_numberofcells = $row["numberofcells"];
			$row_type = $row["type"];

			echo '<tr> 

			<td>' . $row_manufacturer . '</td>
			<td>' . $row_capacity . '</td> 
			<td>' . $row_nominalvoltage . '</td>  
			<td>' . $row_numberofcells . '</td> 
			<td>' . $row_type . '</td> 

		  </tr>';
          
		 }


			//-------------------Charts data-------------------------//


            $row_voltage = $row["voltage"];

            $points = array("label" => $index , "y" => $row_voltage);

            array_push($dataPoints,$points);



            $row_temperatures = floatval($row["temperature"]);
          
            $points1 = array("label" => $index , "y" => $row_temperatures);

            array_push($dataPoints1,$points1);

		 
            $index++;
        }
		







        $result->free();
    }

    

    $conn->close();




} else {

    echo "Try again!!";
}

header("refresh: 5;");

?>



<!DOCTYPE HTML>
<html>
<head>  

<head>
  <link rel="stylesheet" href="styles.css">
</head>



<body>
<?php

//setup navigation

if(isset($_GET['username'])){

$username = $_GET['username'];

  echo "
<div class=topnav>
  <a class=active href=/Devices.php?username=$username>Devices</a>
  <a href=/Users.php?username=$username>Users</a>
  <a href=/Login.php>Logout</a>
</div>";



}
?>


	
<div class="ContainerOne">

<h1>Battery information and measured values</h1>
<br>
<p1>Measured values and informations about battery are shown in this section.</p1>
<br>
<br>
<br>


</div>

<script>
window.onload = function () {


var chart = new CanvasJS.Chart("chartContainer1", {
	animationEnabled: true,
	theme: "dark2",
	title:{
		text: "Voltage dependence"
	},
	axisX:{
        title: "Sample",
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	axisY:{
		title: "Voltage [V]",
		includeZero: true,
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	toolTip:{
		enabled: false
	},
	data: [{
		type: "area",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});

         chart.render();

         

var chart1 = new CanvasJS.Chart("chartContainer2", {
	animationEnabled: true,
	theme: "dark2",
	title:{
		text: "Temperature dependence"
	},
	axisX:{
        title: "Sample",
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	axisY:{
		title: "Temperature [°C]",
		includeZero: true,
		crosshair: {
			enabled: true,
			snapToDataPoint: true
		}
	},
	toolTip:{
		enabled: false
	},
	data: [{
		type: "area",
		dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	}]
});

chart1.render();

}

</script>


</head>

<body>
<div id="chartContainer1" style="height: 370px; width: 50%;margin:10px;float:left"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>



<br>



<div id="chartContainer2" style="height: 370px; width: 50%; margin:10px;float:left;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</body>







<body>
</html>


<?php



if (isset($_GET['devicename']) && isset($_GET['username']) && isset($_GET['measurementID'])) {


    $devicename = $_GET["devicename"];
    $username = $_GET["username"];
    $measurementID = $_GET["measurementID"];


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

    $sql = "SELECT voltage,temperature,timeanddate FROM measurements WHERE username='$username' AND devicename='$devicename' AND measurementID='$measurementID'";

	$indexx = 0;

	

    if ($result = $conn->query($sql)) {


		echo '<table cellspacing="5" cellpadding="5">
      
		<tr> 
		 
		 <td>Sample</td> 
		 <td>Temperature</td> 
		 <td>Voltage</td> 
		 <td>Timestamp</td> 
		 
		  

	   </tr>';
       

        while ($row = $result->fetch_assoc()) {

			$row_tempe= $row["temperature"];
			$row_volt= $row["voltage"];
			$row_timedate = $row["timeanddate"];

			echo '<tr> 
           
			<td>' . $indexx . '</td>
			<td>' . $row_tempe . '</td>
			<td>' . $row_volt . '</td> 
			<td>' . $row_timedate . '</td>  

		  </tr>';
        
		  $indexx++;

		
        }


       

        $result->free();
    }

    

    $conn->close();




} else {

    echo "Try again!!";
}

?>
