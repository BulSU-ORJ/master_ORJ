<?php
	session_start();
	include 'connect.php';
	require_once "Util.php";
	$util = new Util();

	
		$hash=$_SESSION['pdfVal'];
		if(!empty($hash)){
            $file='';
            $filename='';
			$query = "SELECT * FROM `uploaddata`";
			$result = $con->query($query);
			if($result) {
                while($row=mysqli_fetch_array($result)){
                    if (password_verify($row['researchNo'], $hash)) {
                        $file=$row['filePath'];
                        $arr=explode("/",$row['filePath']);
                        $filename=$arr[1];
                        break;
                    }
                }
                header('Content-type: application/pdf');
                header('Content-Disposition: inline; filename="' . $filename . '"');
                header('Content-Transfer-Encoding: binary');
                header('Content-Length: ' . filesize($file));
                header('Accept-Ranges: bytes');
                readfile($file);
			}
		}else{
			$util->redirect("uploadnew.php");
		}
?>