<?php
session_start();
$response='';
if(isset($_POST['value'])){
    $arr=explode("*",$_POST['value']);
    $selectedYear=$arr[0];
    $selectedMonth=$arr[1];
    $month='';
    
    
    if($selectedYear!="Select All"){
        if($selectedMonth!="Select All"){
            $_SESSION['year']=$selectedYear;
            if($selectedMonth=='January'){
                $_SESSION['month']='1';
                $month='January';
             }else if($selectedMonth=='February'){
                $_SESSION['month']='2';
                $month='February';
             }else if($selectedMonth=='March'){
                $_SESSION['month']='3';
                $month='March';
             }else if($selectedMonth=='April'){
                $_SESSION['month']='4';
                $month='April';
             }else if($selectedMonth=='May'){
                $_SESSION['month']='5';
                $month='May';
             }else if($selectedMonth=='June'){
                $_SESSION['month']='6';
                $month='June';
             }else if($selectedMonth=='July'){
                $_SESSION['month']='7';
                $month='July';
             }else if($selectedMonth=='August'){
                $_SESSION['month']='8';
                $month='August';
             }else if($selectedMonth=='September'){
                $_SESSION['month']='9';
                $month='September';
             }else if($selectedMonth=='October'){
                $_SESSION['month']='10';
                $month='October';
             }else if($selectedMonth=='November'){
                $_SESSION['month']='11';
                $month='November';
             }else{
                $_SESSION['month']='12';
                $month='December';
             }
            
            $_SESSION['sort']="List of Researches for the month of ".$month.', '.$selectedYear;
            $response='1:1';
        }else{
            $_SESSION['year']=$selectedYear;
            $_SESSION['sort']="List of Researches for the year of ".$selectedYear;
            $response='1:all';
        }
    }else{
        if($selectedMonth!="Select All"){
            $_SESSION['year']=$selectedYear;
            $response='all:1';
            if($selectedMonth=='January'){
                $_SESSION['month']='1';
                $month='January';
             }else if($selectedMonth=='February'){
                $_SESSION['month']='2';
                $month='February';
             }else if($selectedMonth=='March'){
                $_SESSION['month']='3';
                $month='March';
             }else if($selectedMonth=='April'){
                $_SESSION['month']='4';
                $month='April';
             }else if($selectedMonth=='May'){
                $_SESSION['month']='5';
                $month='May';
             }else if($selectedMonth=='June'){
                $_SESSION['month']='6';
                $month='June';
             }else if($selectedMonth=='July'){
                $_SESSION['month']='7';
                $month='July';
             }else if($selectedMonth=='August'){
                $_SESSION['month']='8';
                $month='August';
             }else if($selectedMonth=='September'){
                $_SESSION['month']='9';
                $month='September';
             }else if($selectedMonth=='October'){
                $_SESSION['month']='10';
                $month='October';
             }else if($selectedMonth=='November'){
                $_SESSION['month']='11';
                $month='November';
             }else{
                $_SESSION['month']='12';
                $month='December';
             }
            $_SESSION['sort']="List of Researches for the month of ".$month;
        }else{
            $_SESSION['sort']="";
            $response='all:all';
        }
        
    }
    
}

// Return response 
echo json_encode($response); 
?>