<?php
class DBController {
	private $host = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "ovpretdb";
	private $conn;
	
    function __construct() {
        $this->conn = $this->connectDB();
	}	
	
	function connectDB() {
		$conn = mysqli_connect($this->host,$this->user,$this->password,$this->database);
		return $conn;
	}
	
    function runBaseQuery($query) {
                $result = mysqli_query($this->conn,$query);
                while($row=mysqli_fetch_assoc($result)) {
                $resultset[] = $row;
                }		
                if(!empty($resultset))
                return $resultset;
    }
    function selectUsernameQuery($query){
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
            $username[] = $row['activeusername'];
        }		
        if(!empty($username))
			return $username[0];
	}
	function selectPassQuery($query){
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
            $pass[] = $row['activepassword'];
        }		
        if(!empty($pass))
			return md5($pass[0]);
	}
    function selectRNQuery($query){
		$result = mysqli_query($this->conn,$query);
		$row = mysqli_fetch_assoc($result);
		return $row['researchNo'];
	}
    
    function runQuery($query, $param_type, $param_value_array) {
        
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
        $result = $sql->get_result();
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }
        
        if(!empty($resultset)) {
            return $resultset;
        }
    }
    
    function bindQueryParams($sql, $param_type, $param_value_array) {
        $param_value_reference[] = & $param_type;
        for($i=0; $i<count($param_value_array); $i++) {
            $param_value_reference[] = & $param_value_array[$i];
        }
        call_user_func_array(array(
            $sql,
            'bind_param'
        ), $param_value_reference);
    }
    function selectResearchQuery($query){
		$result = mysqli_query($this->conn,$query);
		$res =mysqli_fetch_object($result);
        $count = $res->mycount;
		return $count;
	}
	
	function selectUploadQuery($query){
		$result = mysqli_query($this->conn,$query);
		$res =mysqli_fetch_object($result);
        $count = $res->mycount;
		return $count;
	}
	
	function selectDownloadQuery($query){
		$result = mysqli_query($this->conn,$query);
		$res =mysqli_fetch_object($result);
        $count = $res->mycount;
		return $count;
	}
	function selectSshQuery($query){
		$result = mysqli_query($this->conn,$query);
		$resultCheck = mysqli_num_rows($result);
		if ($resultCheck > 0){
		return $result;
		}
	}
    function insert($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
    }
    
    function update($query, $param_type, $param_value_array) {
        $sql = $this->conn->prepare($query);
        $this->bindQueryParams($sql, $param_type, $param_value_array);
        $sql->execute();
    }
}
?>