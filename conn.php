<?php 
$host = "localhost";
$user = "root";
$password ="";
$database = "b1706793";

$conn = mysqli_connect($host, $user, $password, $database);
if(mysqli_connect_errno()){
	echo "Connection Fail " .mysqli_connect_errno();exit;
}
$conn->set_charset("utf8");






	
?>