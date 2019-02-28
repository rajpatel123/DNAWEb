<?php

require_once("lib/database.php");
require_once("lib/function.php");

?>

<!DOCTYPE html>
<html lang="en">
    <?php include('segment/head.php');?>
<body>
<!--Header-part-->
     <?php include('segment/header.php');?>   
<!--close-Header-part--> 

<!--sidebar-menu-->
     <?php include ('segment/left_sidebar.php');?>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a></div>
  </div>
<!--End-breadcrumbs-->

<!--Action boxes-->
  <div class="container-fluid">
    <div class="quick-actions_homepage">
	
      <ul class="quick-actions">
       <!--
		<li class="bg_lb"> <a href="manage_shop.php"> <i class="icon-home"></i>
        <span class="label label-important">200</span>  Total Product </a> </li>	
          
        <li class="bg_ly"> <a href="manage_customer.php"> <i class="icon-user"></i>
		 <span class="label label-success">140</span>   Total Customer </a> </li>
		
        <li class="bg_lo"> <a href="manage_appointment.php"> <i class="icon-shopping-cart"></i> 
		<span class="label label-success">500</span>   Total Order</a> </li>
        
		<li class="bg_lg"> <a href="#"> <i class="icon-credit-card"></i><span class="label label-important">Rs :
		56020 </span> Total Payment</a> </li>
		
		
		<li class="bg_lb"> <a href="manage_product.php"> <i class="icon-home"></i>
		<?php $product_count = mysql_num_rows(mysql_query("select * from product where status='1'"));if($product_count > 0)	{?>
        <span class="label label-important"><?php echo $product_count;?></span>  Total Product <?php } ?></a> </li>	
          
        <li class="bg_ly"> <a href="manage_customer.php"> <i class="icon-user"></i>
		<?php $cus_count = mysql_num_rows(mysql_query("select * from customer where status='1'"));if($cus_count > 0)	{?>
		<span class="label label-success"><?php echo $cus_count;?></span>   Total Customer <?php } ?></a> </li>
		
        <li class="bg_lo"> <a href="manage_order.php"> <i class="icon-shopping-cart"></i> 
	    <?php $order_count = mysql_num_rows(mysql_query("select * from `order` where order_status='1' group by order_id"));if($order_count > 0)	{?>
		<span class="label label-success"><?php echo $order_count;?></span>   Total Order<?php } ?></a> </li>
        
		<li class="bg_lg"> <a href="manage_payment.php"> <i class="icon-credit-card"></i>
		<span class="label label-important">Rs : <?php $payment = mysql_query("select * from `order` where order_status='1' and payment_status='1' group by order_id"); 
	          $total =0;
			  while($payments = mysql_fetch_array($payment)){
				  
				  $total = $total+$payments['total_price'];
			  }
		 echo $total;?> </span> Total Payment</a> </li>
        
-->
      </ul>
	
    </div>
<!--End-Action boxes-->    
 </div>

</div>
<!--Footer-part-->
    <?php include("include/footer.php");?>
<!--end-Footer-part-->

<script src="js/excanvas.min.js"></script> 
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.flot.min.js"></script> 
<script src="js/jquery.flot.resize.min.js"></script> 
<script src="js/jquery.peity.min.js"></script> 
<script src="js/fullcalendar.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.dashboard.js"></script> 
<script src="js/jquery.gritter.min.js"></script> 
<script src="js/matrix.interface.js"></script> 
<script src="js/matrix.chat.js"></script> 
<script src="js/jquery.validate.js"></script> 
<script src="js/matrix.form_validation.js"></script> 
<script src="js/jquery.wizard.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/matrix.popover.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.tables.js"></script> 

<script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
              resetMenu();            
          } 
          // else, send page to designated URL            
          else {  
            document.location.href = newURL;
          }
      }
  }

// resets the menu selection upon entry to this page:
function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}
</script>

</body>
</html>
