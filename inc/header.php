<?php
ob_start();
include("config/config.php");
include("lib/Database.php");
include("lib/Session.php");
include("format/Format.php");

$db = new Database();
$fm = new Format();
Session::check_session();
$userid = Session::get("userid");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
	<title>KPI Library</title>
	<!--bootstrap css link-->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<!--custom css link-->
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<!--fontawesome css link-->
	<link rel="stylesheet" type="text/css" href="fontawesome/css/all.css">
	<!--brand icon-->
	<link rel="shortcut icon" type="image/png" href="images/brand.png">
	<link rel="shortcut icon" type="image/ico" href="images/brand.ico">
</head>
<body>


<!--main navbar-->
<nav class="navbar navbar-expand-lg p-lg-0 p-2 sticky-top mainnavbar">
  <div class="container-fluid">
	  <a class="navbar-brand text-light font-weight-bold" href="index.php">
	    <i class="fas fa-book-reader h4"></i>
	    <span>KPI Library</span>
	  </a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="text-light"><i class="fas fa-bars"></i> Menu</span>
	  </button>
	  <div class="collapse navbar-collapse" id="navbarNav">
	    <ul class="navbar-nav mainnavul">
	      <!--dropdown link-->
		  <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	         <i class="fas fa-plus-square"></i> Add New
	        </a>
	        <!--dropdown menu-->
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="adduserStd.php"><i class="fas fa-users"></i> Users</a>
	          <a class="dropdown-item" href="addbook.php"><i class="fas fa-book-open"></i> Books</a>
	          <a class="dropdown-item" href="addcat.php"><i class="fas fa-th"></i> Categories</a>
	        </div><!--end of dropdown menu-->
	       </li>
	       <!--dropdown link-->
		  <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	         <i class="fas fa-tasks"></i> Manage
	        </a>
	        <!--dropdown menu-->
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="newborrow.php"><i class="fas fa-shopping-cart"></i> Borrow a Book</a>
	          <a class="dropdown-item" href="borrowList.php"><i class="fas fa-exchange-alt"></i> Return a Book</a>
	          <div class="dropdown-divider"></div>
	          <a class="dropdown-item" href="overduefine.php"><i class="fas fa-hand-holding-usd"></i> Overdue Fine</a>
	          <a class="dropdown-item" href="finesubmittedlist.php"><i class="fas fa-gift"></i> Fine Submitted</a>
	        </div><!--end of dropdown menu-->
	       </li>
	       <!--dropdown link-->
		  <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	         <i class="fas fa-info-circle"></i> Report
	        </a>
	        <!--dropdown menu-->
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="userlistStd.php"><i class="fas fa-users"></i> Users</a>
	          <a class="dropdown-item" href="booklist.php"><i class="fas fa-book-open"></i> Books</a>
	          <a class="dropdown-item" href="catlist.php"><i class="fas fa-th"></i> Categories</a>
	          <div class="dropdown-divider"></div>
	          <a class="dropdown-item" href="borrowList.php"><i class="fas fa-shopping-cart"></i> Borrowed Books</a>
	          <a class="dropdown-item" href="returnList.php"><i class="fas fa-exchange-alt"></i> Returned Books</a>
	        </div><!--end of dropdown menu-->
	       </li>
	      <!--dropdown link-->
		  <li class="nav-item dropdown">
	        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	         <i class="fas fa-user"></i> Admin
	        </a>
	        <!--dropdown menu-->
	        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
	          <a class="dropdown-item" href="changepassword.php"><i class="fas fa-unlock-alt"></i> Change Password</a>
	          <a class="dropdown-item" href="profile.php"><i class="far fa-address-card"></i> Profile</a>
	          <a onclick="return confirm('Are you sure to logout?')"  class="dropdown-item" href="logout.php?action=logout"><i class="fas fa-sign-out-alt"></i>Logout</a>
	        </div><!--end of dropdown menu-->
	       </li>
	    </ul>

	  </div>
  </div>
</nav><!--end of main navbar-->

<!--date and time-->
<h4 class="mt-1 text-center text-success"><b>Time: <span id="time"></span> | Today is <span><?php echo date("D"); ?></span>, <?php  echo date("F dS, Y"); ?></b></h4><!--end of date and time-->