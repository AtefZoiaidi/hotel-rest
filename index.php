<?php
require  'connection.php';
$database = new Database();
$connection = $database->connect_to_db();
if ($connection == null){
	$connection = $database->create_db();
	if($connection ==null){
		echo 'There error when try to connect to server.';
		die;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>PHP TEST - Atef Zoiaidi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet"
      href="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.17.1/build/styles/default.min.css">
<script src="//cdn.jsdelivr.net/gh/highlightjs/cdn-release@9.17.1/build/highlight.min.js"></script>
</head>
<body>

<div class="jumbotron text-center m-0">
  <h1>Hotel booking Page</h1>
  <p>REST API calls</p>

</div>
  
<div class="jumbotron m-0" id="add">
<h2>Add</h2>
	<div class="row">
		<div class="col-12">
			  <div class="card">
				  <div class="card-body">
					<div class="row">
					<div class="col-12"><small>REST API calls for create  hotel item .</small></div>
						<div class="col-6">
						 <h5><span class="badge badge-pill badge-primary">POST</span> <span class="host"></span>Api</h5>
						</div>
						<div class="col-6">
						 <button id="post" type="button" class="btn btn-primary float-right">POST</button>
						</div>
					</div>
				   
				  </div>
				  
				</div>
		</div>
		<div class="col-12">
				<form  id="form-add" class="card p-2 mt-2">
					  <div class="form-row">
						<div class="form-group col-md-3">
						  <input type="text" class="form-control" name="name" placeholder="Name">
						</div>
						<div class="form-group col-md-3">
						  <input type="text" class="form-control" name="rating" placeholder="Rating">
						</div>

						<div class="form-group col-md-3">
						  <input type="text" class="form-control" name="reputation" placeholder="Reputation">
						</div>
						<div class="form-group col-md-3">
						  <input type="text" class="form-control" name="price"  placeholder="Price">
						</div>
					  </div>
					  
					  
					  <div class="form-row">
						<div class="form-group col-md-6">
						  <input type="text" class="form-control"name="availability" placeholder="Availability">
						</div>
						<div class="form-group col-md-6">
						     <select  class="form-control" name="category">
								<option selected value='hotel'>Hotel</option>
								<option value='alternative' >alternative</option>
								<option value='lodge' >Lodge</option>
								<option value='hostel' >Hostel</option>
								<option value='resort' >Resort</option>
								<option value='guest-house' >Guest-house</option>
							  </select>
						</div>
					  </div>
					  
					    <div class="form-group">
							<input type="text" class="form-control"  name="address"  placeholder="Address">
						 </div>

					  <div class="form-row">
						<div class="form-group col-md-6">
						  <input type="text" class="form-control" name="city" placeholder="City">
						</div>
						<div class="form-group col-md-4">
						  <input type="text" class="form-control"  name="state" placeholder="State">
						</div>
						<div class="form-group col-md-2">
						  <input type="text" class="form-control" name="zip"  placeholder="Zip">
						</div>
					  </div>
					  
					  <div class="form-group">
							<input type="text" class="form-control" name="country" id="country" placeholder="Country">
						 </div>
						<div class="form-group">
							<input type="text" class="form-control"  name="image"  placeholder="Url image like(https://www.image.com/imge.jpg)">
						 </div>
					  
					</form>
		</div>
	
	</div>
</div>


<div class="jumbotron m-0">
  <h2>Results</h2>
  <div class="card">
  <div class="card-body">
	<div class="row">
		<div class="col-12"><small>REST API calls for get full hotel list.</small></div>
		<div class="col-5  ">
		 <h5 class="pt-2"><span class="badge badge-pill badge-info">GET</span> <span class="host"></span>Api/?page=</h5>
		
		</div>
		<div class="col-1 ">
		 <input type="text" class="form-control" id="page" value='1' >
		</div>
		<div class="col-6 ">
		 <button id="get-page" type="button" class="btn btn-info float-right">GET</button>
		</div>
		
		
		<div class="col-12"><small>REST API calls for get single item of hotel .</small></div>
		<div class="col-5  ">
		 <h5 class="pt-2"><span class="badge badge-pill badge-info">GET</span> <span class="host"></span>Api/?pk=</h5>
		
		</div>
		<div class="col-1 ">
		 <input type="text" class="form-control" id="pk-field" value='1' >
		</div>
		<div class="col-2 ">
		  <h5 class="float-right pt-2">&field=</h5>
		</div>
		<div class="col-2 ">
		  <select id="field" class="form-control" name="category">
								<option  selected value='name'>name</option>
								<option value='rating' >rating</option>
								<option value='category' >category</option>
								<option value='image' >image</option>
								<option value='reputation' >reputation</option>
								<option value='price' >price</option>
								<option value='availability' >availability</option>
								<option value='category' >category</option>
								<option value='city' >city</option>
								<option value='state' >state</option>
								<option value='country' >country</option>
								<option value='zip_code' >zip code</option>
									<option value='address' >address</option>
							  </select>
		</div>
		<div class="col-2 ">
		 <button id="get-field" type="button" class="btn btn-info float-right">GET</button>
		</div>
		
		
		<div class="col-12"><small>REST API calls for get  hotel item.</small></div>
		<div class="col-5 mt-2 ">
		 <h5 class="pt-2"><span class="badge badge-pill badge-info">GET</span> <span class="host"></span>Api/?pk= </h5>
		</div>
		<div class="col-1 mt-2 ">
		 <input type="text" class="form-control" id="pk" value='1' >
		</div>
		<div class="col-6 mt-2">
		 <button id="get-pk" type="button" class="btn btn-info float-right">GET</button>
		</div>
		<div class="col-12"><small>REST API calls for hotel booking.</small></div>
		<div class="col-5 mt-2 ">
		 <h5><span class="badge badge-pill badge-primary">POST</span> <span class="host"></span>Booking </h5>
		</div>
		<div class="col-7 mt-2">
		 <button id="book" type="button" class="btn btn-primary float-right">POST</button>
		</div>
		
	</div>
   
  </div>
  
</div>
 <div class="card mt-2">
	 <div class="card-body">
	<div class="row">
		<div class="col-12 " >
				<pre><code id="get-json" class="language-json"> </code></pre>
		</div>

	</div>
   
  </div>
 </div>

</div>

<div class="jumbotron m-0" id="update">
<h2>Update</h2>
	<div class="row">
		<div class="col-12">
			  <div class="card">
				  <div class="card-body">
					<div class="row">
					<div class="col-12"><small>REST API calls for get  hotel item information.</small></div>
						<div class="col-5 mt-2 ">
						 <h5><span class="badge badge-pill badge-info">GET</span> <span class="host"></span>Api/?pk= </h5>
						</div>
						<div class="col-1 mt-2 ">
						 <input type="text" class="form-control" id="pk-update" value='1' >
						</div>
						<div class="col-6 mt-2">
						 <button id="get-pk-update" type="button" class="btn btn-info float-right">GET</button>
						</div>
						<div class="col-12"><small>REST API calls for update  hotel item information.</small></div>
						<div class="col-6 mt-2">
						
						 <h5><span class="badge badge-pill badge-primary">POST</span> <span class="host"></span>Api</h5>
						</div>
						<div class="col-6 mt-2">
						 <button id="post-update" type="button" class="btn btn-primary float-right">POST</button>
						</div>
						<div class="col-12"><small>REST API calls for remove hotel item.</small></div>
						<div class="col-6 mt-2">
						 <h5><span class="badge badge-pill badge-primary">DELETE</span> <span class="host"></span>Api</h5>
						</div>
						<div class="col-6 mt-2">
						 <button id="delete" type="button" class="btn btn-danger float-right">DELETE</button>
						</div>
					</div>
				   
				  </div>
				  
				</div>
		</div>
		<div class="col-12">
				<form  id="form-update" class="card p-2 mt-2">
					  <div class="form-row">
						<div class="form-group col-md-3">
						  <input type="text" class="form-control" name="name" placeholder="Name">
						</div>
						<div class="form-group col-md-3">
						  <input type="text" class="form-control" name="rating" placeholder="Rating">
						</div>

						<div class="form-group col-md-3">
						  <input type="text" class="form-control" name="reputation"  placeholder="Reputation">
						</div>
						<div class="form-group col-md-3">
						  <input type="text" class="form-control" name="price"  placeholder="Price">
						</div>
					  </div>
					  
					  
					  <div class="form-row">
						<div class="form-group col-md-6">
						  <input type="text" class="form-control"name="availability"  placeholder="Availability">
						</div>
						<div class="form-group col-md-6">
						     <select id="category" class="form-control" name="category">
							 <option selected value=''></option>
								<option  value='hotel'>Hotel</option>
								<option value='alternative' >alternative</option>
								<option value='lodge' >Lodge</option>
								<option value='hostel' >Hostel</option>
								<option value='resort' >Resort</option>
								<option value='guest-house' >Guest-house</option>
							  </select>
						</div>
					  </div>
					  
					    <div class="form-group">
							<input type="text" class="form-control"  name="address" placeholder="Address">
						 </div>

					  <div class="form-row">
						<div class="form-group col-md-6">
						  <input type="text" class="form-control" name="city"  placeholder="City">
						</div>
						<div class="form-group col-md-4">
						  <input type="text" class="form-control"  name="state"  placeholder="State">
						</div>
						<div class="form-group col-md-2">
						  <input type="text" class="form-control" name="zip"  placeholder="Zip">
						</div>
					  </div>
					  
					  <div class="form-group">
							<input type="text" class="form-control" name="country"  placeholder="Country">
						 </div>
						<div class="form-group">
							<input type="text" class="form-control"  name="image"  placeholder="Url image like(https://www.image.com/imge.jpg)">
						 </div>
					  
					</form>
		</div>
	
	</div>
</div>


<script>
$(document).ready(function(){
  id_item = 1
  host = window.location.href;
  $(".host").html(host)
  $("#get-page").on("click",function(event){//function for display list of hotel

	 page = $("#page").val()
	 if (isNaN(page) || page ==''){
		alert(' The page must be an integer');return
	}
	gethotel(page)
});

  $("#get-field").on("click",function(event){//function for display list of hotel

	 pk = $("#pk-field").val()
	 field = $("#field").val()
	 if (isNaN(pk) || pk ==''){
		alert(' The page must be an integer');return
	}
	gethotelfiels(pk,field)
});


  $("#get-pk").on("click",function(event){//function for display  of hotel item
	
	 pk = $("#pk").val()
	 if (isNaN(pk) || pk ==''){
		alert(' The pk must be an integer');return
	}
	gethotelitem(pk)
});

  $("#get-pk-update").on("click",function(event){//function for display  of hotel item for update
	 console.log(event)
	 id_item = $("#pk-update").val()
	 if (isNaN(id_item) || id_item ==''){
		alert(' The pk must be an integer');return
	}
	get_hotel_item_forupdate(id_item)
});


$("#post").on("click",function(event){//function for  hold submit create form
	$("#form-add").submit()
});
$("#book").on("click",function(event){//function for  hold submit booking
	pk = $("#pk").val()
	 if (isNaN(pk) || pk ==''){
		alert(' The pk must be an integer');return
	}
	book('pk='+pk)
});
$("#post-update").on("click",function(event){//function for  hold submit update form
	$("#form-update").submit()
});
$("#delete").on("click",function(event){//function for  hold submit update form
	id_item = $("#pk-update").val()
	if (isNaN(id_item) || id_item ==''){
		alert(' The pk must be an integer');return
	}
	remove('pk='+id_item)
});

 $("#form-add").submit(function(event){//function for creat of hotel
	var arr=$(this).serialize();
	event.preventDefault()
    message = get_value(get_post_value())
	if(message == null){
	
		save(arr)
	}else{
		alert(message)
	}
});
 $("#form-update").submit(function(event){ //function for update hotel informations
	var arr=$(this).serialize();
	arr += '&id='+id_item
	event.preventDefault()
     message = get_value(get_update_value())
	if(message == null){
		save(arr)
	}else{
		alert(message)
	}
});

function get_post_value(){
	data ={}
	data['name'] = $("#form-add  input[name='name']").val()
    data['rating'] = $("#form-add input[name='rating']").val()
    data['category']= $("#form-add select[name='category']").val()
    data['city'] = $("#form-add input[name='city']").val()
    data['state'] = $("#form-add input[name='state']").val()
    data['country'] = $("#form-add input[name='country']").val()
    data['zip_code'] = $("#form-add input[name='zip']").val()
    data['address'] = $("#form-add input[name='address']").val()
    data['image'] = $("#form-add input[name='image']").val()
    data['reputation'] = $("#form-add input[name='reputation']").val()
    data['price'] = $("#form-add input[name='price']").val()
	data['availability'] = $("#form-add input[name='availability']").val()
	return data
}
function get_update_value(){
	data ={}
	data['name'] = $("#form-update  input[name='name']").val()
    data['rating'] = $("#form-update input[name='rating']").val()
    data['category']= $("#form-update select[name='category']").val()
    data['city'] = $("#form-update input[name='city']").val()
    data['state'] = $("#form-update input[name='state']").val()
    data['country'] = $("#form-update input[name='country']").val()
    data['zip_code'] = $("#form-update input[name='zip']").val()
    data['address'] = $("#form-update input[name='address']").val()
    data['image'] = $("#form-update input[name='image']").val()
    data['reputation'] = $("#form-update input[name='reputation']").val()
    data['price'] = $("#form-update input[name='price']").val()
	data['availability'] = $("#form-update input[name='availability']").val()
	return data
}

function get_value(data){
	
	category_array = ['hotel', 'alternative', 'hostel', 'lodge', 'resort', 'guest-house']
	
	if (data.name.length < 10){
		return('name should be longer than 10 characters');
	}
	if (isNaN(data.price)){
		return('The price must be an integer');
	}
	if (isNaN(data.availability) || data.availability ==''){
		return(' The availability must be an integer');
	}
	if (data.city ==''){
		return('Enter city');
	}
	if (data.state ==''){
		return('Enter state');
	}
	if (data.country ==''){
		return('Enter country');
	}
	if (data.address ==''){
		return('Enter address');
	}
	if (data.reputation < 0 || data.reputation > 1000 || isNaN(data.reputation)){
		return('The reputation MUST be an integer >= 0 and <= 1000');
	}
	if (data.zip_code.length < 5 || data.zip_code.length > 5 || isNaN(data.zip_code)){
		return('The zip code MUST be an integer and must have a length of 5');
	}
	if (data.rating  < 0 || data.rating	> 5  || isNaN(data.zip_code)){
		return('Rating must   >= 0 and <= 5');
	}
	if (!category_array.includes(data.category)){
		return('The category can be one of [hotel, alternative, hostel, lodge, resort, guest-house]');
	}
	if(!isValidURL(data.image)){
		return('The image MUST be a valid URL');
	}
	return null
	
}


	function isValidURL(str) {
			var pattern = new RegExp('^((https?:)?\\/\\/)?'+ // protocol
				'(?:\\S+(?::\\S*)?@)?' + // authentication
				'((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|'+ // domain name
				'((\\d{1,3}\\.){3}\\d{1,3}))'+ // OR ip (v4) address
				'(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*'+ // port and path
				'(\\?[;&a-z\\d%_.~+=-]*)?'+ // query string
				'(\\#[-a-z\\d_]*)?$','i'); // fragment locater
			if (!pattern.test(str)) {
				return false;
			} else {
				return true;
			}
	}
	function gethotel(page){
		$.ajax({
			  method: "GET",
			  url: "Api.php/?page="+page,
			  cache : false,
			  processData: false
			})
			  .done(function( data ) {
				  obj = JSON.parse(data);
					$("#get-json").html(JSON.stringify(obj,undefined, 4))

					document.querySelectorAll('code').forEach((block) => {
					  hljs.highlightBlock(block);
					});
			  })
			  .fail(function( msg ) {
				alert( "error msg: " + msg );
			  });
	}
	
	function gethotelfiels(pk,field){
		$.ajax({
			  method: "GET",
			  url: "Api.php/?pk="+pk+'&field='+field,
			  cache : false,
			  processData: false
			})
			  .done(function( data ) {

				  obj = JSON.parse(data);
					$("#get-json").html(JSON.stringify(obj,undefined, 4))

					document.querySelectorAll('code').forEach((block) => {
					  hljs.highlightBlock(block);
					});
			  })
			  .fail(function( msg ) {
				alert( "error msg: " + msg );
			  });
	}
	
	
	function gethotelitem(pk){
		$.ajax({
			  method: "GET",
			  url: "Api.php/?pk="+pk,
			  cache : false,
			  processData: false
			})
			  .done(function( data ) {
				  obj = JSON.parse(data);
	
					$("#get-json").html(JSON.stringify(obj,undefined, 4))
					document.querySelectorAll('code').forEach((block) => {
					  hljs.highlightBlock(block);
					});
			  })
			  .fail(function( msg ) {
				alert( "error msg: " + msg );
			  });
	}
	
	function get_hotel_item_forupdate(pk){
		$.ajax({
			  method: "GET",
			  url: "Api.php/?pk="+pk,
			  cache : false,
			  processData: false
			})
			  .done(function( data ) {
				 
				   obj = JSON.parse(data);
				 	$("#form-update  input[name='name']").val(obj['name'])
					$("#form-update input[name='rating']").val(obj['rating'])
					$("#form-update select[name='category']").val(obj['category'])
					$("#form-update input[name='city']").val(obj.location['city'])
					$("#form-update input[name='state']").val(obj.location['state'])
					$("#form-update input[name='country']").val(obj.location['country'])
					$("#form-update input[name='zip']").val(obj.location['zip_code'])
					$("#form-update input[name='address']").val(obj.location['address'])
					$("#form-update input[name='image']").val(obj['image'])
					$("#form-update input[name='reputation']").val(obj['reputation'])
					$("#form-update input[name='price']").val(obj['price'])
					$("#form-update input[name='availability']").val(obj['availability'])
			  })
			  .fail(function( msg ) {
				alert( "error msg: " + msg );
			  });
	}
	
	
	function save(data){
		$.ajax({
			  method: "POST",
			  url: "Api.php",
			  data: data,
			  cache : false,
			  processData: false
			})
			  .done(function( msg ) {
				alert( msg );
					$("#form-add  input[name='name']").val('')
					$("#form-add  input[name='rating']").val('')
					$("#form-add  select[name='category']").val('')
					$("#form-add  input[name='city']").val('')
					$("#form-add  input[name='state']").val('')
					$("#form-add  input[name='country']").val('')
					$("#form-add  input[name='zip']").val('')
					$("#form-add  input[name='address']").val('')
					$("#form-add  input[name='image']").val('')
					$("#form-add  input[name='reputation']").val('')
					$("#form-add  input[name='price']").val('')
					$("#form-add  input[name='availability']").val('')
			  })
			  .fail(function( msg ) {
				alert( "error msg: " + msg );
			  });
			
	}
	
	function remove(data){
		$.ajax({
			  method: "DELETE",
			  url: "Api.php",
			  cache : false,
			  data:data,
			  processData: false
			})
			  .done(function( msg ) {
				alert( msg );
				$("#form-update  input[name='name']").val('')
					$("#form-update  input[name='rating']").val('')
					$("#form-update  select[name='category']").val('')
					$("#form-update  input[name='city']").val('')
					$("#form-update  input[name='state']").val('')
					$("#form-update  input[name='country']").val('')
					$("#form-update  input[name='zip']").val('')
					$("#form-update  input[name='address']").val('')
					$("#form-update  input[name='image']").val('')
					$("#form-update  input[name='reputation']").val('')
					$("#form-update  input[name='price']").val('')
					$("#form-update  input[name='availability']").val('')
			  })
			  .fail(function( msg ) {
				alert( "error msg: " + msg );
			  });
			
	}
	
	function book(data){
		$.ajax({
			  method: "POST",
			  url: "Booking.php",
			   data:data,
			  cache : false,
			  processData: false
			})
			  .done(function( msg ) {
				  alert( msg );
			  })
			  .fail(function( msg ) {
				alert( "error msg: " + msg );
			  });
	}
});
</script>
</body>
</html>