<?php
require_once ('../process/serverHandler.php');
if(!isset($_SESSION['identify'])){
	header("location:alogin.php");
    exit();
}
$department = $_SESSION['dep'];
$isSuccess = true;

$id = $_POST['id'];
$projName =  $_POST['name'];
$due =  $_POST['duedate'];
$projDue = date("Y-m-d", strtotime($due));

if(!isset($projName)){
    header("location:../adminassignproj.php");
    exit();
}
if(strlen($projName)>30){
    $isSuccess = false;
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Character limit of project name exceeds 30. '); window.location.href='javascript:history.go(-1)';</SCRIPT>");
    exit();
}

$exist = false;

$sql = "SELECT EMP_ID,PROJ_ID,DEP_ID FROM employees JOIN positions ON employees.POS_ID=positions.POS_ID WHERE EMP_ID=$id AND DEP_ID=$department;";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($result)){
    if($row['EMP_ID']==$id){
        if($row['PROJ_ID']!=NULL){
            $isSuccess = false;
            echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('This employee is currently working on a project.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");
            exit();
        }
        $exist = true;
    }
}

if($exist==false){
    $isSuccess = false;
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('This employee could not be found.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");
    exit();
}

$sql1 = "SELECT PROJ_ID,PROJ_NAME,PROJ_END_DATE,DEP_ID FROM projects";
$result1= mysqli_query($conn,$sql1);
$isProjUniq = true;
$projID = mysqli_num_rows($result1)+1;

while($row = mysqli_fetch_assoc($result1)){
    if($row['PROJ_NAME']==$projName){
        if($row['DEP_ID']!=$department){
            $isSuccess = false;
            echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Please change your project name.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");
            exit();
        }
        $isProjUniq = false;
        $projID = $row['PROJ_ID'];
        $projDue = $row['PROJ_END_DATE'];
        break;
        
    }
}



if($isProjUniq){
    $sql2 = "INSERT INTO projects VALUES ($projID, '$projName', '$projDue', NULL, NULL, NULL, '$department');";
    $result2 = mysqli_query($conn,$sql2);
}

$sql3 = "UPDATE `employees` SET `PROJ_ID` = '$projID' WHERE `employees`.`EMP_ID` =$id;";
$result3 = mysqli_query($conn,$sql3);


if($isSuccess){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Success');window.location.replace('../adminproj.php');</SCRIPT>");
}
//GET EMP ID
//ASSIGN PROJ NUM
