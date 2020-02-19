<?php 
session_start();
include('connect.php');
include('authcontrollerAdmin.php');
require_once "authCookieSessionValidate.php";
require_once "Auth.php";

$auth = new Auth();

if(!$isLoggedIn) {
    header("Location: loginSample.php");
}

$id=$_SESSION['member_id'];
$query="SELECT * FROM members WHERE member_id = '$id'";
$result=mysqli_query($con,$query);
if($result){
  while ($row=mysqli_fetch_assoc($result)) {
        # code...
        $member_name=$row['member_name'];
        $member_fname=$row['members_fullName'];
    }  
}

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="Icon/bulsuLogo.png" sizes="16x16" type="image/png"><title>Bulsu Online Research Journal</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="trytry.css">
    <style>
	    .form-container{
	    background: #fff;
	    padding: 30px;
	    border-radius:10px;
	    box-shadow: 0px 0px 10px 0px #000;
	    }
	    </style>
</head>
<body>
    <nav class="navbar nav-tabs navbar-expand-lg navbar-dark" style="background-color: #763435">
        <a class="navbar-brand" href="#">
            <img class="img-fluid d-lg-block d-none" style="height: 85px" src="Icon/header.png">
            <img class="img-fluid d-lg-none" style="height: 49px" src="Icon/header.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <ul class="navbar-nav mr-auto">
            </ul>
            <a class="btn nav-item" style="font-weight: bold" href="adminnew.php">DASHBOARD</a>
            <a class="btn nav-item" href="uploadnew.php">RESEARCHES</a>
            <a class="btn nav-item" href="uploadform.php">UPLOAD FORM</a>
            <div class="dropdown" style="color: white">
                <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">OPTIONS</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" style="color: black" href="userManual.php">Documentation</a>
                    <a class="dropdown-item" style="color: black" href="dlForms.php">Forms</a>
                </div>
            </div>
            <div class="dropdown" style="color: white">
                <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MANAGE ACCOUNT</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" style="color: black" href="addaccount.php">Add Account</a>
                    <a class="dropdown-item" style="color: black" href="#">Change Password</a>
                    <a class="dropdown-item" style="color: black" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container" >
                  <div class="col-sm-12" >
                <div class="col-sm-6" style="float: right;">
                  <form class="form-container" method="POST" action="changepassAdmin.php" id="changepass">
                    <div class="form-group" style="text-align: center;">
                      <h3>Update Account Here</h3>
                  </div>
                    <?php if (count($errors) > 0): ?>
                    <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                    <li style="width: 100%;">
                        <?php echo $error; ?>
                    </li>
                    <?php endforeach;?>
                    </div>
                    <?php endif;?>
                      <div class="form-group">
                            <label >User's Fullname </label>
                          <input type="text" class="form-control form-control-lg" name="username" value="<?php echo $member_fname?>"disabled>
                          <label >Old Username:</label>
                          <input type="text" class="form-control form-control-lg" name="username" value="<?php echo $member_name?>"disabled>
                          <label >New Username:</label>
                          <input type="text" class="form-control form-control-lg" name="newusername" placeholder="Enter New Username">
                          <label >New Password:</label>
                          <input type="password" class="form-control form-control-lg" name="password1" placeholder="Enter New Password" >
                          <label >Confirm Password:</label>
                          <input type="password" class="form-control form-control-lg" name="Cpassword" placeholder="Enter Confirm Password" >
                      </div>
                      <button type="submit" class="btn btn-lg btn-primary btn-block" name="update-btn">Update</button>
                  </form>
                </div>
        </div>
        </div>
</body>
</html>
