<?php
require_once ('process/serverHandler.php');
if(!isset($_SESSION['identify'])){
	header("location:alogin.php");
}
$department = $_SESSION['dep'];
$sql = "SELECT EMP_ID,CONCAT(EMP_FNAME,' ',EMP_LNAME) AS NAME, EMP_EMAIL,EMP_BDAY,EMP_GENDER,EMP_CONTACT_NUM,EMP_NID,EMP_ADDRESS,EMP_DEGREE,EMP_PROFILE_PIC,EMP_POINTS,POS_TITLE FROM employees JOIN positions ON employees.POS_ID=positions.POS_ID JOIN department ON department.DEP_ID=positions.DEP_ID WHERE EMP_MNG_DISCRIM=0 AND department.DEP_ID=$department ORDER BY EMP_POINTS DESC";
$result = mysqli_query($conn, $sql);

$sql2 = "SELECT DEP_NAME FROM department WHERE DEP_ID=$department;";
$result2 = mysqli_query($conn, $sql2);
$dep_name = " ";
while($row = mysqli_fetch_assoc($result2)){
	$dep_name = $row['DEP_NAME'];
}
?>



<html>
<head>
    <title>View Employee |  Admin Panel | Employee Management System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="icon.png" type="image/png" />
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
		integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="animation.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="styleview.css">
</head>
<body>
	<body class="hero-anime">
		<div class="navigation-wrap bg-light start-header start-style">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<nav class="navbar navbar-expand-md navbar-light">
							<a class="navbar-brand" href="index.html"><img src="logo.svg" alt=""></a>
							<button class="navbar-toggler" type="button" data-toggle="collapse"
								data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
								aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
								<ul class="navbar-nav ml-auto py-4 py-md-0">
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="adminhome.php">HOME</a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="adminaddemp.php">Add Employee</a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
										<a class="nav-link" href="adminviewemp.php">View Employee</a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
										<a class="nav-link" href="adminassignproj.php">Assign Project</a>
									</li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="adminproj.php">Project Status</a>
									</li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="adminsalary.php">Salary Table</a>
									</li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="adminempleave.php">Employee Leave</a>
									</li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="logout.php">Logout</a>
									</li>
								</ul>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>

		<table  style="margin-top:130px;">
		   <tr class= "tbl">
            <td colspan = "14" class="title"> &#124 <span class="name">EMPLOYEE LIST</td>
			</tr>
			<tr>
				<th align = "center">Emp. ID</th>
				<th align = "center">Picture</th>
				<th align = "center">Name</th>
				<th align = "center">Email</th>
				<th align = "center">Birthday</th>
				<th align = "center">Gender</th>
				<th align = "center">Contact</th>
				<th align = "center">NID</th>
				<th align = "center">Department</th>
				<th align = "center">Address</th>
				<th align = "center">Degree</th>
				<th align = "center">Position</th>
				<th align = "center">Point</th>
				
				
				<th align = "center">Options</th>
			</tr>

			<?php
				while ($employee = mysqli_fetch_assoc($result)) {
					//error_reporting(E_ERROR | E_PARSE);
					echo "<tr>";
					echo "<td>".$employee['EMP_ID']."</td>";

					if($employee['EMP_PROFILE_PIC']==NULL){
						echo "<td><img src='assets/images/default.jpg' height = 60px width = 60px></td>";
					}else{
						echo "<td><img src='assets/images/".$employee['EMP_PROFILE_PIC']."' height = 60px width = 60px></td>";
					}

					echo "<td>".$employee['NAME']."</td>";
					
					echo "<td>".$employee['EMP_EMAIL']."</td>";
					echo "<td>".$employee['EMP_BDAY']."</td>";
					echo "<td>".$employee['EMP_GENDER']."</td>";
					echo "<td>".$employee['EMP_CONTACT_NUM']."</td>";
					echo "<td>".$employee['EMP_NID']."</td>";
					echo "<td>".$dep_name."</td>";
					echo "<td>".$employee['EMP_ADDRESS']."</td>";
					echo "<td>".$employee['EMP_DEGREE']."</td>";
					echo "<td>".$employee['POS_TITLE']."</td>";
					echo "<td>".$employee['EMP_POINTS']."</td>";

					echo "<td><a href=\"modifier/editemp.php?rand=$employee[EMP_ID]\">Edit</a> | <a href=\"modifier/deleteemp.php?rand=$employee[EMP_ID]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a></td>";

				}


			?>

		</table>
		
			
	</body>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
	<script src="./script.js"></script>
</body>
</html>