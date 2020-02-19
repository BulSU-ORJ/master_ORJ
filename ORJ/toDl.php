<?php

	session_start();
	include 'connect.php';
	if(isset($_POST['id'])){
        $_SESSION['toDl']=$_POST['id'];
        $msg="okay";
	}else{
		$msg="no";
	}
	echo json_encode($msg);
	mysqli_close($con);
?>
		