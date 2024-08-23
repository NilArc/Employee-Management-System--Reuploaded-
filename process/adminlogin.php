<?php
include_once('serverHandler.php');

$email = $_POST['mailuid'];
$password = $_POST['pwd'];

$sql = "SELECT EMP_ID,EMP_MNG_DISCRIM,DEP_ID FROM employees JOIN (SELECT POS_ID,DEP_ID FROM positions) AS TABLE1 ON employees.POS_ID=TABLE1.POS_ID WHERE EMP_EMAIL='$email' AND EMP_PASSWORD='$password' AND EMP_MNG_DISCRIM='1';";
$result = mysqli_query($conn,$sql) or die(mysql_error());

if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
        $_SESSION['identify'] = $row['EMP_ID'];
        $_SESSION['discrim'] = $row['EMP_MNG_DISCRIM'];
        $_SESSION['dep'] = $row['DEP_ID'];
    }
    header("location:../adminHome.php");
    esit();
}else{
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Wrong email or password'); window.location.href='javascript:history.go(-1)';</SCRIPT>");
}
