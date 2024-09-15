<?php 

if($_SERVER['SERVER_NAME'] == 'localhost')
{
	/** database config **/
    define('DBNAME', 'CinemaManagementSystem');
    define('DBHOST', 'cinema-management-system.cl9dstv2z9by.us-east-1.rds.amazonaws.com');
    define('DBUSER', 'nbuser');
    define('DBPASS', 'cinemasystem0123');
	define('DBDRIVER', '');
	
	define('ROOT', 'http://localhost:8000/CinemaManagementSystem/public');
}else
{
	/** database config **/
    define('DBNAME', 'CinemaManagementSystem');
    define('DBHOST', 'cinema-management-system.cl9dstv2z9by.us-east-1.rds.amazonaws.com');
    define('DBUSER', 'nbuser');
    define('DBPASS', 'cinemasystem0123');
	define('DBDRIVER', '');

	define('ROOT', 'https://www.yourwebsite.com');

}

define('APP_NAME', "Cinema Management System");
define('APP_DESC', "");

/** true means show errors **/
define('DEBUG', true);
