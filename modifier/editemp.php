<?php

require_once ('../process/serverHandler.php');
if(!isset($_SESSION['identify'])){
	header("location:alogin.php");
}
$id = $_GET['rand'];
$department = $_SESSION['dep'];


$sql = "SELECT * FROM EMPLOYEES WHERE EMP_ID=$id";
$result = mysqli_query($conn,$sql);
$employee = [];
while($row = mysqli_fetch_assoc($result)){
	$employee = array($row['EMP_FNAME'],$row['EMP_LNAME'],$row['EMP_EMAIL'],$row['EMP_BDAY'],$row['EMP_GENDER'],$row['EMP_CONTACT_NUM'],$row['EMP_NID'],$row['EMP_ADDRESS'],$row['EMP_DEGREE']);
}

$sql2 = "SELECT DEP_NAME FROM department WHERE DEP_ID=$department;";
$result2 = mysqli_query($conn, $sql2);
$dep_name = " ";
while($row = mysqli_fetch_assoc($result2)){
	$dep_name = $row['DEP_NAME'];
}

$sql3 = "SELECT POS_TITLE FROM positions JOIN employees ON positions.POS_ID=employees.POS_ID WHERE EMP_ID=$id;";
$result3 = mysqli_query($conn, $sql3);
$position = " ";
while($row = mysqli_fetch_assoc($result3)){
	$position = $row['POS_TITLE'];
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Employee |  Admin Panel | Employee Management System</title>
	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="icon.png" type="image/png" />
     <!-- Icons font CSS-->
    <link href="../vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="../vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
		integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
	<link rel="stylesheet" href="../animation.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">
    <!-- Main CSS-->
    <link href="../css/main.css" rel="stylesheet" media="all">
</head>

<body>
<body class="hero-anime">
		<div class="navigation-wrap bg-light start-header start-style">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<nav class="navbar navbar-expand-md navbar-light">
							<a class="navbar-brand" href="../index.html"><img src="../logo.svg" alt=""></a>
							<button class="navbar-toggler" type="button" data-toggle="collapse"
								data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
								aria-expanded="false" aria-label="Toggle navigation">
								<span class="navbar-toggler-icon"></span>
							</button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
								<ul class="navbar-nav ml-auto py-4 py-md-0">
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
										<a class="nav-link" href="../adminhome.php">HOME</a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
										<a class="nav-link" href="../adminaddemp.php">Add Employee</a>
									</li>
									<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
										<a class="nav-link" href="../adminviewemp.php">View Employee</a>
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
<body>
		<!-- <form id = "registration" action="edit.php" method="POST"> -->
	<div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title"> &#124 <span class="name">UPDATE EMPLOYEE INFO</h2>
                    <form id = "registration" action="editemp1.php" method="POST">

                        <div class="row row-space">
                            <div class="col-6">
                                <div class="input-group">
                                     <input class="input--style-1" type="text" name="firstName" value="<?php echo $employee[0];?>" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <input class="input--style-1" type="text" name="lastName" value="<?php echo $employee[1];?>">
                                </div>
                            </div>
                        </div>





                        <div class="input-group">
                            <input class="input--style-1" type="email"  name="email" value="<?php echo $employee[2];?>">
                        </div>
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="input-group">
                                    <input class="input--style-1" type="DATE" name="birthday" value="<?php echo $employee[3];?>">
                                   
                                </div>
                            </div>
                            <div class="col-6" >
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search" >
                                        <select name="gender" required="required" value='<?php echo $employee[4];?>'>
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
                                        <script>
                                            document.getElementsByName('gender')[0].value = '<?php echo $employee[4]; ?>'
                                        </script>
                                        <div class="select-dropdown" "></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="input-group">
                            <input class="input--style-1" type="TEXT" name="contact" value="<?php echo $employee[5];?>">
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="number" name="nid" value="<?php echo $employee[6]?>">
                        </div>

                        
                         <div class="input-group">
                            <input class="input--style-1" type="text"  name="address" value="<?php echo $employee[7];?>">
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" name="dept" value="<?php echo $dep_name ?>" readonly>
                        </div>

                        <div class="input-group">
                            <input class="input--style-1" type="text" name="degree" value="<?php echo $employee[8];?>">
                        </div>
						<div class="input-group">
                            <input class="input--style-1" type="text" name="position" value="<?php echo $position;?>">
                        </div>
						
                        <input type="hidden" name="id" id="textField" value="<?php echo $id;?>" required="required"><br><br>
                        <div class="p-t-20">
                            <button class="btn btn--radius btn--green" type="submit" name="update">Submit</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

 </body>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
	<script src="../script.js"></script>
</body>
</html>
