<?php
include('connect.php');

	$result=mysqli_query($con,"SELECT * FROM `uploaddata` ORDER BY `id` DESC");
	$output = '';
    $flag=1;
    if($result){
        $count = mysqli_num_rows($result);
        if($count != 0)
        {
            while($row = mysqli_fetch_array($result))
            {
                $hash = password_hash($row["researchNo"], PASSWORD_DEFAULT);
                if($flag==1){
                    $output .= '<div class="col-sm-4" id="cardRecent">
                                    <div class="card p-2 mb-5">
                                        <div class="card-body">
                                            <h5 class="card-title crop-text-3"><strong>'.$row['title'].'</strong></h5>
                                            <div class="text-secondary text-capitalize">'.$row['author'].'</div>
                                            <div class="text-secondary">'.date('F',strtotime($row['date'])).' '.date('d',strtotime($row['date'])).', '.date('Y',strtotime($row['date'])).'</div><br>
                                            <p id="abstract1" class="card-text">ABSTRACT:</p>
                                            <p id="abstract11" class="card-text crop-text-3" style="text-indent: 50px;">'.$row['abstract'].'</p>
                                        </div>
                                        <div class="card-footer" style="background-color: #ffffff">
                                             <button type="button" class="btn btn-dark" style="width: 45%; float: right" id="'.$hash.'" data-toggle="modal" data-target="#mymodal" onclick="getInfo(this.id)">Read More <i class="fa fa-angle-double-right"></i></button><p id="1"><i class="fa fa-eye" style="font-size: 110%"></i>Views '.$row['viewCount'].'</p>
                                        </div>
                                    </div>
                                </div>';
                }
                else if($flag==2){
                    $output .= '<div class="col-sm-4" id="cardRecent">
                                    <div class="card p-2 mb-5">
                                        <div class="card-body">
                                            <h5 class="card-title crop-text-3"><strong>'.$row['title'].'</strong></h5>
                                            <div class="text-secondary text-capitalize">'.$row['author'].'</div>
                                            <div class="text-secondary">'.date('F',strtotime($row['date'])).' '.date('d',strtotime($row['date'])).', '.date('Y',strtotime($row['date'])).'</div><br>
                                            <p id="abstract2" class="card-text">ABSTRACT:</p>
                                            <p id="abstract21" class="card-text crop-text-3" style="text-indent: 50px;">'.$row['abstract'].'</p>
                                        </div>
                                        <div class="card-footer" style="background-color: #ffffff">
                                             <button type="button" class="btn btn-dark" style="width: 45%; float: right" id="'.$hash.'" data-toggle="modal" data-target="#mymodal" onclick="getInfo(this.id)">Read More <i class="fa fa-angle-double-right"></i></button><p id="2"><i class="fa fa-eye" style="font-size: 110%"></i>Views '.$row['viewCount'].'</p>
                                        </div>
                                    </div>
                                </div>';
                }
                else if($flag==3){
                    $output .= '<div class="col-sm-4" id="cardRecent">
                                    <div class="card p-2 mb-5">
                                        <div class="card-body">
                                            <h5 class="card-title crop-text-3"><strong>'.$row['title'].'</strong></h5>
                                            <div class="text-secondary text-capitalize">'.$row['author'].'</div>
                                            <div class="text-secondary">'.date('F',strtotime($row['date'])).' '.date('d',strtotime($row['date'])).', '.date('Y',strtotime($row['date'])).'</div><br>
                                            <p id="abstract3" class="card-text">ABSTRACT:</p>
                                            <p id="abstract31" class="card-text crop-text-3" style="text-indent: 50px;">'.$row['abstract'].'</p>
                                        </div>
                                        <div class="card-footer" style="background-color: #ffffff">
                                             <button type="button" class="btn btn-dark" style="width: 45%; float: right" id="'.$hash.'" data-toggle="modal" data-target="#mymodal" onclick="getInfo(this.id)">Read More <i class="fa fa-angle-double-right"></i></button><p id="3"><i class="fa fa-eye" style="font-size: 110%"></i>Views '.$row['viewCount'].'</p>
                                        </div>
                                    </div>
                                </div>';
                }
                else{
                    break;
                }
                $flag+=1;
            }
        }else{
            $output .= '<h4 class="text-center">NO RECENT UPLOAD TO DISPLAY</h4>';
        }
    }
echo json_encode($output);

?>