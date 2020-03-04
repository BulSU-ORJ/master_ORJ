<?php
session_start();
$response='';
if(isset($_POST['category'])){
    $category=$_POST['category'];
    if($category=="Select All"){
        $response='all';
        $_SESSION['sort']="List of Researches";
        $_SESSION['flag']=1;
    }else{
        $_SESSION['category']=$category;
        $response='not';
        if(($category=="Student")||($category=="student")){
            $_SESSION['sort']="List of Researches of Students";
        }else{
            $_SESSION['sort']="List of Researches of Faculties";
        }
        $_SESSION['flag']=0;
        $response='all';
    }
}
    


// Return response 
echo json_encode($response); 
?>