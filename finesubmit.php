<?php
	include("inc/header.php");
	$query = "SELECT fine FROM lm_fine";
	$query = $db->select($query);
	if ($query != false) {
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
              <span class="font-weight-bold text-info">Overdue fine submit</span>
            </div>
            <!--for student-->
                  <div class="card-body border-bottom">

                  	<div id="finesubmitmsg"></div>
    	

                    <form action="" method="POST" id="finesubmit">

                    <div class="form-group">
                      <label class="text-primary" for="uname">Username</label>
                      <select class="form-control unameFine" id="uname" name="uname" required="1">
                        <option value="" selected="">Select a user</option>
<!--user select-->
<?php
$query = "SELECT uname FROM lm_user WHERE person='staff'";
$query = $db->select($query);
if ($query != false) {
  while ($result = $query->fetch_assoc()) { ?>
    
                        <option value="<?php echo $result['uname']; ?>"><?php echo $result['uname']; ?></option>

<?php } }  ?>
<!--end of user select-->
                      </select>
                      <p id="unameCheck" class="text-danger ml-1 unameCheckFine"></p>
                    </div>
                    <div class="form-group">
                      <label class="text-primary" for="email">E-mail Address</label>
                      <input type="email" name="email" class="form-control emailFine" id="email" placeholder="E-mail Address" required="1">
                      <p id="emailCheck" class="text-danger ml-1 emailCheckFine"></p>
                    </div>
                    <div class="form-group">
                      <label class="text-primary" for="totalfine">Total Overdue Fine (TK)</label>
<?php
$query = "SELECT fine FROM lm_fine";
$query = $db->select($query);
if ($query != false) {
  $totalfine = 0;
  while ($result = $query->fetch_assoc()) { $totalfine += $result['fine']; } ?>

  					  <input type="text" name="totalfine" class="form-control" id="totalfine" value="<?php echo $totalfine; ?>" readonly="readonly">
  					  <p id="totalfineCheck" class="text-danger ml-1"></p>
   
<?php  }  ?>
                      
                    </div>
                    <button type="submit" name="finesubmit" class="btn btn-success btn-block">Submit</button>
                  </form>

                  <form action="" method="POST" id="finesubmitConfirm" style="display: none;">
                  	<p class="text-danger">Don't refresh this page!</p>
                  	<p class="h5 text-warning">Please, check your e-mail for verification code!</p>
                  	<div class="form-group">
                      <label class="text-primary" for="finesubmitCode">Verification code</label>
                      <input type="text" name="finesubmitCode" class="form-control" id="finesubmitCode" placeholder="Verification code" required="1">
                      <p id="finesubmitCodeMsg" class="ml-1"></p>
                    </div>
                    <button type="submit" name="finesubmitCodeSend" class="btn btn-success btn-block">Confirm</button>
                  </form>



                  </div><!--end of for category-->

                </div>


        </div>
      </div><!--end of main content col div-->
    </div><!--end of main body row-->
  </div><!--end of main body conatiner-->

</section><!--end of main body section-->

<?php
	include("inc/footer.php");
	} else {
		echo "<script>window.location='overduefine.php';</script>";
	}
?>