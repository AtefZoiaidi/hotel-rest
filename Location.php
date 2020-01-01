<?php
class Location{
	public $id;
	public $city ;
    public $state;
    public $country ;
    public $zip_code;
    public $address ;
	public $hotel;
	
	function __construct( $city ,$state, $country,$zip_code,$address,$hotel ){
		$this->city =$city ;
		$this->state = $state;
		$this->country = $country;
		$this->zip_code = $zip_code;
		$this->address   = $address;
		$this->hotel = $hotel;
	}
	
	function get_object(){
		return array ('city'=>$this->city,'state'=>$this->state,'country'=>$this->country,
		'zip_code'=>$this->zip_code,'address'=>$this->address);
	}

	
}



?>