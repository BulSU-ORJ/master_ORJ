<?php
session_start();
$response='';
$count2=1;
$flag=0;
$_SESSION['col']='';
$_SESSION['sort']='';
if(isset($_POST['id'])){
    $arr=explode("*",$_POST['id']);
    $count=count($arr)-1;
    if($count!=1){
        for($i=0;$i<$count;$i++){
            if($arr[$i]=='1'){
                $_SESSION['col'].="CAFA";
                $_SESSION['sort'].="College of Architecture and Fine Arts";
                $flag+=1;
            }else if($arr[$i]=='2'){
                $_SESSION['col'].="CAL";
                $_SESSION['sort'].="College of Arts and Letters";
                $flag+=1;
            }else if($arr[$i]=='3'){
                $_SESSION['col'].="CBA";
                $_SESSION['sort'].="College of Business Administration";
                $flag+=1;
            }else if($arr[$i]=='4'){
                $_SESSION['col'].="CCJE";
                $_SESSION['sort'].="College of Criminal Justice Education";
                $flag+=1;
            }else if($arr[$i]=='5'){
                $_SESSION['col'].="CHTM";
                $_SESSION['sort'].="College of Hospitality and Tourism Management";
                $flag+=1;
            }else if($arr[$i]=='6'){
                $_SESSION['col'].="CICT";
                $_SESSION['sort'].="College of Information and Communications Technology";
                $flag+=1;
            }else if($arr[$i]=='7'){
                $_SESSION['col'].="CIT";
                $_SESSION['sort'].="College of Industrial Technology";
                $flag+=1;
            }else if($arr[$i]=='8'){
                $_SESSION['col'].="CLaw";
                $_SESSION['sort'].="College of Law";
                $flag+=1;
            }else if($arr[$i]=='9'){
                $_SESSION['col'].="CN";
                $_SESSION['sort'].="College of Nursing";
                $flag+=1;
            }else if($arr[$i]=='10'){
                $_SESSION['col'].="COE";
                $_SESSION['sort'].="College of Engineering";
                $flag+=1;
            }else if($arr[$i]=='11'){
                $_SESSION['col'].="COED";
                $_SESSION['sort'].="College of Education";
                $flag+=1;
            }else if($arr[$i]=='12'){
                $_SESSION['col'].="CS";
                $_SESSION['sort'].="College of Science";
                $flag+=1;
            }else if($arr[$i]=='13'){
                $_SESSION['col'].="CSER";
                $_SESSION['sort'].="College of Sports, Exercise and Recreation";
                $flag+=1;
            }else if($arr[$i]=='14'){
                $_SESSION['col'].="CSSP";
                $_SESSION['sort'].="College of Social Sciences and Philosophy";
                $flag+=1;
            }else if($arr[$i]=='15'){
                $_SESSION['col'].="GS";
                $_SESSION['sort'].="Graduate School";
                $flag+=1;
            }else if($arr[$i]=='16'){
                $_SESSION['col'].="Bulsu-Bustos";
                $_SESSION['sort'].="Bulsu-Bustos Campus";
                $flag+=1;
            }else if($arr[$i]=='17'){
                $_SESSION['col'].="Bulsu-Hagonoy";
                $_SESSION['sort'].="Bulsu-Hagonoy Campus";
                $flag+=1;
            }else if($arr[$i]=='18'){
                $_SESSION['col'].="Bulsu-Meneses";
                $_SESSION['sort'].="Bulsu-Meneses Campus";
                $flag+=1;
            }else if($arr[$i]=='19'){
                $_SESSION['col'].="Bulsu-Pulilan";
                $_SESSION['sort'].="Bulsu-Pulilan Campus";
                $flag+=1;
            }else{
                if($arr[$i]=='20'){
                    $_SESSION['col'].="'Bulsu-Sarmiento'";
                    $_SESSION['sort']="Bulsu-Sarmiento Campus";
                    $flag+=1;
                }
            }
            if($i+1<$count){
                $_SESSION['col'].=',';
                $_SESSION['sort'].=',';
            }
        }
        $response="ok";
        $_SESSION['flag']=$flag;
        
    }else{
        if($arr[0]=='1'){
            $_SESSION['col']="CAFA";
            $_SESSION['sort']="College of Architecture and Fine Arts";
            $flag+=1;
        }else if($arr[0]=='2'){
            $_SESSION['col']="CAL";
            $_SESSION['sort']="College of Arts and Letters";
            $flag+=1;
        }else if($arr[0]=='3'){
            $_SESSION['col']="CBA";
            $_SESSION['sort']="College of Business Administration";
            $flag+=1;
        }else if($arr[0]=='4'){
            $_SESSION['col']="CCJE";
            $_SESSION['sort']="College of Criminal Justice Education";
            $flag+=1;
        }else if($arr[0]=='5'){
            $_SESSION['col']="CHTM";
            $_SESSION['sort']="College of Hospitality and Tourism Management";
            $flag+=1;
        }else if($arr[0]=='6'){
            $_SESSION['col']="CICT";
            $_SESSION['sort']="College of Information and Communications Technology";
            $flag+=1;
        }else if($arr[0]=='7'){
            $_SESSION['col']="CIT";
            $_SESSION['sort']="College of Industrial Technology";
            $flag+=1;
        }else if($arr[0]=='8'){
            $_SESSION['col']="CLaw";
            $_SESSION['sort']="College of Law";
            $flag+=1;
        }else if($arr[0]=='9'){
            $_SESSION['col']="CN";
            $_SESSION['sort']="College of Nursing";
            $flag+=1;
        }else if($arr[0]=='10'){
            $_SESSION['col']="COE";
            $_SESSION['sort']="College of Engineering";
            $flag+=1;
        }else if($arr[0]=='11'){
            $_SESSION['col']="COED";
            $_SESSION['sort']="College of Education";
            $flag+=1;
        }else if($arr[0]=='12'){
            $_SESSION['col']="CS";
            $_SESSION['sort']="College of Science";
            $flag+=1;
        }else if($arr[0]=='13'){
            $_SESSION['col']="CSER";
            $_SESSION['sort']="College of Sports, Exercise and Recreation";
            $flag+=1;
        }else if($arr[0]=='14'){
            $_SESSION['col']="CSSP";
            $_SESSION['sort']="College of Social Sciences and Philosophy";
            $flag+=1;
        }else if($arr[0]=='15'){
            $_SESSION['col']="GS";
            $_SESSION['sort']="Graduate School";
            $flag+=1;
        }else if($arr[0]=='16'){
            $_SESSION['col']="Bulsu-Bustos";
            $_SESSION['sort']="Bulsu-Bustos Campus";
            $flag+=1;
        }else if($arr[0]=='17'){
            $_SESSION['col']="Bulsu-Hagonoy";
            $_SESSION['sort']="Bulsu-Hagonoy Campus";
            $flag+=1;
        }else if($arr[0]=='18'){
            $_SESSION['col']="Bulsu-Meneses";
            $_SESSION['sort']="Bulsu-Meneses Campus";
            $flag+=1;
        }else if($arr[0]=='19'){
            $_SESSION['col']="Bulsu-Pulilan";
            $_SESSION['sort']="Bulsu-Pulilan Campus";
            $flag+=1;
        }else{
            if($arr[0]=='20'){
                $_SESSION['col']="Bulsu-Sarmiento";
                $_SESSION['sort']="Bulsu-Sarmiento Campus";
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