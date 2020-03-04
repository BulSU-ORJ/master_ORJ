<?php 
session_start();
if(!empty($_SESSION['userRC_id'])){
    $_SESSION['username'];
    $email=$_SESSION['email'];
  }else{
    header("Location: loginSample.php");
  }
include('connect.php');
include('authcontrollerAdmin.php');


$username=$_SESSION['username'];
$query="SELECT * FROM users_rc WHERE username = '$username'";
$result=mysqli_query($con,$query);
if($result){
  while ($row=mysqli_fetch_assoc($result)) {
        # code...
        $username=$row['username'];
        $email=$row['email'];
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
            <a class="btn nav-item" style="font-weight: bold" href="adminRC.php">DASHBOARD</a>
            <a class="btn nav-item" href="uploadnewRC.php">RESEARCHES</a>
            <a class="btn nav-item" href="uploadformRC.php">UPLOAD FORM</a>
            <div class="dropdown" style="color: white">
                <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">OPTIONS</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" style="color: black" href="userManualRC.php">Documentation</a>
                    <a class="dropdown-item" style="color: black" href="dlFormsRC.php">Forms</a>
                </div>
            </div>
            <div class="dropdown" style="color: white">
                <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MANAGE ACCOUNT</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" style="color: black" href="addaccount.php">Add Account</a>
                    <a class="dropdown-item" style="color: black" href="changepassUser-RC.php">Edit Account</a>
                    <a class="dropdown-item" style="color: black" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container" >
                  <div class="col-sm-12" >
                <div class="col-sm-6" style="float: right;">
                  <form class="form-container" method="POST" action="changepassUser-RC.php" id="changepass">
                    <div class="form-group" style="text-align: center;">
                      <h3>Update Account Here</h3>
                  </div>
                      <div class="form-group">
                            <label >User's Email Address </label>
                          <input type="text" class="form-control form-control-lg" name="username" value="<?php echo $email?>"disabled>
                          <label >Old Username:</label>
                          <input type="text" class="form-control form-control-lg" name="username" value="<?php echo $username?>"disabled>
                          <label >New Username:</label>
                          <input type="text" class="form-control form-control-lg" name="newusername" placeholder="Enter New Username" required>
                          <label >New Password:</label>
                          <input type="password" class="form-control form-control-lg" name="password1" placeholder="Enter New Password" required>
                          <label >Confirm Password:</label>
                          <input type="password" class="form-control form-control-lg" name="Cpassword" placeholder="Enter Confirm Password" required>
                      </div>
                      <button type="submit" class="btn btn-lg btn-primary btn-block" name="updateRC-btn">Update</button>
                  </form>
                </div>
        </div>
        </div>
</body>
</html>
