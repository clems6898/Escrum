# Escrum
Scrum management with a web aplication
This web app was made for a school project in PHP with a MVC pattern. 
To use this app, you should install PostgreSQL and the database which is in "Database" folder, don't forget to put the configuration in escrum/webserver/www/json/pgConnect.json 

If you want to use another SGBD, just modify the Manager class.

In the screenshot folder, you can see the final application. 
 
This project needs Apache server and PHP to work, you can dowload it here : http://httpd.apache.org/ and https://www.php.net/ (v.7.3.x) 
In apache configuration, set webserver/www/ as the root. Don't forget to activate postgreSQL.dll with the configuration file of apache and php.
