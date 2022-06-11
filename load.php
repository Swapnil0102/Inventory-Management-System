<?php include_once('connection.php'); ?>

<?php
session_start();
$username=$_SESSION['username'];
$password= $_SESSION['pass'];

if($username == "admin" && $password == "admin"){
    header("HTTP/1.1 301 Moved Permanently");
    header('Location: admin.php');
    exit();
} else {
    echo "PLease select one item";
}   

?>

