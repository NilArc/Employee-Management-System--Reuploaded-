<?php
    require_once ('process/serverHandler.php');
    if(!isset($_SESSION['identify'])){
        header("location:alogin.php");
    }
    $department = $_SESSION['dep'];

    $sql = "SELECT DEP_NAME FROM department WHERE DEP_ID=$department;";
    $result = mysqli_query($conn,$sql);
    $depName = " ";
    while($row = mysqli_fetch_assoc($result)){
        $depName = $row['DEP_NAME'];
    }
?>

<!DOCTYPE html>
<html>

<head>
	<title>Add Employee | Employee Management System</title>
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
    <link href="css/main.css" rel="stylesheet">
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
                                    <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
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
                    <h2 class="title"> &#124 <span class="name">REGISTRATION</h2>
                    <form action="modifier/addemp.php" method="POST" enctype="multipart/form-data">
					
					

                         <div class="row row-space">
                            <div class="col-6">
                                <div class="input-group">
                                     <input class="input--style-1" type="text" placeholder="First Name" name="firstName" required="required">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" placeholder="Last Name" name="lastName" required="required">
                                </div>
                            </div>
                        </div>


                        <div class="input-group">
                            <input class="input--style-1" type="email" placeholder="Email" name="email" required="required">
                        </div>
                        <p>Birthday</p>
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="input-group">
                                    <input class="input--style-1" type="date" placeholder="BIRTHDATE" name="birthday" required="required">
                                   
                                </div>
                            </div>
                            <div class="col-6" >
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search" >
                                        <select name="gender" required="required">
                                            <option disabled="disabled" selected="selected">Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Lesbian</option>
											<option value="Other">Gay</option>
											<option value="Other">Bisexual</option>
											<option value="Other">Transgender</option>
											<option value="Other">Queer</option>
											<option value="Other">Other</option>
                                        </select>
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Contact Number" name="contact" required="required" >
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="NID" name="nid" required="required">
                        </div>

                        
                         <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Address" name="address" required="required">
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Department" name="dept" value="<?php echo $depName;?>. Department" required="required" readonly>
                        </div> 

                        <div class="input-group">
                            <input class="input--style-1" type="text" placeholder="Degree" name="degree" required="required">
                        </div>
						 <div class="input-group">
                            <input class="input--style-1" id="position" type="text" placeholder="Position" name="position"  required="required" >
                        </div>
                        <div class="input-group">
                            <input class="input--style-1" type="number" placeholder="Salary" name="salary" required="required">
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="file" placeholder="file" name="file">
                        </div>




                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
  
    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>
   <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
	 <!-- Navbar JS-->
	<script src="script.js"></script>
    <!-- Main JS-->
    <script src="js/global.js"></script>

</body>

</html>
<!-- end document-->
