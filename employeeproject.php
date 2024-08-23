
<?php 

require_once ('process/serverHandler.php');
if(!isset($_SESSION['identify'])){
	header("location:elogin.php");
}
$department = $_SESSION['dep'];
$empID = $_SESSION['identify'];

$sql = "SELECT employees.PROJ_ID,PROJ_NAME,PROJ_END_DATE,PROJ_SUBMIT_DATE,PROJ_FILE,EMP_ID,PROJ_MARK FROM employees JOIN projects ON employees.PROJ_ID=projects.PROJ_ID WHERE EMP_ID=$empID;";
$result = mysqli_query($conn,$sql);
?>


<html>

<head>
	
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>My Projects| Employee Panel | Employee Management System</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="styleview.css">
	<link rel="stylesheet" href="animation.css">

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
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4  ">
										<a class="nav-link" href="employeehome.php">HOME</a></a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="employeeprofile.php">My Profile</a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
										<a class="nav-link" href="employeeproject.php">My Projects</a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="employeeleave.php">Apply Leave</a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="logout.php">Log Out</a>
									</li>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>


		<table  style="margin-top:130px;">
		   	<tr class= "tbl">
            	<td colspan = "8" class="title"> &#124 <span class="name">MY PROJECTS</td>
			</tr>
			<tr>

				<th align = "center">Project ID</th>
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

			if(mysqli_num_rows($result)==0){
				echo "<tr>";
				echo "<td>NA</td>";echo "<td>NA</td>";echo "<td>NA</td>";echo "<td>NA</td>";echo "<td>NA</td>";echo "<td>NA</td>";echo "<td>NA</td>";

			}
			while ($employee = mysqli_fetch_assoc($result)) {
				
				echo "<tr>";
				echo "<td>".$employee['PROJ_ID']."</td>";
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
				
				
				//echo '<td><div class="input-group"><input class="input--style-1" type="file" style="float:right" placeholder="file" name="file"></div></td>';
				if($employee['PROJ_SUBMIT_DATE']==NULL){
					echo "<td><a href=\"modifier/filesubmit.php?rand=$employee[PROJ_ID]\">Submit</a>";
				}elseif($employee['PROJ_SUBMIT_DATE']!=NULL){
					echo "<td>Submitted</td>";
				}
				
			}
			?>
	</tr>
</table>







<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script src="./script.js"></script>
</body>
</html>