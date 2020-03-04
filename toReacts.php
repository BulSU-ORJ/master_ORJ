<?php
session_start();
include('connect.php');
$output='';
$count=0;
$flag=1;
$researchNo='';
$index=0;
$msg='';
$attr2='';
$reacts=0;
$counts='';
$name='';
$reacted='';
$id=0;
$rn='';
if(($_POST['id']!='') && (!empty($_SESSION['username'])) && (!empty($_SESSION['user_id']))){
    $username=$con -> real_escape_string($_SESSION['username']);
    $result=$con->query("SELECT * FROM `comments` order by `id` DESC");
    if($result){
        while($row=$result->fetch_array()){
            if(password_verify($row['id'],$_POST['id'])){
                $id=$row['id'];
                $name=$row['name'];
                $rn=$row['researchNo'];
                break;
            }
        }
        $checks=$con->query("SELECT * FROM `react` WHERE `commentID`={$id} AND `likedBy`='{$username}' AND `username`='{$name}' AND `researchNo`='{$rn}'");
        if (mysqli_num_rows($checks)==0) {
            $query="INSERT INTO `react`(`id`, `commentID`, `likedBy`, `username`, `researchNo`) VALUES (null,{$id},'{$username}','{$name}','{$rn}')";
            $result2=mysqli_query($con,$query);
            if($result2){
                $result=$con->query("SELECT * FROM `comments` order by `id` DESC");
                while($row=$result->fetch_array()){
                    $hash = password_hash($row["id"], PASSWORD_DEFAULT);
                    $output.='<div class="media comment-box col-md-9">
                                <div class="thumbnail rounded">
                                    <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                                    <div class="caption">'.$row['name'].'</div>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading rounded"><time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i>'.date('F',strtotime($row['commentDate'])).' '.date('d',strtotime($row['commentDate'])).', '.date('Y',strtotime($row['commentDate'])).'</time>';
                                    if(strlen($row['comment'])<=202){
                                        $output.='<p>'.$row['comment'].'</p>
                                        <div class="footer text-right">';
                                    }else{
                                        $style='dots'.$count.'*'.'more'.$count;
                                        $output.='<p>'.substr($row['comment'],0,199).'<span id="dots'.$count.'">...</span><span id="more'.$count.'" style="display: none;">'.substr($row['comment'],199).'</span></p>
                                        <button type="button" class="btn-link" onclick="readMore(this.id)" id="'.$style.'" style="background-color:white; border:none; padding:0; margin-left:10px;">Read more</button>
                                        <div class="footer text-right">';
                                    }
                                    $result3=$con->query("SELECT * FROM `react` order by `id` DESC");
                                    if($result3){
                                        while($row2=$result3->fetch_array()){
                                            if(($_SESSION['user_id']==$row2['commentID']) && ($_SESSION['username']==$row2['likedBy']) && ($row['name']==$row2['username']) && ($row['researchNo']==$row2['researchNo'])){
                                                $reacts='';
                                                $reacted='Liked';
                                            }
                                            if(($row['name']==$row2['username']) && ($row['id']==$row2['commentID']) && ($row['researchNo']==$row2['researchNo'])){
                                                $reacts+=1;
                                            }
                                        }
                                        $output.='<button type="button" class="btn btn-dark text-center col-sm-2" id="'.$hash.'" onclick="toLikes(this.id)" ><i class="fa fa-heart pr-2"> '.$reacts.'</i></button></div></div></div></div>';
                                        $reacts=0;
                                    }else{
                                        $output.='0 </i></button></div></div></div></div>';
                                    }
                    $count+=1;
                }
            }
        }else{
            $drop=$con->query("DELETE FROM `react` WHERE `commentID`={$id} AND `likedBy`='{$username}' AND `username`='{$name}' AND `researchNo`='{$rn}'");
            if($drop){
                $result=$con->query("SELECT * FROM `comments` order by `id` DESC");
                while($row=$result->fetch_array()){
                    $hash = password_hash($row["id"], PASSWORD_DEFAULT);
                    $output.='<div class="media comment-box col-md-9">
                                <div class="thumbnail rounded">
                                    <img class="img-responsive user-photo" src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png">
                                    <div class="caption">'.$row['name'].'</div>
                                </div>
                                <div class="media-body">
                                    <div class="media-heading rounded"><time class="comment-date" datetime="16-12-2014 01:05"><i class="fa fa-clock-o"></i>'.date('F',strtotime($row['commentDate'])).' '.date('d',strtotime($row['commentDate'])).', '.date('Y',strtotime($row['commentDate'])).'</time>';
                                    if(strlen($row['comment'])<=202){
                                        $output.='<p>'.$row['comment'].'</p>
                                        <div class="footer text-right">';
                                    }else{
                                        $style='dots'.$count.'*'.'more'.$count;
                                        $output.='<p>'.substr($row['comment'],0,199).'<span id="dots'.$count.'">...</span><span id="more'.$count.'" style="display: none;">'.substr($row['comment'],199).'</span></p>
                                        <button type="button" class="btn-link" onclick="readMore(this.id)" id="'.$style.'" style="background-color:white; border:none; padding:0; margin-left:10px;">Read more</button>
                                        <div class="footer text-right">';
                                    }
                                    $result3=$con->query("SELECT * FROM `react` order by `id` DESC");
                                    if($result3){
                                        while($row2=$result3->fetch_array()){
                                            if(($_SESSION['user_id']==$row2['commentID']) && ($_SESSION['username']==$row2['likedBy']) && ($row['name']==$row2['username']) && ($row['researchNo']==$row2['researchNo'])){
                                                $reacts='';
                                                $reacted='Liked';
                                            }
                                            if(($row['name']==$row2['username']) && ($row['id']==$row2['commentID']) && ($row['researchNo']==$row2['researchNo'])){
                                                $reacts+=1;
                                            }
                                        }
                                        $output.='<button type="button" class="btn btn-dark text-center col-sm-2" id="'.$hash.'" onclick="toLikes(this.id)" ><i class="fa fa-heart pr-2"> '.$reacts.' '.$reacted.'</i></button></div></div></div></div>';
                                        $reacts=0;
                                    }else{
                                        $output.='0 </i></button></div></div></div></div>';
                                    }
                    $count+=1;
                }
            }
        }
    }
    if($count==1){
        $counts='<h4 class="media-header">'.$count.' Comment </h4>';
    }else{
        $counts='<h4 class="media-header">'.$count.' Comments </h4>';
    }
}
$data=array(
    'output' => $output,
    'count' => $counts
);
$con->close();
echo json_encode($data);

?>
