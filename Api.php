<?php
require  'connection.php';
require  'HotelController.php';
require  'LocationController.php';

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
$LocationController = new LocationController($connection);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message = check_form($_POST);
	if($message!= null){
		echo json_encode($message);return;
	}
	$hotel = new Hotel($_POST["name"],$_POST["rating"],$_POST["category"],
						$_POST["image"],$_POST["reputation"],$_POST["price"],$_POST["availability"]);
	
	
	if(!isset($_POST["id"])){
		$hotel = $HotelController->save($hotel);

		if($hotel){
			
			$location = new Location($_POST["city"] ,$_POST["state"], $_POST["country"],$_POST["zip"],$_POST["address"],$hotel->id);
			$location = $LocationController->save($location);
			echo json_encode('Hotel created');return;
		}
		echo json_encode('Hotel not created');return;
		
	}else{
		$hotel->id=$_POST["id"];
		$hotel = $HotelController->update($hotel);
		if($hotel){
			$location = new Location($_POST["city"] ,$_POST["state"], $_POST["country"],$_POST["zip"],$_POST["address"],$hotel->id);
			$location = $LocationController->update($location);
			echo json_encode('Hotel updated');return;
		}
		echo json_encode('Hotel not updated');return;
	}
	
	
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(!isset($_GET["page"]) && empty($_GET["pk"]) ){
		$data = array("Api" => "GET", "DETAILS" => "Get list or single item of hotel",
		"How" =>"GET /Api/?<page:integer> OR GET /Api/?<pk:integer> " ,"EXMPLE"=>"GET /Api/?page=1  OR GET /Api/?pk=1");
		echo json_encode($data,JSON_PRETTY_PRINT);return;
	}	
	if(isset($_GET["pk"])){
		$hotel = $HotelController->get($_GET["pk"],$_GET["field"]);
		echo json_encode($hotel,JSON_PRETTY_PRINT);return;
	}
	if(isset($_GET["page"])){
		$data = $HotelController->full_list($_GET["page"]);
		echo json_encode($data,JSON_PRETTY_PRINT);return;
		
	}
	
}

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
		parse_str(file_get_contents('php://input'), $params);
	
		if(!isset($params["pk"]) && empty( $params["pk"]) ){
			$data = array("Api" => "DELETE", "DETAILS" => "Delete Api item",
				"How" =>"DELETE /Api/?<pk:integer> " ,"EXMPLE"=>"DELETE /Api/?pk=1");
				echo json_encode($data,JSON_PRETTY_PRINT);return;
		}
		$data = $HotelController->remove($params["pk"]);
		if ($data){
			$location = $LocationController->remove($params["pk"]);
			echo json_encode('Hotel deleted');return;
		}
		echo json_encode('Hotel not deleted');return;
}







function  check_form($input){
	$message = null;
	$name = $input["name"];
    $rating = $input["rating"];
    $category= $input["category"];
    $city = $input["city"];
    $state = $input["state"];
    $country = $input["country"];
    $zip_code = $input["zip"];
    $address = $input["address"];
    $image = $input["image"];
    $reputation = $input["reputation"];
    $price = $input["price"];
	$availability = $input["availability"];
	$category_array = array('hotel', 'alternative', 'hostel', 'lodge', 'resort', 'guest-house');
	
	if (strlen($name) < 10){
		$message =array ('Error'=>'name should be longer than 10 characters');
	}
	if (!is_numeric($price)){
		$message =array ('Error'=>'The price must be an integer');
	}
	if (!is_numeric($availability) || $availability ==''){
		$message =array ('Error'=>' The availability must be an integer');
	}
	if ($city ==''){
		$message =array ('Error'=>'Enter city');
	}
	if ($state ==''){
		$message =array ('Error'=>'Enter state');
	}
	if ($country ==''){
		$message =array ('Error'=>'Enter country');
	}
	if ($address ==''){
		$message =array ('Error'=>'Enter address');
	}
	if ($reputation < 0 || $reputation > 1000 || !is_numeric($reputation)){
		$message =array ('Error'=>'The reputation MUST be an integer >= 0 and <= 1000');
	}
	if ($zip_code< 10000 || $zip_code> 999999 || !is_numeric($zip_code)){
		$message =array ('Error'=>'The zip code MUST be an integer and must have a length of 5');
	}
	if ($rating  < 0 || $rating	> 5  || !is_numeric($zip_code)){
		$message =array ('Error'=>'Rating must   >= 0 and <= 5');
	}
	if (!in_array($category,$category_array)){
		$message =array ('Error'=>'The category can be one of [hotel, alternative, hostel, lodge, resort, guest-house]');
	}
	if(!filter_var($image, FILTER_VALIDATE_URL)){
		$message =array ('Error'=>'The image MUST be a valid URL');
	}
	
	return $message;
	
	
}











?>