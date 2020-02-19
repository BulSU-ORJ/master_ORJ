<?php
	include('connect.php');
	$output='';
	$count=1;
	$result=mysqli_query($con,"SELECT * FROM `uploaddata` ORDER BY `id` DESC");
	$output.='<div class="table-responsive">
				<table id="table" class="table table-hover  table-wrapper-scroll-y my-custom-scrollbar" style="cursor:pointer; padding:2px">
					<thead>
						<tr>
							<th class="column text-center" onclick="sortTable(0)" style="width: 30%">Title<i class="fa fa-sort"></i></th>
							<th class="column text-center" onclick="sortTable(1)" style="width: 15%">Author<i class="fa fa-sort"></i></th>
							<th class="column text-center" onclick="sortTable(2)" style="width: 15%">Date Uploaded<i class="fa fa-sort"></i></th>
							<th class="column text-center" onclick="sortTable(3)" style="width: auto">Agenda<i class="fa fa-sort"></i></th>
							<th class="column text-center" onclick="sortTable(4)" style="width: auto">College<i class="fa fa-sort"></i></th>
						</tr>
				</thead>';
	if($result){
		while($row=mysqli_fetch_array($result)){
            $hash='';
            $hash = password_hash($row["researchNo"], PASSWORD_DEFAULT);
			$output.='<tr>
                <td class=" text-capitalize text-center" id="'.$hash.'" onclick="clickTable(this.id)">'.$row['title'].'</td>
                <td class=" text-capitalize text-center" id="'.$hash.'" onclick="clickTable(this.id)">'.$row['author'].'</td>
                <td class="text-center" id="'.$hash.'" onclick="clickTable(this.id)">'.date('F',strtotime($row['date'])).' '.date('d',strtotime($row['date'])).', '.date('Y',strtotime($row['date'])).'</td>
                <td class="text-center" id="'.$hash.'" onclick="clickTable(this.id)">'.$row['agenda'].'</td>
                <td class="text-center" id="'.$hash.'" onclick="clickTable(this.id)">'.$row['college'].'</td>
            </tr>';
		}
		
	}else{
		$output.='<tr> <td>No data to be displayed</td></tr>';
	}
	$output.='</table>';
	echo json_encode($output);
	mysqli_close($con);
	

?>