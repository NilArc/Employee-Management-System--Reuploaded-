<?php
require_once ('../process/serverHandler.php');
if(!isset($_SESSION['identify'])){
	header("location:alogin.php");
}
$department = $_SESSION['dep'];
$isSuccess = false;

$projID = $_POST['projID'];
$mark = $_POST['mark'];

if($mark==NULL){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Plase check the given mark.');window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}

if($mark>11){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Mark limit is 10.');window.location.href='javascript:history.go(-1)';</SCRIPT>");exit();
}

$sql1 = "SELECT EMP_ID,EMP_POINTS FROM employees WHERE PROJ_ID='$projID';";
$result1 = mysqli_query($conn,$sql1);
while($row = mysqli_fetch_assoc($result1)){                      
    $emp = $row['EMP_ID'];
    $points = $row['EMP_POINTS'];
    
    $sql2 = "SELECT SALARY_BASE,SALARY_BONUS,SALARY_TOTAL FROM salary WHERE EMP_ID=$emp;";
    $result2 = mysqli_query($conn,$sql2);
    while($row1 = mysqli_fetch_assoc($result2)){
        
        $newMark = $row1['SALARY_BONUS']+$mark;
        $newSalary = $row1['SALARY_BASE']+($row1['SALARY_BASE']*($newMark/100));
        $sql3 = "UPDATE salary SET SALARY_BONUS='$newMark', SALARY_TOTAL='$newSalary' WHERE EMP_ID=$emp;";
        $result3 = mysqli_query($conn,$sql3);

        $sql4 = "UPDATE projects SET PROJ_MARK='$mark' WHERE PROJ_ID='$projID';";
        $result4 = mysqli_query($conn,$sql4);

        $newpoints = $points+(10*$mark);$temp=NULL;
        $sql5 = "UPDATE employees SET EMP_POINTS='$newpoints', PROJ_ID=NULL WHERE EMP_ID='$emp';";
        mysqli_query($conn,$sql5);
        $isSuccess = true;
    }
}

if($isSuccess){
    echo ("<SCRIPT LANGUAGE='JavaScript'>window.alert('Success'); location.replace('../adminhome.php');</SCRIPT>");
}

