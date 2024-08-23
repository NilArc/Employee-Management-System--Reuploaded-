<?php

require_once ('process/serverHandler.php');
if(!isset($_SESSION['identify'])){
	header("location:alogin.php");
}
$department = $_SESSION['dep'];
$sql = "SELECT employees.PROJ_ID,EMP_ID,PROJ_NAME,PROJ_END_DATE,PROJ_SUBMIT_DATE,PROJ_MARK,PROJ_FILE FROM employees JOIN projects ON employees.PROJ_ID=projects.PROJ_ID JOIN (SELECT POS_ID,DEP_ID FROM positions WHERE DEP_ID=$department) AS TABLE1 ON employees.POS_ID=TABLE1.POS_ID;";
$result=mysqli_query($conn,$sql);

?>

<html>
<head>
    <title>Project Status | Admin Panel | Employee Management System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icon.png" type="image/png" />
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
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="adminviewemp.php">View Employee</a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
										<a class="nav-link" href="adminassignproj.php">Assign Project</a>
									</li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
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
            <td colspan = "8" class="title"> &#124 <span class="name">PROJECT STATUS</td>
			</tr>
			<tr>

				<th align = "center">Project ID</th>
				<th align = "center">Emp. ID</th>
				<th align = "center">Project Name</th>
				<th align = "center">Due Date</th>
				<th align = "center">Submission Date</th>
				<th align = "center">Mark</th>
				<th align = "center">Status</th>
				<th align = "center">Option</th>
				
			</tr>

			<?php
			//error_reporting(E_ERROR | E_PARSE); 
			$date = date("Y-m-d");
				while ($employee = mysqli_fetch_assoc($result)) {
					
					echo "<tr>";
					echo "<td>".$employee['PROJ_ID']."</td>";
					echo "<td>".$employee['EMP_ID']."</td>";
					echo "<td>".$employee['PROJ_NAME']."</td>";
					echo "<td>".$employee['PROJ_END_DATE']."</td>";
					if($employee['PROJ_SUBMIT_DATE']==NULL){
						echo "<td>None</td>";
					}else {
						echo "<td>".$employee['PROJ_SUBMIT_DATE']."</td>";
					}
					
					if($employee['PROJ_MARK']==NULL){
						echo "<td>NA</td>";
					}else{
						echo "<td>".$employee['PROJ_MARK']."</td>";
					}

					$day = date("Y-m-d");
					if($employee['PROJ_MARK']==NULL AND $employee['PROJ_SUBMIT_DATE']==NULL){
						echo "<td>Not Submitted</td>";
					}else if($employee['PROJ_SUBMIT_DATE']==NULL AND $day>$employee['PROJ_END_DATE']){
						echo "<td>Due</td>";
					}else if($employee['PROJ_SUBMIT_DATE']!= NULL AND $day<$employee['PROJ_END_DATE']){
						echo "<td>Submitted</td>";
					}elseif($employee['PROJ_SUBMIT_DATE']!= NULL AND $day>$employee['PROJ_END_DATE']){
						echo "<td>Late Submitted</td>";
						
					}
					
					echo "<td><a href=\"modifier/mark.php?rand=$employee[EMP_ID]&random=$employee[PROJ_ID]\">Mark</a>"; 

				}


			?>

		</table>
		
	</body>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
	<script src="./script.js"></script>
</body>
</html>