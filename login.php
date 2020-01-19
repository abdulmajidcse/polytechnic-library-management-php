<?php
ob_start();
include("config/config.php");
include("lib/Database.php");
include("lib/Session.php");
include("format/Format.php");

$db = new Database();
$fm = new Format();
Session::check_login();

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


<!--header-->
<header>
	<div class="container-fluid login text-center p-4">
		<a class="navbar-brand text-light font-weight-bold" href="login.php">
	    <i class="fas fa-book-reader h4"></i>
	    <span>KPI Library</span>
	  </a>
	</div>
</header><!--end of header-->

<!--date and time-->
<h4 class="mt-1 text-center text-success"><b>Time: <span id="time"></span> | Today is <span><?php date_default_timezone_set("Asia/Dhaka"); echo date("D"); ?></span>, <?php  echo date("F dS, Y"); ?></b></h4><!--end of date and time-->

<!--main body section-->
<section>
	<!--main body conatiner-->
	<div class="container-fluid">
		<!--main body row-->
		<div class="row">
			<!--main content col div-->
			<div class="col-12">

				<div class="wraplogin">


					<?php include("loadphp/login_validate.php");?>


					
					<div class="card py-2">
						<div class="card-body">
							<?php
							if(isset($error)){
								echo $error;
							}
							?>
							<!--login form-->
							<form action="" method="POST" class="mb-2">

								<div class="form-group">
									<label for="uname" class="font-weight-bold">Username</label>
									<input type="text" name="uname" id="uname" placeholder="Username" class="form-control" required="1">
								</div>

								<div class="form-group">
									<label for="password" class="font-weight-bold">Password</label>
									<input type="password" name="password" id="password" placeholder="Password" class="form-control" required="1">
								</div>

								<button type="submit" name="login" class="btn btn-success btn-block">Login</button> <p class="mt-2"><a href="forgetpass.php">Forgotten password?</a></p>
							</form><!--end of login form-->
						</div>
					</div>


				</div>
			</div><!--end of main content col div-->
		</div><!--end of main body row-->
	</div><!--end of main body conatiner-->

</section><!--end of main body section-->

<!--footer-->
<footer class="footer p-3">
	<div class="container-fluid text-center">
		<p class="text-white h5 font-weight-bold m-auto">&copy; <?php echo date("Y");?> KPI Library</p>
	</div>
</footer><!--end of footer-->


<!--jquery and bootstrap js script-->
<script type="text/javascript" src="js/jquery-3.3.1.slim.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<!--custom js script-->
<script type="text/javascript" src="js/style.js"></script>
</body>
</html>