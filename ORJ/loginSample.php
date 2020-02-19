<?php
session_start();

if(!empty($_SESSION['userRC_id'])){
    header("Location: adminRC.php");
  }
require_once "Auth.php";
require_once "Util.php";
require_once "DBController.php";

$auth = new Auth();
$db_handle = new DBController();
$util = new Util();

require_once "authCookieSessionValidate.php";
$error=0;
$error2=0;
$warning1="";
$warning2="";
if ($isLoggedIn) {
    $util->redirect("adminnew.php");
}

if (!empty($_POST["login"])) {
	if(isset($_POST['radio'])){
		$radio=$_POST['radio'];
		if($radio == "admin"){
		    $isAuthenticated = false;
		    
		    $username = $_POST["member_name"];
		    $password = $_POST["member_password"];

		    
		    $user = $auth->getMemberByUsername($username);
			if(($user=="false")&&(!empty($password))){
				$error=1;
				$warning1="Please enter your username!";
			}
			else if(($user=="false")&&(empty($password))){
				$error=1;
				$error2=1;
				$warning1="Please enter your usernamess!";
				$warning2="Please enter your password!";
			}
			else{
				$error=0;
				if(!empty($password)){
					$error2=0;
					if (password_verify($password, $user[0]["member_password"])) {
						$isAuthenticated = true;
					}
					if ($isAuthenticated) {
						$_SESSION["member_id"] = $user[0]["member_id"];
						$_SESSION["adminName"] = $user[0]["members_fullName"];
		                
		        
						// Set Auth Cookies if 'Remember Me' checked
						if (! empty($_POST["remember"])) {
							setcookie("member_login", $username, $cookie_expiration_time);
		                    
							//setcookie("member_name", $user[0]["members_fullName"], $cookie_expiration_time);
					
							setcookie("member_password",$password,$cookie_expiration_time);
		            
							$random_password = $util->getToken(16);//getRandomPassword
							setcookie("random_password", $random_password, $cookie_expiration_time);
		            
							$random_selector = $util->getToken(32);//getRAndomSelector
							setcookie("random_selector", $random_selector, $cookie_expiration_time);
		            
							$random_password_hash = password_hash($random_password, PASSWORD_DEFAULT);//secure random_password
							$random_selector_hash = password_hash($random_selector, PASSWORD_DEFAULT);//secure random_selector
		            
							$expiry_date = date("Y-m-d H:i:s", $cookie_expiration_time);
		            
							// mark existing token as expired
							$userToken = $auth->getTokenByUsername($username, 0);
							if (! empty($userToken[0]["id"])) {
								$auth->markAsExpired($userToken[0]["id"]);
							}
							// Insert new token
							$auth->insertToken($username, $random_password_hash, $random_selector_hash, $expiry_date);
						} else {
							$util->clearAuthCookie();
						}
						$util->redirect("adminnew.php");
					} else {
						$error=1;
						$error2=1;
						$warning1="Invalid username or password";
						$warning2="Invalid username or password";
					}
				}
				else{
					$error2=1;
					$warning2="Please enter your password!";
				}
			}
		}elseif ($radio =="recoor") {
			include('authcontrollerAdmin.php');
		}
	}
}
?>
<!doctype html>
<html lang="en">
	<head>
		<link rel="icon" href="Icon/bulsuLogo.png" sizes="16x16" type="image/png"><title>Bulsu Online Research Journal</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" href="loginStyle.css">
		
	</head>
	<body>
	
		<section class="container-fluid">
			<section class="row justify-content-center">
				<section class="col-12 col-sm-8 col-md-5">
					<form class="form-container" method="post" action="" name="loginForm" > 
						<div class="form-group" id="titlelogo">
							<img class="img-fluid d-lg-block d-none"  src="header3.png">
							<img class="img-fluid d-lg-none" id="headerLogo" style="height: 50px" src="header3.2.png">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Enter Username" name="member_name" <?php if($error == "1"){ echo 'style="border:1px solid red; box-shadow:2px 2px 3px 0px red;"'; } ?> value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>">
							<div class="container fa-2x " id="warningDivUsername" <?php if($error == "1"){ echo 'style="display:block;"'; } ?>>
								<img src="exclamation-mark.png" class="avatar">
								<p class="text-danger" id="usernameWarning"><?php echo $warning1; ?></p>
							</div>
						</div>
                        
						<div class="form-group">
							<input type="password" class="form-control" placeholder="Enter Password" name="member_password" <?php if($error2 == "1"){ echo 'style="border:1px solid red; box-shadow:2px 2px 3px 0px red;"'; } ?> value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>">
							<div class="container fa-2x " id="warningDivPassword" <?php if($error2 == "1"){ echo 'style="display:block;"'; } ?>>
								<img src="exclamation-mark.png" class="avatar">
								<p class="text-danger" id="passWarning"><?php echo $warning2; ?></p>
							</div><br>
                        </div>
                        <div class="form-group row text-center">
                                    <label class="radio-inline col-sm-6"><input type="radio" id="admin" name="radio" value="admin" checked> Admin</label>
                                    <label class="radio-inline col-sm-6"><input type="radio" id="recoor" value="recoor" name="radio"> Research Coordinator</label>
                        </div>
                        <input type="submit" id="loginSubmit" class="btn btn-dark btn-block" name="login" value="Login">
						<div class="form-group form-check" id="checkDiv">
							<input type="checkbox" class="form-check-input" name="remember" id="remember"
							<?php if((!empty($_POST["member_name"])) && (!empty($_POST["member_password"]))) { ?> checked
                <?php } ?> /> 
							<label class="form-check-label" for="remember">Stay Signed-in</label>
							<a href="forgetpassAdmin.php" class="text-decoration-none" id="forgotPass">Forgot Password?</a>
						</div>
					</form>
				</section>
			</section>
		</section>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
</html>