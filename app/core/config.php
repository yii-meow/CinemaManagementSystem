<?php 

if($_SERVER['SERVER_NAME'] == 'localhost')
{
	/** database config **/
//    define('DBNAME', 'CinemaManagementSystem');
//    define('DBHOST', 'cinema-management-system.cl9dstv2z9by.us-east-1.rds.amazonaws.com');
//    define('DBUSER', 'RegularUser');  //Readonly, nbuser, RegularUser
//    define('DBPASS', 'R3gul@rU$er2024!');
//	define('DBDRIVER', '');

    //Routing
	define('ROOT', 'http://localhost:80/CinemaManagementSystem/public');


    //Database Credentials
//    $dbName = "CinemaManagementSystem";
//    $host = "cinema-management-system.cl9dstv2z9by.us-east-1.rds.amazonaws.com";
//    $dbConfigs = [
//        'database' => [
//            'readonly' => [
//                'host' => $host,
//                'dbname' => $dbName,
//                'username' => 'Readonly',
//                'password' => 'R34d_Only#User8!'
//            ],
//            'regular' => [
//                'host' => $host,
//                'dbname' => $dbName,
//                'username' => 'RegularUser',
//                'password' => 'R3gul@rU$er2024!'
//            ],
//            'admin' => [
//                'host' => $host,
//                'dbname' => $dbName,
//                'username' => 'nbuser',
//                'password' => 'cinemasystem0123'
//            ]
//        ]
//    ];

}

define('APP_NAME', "Cinema Management System");
define('APP_DESC', "");

/** true means show errors **/
define('DEBUG', true);
