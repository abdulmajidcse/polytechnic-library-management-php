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
              <span class="font-weight-bold text-info">Book list</span>
            </div>
            <!--card-body-->
                  <div class="card-body border-bottom">

                    <div class="p-1 mb-2">
                      <input type="text" name="search" placeholder="Search a category..." class="form-control" style="display: inline;width: auto;" id="liveSearch">
                    </div>
<!--delete confirm-->
<?php
if (isset($_GET['delcon']) && $_GET['delcon'] == 'cant') {
  echo "<p class='alert alert-warning'>Can't delete this category! Because this cateogry has some books.</p>";
}elseif (isset($_GET['delcon']) && $_GET['delcon'] == 'yes') {
  echo "<p class='alert alert-success'>Category deleted successfully!</p>";
}elseif (isset($_GET['delcon']) && $_GET['delcon'] == 'no') {
  echo "<p class='alert alert-warning'>Category not deleted!</p>";
}
?>

                  <!--category list-->
                  <div style="overflow-x:auto;">
                    <table id="liveTable" class="table table-striped table-bordered w-100">
                      <thead>
                          <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Category</th>
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

$query = "SELECT * FROM lm_cat ORDER BY id DESC LIMIT $start_from, $per_page";
$query = $db->select($query);
if ($query != false) {
  $i = $start_from;
  while ($result = $query->fetch_assoc()) { $i++; ?>
                          <tr class="tr">
                            <td><?php echo $i;?></td>
                            <td><?php echo $result['cat'];?></td>
                            <td><a class="mr-3" href="editcat.php?editCatno=<?php echo $result['id'];?>&action=editCat"><i class="fas fa-edit" style="font-size:25px;"></i></a>

                              <a onclick="return confirm('Are you sure to delete the category?');" href="delete.php?delCatno=<?php echo $result['id'];?>&delCat=<?php echo $result['cat'];?>&action=delCat"><i class="fas fa-trash-alt" style="font-size:25px;"></i></a></td>
                          </tr>
<?php } ?><!--end while loop-->
                        </tbody>
                    </table>
                  </div> <!--end of category list-->
<!--pagination-->

<?php
$query = "SELECT * FROM lm_cat";
$query = $db->select($query);
$total_rows = mysqli_num_rows($query);
$pages = ceil($total_rows / $per_page);
  if ($pages > 1) { ?>
  <!--pagination-->
  <div class="container-fluid" style="overflow: auto;">

    <span class="float-left text-info h4 mt-1 mr-2">Page : </span>
   <?php for ($i=1; $i <= $pages; $i++) { ?>

    <a href="catlist.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
    
   <?php } ?>
  </div><!--end of pagination-->

<?php }
} else {
  echo "<tr><td colspan='3'><p class='text-danger font-weight-bold text-center'>No category!</p></td></tr></tbody></table></div>";
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