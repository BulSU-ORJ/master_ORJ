<?php
    include "connect.php";
	$output='';
	$logo='';
    $hash='';
    $title='';
    $col=array('College of Architecture and Fine Arts (CAFA)','College of Arts and Letters (CAL)','College of Business Administration (CBA)','College of Criminal Justice Education (CCJE)','College of Hospitality and Tourism Management (CHTM)','College of Information and Communications Technology (CICT)','College of Industrial Technology (CIT)','College of Law (CLaw)','College of Nursing (CN)','College of Engineering (COE)','College of Education (COED)','College of Science (CS)','College of Sports, Exercise and Recreation (CSER)','College of Social Sciences and Philosophy (CSSP)','Graduate School (GS)','Satellite Campuses','Bulsu-Bustos Campus','Bulsu-Hagonoy Campus','Bulsu-Meneses Campus','Bulsu-Pulilan Campus','Bulsu-Sarmiento Campus');
    $agd=array('Climate change and Adaptation','Biodiversity and the Management of the Natural Environment','Food safety and Security','Diagnosis and Prevention of Human Diseases and Health status of vulnerable Groups','Industry Assistance towards efficient Production and Achieving Global Standards','Cultural Heritage and Conservation','Restructuring Society and Understanding Culture towards Inclusive Nation Building','Emerging Technology and Applications to Inclusive Nation Building','Education and the Pedagogy for the Filipino Learners');
    
	if(isset($_POST['id'])){
		$hash=$_POST['id'];
        $query = "SELECT * FROM `uploaddata` ORDER BY ID DESC";
        $result = $con->query($query);
        if($result) {
            while($row=mysqli_fetch_array($result)){
                if (password_verify($row['researchNo'], $hash)) {
                    $name=explode(" ",$row['author']);
                    $title=$row['title'];
                    $output="<div class='modal-dialog' role='document'>
                <div class='modal-content' style='padding:0;'>
                  <div class='modal-header' style='background-color:#763435; border-radius:0; padding-left:25px;'>
                    <h5 class='modal-title' style=' color:white; font-weight:bold; margin:0;'>Edit Research</h5>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close' style='font-size:35px; color:white;'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>
                  <div class='modal-body' id='modal-body' style='padding:25px; margin:0;'>
                    <form class='form-container' id='Edit_form' enctype='multipart/form-data'>
				        <div class='form-group row'>
                            <label id='staticRN' style='margin-left:15px;'>Research #: ".$row['researchNo']."</label>
				        </div>
                        <div class='form-group'>
                            <label for='fname' style='margin:0;'>Author's First Name:</label>
                            <input type='text' class='form-control' id='fname' name='fname' value='".$name[0]."' >
                        </div>
                        <div class='form-group'>
                            <label for='lname' style='margin:0;'>Author's Last Name:</label>
                            <input type='text' class='form-control' id='lname' name='lname' value='".$name[1]."' >
                        </div>
                        <div class='form-group'>
                            <label for='email' style='margin:0;'>Author's Email Address:</label>
                            <input type='email' class='form-control' id='email' name='email' value='".$row['email']."' >
                        </div>
                        <p  style='margin:0;'>Author's Affiliation</p>";
                        if($row['author_category']=='student'){
                            $output.="<div class='form-check form-check-inline' style='margin-left:5%; margin-right:25%;'>
                                        <input class='form-check-input' type='radio' name='radio' id='student' value='student' checked>
                                        <label class='form-check-label' for='student' style='margin:0;'>Student</label>
                                    </div>
				                    <div class='form-check form-check-inline'>
                                        <input class='form-check-input' type='radio' name='radio' id='faculty' value='faculty'>
                                        <label class='form-check-label' for='faculty' style='margin:0;'>
                                            Faculty Member
                                        </label>
                                    </div>";
                        }else{
                            $output.="<div class='form-check form-check-inline' style='margin-left:5%; margin-right:25%;'>
                                        <input class='form-check-input' type='radio' name='radio' id='student' value='student'>
                                        <label class='form-check-label' for='student' style='margin:0;'>Student</label>
                                    </div>
				                    <div class='form-check form-check-inline'>
                                        <input class='form-check-input' type='radio' name='radio' id='faculty' value='faculty' checked>
                                        <label class='form-check-label' for='faculty' style='margin:0;'>
                                            Faculty Member
                                        </label>
                                    </div>";
                        }
                    
                        $output.="<div class='form-group'>
                            <label for='agenda'>Research Agenda:</label>
                            <select class='form-control' id='agenda' name='agenda'>
                                <option selected>".$row['agenda']."</option>
                                <option disabled>Select Agenda</option>";
                                foreach($agd as $agnda){
                                    if($agnda!=$row['agenda']){
                                        $output.="<option>".$agnda."</option>";
                                    }
                                }
                                
                            $output.="</select>
                            </div>
                            <div class='form-group'>
                                <label for='college'>College Department:</label>
                                <select class='form-control' id='college' name='college'>
                                    <option selected>".$row['college']." (".$row['acronym'].")"."</option>
                                    <option disabled>Select College</option>";
                                    foreach($col as $college){
                                        if(($college!=$row['college']." (".$row['acronym'])&&($college!="Satellite Campuses")){
                                            $output.="<option>".$college."</option>";
                                        }
                                        if($college=="Satellite Campuses"){
                                            $output.="<option disabled>Satellite Campuses</option>";
                                        }
                                    }
                                    
                            $output.="</select>
                            </div>
                            <div class='form-group'>
                                <label for='uploaded_file'>Full Research PDF:</label>
                                <input type='file' class='form-control-file' id='uploaded_file' 
                                name='uploaded_file' accept='application/pdf'><br>
                            </div>
                            <div class='form-group'>
                                <label for='imgrad_file'>Imgrad Format PDF:</label>
                                <input type='file' class='form-control-file' id='imgrad_file' 
                                name='imgrad_file' accept='application/pdf'><br>
                            </div>
                            <div class='form-group' id='divabstract'>
                                <label for='abstractName'>Abstract:</label>
                                <textarea class='form-control z-depth-1' name='abstractName' id='abstractName' rows='3' placeholder='Paste abstract here...'>".$row['abstract']."</textarea>
                            </div>
                            ";
                        
                        
                    break;
                }
            }
        }
        $output.="
                    </form></div>
                  <div class='modal-footer' style='padding:20px;'>
                      <button id='save' type='button' class='btn btn-dark' onclick='toUpdate(this.id)'>Save Changes</button>
                    <button type='button' class='btn btn-dark' style='width:25%;' id='clear' onclick='toClear()'>Clear</button>
                  </div>
                </div>
              </div>";
    }
    $data=array(
        'output' => $output,
        'title' => $title
    );
	// Return response 
	echo json_encode($data);
?>