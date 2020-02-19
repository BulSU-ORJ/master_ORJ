<?php 
	$con=mysqli_connect("localhost","root","");
	if(!mysqli_select_db($con,"momon")){
		die("connection_error");
	}
	$output=array();
	$query = "SELECT DISTINCT `year` from `sample`";
	$result = mysqli_query($con,$query);
	$row=mysqli_fetch_assoc($result);
	$yearOnly = date("Y", $row['year']);
	echo $yearOnly;
?>