<?php 
session_start();
include("connect.php");
require_once "authCookieSessionValidate.php";
require_once "Auth.php";

$auth = new Auth();

if(!$isLoggedIn) {
    header("Location: loginSample.php");
}
$count=1;
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
			function load_unseen_notification()
			{
				$.ajax({
					url:"fetchTable.php",
					method:"POST",
					dataType:"json",
					success:function(data)
					{
						$("#tableFetch").html(data.output);
						if(data.unseen_uploads>0){
							$("#uploadCount").html(data.unseen_uploads);
							$("#allCount").html(data.unseen_uploads);
						}
					}
				});
			}
			load_unseen_notification();
			setInterval(function(){
				load_unseen_notification();
			}, 5000);

			$(document).on('click', '.btn', function(){
				window.open("viewsPdf.php");
			});
		});
			
		function getValue(i){
			$.ajax({
				url:"toPdf.php",
				method:"POST",
				data:{i:i},
				dataType:"json",
				success:function(data)
				{
					if(data=="okay"){
						window.open("pdfDisplay.php");
					}
					else{
						alert(data);
					}
				}
			});
				
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
                        <a class="dropdown-item"  id="dropToggleUpload" href="uploadnew.php" >Upload<span class="badge" id="uploadCount" style="background-color:red; color:white; margin-left:5px; margin-top:-100px;"></span></a>
                        <a class="dropdown-item" href="downloadnew.php">Download<span class="badge sticky-top" id="downloadCount" style="background-color:red; color:white; margin-bottom:50px; margin-left:5px;"></span></a>
						<a class="dropdown-item active"  id="dropToggleViews" href="tables.php">Views<span class="badge" id="viewCount" style="background-color:red; color:white; margin-left:5px;"></span></a>
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
			<div id="tableFetch"></div>
			<div id="gpdf">
				 <button type="button" class="btn btn-danger"> Generate Report</button>
			</div>
	</div>	
</body>
</html>	