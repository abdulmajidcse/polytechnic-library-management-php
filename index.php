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

					<!-- total showing content -->
					<div class="container mt-3">
			          <div class="row">


<?php
$query = "SELECT cat FROM lm_cat";
$query = $db->select($query);
if ($query != false) {
	$catcount = 0;
	while ($result = $query->fetch_assoc()) {
		$catcount += 1;
	}
}
?>

			            <!-- total Categories -->
			            <div class="col-xl-4 col-md-6 mb-4">
			              <div class="card shadow h-100 py-2 card1">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Categories</div>
			                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
			                      if (isset($catcount)) {
			                      	echo $catcount;
			                      } else {
			                      	echo 0;
			                      }
			                      ?></div>
			                    </div>
			                    <div class="col-auto">
			                      <i class="fas fa-th fa-2x text-primary"></i>
			                    </div>
			                  </div>
			                </div>
			              </div>
			            </div><!-- end of total Categories -->

<?php
$query = "SELECT bookcopies FROM lm_book";
$query = $db->select($query);
if ($query != false) {
	$bookcount = "0";
	while ($result = $query->fetch_assoc()) {
		$bookcount += $result['bookcopies'];
	}
}
?>

			            <!-- total books -->
			            <div class="col-xl-4 col-md-6 mb-4">
			              <div class="card shadow h-100 py-2 card2">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Books</div>
			                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
			                      if (isset($bookcount)) {
			                      	echo $bookcount;
			                      } else {
			                      	echo 0;
			                      }
			                      ?></div>
			                    </div>
			                    <div class="col-auto">
			                      <i class="fas fa-book fa-2x text-success"></i>
			                    </div>
			                  </div>
			                </div>
			              </div>
			            </div><!-- end of total books -->

<?php
$query = "SELECT uname FROM lm_user WHERE person='staff'";
$query = $db->select($query);
if ($query != false) {
	$staffcount = 0;
	while ($result = $query->fetch_assoc()) {
		$staffcount += 1;
	}
}
?>

			            <!-- total users staff -->
			            <div class="col-xl-4 col-md-6 mb-4">
			              <div class="card shadow h-100 py-2 card3">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Users (Staff)</div>
			                      <div class="h5 mb-0 font-weight-bold text-info"><?php
			                      if (isset($staffcount)) {
			                      	echo $staffcount;
			                      } else {
			                      	echo 0;
			                      }
			                      ?></div>
			                    </div>
			                    <div class="col-auto">
			                      <i class="fas fa-users fa-2x text-info"></i>
			                    </div>
			                  </div>
			                </div>
			              </div>
			            </div><!-- end of total users staff-->

<?php
$query = "SELECT uname FROM lm_user WHERE person='student'";
$query = $db->select($query);
if ($query != false) {
	$stdcount = 0;
	while ($result = $query->fetch_assoc()) {
		$stdcount += 1;
	}
}
?>

			            
			            <!-- total users student-->
			            <div class="col-xl-4 col-md-6 mb-4">
			              <div class="card shadow h-100 py-2 card4">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Users (Student)</div>
			                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
			                      if (isset($stdcount)) {
			                      	echo $stdcount;
			                      } else {
			                      	echo 0;
			                      }
			                      ?></div>
			                    </div>
			                    <div class="col-auto">
			                      <i class="fas fa-users fa-2x text-success"></i>
			                    </div>
			                  </div>
			                </div>
			              </div>
			            </div><!-- end of total users student-->

<?php
$query = "SELECT id FROM lm_borrow WHERE status=0";
$query = $db->select($query);
if ($query != false) {
	$borrowcount = 0;
	while ($result = $query->fetch_assoc()) {
		$borrowcount += 1;
	}
}
?>

			            
			            
			            <!-- total borrow books -->
			            <div class="col-xl-4 col-md-6 mb-4">
			              <div class="card shadow h-100 py-2 card5">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Borrow Books</div>
			                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
			                      if (isset($borrowcount)) {
			                      	echo $borrowcount;
			                      } else {
			                      	echo 0;
			                      }
			                      ?></div>
			                    </div>
			                    <div class="col-auto">
			                      <i class="fas fa-shopping-cart fa-2x text-danger"></i>
			                    </div>
			                  </div>
			                </div>
			              </div>
			            </div><!-- end of total borrow books -->

<?php
$query = "SELECT id FROM lm_borrow WHERE status=1";
$query = $db->select($query);
if ($query != false) {
	$returncount = 0;
	while ($result = $query->fetch_assoc()) {
		$returncount += 1;
	}
}
?>

			            
			            
			            
			            <!-- total return books -->
			            <div class="col-xl-4 col-md-6 mb-4">
			              <div class="card shadow h-100 py-2 card6">
			                <div class="card-body">
			                  <div class="row no-gutters align-items-center">
			                    <div class="col mr-2">
			                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Return Books</div>
			                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php
			                      if (isset($returncount)) {
			                      	echo $returncount;
			                      } else {
			                      	echo 0;
			                      }
			                      ?></div>
			                    </div>
			                    <div class="col-auto">
			                      <i class="fas fa-exchange-alt fa-2x text-warning"></i>
			                    </div>
			                  </div>
			                </div>
			              </div>
			            </div><!-- end of total return books -->


			          </div>
		          </div><!-- end of total showing content -->
					
				</div>
			</div><!--end of main content col div-->
		</div><!--end of main body row-->
	</div><!--end of main body conatiner-->

</section><!--end of main body section-->

<?php
include("inc/footer.php");
?>