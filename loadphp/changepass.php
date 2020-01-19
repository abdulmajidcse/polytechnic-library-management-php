<!--edit profile-->
<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
	if(empty($_POST['oldPass']) OR empty($_POST['newPass']) OR empty($_POST['conPass'])){
		$msg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} else{
		$userid = $fm->validation($_POST['userid']);
		$oldPass = $fm->validation($_POST['oldPass']);
		$newPass = $fm->validation($_POST['newPass']);
		$conPass = $fm->validation($_POST['conPass']);

		$userid = mysqli_escape_string($db->conn, $userid);
		$oldPass = sha1(md5(mysqli_escape_string($db->conn, $oldPass)));
		$newPass = sha1(md5(mysqli_escape_string($db->conn, $newPass)));
		$conPass = sha1(md5(mysqli_escape_string($db->conn, $conPass)));
		

		$query = "SELECT password FROM lm_log WHERE id='$userid' AND password='$oldPass'";
		$query = $db->select($query);
		if ($query != false) {
			if ($newPass != $conPass) {
				$msg = "<p class='alert alert-warning'>New password and confirm password no match!</p>";
			} else {
				$query = "UPDATE lm_log SET password='$newPass' WHERE id='$userid'";
				$query = $db->update($query);
				if ($query != false) {
					$msg = "<p class='alert alert-success'>Password changed successfully!</p>";
				} else{
					$msg = "<p class='alert alert-warning'>Password not changed!</p>";
				}
			}
		} else {
			$msg = "<p class='alert alert-warning'>Old password is incorrect!</p>";
		}
	}
}
?><!--end of edit profile-->