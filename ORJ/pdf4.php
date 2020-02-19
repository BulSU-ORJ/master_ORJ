<?php
session_start();
$response='';
if(isset($_POST['category'])){
    $category=$_POST['category'];
    if($category=="Select All"){
        $response='all';
        $_SESSION['sort']="List of Researches sort by Affiliation";
    }else{
        $_SESSION['category']=$category;
        $response='not';
        $_SESSION['sort']="List of Researches by ".$category;
    }
}
    


// Return response 
echo json_encode($response); 
?>