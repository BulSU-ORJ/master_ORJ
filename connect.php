<?php
	$con=mysqli_connect("localhost","root","");
	if(!mysqli_select_db($con,"ovpretdb")){
		die("connection_error");
	}
?>