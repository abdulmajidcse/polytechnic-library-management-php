<?php 
/*edit link set*/
if (isset($_GET['editStd']) && $_GET['editStd'] != NULL && $_GET['action'] == 'editUserStd') {
  $editstdid = $_GET['editStd'];
  $id = $editstdid;
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
$query = "SELECT * FROM lm_user WHERE id='$editstdid'";
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
    $semester = $result['semester'];
    $shift = $result['shift'];
    $roll = $result['roll'];
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
              <button type="submit" name="editUserStdImage" class="btn btn-success">Update</button>
            </form>


<?php
  if (isset($editunameMsg)) {
    echo $editunameMsg;
  }
?>

             <!--student edit form-->
             <form action="" method="POST" class="mb-2">
              <div class="form-group">
                <label for="uname" class="font-weight-bold">Username</label>
                <input type="text" name="uname" id="uname" placeholder="Username" class="form-control" value="<?php if(isset($uname)){echo $uname;}?>" required="1">
              </div>
              <button type="submit" name="edituname" class="btn btn-success">Update</button>
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
              <button type="submit" name="editmobile" class="btn btn-success">Update</button>
             </form>

<?php
  if (isset($editrollMsg)) {
    echo $editrollMsg;
  }
?>
             <form action="" method="POST" class="mb-2">
              <div class="form-group">
                <label for="roll" class="font-weight-bold">Roll</label>
                <input type="number" name="roll" min="1" id="roll" placeholder="Roll" class="form-control" value="<?php if(isset($roll)){echo $roll;}?>" required="1">
              </div>
              <button type="submit" name="editroll" class="btn btn-success">Update</button>
             </form>

<?php
  if (isset($editStdMsg)) {
    echo $editStdMsg;
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
                <label for="semester" class="font-weight-bold">Semester</label>
                <input type="text" name="semester" id="semester" placeholder="Semester" class="form-control" value="<?php if(isset($semester)){echo $semester;}?>" required="1">
              </div>

              <div class="form-group">
                <label for="shift" class="font-weight-bold">Shift</label>
                <input type="text" name="shift" id="shift" placeholder="Shift" class="form-control" value="<?php if(isset($shift)){echo $shift;}?>" required="1">
              </div>

              <button type="submit" name="editStd" class="btn btn-success btn-block">Update</button>
            </form><!--end of student edit form-->
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