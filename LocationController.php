<?php
require_once  'Location.php';
class LocationController{
	public $connection=null;
	function __construct($connection) {
		$this->connection=$connection;
	}
	
	function save($location){
		try {
			$sql = "INSERT INTO location (city, state, country,zip_code,address,hotel)
							 VALUES ('$location->city', '$location->state', '$location->country','$location->zip_code','$location->address','$location->hotel')";
			$this->connection->exec($sql);
			$location->id =$this->connection->lastInsertId();
			return $location;
		}catch(PDOException $e)
		{
			return false;
		}
	}
	
	function update($location){
		try {
			$sql = "UPDATE location SET city = :city, state= :state, country= :country,zip_code= :zip_code,address= :address
							       WHERE hotel = :pk ";
			$query = $this->connection->prepare($sql);
			$query->bindValue(":city", $location->city);
			$query->bindValue(":state", $location->state);
			$query->bindValue(":country", $location->country);
			$query->bindValue(":zip_code", $location->zip_code);
			$query->bindValue(":address", $location->address);
			$query->bindValue(":pk", $location->hotel);
			$query->execute();
			return $location;
		}catch(PDOException $e)
		{   return $e->getMessage();
			return null;
		}
	}
	
	function get($pk){
		try {
			$query=$this->connection->prepare("SELECT * FROM location WHERE id=:param");
			$query->bindParam(':param', $pk);
			$query->execute();
			$result = $query -> fetch();
			return $result;
		}catch(PDOException $e)
		{
			return null;
		}
		
	}
	function remove($hotel){
		try {
			$query=$this->connection->prepare("DELETE  FROM location WHERE hotel=:param");
			$query->bindParam(':param', $hotel);
			$query->execute();
			return true;
		}catch(PDOException $e)
		{
			return false;
		}
		
	}
	
	function hotel_location($hotel){
		try {
			$query=$this->connection->prepare("SELECT * FROM location WHERE hotel=:param");
			$query->bindParam(':param', $hotel);
			$query->execute();
			$result = $query -> fetch();
			$location = new Location($result['city'],$result['state'],$result['country'],$result['zip_code'],$result['address'],$hotel);
			return $location;
		}catch(PDOException $e)
		{
			return null;
		}
		
	}
}



?>