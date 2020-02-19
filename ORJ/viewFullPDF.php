<?php
	session_start();
	include 'connect.php';
        
	
		$hash=$_SESSION['pdfVal'];
		if(!empty($hash)){
            $query = "SELECT * FROM `uploaddata`";
            $result = $con->query($query);
            if($result) {
                while($row=mysqli_fetch_array($result)){
                    if (password_verify($row['researchNo'], $hash)) {
                        $src=$row['imgradPath'];
                        $title=$row['title'];
                    }
                    
                    
                }
            }
		}
		
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="Icon/bulsuLogo.png" sizes="16x16" type="image/png"><title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script><!-- jquery CDN -->
    <style>
        .embed-cover {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            width: 99%;
            /* Just for demonstration, remove this part */
            /*opacity: 0.25;
            background-color: red;
        */}

        .wrapper {
            position: relative;
            overflow: hidden;
            margin-top: -30px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <object data="<?php echo $src; ?>" type="application/pdf" style="min-height:100vh;width:100%"></object>
        <div class="embed-cover"></div>
    </div>
</body>
</html>
