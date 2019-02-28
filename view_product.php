<?php
require_once("lib/database.php");
require_once("lib/function.php");

if($_GET['id']!=''){
	$id = base64_decode($_GET['id']);
}else{
	header("Location:logout.php");
}

$productDetail = mysql_fetch_array(mysql_query("SELECT * FROM product WHERE id='".$id."'"));

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
<!--Close-sidebar-menu-->

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_product.php" class="tip-bottom">Manage Product</a> <a href="#" class="current">View Product</a> </div>
  <h1>View Product</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Product-info</h5>
        </div>
        <div class="widget-content nopadding">
          
		 <div class="table-responsive">
		  <table border="1" class="Tabledata" cellpadding="5" cellspacing="5">
    
		    <tr>
			  <td>Sku Id</td>
			  <td><?=$productDetail['sku_id'];?></td>
			</tr>
			
			<tr>
			  <td>Product Name</td>
			  <td><?=$productDetail['product_name'];?></td>
			</tr>
			<tr>
			  <td>category_name</td>
			  <td><?php $cat_name = mysql_fetch_array(mysql_query("SELECT * FROM category WHERE id='".$productDetail['cat_id']."'")); echo ucfirst($cat_name['category_name']);?></td>
			</tr>
			<?php if($productDetail['sub_cat_id']!=''){?>
			<tr>
			  <td>Sub Category Name</td>
			  <td><?php $sub_cat_name = mysql_fetch_array(mysql_query("SELECT * FROM sub_category WHERE id='".$productDetail['sub_cat_id']."'")); echo ucfirst($sub_cat_name['sub_cat_name']);?></td>
			</tr>
			<?php } ?>
			<?php if($productDetail['sub_cat_id']!=''){?>
			<tr>
			  <td>Sub Child  Name</td>
			  <td><?php $sub_child_cat_name = mysql_fetch_array(mysql_query("SELECT * FROM sub_child_category WHERE id='".$productDetail['sub_child_cat_id']."'")); echo ucfirst($sub_child_cat_name['sub_child_name']);?></td>
			</tr>
			<?php } ?>
			<tr>
			  <td>Product Price</td>
			  <td><?=$productDetail['product_sprice'];?></td>
			</tr>
			<tr>
			  <td>Product Type</td>
			  <td><?=$productDetail['product_price'];?></td>
			</tr>
			<tr>
			  <td>Product Quantity</td>
			  <td><?=$productDetail['product_quantity'];?></td>
			</tr>
			<tr>
			  <td>Product Color</td>
			  <td><?=$productDetail['color'];?></td>
			</tr>
			<tr>
			  <td>Product Size</td>
			  <td><?=$productDetail['size'];?></td>
			</tr>
			<tr>
			  <td>Product Image</td>
			  <td><?php if($productDetail['product_image']!='' && file_exists('img/product/'.$productDetail['product_image'])){?> 
			      <img src="img/product/<?=$productDetail['product_image']?>" height="35" width="35" ><?php } ?></td>
			</tr>
			<tr>
			  <td>Product Sub Image</td>
			  <td><?php $image = mysql_query("select * from product_image where product_id='".$productDetail['id']."'");
			    $num = mysql_num_rows($image);
                if($num > 0){
                   while($details = mysql_fetch_array($image)){
				        //if($details['product_sub_image']!='' && file_exists('img/product/'.$details['product_sub_image'])){?>
					   <img src="img/product/<?=$details['product_sub_image']?>" height="50" width="50" >
				   <?php }//} 
				}?></td>
			</tr>
			<tr>
			  <td>Product Specification</td>
			  <td><?=$productDetail['specification'];?></td>
			</tr>
			<tr>
			  <td>Product Shipping</td>
			  <td><?=$productDetail['shipping'];?></td>
			</tr>
			<tr>
			  <td>Product Exchange</td>
			  <td><?=$productDetail['returns'];?></td>
			</tr>
			<tr>
			  <td>Status</td>
			  <td><?php if($productDetail['status']=='1'){ echo '<button class="btn btn-success btn-mini">Active</button>'; }else{ echo '<button class="btn btn-danger btn-mini">Inactive</button>';} ?></td>
			</tr>
		  </table>
        </div>
      </div>
      
    </div>
    
  </div>
  
</div></div>
<!--Footer-part-->
    <?php include("include/footer.php");?>
<!--end-Footer-part--> 
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/bootstrap-colorpicker.js"></script> 
<script src="js/bootstrap-datepicker.js"></script> 
<script src="js/jquery.toggle.buttons.js"></script> 
<script src="js/masked.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.form_common.js"></script> 
<script src="js/wysihtml5-0.3.0.js"></script> 
<script src="js/jquery.peity.min.js"></script> 
<script src="js/bootstrap-wysihtml5.js"></script> 
<script>
	$('.textarea_editor').wysihtml5();
</script>
</body>
</html>
