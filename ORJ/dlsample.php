<?php
	include 'connect.php';
    $query = "SELECT `file` FROM `datafile`
			WHERE `researchNo` = '20191119-01'";
			$result = $con->query($query);
                $row = mysqli_fetch_assoc($result);
                $query2 = "SELECT `title` FROM `uploaddata`
                WHERE `researchNo` = '20191119-01'";
                $result2 = $con->query($query2);
                        // Get the row
                        $row2 = mysqli_fetch_assoc($result2);
                        header('Accept-Ranges: bytes');
                        header('Content-Transfer-Encoding: binary');
                        header("Content-Type: application/pdf");
                        header("Content-Disposition: inline; filename=".$row2['title']);
                        readfile($row['file']);
	
?>
