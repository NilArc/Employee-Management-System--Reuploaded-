<?php 
	require_once ('process/serverHandler.php');
	if(!isset($_SESSION['identify'])){
		header("location:elogin.php");
	}
	$department = $_SESSION['dep'];
	$empID = $_SESSION['identify'];

	$sql1 = "SELECT EMP_ID AS 'I.D.',CONCAT(EMP_FNAME,' ',EMP_LNAME) AS NAME, EMP_POINTS AS POINTS FROM employees JOIN (SELECT POS_ID,DEP_ID FROM positions WHERE DEP_ID=$department) AS TABLE1 ON employees.POS_ID=TABLE1.POS_ID WHERE EMP_MNG_DISCRIM=0 ORDER BY EMP_POINTS DESC;";
	$result1 = mysqli_query($conn, $sql1);

	$sql2 = "SELECT PROJ_NAME,PROJ_END_DATE FROM employees JOIN projects ON employees.PROJ_ID=projects.PROJ_ID WHERE EMP_ID=$empID;";
	$result2 = mysqli_query($conn, $sql2);

	$sql3 = "SELECT SALARY_BASE,SALARY_BONUS,SALARY_TOTAL FROM salary WHERE EMP_ID=$empID;";
	$result3 = mysqli_query($conn, $sql3);

	$sql4 = "SELECT LEAVE_START_DATE,LEAVE_END_DATE,DATEDIFF(LEAVE_END_DATE,LEAVE_START_DATE) AS DAYS,LEAVE_REASON,LEAVE_ACCEPT FROM leaves WHERE EMP_ID=$empID;";
	$result4 = mysqli_query($conn, $sql4);
?>



<html>
<head>
	<title>Employee Panel | Employee Management System</title>
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
	<link rel="stylesheet" type="text/css" href="styleemplogin.css">
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
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4  active">
										<a class="nav-link" href="employeehome.php">HOME</a></a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="employeeprofile.php">My Profile</a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="employeeproject.php">My Projects</a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="employeeleave.php">Apply Leave</a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="logout.php">Log Out</a>
									</li>
								</ul>
							</div>
						</nav>
					</div>
				</div>
			</div>
	</div>
		<!-- <h2>Welcome <?php echo "$empName"; ?> </h2> -->

    	<table  style="margin-top:100px; ">
		   <tr class= "tbl">
            <td colspan = "4" class="title"> &#124 <span class="name">EMPLOYEE LEADERBOARD</td>
			</tr>
			<tr>
				<th align = "center">Seq.</th>
				<th align = "center">Emp. ID</th>
				<th align = "center">Name</th>
				<th align = "center">Points</th>
				

			</tr>

			

			<?php
				$seq = 1;
				while ($row = mysqli_fetch_assoc($result1)) {
					echo "<tr>";
					echo "<td>".$seq."</td>";
					echo "<td>".$row['I.D.']."</td>";
					
					echo "<td>".$row['NAME']."</td>";
					
					echo "<td>".$row['POINTS']."</td>";
					
					$seq+=1;
				}


			?>

		</table>
<br>
    	<table>
            <tr class= "tbl">
            <td colspan = "4" class="title"> &#124 <span class="name">DUE PROJECTS</td>
			</tr>
			<tr>
				<th align = "center">Project Name</th>
				<th align = "center">Due Date</th>
				
			</tr>

			

			<?php
			if(mysqli_num_rows($result2)==0){
				echo "<tr>";
				echo "<td>Enjoy your free time!</td>";echo "<td>NA</td>";

			}
				while ($row = mysqli_fetch_assoc($result2)) {
					echo "<tr>";
					
					echo "<td>".$row['PROJ_NAME']."</td>";
					
					echo "<td>".$row['PROJ_END_DATE']."</td>";

				}


			?>

		</table>
<br>
    	<table>
            <tr class= "tbl">
            <td colspan = "4" class="title"> &#124 <span class="name">SALARY STATUS</td>
			</tr>
			<tr>
				<th align = "center">Base Salary</th>
				<th align = "center">Bonus</th>
				<th align = "center">Total Salary</th>
				
			</tr>

			

			<?php
				while ($row = mysqli_fetch_assoc($result3)) {
					

					echo "<tr>";
					
					
					echo "<td>".$row['SALARY_BASE']."</td>";
					echo "<td>".$row['SALARY_BONUS']." %</td>";
					echo "<td>".$row['SALARY_TOTAL']."</td>";
					
				}


		

			?>

		</table>
<br>
    	<table>
            <tr class= "tbl">
            <td colspan = "5" class="title"> &#124 <span class="name">LEAVE STATUS</td>
			</tr>
			<tr>
				
				<th align = "center">Start Date</th>
				<th align = "center">End Date</th>
				<th align = "center">Total Days</th>
				<th align = "center">Reason</th>
				<th align = "center">Status</th>
			</tr>

			

			<?php
			if(mysqli_num_rows($result4)==0){
				echo "<tr>";
				echo "<td>NA</td>";echo "<td>NA</td>";echo "<td>NA</td>";echo "<td>NA</td>";echo "<td>NA</td>";

			}
			

				while ($row = mysqli_fetch_assoc($result4)) {
					echo "<tr>";
					echo "<td>".$row['LEAVE_START_DATE']."</td>";
					echo "<td>".$row['LEAVE_END_DATE']."</td>";
					echo "<td>".$row['DAYS']."</td>";
					echo "<td>".$row['LEAVE_REASON']."</td>";

							

					if($row['LEAVE_ACCEPT']==1){
						echo "<td>Accepted</td>";
					}elseif($row['LEAVE_ACCEPT']==NULL){
						echo "<td>Pending</td>";
					}elseif($row['LEAVE_ACCEPT']==0){
						echo "<td>Denied</td>";
					}
					
					
				}

			?>

		</table>
		<br><br><br>
</body>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
	<script src="./script.js"></script>

</body>
</html>