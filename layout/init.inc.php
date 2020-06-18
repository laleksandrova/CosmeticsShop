<?php 

session_start();

$host = "localhost";
$username = "root";
$password = "";
$db_name = "cosmeticsshop";

$mysqli = new mysqli($host, $username, $password, $db_name); 

$mysqli->set_charset('utf8'); 

$product_pictures_dir = 'images/objects/';
$product_pictures_small_prefix = 'small_';

?>