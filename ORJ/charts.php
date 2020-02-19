<?php
include('connect.php');

$result1 = mysqli_query($con,"SELECT * FROM `upload` WHERE `acronym`='CAFA'");
$counts1= mysqli_num_rows($result1);
$result2 = mysqli_query($con,"SELECT * FROM `upload` WHERE `acronym`='CAL'");
$counts2= mysqli_num_rows($result2);
$result3= mysqli_query($con,"SELECT * FROM `upload` WHERE `acronym`='CBA'");
$counts3= mysqli_num_rows($result3);
$result4= mysqli_query($con,"SELECT * FROM `upload` WHERE `acronym`='CCJE'");
$counts4= mysqli_num_rows($result4);
$result5= mysqli_query($con,"SELECT * FROM `upload` WHERE `acronym`='CHTM'");
$counts5= mysqli_num_rows($result5);
$result6= mysqli_query($con,"SELECT * FROM `upload` WHERE `acronym`='CICT'");
$counts6= mysqli_num_rows($result6);
$result7= mysqli_query($con,"SELECT * FROM `upload` WHERE `acronym`='CIT'");
$counts7= mysqli_num_rows($result7);
$result8= mysqli_query($con,"SELECT * FROM `upload` WHERE `acronym`='CLaw'");
$counts8= mysqli_num_rows($result8);
$result9= mysqli_query($con,"SELECT * FROM `upload` WHERE `acronym`='CN'");
$counts9= mysqli_num_rows($result9);
$result10= mysqli_query($con,"SELECT * FROM `upload` WHERE `acronym`='COE'");
$counts10= mysqli_num_rows($result10);
$result11= mysqli_query($con,"SELECT * FROM `upload` WHERE `acronym`='COED'");
$counts11= mysqli_num_rows($result11);
$result12= mysqli_query($con,"SELECT * FROM `upload` WHERE `acronym`='CS'");
$counts12= mysqli_num_rows($result12);
$result13= mysqli_query($con,"SELECT * FROM `upload` WHERE `acronym`='CSER'");
$counts13= mysqli_num_rows($result13);
$result14= mysqli_query($con,"SELECT * FROM `upload` WHERE `acronym`='CSSP'");
$counts14= mysqli_num_rows($result14);
$result15= mysqli_query($con,"SELECT * FROM `upload` WHERE `acronym`='GS'");
$counts15= mysqli_num_rows($result15);
$data = array(
   'count1' => $count1,
   'count2'  => $count2,
   'count3'  => $count3,
   'count4'  => $count4,
   'count5' => $count5,
   'count6' => $count6,
   'count7'  => $count7,
   'count8'  => $count8,
   'count9'  => $count9,
   'count10' => $count10,
   'count11' => $count11,
   'count12'  => $count12,
   'count13'  => $count13,
   'count14'  => $count14,
   'count15' => $count15
);
echo json_encode($data);
?>