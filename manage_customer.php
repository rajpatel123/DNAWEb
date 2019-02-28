<?php 
require_once("lib/database.php");
require_once("lib/function.php");

$customer = mysql_query("SELECT * FROM customer order by created_on desc");

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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Customer</a> </div>
    <h1>Manage Customer</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
	  
        <!--Message-Part-Start-->
        <div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Something went wrong.please try again. 
		</div>
		<div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Category Delete Successfully. 
		</div>
		<!--Message-Part-End-->
       
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Manage Customer</h5>
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
                  <th>Image</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
			  $sn=1;
			  while($customer_detail = mysql_fetch_array($customer)){?>
                <tr class="gradeX<?=$customer_detail['id']?>">
                  <td class="center"><?=$sn;?></td>
                  <td><?=ucfirst($customer_detail['fname'].' '.$customer_detail['lname']);?></td>
                  <td><?=$customer_detail['email_id'];?></td>
                  <td><?=$customer_detail['mobile_no'];?></td>
                  <td><?php if($customer_detail['image']!='' && file_exists('img/customer/'.$customer_detail['image'])){?> 
			      <img src="img/customer/<?=$customer_detail['image']?>" height="25" width="25" ><?php } ?></td>
                  <td><?php if($customer_detail['status']=='1'){ echo '<button class="btn btn-success btn-mini">Active</button>'; }else if($customer_detail['status']=='2'){ echo '<button class="btn btn-warning btn-mini">Suspend</button>';}else{ echo '<button class="btn btn-danger btn-mini">Inactive</button>';} ?></td>
                  <td><a href="view_customer.php?id=<?=base64_encode($customer_detail['id']);?>"><span class="icon-eye-open"><span></a>
				  &nbsp;&nbsp;
				  <a href="javascript:void(0);" onclick="Delete('<?php print $customer_detail['id'];?>','<?php print "Customer";?>')"><span class="icon-trash"><span></a>
				  </td>
                </tr>
			  <?php $sn++;} ?>
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
    <?php include("include/footer.php");?>
<!--end-Footer-part-->
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.tables.js"></script>
<script src="js/developer.js"></script>

</body>
</html>
