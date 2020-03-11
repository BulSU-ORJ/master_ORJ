<?php include 'controllers-authController.php' ?>
<?php 
    if(!empty($_SESSION['username'])){
        header("Location: B-HomeRegistered.php");
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
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="trytry.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <style>
    body{
      background:url("Icon/background2.png") center no-repeat;
      background-size: cover;
        background-attachment: fixed;
    }
    .form-container{
    background: #fff;
    padding: 30px;
    border-radius:10px;
    box-shadow: 0px 0px 10px 0px #000;
    }
    .row:after {
      content: "";
      display: table;
      clear: both;
    }

    /* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
    @media screen and (max-width: 600px) {
      .col-8, .col-5, input[type=submit] {
        width: 100%;
        margin-top: 0;
      }
    }
    </style>
</head>
<body>
	<div class="container-fluid" >
      <div class="col-sm-8 col-md-5" style="float: right; margin-top: 15%; margin-right: 10%;">
	            <form class="form-container"  method="POST" name="vform" action="loginGuest.php" onsubmit="return Validate()">
	            	 <div class="form-group">
      							<img class="img-fluid d-lg-block d-none"  src="header3.png">
      							<img class="img-fluid d-lg-none" id="headerLogo" style="height: 50px" src="header3.2.png">
                    <div id="main_error"></div>
                    <div id="username_div">
      						  <label >Username:</label>
      							<input type="text" class="form-control" placeholder="Enter Username" name="username" id="username" >
                    <div id="name_error"></div>
                    </div>
                    <div id="password_div">
      						  <label >Password:</label>
      							<input type="password" class="form-control" placeholder="Enter Password"name="password" id="password">
                    <div id="password_error"></div>
                    </div><br/>
                    <input type="submit"  class="btn btn-primary btn-block" name="login-btn" value="Login" onclick="checklogin();">
                    <a href="forgetpass.php" class="text-decoration-none" id="forgotPass" >Forgot Password?</a>
                  </div>
			    </form>
			</div>
		</div>
</body>
</html>
<script type="text/javascript">
    // SELECTING ALL TEXT ELEMENTS
var username = document.forms['vform']['username'];
var password = document.forms['vform']['password'];
// SELECTING ALL ERROR DISPLAY ELEMENTS
var name_error = document.getElementById('name_error');
var password_error = document.getElementById('password_error');
var main_error = document.getElementById('main_error');
// SETTING ALL EVENT LISTENERS
username.addEventListener('blur', nameVerify, true);
password.addEventListener('blur', passwordVerify, true);
// validation function
function checklogin(){

  if(username.value != "" && password.value != "")
  {
    $.ajax({
      type: "POST",
      url: 'checkdata.php',
      data: {
      user_name_login:username.value,
      user_pass:password.value
      },
      success: function (response) {
      $( '#main_error' ).html(response);
      if(response)   
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
      $( '#main_error' ).html("");
      return false;
  }
}

function Validate() {

  // validate username
  if (username.value == "") {
    username.style.border = "1px solid red";
    document.getElementById('username_div').style.color = "red";
    name_error.textContent = "Username is required";
    username.focus();
    return false;
  }
  // validate password
  if (password.value == "") {
    password.style.border = "1px solid red";
    document.getElementById('password_div').style.color = "red";
    password_error.textContent = "Password is required";
    password.focus();
    return false;
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
function passwordVerify() {
  if (password.value != "") {
    password.style.border = "1px solid #5e6e66";
    document.getElementById('password_div').style.color = "#5e6e66";
    password_error.innerHTML = "";
    return true;
  }
}
</script>