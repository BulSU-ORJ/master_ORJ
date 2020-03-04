<?php
    include 'controllers-authController.php';

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
            <div class="shadow justify-content-center p-5 m-auto col-sm-6" id="uploadDiv" style=" float: right" method="POST" action="forgetpass2.php">
                <div class="form-group d-flex justify-content-center mb-3">
                    <img class="img-fluid d-lg-block d-none" id="brand_logo" src="Icon/lock.png">
                    <img class="img-fluid d-lg-none" id="brand_logo_2" src="Icon/lock.png">
                </div>
                <form class="form-container" method="POST" action="forgetpass2.php">     
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
                    <div class="child-div">
                
                <div class="form-group">
                    <label>Email:</label>
                    <input type="email" class="form-control form-control-lg" name="email" placeholder="Enter Email Address" value="<?php echo $_SESSION['email']; ?>" disabled>
                    <label >Verification Code:</label>
                    <input type="text" class="form-control form-control-lg" name="verify_code" id="verify_code" placeholder="Enter Verification Code" required>
                    <!--label >New Password:</label>
                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Enter Password" >
                    <label >Confirm Password:</label>
                    <input type="password" class="form-control form-control-lg" name="Cpassword" placeholder="Enter Confirm Password"-->
                </div>
                <button type="submit" class="btn btn-dark btn-block" name="fp2-btn">Next</button>
                <a class="btn btn-dark btn-block"  href="forgetpass.php">Cancel</a>
            </form>
            </div>
        </div>
    </div>
</body>
</html>