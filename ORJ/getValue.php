<?php
session_start();
$_SESSION["random_id"]="";
$_SESSION["random_id"]=$_POST['id'];
if($_SESSION["random_id"]){
    $response['message']="true";
}

echo json_encode($response);
?>