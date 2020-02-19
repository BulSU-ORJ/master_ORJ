<!-- 
		Author: Sampath Kumar Medarametla
		Email: skmeadarametla@gmail.com
		All rights reserved to Sampath Kumar Medarametla
		Free to use with copyright
		Date: 7/9/2015
-->
<?php
include_once 'connect.php';
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Uploaded files</title>
    <meta http-equiv="content-type" content="text/html"; charset="utf-8">
<link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
    <?php
	$sql="SELECT * FROM datafile";
	$result_set=mysqli_query($con,$sql);
	if (mysqli_num_rows($result_set) == 0) {
            echo "Database is empty <br>";
        } 


        else {
            while (list($id,$rn, $name,$type,$size,$data) = mysqli_fetch_array($result_set)) {
                $pdf=base64_encode($data);
       ?>             
					<embed src="data:application/pdf;base64,<?php echo $pdf; ?>" type="application/pdf" style="height:200%; width:100%">
	<?php			

        }
        }
?>
   <a href="download.php?id=<?php echo urlencode($id); ?>"
                   ><?php urlencode($name);?>Download</a>
                
    
</body>
</html>