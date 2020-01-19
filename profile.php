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
							include("loadphp/editprofile.php");
		                	include("loadphp/profiledata.php");

							if (isset($savelogimagemsg)) {
								echo $savelogimagemsg;
							}
						?>

			             <!--edit book-->
			            <form action="" method="POST" class="mb-2" enctype="multipart/form-data">

			              <div class="form-group">
			                <?php
			                  if (isset($image)) {
			                     echo "<img src='$image' class='w-25 d-block rounded' alt='Photo' id='imgmodal' data-toggle='modal' data-target='#imgmodals'>";
			                  }
			                ?>
			               
			                <label for="image" class="font-weight-bold">Photo</label>
			                <input type="file" name="image" id="image" class="custom-file" required="1">
			              </div>
			              <input type="hidden" name="userid" value="<?php if(isset($userid)){echo $userid;}?>" required="1">
			              <button type="submit" name="savelogimage" class="btn btn-success">Update</button>
			            </form>


			        <!--Image Modal -->
                    <div class="modal fade" id="imgmodals" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                        <div class="modal-content" style="background: none;">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true" class="text-danger">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <img class="w-100" id="modalimg">
                          </div>
                        </div>
                      </div>
                    </div>
                    <!--end of image modal-->


						<?php
	                		if (isset($msg)) {
	                			echo $msg;
	                		}
	                	?>

		                <!--User log form-->
						<form action="" method="POST" class="mb-2">

							<div class="form-group">
								<label for="fname" class="font-weight-bold">First name</label>
								<input type="text" name="fname" id="fname" placeholder="Fist name" class="form-control" value="<?php if(isset($fname)){echo $fname;}?>" required="1">
							</div>

							<div class="form-group">
								<label for="sname" class="font-weight-bold">Surname</label>
								<input type="text" name="sname" id="sname" placeholder="Surname" class="form-control" value="<?php if(isset($sname)){echo $sname;}?>" required="1">
							</div>

							<div class="form-group">
								<label for="uname" class="font-weight-bold">Username</label>
								<input type="text" name="uname" id="uname" placeholder="Username" class="form-control" value="<?php if(isset($uname)){echo $uname;}?>" required="1">
							</div>

							<div class="form-group">
								<label for="email" class="font-weight-bold">E-mail</label>
								<input type="email" name="email" id="email" placeholder="E-mail" class="form-control" value="<?php if(isset($email)){echo $email;}?>" required="1">
							</div>

							<input type="hidden" name="userid" value="<?php if(isset($userid)){echo $userid;}?>" required="1">

							<button type="submit" name="savedata" class="btn btn-success btn-block">Save</button>
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