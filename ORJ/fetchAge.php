<?php
    $data='<h4 class="text mt-4" style="color: #763435">Select Agenda</h4><br>
				<div class="form-check " style="margin-left:30px;">
					<input type="checkbox" class="form-check-input " id="select0">
					<label class="form-check-label" for="select0">Select All</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select1">
				    <label id="label1" class="form-check-label" for="select1">Climate change and Adaptation</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select2">
					<label id="label2" class="form-check-label" for="select2">Biodiversity and the Management of the Natural Environment</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select3">
					<label id="label3" class="form-check-label" for="select3">Food safety and Security</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select4">
					<label id="label4" class="form-check-label" for="select4">Diagnosis and Prevention of Human Diseases and Health status of vulnerable Groups</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select5">
					<label id="label5" class="form-check-label" for="select5">Industry Assistance towards efficient Production and Achieving Global Standards</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select6">
					<label id="label6" class="form-check-label" for="select6">Cultural Heritage and Conservation</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select7">
					<label id="label7" class="form-check-label" for="select7">Restructuring Society and Understanding Culture towards Inclusive Nation Building</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select8">
					<label id="label8" class="form-check-label" for="select8">Emerging Technology and Applications to Inclusive Nation Building</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select9">
					<label id="label9" class="form-check-label" for="select9 ">Education and the Pedagogy for the Filipino Learners</label>
				</div>';
	echo json_encode($data);
?>