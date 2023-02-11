<?php
$server = "localhost";
$dbuser = "andreasf_db";
$dbpass = "andreasfngdb722";
$database = "andreasf_db";

//Database Connection
$conn = mysqli_connect($server, $dbuser, $dbpass, $database);
if (!$conn) {
    die("Connection error: " . mysqli_connect_error());
}
