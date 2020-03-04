<?php 
include "connect.php";
$resultflag=0;
$arr=array();
$col='';
$acr='';
$rowCount=0;

if((isset($_FILES['uploaded_file']['tmp_name'])) && (isset($_FILES['imgrad_file']['tmp_name']))) {
    // Make sure the file was sent without errors
    if(($_FILES['uploaded_file']['error'] == 0)&&($_FILES['imgrad_file']['error'] == 0)) {

        $name = $con->real_escape_string($_FILES['uploaded_file']['name']);
        //$mime = $con->real_escape_string($_FILES['uploaded_file']['type']);
        //$size = $con->real_escape_string($_FILES['uploaded_file']['size']);
        $ext = pathinfo($name, PATHINFO_EXTENSION);
        //$pdfData = $con->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        
        $name2 = $con->real_escape_string($_FILES['imgrad_file']['name']);
        //$mime2 = $con->real_escape_string($_FILES['imgrad_file']['type']);
        //$size2 = $con->real_escape_string($_FILES['imgrad_file']['size']);
        $ext2 = pathinfo($name2, PATHINFO_EXTENSION);
        //$pdfData2 = $con->real_escape_string(file_get_contents($_FILES  ['imgrad_file']['tmp_name']));
        
        $researchNo=$_POST['staticRN'];
        $agenda=$_POST['agenda'];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $abstract=$con -> real_escape_string($_POST['abstractName']);
        $college=$_POST['college'];
        $category=$_POST['radio'];
        if($college==="Bulsu-Bustos Campus" || $college==="Bulsu-Hagonoy Campus" || $college==="Bulsu-Meneses Campus" || $college==="Bulsu-Sarmiento Campus"){
            $arr=explode(" ",$college);
            $col=$college;
            $acr=$arr[0];
        }else{
            $arr=explode(" (",$college);
            $len=strlen($arr[1]);
            $sub = substr($arr[1], 0, $len - 1);
            $col=$arr[0];
            $acr=$sub;
        }
        
        $author=ucwords($fname.' '.$lname);
		$title=$con -> real_escape_string(substr($name,0,strrpos($name,".")));
        if($search=mysqli_query($con,"SELECT * FROM `uploaddata` WHERE `title`='{$title}'")){
            $rowCount=mysqli_num_rows($search);
            if($rowCount==0){
                if(($ext=="pdf"||$ext=="PDF")&&($ext2=="pdf"||$ext2=="PDF")){
                    $temp = explode(".",$_FILES["uploaded_file"]["name"]);
                    $newfilename=$researchNo.'.'.end($temp);//change the filename to accno
                    $path=$con -> real_escape_string("files/".$newfilename);
                    $targetfolder= $con -> real_escape_string("imgradFiles/".basename($_FILES['imgrad_file']['name']));
                    $result=mysqli_query($con,"INSERT INTO `uploaddata`(`id`,`researchNo`, `author`, `author_category`, `title`, `agenda`, `college`, `acronym`, `email`, `date`, `abstract`, `filePath`, `imgradPath`, `viewCount`) VALUES ('null','{$researchNo}','{$author}','{$category}','{$title}','{$agenda}','{$col}','{$acr}','{$email}',NOW(),'{$abstract}','{$path}','{$targetfolder}',0)");
                    if($result=== TRUE){
                        if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$path)) && (move_uploaded_file($_FILES['imgrad_file']['tmp_name'],$targetfolder))) {//move to specific folder
                            $response['message']="true";// Move succeed.
                        } else {
                            $response['message']="Error in Uploading";// Move failed. Possible duplicate?
                        }
                    }else{
                        $response['message']="Error in Uploading";
                    }
                }else{
                    $response['message']= "notPDF";
                }
            }else{
                $response['message']="PDF File already exist in the database";
            }
        }
    }
	else {
		$response['message']= 'An error accured while the file was being uploaded. '
		. 'Error code: '. intval($_FILES['uploaded_file']['error']);
	}
    
// Return response 
echo json_encode($response);
}
?>