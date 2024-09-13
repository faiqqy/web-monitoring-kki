<?php
//ini_set('display_errors', 0);
header('Access-Control-Allow-Origin: *');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

$sql ="select * from geotag";
$result= $conn->query($sql);

//membuat variabel untuk dimasukan data
$infoGeotag=new stdClass();
$infoGeotag->records=array();
$i = 0;

//memasuakan data info geotag ke object geotag
while($row = $result->fetch_assoc()){
	
	$infoGeotag->records[$i]=new stdClass();
	$infoGeotag->records[$i]->DAY=$row["DAY"];
	$infoGeotag->records[$i]->DATE=$row["DATE"];
	$infoGeotag->records[$i]->TIME=$row["TIME"];
	$infoGeotag->records[$i]->COORDINATE=$row["COORDINATE"];
	$infoGeotag->records[$i]->SOG=$row["SOG"];
	$infoGeotag->records[$i]->SOG2=$row["sog2"];
	$infoGeotag->records[$i]->COG=$row["COG"];
	$i++;
	
}

    echo json_encode($infoGeotag);

?>

