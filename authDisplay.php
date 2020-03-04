<?php
require "DBController.php";
class authDisplay{
    function collegeDisplay($college,$tableNo) {
		$db_handle = new DBController();
	    $query = "Select * from `uploaddata` where `acronym` = ? ORDER BY ID DESC";
	    $result = $db_handle->runQuery($query, 's', array($college));
		if(!empty($result)){
	    echo '<table class="table table-hover" style="cursor:pointer; padding:2px">
				<thead>
                        <tr>
                            <th class="column text-center" onclick="sortTable(0,'.$tableNo.')" style="width: 30%">Title<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(1,'.$tableNo.')" style="width: 15%">Author<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(2,'.$tableNo.')" style="width: 18%">Date Uploaded<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(3,'.$tableNo.')" style="width: 20%">College<i class="fa fa-sort"></i></th>
                            <th class="column text-center" onclick="sortTable(4,'.$tableNo.')" style="width: 20%">Agenda<i class="fa fa-sort"></i></th>
                        </tr>
                    </thead>';
        
		foreach($result as $row){
			$hash = password_hash($row["researchNo"], PASSWORD_DEFAULT);
			echo '<tr>';
			echo    '<td class=" text-capitalize text-center" id="'.$hash.'" onclick="clickTable(this.id)">'.$row['title'].'</td>';
			echo    '<td class=" text-capitalize text-center" id="'.$hash.'" onclick="clickTable(this.id)">'.$row['author'].'</td>';
			echo    '<td class="text-center" id="'.$hash.'" clickTable="getInfo(this.id)">'.date('F',strtotime($row['date'])).' '.date('d',strtotime($row['date'])).', '.date('Y',strtotime($row['date'])).'</td>';
			echo    '<td class=" text-capitalize text-center" id="'.$hash.'" onclick="clickTable(this.id)">'.$row['acronym'].'</td>';
			echo    '<td class=" text-capitalize text-center" id="'.$hash.'" onclick="clickTable(this.id)">'.$row['agenda'].'</td>';
			echo '</tr>';
		}
		echo '</table>';
		}
		else{
			echo "nothing to display";
		}
	}
}

?>