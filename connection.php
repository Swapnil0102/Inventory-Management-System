<?php 
session_start();
ob_start();
$dbhost= "localhost";
$dbuser= "root";
$dbpass= "";
$dbname= "my_ims";
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	if($mysqli->connect_errno){
	echo "Error Occured" . $mysqli->connect_error;
  	}
?>