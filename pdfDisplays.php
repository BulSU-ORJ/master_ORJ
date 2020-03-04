<?php
	session_start();
	include 'connect.php';
	require_once "Util.php";
	$util = new Util();

	
		$id=$_SESSION['pdfVal'];
		if(!empty($id)){
			$query = "SELECT * FROM `datafile`
			WHERE `file_id` = '20191127-02'";
			$result = $con->query($query);
			if($result) {
                $row = mysqli_fetch_assoc($result);
                    $_SESSION['pdfVal']="";
                    if($result->num_rows == 1) {
                        header('Content-type: application/pdf');
                        header('Content-Disposition: inline; filename="' . $row['file_name'] . '"');
                        header('Content-Transfer-Encoding: binary');
                        header('Content-Length: '.$row['file_size']."'");
                        header('Accept-Ranges: bytes');
                        die($row['data']);
                        //readfile("data:application/pdf;base64,$pdf");
                    }
                
			
			}
		}else{
			$util->redirect("tables.php");
		}
		
	
?>
