<?php
require "connect.php";
require_once "Util.php";
$util = new Util();
session_start();
if(!empty($_SESSION["random_id"])){
	$result = mysqli_query($con,"SELECT * FROM `uploaddata`");
	if (mysqli_num_rows($result)>0) {
		while($row=mysqli_fetch_array($result)){
            if(password_verify($row['researchNo'],$_SESSION["random_id"])){//to check if verified
                //$_SESSION["random_id"]="";
                $title=$row['title'];
                $adate=$row['date'];
                $college=$row['college'];
                $acr=$row['acronym'];
                $author = $row['author'];
                $abstract= $row['abstract'];
                $email= $row['email'];
                break;
            }
        }
	}
}
else{
	$util->redirect("B-researches.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="icon" href="Icon/bulsuLogo.png" sizes="16x16" type="image/png"><title><?php echo $title;?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="trytry.css">
    <script>
        function toComment(){
            var click=$("#message").val();
		  $.ajax({
              url:"getComments.php",
              method:"POST",
              data:{click:click},
              dataType:"json",
              success:function(data)
              {
                alert("Successful comment");
                document.getElementById("message").value="";
                $("#comments").html("<hr>"+ data.count+"</br>"+data.output);
              },
              error:function(xhr,status,error){
				alert(xhr.responseText);
				}
          });
        }
        function toLikes(id){
            $.ajax({
              url:"toReacts.php",
              method:"POST",
              data:{id:id},
              dataType:"json",
              success:function(data)
              {
                $("#comments").html("<hr>"+ data.count+"</br>"+data.output);
                  
              },
              error:function(xhr,status,error){
				alert(xhr.responseText);
				}
          });
        }
        function readMore(n){
        var arr=n.split("*");
          if ($('#'+arr[0]).css('display')=== "none") {
            $("#"+arr[0]).css("display", "inline");
            $("#"+arr[1]).css("display", "none");
            document.getElementById(n).innerHTML="Read more";
              
          } else{
              $("#"+arr[0]).css("display", "none");
              $("#"+arr[1]).css("display", "inline");
            document.getElementById(n).innerHTML="Read less";
          }
        }
    </script>
    <style>
        #p2,#p4{
            text-align: center;
            margin: auto;
        }
        #p5, #p6,#p7,#p8,#p9{
            margin-bottom: 0;
        }
        .card{
            font-family: "Times New Roman", Times, serif; 
            width: 21cm;
            min-height: 29.7cm;
            padding: 2cm;
            margin: 1cm auto;
        }
        /*footer*/
        #div3{
            border-top: 2px solid black;
            margin-bottom: 0;
            align-content: flex-end; 
            padding: 0;
            padding-top: 5%;
            
        }
        .card-footer{
            background-color: transparent;
            border: none;
            margin-bottom: none;
            padding-top: auto;
        }
        .thumbnail{
            background-color: white;
        }
        @media (max-width: 978px) {
            .container {
              padding:5%;
              margin:0;
            }

            .card{
                padding: 2px;
            }
            #div0 p{
                font-size: 18px;
            }
            .thumbnail img{
                height: 10%;
                width: 10%;
            }
            
        }
    </style>
    <style>
       /* CSS Test begin */
.comment-box {
    margin-top: 30px !important;
}
/* CSS Test end */

.comment-box img {
    margin:none;
    width: 65px;
    height: 65px;
}
.comment-box .thumbnail{
    margin-right: 3%;
    border: 1px solid #ddd;
    padding: 4px;
    
}
.comment-box .caption{
    padding: 2px;
    word-wrap: break-word;
    font-size: 13px;
    text-align: center;
    font-weight: bold;
}
.comment-box .media-body p {
    padding: 10px;
    font-size: 14px;
}
.comment-box .media-body .media p {
    margin-bottom: 0;
    
}
.comment-box .media-heading {
    background-color: white;
    border: 1px solid #ddd;
    padding: 7px 10px;
    position: relative;
    margin-bottom: -1px;
}
.comment-box .media-heading:before {
    content: "";
    width: 12px;
    height: 12px;
    background-color: white;
    border: 1px solid #ddd;
    border-width: 1px 0 0 1px;
    -webkit-transform: rotate(-45deg);
    transform: rotate(-45deg);
    position: absolute;
    top: 10px;
    left: -6px;
    
}
.comment-box .media-body #reply{
    font-size: 12px;
}
#message{
    height: 100px;
        }
.media-body {
  font-size: 1rem;
  line-height: 1.5;
}
</style>
</head>
<body style="background-color: #f6f6f6">
    <button id="myBtn">Back To Top</button>
    <?php 
        if(!empty($_SESSION['username'])){
            echo '<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #763435">
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
            <a class="btn nav-item  active" href="B-ResearchesRegistered.php" style="font-weight: bold" id="disabled">RESEARCHES</a>
            <a class="btn nav-item" href="B-AgendaRegistered.php">AGENDA</a>
            <a class="btn nav-item" href="B-CollegesRegistered.php">COLLEGES</a>
            <div class="btn-group btn-dropdown mr-2">
              <button type="button" class="btn" id="btndropdown"><a href="" style="text-decoration:none">Manage Account</a></button>
              <button type="button" class="btn dropdown-toggle dropdown-toggle-split" id="btndropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
              </button>
              <div class="dropdown-menu dropdown-menu-lg-right">
                <a class="dropdown-item" href="changepassGuest.php" style="color:black">Account Settings</a>
                <a class="dropdown-item" href="logout1.php" style="color:black">Log Out</a>
              </div>
            </div>
        </div>   
    </nav>';
        }else{
            echo '<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #763435">
        <a class="navbar-brand" href="B-Home.php">
            <img class="img-fluid d-lg-block d-none" style="height: 75px" src="Icon/header.png">
            <img class="img-fluid d-lg-none" style="height: 43px" src="Icon/header.png">
        </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
        <div class="collapse navbar-collapse" data-hover="dropdown" data-animations="fadeInDown" id="navbarSupportedContent" >
            <ul class="navbar-nav mr-auto">
            </ul>
            <li style="list-style-type:none;"><a class="btn nav-item" href="B-Home.php">HOME</a></li>
            <li style="list-style-type:none;"><a class="btn nav-item" href="B-Researches.php" style="font-weight: bold" id="disabled">RESEARCHES</a></li>
            <li style="list-style-type:none;"><a class="btn nav-item" href="B-Agenda.php">AGENDA</a></li>
            <li style="list-style-type:none;"><a class="btn nav-item" href="B-Colleges.php">COLLEGES</a></li>
            <li style="list-style-type:none;"><a class="btn nav-item" href="register.php">REGISTER</a></li>
            <li style="list-style-type:none;"><a class="btn nav-item" href="loginGuest.php">LOGIN</a></li>
        </div>   
    </nav>';
        }
    ?>
    
    <br>  
 <br><br>
 <div class="container">
     <div class="card shadow col"  style="background-color: white ; border: none;">
					<div class="card-body col">
						<div class="form-group" id="div0">
                            <p class="h4 pkoto text-center text-capitalize" id="p1" style="font-weight:bold;"><?php echo $title;?></p>
						</div>
                        <div class="form-group" id="div1" style="margin-top:30px;">
							<p class=" text-capitalize pkoto" id="p2" style="font-size: 15px;"><?php echo $author;?></p>
                            <p class="text-center text-capitalize pkoto" id="p4" style=" font-size: 15px;"><?php echo $college;?></p><br>
						</div>
						<div class="form-group mt-5" id="div2" style="padding-bottom: 2%">
							<p class="text-center"><strong id="p3" style="font-style:bold;">ABSTRACT</strong></p>
							<p class="text-justify pkoto" style="text-indent:50px; line-height: 200%"><em id="em"><?php echo $abstract;?></em></p>
						</div>
					</div>
                    <div class="card-footer">
                        <div class="form-group" id="div3">
                            <p class="text-capitalize mr-auto pkoto" id="p5" style=" font-size: 13px; "><?php echo $author;?></p>
                            <p class="text-capitalize mr-auto pkoto" id="p6" style=" font-size: 13px; "><?php echo $college;?></p>
                            <p class="mr-auto pkoto" id="p7" style=" font-size: 13px;"><?php echo $email;?></p>
                            <p class="mr-auto pkoto" id="p8" style="font-size: 13px;"></p>
                        </div>
                    </div>
     </div><br><br><br>
 </div>
    
<div class="container">
        <h3  class="media-header">New Comment</h3><hr>
        <div class="media comment-box col-md-9">
            <div class="thumbnail rounded">
                <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                <div class="caption"><?php 
                        if(!empty($_SESSION['username'])){
                            echo $_SESSION['username'];
                        }else{
                            echo '';
                        }
                ?></div>
            </div>
            <div class="col">
                <fieldset>
                    <div class="form-group">
                        <?php 
                        $msg='';
                        $attr='';
                        if(!empty($_SESSION['username'])){
                            $msg='Commenting publicly as '.$_SESSION['username'];
                            $attr='';
                        }else{
                            $msg='Login or Sign up to comment';
                            $attr='disabled';
                        } ?>
                        <textarea class="form-control" id="message" placeholder="<?php echo $msg; ?>
                        " required=""></textarea>
                    </div>	
                </fieldset>
                <button type="submit" class="btn btn-dark pull-right" onclick="toComment()" <?php echo $attr; ?>>Submit</button>
            </div>
        </div>
    </div>
    
<div class="container mb-5" id="comments"><hr>
        <?php
            $comments='';
            $attr2='';
            $attr3='';
            $reacts=0;
            $count=0;
            $style='';
            $reacted='';
            $result=$con->query("SELECT * FROM `comments` order by `id` DESC");
            if($result){
                while($row=$result->fetch_array()){
                    if(password_verify($row['researchNo'],$_SESSION["random_id"])){
                        //$_SESSION["random_id"]="";
                        if(!empty($_SESSION['username'])){
                            $hash = password_hash($row["id"], PASSWORD_DEFAULT);
                            $comments.='<div class="media comment-box col-md-9">
                        <div class="thumbnail rounded">
                                <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                                <div class="caption">'.$row['name'].'</div>
                            </div>
                            <div class="media-body">
                                <div class="media-heading rounded"><time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i>'.date('F',strtotime($row['commentDate'])).' '.date('d',strtotime($row['commentDate'])).', '.date('Y',strtotime($row['commentDate'])).'</time>';
                            
                            if(strlen($row['comment'])<=202){
                                $comments.='<p>'.$row['comment'].'</p>
                                <div class="footer text-right">';
                            }else{
                                $style='dots'.$count.'*'.'more'.$count;
                                $comments.='<p>'.substr($row['comment'],0,199).'<span id="dots'.$count.'">...</span><span id="more'.$count.'" style="display: none;">'.substr($row['comment'],199).'</span></p>
                                <button type="button" class="btn-link" onclick="readMore(this.id)" id="'.$style.'" style="background-color:white; border:none; padding:0; margin-left:10px;">Read more</button>
                                <div class="footer text-right">';
                            }
                            $result2=$con->query("SELECT * FROM `react` order by `id` DESC");
                            if($result2){
                                while($row2=$result2->fetch_array()){
                                    if(($_SESSION['user_id']==$row2['commentID']) && ($_SESSION['username']==$row2['likedBy']) && ($row['name']==$row2['username']) && ($row['researchNo']==$row2['researchNo'])){
                                        $reacts='';
                                        $reacted='Liked';
                                    }
                                }
                                
                                $comments.='
                                        <button type="button" class="btn btn-dark text-center col-sm-2" id="'.$hash.'" onclick="toLikes(this.id)" ><i class="fa fa-heart pr-2"> '.$reacts.' '.$reacted.'</i></button></div></div></div></div>';
                                $reacts=0;
                                $reacted='';
                            }else{
                                $comments.='0 </i></button></div></div></div></div>';
                            }
                            
                            
                        }else{
                            $comments.='<div class="media comment-box col-md-9">
                        <div class="thumbnail rounded">
                                <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                                <div class="caption">'.$row['name'].'</div>
                            </div>
                            <div class="media-body">
                                <div class="media-heading rounded"><time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i>'.date('F',strtotime($row['commentDate'])).' '.date('d',strtotime($row['commentDate'])).', '.date('Y',strtotime($row['commentDate'])).'</time>';
                            
                            if(strlen($row['comment'])<=202){
                                $comments.='<p>'.$row['comment'].'</p>
                                <div class="footer text-right">';
                            }else{
                                $style='dots'.$count.'*'.'more'.$count;
                                $comments.='<p>'.substr($row['comment'],0,199).'<span id="dots'.$count.'">...</span><span id="more'.$count.'" style="display: none;">'.substr($row['comment'],199).'</span></p>
                                <button type="button" class="btn-link" onclick="readMore(this.id)" id="'.$style.'" style="background-color:white; border:none; padding:0; margin-left:10px;">Read more</button>
                                <div class="footer text-right">';
                            }
                            $result2=$con->query("SELECT * FROM `react` order by `id` DESC");
                            if($result2){
                                while($row2=$result2->fetch_array()){
                                    if(($row['name']==$row2['username']) && ($row['id']==$row2['commentID']) && ($row['researchNo']==$row2['researchNo'])){
                                        $reacts+=1;
                                    }
                                }
                                $comments.='
                                        <button type="button" class="btn btn-dark text-center col-sm-2" disabled><i class="fa fa-heart pr-2"> '.$reacts.'</i></button></div></div></div></div>';
                                $reacts=0;
                            }else{
                                $comments.='0 </i></button></div></div></div></div>';
                            }
                            
                            
                        }
                        
                        $count+=1;
                    }
                }
            }
        ?>
    <h4 class="media-header"><?php if($count<=1){ echo $count.' Comment'; }else{ echo $count.' Comments'; } ?></h4>
		 <?php echo $comments; ?>
    
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
                            <div class="col">
                                <a class="nav-link" href="B-Home.php"><i class="fa fa-home"></i> HOME</a>
                                <a class="nav-link" href="B-Researches.php"><i class="fa fa-book"></i> RESEARCHES</a>
                                <a class="nav-link" href="B-Agenda.php"><i class="fa fa-cubes"></i> AGENDA</a>
                                <a class="nav-link" href="B-Colleges.php"><i class="fa fa-flag"></i> COLLEGES</a>
                            </div> 
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>