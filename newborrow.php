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
              <span class="font-weight-bold text-info">Borrow a book</span>
            </div>
            <!--for student-->
                  <div class="card-body border-bottom">

                    <?php
                      include("loadphp/borrowBook.php");
                      if (isset($newBorrowMsg)) {
                        echo $newBorrowMsg;
                      }
                    ?>

                    <form action="" method="POST">
                    <div class="form-group">
                      <label class="text-primary" for="person">Select an user</label>
                      <select class="form-control" id="person" name="person" required="1">
                        <option value="" selected="selected">Select a person</option>
                        <option value="student">Student</option>
                        <option value="staff">Staff</option>
                      </select>
                    </div>
                    <div id="allUser" class="form-group">
                      
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
                    <div id="allBook" class="form-group">
                      
                    </div>
                    <div class="form-group">
                      <label class="text-primary" for="borrowdate">Borrow date</label>
                      <input readonly="readonly" name="borrowdate" class="form-control" id="borrowdate" placeholder="Borrow date" value="<?php echo date('Y/m/d'); ?>" required="1">
                    </div>
                    <div class="form-group">
                      <label class="text-primary" for="returndate">Return date</label>
                      <input type="date" name="returndate" min="<?php echo date("Y-m-d");?>" class="form-control" id="returndate" placeholder="Return date" required="1">
                    </div>
                    <button type="submit" name="newborrow" class="btn btn-success btn-block">Confirm</button>
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