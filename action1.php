<?php
$connect=mysqli_connect("localhost","root","","ovpretdb");
$request = mysqli_real_escape_string($connect,$_POST["query"]);
$query = "SELECT * FROM uploaddata WHERE title LIKE '%".$request."%' OR author LIKE '%".$request."%' OR college LIKE '%".$request."%'OR date LIKE '%".$request."%' OR agenda LIKE '%".$request."%'";

$result = mysqli_query($connect, $query);

$data = array();
if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_array($result)){
        $data[] = $row['title'];
        $data[] = $row['author'];
        $data[] = $row['college'];
        $data[] = $row['agenda'];
        break;
    }
    echo json_encode($data);
}
?>