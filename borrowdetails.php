<?php
if (isset($_GET['detailsid']) && $_GET['detailsid'] != NULL && isset($_GET['person']) && $_GET['person'] != NULL && isset($_GET['due']) && $_GET['due'] != NULL && $_GET['action'] == 'details') {
	$detailsid = $_GET['detailsid'];
	$person = $_GET['person'];
	$due = $_GET['due'];
?>

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
				  		<p class="h3 text-center">Kurigram Polytechnic Institute, Kurigram</p>
				  		<p class="text-center font-weight-bold"><em>Library Management</em></p>
<?php
if (isset($detailsid) && isset($person)) { ?>
				  		<span class="font-weight-bold text-info">Borrow details 
				  			<?php if($person == 'staff'){
				  				echo "(Staff)";
				  			}elseif($person == 'student'){
				  				echo "(Student)";
				  			}?>
				  				
				  		</span>
				  		<button onclick="pageprint()" class="btn btn-warning btn-sm">Print</button>
				  		<script type="text/javascript">
				  			function pageprint(){
				  				window.print();
				  			}
				  		</script>
				  	</div>
				  	<!--borrow details-->
	                <div class="card-body border-bottom">
						<p class="alert alert-info">Do you want to <a onclick="return confirm('Are you sure to return the book? <?php if(isset($due)){echo "Overdue fine = $due tk.";}?>');" href="return.php?returnbookno=<?php echo $detailsid;?>&due=<?php echo $due;?>&action=return" class="h5 text-danger font-weight-bold"><i class="fas fa-exchange-alt"></i> Return</a> the book?</p>
	                	<!--borrow details table-->
	                	<div style="overflow-x:auto;">

<?php	
	$query = "SELECT * FROM lm_borrow WHERE id='$detailsid' AND person='$person' AND status=0";
	$query = $db->select($query);
	if ($query != false) {
		$query = "SELECT lm_user.fname, lm_user.sname, lm_user.uname, lm_user.mobile, lm_user.address, lm_user.department, lm_user.designation, lm_user.semester, lm_user.shift, lm_user.roll, lm_user.image, lm_user.person, lm_borrow.catname, lm_borrow.bookname, lm_borrow.borrowdate, lm_borrow.returndate FROM lm_user INNER JOIN lm_borrow ON lm_user.uname=lm_borrow.uname AND lm_user.person=lm_borrow.person WHERE lm_borrow.id='$detailsid' AND lm_borrow.person='$person' ANd lm_borrow.status=0 LIMIT 1";
		$query = $db->select($query);
		if ($query != false) {
			while ($result = $query->fetch_assoc()) {
				$image = $result["image"];
				echo "
					<table class='table table-striped table-bordered'>
						<tr>
		                	<td colspan='2'><img class='rounded' style='width: 25%;' src='$image'></td>
		                </tr>
		                <tr>
		                	<td>Name:</td>
		                	<td>".$result['fname']." ".$result['sname']. "</td>
		                </tr>
		                <tr>
		                	<td>Username:</td>
		                	<td>".$result['uname']. "</td>
		                </tr>
		                <tr>
		                	<td>Mobile:</td>
		                	<td>".$result['mobile']. "</td>
		                </tr>
		                <tr>
		                	<td>Address:</td>
		                	<td>".$result['address']. "</td>
		                </tr>
		                <tr>
		                	<td>Department:</td>
		                	<td>".$result['department']. "</td>
		                </tr>
		        ";
		        if ($person == 'staff') {
		        	echo "
		        		<tr>
		                	<td>Designation:</td>
		                	<td>".$result['designation']. "</td>
		                </tr>
		            ";
		        } elseif ($person == 'student') {
		        	echo "
		        		<tr>
		                	<td>Semester:</td>
		                	<td>".$result['semester']. "</td>
		                </tr>
		                <tr>
		                	<td>Shift:</td>
		                	<td>".$result['shift']. "</td>
		                </tr>
		                <tr>
		                	<td>Roll:</td>
		                	<td>".$result['roll']. "</td>
		                </tr>
		            ";
		        }
		        echo "
		        		<tr>
		                	<td>Category:</td>
		                	<td>".$result['catname']. "</td>
		                </tr>
		                <tr>
		                	<td>Book name:</td>
		                	<td>".$result['bookname']. "</td>
		                </tr>
		                <tr>
		                	<td>Borrow date:</td>
		                	<td>".$result['borrowdate']. "</td>
		                </tr>
		                <tr>
		                	<td>Return date:</td>
		                	<td>".$result['returndate']. "</td>
		                </tr>
		                <tr>
		                	<td>Overdue fine:</td>
		                	<td>".$due." tk". "</td>
		                </tr>
		        	</table>
		        ";
			}
		} else {
			echo "<p class='alert alert-warning'>Something went wrong!</p>";
		}
	} else {
		echo "<script>window.location='404.php'</script>";
	}
}
?>
	                	</div><!--end of borrow details-->
	                </div><!--end of borrow details-->


	                <div class="row mt-5">
	                	<div class="col-6">
	                		<p class="ml-2 p-4 font-weight-bold"><u>Borrower's signature</u></p>
	                	</div>
	                	<div class="col-6 text-right">
	                		<p class="mr-2 p-4 font-weight-bold"><u>Librarian's signature</u></p>
	                	</div>
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

<?php
} else {
	header("location:404.php");
}
?>