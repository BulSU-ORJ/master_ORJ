<?php
require_once "authDisplay.php";//to Display tables
$auth_Display = new authDisplay();

function filterTable($query){
    $connect = mysqli_connect("localhost", "root", "", "ovpretdb");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}?> 
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
					$('#p10').html('<i class="fa fa-download" style="font-size: 120%;"> Downloads '+arrInfo[6]+'</i>');
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
            <li style="list-style-type:none;"><a class="btn nav-item" href="B-Colleges.php">COLLEGES</a></li>
            <li style="list-style-type:none;"><a class="btn nav-item" href="register.php">REGISTER</a></li>
            <li style="list-style-type:none;"><a class="btn nav-item" href="loginGuest.php">LOGIN</a></li>
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
    </div><hr>
    <div class="container">
       <div class="row">
           <ul class="col" style="list-style-type:none; padding: none; margin: none"><br>
		<?php
			include('connect.php');
			$search=$_POST['search'];
			$query="select * from `uploaddata` where author like '%$search%' or title like '%$search%' or agenda like '%$search%' or college like '%$search%' or acronym like '%$search%' or date like '%$search%'";
            $result =mysqli_query($con,$query);
            if($result){
                $rowcount=mysqli_num_rows($result);
                printf("About %d result found.\n",$rowcount);
			if (mysqli_num_rows($result)==0){
				echo '<li>No results found!</li>';
			}
			else{
			while($row=mysqli_fetch_array($result)){
				?>	
				<li>
                    <div class="container">
                    <div class="card col-md-8" style="border-radius: 5px; padding:3%; margin-bottom:2%; margin-top: 3%" >
                        <a href="<?php echo $row['researchNo']; ?>" id="<?php echo $row['researchNo']; ?>" data-toggle="modal" data-target="#mymodal" onclick="getInfo(this.id)" style="color:black">
                        <h5 class="card-title crop-text-3"><strong>
                        <?php echo $row['title']; ?>
                        </strong></h5>
                        </a>
                        <div class="text-secondary text-capitalize">
                        <?php echo "By " .$row['author']; ?>
                        <div class="text-secondary text-capitalize">
                        <?php echo $row['acronym']?>
                        </div>
				        </div>
                        <p class="card-text crop-text-3" style="text-indent: 50px; color: black; margin-top: 2%">
                        <?php echo $row['abstract'];
                        ?> 
                        </p>
                    </div>
                    </div>
				</li>
				<?php
			}
                ?>
               <div class="container-fluid mt-5">
                    <h6 style="text-align: center; color: black">"End of Results"</h6>
               </div>
           <?php
			}
            }
		?>
		</ul><hr>
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
                        <button type="button" class="col-sm btn btn-dark" style="" onclick="toDl()">Download Full-Text PDF</button>
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
<footer class="page-footer font-small pt-4" style="background-color: dimgray">
    <div class="container-fluid text-md-left" style="padding-top: 2%; color: white">
        <div class="row">
            <div class="col-md-4 mb-md-0 mb-4" style="padding-left: 4%">
                <h6 style="color: black"><b>ABOUT US</b></h6><br>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
            </div>
            <div class="col-md-4 mb-md-0 mb-4 pd-0" style="padding-left: 5%">
                <h6 style="color: black"><b>CONTACT US</b></h6><br>
                <p><i class="fa fa-map-marker"></i>Brgy. Guinhawa, Malolos, Bulacan</p>
                <p><i class="fa fa-envelope"></i><a href="https://bulsu.edu.ph" target="_blank" style="color: white">officeofthepresident@bulsu.edu.ph</a></p>
                <p><i class="fa fa-phone"></i>919-7800</p>
            </div>
            <div class="col-md-4 mb-md-0 mb-4">
                <h6 style="color: black"><b>NAVIGATION</b></h6><br>
                    <div class="row">
                        <div class="col">
                            <a class="nav-link" href="index.php" style="padding-left:0px; color: white"><i class="fa fa-home"></i> HOME</a>
                            <a class="nav-link" href="B-Researches.php" style="padding-left:0px; color: white"><i class="fa fa-book"></i> RESEARCHES</a>
                            <a class="nav-link" href="B-Agenda.php" style="padding-left:0px; color: white"><i class="fa fa-cubes"></i> AGENDA</a>
                        </div>
                        <div class="col">
                            <a class="nav-link" href="B-Colleges.php" style="padding-left:0px; color: white"><i class="fa fa-flag"></i> COLLEGES</a>
                            <a class="nav-link" href="register.php" style="padding-left:0px; color: white"><i class="fa fa-user-plus"></i> REGISTER</a>
                            <a class="nav-link" href="loginGuest.php" style="padding-left:0px; color: white"><i class="fa fa-sign-in"></i> LOGIN</a>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>

