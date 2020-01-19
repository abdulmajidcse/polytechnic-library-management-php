<?php
//new borrow book
if($_SERVER['REQUEST_METHOD'] == "POST" AND isset($_POST['newborrow'])){
	if(empty($_POST['person']) OR empty($_POST['uname']) OR empty($_POST['catname']) OR empty($_POST['bookname']) OR empty($_POST['returndate'])){
		$newBorrowMsg = "<p class='alert alert-warning'>Field must not be empty!</p>";
	} else{
		$person = $fm->validation($_POST['person']);
		$uname = $fm->validation($_POST['uname']);
		$catname = $fm->validation($_POST['catname']);
		$bookname = $fm->validation($_POST['bookname']);
		$returndate = $fm->validation($_POST['returndate']);

		$person = mysqli_escape_string($db->conn, $person);
		$uname = mysqli_escape_string($db->conn, $uname);
		$catname = mysqli_escape_string($db->conn, $catname);
		$bookname = mysqli_escape_string($db->conn, $bookname);
		$returndate = mysqli_escape_string($db->conn, $returndate);

		$borrowdate = date("Y-m-d");


		$query = "SELECT uname, status FROM lm_borrow WHERE uname='$uname' AND status=0";
		$query = $db->select($query);

		$bookavail = "SELECT bookcopies FROM lm_book WHERE bookname='$bookname'";
		$bookavail = $db->select($bookavail);
		while ($result = $bookavail->fetch_assoc()) {
			$bookcopyno = $result['bookcopies'];
		}
		$bookcopyno -= 1;
		if ($query != false) {
			$newBorrowMsg = "<p class='alert alert-warning'>This user already borrowed a book and doesn't return the book!</p>";
		} elseif ($bookcopyno < 1) {
			$newBorrowMsg = "<p class='alert alert-warning'>Opps! This book not available.</p>";
		} else {
			$query = "INSERT INTO lm_borrow(person, uname, catname, bookname, borrowdate, returndate) VALUES('$person', '$uname', '$catname', '$bookname', '$borrowdate', '$returndate')";
			$query = $db->insert($query);
			if ($query != false) {
				$query = "UPDATE lm_book SET bookcopies='$bookcopyno' WHERE bookname='$bookname'";
				$query = $db->update($query);
				$newBorrowMsg = "<p class='alert alert-success'>Borrowed this book successfully!</p>";
			} else{
				$newBorrowMsg = "<p class='alert alert-warning'>didn't borrow this book!</p>";
			}
		}
	}
}
?>