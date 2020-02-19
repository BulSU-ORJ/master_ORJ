<?php 
session_start();
include 'authcontrollerAdmin.php';
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
                <div class="form-group d-flex justify-content-center mb-3">
                        <img class="img-fluid d-lg-block d-none" id="brand_logo" src="Icon/lock.png">
                        <img class="img-fluid d-lg-none" id="brand_logo_2" src="Icon/lock.png">
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
            <form class="form-container" method="POST" action="forgetpass3Admin.php"> 
                        
                        <div class="form-group text-center" style="margin-top:5%">
                            <h3>Forgot Password Form</h3> 
                        </div>
                <div class="form-group">

                    
                    <label>Email:</label>
                    <input type="email" class="form-control form-control-lg" name="email1" placeholder="Enter Email Address" value="<?php echo $_SESSION['email']; ?>" disabled>
                    <label >New Password:</label>
                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Enter Password" required >
                    <label >Confirm Password:</label>
                    <input type="password" class="form-control form-control-lg" name="Cpassword" placeholder="Enter Confirm Password" required>
                </div>
                <button type="submit" class="btn btn-lg btn-dark btn-block" name="fp3-btn">Next</button>
                <a class="btn btn-dark btn-block"  href="forgetpassAdmin.php">Cancel</a>
            </form>
            </div>
        </div>
</body>
</html>