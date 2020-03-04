<?php
	include('connect.php');
	$output='';
    $output2='';
	$countUpload=0;
    $yearRows='';
    $monthRows='';
    $flag1=false;
    $flag2=false;
	$result=mysqli_query($con,"SELECT * FROM `uploaddata` order by `id` DESC");
	
  $output.='<div class="table-responsive">
				<table id="myTable" class="table table-hover table-wrapper-scroll-y my-custom-scrollbar" style="cursor:pointer; padding:2px; height:500px;">
					<thead>
						<tr>
							<th class="column text-center" onclick="sortTable(1)" style="width: 12%">Research No.<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(2)" style="width: 15%">Research Title<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(3)" style="width: 7%">Author<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(4)" style="width: 8%">Email<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(4)" style="width: 8%">College<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(5)" style="width: 16%">Agenda<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(6)" style="width: 16%">Date Uploaded<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(7)" style="width: 16%">Total of Views<i class="fa fa-sort"></i></th>
                            <th class="column text-center" style="width: 5%">Edit</th>
                            <th class="column text-center" style="width: 5%">Delete</th>
						</tr>
				</thead>';
	if($result){
		while($row=mysqli_fetch_array($result)){
            $hash = password_hash($row["researchNo"], PASSWORD_DEFAULT);
			$output.='<tr>
						<td id='.'"'.$hash.'" onclick="getValue(this.id)" class="text-center">'.$row['researchNo'].'</td>
						<td id='.'"'.$hash.'" onclick="getValue(this.id)" class="text-center">'.$row['title'].'</td>
						<td id='.'"'.$hash.'" onclick="getValue(this.id)" class="text-center">'.$row['author'].'</td>
						<td id='.'"'.$hash.'" onclick="getValue(this.id)" class="text-center">'.$row['email'].'</td>
						<td id='.'"'.$hash.'" onclick="getValue(this.id)" class="text-center">'.$row['acronym'].'</td>
						<td id='.'"'.$hash.'" onclick="getValue(this.id)" class="text-center">'.$row['agenda'].'</td>
						<td id='.'"'.$hash.'" onclick="getValue(this.id)" class="text-center">'.$row['date'].'</td>
						<td id='.'"'.$hash.'" onclick="getValue(this.id)" class="text-center">'.$row['viewCount'].'</td>
						<td class="text-center"><button id='.'"'.$hash.'" onclick="toModal(this.id)" class="btn btn-dark"  data-toggle="modal" data-target="#editModal" ><i class="fa fa-edit"></i></button></td>
                        <td class="text-center"><button id='.'"'.$hash.'" onclick="toDel(this.id)" class="btn btn-dark"  data-toggle="modal" data-target="#editModal" ><i class="fa fa-trash"></i></button></td>
					</tr>';
		}
		
	}else{
		$output.='<tr> <td>No data to be displayed</td></tr>';
	}
	$output.='</table>
			</div>';
   
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
	   'output'  => $output,
	   'output2'  => $output2,
        'flag1' =>$flag1,
        'flag2' =>$flag2
        
	);
	echo json_encode($data);
	mysqli_close($con);
?>