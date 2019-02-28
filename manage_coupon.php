<?php 
require_once("lib/database.php");
require_once("lib/function.php");

$coupon = mysql_query("SELECT * FROM gosaloon_coupon order by end_date desc");



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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Coupon</a> </div>
    <h1>Manage Coupon</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
       
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Manage Coupon</h5>
          </div>
          <div class="widget-content nopadding">
		  <div class="table-responsive">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Applied Shop</th>
                  <th>Coupon Name</th>
                  <th>Coupon Type</th>
                  <th>Price / %</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
			  $sn=1;
			  while($coupon_detail = mysql_fetch_array($coupon)){?>
                <tr class="gradeX<?=$coupon_detail['id']?>">
                  <td class="center"><?=$sn;?></td>
				  <td><?php if($coupon_detail['shop_id']=='0'){
					  echo "All Shop";
				  }else{
				  $shop = mysql_query("SELECT * FROM gosaloon_onwer WHERE id='".$coupon_detail['shop_id']."'");
				  $shop_details = mysql_fetch_array($shop);
				  echo  ucfirst($shop_details['shop_name']);}?></td>
                  <td><?=ucfirst($coupon_detail['name']);?></td>
                  <td><?=$coupon_detail['coupon_type'];?></td>
                  <td><?=$coupon_detail['price'];?></td>
                  <td><?=$coupon_detail['start_date'];?></td>
                  <td><?=$coupon_detail['end_date'];?></td>
                  <td><?php if(date("d-m-Y")< $coupon_detail['end_date']){ echo '<button class="btn btn-success btn-mini">Active</button>';}else{ echo '<button class="btn btn-danger btn-mini">Expired</button>';}?></td>
                  <td><a href="edit_coupon.php?id=<?=base64_encode($coupon_detail['id']);?>"><span class="icon-edit"><span></a>&nbsp;&nbsp;
				  <a href="javascript:void(0);" onclick="Delete('<?php print $coupon_detail['id'];?>','<?php print "Coupon";?>')"><span class="icon-trash"><span></a></td>
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
