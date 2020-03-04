<?php
    session_start();
    include "connect.php";
    $admin=$_SESSION["adminName"];
	$output='';
    $hash='';
    $rn='';
	if(isset($_POST['id'])){
		$hash=$_POST['id'];
        $result=mysqli_query($con,"Select * from `uploaddata`");
        if($result){
            while($row=mysqli_fetch_array($result)){
                if(password_verify($row['researchNo'],$hash)){
                    $rn=$row['researchNo'];
                    break;
                }
            }
        }
        $output='<div class="modal-dialog modal-dialog-centered" role="document" style="padding-top:0; margin-top:0;">
            <div class="modal-content">
              <div class="modal-header" style="border:none; padding-bottom:0; margin-bottom:0;">
                <h5 class="modal-title" id="exampleModalLongTitle">Please enter your password:</h5>
              </div>
              <div class="modal-body" style="padding-bottom:0; padding-right:0;">
                <div class="form-group">
                    <input type="password" class="form-control" id="pass2" name="pass2" required>
                </div>
              </div>
              <div class="modal-footer" style="border:none; padding-bottom:10px; padding-right:10px;">
                <button id="submit" type="button" class="btn btn-dark" onclick="toDelete()">Submit</button>
                <button type="button" class="btn btn-dark" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>';
        $data=array(
            'output' => $output,
            'rn' => $rn
        );
        // Return response 
        echo json_encode($data);
    }

    if(isset($_POST['data'])){
        $data=explode("*",$_POST['data']);
        $result=mysqli_query($con,"Select * from `members`");
        if($result){
            while($row=mysqli_fetch_array($result)){
                if(($row['members_fullName'] == $admin) && (password_verify($data[0],$row['member_password']))){
                    $result=mysqli_query($con,"SELECT * FROM `uploaddata`");
                    if($result){
                        while($row=mysqli_fetch_array($result)){
                            if($row['researchNo']==$data[1]){
                                $researchNo=$row['researchNo'];
                                $author=$row['author'];
                                $title=$row['title'];
                                $category=$row['author_category'];
                                $agenda=$row['agenda'];
                                $college=$row['college'];
                                $acronym=$row['acronym'];
                                $email=$row['email'];
                                $date=$row['date'];
                                $abstract=$row['abstract'];
                                $oldPath1=$row['filePath'];
                                $oldPath2=$row['imgradPath'];
                                $exp1=explode("/",$oldPath1);
                                $exp2=explode("/",$oldPath2);
                                $newPath1="archiveFiles/".$exp1[1];
                                $newPath2="archiveFiles/".$exp2[1];
                                $result=mysqli_query($con,"INSERT INTO `archive`(`id`, `researchNo`, `author`, `title`, `author_category`, `agenda`, `college`, `acronym`, `email`, `date`, `abstract`, `filePath`, `imgradPath`) VALUES (null,'{$researchNo}','{$author}','{$title}','{$category}','{$agenda}','{$college}','{$acronym}','{$email}','{$date}','{$abstract}','{$newPath1}','{$newPath2}')");
                                if($result){
                                    if(rename($oldPath1,$newPath1) && rename($oldPath2,$newPath2)){
                                        $query="DELETE FROM `uploaddata` WHERE `researchNo`='{$researchNo}'";
                                        mysqli_query($con,$query);
                                        $output='okay';
                                        break;
                                        
                                    }else{
                                        $output='notokay2';
                                    }
                                }
                                else{
                                    $output='not';
                                }
                            }
                        }
                        
                    }
                    break;
                }else{
                    $output='wrong password';
                }
            }
    }
        
        // Return response 
        echo json_encode($output);
    }

?>