<?php
	include "connect.php";
	$flag=1;
	$output='';
	$logo='';
	if(isset($_POST['researchNo'])){
		$hash=$_POST['researchNo'];
        $query = "SELECT * FROM `uploaddata` ORDER BY ID DESC";
        $result = $con->query($query);
        if($result) {
            while($row=mysqli_fetch_array($result)){
                if (password_verify($row['researchNo'], $hash)) {
                    $researchNum=$row['researchNo'];
                    $count=1;
                    $count+=$row['viewCount'];            
                    $output .= $row['title'].'*'.$row['author'].'*'.$row['abstract'].'*'.$row['college'].'*'.$row['email'].'*'.$count.'*'.$flag;
                    $updateSql = "UPDATE `uploaddata` SET `viewCount`=$count WHERE `researchNo`='{$researchNum}'";
                    mysqli_query($con,$updateSql);
                    break;
                }
                $flag+=1;
            }
        }	
	$response = array(
		'message'  => $output//,
		//'header'  => $logo
	);

	// Return response 
	echo json_encode($response);
}
?>