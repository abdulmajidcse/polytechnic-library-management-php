<?php 
include "config/config.php";
include "lib/Database.php";

$db = new Database();

/*Delete student user*/
if (isset($_GET['delUserStd']) && $_GET['delUserStd'] != NULL && isset($_GET['deluname']) && $_GET['deluname'] != NULL && $_GET['action'] == 'delStd') {
	$delid = $_GET['delUserStd'];
	$deluname = $_GET['deluname'];

	$query = "SELECT uname FROM lm_borrow WHERE uname='$deluname'";
	$query = $db->select($query);
	if ($query != false) {
		header("location:userlistStd.php?delcon=cant");
	} else {
		//select image
		$query = "SELECT image FROM lm_user WHERE id='$delid'";
		$query = $db->select($query);
		while ($result = $query->fetch_assoc()) {
			$image = $result['image'];
		}

		$query = "DELETE FROM lm_user WHERE id='$delid'";
		$query = $db->delete($query);
		if ($query != false) {
			unlink($image);
			header("location:userlistStd.php?delcon=yes");
		} else {
			header("location:userlistStd.php?delcon=no");
		}
	}
} 
/*End of delete student user*/

/*Delete staff user*/
elseif (isset($_GET['delUserStaff']) && $_GET['delUserStaff'] != NULL && isset($_GET['deluname']) && $_GET['deluname'] != NULL && $_GET['action'] == 'delStaff') {
	$delid = $_GET['delUserStaff'];
	$deluname = $_GET['deluname'];

	$query = "SELECT uname FROM lm_borrow WHERE uname='$deluname'";
	$query = $db->select($query);
	if ($query != false) {
		header("location:userlistStaff.php?delcon=cant");
	} else {
		$query = "DELETE FROM lm_user WHERE id='$delid'";
		$query = $db->delete($query);
		if ($query != false) {
			header("location:userlistStaff.php?delcon=yes");
		} else {
			header("location:userlistStaff.php?delcon=no");
		}
	}
} 
/*End of delete staff user*/

/*Delete Book*/
elseif (isset($_GET['delBookno']) && $_GET['delBookno'] != NULL && isset($_GET['delBook']) && $_GET['delBook'] != NULL && $_GET['action'] == 'delBook') {
	$delid = $_GET['delBookno'];
	$delBook = $_GET['delBook'];

	$query = "SELECT bookname FROM lm_borrow WHERE bookname='$delBook'";
	$query = $db->select($query);
	if ($query != false) {
		header("location:booklist.php?delcon=cant");
	} else {
		$query = "SELECT image FROM lm_book WHERE id='$delid'";
		$query = $db->select($query);
		while ($result = $query->fetch_assoc()) {
			$image = $result['image'];
		}

		$query = "DELETE FROM lm_book WHERE id='$delid'";
		$query = $db->delete($query);
		if ($query != false) {
			unlink($image);
			header("location:booklist.php?delcon=yes");
		} else {
			header("location:booklist.php?delcon=no");
		}
	}
} 
/*End of delete Book*/

/*Delete category*/
elseif (isset($_GET['delCatno']) && $_GET['delCatno'] != NULL && isset($_GET['delCat']) && $_GET['delCat'] != NULL && $_GET['action'] == 'delCat') {
	$delid = $_GET['delCatno'];
	$delCat = $_GET['delCat'];
	$query = "SELECT catname FROM lm_book WHERE catname='$delCat'";
	$query = $db->select($query);
	if ($query != false) {
		header("location:catlist.php?delcon=cant");
	} else {
		$query = "DELETE FROM lm_cat WHERE id='$delid'";
		$query = $db->delete($query);
		if ($query != false) {
			header("location:catlist.php?delcon=yes");
		} else {
			header("location:catlist.php?delcon=no");
		}
	}
} 
/*End of delete category*/

/*Delete returned*/
elseif (isset($_GET['delreturnno']) && $_GET['delreturnno'] != NULL && $_GET['action'] == 'delreturn') {
	$delreturnno = $_GET['delreturnno'];
	$query = "DELETE FROM lm_borrow WHERE id='$delreturnno'";
	$query = $db->delete($query);
	if ($query != false) {
		header("location:returnList.php?delcon=yes");
	} else {
		header("location:returnList.php?delcon=no");
	}
} 
/*End of delete returned*/

/*Delete fine submitted*/
elseif (isset($_GET['delFineSubmitted']) && $_GET['delFineSubmitted'] != NULL && $_GET['action'] == 'deleteFineSubmitted') {
	$delid = $_GET['delFineSubmitted'];
	$query = "DELETE FROM lm_finesubmit WHERE id='$delid'";
	$query = $db->delete($query);
	if ($query != false) {
		header("location:finesubmittedlist.php?delcon=yes");
	} else {
		header("location:finesubmittedlist.php?delcon=no");
	}
} 
/*End of delete fine submitted*/

/*else condition*/
else {
	header("location:404.php");
}
/*end of else condition*/




?>