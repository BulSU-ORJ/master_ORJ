<?php
require_once 'sendEmails.php';
session_start();
$username = "";
$email = "";
$errors = [];

$conn = new mysqli('localhost', 'root', '', 'ovpretdb');

// SIGN UP USER
if (isset($_POST['signup-btn'])) {
    if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password_confirm']) && !empty($_POST['email'])){

            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $token = bin2hex(random_bytes(50)); // generate unique token
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password

            $que="SELECT * FROM users WHERE username=?";
            $stmt = $conn->prepare($que);
            $stmt->bind_param('s', $username);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                if($username != $user['username'] && $email != $user['email']){
                $query = "INSERT INTO users SET username=?, firstname=?, lastname=?, email=?, token=?, password=?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ssssss', $username, $firstname, $lastname, $email, $token, $password);
                $result = $stmt->execute();

                if ($result) {
                    $user_id = $stmt->insert_id;
                    $stmt->close();

                    //TO DO: send verification email to user
                    sendVerificationEmail($email, $token);

                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    $_SESSION['verified'] = false;
                    $_SESSION['message'] = 'You are Now Registered';
                    $_SESSION['type'] = 'alert-success';
                    header('location: check.php');
                } else {
                    $_SESSION['error_msg'] = "Database error: Could not register user";
                }
            }else{
                echo "<script>alert('Your username or email address has already been used)'</script>";       
            }
        }
    }
}

// LOGIN
if (isset($_POST['login-btn'])){
    if (!empty($_POST['username']) && !empty($_POST['password'])) {        
    $username = $_POST['username'];
    $password = $_POST['password'];


        $query = "SELECT * FROM users WHERE username=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $username);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if($user['verified'] != 0){        
                    if (password_verify($password, $user['password'])) { // if password matches
                        $stmt->close();

                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['verified'] = $user['verified'];
                        $_SESSION['message'] = 'You are logged in!';
                        $_SESSION['type'] = 'alert-success';
                        header('location: B-HomeRegistered.php');
                        exit(0);
                    } else { // if password does not match
                        $errors['login_fail'] = "Wrong username / password";
                    }
            }else{
                $errors['login_fail'] = "Please verify first your email";
            }
        } else {
            $_SESSION['message'] = "Database error. Login failed!";
            $_SESSION['type'] = "alert-danger";
        }
    }
}
//Update account
if(isset($_POST['update-btn'])){
    if (empty($_POST['newusername'])) {
        $errors['username'] = 'Username required';
    }
    if (empty($_POST['password1'])) {
        $errors['password1'] = 'Password required';
    }
    if (isset($_POST['password1']) && $_POST['password1'] !== $_POST['Cpassword']) {
        $errors['Cpassword'] = 'The two passwords do not match';
    }

    $username = $_SESSION['username'];

    $un=$_POST['newusername'];
    $password = password_hash($_POST['password1'], PASSWORD_DEFAULT); //encrypt password

    if (count($errors) === 0) {
        $query = "SELECT * FROM users WHERE username=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $username);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if($username == $user['username']){
                $que="UPDATE users SET username='$un',password='$password' WHERE username='$username'";
                $result = mysqli_query($conn, $que);
   
                   if($result)
                   {
                       echo 'Data Updated';
                   }else{
                       echo 'Data Not Updated';
                   }
            }else{
                echo "Error Update";
            }
        }
    }
}

//Forget password
if(isset($_POST['fp-btn'])){
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email required';
    }
    $email = $_POST['email'];
    $token = "qwertyuiopasdfghjklzxcvbnm1234567890";
    $token =str_shuffle($token);
    $token = substr($token, 0 , 10);

    if (count($errors) === 0) {
        $query = "SELECT * FROM users WHERE email =? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s',$email);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if($email == $user['email']){
                $que="UPDATE users SET token='$token' WHERE email='$email'";
                $result = mysqli_query($conn, $que);

                   if($result)
                   {
                    
                        //sendtokenforgotpassword
                        sendTokenForgotPassword($email,$token);

                        $_SESSION['email'] =$email;
                        $_SESSION['message'] = 'Please type the verification code we sent to your Email';
                        $_SESSION['type'] = 'alert-info';
                        header('location:forgetpass2.php');
                        
                   }else{
                       echo 'Data Not Updated';
                   }
            }else{
                echo "email doesn't exist";
            } 
        }else{
            echo "Database Error!";
        }
    }
}
//forgetpass 2
if(isset($_POST['fp2-btn'])){
    if (!empty($_POST['verify_code'])) {
        
        $email=$_SESSION['email'];
        $token =$_POST['verify_code'];
        
        $query = "SELECT * FROM users WHERE email =? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s',$email);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if($email == $user['email']){
                $que ="SELECT * FROM users WHERE token = '$token'";
                $result = mysqli_query($conn, $que);

                    if($result){
                        $_SESSION['email']=$email;
                        $_SESSION['token']=$token;
                        $_SESSION['message'] = 'Please complete the form';
                        $_SESSION['type'] = 'alert-info';
                        header('location:forgetpass3.php');
                    }else{
                        echo "update failed";
                    }
            }else{
                $errors['email']="Email doesn't matched";
            }
        }
    }
}

if(isset($_POST['fp3-btn'])){
    //checking if the text field are empty
    if($_POST['password'] == $_POST['Cpassword']){
            $email = $_SESSION['email'];
            $token = $_SESSION['token'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password
            $query = "SELECT * FROM users WHERE email=? LIMIT 1";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s',$email);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                if($email == $user['email'] && $token == $user['token']){
                    $que ="UPDATE users SET password = '$password' WHERE token = '$token'";
                $result = mysqli_query($conn, $que);

                    if($result){
                        $_SESSION['message'] = 'Your password has been updated';
                        $_SESSION['type'] = 'alert-success';
                        header('refresh: 3; url=loginGuest.php');
                    }else{
                        echo "update failed";
                    }
                }else{
                    echo "email or token doesn't equal";
                }
            }
        }else{
            echo "new password and confirm password are not the same";
        }
    }