<?php
ob_start();
//ob_flush();
session_start();
//set_error_handler('warning_handler', E_WARNING);
error_reporting(E_ALL);

$db_server 	= "localhost";
$db_user	= "root";
$db_password= "";
$db_name	= "foodfactory_db";

try{
	$mysqli = new mysqli($db_server, $db_user, $db_password, $db_name);
} catch(Exception $ex) {
	die("I cannot connect to the database because: ".$ex->getMessage());
}
$mysqli->set_charset("utf8");

function warning_handler($errno, $errstr, $errfile, $errline, array $errcontext) {
    throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
}

date_default_timezone_set('Asia/Kolkata');
//date_default_timezone_set('Europe/London');

$config['base_url']					= "http://localhost/food_factory/webservices/";
$config['front_url']				= "http://localhost/food_factory/";

$config['img_path']		= "../upload/images";
$config['img_url']			= $config['front_url']."upload/images/";

include("functions.php");
?>