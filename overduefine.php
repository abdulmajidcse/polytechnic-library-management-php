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
              <p class="h3 text-center">Kurigram Polytechnic Institute, Kurigram</p>
              <p class="text-center font-weight-bold"><em>Library Management</em></p>
              <span class="font-weight-bold text-info">Overdue fine list</span>
            </div>
            <!--card-body-->
                  <div class="card-body border-bottom">
                    <?php
                      $query = "SELECT * FROM lm_fine";
                      $query = $db->select($query);
                      if ($query != false) { ?>
                    <div class="p-1 mb-2">
                      <h5 class="text-warning">Print this document before submit. Because this document will delete automatically after submit.</h5>
                      <p><button class="btn btn-primary btn-sm" onclick="pageprint()">Print</button> <button class="btn btn-success btn-sm"><a href="finesubmit.php" class="text-light">Submit</a></button></p>
                    </div>
                      <?php } ?>

                  <!--overdue fine list-->
                  <div style="overflow-x:auto;">
                    <table class="table table-striped table-bordered w-100">
                      <thead>
                          <tr>
                            <th scope="col">Serial</th>
                            <th scope="col">Username</th>
                            <th scope="col">Overdue fine date</th>
                            <th scope="col">Overdue fine</th>
                          </tr>
                        </thead>
                        <tbody>

<!--add new categories php code-->
<?php
$query = "SELECT * FROM lm_fine ORDER BY finedate DESC";
$query = $db->select($query);
if ($query != false) {
  $i = 0;
  $totalfine = 0;
  while ($result = $query->fetch_assoc()) { $i++; $totalfine += $result['fine']; ?>
                          
                          <tr class="tr">
                            <td><?php echo $i;?></td>
                            <td><?php echo $result['uname'];?>
                            <td><?php echo $result['finedate'];?></td>
                            <td><?php echo $result['fine'] . " tk";?></td>
                          </tr>
<?php } ?><!--end while loop-->
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="3" class="text-center">
                              Total fine
                            </th>
                            <th><?php echo $totalfine . " tk"; ?></th>
                          </tr>
                        </tfoot>
                    </table>

                  </div><!--end of borrow list-->

<?php
} else {
  echo "<tr><td colspan='7'><p class='text-danger font-weight-bold text-center'>Overdue fine not available!</p></td></tr></tbody></table></div>";
}
?>
<!--End of pagination-->


                  <!--End of Book list-->

                  </div><!--end of card-body-->
                </div>

                  <div class="row mt-5">
                    <div class="col-6">
                      <p class="ml-2 p-4 font-weight-bold"><u>Receiver's signature</u></p>
                    </div>
                    <div class="col-6 text-right">
                      <p class="mr-2 p-4 font-weight-bold"><u>Librarian's signature</u></p>
                    </div>
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