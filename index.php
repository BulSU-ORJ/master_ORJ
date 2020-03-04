<?php include 'controllers-authController.php'?>
<?php
// redirect user to login page if they're not logged in
    if(!empty($_SESSION['user_id'])){
        $username=$_SESSION['username'];
        $id=$_SESSION['user_id'];
    }else{
        header("Location: B-Home.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css" />
  <link rel="stylesheet" href="main.css">
  <link rel="icon" href="Icon/bulsuLogo.png" sizes="16x16" type="image/png"><title>Home - Bulsu Online Research Journal</title>
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
   </nav>
  <div class="container" >
      <div class="col-md-4 offset-md-4" style="margin-top: 50px;border: 1px solid black;border-radius: 5px;">
        <!-- Display messages -->
        <?php if (isset($_SESSION['message'])): ?>
        <div class="alert <?php echo $_SESSION['type'] ?>">
          <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            unset($_SESSION['type']);
          ?>
        </div>
        <?php endif;?>

        <h4>Welcome, <?php echo $_SESSION['username']; ?></h4>
        
        <?php if (!$_SESSION['verified']): ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            You need to verify your email address!
            Sign into your email account and click
            on the verification link we just emailed you
            at
            <strong><?php echo $_SESSION['email']; ?></strong>
          </div>
          <button type="button" class="btn btn-info btn-block" onclick="window.location.href='https://accounts.google.com/ServiceLogin/identifier?service=mail&passive=true&rm=false&continue=https%3A%2F%2Fmail.google.com%2Fmail%2F&ss=1&scc=1&ltmpl=default&ltmplcache=2&emr=1&osid=1&flowName=GlifWebSignIn&flowEntry=AddSessio'" style="margin-bottom: 15px;">Gmail Login</button>
          <button type="button" class="btn btn-primary btn-block" onclick="window.location.href='loginGuest.php'">Later</button>
        <?php endif;?>
      </div>
    </div>
</body>
</html>
