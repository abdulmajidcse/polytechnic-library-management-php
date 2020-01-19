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
                      <input type="text" name="search" placeholder="Search a book..." class="form-control" style="display: inline;width: auto;" id="liveSearch">
                    </div>
<!--delete confirm-->
<?php
if (isset($_GET['delcon']) && $_GET['delcon'] == 'cant') {
  echo "<p class='alert alert-warning'>Can't delete this book! Because this book has in the borrow list or return list.</p>";
}elseif (isset($_GET['delcon']) && $_GET['delcon'] == 'yes') {
  echo "<p class='alert alert-success'>Book deleted successfully!</p>";
}elseif (isset($_GET['delcon']) && $_GET['delcon'] == 'no') {
  echo "<p class='alert alert-warning'>Book not deleted!</p>";
}
?>

                  <!--student user list-->
                  <div style="overflow-x:auto;">
                    <table id="liveTable" class="table table-striped table-bordered w-100">
                      <thead>
                          <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Book image</th>
                            <th scope="col">Book name</th>
                            <th scope="col">No of copies</th>
                            <th scope="col">Category</th>
                            <th scope="col">Author</th>
                            <th scope="col">Publisher</th>
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

$query = "SELECT * FROM lm_book ORDER BY id DESC LIMIT $start_from, $per_page";
$query = $db->select($query);
if ($query != false) {
  $i = $start_from;
  while ($result = $query->fetch_assoc()) { $i++; ?>
                          <tr class="tr">
                            <td><?php echo $i;?></td>
                            <td><img id="imgmodal" class="rounded" style="width: 100px;" src="<?php echo $result['image'];?>" data-toggle="modal" data-target="#imgmodals" alt="Image"></td>
                            <td><?php echo $result['bookname'];?></td>
                            <td><?php echo $result['bookcopies'];?>
                            <td><?php echo $result['catname'];?></td>
                            <td><?php echo $result['author'];?></td>
                            <td><?php echo $result['publisher'];?></td>
                            <td><a class="mr-3" href="editbook.php?editBookno=<?php echo $result['id'];?>&action=editBook"><i class="fas fa-edit" style="font-size:25px;"></i></a>

                              <a onclick="return confirm('Are you sure to delete the book?');" href="delete.php?delBookno=<?php echo $result['id'];?>&delBook=<?php echo $result['bookname'];?>&action=delBook"><i class="fas fa-trash-alt" style="font-size:25px;"></i></a></td>
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
$query = "SELECT * FROM lm_book";
$query = $db->select($query);
$total_rows = mysqli_num_rows($query);
$pages = ceil($total_rows / $per_page);
  if ($pages > 1) { ?>
  <!--pagination-->
  <div class="container-fluid" style="overflow: auto;">

    <span class="float-left text-info h4 mt-1 mr-2">Page : </span>
   <?php for ($i=1; $i <= $pages; $i++) { ?>

    <a href="booklist.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
    
   <?php } ?>
  </div><!--end of pagination-->

<?php }
} else {
  echo "<tr><td colspan='8'><p class='text-danger font-weight-bold text-center'>No book!</p></td></tr></tbody></table></div>";
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