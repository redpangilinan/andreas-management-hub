<?php
$server = "localhost";
$dbuser = "root";
$dbpass = "";
$database = "php_scrud";

//Database Connection
$conn = mysqli_connect($server, $dbuser, $dbpass, $database);
if (!$conn) {
    die("Connection error: " . mysqli_connect_error());
}
?>