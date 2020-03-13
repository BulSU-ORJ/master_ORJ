<?php
if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    $query = "SELECT * FROM `upload` WHERE CONCAT(`title`, `firstname`, `lastname`, `date`, `agenda`, `college`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
}
 else {
    $query = "SELECT * FROM `upload` ORDER BY `id` DESC";
    $search_result = filterTable($query);
}
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "ovpretdb");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}
?> 
<?php 
    session_start();
    if(!empty($_SESSION['user_id'])){
        $username=$_SESSION['username'];
        $id=$_SESSION['user_id'];
    }else{
        header("Location: index.php");
    }

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="icon" href="Icon/bulsuLogo.png" sizes="16x16" type="image/png"><title>Social Sciences and Humanities - Bulsu Online Research Journal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script><!-- jquery CDN -->
    <link rel="stylesheet" href="trytry.css">
  <script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
             url:"fetchRecent.php",
             method:"POST",
             dataType:"json",
             success:function(data)
             {
                 $("#uploadRow").html(data);
                 load_research();
             }
         });
      function load_research()
      {
          $.ajax({
              url:"loadResearch.php",
              method:"POST",
              dataType:"json",
              success:function(data)
              {
                  $('#tableDiv').html(data);
              }
          });

      }
   });

  </script>
    <script>
        var researchNum='';
    function getInfo(researchNo){
			var rnVar="researchNo="+researchNo;
         researchNum=researchNo;
			$.ajax({
				method:"post",
				dataType: 'json',
				url:"get.php",
				data:rnVar,
				success:function(response){
					var getInfo=response.message;
					var arrInfo=getInfo.split("*");
					var p="#"+arrInfo[6];
					$('#p1').html(arrInfo[0]);
					$('#p2').html(arrInfo[1]);
					$('#p5').html(arrInfo[1]);
					$('#p6').html(arrInfo[3]);
					$('#p7').html("Email: "+arrInfo[4]);
					$('#p9').html('<i class="fa fa-eye" style="font-size: 120%"> Views '+arrInfo[5]+'</i>');
					$(p).html('<i class="fa fa-eye" style="font-size: 110%"></i>Views '+arrInfo[5]);
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
        
      var i=researchNum;
      $.ajax({
			url:"toPdf.php",
            method:"POST",
            data:{i:i},
            dataType:"json",
            success:function(data)
            {
                if(data=="okay"){
                    window.open("viewFullPDF.php");
                }
                else{
                    alert(data);
                }
            }
			});
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
							window.open("researchesAbstractDisplay.php", "_blank");
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
        #tableDiv .table {
          display: block;
          height: 500px;
          overflow-y: scroll;
        width: 100%;
        }
    </style>
</head>
<body>
    <button id="myBtn">Back To Top</button>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #763435">
        <a class="navbar-brand" href="B-Home.html">
            <img class="img-fluid d-lg-block d-none" style="height: 85px" src="Icon/header.png">
            <img class="img-fluid d-lg-none" style="height: 43px" src="Icon/header.png">
        </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" data-hover="dropdown" data-animations="fadeInDown" id="navbarSupportedContent" >
            <ul class="navbar-nav mr-auto">
            </ul>
            <a class="btn nav-item" href="B-HomeRegistered.php">HOME</a>
            <a class="btn nav-item  active" href="B-ResearchesRegistered.php"  style="font-weight: bold" id="disabled">RESEARCHES</a>
            <a class="btn nav-item" href="B-AgendaRegistered.php">AGENDA</a>
            <a class="btn nav-item" href="B-CollegesRegistered.php">COLLEGES</a>
            <div class="btn-group btn-dropdown mr-2">
              <button type="button" class="btn" id="btndropdown"><a href="" style="text-decoration:none">Manage Account</a></button>
              <button type="button" class="btn dropdown-toggle dropdown-toggle-split" id="btndropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
              </button>
              <div class="dropdown-menu dropdown-menu-lg-right">
                <a class="dropdown-item" href="edit_accountGuest.php" style="color:black">Account Settings</a>
                <a class="dropdown-item" href="logout1.php" style="color:black">Log Out</a>
              </div>
            </div>
        </div>   
    </nav>
    <br>  
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 bg-light p-4 mt-3 rounded">
                    <form action="details.php" method="post" class="form-inline p-3">
                        <input type="text" name="search" id="search" class="form-control form-control-lg rounded-0 " placeholder="Search Here" style="width:80%;">
                        <input type="submit" name="search" value="Search" class="btn btn-dark btn-lg rounded-0" style="width:20%;">
                    </form>
                </div>
                <div class="col-md-5" style="position: relative; margin-top:-38px; margin-left:215px;">
                </div>
            </div>
        </div>
        <div class="container-fluid">
        <br>
        <hr>
        <h2>List of Research</h2><br>
    <div class="table" id="tableDiv"></div>
        <script type="text/javascript"> 
            $(document).ready(function() {
            $('#search').off('keyup');
            $('#search').on('keyup', function() {
                // Your search term, the value of the input
                var searchTerm = $('#search').val();
                // table rows, array
                var tr = [];

                // Loop through all TD elements
                $('#table').find('td').each(function() {
                    var value = $(this).html();
                    // if value contains searchterm, add these rows to the array
                    if (value.toLowerCase().includes(searchTerm.toLowerCase())) {
                        tr.push($(this).closest('tr'));

                    }
                });

                // If search is empty, show all rows
                if ( searchTerm == '') {
                    $('tr').show();
                } else {
                    // Else, hide all rows except those added to the array
                    $('tr').not('thead tr').hide();
                    tr.forEach(function(el) {
                        el.show();
                    });
                }
            });
        });
    </script>
    </div>
    <script>
        function sortTable(n) {
          var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
          table = document.getElementById("table");
          switching = true;
          //Set the sorting direction to ascending:
          dir = "asc"; 
          /*Make a loop that will continue until
          no switching has been done:*/
          while (switching) {
            //start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /*Loop through all table rows (except the
            first, which contains table headers):*/
            for (i = 1; i < (rows.length - 1); i++) {
              //start by saying there should be no switching:
              shouldSwitch = false;
              /*Get the two elements you want to compare,
              one from current row and one from the next:*/
              x = rows[i].getElementsByTagName("TD")[n];
              y = rows[i + 1].getElementsByTagName("TD")[n];
              /*check if the two rows should switch place,
              based on the direction, asc or desc:*/
              if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                  //if so, mark as a switch and break the loop:
                  shouldSwitch= true;
                  break;
                }
              } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                  //if so, mark as a switch and break the loop:
                  shouldSwitch = true;
                  break;
                }
              }
            }
            if (shouldSwitch) {
              /*If a switch has been marked, make the switch
              and mark that a switch has been done:*/
              rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
              switching = true;
              //Each time a switch is done, increase this count by 1:
              switchcount ++;      
            } else {
              /*If no switching has been done AND the direction is "asc",
              set the direction to "desc" and run the while loop again.*/
              if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
              }
            }
          }
        }
        </script>
        </div>
        <div class="container">
        <br><br><br>
            <h2>Recent Uploads</h2><br>
        <div class="row" id="uploadRow"></div>
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
                        <button type="button" class="col-sm btn btn-dark" style="" onclick="toDl()">Download Full-Text PDF</button>
					</div>
				</div>
			</div>
		</div>
                <br><br><br>
                <h2>Most Downloaded</h2><br>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card shadow mb-2 bg-white rounded" style="width: 18rem">
                          <div class="card-body">
                            <h5 class="card-title">"How Music Affects Early Childhood Development"</h5>
                              <div class="text-secondary">by Christian Austria</div>
                              <div class="text-secondary">September 6, 2019</div><br>
                            <a href="#" class="btn btn-dark">View Details >></a>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card shadow mb-2 bg-white rounded" style="width: 18rem">
                          <div class="card-body">
                            <h5 class="card-title">"Peace Studies: Nonviolence in Action"</h5>
                                <div class="text-secondary">by Monica Colitoy</div>
                                <div class="text-secondary">September 5, 2019</div><br>
                            <a href="#" class="btn btn-dark">View Details >></a>
                          </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card shadow mb-2 bg-white rounded" style="width: 18rem">
                          <div class="card-body">
                            <h5 class="card-title">"Environmental Philosophy"</h5>
                               <div class="text-secondary">by Louise Fajardo</div>
                              <div class="text-secondary">September 4, 2019</div><br>
                            <a href="#" class="btn btn-dark">View Details >></a>
                          </div>
                        </div>
                    </div>
                </div>
        </div>
    <br><br><br>
    <div class="container-fluid" style="background-color: #F7F7F7">
    <div class="container" style="margin-top: 2%; margin-bottom: 2%; background-color: #F7F7F7">
            <h1 style="text-align: center; padding-top:2%">Research Agenda</h1><br>
            <div id="thumbnail" class="row">
                <div id="thumbnailCont" class="col-sm-4">
                    <img class="img-thumbnail rounded-circle" style="width: 120px; height: 120px; border: 1px solid #763435" src="Icon/climatechange.png">
                    <h5><a href="B-Agenda.php#section1" target="_blank">Climate Change and Adaptation</a></h5>
                </div>
                <br>
                <div id="thumbnailCont" class="col-sm-4">
                    <img class="img-thumbnail rounded-circle" style="width: 120px; height: 120px; border: 1px solid #763435" src="Icon/biodiversity.png">
                    <h5><a href="B-Agenda.php#section2" target="_blank">Biodiversity and the Management of the Natural Environment</a></h5>
                </div>
                <br>
                <div id="thumbnailCont" class="col-sm-4">
                    <img class="img-thumbnail rounded-circle" style="width: 120px; height: 120px; border: 1px solid #763435" src="Icon/food&safety.png">
                    <h5><a href="B-Agenda.php#section3" target="_blank">Food Safety and Security</a></h5>
                </div>
                <br>
                <div id="thumbnailCont" class="col-sm-4">
                    <img class="img-thumbnail rounded-circle" style="width: 120px; height: 120px; border: 1px solid #763435" src="Icon/healthStatus.png">
                    <h5><a href="B-Agenda.php#section4" target="_blank">Diagnosis and Prevention of Human Diseases and Health Status of Vulnerable Groups</a></h5>
                </div>
                <br>
                <div id="thumbnailCont" class="col-sm-4">
                    <img class="img-thumbnail rounded-circle" style="width: 120px; height: 120px; border: 1px solid #763435" src="Icon/industryGlobalStandards.png">
                    <h5><a href="B-Agenda.php#section5" target="_blank">Industry Assistance Towards Efficient Production and Achieving Global Standards</a></h5>
                </div>
                <br>
                <div id="thumbnailCont" class="col-sm-4">
                    <img class="img-thumbnail rounded-circle" style="width: 120px; height: 120px; border: 1px solid #763435" src="Icon/culturalHeritage.png">
                    <h5><a href="B-Agenda.php#section6" target="_blank">Cultural Heritage and Conservation</a></h5>
                </div>
        <br>
                <div id="thumbnailCont" class="col-sm-4">
                    <img class="img-thumbnail rounded-circle" style="width: 120px; height: 120px; border: 1px solid #763435" src="Icon/restructuringSociety.png">
                    <h5><a href="B-Agenda.php#section7" target="_blank">Restructuring Society and Understanding Culture Towards Inclusive Nation Building</a></h5>
                </div>
        <br>
        <div id="thumbnailCont" class="col-sm-4">
                    <img class="img-thumbnail rounded-circle" style="width: 120px; height: 120px; border: 1px solid #763435" src="Icon/technology.png">
                    <h5><a href="B-Agenda.php#section8" target="_blank">Emerging Technology and Applications to Inclusive Nation Building</a></h5>
                </div>
        <br>
        <div id="thumbnailCont" class="col-sm-4">
                    <img class="img-thumbnail rounded-circle" style="width: 120px; height: 120px; border: 1px solid #763435" src="Icon/pedagogy.png">
                    <h5><a href="B-Agenda.php#section9" target="_blank">Education and the Pedagogy for the Filipino Learners</a></h5>
                </div>
            </div>
    </div>
</div>
        <!--scrollspy-->
        <script>
        $('body').scrollspy({target: ".navbar", offset: 50});
        $("#navbarSupportedContent a").on('click', function(event) {
          if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
              scrollTop: $(hash).offset().top
            }, 800, function(){
              window.location.hash = hash;
            });}});
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
    <div class="container-fluid" style="background-color: dimgray;">
        <div class="row" style=" padding: 3%">
            <div class="col-sm-4">
                <div class="container fa-2px">
                    <ul>
                        <h6><b>ABOUT US</b></h6><br>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="container fa-2px">
                    <ul>
                        <h6><b>CONTACT US</b></h6><br>
                        <p><i class="fa fa-map-marker"></i>Brgy. Guinhawa, Malolos, Bulacan</p>
                        <p><i class="fa fa-envelope"></i><a href="https://bulsu.edu.ph" target="_blank">officeofthepresident@bulsu.edu.ph</a></p>
                        <p><i class="fa fa-phone"></i>919-7800</p>
                    </ul>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="container">
                    <ul>
                        <h6><b>NAVIGATION</b></h6><br>
                        <a class="nav-link" href="B-Home.php"><i class="fa fa-home"></i>HOME</a>
                        <a class="nav-link" href="B-Researches.php" style="font-weight: bold"><i class="fa fa-book"></i>RESEARCHES</a>
                        <a class="nav-link" href="B-Agenda.php"><i class="fa fa-cubes"></i>AGENDA</a>
                        <a class="nav-link" href="B-Colleges.php"><i class="fa fa-flag"></i>COLLEGES</a>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
