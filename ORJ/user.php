<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="Icon/bulsuLogo.png" sizes="16x16" type="image/png"><title>Home - Bulsu Online Research Journal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script><!-- jquery CDN -->
	<script type="text/javascript">
		$(document).ready(function(){
		  $.ajax({
              url:"fetchRecent.php",
              method:"POST",
              dataType:"json",
              success:function(data)
              {
                document.getElementById("uploadRow").innerHTML=data.recent;
              }
          });
		});
	</script>
	<script>
		function getInfo(researchNo){
			var rnVar="researchNo="+researchNo;
			$.ajax({
				method:"post",
				dataType: 'json',
				url:"get.php",
				data:rnVar,
				success:function(response){
					var getInfo=response.message;
					var arrInfo=getInfo.split("*");
					$('#p1').html(arrInfo[0]);
					$('#p2').html(arrInfo[1]);
					$('#p5').html(arrInfo[1]);
					$('#p6').html(arrInfo[3]);
					$('#p7').html("Email: "+arrInfo[4]);
					$('#p9').html('<i class="fa fa-eye" style="font-size: 120%">'+'    '+arrInfo[5]+'</i>'+'<i class="fa fa-download" style="font-size: 120%">'+'    '+arrInfo[6]+'</i>');
					$('#p4').html(arrInfo[3]);
					$('#em').html(arrInfo[2]);
					//$('.modal-header').html(response.header);
				},
				error:function(xhr,status,error){
				alert(xhr.responseText);
				}
			});
		}
	</script>
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="trytry.css">
    <style>
        #myBtn {
          display: none;
          position: fixed;
          bottom: 20px;
          right: 30px;
          z-index: 99;
          font-size: 18px;
          border: none;
          outline: none;
          background-color: #763435;
          color: white;
          cursor: pointer;
          padding: 15px;
          border-radius: 50px;
            font-size: 80%; 
            
        }

        #myBtn:hover {
          background-color: #555;
        }
		#xClose:hover {
          color: #555;
        }
        .my-custom-scrollbar {
        position: relative;
        height: 255px;
        overflow: auto;
        }
        .table-wrapper-scroll-y {
        display: block;
        }
		#disabled{
			pointer-events: none;
		}
		.modal-content  {
            -webkit-border-radius: 0px !important;
            -moz-border-radius: 0px !important;
            border-radius: 0px !important; 
        }
        .pkoto{
            font-family: "Times New Roman", Times, serif;   
            
        }
        #modalHeader{
            text-align: center;
            margin: auto;
            margin-top: 61px;
            font-size: 20px;
            
        }
        #p2,#p4{
            text-align: center;
            margin: auto;
        }
        .modal-footer{
            padding-left: 0;
            padding-top: 5px;
            padding-right: 0;   
            padding-bottom: 0;
            margin: 0;
        }
        .modal-body{
            padding-left: 0;
            padding-right: 0;
            margin-left: 61px;
            margin-right: 61px;
        }
        #div3{
            border-top: 2px solid black;
            margin-bottom: 61px;
            align-content: flex-start; 
            padding: 0;
            
        }
        #p5, #p6,#p7,#p8,#p9{
            margin-bottom: 0;
        }
        .modal-content{
            padding:15px;
            padding-bottom: 20px;
        }
    </style>
</head>
<body>
    <button id="myBtn">Back To Top</button>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #763435">
        <a class="navbar-brand" href="B-Home.php">
            <img class="img-fluid d-lg-block d-none" style="height: 85px" src="Icon/header.png">
            <img class="img-fluid d-lg-none" style="height: 43px" src="Icon/header.png">
        </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <ul class="navbar-nav mr-auto">
            </ul>
            <a class="btn nav-item" href="B-Home.php" style="font-weight: bold" id="disabled">HOME</a>
            <a class="btn nav-item  active" href="B-Researches.php">RESEARCHES</a>
            <a class="btn nav-item  active" href="B-Agenda.php">AGENDA</a>
            <a class="btn nav-item  active" href="B-Colleges.php">COLLEGES</a>
            <!--div class="btn-group btn-dropdown mr-2">
              <button type="button" class="btn" id="btndropdown"><a href="B-Agenda.php" style="text-decoration:none">AGENDA</a></button>
              <button type="button" class="btn dropdown-toggle dropdown-toggle-split" id="btndropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
              </button>
              <div class="dropdown-menu dropdown-menu-lg-right">
                <a class="dropdown-item" href="BB-SSH.php">Climate Change and Adaptation</a>
                <a class="dropdown-item" href="BB-BI.php">Biodiversity and the Management of the Natural Environment</a>
                <a class="dropdown-item" href="BB-PAS.php">Food Safety and Security</a>
                <a class="dropdown-item" href="BB-EIT.php">Diagnosis and Prevention of HUman Diseases and Health Status of Vulnerable Groups</a>
                <a class="dropdown-item" href="BB-HSS.php">Indistry Assistance Towards Efficient Production and Achieving Global Statndars</a>
                <a class="dropdown-item" href="BB-Ed.php">Cultural Heritage and Conservation</a>
                <a class="dropdown-item" href="BB-Ed.php">Restructuring Society and Understanding Culture Towards Inclusive Nation Building</a>
                <a class="dropdown-item" href="BB-Ed.php">Emerging Technology and Applications to Inclusive Nation Building</a>
                <a class="dropdown-item" href="BB-Ed.php">Education and the Pedagogy for the Filipino Learners</a>
              </div>
            </div>
            
            <div class="btn-group btn-dropdown mr-2">
              <button type="button" class="btn" id="btndropdown"><a href="B-Colleges.php" style="text-decoration:none">COLLEGES</a></button>
              <button type="button" class="btn dropdown-toggle dropdown-toggle-split" id="btndropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
              </button>
              <div class="dropdown-menu dropdown-menu-lg-right">
                 <a class="dropdown-item" href="BBB-CAFA.php">College of Architecture and Fine Arts (CAFA)</a>
                <a class="dropdown-item" href="BBB-CAL.php">College of Arts and Letters (CAL)</a>
                <a class="dropdown-item" href="BBB-CBA.php">College of Business Administration (CBA)</a>
                <a class="dropdown-item" href="BBB-CCJE.php">College of Criminal Justice Education (CCJE)</a>
                <a class="dropdown-item" href="BBB-CHTM.php">College of Hospitality and Tourism Management (CHTM)</a>
                <a class="dropdown-item" href="BBB-CICT.php">College of Information and Communications Technology (CICT)</a>
                <a class="dropdown-item" href="BBB-CIT.php">College of Industrial Technology (CIT)</a>
                <a class="dropdown-item" href="BBB-CLaw.php">College of Law (CLaw)</a>
                <a class="dropdown-item" href="BBB-CON.php">College of Nursing (CN)</a>
                <a class="dropdown-item" href="BBB-COE.php">College of Engineering (COE)</a>
                <a class="dropdown-item" href="BBB-COED.php">College of Education (COED)</a>
                <a class="dropdown-item" href="BBB-CS.php">College of Science (CS)</a>
                <a class="dropdown-item" href="BBB-CSER.php">College of Sports, Exercise and Recreation (CSER)</a>
                <a class="dropdown-item" href="BBB-CSSP.php">College of Social Sciences and Philosophy (CSSP)</a>
                <a class="dropdown-item" href="BBB-GS.php">Graduate School (GS)</a>
              </div>
            </div-->
        </div>   
    </nav>
    
	<div class="row" style="margin-left: 50px;">
		<?php
			include('conn.php');
			$researchNo=$_GET['researchNo'];
			$query=mysqli_query($conn,"select * from `uploaddata` where researchNo='$researchNo'");
			$row=mysqli_fetch_array($query);
			
			echo '<strong>'.$row['title'].' '.$row['author'].'</strong>';
		?>
		<a href="B-Colleges.php" class="btn btn-primary">Back</a>
	</div>
</body>
</html>