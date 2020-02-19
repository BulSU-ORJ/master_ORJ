<?php

	session_start();
	include 'connect.php';
	if(isset($_POST['i'])){
        $_SESSION['pdfVal']=$_POST['i'];
        $msg="okay";
	}else{
		$msg="no";
	}
	echo json_encode($msg);
	mysqli_close($con);
?>
		