<?php
session_start();
include('authcontrollerAdmin.php');
require_once "authCookieSessionValidate.php";
require_once "Auth.php";

$auth = new Auth();

if(!$isLoggedIn) {
    header("Location: loginSample.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="Icon/bulsuLogo.png" sizes="16x16" type="image/png"><title>Bulsu Online Research Journal</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script><!-- jquery CDN -->
    <link rel="stylesheet" href="trytry.css">
	
	<style>
        #disabled{
			pointer-events: none;
		}
		.form-container{
    		background: #fff;
    		padding: 30px;
    		border-radius:10px;
    		/*box-shadow: 0px 0px 10px 0px #000;*/
    	}
	</style>
</head>
<body style="background: #f6f6f6">
	<nav class="navbar nav-tabs navbar-expand-lg navbar-dark" style="background-color: #763435">
        <a class="navbar-brand" href="#">
            <img class="img d-lg-block d-none" style="height: 75px" src="Icon/header.png">
            <img class="img d-lg-none" style="height: 43px" src="Icon/header.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <ul class="navbar-nav mr-auto">
            </ul>
            <a class="btn nav-item" href="adminnew.php">DASHBOARD</a>
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
                <button class="btn dropdown-toggle" style="font-weight: bold" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MANAGE ACCOUNT</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" style="color: black" href="addaccount.php">Add Account</a>
                    <a class="dropdown-item" style="color: black" href="rc_accounts.php">RC Accounts</a>
                    <a class="dropdown-item" style="color: black" href="edit_accountsample.php">Edit Account</a>
                    <a class="dropdown-item" style="color: black" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-5 mb-5">
           	<div class="form-container shadow justify-content-center p-5 m-auto col-sm-8" method="POST" action="addaccount.php" onsubmit="return Validate();" name="vform">
                <div class="form-group mb-5" style="text-align: center;">
                    <h3>Add Account Here</h3>
                </div>
                <div class="form-group row">
                        <label class="inline col-sm-4">First Name:</label>
                        <input type="text" class="form-control col-sm-8" name="firstname" placeholder="Enter First Name" required>
                </div>
                <div class="form-group row">
                        <label class="col-sm-4">Last Name:</label>
                        <input type="text" class="form-control col-sm-8" name="lastname" placeholder="Enter Last Name" required>
                </div>
                <div class="form-group row">
                        <label class="col-sm-4">Username:</label>
                        <input type="text" class="form-control col-sm-8"  name="username" id="username" onchange="checkuser();" placeholder="Enter Username" required>
                        <div id="name_error"></div>
                </div>
                <div class="form-group row">
                        <label class="col-sm-4">Password:</label>
                        <input type="password" class="form-control col-sm-8" name="password" placeholder="Enter Password" required>
                </div>
                <div class="form-group row">
                        <label class="col-sm-4">Confirm Password:</label>
                        <input type="password" class="form-control col-sm-8" name="password_confirm" placeholder="Enter Confirm Password" required>
                </div>
                <div class="form-group row">
                        <label class="col-sm-4">Email:</label><br>
                        <input type="email" class="form-control col-sm-8" name="email" id="email"  onchange="checkemail();" placeholder="Enter Email Address" required>
                        <div id="email_error"></div>
                </div>
                <div class="form-group row">
                    <label for="college" class="col-sm-4">College Department:</label>
                    <select class="form-control col-sm-8" id="college" name="college">
                        <option selected disabled>Select College</option>
                            <option>College of Architecture and Fine Arts (CAFA)</option>
                            <option>College of Arts and Letters (CAL)</option>
                            <option>College of Business Administration (CBA)</option>
                            <option>College of Criminal Justice Education (CCJE)</option>
                            <option>College of Hospitality and Tourism Management (CHTM)</option>
                            <option>College of Information and Communications Technology (CICT)</option>
							<option>College of Industrial Technology (CIT)</option>
							<option>College of Law (CLaw)</option>
							<option>College of Nursing (CN)</option>
							<option>College of Engineering (COE)</option>
							<option>College of Education (COED)</option>
							<option>College of Science (CS)</option>
							<option>College of Sports, Exercise and Recreation (CSER)</option>
							<option>College of Social Sciences and Philosophy (CSSP)</option>
							<option>Graduate School (GS)</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-dark btn-block" name="addacc-btn" style="margin-top: 20px;">Add Account</button><br>
                <p style="text-align: center">Already have an account? <a href="loginSample.php">Login</a></p>
            </div>
    </div>
</body>
</html>

<script type="text/javascript">
    // SELECTING ALL TEXT ELEMENTS
var username = document.forms['vform']['username'];
var email = document.forms['vform']['email'];
function checkuser(){
  if(username.value)
 {
  $.ajax({
  type: 'post',
  url: 'checkacct.php',
  data: {
   user_name:username.value,
  },
  success: function (response) {
   $( '#name_error' ).html(response);
   if(response=="OK")   
   {
    return true;    
   }
   else
   {
    return false;   
   }
  }
  });
 }
 else
 {
  $( '#name_error' ).html("");
  return false;
 }
}
function checkemail()
{
    
 if(email.value)
 {
  $.ajax({
  type: 'post',
  url: 'checkacct.php',
  data: {
   user_email:email.value,
  },
  success: function (response) {
   $( '#email_error' ).html(response);
   if(response=="OK")   
   {
    return true;    
   }
   else
   {
    return false;   
   }
  }
  });
 }
 else
 {
  $( '#email_error' ).html("");
  return false;
 }
}
</script>
