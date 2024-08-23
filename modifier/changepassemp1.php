<?php
require_once ('../process/serverHandler.php');
if(!isset($_SESSION['identify'])){
    header("location:elogin.php");
}
$department = $_SESSION['dep'];
$empID = $_SESSION['identify'];

$oldpass = $_POST['oldpass'];
$newpass = $_POST['newpass'];

if($oldpass==NULL AND $newpass==NULL){
    header('location:changepassemp.php');
    exit();
}

$sql = "SELECT EMP_PASSWORD FROM employees WHERE EMP_ID=$empID;";
$result = mysqli_query($conn,$sql);
$phrase = " ";
while($row = mysqli_fetch_assoc($result)){
  $phrase = $row['EMP_PASSWORD'];
}

if($phrase!=$oldpass){
    echo "<SCRIPT LANGUAGE='JavaScript'>window.alert('Wrong old password.'); window.location.href='javascript:history.go(-1)';</SCRIPT>";exit();
}

if($oldpass==$newpass){
    echo "<SCRIPT LANGUAGE='JavaScript'>window.alert('You are about to use old password again as new password. '); window.location.href='javascript:history.go(-1)';</SCRIPT>";exit();
}


$check = "SELECT EMP_PASSWORD FROM employees WHERE EMP_PASSWORD='$newpass';";
$rescheck = mysqli_query($conn,$check);
if(mysqli_fetch_row($rescheck)>0){
    echo "<SCRIPT LANGUAGE='JavaScript'>window.alert('Choose another password'); window.location.href='javascript:history.go(-1)';</SCRIPT>";exit();
}

$pat = "/[a-z]/";$pat1="/[0-9]/";$pat2="/[A-Z]/"; 
if(preg_match($pat,$newpass)!=1){
    echo "<SCRIPT LANGUAGE='JavaScript'>window.alert('Use at least 1 letter in your new password.'); window.location.href='javascript:history.go(-1)';</SCRIPT>";exit();
}elseif(preg_match($pat1,$newpass)!=1){
    echo "<SCRIPT LANGUAGE='JavaScript'>window.alert('Use at least 1 digit in your new password.'); window.location.href='javascript:history.go(-1)';</SCRIPT>";exit();
}elseif(preg_match($pat2,$newpass)!=1){
    echo "<SCRIPT LANGUAGE='JavaScript'>window.alert('Use at least 1 capital letter in your new password.'); window.location.href='javascript:history.go(-1)';</SCRIPT>";exit();
}

$sql1 = "UPDATE employees SET EMP_PASSWORD='$newpass' WHERE EMP_ID=$empID";
mysqli_query($conn,$sql1);
echo "<SCRIPT LANGUAGE='JavaScript'>window.alert('Success'); location.replace('../employeeprofile.php');</SCRIPT>";exit();






