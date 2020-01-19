
<?php
//add student user
if($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['addstd'])){
	if(empty($_POST['fname']) OR empty($_POST['sname']) OR empty($_POST['uname']) OR empty($_POST['mobile']) OR empty($_POST['address']) OR empty($_POST['department']) OR empty($_POST['semester']) OR empty($_POST['shift']) OR empty($_POST['roll']) OR empty($_POST['lcardno'])){
		$addstdmsg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} else{
		$fname = $fm->validation($_POST['fname']);
		$sname = $fm->validation($_POST['sname']);
		$uname = $fm->validation($_POST['uname']);
		$mobile = $fm->validation($_POST['mobile']);
		$address = $fm->validation($_POST['address']);
		$department = $fm->validation($_POST['department']);
		$semester = $fm->validation($_POST['semester']);
		$shift = $fm->validation($_POST['shift']);
		$roll = $fm->validation($_POST['roll']);
		$lcardno = $fm->validation($_POST['lcardno']);

		$fname = mysqli_escape_string($db->conn, $fname);
		$sname = mysqli_escape_string($db->conn, $sname);
		$uname = mysqli_escape_string($db->conn, $uname);
		$mobile = mysqli_escape_string($db->conn, $mobile);
		$address = mysqli_escape_string($db->conn, $address);
		$department = mysqli_escape_string($db->conn, $department);
		$semester = mysqli_escape_string($db->conn, $semester);
		$shift = mysqli_escape_string($db->conn, $shift);
		$roll = mysqli_escape_string($db->conn, $roll);
		$lcardno = mysqli_escape_string($db->conn, $lcardno);

		//image upload
		$image_permited = array('jpg', 'jpeg', 'png',);
		$image_name = $_FILES['image']['name'];
		$image_size = $_FILES['image']['size'];
		$image_tmp = $_FILES['image']['tmp_name'];

		$div = explode(".", $image_name);
		$image_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10) . '.' . $image_ext;
		$upload_image = "images/".$unique_image;
		//end of image upload


		$person = "student";
		$mvalid = strlen($mobile);
		$mdigitvalid = substr($mobile, 0, 2);

		$unamecheck = "SELECT uname FROM lm_user WHERE uname='$uname'";
		$unamecheck = $db->select($unamecheck);

		$mobilecheck = "SELECT mobile FROM lm_user WHERE mobile='$mobile'";
		$mobilecheck = $db->select($mobilecheck);

		$rollcheck = "SELECT roll FROM lm_user WHERE roll='$roll'";
		$rollcheck = $db->select($rollcheck);

		$lcardnocheck = "SELECT lcardno FROM lm_user WHERE lcardno='$lcardno'";
		$lcardnocheck = $db->select($lcardnocheck);

		if ($unamecheck != false) {
			$addstdmsg = "<p class='alert alert-warning'>Username already exist!</p>";
		}elseif ($mobilecheck != false) {
			$addstdmsg = "<p class='alert alert-warning'>Mobile number already exist!</p>";
		}elseif ($rollcheck != false) {
			$addstdmsg = "<p class='alert alert-warning'>Roll number already exist!</p>";
		}elseif ($lcardnocheck != false) {
			$addstdmsg = "<p class='alert alert-warning'>Library card number already exist!</p>";
		} elseif ($mvalid != 11 OR $mdigitvalid != '01' OR is_numeric($mobile) == FALSE) {
			$addstdmsg = "<p class='alert alert-warning'>Mobile number is incorrect!</p>";
		} elseif ($roll < 1 OR is_numeric($roll) == FALSE) {
			$addstdmsg = "<p class='alert alert-warning'>Invalid roll number!</p>";
		} elseif ($lcardno < 1 OR is_numeric($lcardno) == FALSE) {
			$addstdmsg = "<p class='alert alert-warning'>Invalid library card number!</p>";
		}elseif (empty($image_name)) {
			$addstdmsg = "<p class='alert alert-warning'>Error! Please, select an image.</p>";
		}elseif (in_array($image_ext, $image_permited) == false) {
			$addstdmsg = "<p class='alert alert-warning'>Error! You can upload only :- ".implode(",", $image_permited)."</p>";
		}elseif ($image_size > 5242880) {
			$addstdmsg = "<p class='alert alert-warning'>Error! Image size should be less than 5MB.</p>";
		} else {
			$query = "INSERT INTO lm_user(fname, sname, uname, mobile, address, department, semester, shift, roll, lcardno, image, person) VALUES('$fname', '$sname', '$uname', '$mobile', '$address', '$department', '$semester', '$shift', '$roll', $lcardno, '$upload_image', '$person')";
			$query = $db->insert($query);
			if ($query != false) {
				move_uploaded_file($image_tmp, $upload_image);
				$addstdmsg = "<p class='alert alert-success'>User added successfully!</p>";
			} else{
				$addstdmsg = "<p class='alert alert-warning'>User not added!</p>";
			}
		}
	}
}//end of add student user

//add staff user
elseif($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['addstaff'])){
	if(empty($_POST['fname']) OR empty($_POST['sname']) OR empty($_POST['uname']) OR empty($_POST['mobile']) OR empty($_POST['address']) OR empty($_POST['department']) OR empty($_POST['designation'])){
		$addstaffmsg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} else{
		$fname = $fm->validation($_POST['fname']);
		$sname = $fm->validation($_POST['sname']);
		$uname = $fm->validation($_POST['uname']);
		$mobile = $fm->validation($_POST['mobile']);
		$address = $fm->validation($_POST['address']);
		$department = $fm->validation($_POST['department']);
		$designation = $fm->validation($_POST['designation']);

		$fname = mysqli_escape_string($db->conn, $fname);
		$sname = mysqli_escape_string($db->conn, $sname);
		$uname = mysqli_escape_string($db->conn, $uname);
		$mobile = mysqli_escape_string($db->conn, $mobile);
		$address = mysqli_escape_string($db->conn, $address);
		$department = mysqli_escape_string($db->conn, $department);
		$designation = mysqli_escape_string($db->conn, $designation);

		//image upload
		$image_permited = array('jpg', 'jpeg', 'png',);
		$image_name = $_FILES['image']['name'];
		$image_size = $_FILES['image']['size'];
		$image_tmp = $_FILES['image']['tmp_name'];

		$div = explode(".", $image_name);
		$image_ext = strtolower(end($div));
		$unique_image = substr(md5(time()), 0, 10) . '.' . $image_ext;
		$upload_image = "images/".$unique_image;
		//end of image upload

		$person = "staff";
		$mvalid = strlen($mobile);
		$mdigitvalid = substr($mobile, 0, 2);

		$unamecheck = "SELECT uname FROM lm_user WHERE uname='$uname'";
		$unamecheck = $db->select($unamecheck);

		$mobilecheck = "SELECT mobile FROM lm_user WHERE mobile='$mobile'";
		$mobilecheck = $db->select($mobilecheck);

		if ($unamecheck != false) {
			$addstaffmsg = "<p class='alert alert-warning'>Username already exist!</p>";
		}elseif ($mobilecheck != false) {
			$addstaffmsg = "<p class='alert alert-warning'>Mobile number already exist!</p>";
		} elseif ($mvalid != 11 OR $mdigitvalid != '01' OR is_numeric($mobile) == FALSE) {
			$addstaffmsg = "<p class='alert alert-warning'>Mobile number is incorrect!</p>";
		}elseif (empty($image_name)) {
			$addstaffmsg = "<p class='alert alert-warning'>Error! Please, select an image.</p>";
		}elseif ($image_size > 5242880) {
			$addstaffmsg = "<p class='alert alert-warning'>Error! Image size should be less than 5MB.</p>";
		}elseif (in_array($image_ext, $image_permited) == false) {
			$addstaffmsg = "<p class='alert alert-warning'>Error! You can upload only :- ".implode(",", $image_permited)."</p>";
		} else {
			$query = "INSERT INTO lm_user(fname, sname, uname, mobile, address, department, designation, image, person) VALUES('$fname', '$sname', '$uname', '$mobile', '$address', '$department', '$designation', '$upload_image', '$person')";
			$query = $db->insert($query);
			if ($query != false) {
				move_uploaded_file($image_tmp, $upload_image);
				$addstaffmsg = "<p class='alert alert-success'>User added successfully!</p>";
			} else{
				$addstaffmsg = "<p class='alert alert-warning'>User not added!</p>";
			}
		}
	}
}//end of add staff user
//edit student photo
elseif ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['editUserStdImage'])) {
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
		$editimageMsg = "<p class='alert alert-warning'>Error! Please, select an image.</p>";
	}elseif (in_array($image_ext, $image_permited) == false) {
		$editimageMsg = "<p class='alert alert-warning'>Error! You can upload only :- ".implode(",", $image_permited)."</p>";
	}elseif ($image_size > 5242880) {
		$editimageMsg = "<p class='alert alert-warning'>Error! Image size should be less than 5MB.</p>";
	}else {
		$query = "SELECT image FROM lm_user WHERE id='$id'";
		$query = $db->select($query);
		if ($query != false) {
			while ($result = $query->fetch_assoc()) {
				$image = $result['image'];
			}
			
			$query = "UPDATE lm_user SET image='$upload_image' WHERE id='$id'";
				$query = $db->update($query);
			if ($query != false) {
				unlink($image);
				move_uploaded_file($image_tmp, $upload_image);
				$editimageMsg = "<p class='alert alert-success'>Photo updated successfully!</p>";
			} else {
				$editimageMsg = "<p class='alert alert-success'>Photo not updated!</p>";
			}
			
		} else{
				$editimageMsg = "<p class='alert alert-warning'>Something went wrong!</p>";
		}
	}
}//end of edit student photo
//edit student user (Username)
elseif ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['edituname'])) {
 	if(empty($_POST['uname'])){
		$editunameMsg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} else{
		$uname = $fm->validation($_POST['uname']);

		$uname = mysqli_escape_string($db->conn, $uname);

		$query = "SELECT uname FROM lm_user WHERE uname='$uname'";
		$query = $db->select($query);

		$queryuser = "SELECT uname FROM lm_user WHERE id='$id'";
		$queryuser = $db->select($queryuser);
		while ($result = $queryuser->fetch_assoc()) {
			$unameOrigin = $result['uname'];
		}

		$queryborrow = "SELECT uname FROM lm_borrow WHERE uname='$unameOrigin'";
			$queryborrow = $db->select($queryborrow);

		if ($query != false) {
			$editunameMsg = "<p class='alert alert-warning'>Username already exist!</p>";
		} elseif ($queryborrow != false) {
			$editunameMsg = "<p class='alert alert-warning'>Can't update username! Because username has in borrow list or return list.</p>";
		} else {
			
			$query = "UPDATE lm_user SET uname='$uname' WHERE id='$id'";
			$query = $db->update($query);
			if ($query != false) {
				$editunameMsg = "<p class='alert alert-success'>Username updated!</p>";
			} else {
				$editunameMsg = "<p class='alert alert-warning'>Username not updated!</p>";
			}
		}
	}
 }
 //edit student user (Mobile number)
elseif ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['editmobile'])) {
 	if(empty($_POST['mobile'])){
		$editmobileMsg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} else{
		$mobile = $fm->validation($_POST['mobile']);

		$mobile = mysqli_escape_string($db->conn, $mobile);

		$mvalid = strlen($mobile);
		$mdigitvalid = substr($mobile, 0, 2);

		$query = "SELECT mobile FROM lm_user WHERE mobile='$mobile'";
		$query = $db->select($query);

		if ($query != false) {
			$editmobileMsg = "<p class='alert alert-warning'>Mobile number already exist!</p>";
		}elseif ($mvalid != 11 OR $mdigitvalid != '01' OR is_numeric($mobile) == FALSE) {
			$editmobileMsg = "<p class='alert alert-warning'>Mobile number is incorrect!</p>";
		} else {
			
			$query = "UPDATE lm_user SET mobile='$mobile' WHERE id='$id'";
			$query = $db->update($query);
			if ($query != false) {
				$editmobileMsg = "<p class='alert alert-success'>Mobile number updated!</p>";
			} else {
				$editmobileMsg = "<p class='alert alert-warning'>Mobile number not updated!</p>";
			}
		}
	}
 }
  //edit student user (roll number)
elseif ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['editroll'])) {
 	if(empty($_POST['roll'])){
		$editrollMsg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} else{
		$roll = $fm->validation($_POST['roll']);

		$roll = mysqli_escape_string($db->conn, $roll);

		$query = "SELECT roll FROM lm_user WHERE roll='$roll'";
		$query = $db->select($query);

		if ($query != false) {
			$editrollMsg = "<p class='alert alert-warning'>Roll number already exist!</p>";
		}elseif ($roll < 1 OR is_numeric($roll) == FALSE) {
			$editrollMsg = "<p class='alert alert-warning'>Invalid roll number!</p>";
		} else {
			$query = "UPDATE lm_user SET roll='$roll' WHERE id='$id'";
			$query = $db->update($query);
			if ($query != false) {
				$editrollMsg = "<p class='alert alert-success'>Roll number updated!</p>";
			} else {
				$editrollMsg = "<p class='alert alert-warning'>roll number not updated!</p>";
			}
		}
	}
 }
//edit student user
 elseif ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['editStd'])) {
	if(empty($_POST['fname']) OR empty($_POST['sname']) OR empty($_POST['address']) OR empty($_POST['department']) OR empty($_POST['semester']) OR empty($_POST['shift'])){
		$editStdMsg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} else{
		$fname = $fm->validation($_POST['fname']);
		$sname = $fm->validation($_POST['sname']);
		$address = $fm->validation($_POST['address']);
		$department = $fm->validation($_POST['department']);
		$semester = $fm->validation($_POST['semester']);
		$shift = $fm->validation($_POST['shift']);

		$fname = mysqli_escape_string($db->conn, $fname);
		$sname = mysqli_escape_string($db->conn, $sname);
		$address = mysqli_escape_string($db->conn, $address);
		$department = mysqli_escape_string($db->conn, $department);
		$semester = mysqli_escape_string($db->conn, $semester);
		$shift = mysqli_escape_string($db->conn, $shift);

		$query = "UPDATE lm_user SET fname='$fname', sname='$sname', address='$address', department='$department', semester='$semester', shift='$shift' WHERE id='$id'";
		$query = $db->update($query);
		if ($query != false) {
			$editStdMsg = "<p class='alert alert-success'>User data updated successfully!</p>";
		} else{
				$editStdMsg = "<p class='alert alert-warning'>User data not updated!</p>";
		}
	}
}
//edit staff photo
elseif ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['editUserStaffImage'])) {
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
		$editimageMsg = "<p class='alert alert-warning'>Error! Please, select an image.</p>";
	}elseif (in_array($image_ext, $image_permited) == false) {
		$editimageMsg = "<p class='alert alert-warning'>Error! You can upload only :- ".implode(",", $image_permited)."</p>";
	}elseif ($image_size > 5242880) {
		$editimageMsg = "<p class='alert alert-warning'>Error! Image size should be less than 5MB.</p>";
	}else {
		$query = "SELECT image FROM lm_user WHERE id='$id'";
		$query = $db->select($query);
		if ($query != false) {
			while ($result = $query->fetch_assoc()) {
				$image = $result['image'];
			}
			
			$query = "UPDATE lm_user SET image='$upload_image' WHERE id='$id'";
				$query = $db->update($query);
			if ($query != false) {
				unlink($image);
				move_uploaded_file($image_tmp, $upload_image);
				$editimageMsg = "<p class='alert alert-success'>Photo updated successfully!</p>";
			} else {
				$editimageMsg = "<p class='alert alert-success'>Photo not updated!</p>";
			}
			
		} else{
				$editimageMsg = "<p class='alert alert-warning'>Something went wrong!</p>";
		}
	}
}//end of edit staff photo
//edit staff user (Username)
elseif ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['editunamestaff'])) {
 	if(empty($_POST['uname'])){
		$editunameMsg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} else{
		$uname = $fm->validation($_POST['uname']);

		$uname = mysqli_escape_string($db->conn, $uname);

		$query = "SELECT uname FROM lm_user WHERE uname='$uname'";
		$query = $db->select($query);

		$queryuser = "SELECT uname FROM lm_user WHERE id='$id'";
		$queryuser = $db->select($queryuser);
		while ($result = $queryuser->fetch_assoc()) {
			$unameOrigin = $result['uname'];
		}

		$queryborrow = "SELECT uname FROM lm_borrow WHERE uname='$unameOrigin'";
			$queryborrow = $db->select($queryborrow);

		if ($query != false) {
			$editunameMsg = "<p class='alert alert-warning'>Username already exist!</p>";
		} elseif ($queryborrow != false) {
			$editunameMsg = "<p class='alert alert-warning'>Can't update username! Because username has in borrow list or return list.</p>";
		} else {
			
			$query = "UPDATE lm_user SET uname='$uname' WHERE id='$id'";
			$query = $db->update($query);
			if ($query != false) {
				$editunameMsg = "<p class='alert alert-success'>Username updated!</p>";
			} else {
				$editunameMsg = "<p class='alert alert-warning'>Username not updated!</p>";
			}
		}
	}
 }
 //edit staff user (Mobile number)
elseif ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['editmobilestaff'])) {
 	if(empty($_POST['mobile'])){
		$editmobileMsg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} else{
		$mobile = $fm->validation($_POST['mobile']);

		$mobile = mysqli_escape_string($db->conn, $mobile);

		$mvalid = strlen($mobile);
		$mdigitvalid = substr($mobile, 0, 2);

		$query = "SELECT mobile FROM lm_user WHERE mobile='$mobile'";
		$query = $db->select($query);

		if ($query != false) {
			$editmobileMsg = "<p class='alert alert-warning'>Mobile number already exist!</p>";
		}elseif ($mvalid != 11 OR $mdigitvalid != '01' OR is_numeric($mobile) == FALSE) {
			$editmobileMsg = "<p class='alert alert-warning'>Mobile number is incorrect!</p>";
		} else {
			
			$query = "UPDATE lm_user SET mobile='$mobile' WHERE id='$id'";
			$query = $db->update($query);
			if ($query != false) {
				$editmobileMsg = "<p class='alert alert-success'>Mobile number updated!</p>";
			} else {
				$editmobileMsg = "<p class='alert alert-warning'>Mobile number not updated!</p>";
			}
		}
	}
 }
//edit staff user
elseif ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['editStaff'])) {
	if(empty($_POST['fname']) OR empty($_POST['sname']) OR empty($_POST['address']) OR empty($_POST['department']) OR empty($_POST['designation'])){
		$editStaffMsg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} else{
		$fname = $fm->validation($_POST['fname']);
		$sname = $fm->validation($_POST['sname']);
		$address = $fm->validation($_POST['address']);
		$department = $fm->validation($_POST['department']);
		$designation = $fm->validation($_POST['designation']);

		$fname = mysqli_escape_string($db->conn, $fname);
		$sname = mysqli_escape_string($db->conn, $sname);
		$address = mysqli_escape_string($db->conn, $address);
		$department = mysqli_escape_string($db->conn, $department);
		$designation = mysqli_escape_string($db->conn, $designation);

		$query = "UPDATE lm_user SET fname='$fname', sname='$sname', address='$address', department='$department', designation='$designation' WHERE id='$id'";
		$query = $db->update($query);
		if ($query != false) {
			$editStaffMsg = "<p class='alert alert-success'>User data updated successfully!</p>";
		} else{
				$editStaffMsg = "<p class='alert alert-warning'>User data not updated!</p>";
		}
	}
}
?>