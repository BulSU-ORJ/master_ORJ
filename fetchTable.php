<?php
	include('connect.php');
	$output='';
	$count=1;
	$countUpload=0;
	$update="UPDATE `notif_view` SET `isExpired` = 1 WHERE `isExpired`=0";//get data that status 
	mysqli_query($con, $update);
	$result=mysqli_query($con,"SELECT * FROM `visitedabstract` WHERE `count`!=0 order by `count` DESC");
	
  $output.='<div class="table-responsive">
				<table id="myTable" class="table table-hover " style="cursor:pointer; padding:2px; height:500px;">
					<thead>
						<tr>
							<th class="column text-center" onclick="sortTable(0)" style="width: 6%; ">No.<i class="fa fa-sort"></i></th>
							<th class="column text-center" onclick="sortTable(1)" style="width: 12%">Research No.<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(2)" style="width: 15%">Research Title<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(3)" style="width: 7%">Author<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(4)" style="width: 8%">College<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(5)" style="width: 16%">Agenda<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(6)" style="width: 16%">Date Uploaded<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(7)" style="width: 10%">Total Views<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(8)" style="width: 10%">Viewed By:<i class="fa fa-sort"></i></th>
						</tr>
				</thead>';
	if($result){
		while($row=mysqli_fetch_array($result)){
			$output.='<tr>
						<td id='.'"'.$row["researchNo"].'" onclick="getValue(this.id)" class="text-center">'.$count.'</td>
						<td id='.'"'.$row["researchNo"].'" onclick="getValue(this.id)" class="text-center">'.$row['researchNo'].'</td>
						<td id='.'"'.$row["researchNo"].'" onclick="getValue(this.id)" class="text-center">'.$row['title'].'</td>
						<td id='.'"'.$row["researchNo"].'" onclick="getValue(this.id)" class="text-center">'.$row['author'].'</td>
						<td id='.'"'.$row["researchNo"].'" onclick="getValue(this.id)" class="text-center">'.$row['acronym'].'</td>
						<td id='.'"'.$row["researchNo"].'" onclick="getValue(this.id)" class="text-center">'.$row['agenda'].'</td>
						<td id='.'"'.$row["researchNo"].'" onclick="getValue(this.id)" class="text-center">'.$row['date'].'</td>
						<td id='.'"'.$row["researchNo"].'" onclick="getValue(this.id)" class="text-center">'.$row['count'].'</td>
						<td id='.'"'.$row["researchNo"].'" onclick="getValue(this.id)" class="text-center">'.$row['accountType'].'</td>
					</tr>';
		$count+=1;
		}
		
	}else{
		$output.='<tr> <td>No data to be displayed</td></tr>';
	}
	$output.='</table>
			</div>';
	$upload_query = "SELECT * FROM `upload` WHERE `isExpired`=0";
	$result_upload = mysqli_query($con, $upload_query);
	$countUpload = mysqli_num_rows($result_upload);
	$data = array(
	'output'  => $output,
	'unseen_uploads'  => $countUpload
	);
	echo json_encode($data);
	mysqli_close($con);
?>