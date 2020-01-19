<!--login form validation-->
<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(empty($_POST['uname']) OR empty($_POST['password'])){
		$error = "<p class='alert alert-warning'>Please, write your username and password!</p>";
	} else{
		$uname = $fm->validation($_POST['uname']);
		$password = $fm->validation($_POST['password']);
		
		$uname = mysqli_escape_string($db->conn, $uname);
		$password = sha1(md5(mysqli_escape_string($db->conn, $password)));
		$query = "SELECT * FROM lm_log WHERE uname='$uname' AND password='$password' LIMIT 1";
		$query = $db->select($query);
		if ($query != false) {
			$result = mysqli_num_rows($query);
			if ($result > 0) {
				while ($row = $query->fetch_assoc()) {
					Session::set("login", true);
					Session::set("userid", $row['id']);
				}
			header("location:index.php");
				
			}
		} else{
			$error = "<p class='alert alert-warning'>Username or password are incorrect!</p>";
		}
	}
}
?><!--end of login form validation-->