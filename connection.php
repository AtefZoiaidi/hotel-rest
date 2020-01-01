<?php


class Database{
	private $database = "hoteldb";
	private $host = "localhost";
	private $root = "root";
	private $password = "";
	public $connction = null;
	private $db_sql = "CREATE DATABASE hoteldb";
	private $table_sql_location = "CREATE TABLE location (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    city VARCHAR(255),
	state VARCHAR(255),
    country VARCHAR(255),
    zip_code INTEGER,
	address  VARCHAR(255),
	hotel INT,
	FOREIGN KEY (hotel) REFERENCES hotel(id)
    )";
	private $table_sql_hotel = "CREATE TABLE hotel (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
	rating INTEGER,
	category VARCHAR(15),
	image VARCHAR(255),
    reputation INTEGER(4),
    reputationBadge VARCHAR(10),
	price INTEGER,
	availability INTEGER
    )";
	function connect_to_db(){
		try{
			$this->connction =  new PDO("mysql:host=$this->host;dbname=$this->database", $this->root, $this->password);
			$this->connction->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->connction->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
			$this->connction->setAttribute(PDO::ATTR_STRINGIFY_FETCHES, false);
			$this->connction->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			$this->connction = null;
		}
		 return $this->connction;
	}
	function connet_to_server(){
		try{
			$this->connction = new PDO("mysql:host=$this->host", $this->root, $this->password);
			$this->connction->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		}catch(PDOException $e){
			$this->connction = null;
			
		}
	}
	function create_db(){
		$this->connet_to_server();
		if ($this->connction != null){
			try{
				$this->connction->exec($this->db_sql);
				$this->connect_to_db();				
				$this->connction->exec($this->table_sql_hotel);
				$this->connction->exec($this->table_sql_location);
				return $this->connction;
			}catch(PDOException $e){
				 return $this->connction;
			}
		}
		
	}
	
	
	
}























?>