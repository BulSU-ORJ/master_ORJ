<?php
class footerHeaderDisplay{
    function headerDisplay() {
		echo '<a class="navbar-brand" href="B-Home.php">
            <img class="img-fluid d-lg-block d-none" style="height: 85px" src="Icon/header.png">
            <img class="img-fluid d-lg-none" style="height: 43px" src="Icon/header.png">
        </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" >
            <ul class="navbar-nav mr-auto">
            </ul>
            <a class="btn nav-item" href="B-Home.php">HOME</a>
            <a class="btn nav-item  active" href="B-Researches.php">RESEARCHES</a>
            <div class="btn-group btn-dropdown mr-2" id="myNav">
              <button type="button" class="btn" id="btndropdown"><a href="B-Agenda.php" style="text-decoration:none">AGENDA</a></button>
              <button type="button" class="btn dropdown-toggle dropdown-toggle-split" id="btndropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
              </button>
              <div class="dropdown-menu dropdown-menu-lg-right">
                <a class="dropdown-item" href="#section1">Climate Change and Adaptation</a>
                <a class="dropdown-item" href="#section2">Biodiversity and the Management of the Natural Environment</a>
                <a class="dropdown-item" href="#section3">Food Safety and Security</a>
                <a class="dropdown-item" href="#section4">Diagnosis and Prevention of Human Diseases and Health Status of Vulnerable Groups</a>
                <a class="dropdown-item" href="#section5">Industry Assistance Towards Efficient Production and Achieving Global Standards</a>
                <a class="dropdown-item" href="#section6">Cultural Heritage and Conservation</a>
                <a class="dropdown-item" href="#section7">Restructuring Society and Understanding Culture Towards Inclusive Nation Building</a>
                <a class="dropdown-item" href="#section8">Emerging Technology and Applications to Inclusive Nation Building</a>
                <a class="dropdown-item" href="#section9">Education and the Pedagogy for the Filipino Learners</a>
              </div>
            </div>
            
            <div class="btn-group btn-dropdown mr-2" id="myNav">
              <button type="button" class="btn" id="btndropdown"><a href="B-Colleges.php" style="text-decoration:none">COLLEGES</a></button>
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
        </div>';
	}
}

?>