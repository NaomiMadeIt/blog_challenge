<?php
$host 		= 'localhost';
$username = 'naomi_blog';
$password = 'SftaeE52AtKTxCAd';
$database = 'naomi_blog';

//connect to database
$db = new mysqli( $host, $username, $password, $database );

//check to make sure it worked
if( $db->connect_errno > 0 ){
	die( 'Cannot connect to Database. Try again later.' );
}

//salt for making our passwords stronger. keep this a secret!
define('SALT', 'vgrqejun4tge7iuohtr1yhtdkmrsf52318675326gresjiludsvz6yg');

define('ROOT_URL', 'http://localhost/naomi_php/blog_challenge/');
define('ROOT_PATH', 'C:\xampp\htdocs\naomi_php\blog_challenge');

error_reporting( E_ALL & ~E_NOTICE );
