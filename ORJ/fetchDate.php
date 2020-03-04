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
         $output2.='
                <div class="row mt-5">
                    <div class="col-sm-6 form-group">
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
                </div>
                <div class="col-sm-6 form-group">
                    <label for="college" id="labelForMnth" style="font-weight:bold;">By Month:</label>
                    <select class="form-control" id="months" name="months" style="width:250px;">
                        <option selected>Select All</option>
                        <option>January</option>
                        <option>February</option>
                        <option>March</option>
                        <option>April</option>
                        <option>May</option>
                        <option>June</option>
                        <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                    </select>
                </div>
                </div>';	
    }
    
	$data = array(
	   'output2'  => $output2
	);
	echo json_encode($data);
	mysqli_close($con);
?>