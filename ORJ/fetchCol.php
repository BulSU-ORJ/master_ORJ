<?php
    $data='<h4 class="text mt-4" style="color: #763435">Select Colleges</h4><br>
				<div class="form-check " style="margin-left:30px;">
					<input type="checkbox" class="form-check-input " id="select0">
					<label class="form-check-label" for="select0">Select All</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select1">
					<label id="label1" class="form-check-label" for="select1">College of Architecture and Fine Arts (CAFA)</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select2">
					<label id="label2" class="form-check-label" for="select2">College of Arts and Letters (CAL)</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select3">
					<label id="label3" class="form-check-label" for="select3">College of Business Administration (CBA)</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select4">
					<label id="label4" class="form-check-label" for="select4">College of Criminal Justice Education (CCJE)</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select5">
					<label id="label5" class="form-check-label" for="select5">College of Hospitality and Tourism Management (CHTM)</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select6">
					<label id="label6" class="form-check-label" for="select6">College of Information and Communication Technology (CICT)</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select7">
					<label id="label7" class="form-check-label" for="select7">College of Industrial Technology (CIT)</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select8">
					<label id="label8" class="form-check-label" for="select8">College of Law (CLaw)</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select9">
					<label id="label9" class="form-check-label" for="select9 ">College of Nursing (CN)</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select10">
					<label id="label10" class="form-check-label" for="select10">College of Engineering (COE)</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select11">
					<label id="label11" class="form-check-label" for="select11">College of Education (COED)</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select12">
					<label id="label12" class="form-check-label" for="select12">College of Science (CS)</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select13">
					<label id="label13" class="form-check-label" for="select13">College of Sports, Exercise and Recreation (CSER)</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select14">
					<label id="label14" class="form-check-label" for="select14">College of Social Sciences and Philosophy (CSSP)</label>
				</div>
                <div class="form-check" style="margin-left:30px;">
					<input type="checkbox" class="form-check-input chck1" id="select15">
					<label id="label15" class="form-check-label" for="select15">Graduate School (GS)</label>
				</div><br>
                <div class="form-check">
                    <h5 style="font-weight: bold">Satellite Campuses</h5>
				</div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-check" style="margin-left:30px;">
                            <input type="checkbox" class="form-check-input chck1" id="select16">
                            <label id="label16" class="form-check-label" for="select16">Bulsu-Bustos Campus</label>
                        </div>
                        <div class="form-check" style="margin-left:30px;">
                            <input type="checkbox" class="form-check-input chck1" id="select17">
                            <label id="label17" class="form-check-label" for="select17">Bulsu-Hagonoy Campus</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-check" style="margin-left:30px;">
                            <input type="checkbox" class="form-check-input chck1" id="select18">
                            <label id="label18" class="form-check-label" for="select18">Bulsu-Meneses Campus</label>
                        </div>
                        <div class="form-check" style="margin-left:30px;">
                            <input type="checkbox" class="form-check-input chck1" id="select19">
                            <label id="label19" class="form-check-label" for="select19">Bulsu-Sarmiento Campus</label>
                        </div>
                    </div>
                </div>
';
	echo json_encode($data);
?>