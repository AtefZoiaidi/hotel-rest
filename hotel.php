<?php


class Hotel{
	public $id;
	public $name ;
    public $rating;
    public $category;
    public $image ;
    public $reputation ;
    public $price ;
	public $availability ;
	public $reputation_badge;
	
	function __construct($name,$rating,$category,$image,$reputation,$price,$availability) {
		$this->name = $name;
		$this->rating  = $rating;
		$this->image  = $image;
		$this->reputation  = $reputation;
		$this->price  = $price;
		$this->availability = $availability;
		$this->category = $category;
		if($reputation  <= 500  ){
			$this->reputation_badge='red';
		}else if($reputation  > 500 && $reputation  <= 799 ){
			$this->reputation_badge='yellow';
		}else{
			$this->reputation_badge='green';
		}
		
	}
	
	function get_object($connection){
		$LocationController = new LocationController($connection);
		$location = $LocationController->hotel_location($this->id);
		return array ('id'=>$this->id,'name'=>$this->name,'rating'=>$this->rating,'category'=>$this->category,'image'=>$this->image,'reputation'=>$this->reputation,
		'price'=>$this->price,'availability'=>$this->availability,'category'=>$this->category,'location'=>$location->get_object());
	}
	
	function get_object_field($field,$connection){

		$hotel_field = array('name'=>$this->name,'rating'=>$this->rating,'category'=>$this->category,'image'=>$this->image,'reputation'=>$this->reputation,
		'price'=>$this->price,'availability'=>$this->availability,'category'=>$this->category);
		
		$LocationController = new LocationController($connection);
		$location = $LocationController->hotel_location($this->id);
		
		$location_field = array ('city'=>$location->city,'state'=>$location->state,'country'=>$location->country,
		'zip_code'=>$location->zip_code,'address'=>$location->address);
		if(in_array($field,$hotel_field)){
			return array ($field=>$hotel_field[$field]);
		}
		if(in_array($field,$location_field)){
			return array ($field=>$location_field[$field]);
		}

		return array ();
	}
	
	
	
}



?>