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
	
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			google.charts.load('current', {'packages':['corechart']});
			google.charts.setOnLoadCallback(drawChart);
			google.charts.setOnLoadCallback(drawChart1);
			function drawChart() {
				var data = google.visualization.arrayToDataTable([
					['Colleges', 'number'],
					<?php
						echo $output;
					?>
				]);
				var options = {
					'title': 'Number of Researches per Colleges',
                    titleTextStyle: {
                        color: ('#763435'),
                        fontName: 'Raleway',
                        fontSize: 20,
                        bold: true,
                    },
                    height: 300,
                    width: 535,
                    colors:['#29a8ab','#74546a','#f67e7d','#ff8c61','#247ba0','#ffe066','#6d6875','#5c374c','#4a7c59','#ee2e31','#c9cba3','#3a506b','#9a8c98','#e9c46a','#264653'],
				};
				var chart = new google.visualization.PieChart(document.getElementById('pieChart'));
				chart.draw(data, options);
			}
            
            function drawChart1() {
                var data = google.visualization.arrayToDataTable([
                  ['Agenda', 'number'],
					<?php
						echo $output1;
					?>
                ]);

                var options = {
                    title: 'Number of Researches per Agenda',
                    titleTextStyle: {
                        color: ('#763435'),
                        fontName: 'Raleway',
                        fontSize: 20,
                        bold: true,
                    },
                    titlePosition: 'left',
                    pieHole: 0.4,
                    height: 300,
                    width: 535,
                    colors: ['#e0a899','#8b9dc3','#ff6f69','#ffcc5c','#88d8b0','#c99789','#8b9dc3'],
                };

                var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
                chart.draw(data, options);
              }

		});

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
	</style>
</head>
<body style="background-color: #f6f6f6;">
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
                    <a class="dropdown-item" style="color: black" href="addaccount.php">Add Account</a>
                    <a class="dropdown-item" style="color: black" href="rc_accounts.php">RC Accounts</a>
                    <a class="dropdown-item" style="color: black" href="edit_accountsample.php">Edit Account</a>
                    <a class="dropdown-item" style="color: black" href="logout.php">Log Out</a>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>