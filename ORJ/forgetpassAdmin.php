<?php 
session_start();
if(isset($_POST['fp-btn'])){
	
	include 'authcontrollerAdmin.php';
}
?>
<!doctype html>
<html lang="en">
	<head>
		<link rel="icon" href="Icon/bulsuLogo.png" sizes="16x16" type="image/png"><title>Bulsu Online Research Journal</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="trytry.css">
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script><!-- jquery CDN -->
		<style>
         #uploadDiv{
            margin:0;
            background-color:white;
            border-radius: 10px;
            
        }
        .form-control{
            padding:5px;
        }
        #brand_logo_container {
			position: absolute;
			height: 170px;
			width: 170px;
			top: -75px;
			border-radius: 50%;
			padding: 10px;
			text-align: center;
		}
		#brand_logo_2{
			height: 150px;
			width: 150px;
			border-radius: 50%;
			border: 2px solid white;
		}
        
	    </style>
	</head>
	<body style="background-color: #f6f6f6;">
        <div class="container mb-5" style="margin-top: 5%;">
				<div class="shadow justify-content-center p-5 m-auto col-sm-6" id="uploadDiv">
                    <div class="form-group d-flex justify-content-center mb-1">
                        <img class="img-fluid d-lg-block d-none" id="brand_logo" src="Icon/lock.png">
                        <img class="img-fluid d-lg-none" id="brand_logo_2" src="Icon/lock.png">
                    </div>
					<form class="form-container" method="POST" action="forgetpassAdmin.php"> 
                        
						<div class="form-group text-center" style="margin-top:5%">
							<h3>Forgot Password Form</h3> 
                        </div>
						<div class="form-group pt-3">
							<label>Email:</label>
                            <input type="text" id="email" name="email1" class="form-control form-control-lg" placeholder="Your Email Address"><br>
                        </div>
                        <div class="row text-center form-group">
							<label class="radio-inline col"><input type="radio" id="admin" name="radio" value="admin" checked> Admin</label>
                            <label class="radio-inline col"><input type="radio" id="recoor" value="recoor" name="radio"> Research Coordinator</label>
						</div>
                        <button class="btn btn-dark btn-block" type="submit" id="fp-btn" name="fp-btn">Next</button>
                        <a class="btn btn-dark btn-block"  href="loginSample.php">Cancel</a>
					</form>
				</div>
			</div>   
	</body>
</html>