<?php $db= new mysqli('localhost','root','','ovpretdb'); 
extract($_POST);
$user_id=$db->real_escape_string($id);
$status=$db->real_escape_string($status);
$sql=$db->query("UPDATE users_rc SET status='$status' WHERE id='$id'");
echo $sql;
//echo 1;
?>
