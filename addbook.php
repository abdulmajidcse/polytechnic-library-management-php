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
              <span class="font-weight-bold text-info">Add new Category</span>
            </div>
            <!--for student-->
                  <div class="card-body border-bottom">

                    <?php
                      include("loadphp/book.php");
                      if (isset($addbookmsg)) {
                        echo $addbookmsg;
                      }
                    ?>

                    <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label class="text-primary" for="bookname">Book Name</label>
                      <input type="text" name="bookname" class="form-control" id="bookname" placeholder="Book name" required="1">
                    </div>
                    <div class="form-group">
                      <label class="text-primary" for="image">Book Image</label>
                      <input type="file" name="image" class="custom-file" id="image" required="1">
                    </div>
                    <div class="form-group">
                      <label class="text-primary" for="bookcopies">Number of copies</label>
                      <input type="number" min="0" name="bookcopies" class="form-control" id="bookcopies" placeholder="Number of copies" required="1">
                    </div>
                    <div class="form-group">
                      <label class="text-primary" for="catname">Book category</label>
                      <select class="form-control" id="catname" name="catname" required="1">
                        <option value="" selected="">Select a book category</option>
<!--category select-->
<?php
$query = "SELECT * FROM lm_cat ORDER BY cat ASC";
$query = $db->select($query);
if ($query != false) {
  while ($result = $query->fetch_assoc()) { ?>
    
                        <option value="<?php echo $result['cat']; ?>"><?php echo $result['cat']; ?></option>

<?php } }  ?>
<!--end of category select-->
                      </select>
                    </div>
                    <div class="form-group">
                      <label class="text-primary" for="author">Author Name</label>
                      <input type="text" name="author" class="form-control" id="author" placeholder="Book author name" required="1">
                    </div>
                    <div class="form-group">
                      <label class="text-primary" for="publisher">Publisher Name</label>
                      <input type="text" name="publisher" class="form-control" id="publisher" placeholder="Book publisher name" required="1">
                    </div>
                    <button type="submit" name="addbook" class="btn btn-success btn-block">Add</button>
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
?>