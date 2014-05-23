# Wordpress external authentication plugin

Install this into your wordpress plugins/directory.

## Configuration

* URL - authentication url
* Login param name - param name for login  
* Password param name - param name for password

**Example**

URL: http://localhost
Login param name: login
Password param name: password

This will make POST request when user log in to http://localhost with POST DATA: login = user provided login, password = user provided password

## Authentication backend

Authentication backend should return JSON response in format:

**Authentication pass**

{"status":1,"first_name":"John","last_name":"Doe","email":"john.doe@bar.com","login":"john_doe"}

**Authentication fail** 

{"status":0}

Copyright (c) 2014 Damian Baćkowski, released under the MIT license
