<?php
require  'connection.php';
require  'HotelController.php';

$database = new Database();
$connection = $database->connect_to_db();
if ($connection == null){
	$connection = $database->create_db();
	if($connection ==null){
		echo 'There error when try to connect to server.';
		die;
	}
}
$HotelController = new HotelController($connection);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 

	if(isset($_POST["pk"])){
		$hotel = $HotelController->book($_POST["pk"]);
		if($hotel){
			echo json_encode('Hotel booked done');return;
		}
		echo json_encode(array('Error'=>'There is no availability !'));return;
		
	}
	
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	
	header('X-PHP-Response-Code: 400', true, 404);
	echo json_encode(array('Error'=>'Method not Allowed'));return;
}


?>