<?php
session_start();
    include "connect.php";
    $output='';
    $query = "SELECT * FROM `members`";
    $result = $con->query($query);
    $id=$_SESSION['member_id'];
    $output='';
    if($result) {
        while($row=mysqli_fetch_array($result)){
            if($row['member_id']== $id){
                if (password_verify($_POST['x'], $row["pinNo"])) {
                    $output="ok";
                }else{
                    $output="invalid";
                }
            }
        }
    }else{
        $output='oh no';
    }
// Return response 
echo json_encode($output);
?>