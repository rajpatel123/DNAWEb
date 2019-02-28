<?php
$url =  $_SERVER['PHP_SELF']; 
$urlArray = explode("/",$url);
$page = $urlArray[3];
?>

<div id="sidebar">
<a href="#" class="visible-phone"><i class="icon icon-reorder"></i> Menu</a>
  <ul>
  
	<li class="<?php if($page=='dashboard.php'){ echo "active";}?>"><a href="dashboard.php"><i class="icon icon-dashboard"></i> <span>Dashboard</span></a></li>
	
    <li class="submenu <?php if($page=='manage_admin.php' || $page=='view_admin.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-th-list"></i> <span>Admin </span></a>
      <ul>
        <li class="<?php if($page=='manage_admin.php' || $page=='view_admin.php'){ echo "active";}?>"><a href="manage_admin.php">Manage Admin</a></li>
      </ul>
    </li>
	<!--
	<li class="submenu <?php if($page=='manage_customer.php' || $page=='view_customer.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-user"></i> <span>Customer</span></a>
      <ul>
        <li class=" <?php if($page=='manage_customer.php'|| $page=='view_customer.php'){ echo "active";}?>"><a href="manage_customer.php">Manage Customer</a></li>
      </ul>
    </li>
	-->
	<li class="submenu <?php if($page=='add_category.php' || $page=='manage_category.php' || $page=='edit_category.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-home"></i> <span>Category </span></a>
      <ul>
	    <li class="<?php if($page=='add_category.php'){ echo "active";}?>"><a href="add_category.php">Add Category</a></li>
        <li class="<?php if($page=='manage_category.php' || $page=='edit_category.php'){ echo "active";}?>"><a href="manage_category.php">Manage Category</a></li>
      </ul>
    </li>
	
	<li class="submenu <?php if($page=='add_subcategory.php' || $page=='manage_subcategory.php' || $page=='edit_subcategory.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-home"></i> <span>Sub Category </span></a>
      <ul>
	    <li class="<?php if($page=='add_subcategory.php'){ echo "active";}?>"><a href="add_subcategory.php">Add Sub Category</a></li>
        <li class="<?php if($page=='manage_subcategory.php' || $page=='edit_subcategory.php'){ echo "active";}?>"><a href="manage_subcategory.php">Manage Sub Category</a></li>
      </ul>
    </li>
	
	<li class="submenu <?php if($page=='add_childcategory.php' || $page=='manage_childcategory.php' || $page=='edit_childcategory.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-home"></i> <span>Sub Child Category</span></a>
      <ul>
	    <li class="<?php if($page=='add_childcategory.php'){ echo "active";}?>"><a href="add_childcategory.php">Add Sub Child Category</a></li>
        <li class="<?php if($page=='manage_childcategory.php' || $page=='edit_childcategory.php'){ echo "active";}?>"><a href="manage_childcategory.php">Manage Sub Child Category</a></li>
      </ul>
    </li>
    
    <li class="submenu <?php if($page=='add_file.php' || $page=='manage_file.php' || $page=='edit_file.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-home"></i> <span>All Video/Pdf</span></a>
      <ul>
	    <li class="<?php if($page=='add_file.php'){ echo "active";}?>"><a href="add_file.php">Add Video/Pdf</a></li>
        <li class="<?php if($page=='manage_file.php' || $page=='edit_file.php'){ echo "active";}?>"><a href="manage_file.php">Manag eVideo/Pdf</a></li>
      </ul>
    </li>
    
    
    <li class="submenu <?php if($page=='add_test.php' || $page=='manage_test.php' || $page=='edit_test.php' || $page=='add_question.php' || $page=='manage_test_question.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-home"></i> <span>Test</span></a>
      <ul>
	    <li class="<?php if($page=='add_test.php'){ echo "active";}?>"><a href="add_test.php">Add Test</a></li>
        <li class="<?php if($page=='manage_test.php' || $page=='edit_test.php' || $page=='add_question.php' || $page=='manage_test_question.php'){ echo "active";}?>"><a href="manage_test.php">Manag Test</a></li>
      </ul>
    </li>
    
	<!--
	<li class="submenu <?php if($page=='add_shop.php' || $page =='manage_shop.php' || $page=='shop_subcategory.php' || $page=='add_subcategory.php' || $page=='shop_category.php' || $page =='edit_subcategory.php' || $page=='edit_shop.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-home"></i> <span>Shop Management</span></a>
      <ul>
	    <!--<li class="<?php if($page=='add_shop.php'){ echo "active";}?>"><a href="add_shop.php">Add Shop</a></li>-->
        <!--<li class="<?php if($page =='manage_shop.php' || $page=='shop_category.php' || $page=='shop_subcategory.php' || $page=='add_subcategory.php' || 'edit_subcategory.php'){ echo "active";}?>"><a href="manage_shop.php">Manage Shop</a></li>
      </ul>
    </li>
	
	<li class="submenu <?php if($page =='add_product.php' || $page =='edit_product.php' || $page =='manage_product.php' || $page =='view_product.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-calendar"></i> <span>Product </span></a>
      <ul>
	    <li class="<?php if($page =='add_product.php'){ echo "active";}?>"><a href="add_product.php">Add Product</a></li>
        <li class="<?php if($page =='manage_product.php' || $page =='edit_product.php' || $page =='view_product.php'){ echo "active";}?>"><a href="manage_product.php">Manage Product</a></li>
      </ul>
    </li>
    
    	<li class="submenu <?php if($page =='manage_order.php' || $page =='view_order.php' || $page=='edit_order.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-credit-card"></i> <span>Order </span></a>
      <ul>
        <li class="<?php if($page =='manage_order.php' || $page=='edit_order.php' || $page=='view_order.php'){ echo "active";}?>"><a href="manage_order.php">Manage Order</a></li>
      </ul>
    </li>
	
	<li class="submenu <?php if($page =='manage_payment.php' || $page =='add_payment.php' || $page=='edit_payment.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-credit-card"></i> <span>Payment </span></a>
      <ul>
        <li class="<?php if($page =='manage_payment.php' || $page=='edit_payment.php'){ echo "active";}?>"><a href="manage_payment.php">Manage Payment</a></li>
      </ul>
    </li>
	<!--
	<li class="submenu <?php if($page =='add_coupon.php' || $page=='manage_coupon.php' || $page=='edit_coupon.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-gift"></i> <span>Coupon</span></a>
      <ul>
        <li class="<?php if($page =='add_coupon.php'){ echo "active";}?>"><a href="add_coupon.php">Add Coupon</a></li>
        <li class="<?php if($page =='manage_coupon.php'){ echo "active";}?>"><a href="manage_coupon.php">Manage coupon</a></li>
      </ul>
    </li>
		
		
	<li class="submenu <?php if($page =='add_color.php' || $page=='manage_color.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-th-list"></i> <span>Color</span></a>
      <ul>
        <li class="<?php if($page =='add_color.php'){ echo "active";}?>"><a href="add_color.php">Add Color</a></li>
        <li class="<?php if($page =='manage_color.php'){ echo "active";}?>"><a href="manage_color.php">Manage Color</a></li>
      </ul>
    </li>	
    
    <li class="submenu <?php if($page =='add_size.php' || $page=='manage_size.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-th-list"></i> <span>Size</span></a>
      <ul>
        <li class="<?php if($page =='add_size.php'){ echo "active";}?>"><a href="add_size.php">Add Size</a></li>
        <li class="<?php if($page =='manage_size.php'){ echo "active";}?>"><a href="manage_size.php">Manage Size</a></li>
      </ul>
    </li>
    
    <li class="submenu <?php if($page=='manage_review.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-th-list"></i> <span>Review</span></a>
      <ul>
        <li class="<?php if($page =='manage_size.php'){ echo "active";}?>"><a href="manage_review.php">Manage Review</a></li>
      </ul>
    </li>
    
	<li class="submenu <?php if($page =='add_banner.php' || $page=='manage_banner.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-th-list"></i> <span>Banner</span></a>
      <ul>
        <li class="<?php if($page =='add_banner.php'){ echo "active";}?>"><a href="add_banner.php">Add Banner</a></li>
        <li class="<?php if($page =='manage_banner.php'){ echo "active";}?>"><a href="manage_banner.php">Manage Banner</a></li>
      </ul>
    </li>-->

	<li class="submenu <?php if($page=='change_password.php'){ echo "active open";}?>"> <a href="#"><i class="icon icon-wrench"></i> <span>Setting </span></a>
      <ul>
        <li class="<?php if($page=='change_password.php'){ echo "active";}?>"><a href="change_password.php">Change Password</a></li>
      </ul>
    </li>
  </ul>
</div>

<script>


</script>