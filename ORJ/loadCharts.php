<?php
	include('connect.php');
	$flag=0;
	$acronyms= array('CAFA','CAL','CBA','CCJE','CHTM','CICT','CIT','CLaw','CN','COE','COED','CS','CSER','CSSP','GS');
	foreach($acronyms as $acr){
		$colleges = mysqli_query($con,"SELECT * FROM `upload` WHERE `acronym`='{$acr}'");
		$counts= mysqli_num_rows($colleges);
		$response = array(
			't' => "['Colleges','Number of uploads']",
			'c' => $acr,'n' =>$counts
		);
	}
	echo json_encode($response);
?>