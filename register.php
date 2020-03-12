<?php include 'controllers-authController.php' ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="Icon/bulsuLogo.png" sizes="16x16" type="image/png"><title>Bulsu Online Research Journal</title>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
        <link rel="stylesheet" href="trytry.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.5.3/dist/sweetalert2.all.min.js"></script>
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
    
    /* Clear floats after the columns */
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
    
	<div class="container">
            <form class="form-container col-sm-6 col-md-6   " style="float:right; margin-top: 6%" method="POST" action="register.php" name="vform">
                <div class="form-group" style="text-align: center;">
                    <h3>Sign Up Here</h3>
                </div>
                <div class="form-group">
                    <label class="col-sm-4" style="float: left;">First Name:</label>
                    <input type="text" style="float:right"  class="form-control form-control-lg col-sm-8" name="firstname" placeholder="Enter First Name" required>
                    <label class="col-sm-4" style="float: left;">Last Name:</label>
                    <input type="text" style="float:right"  class="form-control form-control-lg col-sm-8" name="lastname" placeholder="Enter Last Name" required>
                    <label class="col-sm-4"style="float: left;">Username:</label>
                    <input type="text" style="float:right"  class="form-control form-control-lg col-sm-8"  name="username" id="username" onchange ="checkname();" placeholder="Enter Username" required>
                    <div id="name_error"></div>
                    <label class="col-sm-4"style="float: left;">Password:</label>
                    <input type="password" style="float:right"  class="form-control form-control-lg col-sm-8" name="password" placeholder="Enter Password" required>
                    <label class="col-sm-4"style="float: left;">Confirm Password:</label>
                    <input type="password" style="float:right;"  class="form-control form-control-lg col-sm-8" name="password_confirm" placeholder="Enter Confirm Password" required>
                    <label class="col-sm-4"style="float: left;">Email:</label><br>
                    <input type="email" style="float:right"  class="form-control form-control-lg col-sm-8" name="email" id="email" onchange="checkemail();" placeholder="Enter Email Address" required>
                    <div id="email_error"></div>
                <button type="submit" class="btn btn-lg btn-dark btn-block" name="signup-btn" style="margin-top: 20px;">Sign Up</button><br>
                <p style="text-align: center">Already have an account? <a href="loginGuest.php">Login</a></p>
                </div>
            </form>
    </div>
</body>
</html>
<script type="text/javascript">
    // SELECTING ALL TEXT ELEMENTS
var username = document.forms['vform']['username'];
var email = document.forms['vform']['email'];
function checkname()
{   

 if(username.value)
 {
  $.ajax({
  type: 'post',
  url: 'checkdata.php',
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
  url: 'checkdata.php',
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