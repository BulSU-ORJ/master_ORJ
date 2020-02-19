<?php
    include "connect.php";
    $id=$_POST['id'];
    $fileName='';
    $fileType='';
    $fileSize='';
    $result=mysqli_query($con,"SELECT * FROM `dl_forms` where `fileid`='{$id}'");
    if($result){
        $row=mysqli_fetch_assoc($result);
        $fileName=$row['filename'];
        $ext = strtoupper(pathinfo($fileName, PATHINFO_EXTENSION));
        $fileType=$ext." File";
        $fileSize=$row['size'];
        $units = array('B','KB','MB','GB');
        $power = $fileSize > 0 ? floor(log($fileSize,1024)) : 0;
        $size= number_format($fileSize / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
        
        
    }
    
    $response = array(
		'name'  => $fileName,
		'type'  => $fileType,
		'size'  => $size
	);

	// Return response 
	echo json_encode($response);

?>