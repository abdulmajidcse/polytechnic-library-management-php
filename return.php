<?php
include "config/config.php";
include "lib/Database.php";

$db = new Database();
//return book update status
if (isset($_GET['returnbookno']) && $_GET['returnbookno'] != NULL && isset($_GET['due']) && $_GET['due'] != NULL && $_GET['action'] == 'return') {

  $returnbookno = $_GET['returnbookno'];
  $due = $_GET['due'];
  $today = date("Y-m-d");
  //bookname and book copies
  $query = "SELECT bookname FROM lm_borrow WHERE id='$returnbookno'";
  $query = $db->select($query);
  while ($result = $query->fetch_assoc()) {
    $bookname = $result['bookname'];
  }
  
  $query = "SELECT bookcopies FROM lm_book WHERE bookname='$bookname'";
  $query = $db->select($query);
  while ($result = $query->fetch_assoc()) {
    $bookcopies = $result['bookcopies'];
  }
  $bookcopies += 1;
  //end of bookname and book copies
  $return = "UPDATE lm_borrow SET returneddate='$today', overduefine='$due', status=1 WHERE id='$returnbookno'";
  $return = $db->update($return);
  if ($return != false) {
    $query = "UPDATE lm_book SET bookcopies='$bookcopies' WHERE bookname='$bookname'";
    $query = $db->update($query);

    $returnedselect = "SELECT uname, returneddate, overduefine FROM lm_borrow WHERE id='$returnbookno' AND overduefine > 0";
    $returnedselect = $db->select($returnedselect);
    if ($returnedselect != false) {
        while ($result = $returnedselect->fetch_assoc()) {
          $uname = $result['uname'];
          $finedate = $result['returneddate'];
          $fine = $result['overduefine'];
        }
        $lm_fine = "INSERT INTO lm_fine(uname, finedate, fine) VALUES('$uname', '$finedate', '$fine')";
        $lm_fine = $db->insert($lm_fine);
    }

    header("location:borrowList.php?return=yes");
  } else {
    header("location:borrowList.php?return=no");
  }
} else {
  header("location:404.php");
}
?>