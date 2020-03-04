<?php include 'controllers-authController.php';

    $username = $_SESSION['username'];

?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="Icon/bulsuLogo.png" sizes="16x16" type="image/png"><title>Bulsu Online Research Journal</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
    <link rel="stylesheet" href="trytry.css">
    <style>
    body{
        background:url("Icon/background2.png") center no-repeat;
        background-size: cover;
    }.form-container{
    background: #fff;
    padding: 30px;
    border-radius:10px;
    box-shadow: 0px 0px 10px 0px #000;
    }
    </style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #763435">
        <a class="navbar-brand" href="B-Home.html">
            <img class="img-fluid d-lg-block d-none" style="height: 85px" src="Icon/header.png">
            <img class="img-fluid d-lg-none" style="height: 43px" src="Icon/header.png">
        </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <ul class="navbar-nav mr-auto">
            </ul>
            <a class="btn nav-item" href="B-HomeRegistered.php">HOME</a>
            <a class="btn nav-item  active" href="B-ResearchesRegistered.php">RESEARCHES</a>
            <div class="btn-group btn-dropdown mr-2">
              <button type="button" class="btn" id="btndropdown"><a href="B-AgendaRegistered.php" style="text-decoration:none">AGENDA</a></button>
              <button type="button" class="btn dropdown-toggle dropdown-toggle-split" id="btndropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
              </button>
              <div class="dropdown-menu dropdown-menu-lg-right">
                <a class="dropdown-item" href="#section1" >Climate Change and Adaptation</a>
                <a class="dropdown-item" href="#section2">Biodiversity and the Management of the Natural Environment</a>
                <a class="dropdown-item" href="#section3">Food Safety and Security</a>
                <a class="dropdown-item" href="#section4">Diagnosis and Prevention of HUman Diseases and Health Status of Vulnerable Groups</a>
                <a class="dropdown-item" href="#section5">Indistry Assistance Towards Efficient Production and Achieving Global Statndars</a>
                <a class="dropdown-item" href="#section6">Cultural Heritage and Conservation</a>
                <a class="dropdown-item" href="#section7">Restructuring Society and Understanding Culture Towards Inclusive Nation Building</a>
                <a class="dropdown-item" href="#section8">Emerging Technology and Applications to Inclusive Nation Building</a>
                <a class="dropdown-item" href="#section9">Education and the Pedagogy for the Filipino Learners</a>
              </div>
            </div>
            
            <div class="btn-group btn-dropdown mr-2">
              <button type="button" class="btn" id="btndropdown"><a href="B-CollegesRegistered.php" style="text-decoration:none">COLLEGES</a></button>
              <button type="button" class="btn dropdown-toggle dropdown-toggle-split" id="btndropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
              </button>
              <div class="dropdown-menu dropdown-menu-lg-right">
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
            </div>
            <div class="btn-group btn-dropdown mr-2">
              <button type="button" class="btn" id="btndropdown"><a href="" style="text-decoration:none">Manage Account</a></button>
              <button type="button" class="btn dropdown-toggle dropdown-toggle-split" id="btndropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
              </button>
              <div class="dropdown-menu dropdown-menu-lg-right">
                <a class="dropdown-item" href="changepassGuest.php" >Account Settings</a>
                <a class="dropdown-item" href="logoutGuest.php" >Log Out</a>
              </div>
            </div>
        </div>
  </nav>
    <div class="container-fluid" >
	    		  <div class="col-sm-12" >
                <div class="col-sm-6" style="float: right;">
                  <form class="form-container" method="POST" action="changepassGuest.php" id="changepass">
                    <div class="form-group" style="text-align: center;">
                      <h3>Update Account Here</h3>
                  </div>
                    <?php if (count($errors) > 0): ?>
                    <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                    <li style="width: 100%;">
                        <?php echo $error; ?>
                    </li>
                    <?php endforeach;?>
                    </div>
                    <?php endif;?>
                      <div class="form-group">
                          <label >Old Username:</label>
                          <input type="text" class="form-control form-control-lg" name="username" value="<?php echo $_SESSION['username']?>"disabled>
                          <label >New Username:</label>
                          <input type="text" class="form-control form-control-lg" name="newusername" placeholder="Enter New Username">
                          <label >New Password:</label>
                          <input type="password" class="form-control form-control-lg" name="password1" placeholder="Enter New Password" >
                          <label >Confirm Password:</label>
                          <input type="password" class="form-control form-control-lg" name="Cpassword" placeholder="Enter Confirm Password" >
                      </div>
                      <button type="submit" class="btn btn-lg btn-primary btn-block" name="update-btn">Update</button>
                  </form>
                </div>
        </div>
		</div>
</body>
</html>