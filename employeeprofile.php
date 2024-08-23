<?php

require_once ('process/serverHandler.php');
	if(!isset($_SESSION['identify'])){
		header("location:elogin.php");
	}
$department = $_SESSION['dep'];
$empID = $_SESSION['identify'];

$sql = "SELECT * FROM `employees` WHERE EMP_ID=$empID";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_assoc($result)){
    $firstname = $row['EMP_FNAME'];
    $lastname = $row['EMP_LNAME'];
    $email = $row['EMP_EMAIL'];
    $contact = $row['EMP_CONTACT_NUM'];
    $address = $row['EMP_ADDRESS'];
    $gender = $row['EMP_GENDER'];
    $birthday = $row['EMP_BDAY'];
    $nid = $row['EMP_NID'];
    $degree = $row['EMP_DEGREE'];
    
    
    $pic = $row['EMP_PROFILE_PIC'];
    if($pic==NULL){
      $pic = "default.jpg";
    }
}

$sql2 = "SELECT POS_TITLE FROM positions JOIN employees ON positions.POS_ID=employees.POS_ID WHERE EMP_ID=$empID;";
$result2= mysqli_query($conn, $sql2);
$position = " ";
while($row = mysqli_fetch_assoc($result2)){
  $position = $row['POS_TITLE'];
}

$sql3 = "SELECT DEP_NAME FROM department WHERE DEP_ID=$department;";
$result3= mysqli_query($conn, $sql3);
$dept = " ";
while($row = mysqli_fetch_assoc($result3)){
  $dept = $row['DEP_NAME'];
}

$sql4 = "SELECT SALARY_TOTAL FROM salary WHERE EMP_ID=$empID;";
$result4= mysqli_query($conn, $sql4);
$salary = 0;
while($row = mysqli_fetch_assoc($result4)){
  $salary = $row['SALARY_TOTAL'];
}
 

?>

<html>
<head>
  <?php
  echo "<script>console.log($empID)</script>";
  ?>
  <title>My Profile | Employee Management System</title>

  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <title>Employee Management System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="animation.css">
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
                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4  ">
                    <a class="nav-link" href="employeehome.php">HOME</a></a>
                  </li>
                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
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

    <!-- <form id = "registration" action="edit.php" method="POST"> -->
  <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                <div class="vertL">
                <h2 class="title"> &#124 <span class="name">MY PROFILE</h2>
                    <form method="POST" action="modifier/updateempprofile.php" enctype="multipart/form-data">

                        <div class="input-group-image">
                          <center><img style="margin-bottom: 15px;" src="assets/images/<?php echo $pic;?>" height = 150px width = 150px></center>  
                        </div>
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="input-group">
                                  <p>First Name</p>
                                    <input class="input--style-1" type="text" name="firstName" value="<?php echo $firstname;?>" readonly >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                  <p>Last Name</p>
                                    <input class="input--style-1" type="text" name="lastName" value="<?php echo $lastname;?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="input-group">
                          <p>Email</p>
                            <input class="input--style-1" type="email"  name="email" value="<?php echo $email;?>" readonly>
                        </div>
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="input-group">
                                  <p>Date of Birth</p>
                                    <input class="input--style-1" type="text" name="birthday" value="<?php echo $birthday;?>" readonly>
                                   
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                  <p>Gender</p>
                                  <input class="input--style-1" type="text" name="gender" value="<?php echo $gender;?>" readonly>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group">
                          <p>Contact Number</p>
                            <input class="input--style-1" type="number" name="contact" value="<?php echo $contact;?>" readonly>
                        </div>

                        <div class="input-group">
                          <p>NID</p>
                            <input class="input--style-1" type="number" name="nid" value="<?php echo $nid;?>" readonly>
                        </div>

                        
                        <div class="input-group">
                          <p>Address</p>
                            <input class="input--style-1" type="text"  name="address" value="<?php echo $address;?>" readonly>
                        </div>

                        <div class="input-group">
                          <p>Department</p>
                            <input class="input--style-1" type="text" name="dept" value="<?php echo $dept;?>" readonly>
                        </div>

                        <div class="input-group">
                          <p>Degree</p>
                            <input class="input--style-1" type="text" name="degree" value="<?php echo $degree;?>" readonly>
                        </div>
                       <div class="input-group">
                          <p>Position</p>
                            <input class="input--style-1" type="text" name="position" value="<?php echo $position;?>" readonly>
                        </div>

                        <div class="input-group">
                          <p>Total Salary</p>
                            <input class="input--style-1" type="text" name="degree" value="<?php echo $salary;?>" readonly>
                        </div>

                        <input type="hidden" name="id" id="textField" value="<?php echo $id;?>" required="required"><br><br>
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green"  name="send" type="submit">Update Info</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>


     <!-- Jquery JS-->
    <!-- <script src="vendor/jquery/jquery.min.js"></script>
   
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

   
    <script src="js/global.js"></script> -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script src="./script.js"></script>
</body>
</html>
