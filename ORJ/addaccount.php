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
                    <a class="dropdown-item" style="color: black" href="rc_accounts.php">RC Accounts</a>
                    <a class="dropdown-item" style="color: black" href="changepassAdmin.php">Edit Account</a>
                    <a class="dropdown-item" style="color: black" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container">
           	<form class="form-container col-sm-6 col-md-6   " style="float:right; margin-top: 6%" method="POST" action="addaccount.php" onsubmit="return Validate();" name="vform">
                <div class="form-group" style="text-align: center;">
                    <h3>Add Account Here</h3>
                </div>
                <div class="form-group">
                    <div id="firstname_div" class="row" style="margin-bottom: 10px; margin-right: 5px">
                        <label class="col-sm-4">First Name:</label>
                        <input type="text" style="padding-top: 2px; padding-bottom: 2px; float:right"  class="form-control form-control-lg col-sm-8" name="firstname" placeholder="Enter First Name" >
                        <div id="firstname_error"></div>
                    </div>
                    <div id="lastname_div" class="row" style="margin-bottom: 10px; margin-right: 5px">
                        <label class="col-sm-4">Last Name:</label>
                        <input type="text" style="padding-top: 2px; padding-bottom: 2px; float:right"  class="form-control form-control-lg col-sm-8" name="lastname" placeholder="Enter Last Name">
                        <div id="lastname_error"></div>
                    </div>
                    <div id="username_div" class="row" style="margin-bottom: 10px; margin-right: 5px">
                        <label class="col-sm-4">Username:</label>
                        <input type="text" style="padding-top: 2px; padding-bottom: 2px; float:right"  class="form-control form-control-lg col-sm-8"  name="username" id="username" placeholder="Enter Username">
                        <div id="name_error"></div>
                    </div>
                    
                    <div id="password_div" class="row" style="margin-bottom: 10px; margin-right: 5px">
                        <label class="col-sm-4">Password:</label>
                        <input type="password" style="padding-top: 2px; padding-bottom: 2px; float:right"  class="form-control form-control-lg col-sm-8" name="password" placeholder="Enter Password">
                    </div>
                    
                    <div id="pass_confirm_div" class="row" style="margin-bottom: 10px; margin-right: 5px"> 
                        <label class="col-sm-4">Confirm Password:</label>
                        <input type="password" style="padding-top: 2px; padding-bottom: 2px; float:right;"  class="form-control form-control-lg col-sm-8" name="password_confirm" placeholder="Enter Confirm Password">
                        <div id="password_error"></div>
                    </div>
                    
                    <div id="email_div" class="row" style="margin-bottom: 10px; margin-right: 5px">
                        <label class="col-sm-4">Email:</label><br>
                        <input type="email" style="padding-top: 2px; padding-bottom: 2px; float:right"  class="form-control form-control-lg col-sm-8" name="email" id="email"  placeholder="Enter Email Address">
                        <div id="email_error"></div>
                    </div>
                    <div class="form-group">
                    <label for="college">College Department:</label>
                    <select class="form-control" id="college" name="college">
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
                <button type="submit" class="btn btn-lg btn-dark btn-block" name="addacc-btn" style="margin-top: 20px;">Add Account</button><br>
                <p style="text-align: center">Already have an account? <a href="loginSample.php">Login</a></p>
                </div>
            </form>
    </div>
</body>
</html>

<script type="text/javascript">
    // SELECTING ALL TEXT ELEMENTS
var firstname = document.forms['vform']['firstname'];
var lastname = document.forms['vform']['lastname'];
var username = document.forms['vform']['username'];
var password = document.forms['vform']['password'];
var password_confirm = document.forms['vform']['password_confirm'];
var email = document.forms['vform']['email'];
// SELECTING ALL ERROR DISPLAY ELEMENTS
var firstname_error = document.getElementById('firstname_error');
var lastname_error = document.getElementById('lastname_error');
var name_error = document.getElementById('name_error');
var password_error = document.getElementById('password_error');
var email_error = document.getElementById('email_error');
// SETTING ALL EVENT LISTENERS
firstname.addEventListener('blur', firstnameVerify, true);
lastname.addEventListener('blur', lastnameVerify, true);
username.addEventListener('blur', nameVerify, true);
email.addEventListener('blur', emailVerify, true);
password.addEventListener('blur', passwordVerify, true);

// validation function
function Validate() {
  // validate firstname
  if (firstname.value == "") {
    firstname.style.border = "1px solid red";
    document.getElementById('firstname_div').style.color = "red";
    firstname_error.textContent = "Firstname is required";
    firstname.focus();
    return false;
  }
  // validate lastname
  if (lastname.value == "") {
    lastname.style.border = "1px solid red";
    document.getElementById('lastname_div').style.color = "red";
    lastname_error.textContent = "lastname is required";
    lastname.focus();
    return false;
  }
  // validate username
  if (username.value == "") {
    username.style.border = "1px solid red";
    document.getElementById('username_div').style.color = "red";
    name_error.textContent = "Username is required";
    username.focus();
    return false;
  }
  // validate username
  if (username.value.length < 3) {
    username.style.border = "1px solid red";
    document.getElementById('username_div').style.color = "red";
    name_error.textContent = "Username must be at least 3 characters";
    username.focus();
    return false;
  }

  // validate password
  if (password.value == "") {
    password.style.border = "1px solid red";
    document.getElementById('password_div').style.color = "red";
    password_confirm.style.border = "1px solid red";
    password_error.textContent = "Password is required";
    password.focus();
    return false;
  }
  // check if the two passwords match
  if (password.value != password_confirm.value) {
    password.style.border = "1px solid red";
    document.getElementById('pass_confirm_div').style.color = "red";
    password_confirm.style.border = "1px solid red";
    password_error.innerHTML = "The two passwords do not match";
    return false;
  }
  if (email.value == "") {
    email.style.border = "1px solid red";
    document.getElementById('email_div').style.color = "red";
    email_error.textContent = "Email is required";
    email.focus();
    return false;
  }

}
// event handler functions
function firstnameVerify() {
  if (firstname.value != "") {
   firstname.style.border = "1px solid #5e6e66";
   document.getElementById('firstname_div').style.color = "#5e6e66";
   firstname_error.innerHTML = "";
   return true;
    }
}
function lastnameVerify() {
  if (lastname.value != "") {
   lastname.style.border = "1px solid #5e6e66";
   document.getElementById('lastname_div').style.color = "#5e6e66";
   lastname_error.innerHTML = "";
   return true;
  }
}
function nameVerify() {
  if (username.value != "") {
   username.style.border = "1px solid #5e6e66";
   document.getElementById('username_div').style.color = "#5e6e66";
   name_error.innerHTML = "";
   return true;
  }
}
function emailVerify() {
  if (email.value != "") {
    email.style.border = "1px solid #5e6e66";
    document.getElementById('email_div').style.color = "#5e6e66";
    email_error.innerHTML = "";
    return true;
  }
}
function passwordVerify() {
  if (password.value != "") {
    password.style.border = "1px solid #5e6e66";
    document.getElementById('pass_confirm_div').style.color = "#5e6e66";
    document.getElementById('password_div').style.color = "#5e6e66";
    password_error.innerHTML = "";
    return true;
  }
  if (password.value === password_confirm.value) {
    password.style.border = "1px solid #5e6e66";
    document.getElementById('pass_confirm_div').style.color = "#5e6e66";
    password_error.innerHTML = "";
    return true;
  }
}

</script>