<?php
session_start();
include('connect.php');
require_once "authCookieSessionValidate.php";
require_once "Auth.php";

$auth = new Auth();

if(!$isLoggedIn) {
    header("Location: loginSample.php");
}
$output='';
$acronyms= array('CAFA','CAL','CBA','CCJE','CHTM','CICT','CIT','CLaw','CN','COE','COED','CS','CSER','CSSP','GS');
foreach($acronyms as $acr){
	$result = mysqli_query($con,"SELECT * FROM `uploaddata` WHERE `acronym`='{$acr}'");
	$counts= mysqli_num_rows($result);
	
	$output.="['".$acr."',".$counts."],";
}

$output1='';
$agenda= array('Climate Change and Adaptation','Biodiversity and the Management of the Natural Environment','Food Safety and Security','Diagnosis and Prevention of Human Diseases and Health Status of Vulnerable Groups','Industry Assistance Towards Efficient Production and Achieving Global Standards','Cultural Heritage and Conservation','Restructuring Society and Understanding Culture Towards Inclusive Nation Building','Emerging Technology and Applications to Inclusive Nation Building','Education and the Pedagogy for the Filipino Learners');
foreach($agenda as $acr){
	$result = mysqli_query($con,"SELECT * FROM `uploaddata` WHERE `agenda`='{$acr}'");
	$counts= mysqli_num_rows($result);
	
	$output1.="['".$acr."',".$counts."],";
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script><!-- jquery CDN -->
    <link rel="stylesheet" href="trytry.css">
	<script type="text/javascript">
		function toDl(id){
            $.ajax({
				url:"toDl.php",
				method:"POST",
				data:{id:id},
				dataType: 'json',
				success:function(response)
                {
                   
					if(response=="okay"){
						window.location.href="downloadto.php";
					}
					else{
						alert(response);
					}
				},
				error:function(xhr,status,error){
					alert(xhr.responseText);
				}
			})
        }
        function details(id){
            var classes= ".details"+id;
            $.ajax({
				url:"formsInfo.php",
				method:"POST",
				data:{id:id},
				dataType: 'json',
				success:function(response){
                    $(classes).html('<h6>File Name: '+response.name+'</h6><h6>File Format: '+response.type+'</h6><h6>File Size: '+response.size+'</h6>');
				},
				error:function(xhr,status,error){
					alert(xhr.responseText);
				}
			})
        }
	</script>
	<style>
		#disabled{
			pointer-events: none;
		}
        #pieChart svg, #donutchart svg {
          background: white;
          border-radius: .5rem;
          padding: .5rem;
          margin: 0 auto;
          box-shadow: 0 2px 1rem rgba(0,0,0,.2);
        }
        .nav-link active #home-tab:active{
            background-color: #f6f6f6;
            color: #763435;
        }
        #nav-home-tab, #nav-profile-tab a{
            font-weight: bold;
        }
        .nav-tabs .nav-item .nav-link {
          background-color: transparent;
          color: #FFF;
        }

        .nav-tabs .nav-item .nav-link.active {
          color: #763435;
            font-weight: bold;
            background-color: white;
        }

        .tab-content {
          border: 1px solid #dee2e6;
          border-top: transparent;
          padding: 15px;
            background-color: white;
        }

        .tab-content .tab-pane {
          background-color: white;
          color: black;
          min-height: 200px;
          height: auto;
        }
	</style>
</head>
<body style="background-color: #f6f6f6;">
    <button id="myBtn">Back To Top</button>
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
            <a class="btn nav-item" href="uploadform.php">UPLOAD FORM</a>
            <div class="dropdown" style="color: white">
                <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-weight: bold">OPTIONS</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" style="color: black" href="userManual.php">Documentation</a>
                    <a class="dropdown-item" style="color: black" href="dlForms.php">Forms</a>
                </div>
            </div>
            <div class="dropdown" style="color: white">
                <button class="btn dropdown-toggle" id="dropdownMenuButton" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">MANAGE ACCOUNT</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" style="color: black" href="#">Add Account</a>
                    <a class="dropdown-item" style="color: black" href="#">Change Password</a>
                    <a class="dropdown-item" style="color: black" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
    <div class="container" style="margin-top: 3%; margin-bottom: 5%">
    <h2 style="margin-bottom: 5%"><strong>Download Forms</strong></h2>
        <div class="row" id="accordion">
            <div class="card" style="width: 80%; margin: 0 auto; float: none; margin-bottom: 2%;">
                <div class="card-body">
                    <div class="card-title"><h4><strong>Application for Research Incentive</strong> </h4></div>
                    <div class="card-footer" style="background-color: #ffffff;">
                        <button id="1" type="button" data-toggle="collapse" href="#collapse1" class="btn btn-dark" style="width: 25%;" onclick="details(this.id)">File Details <i class="fa fa-file-word-o fa-fw"></i></button>
                        <button id="1" type="button" class="btn btn-dark" style="width: 25%;" onclick="toDl(this.id)">Download File <i class="fa fa-download"></i></button>
                        <div id="collapse1" class="collapse" data-parent="#accordion">
                            <div class="card" style="margin-top: 2%">
                                <div class="card-body details1">
                                    <h6>File Name: </h6>
                                    <h6>File Format: </h6>
                                    <h6>File Size: </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="card" style="width: 80%; margin: 0 auto; margin-bottom: 2%;">
                <div class="card-body">
                    <div class="card-title"><h4><strong>Budgetary Requirements (with Sample)</strong> </h4></div>
                    <div class="card-footer" style="background-color: #ffffff;">
                        <button id="2" type="button" data-toggle="collapse" href="#collapse2" class="btn btn-dark" style="width: 25%" onclick="details(this.id)">File Details <i class="fa fa-file-excel-o fa-fw"></i></button>
                        <button id="2" type="button" class="btn btn-dark" style="width: 25%;" onclick="toDl(this.id)">Download File <i class="fa fa-download"></i></button>
                        <div id="collapse2" class="collapse" data-parent="#accordion">
                            <div class="card" style="margin-top: 2%">
                                <div class="card-body details2">
                                    <h6>File Name: </h6>
                                    <h6>File Format: </h6>
                                    <h6>File Size: </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 80%; margin: 0 auto; float: none; margin-bottom: 2%;">
                <div class="card-body">
                    <div class="card-title"><h4><strong>Capsule Proposal Form</strong> </h4></div>
                    <div class="card-footer" style="background-color: #ffffff;">
                        <button id="3" type="button" data-toggle="collapse" href="#collapse3" class="btn btn-dark" style="width: 25%" onclick="details(this.id)">File Details <i class="fa fa-file-word-o fa-fw"></i></button>
                        <button id="3" type="button" class="btn btn-dark" style="width: 25%;" onclick="toDl(this.id)">Download File <i class="fa fa-download"></i></button>
                        <div id="collapse3" class="collapse" data-parent="#accordion">
                            <div class="card" style="margin-top: 2%">
                                <div class="card-body details3">
                                    <h6>File Name: </h6>
                                    <h6>File Format: </h6>
                                    <h6>File Size: </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 80%; margin: 0 auto; float: none; margin-bottom: 2%;">
                <div class="card-body">
                    <div class="card-title"><h4><strong>Completed Research Form</strong> </h4></div>
                    <div class="card-footer" style="background-color: #ffffff;">
                        <button id="4" type="button" data-toggle="collapse" href="#collapse4" class="btn btn-dark" style="width: 25%" onclick="details(this.id)">File Details <i class="fa fa-file-word-o fa-fw"></i></button>
                        <button id="4" type="button" class="btn btn-dark" style="width: 25%;" onclick="toDl(this.id)">Download File <i class="fa fa-download"></i></button>
                        <div id="collapse4" class="collapse" data-parent="#accordion">
                            <div class="card" style="margin-top: 2%">
                                <div class="card-body details4">
                                    <h6>File Name: </h6>
                                    <h6>File Format: </h6>
                                    <h6>File Size: </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
            </div> 
            <div class="card" style="width: 80%; margin: 0 auto; float: none; margin-bottom: 2%;">
                <div class="card-body">
                    <div class="card-title"><h4><strong>Criteria for Evaluation of Research Proposals</strong> </h4></div>
                    <div class="card-footer" style="background-color: #ffffff;">
                        <button id="5" type="button" data-toggle="collapse" href="#collapse5" class="btn btn-dark" style="width: 25%"  onclick="details(this.id)">File Details <i class="fa fa-file-pdf-o fa-fw"></i></button>
                        <button id="5" type="button" class="btn btn-dark" style="width: 25%;" onclick="toDl(this.id)">Download File <i class="fa fa-download"></i></button>
                        <div id="collapse5" class="collapse" data-parent="#accordion">
                            <div class="card" style="margin-top: 2%">
                                <div class="card-body details5">
                                    <h6>File Name: </h6>
                                    <h6>File Format: </h6>
                                    <h6>File Size: </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 80%; margin: 0 auto; float: none; margin-bottom: 2%;">
                <div class="card-body">
                    <div class="card-title"><h4><strong>Full Blown Proposal Format</strong> </h4></div>
                    <div class="card-footer" style="background-color: #ffffff;">
                        <button id="6" type="button" data-toggle="collapse" href="#collapse6" class="btn btn-dark" style="width: 25%" onclick="details(this.id)">File Details <i class="fa fa-file-word-o fa-fw"></i></button>
                        <button id="6" type="button" class="btn btn-dark" style="width: 25%;" onclick="toDl(this.id)">Download File <i class="fa fa-download"></i></button>
                        <div id="collapse6" class="collapse" data-parent="#accordion">
                            <div class="card" style="margin-top: 2%">
                                <div class="card-body details6">
                                    <h6>File Name: </h6>
                                    <h6>File Format: </h6>
                                    <h6>File Size: </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 80%; margin: 0 auto; float: none; margin-bottom: 2%;">
                <div class="card-body">
                    <div class="card-title"><h4><strong>Guidelines for Proposing Researches</strong> </h4></div>
                    <div class="card-footer" style="background-color: #ffffff;">
                        <button id="7" type="button" data-toggle="collapse" href="#collapse7" class="btn btn-dark" style="width: 25%" onclick="details(this.id)">File Details <i class="fa fa-file-pdf-o fa-fw"></i></button>
                        <button id="7" type="button" class="btn btn-dark" style="width: 25%;" onclick="toDl(this.id)">Download File <i class="fa fa-download"></i></button>
                        <div id="collapse7" class="collapse" data-parent="#accordion">
                            <div class="card" style="margin-top: 2%">
                                <div class="card-body details7">
                                    <h6>File Name: </h6>
                                    <h6>File Format: </h6>
                                    <h6>File Size: </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 80%; margin: 0 auto; float: none; margin-bottom: 2%;">
                <div class="card-body">
                    <div class="card-title"><h4><strong>Monitoring Instrument</strong> </h4></div>
                    <div class="card-footer" style="background-color: #ffffff;">
                        <button id="8" type="button" data-toggle="collapse" href="#collapse8" class="btn btn-dark" style="width: 25%" onclick="details(this.id)">File Details <i class="fa fa-file-word-o fa-fw"></i></button>
                        <button id="8" type="button" class="btn btn-dark" style="width: 25%;" onclick="toDl(this.id)">Download File <i class="fa fa-download"></i></button>
                        <div id="collapse8" class="collapse" data-parent="#accordion">
                            <div class="card" style="margin-top: 2%">
                                <div class="card-body details8">
                                    <h6>File Name: </h6>
                                    <h6>File Format: </h6>
                                    <h6>File Size: </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 80%; margin: 0 auto; float: none; margin-bottom: 2%;">
                <div class="card-body">
                    <div class="card-title"><h4><strong>Progress Report</strong> </h4></div>
                    <div class="card-footer" style="background-color: #ffffff;">
                        <button id="9" type="button" data-toggle="collapse" href="#collapse9" class="btn btn-dark" style="width: 25%" onclick="details(this.id)">File Details <i class="fa fa-file-word-o fa-fw"></i></button>
                        <button id="9" type="button" class="btn btn-dark" style="width: 25%;" onclick="toDl(this.id)">Download File <i class="fa fa-download"></i></button>
                        <div id="collapse9" class="collapse" data-parent="#accordion">
                            <div class="card" style="margin-top: 2%">
                                <div class="card-body details9">
                                    <h6>File Name: </h6>
                                    <h6>File Format: </h6>
                                    <h6>File Size: </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card" style="width: 80%; margin: 0 auto; float: none; margin-bottom: 2%;">
                <div class="card-body">
                    <div class="card-title"><h4><strong>Terminal Report</strong> </h4></div>
                    <div class="card-footer" style="background-color: #ffffff;">
                        <button id="10" type="button" data-toggle="collapse" href="#collapse10" class="btn btn-dark" style="width: 25%"  onclick="details(this.id)">File Details <i class="fa fa-file-word-o fa-fw"></i></button>
                        <button id="10" type="button" class="btn btn-dark" style="width: 25%;" onclick="toDl(this.id)">Download File <i class="fa fa-download"></i></button>
                        <div id="collapse10" class="collapse" data-parent="#accordion">
                            <div class="card" style="margin-top: 2%">
                                <div class="card-body details10">
                                    <h6>File Name: </h6>
                                    <h6>File Format: </h6>
                                    <h6>File Size: </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!--Scroll button up-->
<script>
        $(window).scroll(function() {
            if ($(this).scrollTop() >= 50) {
                $('#myBtn').fadeIn(200);
            } else {
                $('#myBtn').fadeOut(200);
            }
        });
        $('#myBtn').click(function() { 
            $('body,html').animate({
                scrollTop : 0
            }, 500);
        });
    </script>
</body>
</html>