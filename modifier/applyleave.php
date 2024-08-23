<?php
require_once ('../process/serverHandler.php');
if(!isset($_SESSION['identify'])){
    header("location:elogin.php");
}
$department = $_SESSION['dep'];
$empID = $_SESSION['identify'];
$isSuccess = true;

$reason = $_POST['reason'];
$start = $_POST['start'];
$newstart = date_create($start);
$endd = $_POST['end'];
$newendd = date_create($endd);
$diff = date_diff($newstart,$newendd);
$h = $diff->format("%R%a days");
$s = $h[0];

if($reason==NULL OR $diff->days==NULL){
    header('location: ../employeeleave.php');
    exit();
}

if(strlen($reason)>255){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Max 255 character limit for leave reason.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}

if($s=='-'){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check for the leave dates.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}

$sql = "SELECT LEAVE_ID FROM leaves;";
$sql1 = "SELECT LEAVE_ID FROM leaves WHERE EMP_ID=$empID;";

$result = mysqli_query($conn,$sql);
$result1 = mysqli_query($conn,$sql1);
$id = mysqli_num_rows($result)+1;
$token = mysqli_num_rows($result1)+1;

$sql3 = "INSERT INTO leaves VALUES('$id','$token','$start','$endd','$reason',NULL,'$empID');";
mysqli_query($conn,$sql3);

echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Success'); window.location.replace('../employeeleave.php');</SCRIPT>");exit();




