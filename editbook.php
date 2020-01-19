<?php 
/*edit link set*/
if (isset($_GET['editBookno']) && $_GET['editBookno'] != NULL && $_GET['action'] == 'editBook') {
  $editbookid = $_GET['editBookno'];
  $id = $editbookid;
 ?>
<?php
include("inc/header.php");
include("loadphp/book.php");
?>

<!--main body section-->
<section>
  <!--main body conatiner-->
  <div class="container-fluid">
    <!--main body row-->
    <div class="row">
      <!--main content col div-->
      <div class="col-12">

        <div class="wrapprofile">
          
          <div class="card py-2">
                  <div class="card-body">

<!--user std data select-->
<?php
$query = "SELECT * FROM lm_book WHERE id='$editbookid'";
$query = $db->select($query);
if ($query != false) {
  while ($result = $query->fetch_assoc()) {
    $id = $result['id'];
    $bookname = $result['bookname'];
    $image = $result['image'];
    $bookcopies = $result['bookcopies'];
    $catname = $result['catname'];
    $author = $result['author'];
    $publisher = $result['publisher'];
  }
} else {
  echo "<script>window.location='404.php'</script>";
}
?><!--end of user std data select-->


<?php
  if (isset($editimageMsg)) {
    echo $editimageMsg;
  }
?>

             <!--edit book-->
            <form action="" method="POST" class="mb-2" enctype="multipart/form-data">

              <div class="form-group">
                <?php
                  if (isset($image)) {
                     echo "<img src='$image' class='w-25 d-block' alt='image'>";
                  }
                ?>
               
                <label for="image" class="font-weight-bold">Book image</label>
                <input type="file" name="image" id="image" class="custom-file" required="1">
              </div>
              <button type="submit" name="editBookImage" class="btn btn-success">Update</button>
            </form>


<?php
  if (isset($editBooknameMsg)) {
    echo $editBooknameMsg;
  }
?>

             <!--edit book-->
            <form action="" method="POST" class="mb-2">

              <div class="form-group">
                <label for="bookname" class="font-weight-bold">Book name</label>
                <input type="text" name="bookname" id="bookname" placeholder="Book name" class="form-control" value="<?php if(isset($bookname)){echo $bookname;}?>" required="1">
              </div>
              <button type="submit" name="editBookName" class="btn btn-success">Update</button>
            </form>

<?php
  if (isset($editBookMsg)) {
    echo $editBookMsg;
  }
?>
            <form action="" method="POST" class="mb-2">

              <div class="form-group">
                <label for="bookcopies" class="font-weight-bold">No of copies</label>
                <input type="number" name="bookcopies" min="0" id="bookcopies" placeholder="No of copies" class="form-control" value="<?php if(isset($bookcopies)){echo $bookcopies;}?>" required="1">
              </div>

              <div class="form-group">
                      <label class="font-weight-bold" for="catname">Category</label>
                      <select class="form-control" id="catname" name="catname" required="1">
                        <option value="">Select a book category</option>
<!--category select-->
<?php
$query = "SELECT * FROM lm_cat ORDER BY cat ASC";
$query = $db->select($query);
if ($query != false) {
  while ($result = $query->fetch_assoc()) { ?>
    
                        <option value="<?php echo $result['cat']; ?>" <?php if($result['cat'] == $catname){ echo "selected='selected'"; } ?>><?php echo $result['cat']; ?></option>

<?php } }  ?>
<!--end of category select-->
                      </select>
                    </div>

              <div class="form-group">
                <label for="author" class="font-weight-bold">Author</label>
                <input type="text" name="author" id="author" placeholder="Author" class="form-control" value="<?php if(isset($author)){echo $author;}?>" required="1">
              </div>

              <div class="form-group">
                <label for="publisher" class="font-weight-bold">Publisher</label>
                <input type="text" name="publisher" id="publisher" placeholder="Publisher" class="form-control" value="<?php if(isset($publisher)){echo $publisher;}?>" required="1">
              </div>

              <button type="submit" name="editBook" class="btn btn-success btn-block">Update</button>
            </form><!--end of login form-->
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
<?php }else{
  header("location:404.php");
}
?>