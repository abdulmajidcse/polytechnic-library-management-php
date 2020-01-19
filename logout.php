<?php
ob_start();
include("lib/Session.php");
Session::start();
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
	Session::end();
	header("location:login.php");
}
?>