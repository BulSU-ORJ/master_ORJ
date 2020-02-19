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
					</tr>';
		}
		
	}else{
		$output.='<tr> <td>No data to be displayed</td></tr>';
	}
	$output.='</table>
			</div>';
   
	$data = array(
	   'output'  => $output
        
	);
	echo json_encode($data);
	mysqli_close($con);
?>