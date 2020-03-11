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
                    $output="
                    <div class='row'>
                    <div class='modal-dialog modal-lg' role='document'>
                <div class='modal-content' style='padding:0;'>
                  <div class='modal-header' style='background-color:#763435; border-radius:0;'>
                    <h4 class='modal-title' style=' color:white; font-weight:bold; margin:0;'>Edit Research</h4>
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close' style='font-size:35px; color:white;'>
                      <span aria-hidden='true'>&times;</span>
                    </button>
                  </div>
                  <div class='modal-body' id='modal-body col-sm-12' style='padding:25px; margin:0;'>
                    <form class='form-container' id='Edit_form' enctype='multipart/form-data'>
				        <div class='form-group row'>
                            <label id='staticRN' style='margin-left:15px;'>Research #: ".$row['researchNo']."</label>
				        </div>
                        <div class='row'>
                        <div class='form-group col-sm-6'>
                            <label for='fname' style='margin:0;'>Author's First Name:</label>
                            <input type='text' class='form-control' id='fname' name='fname' value='".$name[0]."' onblur='toCheck2(this.id)'>
                        </div>
                        <div class='form-group col-sm-6'>
                            <label for='lname' style='margin:0;'>Author's Last Name:</label>
                            <input type='text' class='form-control' id='lname' name='lname' value='".$name[1]."' onblur='toCheck2(this.id)'>
                        </div>
                        </div>
                        <div class='form-group'>
                            <label for='email' style='margin:0;'>Author's Email Address:</label>
                            <input type='email' class='form-control' id='email' name='email' value='".$row['email']."' onblur='toCheck2(this.id)'>
                        </div>
                        <p  style='margin:0;'>Author's Affiliation</p>";
                        if($row['author_category']=='student'){
                            $output.="<div class='form-group row text-center'>
                                            <label class='radio-inline col'><input type='radio' id='student' name='radio' value='student' checked> Student</label>
                                            <label class='radio-inline col'><input type='radio' id='faculty' value='faculty' name='radio'> Faculty</label>
                                    </div>";
                        }else{
                            $output.="<div class='form-group row text-center'>
                                            <label class='radio-inline col'><input type='radio' id='student' name='radio' value='student' checked> Student</label>
                                            <label class='radio-inline col'><input type='radio' id='faculty' value='faculty' name='radio'> Faculty</label>
                                    </div>";
                        }
                    
                        $output.="
                        <div class='row'>
                        <div class='form-group col-sm-6'>
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
                            <div class='form-group col-sm-6'>
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
                            </div>
                            <div class='form-group'>
                                <label for='uploaded_file'>Full Research PDF:</label>
                                <input type='file' class='form-control-file' id='uploaded_file' 
                                name='uploaded_file' accept='application/pdf' onchange='toCheck2(this.id)'><br>
                            </div>
                            <div class='form-group'>
                                <label for='imgrad_file'>Imgrad Format PDF:</label>
                                <input type='file' class='form-control-file' id='imgrad_file' 
                                name='imgrad_file' accept='application/pdf' onchange='toCheck2(this.id)'><br>
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
                    <button type='button' class='btn btn-dark' style='width:20%;' id='clear' onclick='toClear()'>Clear</button>
                  </div>
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