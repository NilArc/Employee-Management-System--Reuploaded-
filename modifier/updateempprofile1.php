<?php

require_once ('../process/serverHandler.php');
	if(!isset($_SESSION['identify'])){
		header("location:elogin.php");
	}
$department = $_SESSION['dep'];
$empID = $_SESSION['identify'];
$isSucces = true;


$email = $_POST['email'];
$contact = $_POST['contact'];
$address = $_POST['address'];

if(!isset($email) AND !isset($contact) AND !isset($address)){
    header('location: updateempprofile.php');
    exit();
}

//dups
$sql1 = "SELECT EMP_EMAIL,EMP_CONTACT_NUM,EMP_ADDRESS FROM employees WHERE EMP_ID!=$empID;";
$result1 = mysqli_query($conn,$sql1);
while($row = mysqli_fetch_assoc($result1)){
    if($row['EMP_EMAIL']==$email){
        echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('This email is already being used.'); location.replace('updateempprofile.php');</SCRIPT>");exit();
    }elseif($row['EMP_CONTACT_NUM']==$contact){
        echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('This contact is already being used.'); location.replace('updateempprofile.php');</SCRIPT>");exit();
    }
    
}

if(strlen($contact)!=11 OR $contact[0]!='0' OR $contact[1]!='9'){
    $isSucces=false;
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check the contact number format.'); location.replace('updateempprofile.php');</SCRIPT>");exit();
}elseif(strlen($address)>50){
    $isSucces=false;
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Address has limit of 50 characters.'); location.replace('updateempprofile.php');</SCRIPT>");exit();
}

$sql = "UPDATE employees SET EMP_EMAIL='$email',EMP_CONTACT_NUM='$contact',EMP_ADDRESS='$address' WHERE EMP_ID='$empID';";
$result = mysqli_query($conn,$sql);

if($isSucces){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Success'); location.replace('../employeeprofile.php');</SCRIPT>");exit();
}

