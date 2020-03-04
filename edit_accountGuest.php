<?php
    session_start();
include('connect.php');
    if(!empty($_SESSION['user_id'])){
        $username=$_SESSION['username'];
        $id=$_SESSION['user_id'];
    }else{
        header("Location: B-Home.php");
    }
$id=$_SESSION['user_id'];

$query="SELECT * FROM users WHERE id = '$id'";
$result=mysqli_query($con,$query);
if($result){
  while ($row=mysqli_fetch_assoc($result)) {
        # code...
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
    }  
}
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
    <script type="text/javascript">
        $(document).ready(function(){
            
            //Get all variables
            var firstname = document.forms['form_edit']['fname'];
            var middlename = document.forms['form_edit']['mname'];
            var lastname = document.forms['form_edit']['lname'];
            var oldpass = document.forms['form_edit']['oldpass'];
            var newpass = document.forms['form_edit']['newpass'];
            var cpass = document.forms['form_edit']['Cpass'];

            //function para mawala yung disable
            $('#Cpass').change(function(){
                if (newpass.value != "" && cpass.value != ""){  
                    $.ajax({
                        type:"POST",
                        url:"editaccountGuest.php",
                        data:{
                            cpass1:cpass.value,newpass1:newpass.value,
                        },
                        success: function(response){
                            $('#checker1').html(response);
                            if (response == "password_matched"){
                                    newpass.style.border = "1px solid #228B22";
                                    document.getElementById('border_checker').style.color = "#00FF7F";
                                    cpass.style.border = "1px solid #228B22";
                                    document.getElementById('border_checker1').style.color = "#00FF7F";
                                    document.getElementById('checker1').style.color = "#228B22";
                                //$('#newpass').removeAttr("disabled");
                                //$('#Cpass').removeAttr("disabled");
                                return true;
                            }else{
                                newpass.style.border = "1px solid red";
                                document.getElementById('border_checker').style.color = "red";
                                cpass.style.border = "1px solid red";
                                document.getElementById('border_checker1').style.color = "red";
                                document.getElementById('checker1').style.color = "red";
                                $('#submit').attr('disabled',true);
                                return false;
                            }
                        }
                    });
                }
            });
            //function para magsubmit
            $('#submit').click(function(){
                //$('#submit').attr('disabled',true);
                $('#submit').attr('class','btn btn-dark btn-block');
                //$('#gifImg').attr('src','Icon/load2.gif');
                //$('#lblGif').html('Please wait...');
                toUpdate();
            });
            function toUpdate(){
                
                if (firstname.value != "" || middlename.value != "" || lastname.value != "" || newpass.value !="" || oldpass.value != ""){
                $.ajax({
                    type: 'post',
                    url: 'editaccountGuest.php',
                    data: {
                        fname: firstname.value, mname: middlename.value, lname: lastname.value, new_pass:newpass.value, old_pass:oldpass.value,
                    },
                    success: function(response){
                    $('#checker').html(response);
                        if (response){
                            return true;
                        }else{
                            return false;
                        }
                    }
                });
                }
            }       
        });
    </script>
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
            <li style="list-style-type:none;"><a class="btn nav-item" href="B-HomeRegistered.php" style="font-weight: bold" id="disabled">HOME</a></li>
            <li style="list-style-type:none;"><a class="btn nav-item" href="B-ResearchesRegistered.php">RESEARCHES</a></li>
            <li style="list-style-type:none;"><a class="btn nav-item" href="B-AgendaRegistered.php">AGENDA</a></li>
            <li style="list-style-type:none;"><a class="btn nav-item" href="B-CollegesRegistered.php">COLLEGES</a></li>
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
    <div class="container" >
                  <div class="col-sm-12" >
                <div class="col-sm-6" style="float: right;">
        <br>
        <h2 class="text-center" style="font-weight:bold;">Update Account</h2>
        <form class="form-container" enctype="multipart/form-data" method="POST" action="edit_accountGuest.php" name="form_edit">
                <div class="form-group">
                <div id="checker"></div>
                <label for="fname">First Name:</label>
                    <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $firstname; ?>" autofocus>
                </div>
                <div class="form-group">
                <label for="lname">Middle Name:</label>
                    <input type="text" class="form-control" id="mname" name="mname" placeholder="Optional">
                </div>
                <div class="form-group">
                <label for="lname">Last Name:</label>
                    <input type="text" class="form-control" id="lname" name="lname" value="<?php echo $lastname; ?>">
                </div>
                <p>If do you want to change your password just fill up the Old password</p>
                <div class="form-group">
                <label for="oldpass">Old Password:</label>
                    <input type="password" class="form-control" id="oldpass" name="oldpass">
                </div>
                <div id="checker1"></div>
                <div class="form-group" id="border_checker">
                <label for="newpass">New Password:</label>
                    <input type="password" class="form-control" id="newpass" name="newpass">
                </div>
                <div class="form-group" id="border_checker1">
                <label for="Cpass">Confirm Password:</label>
                    <input type="password" class="form-control" id="Cpass" name="Cpass">
                </div>
                <button type="button" class="btn btn-dark btn-block" name="submit" id="submit" onclick="checkbutton();">Update</button>
            </form>
    </div>

</body>
</html>