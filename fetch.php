<?php
include('connect.php');
session_start();
$allCount=0;
if(isset($_POST['view'])){
if($_POST["view"] == 'view')
{
	$update="UPDATE `notif_view` SET `isExpired` = 1 WHERE `isExpired`=0";//get data that status 
	mysqli_query($con, $update);
}
$countView=0;
$countUpload=0;
$view_query = "SELECT * FROM `notif_view` WHERE `isExpired`=0";
$result_view = mysqli_query($con, $view_query);
$countView = mysqli_num_rows($result_view);

$upload_query = "SELECT * FROM `upload` WHERE `isExpired`=0";
$result_upload = mysqli_query($con, $upload_query);
$countUpload = mysqli_num_rows($result_upload);
$allCount=$countView+$countUpload;
$data = array(
   'unseen_views'  => $countView,
   'unseen_uploads'  => $countUpload,
   'all_Counts'  => $allCount
);
echo json_encode($data);
}
?>