<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);

curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Labyrinth-Email: " . $_GET["id"]));



//Start
if($_GET["endpoint"] === "start") {
	
	$endpoint = "http://challenge2.airtime.com:7182/start";

	curl_setopt($ch, CURLOPT_URL, $endpoint);
	
	$output = curl_exec($ch);
	curl_close($ch);

	echo $output;
	
}



//Check lights
if($_GET["endpoint"] === "wall")   {

	$endpoint = "http://challenge2.airtime.com:7182/wall?roomId=" . $_GET['roomId'];
	
	curl_setopt($ch, CURLOPT_URL, $endpoint);
	
	$output = curl_exec($ch);
	curl_close($ch);

	echo $output;
	
}


//Check Exits
if($_GET["endpoint"] === "exits") {

	$endpoint = "http://challenge2.airtime.com:7182/exits?roomId=" . $_GET['roomId'];
	
	curl_setopt($ch, CURLOPT_URL, $endpoint);
	
	$output = curl_exec($ch);
	curl_close($ch);

	echo $output;
	
}



//Move
if($_GET["endpoint"] === "move") {

	$endpoint = "http://challenge2.airtime.com:7182/move?roomId=" . $_GET['roomId'] . "&exit=" . $_GET['exit'];

	curl_setopt($ch, CURLOPT_URL, $endpoint);
	
	$output = curl_exec($ch);
	curl_close($ch);

	echo $output;
	
}



//Report
if($_GET["endpoint"] === "send") {
	
	$data =  new stdClass();
	
	$data->roomIds = explode(",", $_GET["roomIds"]);
	$data->challenge = $_GET["challenge"];
	
	$payload = json_encode($data);
	
	$endpoint = "http://challenge2.airtime.com:7182/report";
	
	curl_setopt($ch, CURLOPT_URL, $endpoint);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	
	curl_setopt($ch, CURLOPT_POSTFIELDS, $payload); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Labyrinth-Email: " . $_GET["id"], 'Content-Type: application/json', 'Content-Length: ' . strlen($payload)));  
	
	$result = curl_exec($ch);  
	
	echo $result;
	
}
