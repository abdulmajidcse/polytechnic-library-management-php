<?php
//add new book
if($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['addbook'])){
	if(empty($_POST['bookname']) OR empty($_POST['bookcopies']) OR empty($_POST['catname']) OR empty($_POST['author']) OR empty($_POST['publisher'])){
		$addbookmsg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} else{
		$bookname = $fm->validation($_POST['bookname']);
		$bookcopies = $fm->validation($_POST['bookcopies']);
		$catname = $fm->validation($_POST['catname']);
		$author = $fm->validation($_POST['author']);
		$publisher = $fm->validation($_POST['publisher']);

		$bookname = mysqli_escape_string($db->conn, $bookname);
		$bookcopies = mysqli_escape_string($db->conn, $bookcopies);
		$catname = mysqli_escape_string($db->conn, $catname);
		$author = mysqli_escape_string($db->conn, $author);
		$publisher = mysqli_escape_string($db->conn, $publisher);

		
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


		$query = "SELECT bookname FROM lm_book WHERE bookname='$bookname'";
		$query = $db->select($query);
		if ($query != false) {
			$addbookmsg = "<p class='alert alert-warning'>Book name already exist!</p>";
		} elseif (is_numeric($bookcopies) == FALSE) {
			$addbookmsg = "<p class='alert alert-warning'>Input a valid book copy number!</p>";
		}elseif (empty($image_name)) {
			$addbookmsg = "<p class='alert alert-warning'>Error! Please, select an image.</p>";
		}elseif (in_array($image_ext, $image_permited) == false) {
			$addbookmsg = "<p class='alert alert-warning'>Error! You can upload only :- ".implode(",", $image_permited)."</p>";
		}elseif ($image_size > 5242880){
			$addbookmsg = "<p class='alert alert-warning'>Error! Image size should be less than 5MB.</p>";
		} elseif ($bookcopies < 0) {
			$addbookmsg = "<p class='alert alert-warning'>Number of copies are no less than 0!</p>";
		} else {
			$query = "INSERT INTO lm_book(bookname, image, bookcopies, catname, author, publisher) VALUES('$bookname', '$upload_image', '$bookcopies', '$catname', '$author', '$publisher')";
			$query = $db->insert($query);
			if ($query != false) {
				move_uploaded_file($image_tmp, $upload_image);
				$addbookmsg = "<p class='alert alert-success'>Book added successfully!</p>";
			} else{
				$addbookmsg = "<p class='alert alert-warning'>Book not added!</p>";
			}
		}
	}
}


//edit book
elseif ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['editBookImage'])) {
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
	}elseif ($image_size > 5242880){
		$editimageMsg = "<p class='alert alert-warning'>Error! Image size should be less than 5MB.</p>";
	}else {
		$query = "SELECT image FROM lm_book WHERE id='$id'";
		$query = $db->select($query);
		if ($query != false) {
			while ($result = $query->fetch_assoc()) {
				$image = $result['image'];
			}
			
			$query = "UPDATE lm_book SET image='$upload_image' WHERE id='$id'";
				$query = $db->update($query);
			if ($query != false) {
				unlink($image);
				move_uploaded_file($image_tmp, $upload_image);
				$editimageMsg = "<p class='alert alert-success'>Book image updated successfully!</p>";
			} else {
				$editimageMsg = "<p class='alert alert-success'>Book image not updated!</p>";
			}
			
		} else{
				$editimageMsg = "<p class='alert alert-warning'>Something went wrong!</p>";
		}
	}
}elseif ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['editBookName'])) {
	if(empty($_POST['bookname'])){
		$editBooknameMsg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} else{
		$bookname = $fm->validation($_POST['bookname']);
		$bookname = mysqli_escape_string($db->conn, $bookname);

		$query = "SELECT bookname FROM lm_book WHERE bookname='$bookname'";
		$query = $db->select($query);
		if ($query != false) {
			$editBooknameMsg = "<p class='alert alert-warning'>Book name already exist!</p>";
		} else {
			$query = "SELECT bookname FROM lm_book WHERE id='$id'";
			$query = $db->select($query);
			while ($result = $query->fetch_assoc()) {
				$borrowBookname = $result['bookname'];
			}
			$query = "SELECT bookname FROM lm_borrow WHERE bookname='$borrowBookname'";
			$query = $db->select($query);
			if ($query != false) {
				$editBooknameMsg = "<p class='alert alert-warning'>Opps! Can't update this book. Because this book has in borrow list or return list.</p>";
			} else {
				$query = "UPDATE lm_book SET bookname='$bookname' WHERE id='$id'";
				$query = $db->update($query);
				if ($query != false) {
					$editBooknameMsg = "<p class='alert alert-success'>Book name updated successfully!</p>";
				} else{
						$editBooknameMsg = "<p class='alert alert-warning'>Book name not updated!</p>";
				}
			}
		}
	}
}elseif ($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['editBook'])) {
	$bookcopies = $fm->validation($_POST['bookcopies']);
	$catname = $fm->validation($_POST['catname']);
	$author = $fm->validation($_POST['author']);
	$publisher = $fm->validation($_POST['publisher']);

	$bookcopies = mysqli_escape_string($db->conn, $bookcopies);
	$catname = mysqli_escape_string($db->conn, $catname);
	$author = mysqli_escape_string($db->conn, $author);
	$publisher = mysqli_escape_string($db->conn, $publisher);
	if(empty($_POST['bookcopies']) OR empty($_POST['catname']) OR empty($_POST['author']) OR empty($_POST['publisher'])){
		$editBookMsg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} elseif (is_numeric($bookcopies) == FALSE) {
		$editBookMsg = "<p class='alert alert-warning'>Input a valid book copy number!</p>";
	} elseif ($bookcopies < 0) {
		$editBookMsg = "<p class='alert alert-warning'>Number of copies are no less than 0!</p>";
	} else{

		$query = "UPDATE lm_book SET bookcopies='$bookcopies', catname='$catname', author='$author', publisher='$publisher' WHERE id='$id'";
		$query = $db->update($query);
		if ($query != false) {
			$editBookMsg = "<p class='alert alert-success'>Updated successfully!</p>";
		} else{
				$editBookMsg = "<p class='alert alert-warning'>Not updated!</p>";
		}
	}
}
?>