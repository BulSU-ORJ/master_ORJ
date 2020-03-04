<?php 
include "connect.php";
$resultflag=0;
if(isset($_FILES['uploaded_file']['tmp_name'])) {
    // Make sure the file was sent without errors
    if($_FILES['uploaded_file']['error'] == 0) {
        $name = $con->real_escape_string($_FILES['uploaded_file']['name']);
        $mime = $con->real_escape_string($_FILES['uploaded_file']['type']);
        $pdfData = $con->real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
        
        $researchNo=$_POST['staticRN'];
        $agenda=$_POST['agenda'];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $abstract=$_POST['abstractName'];
        $college=$_POST['college'];
        $arr=explode("-",$college);
        $author=$fname.' '.$lname;
		$title=substr($name,0,strrpos($name,"."));
        $current_time = time();
        $current_date = date("Y-m-d H:i:s", $current_time);
        $result=mysqli_query($con,"INSERT INTO `upload`(`id`, `researchNo`, `author`, `title`, `files`, `agenda`, `college`, `acronym`, `email`, `date`, `abstract`) VALUES ('null','{$researchNo}','{$author}','{$title}','{$pdfData}','{$agenda}','{$arr[0]}','{$arr[1]}','{$email}',NOW(),'{$abstract}')");
        if ($result=== TRUE) {
           $resultflag=1;
        } else {
            $resultflag=2;
        }
        if($resultflag==1){
            $response['message']="true";
        }
        else if($resultflag==2){
            $response['message']= $college.' '.$arr[1];
        }
        else{
            $response['message']="the end";
        }
    }
	else {
		$response['message']= 'An error accured while the file was being uploaded. '
		. 'Error code: '. intval($_FILES['uploaded_file']['error']);
	}
}
// Return response 
echo json_encode($response);
?>