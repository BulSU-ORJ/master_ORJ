
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
			function loadYear()
			{
				$.ajax({
					url:"fetchYear.php",
					method:"POST",
					dataType:"json",
					success:function(data)
					{
						$("#tableFetch").html(data.output);
					}
				});
			}
		});
		$(document).on('click', '#radio1', function(){
				$("#category").attr("style", "display: none");
				$(".checkboxes0").attr("style", "display: none");
				$(".checkboxes1").attr("style", "display: none");
				$(".checkboxes2").attr("style", "display: none");
			});
		$(document).on('click', '#radio2', function(){
				$("#category").html("Select Colleges:");
				$("#category").attr("style", "display: block");
				$(".checkboxes0").attr("style", "display: block");
				$(".checkboxes1").attr("style", "display: block");
				$(".checkboxes2").attr("style", "display: block");
				var colleges = ["College of Architecture and Fine Arts-CAFA", "College of Arts and Letters-CAL","College of Business Administration-CBA",
				"College of Criminal Justice Education-CCJE","College of Hospitality and Tourism Management-CHTM","College of Information and Communication Technology-CICT",
				"College of Industrial Technology-CIT","College of Law-CLaw","College of Nursing-CN","College of Engineering-COE",
				"College of Education-COED","College of Science-CS","College of Sports, Exercise and Recreation-CSER","College of Social Sciences and Philosophy-CSSP","Graduate School-GS"];
				for(var i=1;i<=15;i++){
					$("#label"+i).html(colleges[i-1]);
				}
				
			});
		$(document).on('click', '#radio3', function(){
			$("#category").html("Select Agenda:");
			$("#category").attr("style", "display: block");
			$(".checkboxes0").attr("style", "display: block");
			$(".checkboxes1").attr("style", "display: block");
			$(".checkboxes2").attr("style", "display: none");
			var agenda = ["Climate change and Adaptation", "Biodiversity and the Management of the Natural Environment","Food safety and Security",
				"Diagnosis and Prevention of Human Diseases and Health status of vulnerable Groups ","Industry Assistance towards efficient Production and Achieving Global Standards","Cultural Heritage and Conservation",
				"Cultural Heritage and Conservation","Restructuring Society and Understanding Culture towards Inclusive Nation Building","Emerging Technology and Applications to Inclusive Nation Building",
				"Education and the Pedagogy for the Filipino Learners"];
			for(var i=1;i<=9;i++){
				$("#label"+i).html(agenda[i-1]);
			}
		});
		$(document).on('click', '#select0', function(){
			$('input:checkbox').prop('checked', this.checked);
		});
		$(document).on('click', '.chck1', function(){
			var bool=$('input[type=checkbox]').prop('checked');
			if(bool){
				$("#select0").prop("checked", false);
			}
			
		});
		$(document).on('click', '.chck2', function(){
			var bool=$('input[type=checkbox]').prop('checked');
			if(bool){
				$("#select0").prop("checked", false);
			}
			
		});
		$(document).on('click', '#submit',function(e){
       
			 if ($('#radio1').is(':checked')) {
				window.open("viewsPdfUpload.php");
			 }
		});
		
	</script>	
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
          border-radius: 50px;;
            font-size: 80%;
        }

        #myBtn:hover {
          background-color: #555;
        }
        .my-custom-scrollbar {
        position: relative;
        height: 255px;
        overflow: auto;
        }
        .table-wrapper-scroll-y {
        display: block;
        }
		.dropdown-item active{
			background-color:#763435;
			border-color:#763435;
		}
		
		#xClose:hover {
          color: #555;
        }
		.form-check{
			padding:10px;
		}
	</style>
</head>
<body>
    <nav class="navbar nav-tabs navbar-expand-lg navbar-dark" style="background-color: #763435">
        <a class="navbar-brand" href="#">
            <img class="img-fluid d-lg-block d-none" style="height: 85px" src="Icon/header.png">
            <img class="img-fluid d-lg-none" style="height: 49px" src="Icon/header.png">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"> </span>
        </button>
        
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link " href ="adminnew.php" >Dashboard</a>
                </li>
                <li class="nav-item">
					<a class="nav-link " href ="adminnew.php" >Researches</a>
				</li>
                <li class="nav-item ">
                    <a class="nav-link " href ="uploadform.php">Upload Form</a>
                </li>
                <li class="nav-item dropdown active">
				
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                    data-toggle="dropdown" style="background-color: #763435">Notifications
					<span class="badge" id="allCount" style="background-color:red; color:white;"></span></a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown" >
                        <a class="dropdown-item active"  id="dropToggleUpload" href="uploadnew.php" >Upload<span class="badge" id="uploadCount" style="background-color:red; color:white; margin-left:5px; margin-top:-100px;"></span></a>
                        <a class="dropdown-item" href="downloadnew.php">Download<span class="badge sticky-top" id="downloadCount" style="background-color:red; color:white; margin-bottom:50px; margin-left:5px;"></span></a>
						<a class="dropdown-item "  id="dropToggleViews" href="tables.php">Views<span class="badge" id="viewCount" style="background-color:red; color:white; margin-left:5px;"></span></a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                    data-toggle="dropdown" style="background-color: #763435">Manage Account</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown" >
                        <a class="dropdown-item" href="#">Add Account</a>
                        <a class="dropdown-item" href="#">Change Password</a>
                        <a class="dropdown-item" href="logout.php">Log Out</a>
                    </div>
                </li>
            </ul>    
        </div>
    </nav>
	<div class="container-fluid">
        <br>
        <h2 class="text-center">List of Research</h2><br>
				 <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#openMdal"> Generate Report</button>
			</div>
	</div>		
	<!-- Modal -->
	<div class="modal fade " id="openMdal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header"  style="border:none;" id="modalHeader">
					<h5 class="modal-title" id="exampleModalLongTitle">Select Category</h5>
						<button type="button" id="xClose" class="close" data-dismiss="modal" style="font-size:30px; color:dimgray; float:right;">&times;</button>
						
						</button>
				</div>
				<div class="modal-body">
				 <form class="form-container" id="reportForm">
					<div class="form-check form-check-inline" style="margin-left:200px; margin-right:30px;">
						<input class="form-check-input" type="radio" name="exampleRadios" id="radio1" value="option1" checked>
						<label class="form-check-label" for="radio1">
							By Date
						</label>
					</div>
				<div class="form-check form-check-inline" style=" margin-right:20px;">
					<input class="form-check-input" type="radio" name="exampleRadios" id="radio2" value="option2">
					<label class="form-check-label" for="radio2">
						By Colleges
					</label>
				</div>
				<div class="form-check form-check-inline "  style=" margin-right:20px;">
					<input class="form-check-input" type="radio" name="exampleRadios" id="radio3" value="option3" >
					<label class="form-check-label" for="radio3">
						By Agenda
					</label>
				</div>
				</br></br>
				<h5 class="text-center" style="display:none;" id="category"></h5></br>
				<div class="form-check  form-check-inline checkboxes0" style="margin-left:30px; display:none;">
					<input type="checkbox" class="form-check-input " id="select0">
					<label class="form-check-label" for="select0"></label>
				</div>
				<div class="form-check  form-check-inline checkboxes1" style="margin-left:30px; ">
					<input type="checkbox" class="form-check-input chck1" id="select1" disabled>
					<label id="label1" class="form-check-label" for="select1"></label>
				</div>
				<div class="form-check form-check-inline checkboxes1" style="display:none;">
					<input type="checkbox" class="form-check-input chck1" id="select2">
					<label id="label2" class="form-check-label" for="select2"></label>
				</div>
				<div class="form-check form-check-inline checkboxes1" style="display:none;">
					<input type="checkbox" class="form-check-input chck1" id="select3">
					<label  id="label3" class="form-check-label" for="select3"></label>
				</div>
				<div class="form-check  form-check-inline checkboxes1" style="margin-left:30px; display:none;">
					<input type="checkbox" class="form-check-input chck1" id="select4">
					<label  id="label4" class="form-check-label" for="select4"></label>
				</div>
				<div class="form-check form-check-inline checkboxes1" style="display:none;">
					<input type="checkbox" class="form-check-input chck1" id="select5">
					<label  id="label5" class="form-check-label" for="select5"></label>
				</div>
				<div class="form-check form-check-inline checkboxes1" style="display:none;">
					<input type="checkbox" class="form-check-input chck1" id="select6">
					<label  id="label6" class="form-check-label" for="select6"></label>
				</div>
				<div class="form-check  form-check-inline checkboxes1" style="margin-left:30px; display:none;">
					<input type="checkbox" class="form-check-input chck1" id="select7">
					<label  id="label7" class="form-check-label" for="select7"></label>
				</div>
				<div class="form-check form-check-inline checkboxes1" style="display:none;">
					<input type="checkbox" class="form-check-input chck1" id="select8">
					<label  id="label8" class="form-check-label" for="select8"></label>
				</div>
				<div class="form-check form-check-inline checkboxes1" style="display:none;">
					<input type="checkbox" class="form-check-input chck1" id="select9">
					<label  id="label9" class="form-check-label" for="select9 "></label>
				</div>
				<div class="form-check  form-check-inline checkboxes2" style="margin-left:30px; display:none;">
					<input type="checkbox" class="form-check-input chck2" id="select10">
					<label  id="label10" class="form-check-label" for="select10"></label>
				</div>
				<div class="form-check form-check-inline checkboxes2" style="display:none;">
					<input type="checkbox" class="form-check-input chck2 " id="select11">
					<label  id="label11" class="form-check-label" for="select11"></label>
				</div>
				<div class="form-check form-check-inline checkboxes2" style="display:none;">
					<input type="checkbox" class="form-check-input  chck2" id="select12">
					<label  id="label12" class="form-check-label" for="select12"></label>
				</div>
				<div class="form-check  form-check-inline checkboxes2" style="margin-left:30px; display:none;">
					<input type="checkbox" class="form-check-input chck2" id="select13">
					<label  id="label13" class="form-check-label" for="select13"></label>
				</div>
				<div class="form-check form-check-inline checkboxes2" style="display:none;">
					<input type="checkbox" class="form-check-input chck2 " id="select14">
					<label  id="label14" class="form-check-label" for="select14"></label>
				</div>
				<div class="form-check form-check-inline checkboxes2" style="display:none;">
					<input type="checkbox" class="form-check-input chck2" id="select15">
					<label  id="label15" class="form-check-label" for="select15"></label>
				</div>
				<div class="modal-footer" style="border:none;">
					<button type="button" class="btn btn-primary" id="submit">Submit</button>
				</div>
				</form>
			</div>
		</div>
	</div>
		
</body>
</html>