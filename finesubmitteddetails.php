<?php
	if (isset($_GET['FineSubmittedId']) && $_GET['FineSubmittedId'] != NULL && $_GET['action'] == 'FineSubmitted') {
		$detailsid = $_GET['FineSubmittedId'];

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

				  		<span class="font-weight-bold text-info">Fine submitted details 
				  			
				  		</span>
				  		<button onclick="pageprint()" class="btn btn-warning btn-sm">Print</button>
				  		<script type="text/javascript">
				  			function pageprint(){
				  				window.print();
				  			}
				  		</script>
				  	</div>
				  	<!--fine submitted details-->
	                <div class="card-body border-bottom">
						
	                	<!--fine submitted details table-->
	                	<div style="overflow-x:auto;">
<?php
	$query = "SELECT * FROM lm_finesubmit WHERE id='$detailsid'";
	$query = $db->select($query);
	if ($query != false) {
		while ($result = $query->fetch_assoc()) { ?>
					<table class='table table-striped table-bordered'>
		                <tr>
		                	<td>Name:</td>
		                	<td><?php echo $result['name']; ?></td>
		                </tr>
		                <tr>
		                	<td>Mobile:</td>
		                	<td><?php echo $result['mobile']; ?></td>
		                </tr>
		                <tr>
		                	<td>E-mail:</td>
		                	<td><?php echo $result['email']; ?></td>
		                </tr>
		                <tr>
		                	<td>Department:</td>
		                	<td><?php echo $result['department']; ?></td>
		                </tr>
		        		<tr>
		                	<td>Designation:</td>
		                	<td><?php echo $result['designation']; ?></td>
		                </tr>
		        		<tr>
		                	<td>Submitted date</td>
		                	<td><?php echo $result['submitteddate']; ?></td>
		                </tr>
		                <tr>
		                	<td>Amount(TK):</td>
		                	<td><?php echo $result['amount']; ?> tk</td>
		                </tr>
		        	</table>

<?php } } else {
	echo "<script>window.location='404.php';</script>";
} ?>

	                	</div><!--end of fine submitted details-->
	                </div><!--end of fine submitted details-->


	                <div class="row mt-5">
	                	<div class="col-6">
	                		<p class="ml-2 p-4 font-weight-bold"><u>Receiver's signature</u></p>
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
	} else {
		header("location:404.php");
	}
?>