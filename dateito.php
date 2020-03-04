<?php
	include('connect.php');
    $yearRows='';
	$year=mysqli_query($con,"SELECT DISTINCT YEAR(`date`) FROM `uploaddata`");
    if($year){
        $yearCount=mysqli_num_rows($year);
        if($yearCount>1){
            $yearRows.='<option selected>Select All</option>';
            while($rowYear=mysqli_fetch_array($year)){
                
                $yearRows.='<option>'.date('Y',strtotime($rowYear['YEAR(`date`)'])).'</option>';
                echo (int)$rowYear['YEAR(`date`)']."<br>";
            }
          //  $flag1=false;
        }
        else{
            $rowYear=mysqli_fetch_assoc($year);
            $yearRows.='<option selected>'.date('Y',strtotime($rowYear['YEAR(`date`)'])).'</option>';
            // $flag1=true;
            
        }
		
    }
?>