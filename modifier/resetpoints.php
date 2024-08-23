<?php

include_once('../process/serverHandler.php');
$department = $_SESSION['dep'];

$sql1 = "SELECT EMP_ID FROM employees JOIN (SELECT POS_ID FROM positions JOIN department ON positions.DEP_ID=department.DEP_ID WHERE positions.DEP_ID=1) AS TABLE1 ON employees.POS_ID=TABLE1.POS_ID WHERE EMP_MNG_DISCRIM=0;";
$result1 = mysqli_query($conn,$sql1);
while($row = mysqli_fetch_assoc($result1)){
    $id = $row['EMP_ID'];
    $sql = "UPDATE employees SET EMP_POINTS=0 WHERE EMP_ID='$id';";
    $sendReq = mysqli_query($conn,$sql) or die(mysql_error());

    $sql2 = "UPDATE salary SET SALARY_BONUS=0, SALARY_TOTAL=SALARY_BASE WHERE EMP_ID='$id';";
    $sendReq2 = mysqli_query($conn,$sql2) or die(mysql_error());
}


header('location:../adminhome.php');
exit();

