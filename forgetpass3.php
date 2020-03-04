<?php include 'controllers-authController.php';
	/*if(isset($_POST['email'])){
		$conn = new mysqli('localhost', 'root', '', 'ovpretdb');

		$email =$conn->real_escape_string( $_POST['email']);

		$sql = $conn->query("SELECT username FROM users WHERE email='$email'");
		if($sql->num_rows > 0){
			$token = "qwertyuiopasdfghjklzxcvbnm1234567890";
			$token =str_shuffle($token);
			$token = substr($token, 0 , 10);

			$conn->query("UPDATE users SET token='$token' WHERE email = '$email'");


			exit(json_encode(array("status" => 1, "msg" => 'Please Check your Email Inbox')));
		}else{
			exit(json_encode(array("status" => 0, "msg" => 'Please Check your Inputs!')));
		}
	}*/
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
    <style>
    body{
        background:url("Icon/background2.png") center no-repeat;
        background-size: cover;
    }
    #uploadDiv{
        margin:0;
        background-color:white;
        border-radius: 10px;      
    }
    .form-control{
        padding:5px;
    }
    #brand_logo_2{
        height: 150px;
        width: 150px;
        border-radius: 50%;
        border: 2px solid white;
    }
    </style>
</head>
<body>
      <div class="container mb-5" style="margin-top: 5%;">
            <div class="shadow justify-content-center p-5 m-auto col-sm-6" id="uploadDiv">
                <div class="form-group d-flex justify-content-center mb-3">
                        <img class="img-fluid d-lg-block d-none" id="brand_logo" src="Icon/lock.png">
                        <img class="img-fluid d-lg-none" id="brand_logo_2" src="Icon/lock.png">
                    </div>
                    <form class="form-container" method="POST" action="forgetpass3.php">     
                    <div class="form-group text-center" style="margin-top:5%">
                        <h3>Forget Password Form</h3> 
                    </div>
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert <?php echo $_SESSION['type'] ?>" style="text-align: center">
                        <?php
                            echo $_SESSION['message'];
                            unset($_SESSION['message']);
                            unset($_SESSION['type']);

                        ?>
                    </div>
                <?php endif;?>
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control form-control-lg" name="email1" placeholder="Enter Email Address" value="<?php echo $_SESSION['email']; ?>" disabled>
                    <label >New Password:</label>
                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Enter Password" required>
                    <label >Confirm Password:</label>
                    <input type="password" class="form-control form-control-lg" name="Cpassword" placeholder="Enter Confirm Password" required>
                </div>
                <button type="submit" class="btn btn-lg btn-dark btn-block" name="fp3-btn">Next</button>
                <a class="btn btn-dark btn-block"  href="forgetpass.php">Cancel</a>
            </form>
            </div>
        </div>
	<!--<script src="http://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script type="text/javascript">
		var email = $("#email");

		$(document).ready(function(){
			$('.btn-info').on('click', function(){
				if(email.val() != ""){
					email.css('border','1px solid green');

					$.ajax({
						url:'forgetpass.php',
						method: 'POST',
						dataType: 'json',
						data:{
							email: email.val()
						}, success: function(response){
							if(!response.success){
								$("#response").html(response.msg).css('color', "red");
							}else{
								$("#response").html(response.msg).css('color', "green");
							}
						}
					});
				}else{
					email.css('border','1px solid red');
				}
			});
		});
        </script>-->
</body>
</html>