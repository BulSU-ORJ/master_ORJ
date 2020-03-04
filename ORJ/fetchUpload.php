<?php
	include('connect.php');
	$output='';
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
						<td id='.'"'.$hash.'" onclick="getValue(this.id)" class="text-center" style="color: black">'.$row['researchNo'].'</td>
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
	$data = array(
	   'output'  => $output
	);
	echo json_encode($data);
	mysqli_close($con);
?>