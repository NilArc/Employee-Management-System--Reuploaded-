<?php 
	require_once ('process/serverHandler.php');
	if(!isset($_SESSION['identify'])){
		header("location:elogin.php");
	}
	$department = $_SESSION['dep'];
	$empID = $_SESSION['identify'];

	
	$sql1 = "SELECT leaves.EMP_ID AS ID,CONCAT(EMP_FNAME,' ',EMP_LNAME)AS NAME, LEAVE_START_DATE, LEAVE_END_DATE,DATEDIFF(LEAVE_END_DATE,LEAVE_START_DATE) AS DAYS,LEAVE_REASON,LEAVE_ACCEPT,LEAVE_TOKEN FROM leaves JOIN employees ON leaves.EMP_ID=employees.EMP_ID WHERE employees.EMP_ID=$empID;";
	
	$result1 = mysqli_query($conn,$sql1);
	
?>

<html>
<head>
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Apply Leave | Employee Panel | Employee Management System</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
  	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
  	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">
  	<link rel="stylesheet" href="animation.css">
	<link rel="stylesheet" type="text/css" href="styleapply.css">
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
										<a class="nav-link" href="employeehome.php">HOME</a></a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="employeeprofile.php">My Profile</a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="employeeproject.php">My Projects</a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
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


	<div class="divider"></div>
	<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
				<h2 class="title"> &#124 <span class="name">APPLY LEAVE</h2>
                    

                    <form action="modifier/applyleave.php" method="POST" enctype="multipart/form-data">


                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Reason" name="reason" required="required">
                        </div>
                        <div class="row row-space">
                            <div class="col-6">
                            	<p>Start Date</p>
                                <div class="input-group">
                                    <input class="input--style-1" type="date" placeholder="start" name="start" required="required">
                                   
                                </div>
                            </div>
                            <div class="col-6">
                            	<p>End Date</p>
                                <div class="input-group">
                                    <input class="input--style-1" type="date" placeholder="end" name="end" required="required">
                                   
                                </div>
                            </div>
                        </div>
                        



                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
		

		</table>

				<table>
		   <tr class= "tbl">
            <td colspan = "13" class="title"> &#124 <span class="name">MY LEAVE</td>
			</tr>
			<tr>
			<tr>
				<th>Emp. ID</th>
				<th>Name</th>
				<th>Start Date</th>
				<th>End Date</th>
				<th>Total Days</th>
				<th>Reason</th>
				<th>Status</th>
			</tr>

		<?php


			while ($employee = mysqli_fetch_assoc($result1)) {

				$date1 = new DateTime($employee['LEAVE_START_DATE']);
				$date2 = new DateTime($employee['LEAVE_END_DATE']);
				$interval = $date1->diff($date2);
				$interval = $date1->diff($date2);
				//echo "difference " . $interval->days . " days ";

					echo "<tr>";
					echo "<td>".$empID."</td>";
					
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
					

				}


			?>
		</table>

		<br><br><br><br>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script src="./script.js"></script>
</body>
</html>