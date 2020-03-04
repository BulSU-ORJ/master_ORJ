<?php
	if(!empty($_POST['staticRN'])){
		include "connect.php";
		$date = new DateTime("now", new DateTimeZone('Asia/Manila') );
		$fa= $date->format('Ymd');
		$input = 1;

		$sql = "SELECT `researchNo` FROM `uploaddata` ORDER BY id DESC LIMIT 1";
		$result = mysqli_query($con,$sql);
		$rowsCount=mysqli_num_rows($result);
		
		if ($result && $rowsCount > 0) {
			$row = mysqli_fetch_assoc($result);
			$y=$row['researchNo'];
			list($rn, $num) = explode('-',$y);//split date and research number
			if($fa==$rn){
				if($num!='99'){
					$changeType=intval($num);
					$changeType+=1;
					$number = str_pad($changeType, 2, "0", STR_PAD_LEFT);
					$researchNum=$fa."-".$number;
					$response['message']= $researchNum;
				}
				else{
					$response['message']= 'limit na ito';
				}
			}
			else{
				$input = 1;
				$number = str_pad($input, 2, "0", STR_PAD_LEFT);
				$researchNum=$fa."-".$number;
				$response['message']= $researchNum;
			}
		}
		else{
			$input = 1;
			$number = str_pad($input, 2, "0", STR_PAD_LEFT);
			$researchNum=$fa."-".$number;
			$response['message']= $researchNum;
		}
	}
// Return response 
echo json_encode($response);
?>