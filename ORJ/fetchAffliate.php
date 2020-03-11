<?php
$data='<h4 class="text mt-4" style="color: #763435">Select Affiliation</h4><br>
         <select class="form-control" id="category" name="category" style="width:250px;">
            <option selected>Select All</option>
            <option> Student</option>
            <option> Faculty</option>
         </select>';
	echo json_encode($data);
?>