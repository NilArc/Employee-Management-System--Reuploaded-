<?php
require_once ('process/serverHandler.php');
if(!isset($_SESSION['identify'])){
	header("location:alogin.php");
}
$department = $_SESSION['dep'];

?>
<!DOCTYPE html>
<html>

<head>
    <!-- Title Page-->
    <title>Assign Project | Admin Panel | Employee Management System</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="icon.png" type="image/png" />
     <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
		integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="animation.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">
    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
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
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
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

    <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title"> &#124 <span class="name">PROJECT</h2>
                    <form action="modifier/assignempproj.php" method="POST" enctype="multipart/form-data">


                         <div class="input-group">
                            <input class="input--style-1" type="number" placeholder="Employee ID" name="id" required="required">
                        </div>


                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Project Name (Max 30 characters)" name="name" required="required">
                        </div>
                        <div class="row row-space">
                            <div class="col-4">
                                <div class="input-group">
                                    <input class="input--style-1" type="date" placeholder="date" name="duedate" required="required">
                                   
                                </div>
                            </div>
                            
                        </div>
                        

                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>


	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
	<script src="./script.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
<!-- end document-->
