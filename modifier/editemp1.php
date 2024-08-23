<?php
require_once ('../process/serverHandler.php');
if(!isset($_SESSION['identify'])){
	header("location:alogin.php");
}
$department = $_SESSION['dep'];

$id = $_POST['id'];
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$email = $_POST['email'];
$birthday = $_POST['birthday'];
$gender = $_POST['gender'];
$contact = $_POST['contact'];
$nid = $_POST['nid'];
$address = $_POST['address'];
$degree = $_POST['degree'];
$position = $_POST['position'];

//null
if($firstName==NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check you first name input.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}elseif($lastName==NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check yourr last name input.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}elseif($email==NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check your email input.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}elseif($birthday==NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check your birthday input.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}elseif($gender==NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check your gender input.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}elseif($contact==NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check your contact number input.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}elseif($nid==NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check your NID input.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}elseif($address==NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check your address input.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}elseif($degree==NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check your degree input.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}elseif($position==NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check your position input.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}

//dup
$sql = "SELECT EMP_FNAME,EMP_LNAME,EMP_EMAIL,EMP_CONTACT_NUM,EMP_NID FROM employees WHERE EMP_ID!=$id ;";
$resDup = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($resDup)){
    if($firstName==$row['EMP_FNAME'] AND $lastName==$row['EMP_LNAME']){
        echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('This employee name is already being used.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
    }elseif($email==$row['EMP_EMAIL']){
        echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('This employee email is already being used.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
    }elseif($contact==$row['EMP_CONTACT_NUM']){
        echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('This employee contact number is already being used.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
    }elseif($nid==$row['EMP_NID']){
        echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('This employee NID is already being used.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
    }
}

//format
if(strlen($firstName)>20){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('First name character limit is 20.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}
if(!(preg_match("/[A-Z]/",$firstName) OR preg_match("/[a-z]/",$firstName))){

    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check the first name format.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}
if(preg_match("/[0-9]/",$firstName)){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check the first name format.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}
//$newFirstName = strtolower($firstName);$firstName = strtoupper($newFirstName[0]).$newFirstName;

if(strlen($lastName)>30){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Last name character limit is 30.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}
if(!(preg_match("/[A-Z]/",$lastName) OR preg_match("/[a-z]/",$lastName))){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check the last name format.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}
if(preg_match("/[0-9]/",$lastName)){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check the last name format.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}
//$newLastName = strtolower($lastName);$lastName = strtoupper($newLastName[0]).$newLastName;

$checkEmail = explode("@",$email);
$emailExt = end($checkEmail); $emailextention = array("gmail.com", "yahoo.com","hotmail.com");
if(!in_array($emailExt,$emailextention)){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check the email format. Google, Yahoo, and Hotmail accounts are the only allowed emails.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}

$newbirthday = date("Y-m-d", strtotime($birthday));

$genderList = array("Male","Female","Other");
if(!in_array($gender,$genderList)){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Something went wrong with the input gender.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}

if(strlen($contact)!=11 OR $contact[0]!='0' OR $contact[1]!='9'){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check the contact number format.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}elseif(preg_match("/[^0-9]/",$contact)){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check the contact number format.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}

if($nid>4294967295){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check the NID format. NID above 4294967295 is not allowed'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}elseif(preg_match("/[^0-9]/",$nid)){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check the contact number format.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}

if(strlen($degree)>20){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Degree input has limit of 50 characters.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}elseif(preg_match("/[0-9]/",$degree)){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check the Degree input format.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}

if(strlen($position)>30){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Position name input has limit of 30 characters.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}

if($nid>99999){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check the NID format. NID above 99999 is not allowed'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}


$sql1 = "SELECT POS_ID,POS_TITLE FROM positions";
    $result1= mysqli_query($conn,$sql1);
    $isPosUniq = true;
    $posID = mysqli_num_rows($result1)+1;
    
    while($row = mysqli_fetch_assoc($result1)){
        if($row['POS_TITLE']===$position){
            $isPosUniq = false;
            $posID = $row['POS_ID'];
            break;
        }
        
    }
    
    if($isPosUniq){
        $sql2 = "INSERT INTO `positions` (`POS_ID`, `POS_TITLE`, `DEP_ID`) VALUES ($posID, '$position', '$department');";
        $result2 = mysqli_query($conn,$sql2);
    }
    
    $empID = $_POST['id'];
    
    $sql3 = "UPDATE employees SET EMP_FNAME='$firstName', EMP_LNAME='$lastName', EMP_EMAIL='$email', EMP_BDAY='$birthday', EMP_GENDER='$gender', EMP_CONTACT_NUM='$contact', EMP_NID='$nid', EMP_ADDRESS='$address', EMP_DEGREE='$degree', POS_ID='$posID' WHERE EMP_ID='$empID';";
    $result3 = mysqli_query($conn,$sql3);

    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Success'); location.replace('../adminhome.php');</SCRIPT>");exit();