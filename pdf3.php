<?php
session_start();
$response='';
$count2=1;
$flag=0;
$_SESSION['agd']='';
if(isset($_POST['id'])){
    $arr=explode("*",$_POST['id']);
    $count=count($arr)-1;
    if($count!=1){
        for($i=0;$i<$count;$i++){
            if($arr[$i]=='1'){
                $_SESSION['agd'].="Climate change and Adaptation";
                $flag+=1;
            }else if($arr[$i]=='2'){
                $_SESSION['agd'].="Biodiversity and the Management of the Natural Environment";
                $flag+=1;
            }else if($arr[$i]=='3'){
                $_SESSION['agd'].="Food safety and Security";
                $flag+=1;
            }else if($arr[$i]=='4'){
                $_SESSION['agd'].="Diagnosis and Prevention of Human Diseases and Health status of vulnerable Groups";
                $flag+=1;
            }else if($arr[$i]=='5'){
                $_SESSION['agd'].="Industry Assistance towards efficient Production and Achieving Global Standards";
                $flag+=1;
            }else if($arr[$i]=='6'){
                $_SESSION['agd'].="Cultural Heritage and Conservation";
                $flag+=1;
            }else if($arr[$i]=='7'){
                $_SESSION['agd'].="Restructuring Society and Understanding Culture towards Inclusive Nation Building";
                $flag+=1;
            }else if($arr[$i]=='8'){
                $_SESSION['agd'].="Emerging Technology and Applications to Inclusive Nation Building";
                $flag+=1;
            }else{
                if($arr[$i]=='9'){
                    $_SESSION['agd'].="Education and the Pedagogy for the Filipino Learners";
                    $flag+=1;
                }
            }
            if($i+1<$count){
                $_SESSION['agd'].=',';
            }
            
        }
        $response="ok";
        $_SESSION['flag']=$flag;
        
    }else{
        if($arr[0]=='1'){
            $_SESSION['agd']="Climate change and Adaptation";
            $flag+=1;
        }else if($arr[0]=='2'){
            $_SESSION['agd']="Biodiversity and the Management of the Natural Environment";
            $flag+=1;
        }else if($arr[0]=='3'){
            $_SESSION['agd']="Food safety and Security";
            $flag+=1;
        }else if($arr[0]=='4'){
            $_SESSION['agd']="Diagnosis and Prevention of Human Diseases and Health status of vulnerable Groups";
            $flag+=1;
        }else if($arr[0]=='5'){
            $_SESSION['agd']="Industry Assistance towards efficient Production and Achieving Global Standards";
            $flag+=1;
        }else if($arr[0]=='6'){
            $_SESSION['agd']="Cultural Heritage and Conservation";
            $flag+=1;
        }else if($arr[0]=='7'){
            $_SESSION['agd']="Restructuring Society and Understanding Culture towards Inclusive Nation Building";
            $flag+=1;
        }else if($arr[0]=='8'){
            $_SESSION['agd']="Emerging Technology and Applications to Inclusive Nation Building";
            $flag+=1;
        }else{
            if($arr[0]=='9'){
                $_SESSION['agd']="Education and the Pedagogy for the Filipino Learners";
                $flag+=1;
            }
        }
        $response="ok";
        $_SESSION['flag']=$flag;
        
    }
}

// Return response 
echo json_encode($response); 
?>