<?php
require_once ('../process/serverHandler.php');
if(!isset($_SESSION['identify'])){
	header("location:alogin.php");
}

//getting id of the data from url
$id = $_GET['rand'];

//deleting the row from table
$result = mysqli_query($conn, "DELETE FROM employees WHERE EMP_ID=$id");

//redirecting to the display page (index.php in our case)
echo '<script language="javascript">';
echo 'alert("Delete Succes")';
echo '</script>';

?>

<html>
<?php
echo '<script language="javascript">alert("Delete Success");</script>';
header("location:../adminviewemp.php");
exit();
?>
</html>

