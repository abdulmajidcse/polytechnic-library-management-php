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

        <div class="wrapfixed">
          
          <div class="card">
            <div class="card-header">
              <span class="font-weight-bold text-info">Fine submitted list</span>
            </div>
            <!--card-body-->
                  <div class="card-body border-bottom">

                    <div class="p-1 mb-2">
                      <input type="text" name="search" placeholder="Search here..." class="form-control" style="display: inline;width: auto;" id="liveSearch">
                    </div>

<!--delete confirm-->
<?php
  if (isset($_GET['delcon']) && $_GET['delcon'] == 'yes') {
    echo "<p class='alert alert-success'>Deleted successfully!</p>";
  }elseif (isset($_GET['delcon']) && $_GET['delcon'] == 'no') {
    echo "<p class='alert alert-warning'>Not deleted!</p>";
  }
?>

                  <!--staff user list-->
                  <div style="overflow-x:auto;">
                    <table id="liveTable" class="table table-striped table-bordered w-100">
                      <thead>
                          <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Name</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Submitted date</th>
                            <th scope="col">Amount(TK)</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

<!--staff user list code-->
<?php
$per_page = 50;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else{
  $page = 1;
}
$start_from = ($page-1) * $per_page;

$query = "SELECT * FROM lm_finesubmit ORDER BY id DESC LIMIT $start_from, $per_page";
$query = $db->select($query);
if ($query != false) {
  $i = $start_from;
  while ($result = $query->fetch_assoc()) { $i++; ?>
                          <tr class="tr">
                            <td><?php echo $i;?></td>
                            <td><?php echo $result['name'];?></td>
                            <td><?php echo $result['email'];?></td>
                            <td><?php echo $result['submitteddate'];?></td>
                            <td><?php echo $result['amount'];?></td>
                            <td><a class="mr-3 text-success font-weight-bold" href="finesubmitteddetails.php?FineSubmittedId=<?php echo $result['id'];?>&action=FineSubmitted"><i class="fas fa-list-alt"></i> Details</i></a>

                              <a class="text-danger font-weight-bold" onclick="return confirm('Are you sure to delete?');" href="delete.php?delFineSubmitted=<?php echo $result['id'];?>&action=deleteFineSubmitted"><i class="fas fa-trash-alt"></i> Delete</a></td>

                          </tr>
<?php } ?><!--end while loop-->
                        </tbody>
                    </table>

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

                  </div>
<!--pagination-->

<?php
$query = "SELECT * FROM lm_user";
$query = $db->select($query);
$total_rows = mysqli_num_rows($query);
$pages = ceil($total_rows / $per_page);
  if ($pages > 1) { ?>
  <!--pagination-->
  <div class="container-fluid" style="overflow: auto;">

    <span class="float-left text-info h4 mt-1 mr-2">Page : </span>
   <?php for ($i=1; $i <= $pages; $i++) { ?>

    <a href="userlistStd.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
    
   <?php } ?>
  </div><!--end of pagination-->

<?php }
} else {
  echo "<tr><td colspan='8'><p class='text-danger font-weight-bold text-center'>No user!</p></td></tr></tbody></table></div>";
}
?>
<!--End of pagination-->


                  <!--End of Book list-->

                  </div><!--end of card-body-->
                </div>


        </div>
      </div><!--end of main content col div-->
    </div><!--end of main body row-->
  </div><!--end of main body conatiner-->

</section><!--end of main body section-->

<?php
include("inc/footer.php");
?>