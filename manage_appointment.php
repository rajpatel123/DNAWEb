<?php 
require_once("lib/database.php");
require_once("lib/function.php");

$appointment = mysql_query("SELECT * FROM gosaloon_appointment WHERE status='1' order by appointment_date desc");



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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Appointment</a> </div>
    <h1>Manage Appointment</h1>
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
                  <strong>Success ! </strong> Appointment Delete Successfully. 
		</div>
		<!--Message-Part-End-->
		
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Manage Appointment</h5>
          </div>
          <div class="widget-content nopadding">
		  <div class="table-responsive">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Appointment No</th>
                  <th>Appointment Date</th>
                  <th>Appointment Time</th>
                  <th>Customer Name</th>
                  <th>Salon Name </th>
				  <th>Amount </th>
                  <th>Service </th>
                  <th>Payment Method </th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
			  $sn=1;
			  while($appointment_details = mysql_fetch_array($appointment)){?>
                <tr class="gradeX<?=$appointment_details['id'];?>">
                  <td class="center"><?=$sn;?></td>
                  <td><?=$appointment_details['appointment_no'];?></td>
                  <td><?=$appointment_details['appointment_date'];?></td>
                  <td><?=$appointment_details['appointment_time'];?></td>
				  
                  <td><?php $cus = mysql_fetch_array(mysql_query("SELECT * FROM gosaloon_customer WHERE id='".$appointment_details['customer_id']."'"));
				  echo $cus['fname'].' '.$cus['fname'];?>
				  </td>
				  
				  <td><?php $shop = mysql_fetch_array(mysql_query("SELECT * FROM gosaloon_onwer WHERE id='".$appointment_details['shop_id']."'"));
				  echo $shop['shop_name'];?>
				  </td>
				  
				   <?php if($appointment_details['package_id']=="0"){?>
				  <td>Rs : <?php $sub_details = mysql_fetch_array(mysql_query("SELECT * FROM gosaloon_sub_cat WHERE sub_cat_id='".$appointment_details['sub_cat_id']."' AND shop_id='".$appointment_details['shop_id']."'"));
				  
				  if($appointment_details['coupon_code']=="" || $appointment_details['package_id']==""){
				     echo $sub_details['price'];
				  }else{
				   $offer_code = mysql_fetch_array(mysql_query("SELECT * FROM gosaloon_coupon WHERE code='".$appointment_details['coupon_code']."'"));
				     if($offer_code['coupon_type']=='Fixed Price Coupon'){
					   echo $sub_details['price']-$offer_code['price'];
				     }else{
					   $offer_amount = ($sub_details['price']/100)*$offer_code['price'];
					   echo $sub_details['price']-$offer_amount;
				     }
				  }
				  ?>
				  </td>
				  <td><?=ucfirst($sub_details['sub_category_name']);?></td>
				  
				  <?php }else{ ?>
				     <td>Rs : <?php $package_details = mysql_fetch_array(mysql_query("SELECT * FROM gosaloon_package WHERE id='".$appointment_details['package_id']."' AND shop_id='".$appointment_details['shop_id']."'"));
				  echo $package_details['package_price'];?>
				  </td>
				  <td><i class="icon icon-gift"></i> <?=ucfirst($package_details['package_name']);?></td>
				  <?php } ?>
				  
				  <td><?=$appointment_details['payment_method'];?></td>
				  
                  <td><?php if($appointment_details['work_status']=='2'){ echo '<button class="btn btn-success btn-mini">Completed</button>'; }else if($appointment_details['work_status']=='3'){ echo '<button class="btn btn-danger btn-mini">Cancel</button>';}else if($appointment_details['work_status']=='1'){ echo '<button class="btn btn-warning btn-mini">Progress</button>';}else{echo '<button class="btn btn-button btn-mini">Awaited</button>';} ?></td>
				  
				  <?php if($appointment_details['work_status']=='3'){ echo "<td>--</td>";}else{?>
                  <td><a href="edit_appointment.php?id=<?=base64_encode($appointment_details['id']);?>"><span class="icon-edit"><span></a> &nbsp;&nbsp;
				  </td>
				  <?php } ?>
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
