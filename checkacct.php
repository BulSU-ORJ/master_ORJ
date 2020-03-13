
<?php

$conn = new mysqli('localhost', 'root', '', 'ovpretdb');

if(isset($_POST['user_name']))
{
  $name=$_POST['user_name'];

  $query=" SELECT * FROM users_rc WHERE username=?";
  $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $name);

  if ($stmt->execute()) {
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
      if($name == $user['username']){
        echo "<script>alert('User Name Already Exist')</script>";
      }
      else
      {
        echo "<script>alert('OK')</script>";
      }
    exit();
  }
}

if(isset($_POST['user_email']))
{
  $emailId=$_POST['user_email'];

  $query=" SELECT * FROM users_rc WHERE email=?";
  $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $emailId);

  if ($stmt->execute()) {
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    if($emailId == $user['email']){
        echo "<script>alert('Email Already Exist')</script>";
    }
    else
    {
        echo "<script>alert('OK')</script>";
    }
  exit();
  }
}

// if(isset($_POST['user_name_login']) && isset($_POST['user_pass']))
// {
//     $name=$_POST['user_name_login'];
//     $pass=$_POST['user_pass'];

//     $query = "SELECT * FROM users WHERE username=? LIMIT 1";
//         $stmt = $conn->prepare($query);
//         $stmt->bind_param('s', $name);

//         if ($stmt->execute()) {
//             $result = $stmt->get_result();
//             $user = $result->fetch_assoc();
//             if($user['verified'] != 0){        
//                     if (password_verify($pass, $user['password'])) { // if password matches
//                         $stmt->close();
                        
//                         return true;
//                         exit(0);
//                     } else { // if password does not match
//                         echo "Wrong username / password";
//                     }
//             }else{
//                 echo "Please verify first your email";
//             }
//         }
// }
?>