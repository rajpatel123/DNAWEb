<?php 
require_once("lib/database.php");
require_once("lib/function.php");

$payment = mysql_query("SELECT * FROM `order` Where order_status='1' group by order_id");



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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Payment</a> </div>
    <h1>Manage Payment</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
       
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Manage Payment</h5>
          </div>
          <div class="widget-content nopadding">
		  <div class="table-responsive">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Order No</th>
                  <th>Amount</th>
                  <th>Payment Type</th>
                  <th>Payment Date</th>
                  <th>Payment Status</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
			  $sn=1;
			  while($payment_detail = mysql_fetch_array($payment)){?>
                <tr class="gradeX<?=$payment_detail['id']?>">
                  <td class="center"><?=$sn;?></td>
                  <td><?=$payment_detail['order_id']?></td>
                  <td><?=$payment_detail['total_price'];?></td>
                  <td><?php if($payment_detail['payment_type']==1){ echo "Cash"; }else{ echo "Online";}?></td>
                   <td><?=$payment_detail['payment_date']?></td>
                  <td><?php if($payment_detail['payment_status']=='1'){ echo '<button class="btn btn-success btn-mini">Done</button>'; }else{ echo '<button class="btn btn-warning btn-mini">Pending</button>';} ?></td>
                  
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
<script src="js/developer-validation.js"></script>


</body>
</html>
