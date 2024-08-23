<?php
require_once ('process/serverHandler.php');
if(isset($_SESSION['identify'])){
	if($_SESSION['discrim']==1){
		header("location:adminHome.php");
	}else{
		header("location:employeeHome.php");
	}
	exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Log In | Employee Management System</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="icon.png" type="image/png" />
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;800&display=swap" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="stylelogin.css">
	<link rel="stylesheet" href="animation.css">
</head>
<body>
	<body>
		<body class="hero-anime">
			<div class="navigation-wrap bg-light start-header start-style">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<nav class="navbar navbar-expand-md navbar-light">
	
								<a class="navbar-brand" href="index.html"><img
										src="logo.svg" alt=""></a>
	
								<button class="navbar-toggler" type="button" data-toggle="collapse"
									data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
									aria-expanded="false" aria-label="Toggle navigation">
									<span class="navbar-toggler-icon"></span>
								</button>
								<div class="collapse navbar-collapse" id="navbarSupportedContent">
									<ul class="navbar-nav ml-auto py-4 py-md-0">
										<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
											<a class="nav-link" href="index.html">HOME</a>
										</li>
								
										<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 ">
											<a class="nav-link" href="elogin.php">EMPLOYEE</a>
										</li>
										<li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
											<a class="nav-link" href="alogin.php">ADMINISTRATOR</a>
										</li>
									</ul>
								</div>
							</nav>
						</div>
					</div>
				</div>
			</div>


	<div class="loginbox">
    <img src="assets/admin.svg" class="avatar">
        <h1>LOGIN</h1>
            <form action="process/adminlogin.php" method="POST">
            <p>Admin Email</p>
            <input type="text" name="mailuid" placeholder="Enter Email Address" required="required">
            <p>Password</p>
            <input type="password" name="pwd" placeholder="Enter Password" required="required">
            <input type="submit" name="login-submit" value="Login">
           
        </form>
        
    </div>
</body>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
	<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
	<script src="./script.js"></script>
</body>
</html>