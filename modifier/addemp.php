<?php
require_once ('../process/serverHandler.php');
if(!isset($_SESSION['identify'])){
	header("location:alogin.php");
}
$department = $_SESSION['dep'];


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
$salary = $_POST['salary'];
$pic = $_FILES['file'];


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
}elseif($salary==NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check your NID input.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}

//dup
$sql = "SELECT EMP_FNAME,EMP_LNAME,EMP_EMAIL,EMP_CONTACT_NUM,EMP_NID FROM employees;";
$resDup = mysqli_query($conn,$sql);
while($row = mysqli_fetch_assoc($resDup)){
    if($firstName==$row['EMP_FNAME'] AND $lastName==$row['EMP_LNAME']){
        echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('This employee name is already taken.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
    }elseif($email==$row['EMP_EMAIL']){
        echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('This employee email is already taken.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
    }elseif($contact==$row['EMP_CONTACT_NUM']){
        echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('This employee contact number is already taken.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
    }elseif($nid==$row['EMP_NID']){
        echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('This employee NID is already taken.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
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

if(preg_match("/[^0-9]/",$salary)){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check the salary input format.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}elseif($nid>99999){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Check the NID format. NID above 99999 is not allowed'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}

$sql1 = "SELECT POS_ID,POS_TITLE FROM positions";
$result1= mysqli_query($conn,$sql1);
$isPosUniq = true;
$posID = mysqli_num_rows($result1)+1;

    while($row = mysqli_fetch_assoc($result1)){
        if($row['POS_TITLE']==$position){
            $isPosUniq = false;
            $posID = $row['POS_ID'];
            break;
        }
    }
/////////////////////////////////////////////////////////
    $ext = " ";$newFileName=NULL;
    if($pic!=NULL){
        $allowed = array("image/jpeg","image/jpg","image/png");
        if($pic['size']>5000000){
            echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Profile picture exceeds 5MB.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
        }elseif(!in_array($pic['type'],$allowed)){
            echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Use photo in JPG, PNG, or JPEG format.'); window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
        }

        $noext = explode('/', $pic['type']);
        $ext = strtolower(end($noext));

        $newFileName = uniqid('',true).".".$ext;
        $uploadPath = '../assets/images/'.$newFileName;

        if($pic['error']===0){
            move_uploaded_file($pic['tmp_name'],$uploadPath);
        }else{
            echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Something went wrong with the uploading.'); location.replace('../adminviewemp.php');;</SCRIPT>");exit();
        }
    }
////////////////////////////////////////////////////
    if($isPosUniq){
        $sql2 = "INSERT INTO `positions` (`POS_ID`, `POS_TITLE`, `DEP_ID`) VALUES ($posID, '$position', '$department');";
        $result2 = mysqli_query($conn,$sql2);
    }
    

    

    $sql3 = "SELECT EMP_ID AS NUM FROM employees;";
    $result3 = mysqli_query($conn,$sql3);
    $numemp = mysqli_num_rows($result3);

    
    $sql4 = "INSERT INTO employees VALUES ($numemp+1, '$firstName', '$lastName','$email', CONCAT('$firstName','$lastName'), 0, '$newbirthday', '$gender', '$contact', '$nid', '$address', '$degree', '$newFileName', 0, NULL, $posID);";
    $result4 = mysqli_query($conn,$sql4);

    $trueSalary = sprintf("%.2f", $salary);
    $sql5 = "INSERT INTO salary VALUES(SALARY_ID,'$trueSalary',0,'$trueSalary',$numemp+1);";
    $result5 = mysqli_query($conn,$sql5);


    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Success'); location.replace('../adminviewemp.php');;</SCRIPT>");