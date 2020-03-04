<?php
	include('connect.php');
    $monthRows='';
    $flag2=false;

if(isset($_POST['year'])){
    $val=$_POST['year'];
    if($val!="Select All"){
        $month=mysqli_query($con,"SELECT DISTINCT Month(`date`) FROM `uploaddata` WHERE YEAR(`date`)='{$val}' order by Month(`date`) ASC");
        if($month){
            $mnthCount=mysqli_num_rows($month);
            if($mnthCount>1){
                $monthRows.='<option selected>Select All</option>';
                while($rowmnth=mysqli_fetch_array($month)){
                    if($rowmnth['Month(`date`)']=='1'){
                        $monthRows.='<option>January</option>';
                    }else if($rowmnth['Month(`date`)']=='2'){
                        $monthRows.='<option>February</option>';
                    }else if($rowmnth['Month(`date`)']=='3'){
                        $monthRows.='<option>March</option>';
                    }else if($rowmnth['Month(`date`)']=='4'){
                        $monthRows.='<option>April</option>';
                    }else if($rowmnth['Month(`date`)']=='5'){
                        $monthRows.='<option>May</option>';
                    }else if($rowmnth['Month(`date`)']=='6'){
                        $monthRows.='<option>June</option>';
                    }else if($rowmnth['Month(`date`)']=='7'){
                        $monthRows.='<option>July</option>';
                    }else if($rowmnth['Month(`date`)']=='8'){
                        $monthRows.='<option>August</option>';
                    }else if($rowmnth['Month(`date`)']=='9'){
                        $monthRows.='<option>September</option>';
                    }else if($rowmnth['Month(`date`)']=='10'){
                        $monthRows.='<option>October</option>';
                    }else if($rowmnth['Month(`date`)']=='11'){
                        $monthRows.='<option>November</option>';
                    }else{
                        $monthRows.='<option>December</option>';
                    }
                    $flag2=false;
                }
            }
            else{
                $rowmnth=mysqli_fetch_assoc($month);
                if($rowmnth['Month(`date`)']=='1'){
                    $monthRows.='<option>January</option>';
                }else if($rowmnth['Month(`date`)']=='2'){
                    $monthRows.='<option>February</option>';
                }else if($rowmnth['Month(`date`)']=='3'){
                    $monthRows.='<option>March</option>';
                }else if($rowmnth['Month(`date`)']=='4'){
                    $monthRows.='<option>April</option>';
                }else if($rowmnth['Month(`date`)']=='5'){
                    $monthRows.='<option>May</option>';
                }else if($rowmnth['Month(`date`)']=='6'){
                    $monthRows.='<option>June</option>';
                }else if($rowmnth['Month(`date`)']=='7'){
                    $monthRows.='<option>July</option>';
                }else if($rowmnth['Month(`date`)']=='8'){
                    $monthRows.='<option>August</option>';
                }else if($rowmnth['Month(`date`)']=='9'){
                    $monthRows.='<option>September</option>';
                }else if($rowmnth['Month(`date`)']=='10'){
                    $monthRows.='<option>October</option>';
                }else if($rowmnth['Month(`date`)']=='11'){
                    $monthRows.='<option>November</option>';
                }else{
                    $monthRows.='<option>December</option>';
                }
                $flag2=true;
            }

        }
        
    }else{
        $month=mysqli_query($con,"SELECT DISTINCT Month(`date`) FROM `uploaddata` order by Month(`date`) ASC");
        if($month){
            $mnthCount=mysqli_num_rows($month);
            if($mnthCount>1){
                $monthRows.='<option selected>Select All</option>';
                while($rowmnth=mysqli_fetch_array($month)){
                    if($rowmnth['Month(`date`)']=='1'){
                        $monthRows.='<option>January</option>';
                    }else if($rowmnth['Month(`date`)']=='2'){
                        $monthRows.='<option>February</option>';
                    }else if($rowmnth['Month(`date`)']=='3'){
                        $monthRows.='<option>March</option>';
                    }else if($rowmnth['Month(`date`)']=='4'){
                        $monthRows.='<option>April</option>';
                    }else if($rowmnth['Month(`date`)']=='5'){
                        $monthRows.='<option>May</option>';
                    }else if($rowmnth['Month(`date`)']=='6'){
                        $monthRows.='<option>June</option>';
                    }else if($rowmnth['Month(`date`)']=='7'){
                        $monthRows.='<option>July</option>';
                    }else if($rowmnth['Month(`date`)']=='8'){
                        $monthRows.='<option>August</option>';
                    }else if($rowmnth['Month(`date`)']=='9'){
                        $monthRows.='<option>September</option>';
                    }else if($rowmnth['Month(`date`)']=='10'){
                        $monthRows.='<option>October</option>';
                    }else if($rowmnth['Month(`date`)']=='11'){
                        $monthRows.='<option>November</option>';
                    }else{
                        $monthRows.='<option>December</option>';
                    }
                    $flag2=false;
                }
            }
            else{
                $rowmnth=mysqli_fetch_assoc($month);
                if($rowmnth['Month(`date`)']=='1'){
                    $monthRows.='<option>January</option>';
                }else if($rowmnth['Month(`date`)']=='2'){
                    $monthRows.='<option>February</option>';
                }else if($rowmnth['Month(`date`)']=='3'){
                    $monthRows.='<option>March</option>';
                }else if($rowmnth['Month(`date`)']=='4'){
                    $monthRows.='<option>April</option>';
                }else if($rowmnth['Month(`date`)']=='5'){
                    $monthRows.='<option>May</option>';
                }else if($rowmnth['Month(`date`)']=='6'){
                    $monthRows.='<option>June</option>';
                }else if($rowmnth['Month(`date`)']=='7'){
                    $monthRows.='<option>July</option>';
                }else if($rowmnth['Month(`date`)']=='8'){
                    $monthRows.='<option>August</option>';
                }else if($rowmnth['Month(`date`)']=='9'){
                    $monthRows.='<option>September</option>';
                }else if($rowmnth['Month(`date`)']=='10'){
                    $monthRows.='<option>October</option>';
                }else if($rowmnth['Month(`date`)']=='11'){
                    $monthRows.='<option>November</option>';
                }else{
                    $monthRows.='<option>December</option>';
                }
                $flag2=true;
            }

        }
    }        
}
	$data = array(
        'mnth' =>$monthRows,
        'flag2' =>$flag2
        
	);
	echo json_encode($data);
	mysqli_close($con);
?>