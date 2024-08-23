<?php
require_once ('../process/serverHandler.php');
if(!isset($_SESSION['identify'])){
	header("location:alogin.php");
}

$id = $_GET['rand1'];
$token = $_GET['rand2'];
$choice = $_GET['rand3'];

$result = mysqli_query($conn, "UPDATE leaves SET LEAVE_ACCEPT=$choice WHERE EMP_ID = $id AND LEAVE_TOKEN = $token;");

header("Location:../adminempleave.php");
?>

