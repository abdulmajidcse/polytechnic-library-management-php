<?php 
/*edit link set*/
if (isset($_GET['editCatno']) && $_GET['editCatno'] != NULL && $_GET['action'] == 'editCat') {
  $editcatid = $_GET['editCatno'];
 ?>
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

        <div class="wrapprofile">
          
          <div class="card py-2">
                  <div class="card-body">

<!--user std data select-->
<?php
$query = "SELECT * FROM lm_cat WHERE id='$editcatid'";
$query = $db->select($query);
if ($query != false) {
  while ($result = $query->fetch_assoc()) {
    $id = $result['id'];
    $cat = $result['cat'];
  }
} else {
  echo "<script>window.location='404.php'</script>";
}
?><!--end of user std data select-->

                    <?php
                      include("loadphp/category.php");
                      if (isset($editCatMsg)) {
                        echo $editCatMsg;
                      }
                    ?>

             <!--login form-->
            <form action="" method="POST" class="mb-2">

              <div class="form-group">
                <label for="cat" class="font-weight-bold">Category name</label>
                <input type="text" name="cat" id="cat" placeholder="Category name" class="form-control" value="<?php if(isset($cat)){echo $cat;}?>" required="1">
              </div>

              <button type="submit" name="editCat" class="btn btn-success btn-block">Update</button>
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