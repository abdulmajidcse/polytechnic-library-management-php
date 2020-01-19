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
              <span class="font-weight-bold text-info">Users list (Student)</span>
            </div>
            <!--card-body-->
                  <div class="card-body border-bottom">

                    <div class="p-1 mb-2">
                      <a href="userlistStd.php" class="btn border mr-1 bg-info text-light">Student list</a>
                      <a href="userlistStaff.php" class="btn border mr-3">Staff list</a>
                      <input type="text" name="search" placeholder="Search a student..." class="form-control" style="display: inline;width: auto;" id="liveSearch">
                    </div>
<!--delete confirm-->
<?php
if (isset($_GET['delcon']) && $_GET['delcon'] == 'cant') {
  echo "<p class='alert alert-warning'>Can't delete this user! Because this user has in borrow list or return list.</p>";
}elseif (isset($_GET['delcon']) && $_GET['delcon'] == 'yes') {
  echo "<p class='alert alert-success'>User data deleted successfully!</p>";
}elseif (isset($_GET['delcon']) && $_GET['delcon'] == 'no') {
  echo "<p class='alert alert-warning'>User data not deleted!</p>";
}
?>

                  <!--student user list-->
                  <div style="overflow-x:auto;">
                    <table id="liveTable" class="table table-striped table-bordered w-100">
                      <thead>
                          <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Photo</th>
                            <th scope="col">Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Mobile</th>
                            <th scope="col">Address</th>
                            <th scope="col">Department</th>
                            <th scope="col">Semester</th>
                            <th scope="col">Shift</th>
                            <th scope="col">Roll</th>
                            <th scope="col">Library card no</th>
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

$query = "SELECT * FROM lm_user WHERE person='student' ORDER BY id DESC LIMIT $start_from, $per_page";
$query = $db->select($query);
if ($query != false) {
  $i = $start_from;
  while ($result = $query->fetch_assoc()) { $i++; ?>
                          <tr class="tr">
                            <td><?php echo $i;?></td>
                            <td><img id="imgmodal" class="rounded" style="width: 100px;" src="<?php echo $result['image'];?>" data-toggle="modal" data-target="#imgmodals" alt="Photo"></td>
                            <td><?php echo $result['fname']. " " . $result['sname'];?></td>
                            <td><?php echo $result['uname'];?></td>
                            <td><?php echo $result['mobile'];?></td>
                            <td><?php echo $result['address'];?></td>
                            <td><?php echo $result['department'];?></td>
                            <td><?php echo $result['semester'];?></td>
                            <td><?php echo $result['shift'];?></td>
                            <td><?php echo $result['roll'];?></td>
                            <td><?php echo $result['lcardno'];?></td>
                            <td><a class="mr-3" href="editUserStd.php?editStd=<?php echo $result['id'];?>&action=editUserStd"><i class="fas fa-edit" style="font-size:25px;"></i></a>

                              <a onclick="return confirm('Are you sure to delete the user?');" href="delete.php?delUserStd=<?php echo $result['id'];?>&deluname=<?php echo $result['uname'];?>&action=delStd"><i class="fas fa-trash-alt" style="font-size:25px;"></i></a></td>
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
  echo "<tr><td colspan='12'><p class='text-danger font-weight-bold text-center'>No user!</p></td></tr></tbody></table></div>";
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