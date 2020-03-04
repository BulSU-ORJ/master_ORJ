<?php
	include('connect.php');
	$output='';
	$countUpload=0;
    $yearRows='';
    $monthRows='';
    $flag1=false;
	$result=mysqli_query($con,"SELECT DISTINCT `author_category` FROM `uploaddata`");
    if($result){
         $output.='<div class="form-group">
                    <label for="category" style="font-weight:bold;">By Affiliate:</label>
                    <select class="form-control" id="category" name="category" style="width:250px;">
                    ';
        $rowsCount=mysqli_num_rows($result);
        if($rowsCount==1){
            $rows=mysqli_fetch_assoc($result);
            $output.='<option selected>'.$rows['author_category'].'</option>';
            $flag1=true;
            
        }
        else{
            $output.='<option selected>Select All</option>';
            while($rows=mysqli_fetch_array($result)){
                $output.='<option>'.$rows['author_category'].'</option>';
                
            }
            $flag1=false;
        }
        $output.='</select>
                </div>';
		
    }
	$data = array(
	   'output'  => $output,
        'flag1' =>$flag1
        
	);
	echo json_encode($data);
	mysqli_close($con);
?>