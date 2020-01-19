<?php

class Database{
	
	public $db_host = DB_HOST;
	public $db_user = DB_USER;
	public $db_pass = DB_PASS;
	public $db_name = DB_NAME;
	public $conn;

	public function __construct(){
		$this->connectDB();
	}

	private function connectDB(){
		$this->conn = new mysqli("$this->db_host", "$this->db_user", "$this->db_pass", "$this->db_name");
		if (!$this->conn) {
			echo "Connection failed!" . $this->conn->connect_error;
		}
	}

	public function select($query){
		$result = $this->conn->query($query) or die($this->conn->error);
		if ($result->num_rows > 0) {
			return $result;
		} else {
			return false;
		}
	}

	public function insert($query){
		$result = $this->conn->query($query) or die($this->conn->error);
		if ($result) {
			return $result;
		} else {
			return false;
		}
	}

	public function update($query){
		$result = $this->conn->query($query) or die($this->conn->error);
		if ($result) {
			return $result;
		} else {
			return false;
		}
	}

	public function delete($query){
		$result = $this->conn->query($query) or die($this->conn->error);
		if ($result) {
			return $result;
		} else {
			return false;
		}
	}
}
?>