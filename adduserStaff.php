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

				<div class="wrap">
					
				  <div class="card">
				  	<div class="card-header">
				  		<span class="font-weight-bold text-info">Add new User (Staff)</span>
				  	</div>

	                <!--for staff-->
	                <div class="card-body">

	                	<div class="p-1 mb-2">
	                      <a href="adduserStd.php" class="btn border mr-1">For student</a>
	                      <a href="adduserStaff.php" class="btn border mr-3 bg-info text-light">For staff</a>
	                    </div>

	                	<?php
	                		include("loadphp/user.php");
	                		if (isset($addstaffmsg)) {
	                			echo $addstaffmsg;
	                		}
	                	?>

						<!--Staff form-->
						<form action="" method="POST" class="mb-2" enctype="multipart/form-data">
							<!--information-->
							<div class="row">

								<div class="col-md-3 col-12 mb-3">
									<input type="text" name="fname" placeholder="First name" class="form-control" required="1">
								</div>
								<div class="col-md-3 col-12 mb-3">
									<input type="text" name="sname" placeholder="Surname" class="form-control" required="1">
								</div>
								<div class="col-md-3 col-12 mb-3">
									<input type="text" name="uname" placeholder="Username" class="form-control" required="1">
								</div>
								<div class="col-md-3 col-12 mb-3">
									<input type="number" name="mobile" min="0" placeholder="Moblie number" class="form-control" required="1">
								</div>

								<div class="col-md-3 col-12 mb-3">
									<input type="text" name="address" placeholder="Address" class="form-control" required="1">
								</div>
								<div class="col-md-3 col-12 mb-3">
									<input type="text" name="department" placeholder="Department" class="form-control" required="1">
								</div>
								<div class="col-md-3 col-12 mb-3">
									<input type="text" name="designation" placeholder="Designation" class="form-control" required="1">
								</div>

								<div class="col-md-3 col-12 mb-3">
									<div class="input-group mb-3">
									  <div class="input-group-prepend">
									    <span class="input-group-text" id="imagestaff">Photo</span>
									  </div>
									  <div class="custom-file">
									    <input type="file" name="image" class="custom-file" aria-describedby="imagestaff" required="1">
									  </div>
									</div>
								</div>

							</div><!--end of information-->

							<button type="submit" name="addstaff" class="btn btn-success">Add</button>
						</form><!--end of Staff form-->
	                </div><!--end of for student-->
	              </div>


				</div>
			</div><!--end of main content col div-->
		</div><!--end of main body row-->
	</div><!--end of main body conatiner-->

</section><!--end of main body section-->

<?php
include("inc/footer.php");
?>