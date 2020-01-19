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

				<div class="wrapcat">
					
				  <div class="card">
				  	<div class="card-header">
				  		<span class="font-weight-bold text-info">Add new Category</span>
				  	</div>
				  	<!--for student-->
	                <div class="card-body border-bottom">

	                	<?php
	                		include("loadphp/category.php");
	                		if (isset($addcatmsg)) {
	                			echo $addcatmsg;
	                		}
	                	?>

		                <!--Add category form-->
						<form action="" method="POST" class="mb-2" id="catadd">
							<div class="form-group">
								<label for="cat" class="font-weight-bold">Category name</label>
								<input type="text" name="cat" id="cat" placeholder="Category name" class="form-control" required="1">
							</div>

							<button type="submit" name="addcat" class="btn btn-success btn-block">Add</button>
						</form><!--end of Add category form-->
	                </div><!--end of for category-->

	              </div>


				</div>
			</div><!--end of main content col div-->
		</div><!--end of main body row-->
	</div><!--end of main body conatiner-->

</section><!--end of main body section-->

<?php
include("inc/footer.php");
?>