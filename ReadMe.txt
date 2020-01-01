For Run Rest Hotel Application.
- Download & Install wampserver http://www.wampserver.com/en/
- Run wampserver 
- Move App folder under  'www' folder for wampserver 
- open http://localhost/Hotel-rest/ on you browser 


============================================
for Acceptance criteria :
I can get all the items for the given hotelier. 
	- you can get this by :
		== > GET http://localhost/test/Api/?page=1  # this for get full hotel list # '1' is mean page number
		== > GET http://localhost/test/Api/?pk=1  # this for get hotel item # '1' is mean primary key or id for hotel item

============================================
I can get a single item.
	- you can get this by :
		== > GET http://localhost/test/Api/?pk=1&field=name  # this for get hotel item # '1' is meanid for hotel item  # 									'name' is field that you want get hotel item
============================================
I can create new entries.
	- you can get this by :
		== > POST http://localhost/test/Api # this for create new hotel item # Sure you need send Hotel data with POST method

============================================
I can update information of any of my items.
I can delete any item.
	- you can get this by :
		== > DELETE http://localhost/test/Api # this for remove hotel item # Sure you need send id for hotel item with DELETE 											method

============================================
A booking endpoint than whenever is called reduces the accommodation availability,and that fails if there is no availability
	- you can get this by :
		== > POST http://localhost/test/Booking # this forcalled reduces the accommodation availability # Sure you need send Hotel id with POST method


# you can find this app on my github
Git remote add origin https://github.com/AtefZoiaidi/hotel-rest.git



© 2020 Atef Zoiaidi