<?php
	session_start();
	include 'connect.php';
	require_once "Util.php";
	$util = new Util();

	
		$id=$_SESSION['toDl'];
		if(!empty($id)){
			$query = "SELECT * FROM `dl_forms`
			WHERE `fileid` = '{$id}'";
			$result = $con->query($query);
			if($result) {
                $row = mysqli_fetch_assoc($result);
                if($result->num_rows == 1) {
                    header('Content-type:'.$row['filetype']);
                    header('Content-Disposition: attachment; filename="' . $row['filename'] . '"');
                    header('Content-Transfer-Encoding: binary');
                    ob_clean();
                    ob_flush();
                    echo $row['data'];
                    
                }
			
			}
		}//else{
			//$util->redirect("tables.php");
		//}
		
	
?>
