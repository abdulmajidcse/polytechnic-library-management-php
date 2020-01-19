<?php 
/*edit link set*/
if (isset($_GET['editStaff']) && $_GET['editStaff'] != NULL && $_GET['action'] == 'editUserStaff') {
  $editstaffid = $_GET['editStaff'];
  $id = $editstaffid;
 ?>
<?php
include("inc/header.php");
include("loadphp/user.php");
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
$query = "SELECT * FROM lm_user WHERE id='$editstaffid'";
$query = $db->select($query);
if ($query != false) {
  while ($result = $query->fetch_assoc()) {
    $id = $result['id'];
    $fname = $result['fname'];
    $sname = $result['sname'];
    $uname = $result['uname'];
    $mobile = $result['mobile'];
    $address = $result['address'];
    $department = $result['department'];
    $designation = $result['designation'];
    $image = $result['image'];
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
                     echo "<img src='$image' class='w-25 d-block' alt='Photo'>";
                  }
                ?>
               
                <label for="image" class="font-weight-bold">Photo</label>
                <input type="file" name="image" id="image" class="custom-file" required="1">
              </div>
              <button type="submit" name="editUserStaffImage" class="btn btn-success">Update</button>
            </form>


<?php
  if (isset($editunameMsg)) {
    echo $editunameMsg;
  }
?>

             <!--staff user form-->
             <form action="" method="POST" class="mb-2">
              <div class="form-group">
                <label for="uname" class="font-weight-bold">Username</label>
                <input type="text" name="uname" id="uname" placeholder="Username" class="form-control" value="<?php if(isset($uname)){echo $uname;}?>" required="1">
              </div>
              <button type="submit" name="editunamestaff" class="btn btn-success">Update</button>
             </form>


<?php
  if (isset($editmobileMsg)) {
    echo $editmobileMsg;
  }
?>
             <form action="" method="POST" class="mb-2">
              <div class="form-group">
                <label for="mobile" class="font-weight-bold">Mobile number</label>
                <input type="text" name="mobile" id="mobile" placeholder="Mobile number" class="form-control" value="<?php if(isset($mobile)){echo $mobile;}?>" required="1">
              </div>
              <button type="submit" name="editmobilestaff" class="btn btn-success">Update</button>
             </form>

<?php
  if (isset($editStaffMsg)) {
    echo $editStaffMsg;
  }
?>
            <form action="" method="POST" class="mb-2">

              <div class="form-group">
                <label for="fname" class="font-weight-bold">First name</label>
                <input type="text" name="fname" id="fname" placeholder="Fist name" class="form-control" value="<?php if(isset($fname)){echo $fname;}?>" required="1">
              </div>

              <div class="form-group">
                <label for="sname" class="font-weight-bold">Surname</label>
                <input type="text" name="sname" id="sname" placeholder="Surname" class="form-control" value="<?php if(isset($sname)){echo $sname;}?>" required="1">
              </div>
              
              <div class="form-group">
                <label for="address" class="font-weight-bold">Address</label>
                <input type="text" name="address" id="address" placeholder="Address" class="form-control" value="<?php if(isset($address)){echo $address;}?>" required="1">
              </div>

              <div class="form-group">
                <label for="department" class="font-weight-bold">Department</label>
                <input type="text" name="department" id="department" placeholder="Department" class="form-control" value="<?php if(isset($department)){echo $department;}?>" required="1">
              </div>

              <div class="form-group">
                <label for="designation" class="font-weight-bold">designation</label>
                <input type="text" name="designation" id="Designation" placeholder="Designation" class="form-control" value="<?php if(isset($designation)){echo $designation;}?>" required="1">
              </div>

              <button type="submit" name="editStaff" class="btn btn-success btn-block">Update</button>
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