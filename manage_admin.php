<?php 
require_once("lib/database.php");
require_once("lib/function.php");

$admin = mysql_query("SELECT * FROM users WHERE type='Admin' order by created_on desc");



?>
<!DOCTYPE html>
<html lang="en">
<!--Head-part-->
   <?php include("segment/head.php");?>
<!--close-Head-part-->
<body>

<!--Header-part-->
   <?php include("segment/header.php");?>   
<!--close-Header-part--> 

<!--sidebar-menu-->
    <?php include("segment/left_sidebar.php");?>
<!--close-sidebar-menu-->

<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Admin</a> </div>
    <h1>Manage Admin</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
       
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Manage Admin</h5>
          </div>
          <div class="widget-content nopadding">
          <div class="table-responsive">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Email Id</th>
                  <th>Mobile No</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
			  $sn=1;
			  while($admin_detail = mysql_fetch_array($admin)){?>
                <tr class="gradeX">
                  <td class="center"><?=$sn;?></td>
                  <td><?=ucfirst($admin_detail['name']);?></td>
                  <td><?=$admin_detail['email'];?></td>
                  <td><?=$admin_detail['mobile_no'];?></td>
                  <td><?php if($admin_detail['status']=='1'){ echo '<button class="btn btn-success btn-mini">Active</button>'; }else{ echo '<button class="btn btn-danger btn-mini">Inactive</button>';} ?></td>
                  <td><a href="view_admin.php?id=<?=base64_encode($admin_detail['id']);?>"><span class="icon-eye-open"><span></a></td>
                </tr>
			  <?php } ?>
              </tbody>
            </table>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
    <?php include("segment/footer.php");?>
<!--end-Footer-part-->
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.tables.js"></script>

</body>
</html>
