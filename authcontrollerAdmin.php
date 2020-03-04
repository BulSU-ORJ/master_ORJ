<?php
require_once 'sendEmails.php';
$username = "";
$email = "";
$radio = "";

$conn = new mysqli('localhost', 'root', '', 'ovpretdb');

//sign-up RC-Admin
if(isset($_POST['addacc-btn'])){
	if(!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password_confirm']) && !empty($_POST['email']) && !empty($_POST['college'])){
			
			$firstname = $_POST['firstname'];
	        $lastname = $_POST['lastname'];
	        $username = $_POST['username'];
	        $email = $_POST['email'];
            $college = $_POST['college'];
            $status="active";
	        $token = bin2hex(random_bytes(50)); // generate unique token
	        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password

	        $que="SELECT * FROM users_rc WHERE username=?";
            $stmt = $conn->prepare($que);
            $stmt->bind_param('s', $username);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                if($username != $user['username'] && $email != $user['email']){
                $query = "INSERT INTO users_rc SET username=?, firstname=?, lastname=?, email=?, token=?, password=?,status=?, department=?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('ssssssss', $username, $firstname, $lastname, $email, $token, $password, $status, $college);
                $result = $stmt->execute();

                if ($result) {
                    $user_id = $stmt->insert_id;
                    $stmt->close();

                    //TO DO: send verification email to user
                    sendVerificationEmailAdmin($email, $token);

                    $_SESSION['userRC_id'] = $user_id;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    $_SESSION['verified'] = false;
                    $_SESSION['message'] = 'You are Now Registered';
                    $_SESSION['type'] = 'alert-success';
                    header('location: valid.php');
                } else {
                    $_SESSION['error_msg'] = "Database error: Could not register user";
                }
            }else{
                echo "<script>alert('Your username or email address has already been used)'</script>";       
            }
        }
	}
}

//update admins fullname
if(isset($_POST['adminsave-btn'])){
    if(isset($_SESSION['member_id'])){
        $id = $_SESSION['member_id'];
        $fullname = $_POST['fullname'];
        $password = $_POST['password'];

        $query = "SELECT * FROM members WHERE member_id = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s',$id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $password_hash=$user['member_password'];
            if (password_verify($password,$password_hash)) { // if password matches 
                $que="UPDATE members SET members_fullName='$fullname'WHERE member_id='$id'";
                $result = mysqli_query($con, $que);
                   if($result)
                   {
                       echo '<script>alert("Data Updated")</script>';
                   }else{
                       echo '<script>alert("Data Not Updated")</script>';
                   } 
            }else{
                echo "<script>alert('Password doesn't matched')</script>";
            }

        }
    }
}
//update admin email
if (isset($_POST['adminsave-btn2'])){
    if(isset($_SESSION['member_id'])){
        $id = $_SESSION['member_id'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "SELECT * FROM members WHERE member_id = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s',$id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $password_hash=$user['member_password'];
            if (password_verify($password,$password_hash)) { // if password matches

            echo "<script>alert('gumana gumana')</script>";
            }
        }   
    }
}
//update admin password
if(isset($_POST['adminsave-btn3'])){
    if(isset($_SESSION['member_id'])){
        $id = $_SESSION['member_id'];        
        $password = $_POST['password'];
    
        $query = "SELECT * FROM members WHERE member_id = ? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s',$id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $password_hash=$user['member_password'];
            if (password_verify($password,$password_hash)) { // if password matches
                if(isset($_POST['newpassword']) == isset($_POST['Cpassword'])){
                    $password = password_hash($_POST['newpassword'], PASSWORD_DEFAULT); //encrypt password
                    $que="UPDATE members SET member_password='$password'WHERE member_id='$id'";
                    $result = mysqli_query($con, $que);
                   if($result)
                   {
                       echo '<script>alert("Data Updated")</script>';
                   }else{
                       echo '<script>alert("Data Not Updated")</script>';
                   }
                }
            }
        }   
    }   
}

/*if(isset($_POST['update-btn'])){
    if(isset($_SESSION['member_id'])){
        $id = $_SESSION['member_id'];
        $username = $_POST['newusername'];
        $password = password_hash($_POST['password1'], PASSWORD_DEFAULT); //encrypt password
        $query = "SELECT * FROM members WHERE member_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if($id == $user['member_id']){
                $que="UPDATE members SET member_name='$username',member_password='$password' WHERE member_id='$id'";
                $result = mysqli_query($conn, $que);
                   if($result)
                   {
                       echo '<script>alert("Data Updated")</script>';
                   }else{
                       echo '<script>alert("Data Not Updated")</script>';
                   }
            }
        }
    }
}*/

//login RC
if(isset($_POST['login'])){
    $username=$_POST['member_name'];
    $password=$_POST['member_password'];

    $query = "SELECT * FROM users_rc WHERE username=? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s',$username);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if($user['verified'] != 0 ){
                if($user['status'] != 0){
                    if (password_verify($password, $user['password'])) { // if password matches
                        $stmt->close();
                        
                        $_SESSION['userRC_id'] = $user['id'];
                        $_SESSION['username'] = $user['username'];
                        $_SESSION['email'] = $user['email'];
                        $_SESSION['verified'] = $user['verified'];
                        $_SESSION['message'] = 'You are logged in!';
                        $_SESSION['type'] = 'alert-success';
                        header('location: adminRC.php');
                        exit(0);
                    } else { // if password does not match
                        echo "<script>alert('Wrong username / password')</script>";
                    }
                }else{
                    echo "<script>alert('Your account has been disabled')</script>";
                }
            }else{
                echo "<script>alert('Please verify first your email')</script>";
            }
        }
    }

//forget pass admin
if(isset($_POST['radio'])){
    $_SESSION['radio']=$_POST['radio'];
        if (isset($_SESSION['radio'])){
            $radio=$_SESSION['radio'];
            if($radio == "admin"){
                if(isset($_POST['email1'])){
                    $email = $_POST['email1'];
                    $token = "qwertyuiopasdfghjklzxcvbnm1234567890";
                    $token =str_shuffle($token);
                    $token = substr($token, 0 , 10);

                    $query = "SELECT * FROM members WHERE member_email = ? LIMIT 1";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param('s', $email);

                    if ($stmt->execute()){
                            $result = $stmt->get_result();
                            $user = $result->fetch_assoc();
                            if($email == $user['member_email']){
                                $que="UPDATE members SET token='$token' WHERE member_email='$email'";
                                $result = mysqli_query($conn, $que);

                                if($result)
                                {
                                        
                                        //sendtokenforgotpassword
                                        sendTokenForgotPasswordAdmin($email,$token);
                                        $_SESSION['radio'] = $radio;
                                        $_SESSION['email'] =$email;
                                        $_SESSION['message'] = 'Get the Verification Code in Your Email';
                                        $_SESSION['type'] = 'alert-info';
                                        header('location:forgetpass2Admin.php');
                                        
                                }else{
                                       echo '<script> alert("Data Not Updated");</script>';
                                }
                            }else{
                                echo "<script> alert('email does not exist');</script>";
                            }
                    }
                }
            }
        
        elseif ($radio == "recoor"){
            if(isset($_POST['email1'])){
            $email = $_POST['email1'];
            $token = "qwertyuiopasdfghjklzxcvbnm1234567890";
            $token =str_shuffle($token);
            $token = substr($token, 0 , 10);

            $query = "SELECT * FROM users_rc WHERE email = ? LIMIT 1";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $email);

            if ($stmt->execute()){
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                if($email == $user['email']){
                    $que="UPDATE users_rc SET token='$token' WHERE email='$email'";
                    $result = mysqli_query($conn, $que);

                    if($result)
                    {   

                        $_SESSION['radio'] =$radio;         
                        //sendtokenforgotpassword
                        sendTokenForgotPasswordAdmin($email,$token);

                        $_SESSION['email'] =$email;
                        $_SESSION['message'] = 'Get the Verification Code in Your Email';
                        $_SESSION['type'] = 'alert-info';
                        header('location:forgetpass2Admin.php'); 
                        }else{
                            echo '<script> alert("Data Not Updated");</script>';
                        }
                        }else{
                            echo "<script> alert('email does not exist');</script>";
                        }
                }
            }
        }
    }
}
//forget pass2 admin
if(isset($_POST['fp2-btn'])){
    if(isset($_SESSION['radio'])){
        $radio = $_SESSION['radio'];
        if ($radio == 'admin'){
            $email=$_SESSION['email'];
            $token =$_POST['verify_code'];
            
            $query = "SELECT * FROM members WHERE member_email =? LIMIT 1";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('s',$email);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                if($email == $user['member_email']){
                    if($token == $user['token']){
                        $que ="SELECT * FROM members WHERE token = '$token'";
                        $result = mysqli_query($conn, $que);

                        if($result){
                            $_SESSION['radio'] =$radio;    
                            $_SESSION['email'] =$email;
                            $_SESSION['token'] =$token;
                            $_SESSION['message'] = 'Get the Verification Code in Your Email';
                            $_SESSION['type'] = 'alert-info';
                            header('location:forgetpass3Admin.php');
                        }else{
                            echo "update failed";
                        }
                    }
                }else{
                    echo "Email doesn't matched";
                }
            }
        }
        elseif ($radio == 'recoor') {
                $email=$_SESSION['email'];
                $token =$_POST['verify_code'];
                
                $query = "SELECT * FROM users_rc WHERE email =? LIMIT 1";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('s',$email);

                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    $user = $result->fetch_assoc();
                    if ($email == $user['email'] && $token == $user['token']){
                        $que ="SELECT * FROM users_rc WHERE token = '$token'";
                        $result = mysqli_query($conn, $que);

                        if($result){
                            $_SESSION['radio'] =$radio;    
                            $_SESSION['email'] =$email;
                            $_SESSION['token'] =$token;
                            $_SESSION['message'] = 'Get the Verification Code in Your Email';
                            $_SESSION['type'] = 'alert-info';
                            header('location:forgetpass3Admin.php');
                        }else{
                            echo "update failed";
                        }  
                    }
                }
            
            }
        }
    }
//forgetpass 3 admin
if(isset($_POST['fp3-btn'])){
    if(isset($_SESSION['radio'])){
        $radio = $_SESSION['radio'];
        if ($radio=="admin"){
            if($_POST['password'] == $_POST['Cpassword']){
                $email = $_SESSION['email'];
                $token = $_SESSION['token'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password
                $query = "SELECT * FROM members WHERE member_email=? LIMIT 1";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('s',$email);

                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    $user = $result->fetch_assoc();
                    if($email == $user['member_email'] && $token == $user['token']){
                        $que ="UPDATE members SET member_password = '$password' WHERE token = '$token'";
                        $result = mysqli_query($conn, $que);

                        if($result){
                            $_SESSION['message'] = 'Your password has been updated';
                            $_SESSION['type'] = 'alert-success';
                            header('refresh: 3; url=loginSample.php');
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
        elseif ($radio=="recoor"){
            if($_POST['password'] == $_POST['Cpassword']){
                $email = $_SESSION['email'];
                $token = $_SESSION['token'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT); //encrypt password
                $query = "SELECT * FROM users_rc WHERE email=? LIMIT 1";
                $stmt = $conn->prepare($query);
                $stmt->bind_param('s',$email);

                if ($stmt->execute()) {
                    $result = $stmt->get_result();
                    $user = $result->fetch_assoc();
                    if($email == $user['email'] && $token == $user['token']){
                        $que ="UPDATE users_rc SET password = '$password' WHERE token = '$token'";
                        $result = mysqli_query($conn, $que);

                        if($result){
                            $_SESSION['message'] = 'Your password has been updated';
                            $_SESSION['type'] = 'alert-success';
                            header('refresh: 3; url=loginSample.php');
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
    }
}



    /*if(isset($_POST['email1'])){
    
        $query = "SELECT * FROM members WHERE member_email =? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s',$email);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if($email == $user['member_email']){
                if($token == $user['token']){
                    $que ="UPDATE members SET member_password = '$password' WHERE token = '$token'";
                    $result = mysqli_query($conn, $que);

                        if($result){
                            $_SESSION['message'] = 'Your password has been updated';
                            $_SESSION['type'] = 'alert-success';
                            header('refresh: 3; url=loginSample.php');
                        }else{
                            echo "update failed";
                        }
                }
            }else{
                    echo "Email doesn't matched";
            }
    }else
    }else{
        echo "not set";
    }*/
//update RC
if(isset($_POST['updateRC-btn'])){
    if(isset($_SESSION['user_id'])){
        $id = $_SESSION['user_id'];
        $newusername = $_POST['newusername'];
        $password = password_hash($_POST['password1'], PASSWORD_DEFAULT); //encrypt password

        $query = "SELECT * FROM users_rc WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();
            if($id == $user['id']){
                $que="UPDATE users_rc SET username='$newusername',password='$password' WHERE id='$id'";
                $result = mysqli_query($conn, $que);
                   if($result)
                   {
                       echo '<script>alert("Data Updated"); </script>';
                   }else{
                       echo '<script> alert("Data Not Updated"); </script>';
                   }
            }
        }
    }
}

?>