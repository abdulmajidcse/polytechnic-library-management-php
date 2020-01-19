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
              <span class="font-weight-bold text-info">Borrowed book list</span>
            </div>
            <!--card-body-->
                  <div class="card-body border-bottom">

                    <div class="p-1 mb-2">
                      <input type="text" name="search" placeholder="Search a borrower..." class="form-control" style="display: inline;width: auto;" id="liveSearch">
                    </div>

<!--return confirm-->
<?php
if (isset($_GET['return']) && $_GET['return'] == 'yes') {
  echo "<p class='alert alert-success'>Returned this book successfully!</p>";
}elseif (isset($_GET['return']) && $_GET['return'] == 'no') {
  echo "<p class='alert alert-warning'>Didn't return this book! Something went wrong.</p>";
}
?>

                  <!--borrow list-->
                  <div style="overflow-x:auto;">
                    <table id="liveTable" class="table table-striped table-bordered w-100">
                      <thead>
                          <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Book name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Borrow date</th>
                            <th scope="col">Return date</th>
                            <th scope="col">Overdue fine</th>
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

$query = "SELECT * FROM lm_borrow WHERE status=0 ORDER BY id DESC LIMIT $start_from, $per_page";
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
                            <td>
                              <?php
                                $fine = 0;
                                $todaytime = strtotime($today);
                                $returndaytime = strtotime($result['returndate']);
                                if($todaytime > $returndaytime){
                                  $time = $todaytime - $returndaytime;
                                  $timediv = $time / 86400;
                                  $timeint = (int)$timediv;
                                  $fine = 10 * $timeint;
                                  echo $fine . " tk";
                                }else{
                                  echo "$fine tk";
                                }
                              ?>
                              </td>
                            <td><a class="text-success font-weight-bold mr-3" class="mr-3" href="borrowdetails.php?detailsid=<?php echo $result['id'];?>&due=<?php echo $fine;?>&person=<?php echo $result['person'];?>&action=details"><i class="fas fa-list-alt"></i> Details</i></a>

                              <a class="text-danger font-weight-bold" onclick="return confirm('Are you sure to return this book? <?php if(isset($fine)){echo "Overdue fine = $fine tk.";}?>');" href="return.php?returnbookno=<?php echo $result['id'];?>&due=<?php echo $fine;?>&action=return"><i class="fas fa-exchange-alt"></i> Return</a></td>
                          </tr>
<?php } ?><!--end while loop-->
                        </tbody>
                    </table>
                  </div><!--end of borrow list-->
<!--pagination-->

<?php
$query = "SELECT * FROM lm_borrow WHERE status=0";
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
  echo "<tr><td colspan='7'><p class='text-danger font-weight-bold text-center'>No borrower!</p></td></tr></tbody></table></div>";
}
?>
<!--End of pagination-->


                  <!--End of Book list-->

                  </div><!--end of card-body-->
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