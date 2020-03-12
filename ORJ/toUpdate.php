<?php 
session_start();
include "connect.php";
$admin=$_SESSION["adminName"];
$response='';
$name = $_FILES['uploaded_file']['name'];
$name2 =$_FILES['imgrad_file']['name'];
$ext = pathinfo($name, PATHINFO_EXTENSION);
$ext2 = pathinfo($name2, PATHINFO_EXTENSION);
        
$researchNo=$_POST['staticRN'];
$agenda=$con->real_escape_string($_POST['agenda']);
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$con->real_escape_string($_POST['email']);
$abstract=$con->real_escape_string($_POST['abstractName']);
$college=$_POST['college'];
$category=$_POST['radio'];
$oldTitle=$_POST['title'];
if($college==="Bulsu-Bustos Campus" || $college==="Bulsu-Hagonoy Campus" || $college==="Bulsu-Meneses Campus" || $college==="Bulsu-Pulilan Campus" || $college==="Bulsu-Sarmiento Campus"){
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

$arr2=explode(" #: ",$researchNo);
$author=ucwords($fname.' '.$lname);
$title=substr($name,0,strrpos($name,"."));
            if(($ext=="pdf"||$ext=="PDF")&&($ext2=="pdf"||$ext2=="PDF")){
                $temp = explode(".",$_FILES["uploaded_file"]["name"]);
                $newfilename=$arr2[1].'.'.end($temp);//change the filename to accno
                $path="files/".$newfilename;
                $targetfolder = "imgradFiles/";
                $targetfolder= $targetfolder.basename($_FILES['imgrad_file']['name']);
                $oldTitle2=$oldTitle.'.pdf';
                $targetfolder2="imgradFiles/".$oldTitle2;

                if((unlink($path))&&(unlink($targetfolder2))){
                    $result=mysqli_query($con,"UPDATE `uploaddata` SET `author`='{$author}',`title`='{$title}',`author_category`='{$category}',`agenda`='{$agenda}',`college`='{$col}',`acronym`='{$acr}',`email`='{$email}',`date`=NOW(),`abstract`='{$abstract}',`filePath`='{$path}',`imgradPath`='{$targetfolder}' WHERE `researchNo`= '{$arr2[1]}'");
                    if($result=== TRUE){
                        if ((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$path)) &&(move_uploaded_file($_FILES['imgrad_file']['tmp_name'],$targetfolder))) {//move to specific folder
                            $response="true";// Move succeed.
                        } else {
                            $response="Error in Uploading";// Move failed. Possible duplicate?
                        }
                    }
                    
                }else{
                    $response='ok';
                }

            }else{
                $response= "notPDF";
            }
// Return response 
echo json_encode($response);

?>