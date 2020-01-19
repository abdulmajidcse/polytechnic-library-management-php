<?php
include("inc/header.php");
?>

<!--main body section-->
<section>
	<!--main body conatiner-->
	<div class="container-fluid">
		<!--main body row-->
		<div class="row">
			<!--main content col div-->
			<div class="col-12">

				<div class="wrapprofile">
					
				  <div class="card py-2">
	                <div class="card-body">

	                	<?php
	                		include("loadphp/changepass.php");
	                		if (isset($msg)) {
	                			echo $msg;
	                		}
	                	?>

		                <!--login form-->
						<form action="" method="POST" class="mb-2">

							<div class="form-group">
								<label for="oldPass" class="font-weight-bold">Old Password</label>
								<input type="password" name="oldPass" id="oldPass" placeholder="Old Password" class="form-control" required="1">
							</div>

							<div class="form-group">
								<label for="newPass" class="font-weight-bold">New Password</label>
								<input type="password" name="newPass" id="newPass" placeholder="New Password" class="form-control" required="1">
							</div>

							<div class="form-group">
								<label for="conPass" class="font-weight-bold">Confirm Password</label>
								<input type="password" name="conPass" id="conPass" placeholder="Confirm Password" class="form-control" required="1">
							</div>

							<input type="hidden" name="userid" value="<?php if(isset($userid)){echo $userid;}?>">

							<button type="submit" name="submit" class="btn btn-success btn-block">Change Password</button>
						</form><!--end of login form-->
	                </div>
	              </div>


				</div>
			</div><!--end of main content col div-->
		</div><!--end of main body row-->
	</div><!--end of main body conatiner-->

</section><!--end of main body section-->

<?php
include("inc/footer.php");
?>