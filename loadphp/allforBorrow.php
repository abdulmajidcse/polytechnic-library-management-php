<?php
include("../config/config.php");
include("../lib/Database.php");

$db = new Database();
//select all username by select person
if (isset($_POST['person']) && $_POST['person'] != NULL) {

	$person = $_POST['person'];
	if ($person != NULL) {
		$query = "SELECT uname FROM lm_user WHERE person='$person' ORDER BY uname ASC";
		$query = $db->select($query);
		if ($query != false) {
			$data = "<label class='text-success font-weight-bold' for='uname'>Username</label><select class='form-control' id='uname' name='uname' required='1'><option value='' selected='selected'>Select a person</option>";
			while ($result = $query->fetch_assoc()) {
				$data .= "<option value='".$result['uname']."'>".$result['uname']."</option>";
			}
			$data .= "</select>";
			echo $data;
		} else {
			echo "<p class='alert alert-warning'>There has no user! Please, select another.</p>";
		}
	}
}

//select all book by select category
elseif (isset($_POST['catname']) && $_POST['catname'] != NULL) {

	$catname = $_POST['catname'];
	if ($catname != NULL) {
		$query = "SELECT bookname, bookcopies FROM lm_book WHERE catname='$catname' ORDER BY bookname ASC";
		$query = $db->select($query);
		if ($query != false) {
			$data = "<label class='text-success font-weight-bold' for='bookname'>Book name</label><select class='form-control' id='bookname' name='bookname' required='1'><option value='' selected='selected'>Select a book</option>";
			while ($result = $query->fetch_assoc()) {
				if ($result['bookcopies'] > 0) {
					$data .= "<option value='".$result['bookname']."'>".$result['bookname']."</option>";
				}
			}
			$data .= "</select>";
			echo $data;
		} else {
			echo "<p class='alert alert-warning'>Opps! There has no book in your library by this category. Please, select another category.</p>";
		}
	}
}
?>



                      
                        
                        
                      