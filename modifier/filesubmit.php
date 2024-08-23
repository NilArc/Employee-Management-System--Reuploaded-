<?php
require_once ('../process/serverHandler.php');
if(!isset($_SESSION['identify'])){
	header("location:elogin.php");
}

$empID = $_SESSION['identify'];
$projID = $_GET['rand'];

if($projID==NULL){
    header('location:employeeproject.php');
    exit();
}



$day = date("Y-m-d");
$sql = "UPDATE projects SET PROJ_SUBMIT_DATE='$day' WHERE PROJ_ID='$projID';";
mysqli_query($conn,$sql);

echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Success'); location.replace('../employeeproject.php');</SCRIPT>");
exit();

