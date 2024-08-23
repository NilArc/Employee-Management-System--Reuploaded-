<?php

require_once ('process/dbh.php');
$sql = "SELECT * FROM `employee` WHERE 1";

//echo "$sql";
$result = mysqli_query($conn, $sql);
if(isset($_POST['update']))
{

  $id = mysqli_real_escape_string($conn, $_POST['id']);
  
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  
  $contact = mysqli_real_escape_string($conn, $_POST['contact']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
 


 $result = mysqli_query($conn, "UPDATE `employee` SET `email`='$email',`contact`='$contact',`address`='$address' WHERE id=$id");

 echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Succesfully Updated')
    window.location.href='myprofile.php?id=$id  ';
    </SCRIPT>");

  
}
?>




<?php
  $id = (isset($_GET['id']) ? $_GET['id'] : '');
  $sql = "SELECT * from `employee` WHERE id=$id";
  $result = mysqli_query($conn, $sql);
  if($result){
  while($res = mysqli_fetch_assoc($result)){
  $firstname = $res['firstName'];
  $lastname = $res['lastName'];
  $email = $res['email'];
  $contact = $res['contact'];
  $address = $res['address'];
  $gender = $res['gender'];
  $birthday = $res['birthday'];
  $nid = $res['nid'];
  $dept = $res['dept'];
  $degree = $res['degree'];
  // $salary = $res['salary'];
}
}

?>

<html>
<head>
  <title>Update Profile | Employee Management System</title>
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
                    <a class="nav-link" href="employeehome.php?id=<?php echo $id?>"">HOME</a></a>
                  </li>
                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4 active">
                    <a class="nav-link" href="employeeprofile.php?id=<?php echo $id?>"">My Profile</a>
                  </li>
                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                    <a class="nav-link" href="employeeproject.php?id=<?php echo $id?>"">My Projects</a>
                  </li>
                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                    <a class="nav-link" href="employeeleave.php?id=<?php echo $id?>"">Apply Leave</a>
                  </li>
                  <li class="nav-item pl-4 pl-md-0 ml-0 ml-md-4">
                    <a class="nav-link" href="elogin.html">Log Out</a>
                  </li>
                </ul>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  
  <div class="divider"></div>
  

    <!-- <form id = "registration" action="edit.php" method="POST"> -->
  <div class="page-wrapper bg-blue p-t-100 p-b-100 font-robo">
        <div class="wrapper wrapper--w680">
            <div class="card card-1">
                <div class="card-heading"></div>
                  <div class="card-body">
                      <h2 class="title"> &#124 <span class="name">UPDATE INFO</h2>

                      <form id = "registration" action="myprofileup.php" method="POST">



                          <div class="input-group">
                            <p>Email</p>
                              <input class="input--style-1" type="email"  name="email" value="<?php echo $email;?>">
                          </div>
                         
                          
                          <div class="input-group">
                            <p>Contact</p>
                              <input class="input--style-1" type="number" name="contact" value="<?php echo $contact;?>">
                          </div>

                         

                          
                           <div class="input-group">
                            <p>Address</p>
                              <input class="input--style-1" type="text"  name="address" value="<?php echo $address;?>">
                          </div>

                         
                          <input type="hidden" name="id" id="textField" value="<?php echo $id;?>" required="required"><br><br>
                          <div class="p-t-20">
                              <button class="btn btn--radius btn--green" type="submit" name="update">Submit</button>
                          </div>
                          
                      </form>
                      <br>
                      <button class="btn btn--radius btn--green" onclick="window.location.href = 'changepassemp.php?id=<?php echo $id?>';">Change Password</button>

                </div>
            </div>
        </div>
    </div>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<script src="./script.js"></script>
</body>
</body>
</html>
