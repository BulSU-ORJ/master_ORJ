<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'ovpretdb');

$id = $_SESSION['userRC_id'];

if(isset($_POST['fname']) || isset($_POST['mname']) || isset($_POST['lname']) || isset($_POST['new_pass']) || isset($_POST['old_pass'])){
	$fname = $_POST['fname'];
	$mname = $_POST['mname'];
	$lname = $_POST['lname'];
	$newpass = password_hash($_POST['new_pass'], PASSWORD_DEFAULT); //encrypt password
	$password =$_POST['old_pass'];


	$query ="SELECT * FROM users_rc WHERE id = ? LIMIT 1";
  	$stmt = $conn->prepare($query);
    $stmt->bind_param('s', $id);

  if ($stmt->execute()) {
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $password_hash=$user['password'];
        if($id == $user['id']){
	        if($fname != $user['firstname']){	
	        	$que="UPDATE users_rc SET firstname='$fname',middlename = '$mname', lastname = '$lname' WHERE id='$id'";
	        	$result = mysqli_query($conn, $que);
	                   if($result)
	                   {
	                       echo '<script>alert("Personal info has been updated")</script>';
	                   }else{
	                       echo '<script>alert("Personal info Not Updated")</script>';
	                   }
	        }
	        if (password_verify($password,$password_hash)) { // if password matches
	        	$que="UPDATE users_rc SET password = '$newpass' WHERE id='$id'";
        		$result = mysqli_query($conn, $que);
                   if($result)
                   {
                       echo '<script>alert("Password Updated")</script>';
                   }else{
                       echo '<script>alert("Data Not Updated")</script>';
                   }	
	        }
        }
        /*if($id == $user['member_id']){
        	$que="UPDATE members SET member_password = '$newpass' WHERE member_id='$id'";
        	$result = mysqli_query($conn, $que);
                   if($result)
                   {
                       echo '<script>alert("Data Updated")</script>';
                   }else{
                       echo '<script>alert("Data Not Updated")</script>';
                   }
        }*/
        
	}
}

if(isset($_POST['cpass1']) && isset($_POST['newpass1'])){
  $cpass=$_POST['cpass1'];
  $newpass=$_POST['newpass1'];

  if($cpass == $newpass){
    echo "password_matched";
  }else{
    echo "password doesn't matched";
  }
}
	/*//inequal kung kaninong acct
	$query = "SELECT * FROM users_rc WHERE id = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s',$id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        $password_hash=$user['password'];
            if (password_verify($password,$password_hash)) { // if password matches
            	echo"password_match";
            }else{
            	echo"<script>alert('Password doesn't match')</script>";
            }
            exit();
    }
}*/
?>