<?php
require "DBController.php";
class Auth{
    function getMemberByUsername($username) {
		if(!empty($username)){
        $db_handle = new DBController();
        $query = "Select * from members where member_name = ?";
        $result = $db_handle->runQuery($query, 's', array($username));
        return $result;
		}
		else{
			return "false";
		}
    }
	function getTokenByUsername($username,$expired) {
	    $db_handle = new DBController();
	    $query = "Select * from tbl_token_auth where username = ? and is_expired = ?";
	    $result = $db_handle->runQuery($query, 'si', array($username, $expired));
	    return $result;
    }
    
    function markAsExpired($tokenId) {
        $db_handle = new DBController();
        $query = "UPDATE tbl_token_auth SET is_expired = ? WHERE id = ?";
        $expired = 1;
        $result = $db_handle->update($query, 'ii', array($expired, $tokenId));
        return $result;
    }
    
    function insertToken($username, $random_password_hash, $random_selector_hash, $expiry_date) {
        $db_handle = new DBController();
        $query = "INSERT INTO tbl_token_auth (username, password_hash, selector_hash, expiry_date) values (?, ?, ?,?)";
        $result = $db_handle->insert($query, 'ssss', array($username, $random_password_hash, $random_selector_hash, $expiry_date));
        return $result;
    }
	
	function insertActive($activeUsername,$activePassword){
		$db_handle = new DBController();
        $query = "INSERT INTO active_accounts (activeusername, activepassword) values (?, ?)";
        $result = $db_handle->insert($query, 'ss', array($activeUsername, $activePassword));
        return $result;
	}
    
	function dropActive($dropUsername,$dropPassword){
		$db_handle = new DBController();
        $query = "INSERT INTO active_accounts (activeusername, activepassword) values (?, ?)";
        $result = $db_handle->insert($query, 'ss', array($activeUsername, $activePassword));
        return $result;
	}
	function selectUsername() {
        $db_handle = new DBController();
        $query = "Select * from active_accounts";
        $result = $db_handle->selectUsernameQuery($query);
        echo $result;
    }
	
	function selectResearch(){
		$db_handle = new DBController();
		$query="SELECT COUNT(*) AS mycount FROM upload";
		$result = $db_handle->selectResearchQuery($query);
		
		echo "Number of Research $result";
        
	}
	function selectDownloads(){
		$db_handle = new DBController();
		$query="SELECT COUNT(audit_trail.Action) AS mycount FROM `upload` JOIN audit_trail ON audit_trail.accountNO = upload.accountNo WHERE audit_trail.Action = 'download'";
		$result = $db_handle->selectDownloadQuery($query);
		
		echo "All Downloads $result";
        
	}
	function selectSsh(){
		$db_handle = new DBController();
		$query="SELECT * FROM `upload` WHERE Cluster='Social Science and Humanities'";
		$result = $db_handle->selectSshQuery($query);
		$index=0;
		while($row = mysqli_fetch_array($result)){
            $rnumber = $row['researchNo'];
            $rtitle = $row['research_title'];
			$name = $row['FName'].' '.$row['Lname'];
            $cluster = $row['Cluster'];
            $college = $row['college'];
            $date = $row['date'];       

            echo "<tr>";
            echo "<th scope='row'>$rnumber</th>";
            echo "<td><button type='button' id='$rnumber' class='btn btn-primary' data-toggle='modal' data-target='#pdfModal' >$rtitle</button></td>";
            echo "<td>$name</td>";       
            echo "<td>$cluster</td>";
            echo "<td>$college</td>";
            echo "<td>$date</td>";        
            echo "</tr>";
			$index+=1;
        }
	}
    function selectBusiness(){
        $db_handle = new DBController();
        $query="SELECT upload.researchNo, upload.research_title, CONCAT (upload.FName,' ', upload.Lname) AS Name, upload.Cluster, upload.date FROM upload WHERE Cluster='Business and Industry'";
        $result = $db_handle->selectBusinessQuery($query);
        while($row = mysqli_fetch_assoc($result)){
            $rnumber = $row['researchNo'];
            $rtitle = $row['research_title'];
            $name = $row["Name"];
            $cluster = $row['Cluster'];
            $date = $row['date'];       

            echo "<tr>";
            echo "<th scope='row'>$rnumber</th>";
            echo "<td><button type='button' class='btn btn-primary' data-toggle='modal' data-target='#exampleModalLong' onclick='getPdf()'>PDF File</button></td>";
            echo "<td>$rtitle</td>";
            echo "<td>$name</td>";       
            echo "<td>$cluster</td>";
            echo "<td>$date</td>";        
            echo "</tr>";
        }   
    }
	function getName(){
		$db_handle = new DBController();
        $query = "Select * from active_accounts where firstname = ?";
        $result = $db_handle->selectPassQuery($query);
        echo $result;
	}
	function selectPass() {
        $db_handle = new DBController();
        $query = "Select * from active_accounts";
        $result = $db_handle->selectPassQuery($query);
        echo $result;
    }
    function update($query) {
        mysqli_query($this->conn,$query);
    }
 
	//function to get the researchNo
	function getResearchNo(){
		include "connect.php";
		$date = new DateTime("now", new DateTimeZone('Asia/Manila') );
		$fa= $date->format('Ymd');

		$input = 1;

		$sql = "SELECT `researchNo` FROM `uploaddata` ORDER BY id DESC LIMIT 1";
		$result = mysqli_query($con,$sql);
		$rowsCount=mysqli_num_rows($result);
		
		if ($result && $rowsCount > 0) {
			$row = mysqli_fetch_assoc($result);
			$y=$row['researchNo'];
			list($rn, $num) = explode('-',$y);//split date and research number
			if($fa==$rn){
				if($num!='99'){
					$changeType=intval($num);
					$changeType+=1;
					$number = str_pad($changeType, 2, "0", STR_PAD_LEFT);
					$researchNum=$fa."-".$number;
					echo $researchNum;
				}
				else{
					echo 'limit na ito';
				}
			}
			else{
				$input = 1;
				$number = str_pad($input, 2, "0", STR_PAD_LEFT);
				$researchNum=$fa."-".$number;
				echo $researchNum;
			}
		}
		else{
			$input = 1;
			$number = str_pad($input, 2, "0", STR_PAD_LEFT);
			$researchNum=$fa."-".$number;
			echo $researchNum;
		}
	}
    function selectTitle(){
        $x=0;
        $db_handle= new DBController();
        $query = "SELECT * FROM upload WHERE Cluster='Social Science and Humanities'";
        $result = $db_handle->selectTitleQuery($query);
        while($row = mysqli_fetch_assoc($result)){
            $title[]=$row['research_title'];
            $researchNo[]=$row['researchNo'];
        }
        $files = scandir("pdf's");
        rsort($files); // this does the sorting
        foreach($files as $file)
        {   
            if($file != '.' && $file != '..'){
                $data[]=$file;    
                $without_ext[]= basename($data[$x],'.pdf');
            }
            $x++;
        }
        $length = count($data);
        for ($i=0;$i<$length;$i++){
            if ($without_ext[$i]==$researchNo[$i]){
                echo $title[$i];
            }
        }
    }
}
?>