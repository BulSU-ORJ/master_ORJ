<?php 
session_start();
include "connect.php";
$admin=$_SESSION["adminName"];
$pass=$_POST['pass'];
$response='';
$name = $con->real_escape_string($_FILES['uploaded_file']['name']);
$name2 = $con->real_escape_string($_FILES['imgrad_file']['name']);
$ext = pathinfo($name, PATHINFO_EXTENSION);
$ext2 = pathinfo($name2, PATHINFO_EXTENSION);
        
$researchNo=$_POST['staticRN'];
$agenda=$_POST['agenda'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$abstract=$_POST['abstractName'];
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
$result=mysqli_query($con,"Select * from `members`");
if($result){
    while($row=mysqli_fetch_array($result)){
        if(($row['members_fullName'] == $admin) && (password_verify($pass,$row['member_password']))){
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
                    }else{
                        $result=mysqli_query($con,"UPDATE `uploaddata` SET `author`='{$author}',`title`='{$title}',`author_category`='{$category}',`agenda`='{$agenda}',`college`='{$col}',`acronym`='{$acr}',`email`='{$email}',`date`=NOW(),`abstract`='{$abstract}',`filePath`='{$path}',`imgradPath`='{$targetfolder}' WHERE `researchNo`= '{$arr2[1]}'");
                        if($result=== TRUE){
                            if((move_uploaded_file($_FILES['uploaded_file']['tmp_name'],$path)) &&(move_uploaded_file($_FILES['imgrad_file']['tmp_name'],$targetfolder))) {//move to specific folder
                                $response="true";// Move succeed.
                            } else {
                                $response="Error in Uploading";// Move failed. Possible duplicate?
                            }
                        }else{
                            $response="Error in Uploading";
                        }
                    }
                    
                }else{
                    $response='pota';
                }

            }else{
                $response= "notPDF";
            }
            break;
        }else{
            $response='wrong password';
        }
    }
}
// Return response 
echo json_encode($response);

?>