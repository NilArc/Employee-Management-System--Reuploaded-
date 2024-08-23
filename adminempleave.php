<?php

require_once ('process/serverHandler.php');
if(!isset($_SESSION['identify'])){
	header("location:alogin.php");
}
$department = $_SESSION['dep'];

$sql = "SELECT employees.EMP_ID AS EMP_ID, LEAVE_TOKEN,CONCAT(employees.EMP_FNAME,' ',employees.EMP_LNAME) AS NAME, LEAVE_START_DATE,LEAVE_END_DATE,DATEDIFF(LEAVE_END_DATE,LEAVE_START_DATE) AS DAYS,LEAVE_REASON,LEAVE_ACCEPT FROM leaves JOIN employees ON leaves.EMP_ID=employees.EMP_ID JOIN (SELECT POS_ID,DEP_ID FROM positions WHERE DEP_ID=$department) AS TABLE1 ON employees.POS_ID=TABLE1.POS_ID WHERE employees.EMP_MNG_DISCRIM=0;";
$result = mysqli_query($conn,$sql);
?>



<html>
<head>
	<title>Employee Management System</title>
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
	<!-- Main CSS-->
    
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
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
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
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="adminproj.php">Project Status</a>
									</li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="adminsalary.php">Salary Table</a>
									</li>
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
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
            <td colspan = "13" class="title"> &#124 <span class="name">EMPLOYEE LEAVE</td>
			</tr>
			<tr>
			<tr>
				<th>Emp. ID</th>
				<th>Token</th>
				<th>Name</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Total Days</th>
				<th>Reason</th>
				<th>Status</th>
				<th>Options</th>
			</tr>

			<?php
				//error_reporting(E_ERROR | E_PARSE); // ERROR HERE
				while ($employee = mysqli_fetch_assoc($result)) {

					echo "<tr>";
					echo "<td>".$employee['EMP_ID']."</td>";
					echo "<td>".$employee['LEAVE_TOKEN']."</td>";
					echo "<td>".$employee['NAME']."</td>";
					
					echo "<td>".$employee['LEAVE_START_DATE']."</td>";
					echo "<td>".$employee['LEAVE_END_DATE']."</td>";
					echo "<td>".$employee['DAYS']."</td>";
					echo "<td>".$employee['LEAVE_REASON']."</td>";
					if($employee['LEAVE_ACCEPT']==1){
						echo "<td>Accepted</td>";
					}elseif($employee['LEAVE_ACCEPT']==NULL){
						echo "<td>Pending</td>";
					}elseif($employee['LEAVE_ACCEPT']==0){
						echo "<td>Denied</td>";
					}
					echo "<td><a href=\"modifier/leavestat.php?rand1=$employee[EMP_ID]&rand2=$employee[LEAVE_TOKEN]&rand3=1\"  onClick=\"return confirm('Are you sure to APPROVE the request?')\">&#x2611</a> | <a href=\"modifier/leavestat.php?rand1=$employee[EMP_ID]&rand2=$employee[LEAVE_TOKEN]&rand3=0\" onClick=\"return confirm('Are you sure to CANCEL the request?')\">&#x2612</a></td>";

				}


			?>

		</table>
	</div>
	</body>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
	<script src="./script.js"></script>
</body>
</html>