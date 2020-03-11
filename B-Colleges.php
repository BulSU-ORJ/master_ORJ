<?php
require_once "authDisplay.php";//to Display tables
$auth_Display = new authDisplay();

function filterTable($query){
    $connect = mysqli_connect("localhost", "root", "", "ovpretdb");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}?> 
<?php 
    session_start();
    if(!empty($_SESSION['username'])){
        header("Location: B-HomeRegistered.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="Icon/bulsuLogo.png" sizes="16x16" type="image/png"><title>Colleges - Bulsu Online Research Journal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" integrity="sha256-LOnFraxKlOhESwdU/dX+K0GArwymUDups0czPWLEg4E=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="trytry.css">
	<script type="text/javascript">
		$(document).ready(function(){	
			$('#search').typeahead({
                    source: function(query, result){
                        $.ajax({
                            url: "action1.php",
                            method: "POST",
                            data:{query:query},
                            dataType:"json",
                            success: function(data){
                                result($.map(data, function(item){
                                    return item;
                                    
                                }));
                            }
                        });
                    },
            autoSelect: false
            });
		});
	</script>
    <script>
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
					$('#p9').html('<i class="fa fa-eye" style="font-size: 120%"> Views '+arrInfo[5]+'</i>');
					$('#p10').html('<i class="fa fa-heart" style="font-size: 120%;"> Like '+arrInfo[6]+'</i>');
					$('#p4').html(arrInfo[3]);
					$('#em').html(arrInfo[2]);
					//$('.modal-header').html(response.header);
				},
				error:function(xhr,status,error){
				alert(xhr.responseText);
				}
			});
		}
        function toDl(){
            window.location.href="register.php";
        }
        function clickTable(n) {
				var id=n;
				$.ajax({
					url:"getValue.php",
					method:"POST",
					data:{id:id},
					dataType: 'json',
					success:function(response){
						if(response.message=="true"){
							window.open("collegesAbstractDisplay.php", "_blank");
						}
						else{
							alert(response.message);
						}
					},
					error:function(xhr,status,error){
						alert(xhr.responseText);
					}
				})
			}
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
        th{
            position: sticky;
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
            padding-top: 2%;
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
            padding-top: 5%;
            
        }
        #p5, #p6,#p7,#p8,#p9{
            margin-bottom: 0;
        }
        .modal-content{
            padding:15px;
            padding-bottom: 20px;
        }
        .searchButton {
            padding: 0;
          width: 40px;
          height: 24px;
          border: 1px solid white;
          background: white;
          text-align: center;
          color: dimgray;
          border-radius: 0 5px 5px 0;
          cursor: pointer;
          font-size: 20px;
        }
    </style>
</head>
<body>
    <button id="myBtn">Back To Top</button>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #763435">
        <a class="navbar-brand" href="B-Home.php">
            <img class="img-fluid d-lg-block d-none" style="height: 75px" src="Icon/header.png">
            <img class="img-fluid d-lg-none" style="height: 43px" src="Icon/header.png">
        </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <ul class="navbar-nav mr-auto">
            </ul>
            <li style="list-style-type:none;"><a class="btn nav-item" href="index.php">HOME</a></li>
            <li style="list-style-type:none;"><a class="btn nav-item" href="B-Researches.php">RESEARCHES</a></li>
            <li style="list-style-type:none;"><a class="btn nav-item" href="B-Agenda.php">AGENDA</a></li>
            <li style="list-style-type:none;"><div class="btn-group btn-dropdown mr-2">
              <button type="button" class="btn" id="btndropdown"><a href="B-Colleges.php" style="text-decoration:none; font-weight: bold">COLLEGES</a></button>
              <button type="button" class="btn dropdown-toggle dropdown-toggle-split" id="btndropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
              </button>
              <div class="dropdown-menu dropdown-menu-right" id="dropdownNav">
                 <a class="dropdown-item" href="#section1">College of Architecture and Fine Arts (CAFA)</a>
                <a class="dropdown-item" href="#section2">College of Arts and Letters (CAL)</a>
                <a class="dropdown-item" href="#section3">College of Business Administration (CBA)</a>
                <a class="dropdown-item" href="#section4">College of Criminal Justice Education (CCJE)</a>
                <a class="dropdown-item" href="#section5">College of Hospitality and Tourism Management (CHTM)</a>
                <a class="dropdown-item" href="#section6">College of Information and Communications Technology (CICT)</a>
                <a class="dropdown-item" href="#section7">College of Industrial Technology (CIT)</a>
                <a class="dropdown-item" href="#section8">College of Law (CLaw)</a>
                <a class="dropdown-item" href="#section9">College of Nursing (CN)</a>
                <a class="dropdown-item" href="#section10">College of Engineering (COE)</a>
                <a class="dropdown-item" href="#section11">College of Education (COED)</a>
                <a class="dropdown-item" href="#section12">College of Science (CS)</a>
                <a class="dropdown-item" href="#section13">College of Sports, Exercise and Recreation (CSER)</a>
                <a class="dropdown-item" href="#section14">College of Social Sciences and Philosophy (CSSP)</a>
                <a class="dropdown-item" href="#section15">Graduate School (GS)</a>
              </div>
            </div></li>
            <li style="list-style-type:none;"><a class="btn nav-item  active" href="register.php">REGISTER</a></li>
            <li style="list-style-type:none;"><a class="btn nav-item  active" href="loginGuest.php">LOGIN</a></li>
        </div>   
    </nav><br>
    <div class="container">
        <form action="details.php" method="post" id="search-form">
            <div class="row">
                <div class="input-group col-md-8 offset-md-2 bg-light p-4 mt-4 rounded">
                    <input class="form-control border-right-0" typeahead-focus-first="false" autocomplete="off" type="text" name="search" id="search" placeholder="Search Here">
                    <span class="input-group-append bg-white border-left-0">
                        <span class="input-group-text bg-transparent">
                                <i class="fa fa-search"></i>
                        </span>
                    </span>
                </div>
            </div>
        </form>
    </div>
    
    <div class="container" style="margin-top: 2%">
        <div id="section1" class="container">
           <h2><img src="Icon/Colleges/CAFA.png" style="width: 10%; padding-right: 1%"><b>College of Architecture and Fine Arts</b></h2>
          <hr>
                <h4>Courses Involved :</h4>
                    <ul>
                        <li>Bachelor of Science in Architecture</li>
                        <li>Bachelor of Landscape Architecture</li>
                        <li>Bachelor of Fine Arts Major in Visual Communication</li>
                    </ul><br>
			<div class="table table-wrapper-scroll-y my-custom-scrollbar" id="tableDiv1" style="display: block; height: 290px; overflow-y: scroll; width: 100%;">
				<?php $auth_Display->collegeDisplay("CAFA",1);?>
			</div>
        </div><br><br><br>
        <div id="section2" class="container">
            <h2><img src="Icon/Colleges/CAL.png" style="width: 10%; padding-right: 1%"><b>College of Arts and Letters</b></h2>
            <hr>
            <h4>Courses Involved :</h4>
                <ul>
                    <li>Bachelor of Arts in Broadcasting</li>
                    <li>Bachelor of Arts in Journalism</li>
                    <li>Bachelor of Performing Arts (Theater Track)</li>
                    <li>Batsilyer ng Sining sa Malikhaing Pagsulat</li>
                </ul><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="tableDiv2" style="display: block; height: 290px; overflow-y: scroll; width: 100%;">
                <?php $auth_Display->collegeDisplay("CAL",2);?>
            </div>
        </div><br><br><br>
        <div id="section3" class="container">
          <h2><img src="Icon/Colleges/CBA.png" style="width: 10%; padding-right: 1%"><b>College of Business Administration</b></h2>
                <hr>
                <h4>Courses Involved :</h4>
                    <ul>
                        <li>Bachelor of Science in Business Administration Major in Business Economics</li>
                        <li>Bachelor of Science in Business Administration Major in Financial Management</li>
                        <li>Bachelor of Science in Business Administration Major in Marketing Management</li>
                        <li>Bachelor of Science in Entrepreneurship</li>
                        <li>Bachelor of Science in Accountancy</li>
                        <li>Bachelor of Science in Accounting Information System</li>
                    </ul><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="tableDiv3" style="display: block; height: 290px; overflow-y: scroll; width: 100%;">
                <?php $auth_Display->collegeDisplay("CBA",3);?>
            </div>
        </div><br><br><br>
        <div id="section4" class="container">
          <h2><img src="Icon/Colleges/CCJE.png" style="width: 10%; padding-right: 1%"><b>College of Criminal Justice Education</b></h2>
                <hr>
                <h4>Courses Involved :</h4>
                    <ul>
                        <li>Bachelor of Arts in Legal Management</li>
                        <li>Bachelor of Science in Criminology</li>
                    </ul><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="tableDiv4" style="display: block; height: 290px; overflow-y: scroll; width: 100%;">
                <?php $auth_Display->collegeDisplay("CCJE",4);?>
            </div>
        </div><br><br><br>
        <div id="section5" class="container">
          <h2><img src="Icon/Colleges/CHTM.png" style="width: 10%; padding-right: 1%"><b>College of Hospitality and Tourism Management</b></h2>
                <hr>
                <h4>Courses Involved :</h4>
                    <ul>
                        <li>Bachelor of Science in Hospitality Management</li>
                        <li>Bachelor of Science in Tourism Management</li>
                    </ul><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="tableDiv5" style="display: block; height: 290px; overflow-y: scroll; width: 100%;">
                <?php $auth_Display->collegeDisplay("CHTM",5);?>
            </div>
        </div><br><br><br>
        <div id="section6" class="container">
          <h2><img src="Icon/Colleges/CICT.png" style="width: 10%; padding-right: 1%"><b>College of Information and Communications Technology</b></h2>
                <hr>
                <h4>Courses Involved :</h4>
                    <ul>
                        <li>Bachelor of Science in Information Technology</li>
                        <li>Bachelor of Library and Information Science</li>
                    </ul><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="tableDiv6" style="display: block; height: 290px; overflow-y: scroll; width: 100%;">
                <?php $auth_Display->collegeDisplay("CICT",6);?>
            </div>
        </div><br><br><br>
        <div id="section7" class="container">
          <h2><img src="Icon/Colleges/CIT.png" style="width: 10%; padding-right: 1%"><b>College of Industrial Technology</b></h2>
                <hr>
                <h4>Courses Involved :</h4>
                    <ul>
                        <li>Bachelor of Industrial Technology major in Automotive</li>
                        <li>Bachelor of Industrial Technology major in Computer</li>
                        <li>Bachelor of Industrial Technology major in Drafting</li>
                        <li>Bachelor of Industrial Technology major in Electrical</li>
                        <li>Bachelor of Industrial Technology major in Electronics</li>
                        <li>Bachelor of Industrial Technology major in Mechanical</li>
                        <li>Certificate in Two-Year Technology major in Foods</li>
                        <li>Certificate in Two-Year Technology major in Welding and Fabrication</li>
                        <li>Certificate in Two-Year Technology major in Heating, Ventilation & Air-Conditioning</li>
                    </ul><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="tableDiv7" style="display: block; height: 290px; overflow-y: scroll; width: 100%;">
                <?php $auth_Display->collegeDisplay("CIT",7);?>
            </div>
        </div><br><br><br>
        <div id="section8" class="container">
          <h2><img src="Icon/Colleges/CLaw.png" style="width: 10% ; padding-right: 1%"><b>College of Law</b></h2>
                <hr>
                <h4>Courses Involved :</h4>
                    <ul>
                        <li>Bachelor of Laws</li>
                        <li>Juris Doctor</li>
                    </ul><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="tableDiv8" style="display: block; height: 290px; overflow-y: scroll; width: 100%;">
                <?php $auth_Display->collegeDisplay("CLaw",8);?>
            </div>
        </div><br><br><br>
        <div id="section9" class="container">
          <h2><img src="Icon/Colleges/CN.png" style="width: 10%; padding-right: 1%"><b>College of Nursing</b></h2>
        <hr>
        <h4>Courses Involved :</h4>
            <ul>
                <li>Bachelor of Science in Nursing</li>
            </ul><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="tableDiv9" style="display: block; height: 290px; overflow-y: scroll; width: 100%;">
                <?php $auth_Display->collegeDisplay("CN",9);?>
            </div>
        </div><br><br><br>
        <div id="section10" class="container">
          <h2><img src="Icon/Colleges/COE.png" style="width: 10%; padding-right: 1%"><b>College of Engineering</b></h2>
                <hr>
                <h4>Academic Units Involved :</h4>
                    <ul id="SSH">
                        <li>Bachelor of Science in Civil Engineering</li>
                        <li>Bachelor of Science in Computer Engineering</li>
                        <li>Bachelor of Science in Electrical Engineering</li>
                        <li>Bachelor of Science in Electronics Engineering</li>
                        <li>Bachelor of Science in Industrial Engineering</li>
                        <li>Bachelor of Science in Manufacturing Engineering</li>
                        <li>Bachelor of Science in Mechanical Engineering</li>
                        <li>Bachelor of Science in Mechatronics Engineering</li>
                    </ul><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="tableDiv10" style="display: block; height: 290px; overflow-y: scroll; width: 100%;">
                <?php $auth_Display->collegeDisplay("COE",10);?>
            </div>
        </div> 
        <br><br><br>
        <div id="section11" class="container">
          <h2><img src="Icon/Colleges/COED.png" style="width: 10%; padding-right: 1%"><b>College of Education</b></h2>
                <hr>
                <h4>Courses Involved :</h4>
                    <ul>
                        <li>Bachelor of Elementary Education</li>
                        <li>Bachelor of Early Childhood Education</li>
                        <li>Bachelor of Secondary Education Major in English minor in Mandarin</li>
                        <li>Bachelor of Secondary Education Major in Filipino</li>
                        <li>Bachelor of Secondary Education Major in Sciences</li>
                        <li>Bachelor of Secondary Education Major in Mathematics</li>
                        <li>Bachelor of Secondary Education Major in Social Studies</li>
                        <li>Bachelor of Secondary Education Major in Values Education</li>
                        <li>Bachelor of Technical Vocational Teacher Education with specialization in Foods and Service Management</li>
                        <li>Bachelor of Technical Vocational Teacher Education with specialization in Garments, Fashion and Design</li>
                        <li>Bachelor of Physical Education</li>
                    </ul><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="tableDiv11" style="display: block; height: 290px; overflow-y: scroll; width: 100%;">
                <?php $auth_Display->collegeDisplay("COED",11);?>
            </div>
        </div><br><br><br>
        <div id="section12" class="container">
          <h2><img src="Icon/Colleges/CS.png" style="width: 10%; padding-right: 1%"><b>College of Science</b></h2>
                <hr>
                <h4>Courses Involved :</h4>
                    <ul>
                        <li>Bachelor of Science in Biology</li>
                        <li>Bachelor of Science in Environmental Science</li>
                        <li>Bachelor of Science in Food Technology</li>
                        <li>Bachelor of Science in Math with Specialization in Computer Science</li>
                        <li>Bachelor of Science in Math with Specialization in Applied Statistics</li>
                        <li>Bachelor of Science in Math with Specialization in Business Applications</li>
                    </ul><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="tableDiv12" style="display: block; height: 290px; overflow-y: scroll; width: 100%;">
                <?php $auth_Display->collegeDisplay("CS",12);?>
            </div>
        </div><br><br><br>
        <div id="section13" class="container">
          <h2><img src="Icon/Colleges/CSER.png" style="width: 10%; padding-right: 1%"><b>College of Sports, Exercise and Recreation</b></h2>
                <hr>
                <h4>Courses Involved :</h4>
                    <ul>
                        <li>Bachelor of Science in Exercise and Sports Sciences with specialization in Fitness and Sports Coaching</li>
                        <li>Bachelor of Science in Exercise and Sports Sciences with specialization in Fitness and Sports Management</li>
                    </ul><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar"  id="tableDiv13" style="display: block; height: 290px; overflow-y: scroll; width: 100%;">
                <?php $auth_Display->collegeDisplay("CSER",13);?>
            </div>
        </div><br><br><br>
        <div id="section14" class="container">
          <h2><img src="Icon/Colleges/CSSP.png" style="width: 10%; padding-right: 1%"><b>College of Social Sciences and Philosophy</b></h2>
                <hr>
                <h4>Courses Involved :</h4>
                    <ul>
                        <li>Bachelor of Public Administration</li>
                        <li>Bachelor of Science in Social Work</li>
                        <li>Bachelor of Science in Psychology</li>
                    </ul><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar"  id="tableDiv14" style="display: block; height: 290px; overflow-y: scroll; width: 100%;">
                <?php $auth_Display->collegeDisplay("CSSP",14);?>
            </div>
        </div><br><br><br>
        <div id="section15" class="container">
          <h2><img src="Icon/Colleges/GS.png" style="width: 10%; padding-right: 1%"><b>Graduate School</b></h2>
                <hr>
                <h4>Courses Involved :</h4>
                    <ul>
                        <li>Doctor of Education</li>
                        <li>Doctor of Philosophy</li>
                        <li>Doctor of Public Administration</li>
                        <li>Master in Physical Education</li>
                        <li>Master in Business Administration</li>
                        <li>Master in Public Administration</li>
                        <li>Master of Arts in Education</li>
                        <li>Master of Engineering Program</li>
                        <li>Master of Industrial Technology Management</li>
                        <li>Master of Science in Civil Engineering</li>
                        <li>Master of Science in Computer Engineering</li>
                        <li>Master of Science in Electronics and Communications Engineering</li>
                        <li>Master of Information Technology</li>
                        <li>Master of Manufacturing Engineering</li>
                    </ul><br>
            <div class="table-wrapper-scroll-y my-custom-scrollbar" id="tableDiv15" style="display: block; height: 290px; overflow-y: scroll; width: 100%;">
                <?php $auth_Display->collegeDisplay("GS",15);?>
            </div>
        </div>
        <div class="modal fade border-0 rounded-0" id="mymodal" role="document">
			<div class="modal-dialog modal-lg" style="width:75%;">
			<!--modal content-->
				<div class="modal-content">
					<div class="modal-header" style="border:none;" id="modalHeader">
                        <p class="h4 pkoto" ><strong id="p1"></strong></p>
					</div>
					<div class="modal-body">
						<div class="form-group" id="div1" style="margin-top:30px;">
							<p class=" text-capitalize pkoto" id="p2" style="font-size: 15px;"></p>
                            <p class="text-center text-capitalize pkoto" id="p4" style=" font-size: 15px;"></p><br>
						</div>
						<div class="form-group" id="div2" style="padding-bottom: 2%">
							<p><strong id="p3" style="font-style:italic;">Abstract:</strong></p>
							<p class="text-justify pkoto" style="text-indent:50px;"><em id="em"></em></p>
						</div>
                        <div class="form-group" id="div3">
							<p class="text-capitalize mr-auto pkoto" id="p5" style=" font-size: 13px; "></p>
                            <p class="text-capitalize mr-auto pkoto" id="p6" style=" font-size: 13px; "></p>
                        <p class="mr-auto pkoto" id="p7" style=" font-size: 13px;"></p>
                        <p class="mr-auto pkoto" id="p8" style="font-size: 13px;"></p>
                        
						</div>
					</div>
					<div class="modal-footer row" style="padding-left:0%">
                        <div class="col-sm-2 text-capitalize pkoto" id="p9" style="font-size: 15px;"></div>
                        <div class="col-sm-6 text-capitalize pkoto" id="p10" style="font-size: 15px; text-align: left"></div>
                        <button type="button" class="col-sm btn btn-dark" style="" onclick="toDl()">View Imrad</button>
					</div>
				</div>
			</div>
		</div>
        <!--sort by table-->
        <script>
            function sortTable(n,id) {
                var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
				var div="tableDiv"+id;
				tableDiv = document.getElementById(div);
				table=tableDiv.getElementsByTagName("table")[0];
                switching = true;
                dir = "asc";
                 while (switching) {
                    switching = false;
                    rows = table.rows;
                    for (i = 1; i < (rows.length - 1); i++) {
                      shouldSwitch = false;
                      x = rows[i].getElementsByTagName("TD")[n];
                      y = rows[i + 1].getElementsByTagName("TD")[n];
                      if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                          shouldSwitch= true;
                          break;
                        }}
                        else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                          shouldSwitch = true;
                          break;
                        }}}
                    if (shouldSwitch) {
                      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                      switching = true;
                      switchcount ++;      
                    } else {
                      if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                      }}}
			}
        </script>
        <!--scrollspy-->
        <script>
            $(document).ready(function(){
              // Add scrollspy to <body>
              $('body').scrollspy({target: ".navbar", offset: 50});   

              // Add smooth scrolling on all links inside the navbar
              $("#navbarSupportedContent a").on('click', function(event) {
                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                  // Prevent default anchor click behavior
                  event.preventDefault();

                  // Store hash
                  var hash = this.hash;

                  // Using jQuery's animate() method to add smooth page scroll
                  // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                  $('html, body').animate({
                    scrollTop: $(hash).offset().top
                  }, 800, function(){

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                  });
                }  // End if
              });
            });
        </script> 
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
        </div>
       <!-- </div>--><br><br><br>
<div class="container-fluid" style="background-color: dimgray;">
        <div class="row" style="padding: 3%">
            <div class="col">
                <div class="container fa-2px">
                    <ul>
                        <h6><b>ABOUT US</b></h6><br>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    </ul>
                </div>
            </div>
            <div class="col">
                <div class="container fa-2px">
                    <ul>
                        <h6><b>CONTACT US</b></h6><br>
                        <p><i class="fa fa-map-marker"></i>Brgy. Guinhawa, Malolos, Bulacan</p>
                        <p><i class="fa fa-envelope"></i><a href="https://bulsu.edu.ph" target="_blank">officeofthepresident@bulsu.edu.ph</a></p>
                        <p><i class="fa fa-phone"></i>919-7800</p>
                    </ul>
                </div>
            </div>
            <div class="col">
                <div class="container">
                    <ul>
                        <h6><b>NAVIGATION</b></h6><br>
                        <div class="row">
                            <div class="col-sm-6">
                                <a class="nav-link" href="B-Home.php" style="padding-left:0px"><i class="fa fa-home"></i> HOME</a>
                                <a class="nav-link" href="B-Researches.php" style="padding-left:0px"><i class="fa fa-book"></i> RESEARCHES</a>
                                <a class="nav-link" href="B-Agenda.php" style="padding-left:0px"><i class="fa fa-cubes"></i> AGENDA</a>
                                <a class="nav-link" href="B-Colleges.php" style="font-weight: bold; padding-left:0px"><i class="fa fa-flag"></i> COLLEGES</a>
                            </div>
                            <div class="col-sm-6">
                                <a class="nav-link" href="register.php"><i class="fa fa-user-plus"></i> REGISTER</a>
                                <a class="nav-link" href="loginGuest.php"><i class="fa fa-sign-in"></i> LOGIN</a>
                            </div>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

