<?php 
session_start();

require_once "authCookieSessionValidate.php";
require_once "Auth.php";

$auth = new Auth();

if(!$isLoggedIn) {
    header("Location: loginSample.php");
}

?>

<!DOCTYPE html>
<html>
<head>   
    <link rel="icon" href="Icon/bulsuLogo.png" sizes="16x16" type="image/png"><title>Bulsu Online Research Journal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script><!-- jquery CDN -->
    <link rel="stylesheet" href="trytry.css">
	<script type="text/javascript">
		$(document).ready(function(){
			$('#submit').click(function(){
                $('#submit').attr('disabled',true);
                $('#submit').attr('class','btn btn-dark btn-block');
                $('#gifImg').attr('src','Icon/load2.gif');
                $('#lblGif').html('Please wait...');
				toAdd();
			});
		  function toAdd(){
              var formData=new FormData();
              var fname=$("#fname").val();
              var lname=$("#lname").val();
              var email=$("#email").val();
              var agenda=$("#agenda").val();
              var college=$("#college").val();
              var staticRN=$("#staticRN").val();
              var abstractName=$("#abstractName").val();
              var category='';
                formData.append('uploaded_file',$('#uploaded_file')[0].files[0]);
                formData.append('imgrad_file',$('#imgrad_file')[0].files[0]);
                formData.append('fname',fname);
                formData.append('lname',lname);
				formData.append('staticRN',staticRN);
				formData.append('email',email);
				formData.append('agenda',agenda);
				formData.append('college',college);
				formData.append('abstractName',abstractName);
              if ($('#student').is(':checked')) {
                  category=$("#student").val();
                  formData.append('radio',category);
              }if ($('#faculty').is(':checked')) {
                  category=$("#faculty").val();
                  formData.append('radio',category);
              }
              $.ajax({
				url:"sample.php",
				method:"POST",
				data:formData,
				dataType: 'json',
				contentType:false,
				cache:false,
				processData:false,
				success:function(response){
					if(response.message=="true"){
						fetch_data();
					}else if(response.message==="notPDF"){
                        alert("Please upload only PDF File");
                        document.getElementById("uploaded_file").value="";
                        document.getElementById("imgrad_file").value="";
                        $('#submit').attr('disabled',false);
                        $('#submit').attr('class','btn btn-dark btn-block');
                        $('#submit').css('background-color','#763435');
                        $('#gifImg').attr('src','');
                        $('#lblGif').html('');
                        $('#uploaded_file').focus();
                    }
                    else{
                        alert(response.message);
                        document.getElementById("fname").value="";
                        document.getElementsByTagName("input")[1].focus();
                        document.getElementById("lname").value="";
                        document.getElementById("email").value="";
    					document.getElementById("agenda").selectedIndex =0;
                        document.getElementById("college").selectedIndex =0;
                        document.getElementById("abstractName").value="";
                        document.getElementById("uploaded_file").value="";
                        document.getElementById("imgrad_file").value="";
                        $('#submit').attr('disabled',false);
                        $('#submit').attr('class','btn btn-dark btn-block');
                        $('#submit').css('background-color','#763435');
                        $('#gifImg').attr('src','');
                        $('#lblGif').html('');
                        $('#student').prop('checked',true);
                    }
				},
				error:function(xhr,status,error){
					alert(xhr.responseText);
				}
              })
          }
        });
        
                    
	</script>
	<script>
		function fetch_data(){
			var formData=new FormData();
			var staticRN=$("#staticRN").val();
			formData.append('staticRN',staticRN);
			$.ajax({
				url:"toDisplay.php",
				method:"POST",
				data:formData,
				dataType: 'json',
				contentType:false,
				cache:false,
				processData:false,
				success:function(response){
                        alert("upload Successfully");
                        document.getElementById("staticRN").value="";
                        document.getElementById("staticRN").value=response.message;
                        document.getElementById("fname").value="";
                        document.getElementsByTagName("input")[1].focus();
                        document.getElementById("lname").value="";
                        document.getElementById("email").value="";
                        document.getElementById("agenda").selectedIndex =0;
                        document.getElementById("college").selectedIndex =0;
                        document.getElementById("abstractName").value="";
                        document.getElementById("uploaded_file").value="";
                        document.getElementById("imgrad_file").value="";
                        $('#submit').attr('disabled',false);
                        $('#submit').attr('class','btn btn-dark btn-block');
                        $('#submit').css('background-color','#763435');
                        $('#gifImg').attr('src','');
                        $('#lblGif').html('');
                        $('#student').prop('checked',true);
					
				},
				error:function(xhr,status,error){
					alert(xhr.responseText);
				}
			})
		}
	</script>
    <style>
        #uploadDiv{
            margin:0;
            margin-top:40px;
            padding:40px;
            background-color:#ffffff;
            -webkit-box-shadow:0 3px 4px 4px #777;
            -moz-box-shadow:0 3px 4px 4px #777;
            box-shadow:0 3px 4px 4px #777;
            
        }
        .form-control{
            padding:5px;
        }
        label{
            padding:0;
            margin:0;
        }
        #disabled{
			pointer-events: none;
		}
    </style>
</head>
<body style="background-color: #f6f6f6">
    <nav class="navbar nav-tabs navbar-expand-lg navbar-dark" style="background-color: #763435">
        <a class="navbar-brand" href="#">
            <img class="img-fluid d-lg-block d-none" style="height: 85px" src="Icon/header.png">
            <img class="img-fluid d-lg-none" style="height: 49px" src="Icon/header.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <ul class="navbar-nav mr-auto">
            </ul>
            <a class="btn nav-item" href="adminnew.php">DASHBOARD</a>
            <a class="btn nav-item" href="uploadnew.php">RESEARCHES</a>
            <a class="btn nav-item" style="font-weight: bold" id="disabled" href="uploadform.php">UPLOAD FORM</a>
            <div class="dropdown">
                <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">OPTIONS</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" style="color: black" href="userManual.php">Documentation</a>
                    <a class="dropdown-item" style="color: black" href="dlForms.php">Forms</a>
                </div>
            </div>
            <div class="dropdown" style="color: white">
                <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MANAGE ACCOUNT</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" style="color: black" href="addaccount.php">Add Account</a>
                    <a class="dropdown-item" style="color: black" href="rc_accounts.php">RC Accounts</a>
                    <a class="dropdown-item" style="color: black" href="edit_accountsample.php">Edit Account</a>
                    <a class="dropdown-item" style="color: black" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    
    <div class="container">
        <div class="row justify-content-center" style="padding-bottom:20px;">
            <div class="col-sm-6" id="uploadDiv">
            <div class="form-group" style="text-align: center;">
                <h3 >Upload Form</h3>
            </div>
            <form class="form-container" id="upload_form" enctype="multipart/form-data">
				<div class="form-group row">
					<label for="staticRN" style="margin-left:15px; margin-top:6px;">Research #:</label>
					<div class="col-sm-8">
						<input type="text" readonly class="form-control-plaintext" id="staticRN" style="border:none;" value="<?php $auth->getResearchNo() ?>">
					</div>
				</div>
                <div class="form-group">
					<label for="fname">Author's First Name:</label>
                    <input type="text" class="form-control" id="fname" name="fname" autofocus>
                </div>
                <div class="form-group">
					<label for="lname">Author's Last Name:</label>
                    <input type="text" class="form-control" id="lname" name="lname">
                </div>
                <div class="form-group">
					<label for="email">Author's Email Address:</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <p>Author's Affiliation</p>
                <div class="form-check form-check-inline" style=" margin-left:15%;margin-right:25%;">
						<input class="form-check-input" type="radio" name="radio" id="student" value="student" checked>
						<label class="form-check-label" for="student">
							Student
						</label>
					</div>
				    <div class="form-check form-check-inline">
					   <input class="form-check-input" type="radio" name="radio" id="faculty" value="faculty">
                        <label class="form-check-label" for="faculty">
                            Faculty Member
					   </label>
                     </div>
                <div class="form-group">
                    <label for="agenda">Research Agenda:</label>
                    <select class="form-control" id="agenda" name="agenda">
                        <option selected disabled>Select Agenda</option>
                            <option>Climate change and Adaptation</option>
                            <option>Biodiversity and the Management of the Natural Environment</option>
                            <option>Food safety and Security</option>
                            <option>Diagnosis and Prevention of Human Diseases and Health status of vulnerable Groups </option>
                            <option>Industry Assistance towards efficient Production and Achieving Global Standards</option>
                            <option>Cultural Heritage and Conservation</option>
							<option>Restructuring Society and Understanding Culture towards Inclusive Nation Building</option>
							<option>Emerging Technology and Applications to Inclusive Nation Building</option>
							<option>Education and the Pedagogy for the Filipino Learners</option>
                    </select>
                </div>
				<div class="form-group">
                    <label for="college">College Department:</label>
                    <select class="form-control" id="college" name="college">
                        <option selected disabled>Select College</option>
                            <option>College of Architecture and Fine Arts (CAFA)</option>
                            <option>College of Arts and Letters (CAL)</option>
                            <option>College of Business Administration (CBA)</option>
                            <option>College of Criminal Justice Education (CCJE)</option>
                            <option>College of Hospitality and Tourism Management (CHTM)</option>
                            <option>College of Information and Communications Technology (CICT)</option>
							<option>College of Industrial Technology (CIT)</option>
							<option>College of Law (CLaw)</option>
							<option>College of Nursing (CN)</option>
							<option>College of Engineering (COE)</option>
							<option>College of Education (COED)</option>
							<option>College of Science (CS)</option>
							<option>College of Sports, Exercise and Recreation (CSER)</option>
							<option>College of Social Sciences and Philosophy (CSSP)</option>
							<option>Graduate School (GS)</option>
                            <option disabled>Satellite Campuses</option>
                            <option>Bulsu-Bustos Campus</option>
                            <option>Bulsu-Hagonoy Campus</option>
                            <option>Bulsu-Meneses Campus</option>
                            <option>Bulsu-Sarmiento Campus</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="uploaded_file">Full Research PDF:</label>
                    <input type="file" class="form-control-file" id="uploaded_file" 
                    name="uploaded_file" accept="application/pdf"><br>
                </div>
                <div class="form-group">
                    <label for="imgrad_file">Imgrad Format PDF:</label>
                    <input type="file" class="form-control-file" id="imgrad_file" 
                    name="imgrad_file" accept="application/pdf"><br>
                </div>
				<div class="form-group" id="divabstract">
					<label for="abstractName">Abstract:</label>
					<textarea class="form-control z-depth-1" name="abstractName" id="abstractName" rows="3" placeholder="Paste abstract here..."></textarea>
				</div>
                <button type="button" class="btn btn-dark btn-block" name="submit" id="submit">Upload File</button>
            </form>
                
            </div>
        </div>
    </div>
</body>
</html>