<?php
	include('connect.php');
	$output='';
    $output2='';
	$countUpload=0;
    $yearRows='';
    $monthRows='';
    $flag1=false;
    $flag2=false;
	$year=mysqli_query($con,"SELECT DISTINCT YEAR(`date`) FROM `uploaddata`");
    if($year){
         $output2.='<div class="form-group">
                    <label for="agenda" style="font-weight:bold;">By Year:</label>
                    <select class="form-control" id="year" name="year" style="width:250px;">
                    ';
        $yearCount=mysqli_num_rows($year);
        if($yearCount>1){
            $output2.='<option selected>Select All</option>';
            while($rowYear=mysqli_fetch_array($year)){
                $intYr=$rowYear['YEAR(`date`)'];
                $output2.='<option>'.$rowYear['YEAR(`date`)'].'</option>';
                
            }
            $flag1=false;
        }
        else{
            $rowYear=mysqli_fetch_assoc($year);
            $intYr=$rowYear['YEAR(`date`)'];
            $output2.='<option selected>'.$rowYear['YEAR(`date`)'].'</option>';
            $flag1=true;
            
        }
        $output2.='</select>
                </div>';
		
    }
    $month=mysqli_query($con,"SELECT DISTINCT Month(`date`) FROM `uploaddata` order by Month(`date`) ASC");
    if($month){
        $output2.='<div class="form-group">
                    <label for="college" id="labelForMnth" style="font-weight:bold;">By Month:</label>
                    <select class="form-control" id="months" name="months" style="width:250px;">';
        $mnthCount=mysqli_num_rows($month);
        if($mnthCount>1){
            $output2.='<option selected>Select All</option>';
            while($rowmnth=mysqli_fetch_array($month)){
                if($rowmnth['Month(`date`)']=='1'){
                    $output2.='<option>January</option>';
                }else if($rowmnth['Month(`date`)']=='2'){
                    $output2.='<option>February</option>';
                }else if($rowmnth['Month(`date`)']=='3'){
                    $output2.='<option>March</option>';
                }else if($rowmnth['Month(`date`)']=='4'){
                    $output2.='<option>April</option>';
                }else if($rowmnth['Month(`date`)']=='5'){
                    $output2.='<option>May</option>';
                }else if($rowmnth['Month(`date`)']=='6'){
                    $output2.='<option>June</option>';
                }else if($rowmnth['Month(`date`)']=='7'){
                    $output2.='<option>July</option>';
                }else if($rowmnth['Month(`date`)']=='8'){
                    $output2.='<option>August</option>';
                }else if($rowmnth['Month(`date`)']=='9'){
                    $output2.='<option>September</option>';
                }else if($rowmnth['Month(`date`)']=='10'){
                    $output2.='<option>October</option>';
                }else if($rowmnth['Month(`date`)']=='11'){
                    $output2.='<option>November</option>';
                }else{
                    $output2.='<option>December</option>';
                }
                $flag2=false;
            }
        }
        else{
            $rowmnth=mysqli_fetch_assoc($month);
            if($rowmnth['Month(`date`)']=='1'){
                $output2.='<option>January</option>';
            }else if($rowmnth['Month(`date`)']=='2'){
                $output2.='<option>February</option>';
            }else if($rowmnth['Month(`date`)']=='3'){
                $output2.='<option>March</option>';
            }else if($rowmnth['Month(`date`)']=='4'){
                $output2.='<option>April</option>';
            }else if($rowmnth['Month(`date`)']=='5'){
                $output2.='<option>May</option>';
            }else if($rowmnth['Month(`date`)']=='6'){
                $output2.='<option>June</option>';
            }else if($rowmnth['Month(`date`)']=='7'){
                $output2.='<option>July</option>';
            }else if($rowmnth['Month(`date`)']=='8'){
                $output2.='<option>August</option>';
            }else if($rowmnth['Month(`date`)']=='9'){
                $output2.='<option>September</option>';
            }else if($rowmnth['Month(`date`)']=='10'){
                $output2.='<option>October</option>';
            }else if($rowmnth['Month(`date`)']=='11'){
                $output2.='<option>November</option>';
            }else{
                $output2.='<option>December</option>';
            }
            $flag2=true;
        }
		
    }
	$data = array(
	   'output2'  => $output2,
        'flag1' =>$flag1,
        'flag2' =>$flag2
        
	);
	echo json_encode($data);
	mysqli_close($con);
?>