<?php
session_start();

$serverName = "localhost";
$dbUserName = "root";
$dbPwd = "";
$dbName = "ems";

$conn = mysqli_connect($serverName,$dbUserName,$dbPwd,$dbName);

if ($conn -> connect_errno) {
	echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
}
