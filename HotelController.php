<?php
require_once  'Hotel.php';
class HotelController{
	
	
	public $connection=null;
	function __construct($connection) {
		$this->connection=$connection;
	}
	
	function full_list($page){
		try {
			$data = array();
			$limit = 10;
			$offset = ($page * 10) - 10;
			$query=$this->connection->prepare("SELECT * FROM hotel  LIMIT :limit OFFSET :offset");
			$query->bindParam(':limit', $limit, PDO::PARAM_INT);
			$query->bindParam(':offset', $offset, PDO::PARAM_INT);

			$query->execute();
			$result = $query -> fetchAll();
			foreach( $result as $row ) {
				$hotel = new Hotel($row["name"],$row["rating"],$row["category"],
							$row["image"],$row["reputation"],$row["price"],$row["availability"]);
				$hotel->id = $row["id"];
				$hotel =$hotel->get_object($this->connection);
				array_push($data,$hotel);
			}
			return $data;
		}catch(PDOException $e)
		{   
		
			return $e->getMessage();

		}
		
	}
	
	function save($hotel){
		try {
			$sql = "INSERT INTO hotel(name, rating, category,image,reputation,reputationBadge,price,availability )
							 VALUES ('$hotel->name', '$hotel->rating', '$hotel->category','$hotel->image','$hotel->reputation','$hotel->reputation_badge',
							 '$hotel->price','$hotel->availability')";
			$this->connection->exec($sql);
			$hotel->id =$this->connection->lastInsertId();
			return $hotel;
		}catch(PDOException $e)
		{   
			return null;
		}
	}
	
	function update($hotel){
		try {
			$sql = "UPDATE hotel SET name = :name, rating= :rating, category= :category,image= :image,reputation= :reputation,
									reputationBadge= :reputationBadge,price= :price,availability= :availability
							       WHERE id = :pk ";
			$query = $this->connection->prepare($sql);
			$query->bindValue(":name", $hotel->name);
			$query->bindValue(":rating", $hotel->rating);
			$query->bindValue(":category", $hotel->category);
			$query->bindValue(":image", $hotel->image);
			$query->bindValue(":reputation", $hotel->reputation);
			$query->bindValue(":reputationBadge", $hotel->reputation_badge);
			$query->bindValue(":price", $hotel->price);
			$query->bindValue(":availability", $hotel->availability);
			$query->bindValue(":pk", $hotel->id);
			$query->execute();
			return $hotel;
		}catch(PDOException $e)
		{   return $e->getMessage();
			return null;
		}
	}
	
	function get($pk,$field=null){
		try {
			$query=$this->connection->prepare("SELECT * FROM hotel WHERE id=:param");
			$query->bindParam(':param', $pk);
			$query->execute();
			$result = $query -> fetch();
			$hotel = new Hotel($result["name"],$result["rating"],$result["category"],
						$result["image"],$result["reputation"],$result["price"],$result["availability"]);
			$hotel->id = $result["id"];
			if($field!= null){
				return $hotel->get_object_field($field,$this->connection);
			}
			return $hotel->get_object($this->connection);
		}catch(PDOException $e)
		{
			return null;
		}
		
	}
	
	function book($pk){
		
		try {
			$query=$this->connection->prepare("SELECT * FROM hotel WHERE id=:param");
			$query->bindParam(':param', $pk);
			$query->execute();
			$result = $query -> fetch();
			$hotel = new Hotel($result["name"],$result["rating"],$result["category"],
						$result["image"],$result["reputation"],$result["price"],$result["availability"]);
			$hotel->id = $result["id"];
			if($hotel->availability <= 0){
				return null;
			}else{
				$hotel->availability = $hotel->availability - 1;
				$this->update($hotel);
				return $hotel;
			}
			
		}catch(PDOException $e)
		{
			return null;
		}
		
	}
	
	function remove($pk){
		try {
			$query=$this->connection->prepare("DELETE  FROM hotel WHERE id=:param");
			$query->bindParam(':param', $pk);
			$query->execute();
			return true;
		}catch(PDOException $e)
		{
			return false;
		}
		
	}
	
	
}


?>