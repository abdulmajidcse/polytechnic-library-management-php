<!--edit profile-->
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['savelogimage'])) {
	$userid = $fm->validation($_POST['userid']);
	$userid = mysqli_escape_string($db->conn, $userid);
	//image upload
	$image_permited = array('jpg', 'jpeg', 'png',);
	$image_name = $_FILES['image']['name'];
	$image_tmp = $_FILES['image']['tmp_name'];
	$image_size = $_FILES['image']['size'];

	$div = explode(".", $image_name);
	$image_ext = strtolower(end($div));
	$unique_image = substr(md5(time()), 0, 10) . '.' . $image_ext;
	$upload_image = "images/".$unique_image;
	//end of image upload

	if (empty($image_name)) {
		$savelogimagemsg = "<p class='alert alert-warning'>Error! Please, select an image.</p>";
	}elseif (in_array($image_ext, $image_permited) == false) {
		$savelogimagemsg = "<p class='alert alert-warning'>Error! You can upload only :- ".implode(",", $image_permited)."</p>";
	}elseif ($image_size > 5242880){
		$savelogimagemsg = "<p class='alert alert-warning'>Error! Image size should be less than 5MB.</p>";
	}else {
		$query = "SELECT image FROM lm_log WHERE id='$userid'";
		$query = $db->select($query);
		if ($query != false) {
			while ($result = $query->fetch_assoc()) {
				$image = $result['image'];
			}
			
			$query = "UPDATE lm_log SET image='$upload_image' WHERE id='$userid'";
				$query = $db->update($query);
			if ($query != false) {
				unlink($image);
				move_uploaded_file($image_tmp, $upload_image);
				$savelogimagemsg = "<p class='alert alert-success'>Photo updated successfully!</p>";
			} else {
				$savelogimagemsg = "<p class='alert alert-success'>Photo not updated!</p>";
			}
			
		} else{
				$savelogimagemsg = "<p class='alert alert-warning'>Something went wrong!</p>";
		}
	}
}
elseif($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['savedata'])){
	if(empty($_POST['fname']) OR empty($_POST['sname']) OR empty($_POST['uname']) OR empty($_POST['email'])){
		$msg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} else{
		$userid = $fm->validation($_POST['userid']);
		$fname = $fm->validation($_POST['fname']);
		$sname = $fm->validation($_POST['sname']);
		$uname = $fm->validation($_POST['uname']);
		$email = $fm->validation($_POST['email']);

		$userid = mysqli_escape_string($db->conn, $userid);
		$fname = mysqli_escape_string($db->conn, $fname);
		$sname = mysqli_escape_string($db->conn, $sname);
		$uname = mysqli_escape_string($db->conn, $uname);
		$email = mysqli_escape_string($db->conn, $email);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$msg = "<p class='alert alert-warning'>Invalid e-mail address!</p>";
		} else {
			$query = "UPDATE lm_log SET fname='$fname', sname='$sname', uname='$uname', email='$email' WHERE id='$userid'";
			$query = $db->update($query);
			if ($query != false) {
				$msg = "<p class='alert alert-success'>Profile updated successfully!</p>";
			} else{
				$msg = "<p class='alert alert-warning'>Profile not updated!</p>";
			}
		}
	}
}
?><!--end of edit profile-->