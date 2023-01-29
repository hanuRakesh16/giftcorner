<?php
global $__site_config;

function get_config($key, $default = null)
{
	$__site_config_path = dirname($_SERVER['DOCUMENT_ROOT']) . '/giftcorner.json';
	$__site_config = file_get_contents($__site_config_path);
	$array = json_decode($__site_config, true);
	if (isset($array[$key])) {
		return $array[$key];
	} else {
		return $default;
	}
}
	define('SITEURL','http://localhost/giftcorner/');
	$host = get_config('db_server');
	$username = get_config('db_username');
	$pass = get_config('db_password');
	$db = get_config('db_name');

	$conn=mysqli_connect($host,$username,$pass,$db);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error); 
	}
 ?>