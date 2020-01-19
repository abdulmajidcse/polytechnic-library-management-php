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
              <span class="font-weight-bold text-info">Returned book list</span>
            </div>
            <!--card-body-->
                  <div class="card-body border-bottom">

                    <div class="p-1 mb-2">
                      <input type="text" name="search" placeholder="Search a return..." class="form-control" style="display: inline;width: auto;" id="liveSearch">
                    </div>

<!--returned delete-->
<?php
if (isset($_GET['delcon']) && $_GET['delcon'] == 'yes') {
  echo "<p class='alert alert-success'>Return information deleted successfully!</p>";
}elseif (isset($_GET['delcon']) && $_GET['delcon'] == 'no') {
  echo "<p class='alert alert-warning'>Return information not deleted!</p>";
}
?>

                  <!--return list-->
                  <div style="overflow-x:auto;">
                    <table id="liveTable" class="table table-striped table-bordered w-100">
                      <thead>
                          <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Book name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Borrow date</th>
                            <th scope="col">Return date</th>
                            <th scope="col">Returned date</th>
                            <th scope="col">Overdue fine</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>

<!--add new categories php code-->
<?php
$per_page = 50;
if (isset($_GET['page'])) {
  $page = $_GET['page'];
} else{
  $page = 1;
}
$start_from = ($page-1) * $per_page;

$query = "SELECT * FROM lm_borrow WHERE status=1 ORDER BY returneddate DESC LIMIT $start_from, $per_page";
$query = $db->select($query);
if ($query != false) {
  $i = $start_from;
  while ($result = $query->fetch_assoc()) { $i++; $today = date("Y-m-d"); ?>
                          
                          <tr class="tr">
                            <td><?php echo $i;?></td>
                            <td><?php echo $result['bookname'];?></td>
                            <td><?php echo $result['uname'];?>
                            <td><?php echo $result['borrowdate'];?></td>
                            <td><?php echo $result['returndate'];?></td>
                            <td><?php echo $result['returneddate'];?></td>
                            <td><?php echo $result['overduefine'];?></td>
                              <td><span class="text-success font-weight-bold"><em>Returned success!</em></span></td>
                            <td><a class="mr-3 text-success font-weight-bold" href="returndetails.php?detailsid=<?php echo $result['id'];?>&person=<?php echo $result['person'];?>&action=details"><i class="fas fa-list-alt"></i> Details</i></a>

                              <a class="text-danger font-weight-bold" onclick="return confirm('Are you sure to delete the return information?');" href="delete.php?delreturnno=<?php echo $result['id'];?>&action=delreturn"><i class="fas fa-trash-alt"></i> Delete</a></td>
                          </tr>
<?php } ?><!--end while loop-->
                        </tbody>
                    </table>
                  </div><!--end of borrow list-->
<!--pagination-->

<?php
$query = "SELECT * FROM lm_borrow WHERE status=1";
$query = $db->select($query);
$total_rows = mysqli_num_rows($query);
$pages = ceil($total_rows / $per_page);
  if ($pages > 1) { ?>
  <!--pagination-->
  <div class="container-fluid" style="overflow: auto;">

    <span class="float-left text-info h4 mt-1 mr-2">Page : </span>
   <?php for ($i=1; $i <= $pages; $i++) { ?>

    <a href="borrowList.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
    
   <?php } ?>
  </div><!--end of pagination-->

<?php }
} else {
  echo "<tr><td colspan='9'><p class='text-danger font-weight-bold text-center'>No return book!</p></td></tr></tbody></table></div>";
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