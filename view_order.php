<?php 
require_once("lib/database.php");
require_once("lib/function.php");
if($_GET['id']!=''){
	$id = base64_decode($_GET['id']);
}else{
	header("Location:logout.php");
}

$order = mysql_query("SELECT * FROM `order` WHERE order_id='".$id."'");
$orders = mysql_query("SELECT * FROM `order` WHERE order_id='".$id."'");
$order_d = mysql_fetch_array($orders);
$customer = mysql_fetch_array(mysql_query("select * from  address  where customer_id='".$order_d['customer_id']."'"));

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

<style>
.table_invoice td{border-top: transparent !important;}
</style>


<div id="content">
 <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">View Product</a> </div>
    <h1>View Product</h1>
  </div>
  
   <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> 
            <h5>Order No : 	<?=$id?></h5>
          </div>
		  <div class="widget-content nopadding">
		   <div class="table-responsive">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Product Name</th>
                  <th>Product QTY</th>
                  <th>Product Price</th>
                  <th>Total Price</th>
                </tr>
               
              </thead>
			  
			  <tbody>
			       <?php 
			       $total=0;
			       $sn = 1;
			       while ($detail = mysql_fetch_array($order)){
			       $pdetail = mysql_fetch_array(mysql_query("select * from product where id='".$detail['product_id']."'"));
			       ?>
		     	<tr>
                  <td><?=$sn?></td>
                  <td><?=ucfirst($pdetail['product_name'])?></td>
                  <td><?=$detail['quantity']?></td>
                  <td>Rs : <?=$pdetail['product_sprice'].'.'."00";?></td>
                  <td>Rs : <?=$detail['price'].'.'."00";?></td>
                  <?php $total = $total+$detail['price']; ?>
                </tr>
				 <?php $sn++;} ?>
				<tr>
                  <td colspan="3">&nbsp;</td>
                  <td>Total </br >GST (3%) </br> Delivery Charge</td>
                  <td>Rs : <?=$total.'.'."00";?> </br> 
                      Rs : <?php $gst = (int)($total*(3/100)); echo $gst.'.'."00";?> <br>
                      Rs : <?php if($customer['state']=="delhi"){ echo $delivery = "100.00";}else{ echo $delivery = "300.00";}?>
                  </td>
                </tr>
                
                <tr>
                  <td colspan="3">&nbsp;</td>
                  <td>Total Amount</td>
                  <td>Rs : <?php $total_amount = $total+$gst+$delivery; echo $total_amount.'.'."00";?>
                   
                  </td>
                </tr>
			  </tbody>
			  
            </table>
           </div>
		  </div>
		</div>
		
	   <div class="clearfix"></div><br />
	 
		<div class="table_invoice">
		 <div class="span4"> 
		  <div class="table-responsive">
		   <h5>Order Details :- </h5>
			<table class="table data-table">
			  
			  <tbody>
			   <!--
			   <tr>
				  <td><strong>Order Type : </strong></td>
				  <td><?php if($order_d['payment_type']=='1'){
				  echo "Cash";}else{echo "Online";} ?></td>
			   </tr>-->	

			   <tr>
				  <td><strong>Order Date : </strong></td>
				   <td><?php echo date("Y-m-d", strtotime($order_d['created_on']))?>
				   
				   </td>
			   </tr>	

			   <tr>
				  <td><strong>Order Status : </strong></td>
				  <td><?php if($order_d['delivery_status']=='1'){
				  echo "Done";}else{echo "Progress";} ?></td>
			   </tr>
			   
			    <tr>
				  <td><strong>Order Date : </strong></td>
				   <td><?php $date = date("Y-m-d", strtotime($order_d['created_on']));
				   echo date('Y-m-d', strtotime($date. ' + 7 days'));;
				   ?>
				   
				   </td>
			   </tr>
			   
			  </tbody>	  
			</table>
		   </div>
		  </div>
		  
		  <div class="span4"> </div>
		  
		 <div class="span4"> 
		  <div class="table-responsive">
		   <h5>Customer Details :-</h5>
			<table class="table data-table">
			  
			  <tbody> 
			  
			    <tr>
				  <td><strong> Name : </strong></td>
				  <td><?=ucfirst($customer['name'])?></td>
			   </tr>

			    <tr>
				  <td><strong>Phone no : </strong></td>
				  <td><?=$customer['phone']?></td>
			   </tr>	

			   <tr>
				   <td><strong> Address : </strong></td>
				   <td><?=$customer['line1'].','.$customer['line2'].','.$customer['city'].','.$customer['state'].','.$customer['country'].','.$customer['pincode']?></td>
			   </tr>
	 
			  
			  </tbody>	  
			</table>
		   </div>
		  </div>
		  
		<div class="clearfix"></div><br />
		  
		 <div class="span4" style="margin:0px;"> 
		  <div class="table-responsive">
		   <h5>Payment Details :-</h5>
			<table class="table data-table">
			  
			  <tbody> 
              <tr>
				  <td><strong>Payment Type : </strong></td>
				  <td><?php if($order_d['payment_type']=='1'){
				  echo "Cash";}else{echo "Online";} ?></td>
			   </tr>

			  <tr>
				  <td><strong>Payment Status : </strong></td>
				  <td><?php if($order_d['payment_status']=='1'){
				  echo "Done";}else{echo "Pending";} ?></td>
			   </tr>	

			   
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
<script src="js/developer.js"></script>

</body>
</html>
