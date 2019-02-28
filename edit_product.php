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
<!--close-sidebar-menu--> 
<style> .error{ color:red;display:none; }</style>


<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_product.php" class="tip-bottom">Manage Prodcut</a> <a href="javascript:void(0);" class="current">Edit Product</a> </div>
  <h1>Edit Product</h1>
</div>
<div class="container-fluid">
  <hr>
  <div id="show"></div>
  
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Product</h5>
        </div>
        <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="" id="sub_cat_validation" enctype="multipart/form-data">
		    <!--Message-Part-Start-->
			<div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Product Update Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Something went wrong.please try again. 
			</div>
			
			<div class="test"></div>
		  
		    <div class="control-group">
              <label class="control-label">Category :</label>
              <div class="controls">
                 <select id="cat_id" disabled="true" class="span6">
				 <option value="">Select Category</value>
				  <?php $cat_detail = mysql_query("SELECT * FROM category WHERE id='".$productDetail['cat_id']."'");
				  
				     while($Catdetail = mysql_fetch_array($cat_detail)){?>
				     <option value="<?=$Catdetail['id']?>" <?php if($productDetail['cat_id']==$Catdetail['id']){echo "selected";}?> ><?=$Catdetail['category_name']?></option>
                     <?php }?>
					 

                </select>
				<label id="error_cat_id" class="error">Please Select Category Name.</label>
              </div>
            </div> 
			
			<div class="control-group">
              <label class="control-label">Sub Category :</label>
              <div class="controls">
                 <select id="sub_cat_id" disabled="true" class="span6">
				 <option value="">Select Sub Category</value>
				  <?php $cat_detail = mysql_query("SELECT * FROM sub_category WHERE id='".$productDetail['sub_cat_id']."'");
				  
				     while($Catdetail = mysql_fetch_array($cat_detail)){?>
				     <option value="<?=$Catdetail['id']?>" <?php if($productDetail['sub_cat_id']==$Catdetail['id']){echo "selected";}?> ><?=$Catdetail['sub_cat_name']?></option>
                     <?php }?>
					 

                </select>
				<label id="error_cat_id" class="error">Please Select Sub Category Name.</label>
              </div>
            </div> 
			
			<div class="control-group">
              <label class="control-label">Sub Child Category :</label>
              <div class="controls">
                 <select id="sub_child_cat_id" disabled="true" class="span6">
				 <option value="">Select Sub Child Category</value>
				  <?php $child_cat_detail = mysql_query("SELECT * FROM sub_child_category WHERE id='".$productDetail['sub_child_cat_id']."'");
				  
				     while($ChildCatdetail = mysql_fetch_array($child_cat_detail)){?>
				     <option value="<?=$ChildCatdetail['id']?>" <?php if($productDetail['sub_child_cat_id']==$ChildCatdetail['id']){echo "selected";}?> ><?=$ChildCatdetail['sub_child_name']?></option>
                     <?php }?>
					 

                </select>
				<label id="error_cat_id" class="error">Please Select Sub Category Name.</label>
              </div>
            </div> 
			
			<div class="control-group">
              <label class="control-label">Product Name :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Product Name" value="<?=$productDetail['product_name']?>" id="product_name"/>
				<label id="error_product_name" class="error">Please Enter Product Name.</label>
              </div>
            </div> 
			<!--
			<div class="control-group">
              <label class="control-label">Product Price :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Product Price" value="<?=$productDetail['product_price']?>" id="product_price"/>
				<label id="error_product_price" class="error">Please Enter Product Price.</label>
              </div>
            </div> 
			
			<div class="control-group">
              <label class="control-label">Product Sale Price :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Product Sale Price" value="<?=$productDetail['product_sprice']?>" id="product_sprice"/>
				<label id="error_product_sprice" class="error">Please Enter Product Sale Price.</label>
              </div>
            </div>
			-->
			
			<div class="control-group">
              <label class="control-label">Product Price <span style="color:red;">*</span> :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Product Price" id="product_sprice" value="<?=$productDetail['product_sprice']?>" />
				<label id="error_product_sprice" class="error">Enter Product  Price.</label>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Product Type <span style="color:red;">*</span> :</label>
              <div class="controls">
                <select id="product_price" class="span6">
				  <option value="Pair" <?php if($productDetail['product_price']=='Pair'){echo "selected";}?>>Pair</value>
				  <option value="Piece" <?php if($productDetail['product_price']=='Piece'){echo "selected";}?>>Piece</value>
			    </select>
				<label id="error_product_price" class="error">Select Product Type.</label>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Product Quantity :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Product Quantity" value="<?=$productDetail['product_quantity']?>" id="product_quantity"/>
				<label id="error_product_quantity" class="error">Please Enter Product Quantity.</label>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Color <input type="checkbox" id="checkAll" title="All color select."> : </label>
              <div class="controls">
				    <?php 
					$color=array();
				    if($productDetail['color']!=''){$color=explode(',',$productDetail['color']);}
					$colors = mysql_query("SELECT * FROM color");
				    while($color_detail = mysql_fetch_array($colors)){?>
                    <input type="checkbox" value="<?=$color_detail['name']?>" class="color checkBoxClass" name="color" <?php if(in_array($color_detail['name'],$color)){?> checked="checked" <?php } ?>/>&nbsp;<?=ucfirst($color_detail['name'])?> 
					&nbsp;&nbsp;<?php } ?>				
					
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Size : </label>
              <div class="controls">
				    <?php 
					$size = array();
					if($productDetail['size']!=''){$size=explode(',',$productDetail['size']);}
					$sizes = mysql_query("SELECT * FROM size");
				    while($sizes_detail = mysql_fetch_array($sizes)){?>
                    <input type="checkbox" value="<?=$sizes_detail['size']?>" class="size" name="size" <?php if(in_array($sizes_detail['size'],$size)){?> checked="checked" <?php } ?>/>&nbsp;<?=ucfirst($sizes_detail['size'])?> 
					&nbsp;&nbsp;<?php } ?>				
					
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Product Image : </label>
              <div class="controls">
                <input type="file" id="file" />
				 <?php if($productDetail['product_image']!='' && file_exists('img/product/'.$productDetail['product_image'])){?> 
			      <img src="img/product/<?=$productDetail['product_image']?>" height="25" width="25" ><?php } ?>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Product Specification :</label>
              <div class="controls">
                <textarea id="specification" class="span6" ><?=$productDetail['specification'];?></textarea>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Product Shipping :</label>
              <div class="controls">
                <textarea id="shipping" class="span6" ><?=$productDetail['shipping'];?></textarea>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Product Exchange :</label>
              <div class="controls">
                <textarea id="returns" class="span6" ><?=$productDetail['returns'];?></textarea>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Product Status :</label>
              <div class="controls">
                <select id="status" class="span6">
                  <option value="">Select Status</option>
				  <option value="1" <?php if($productDetail['status']=='1'){echo "selected";}?> >Active</option>
                  <option value="2" <?php if($productDetail['status']=='2'){echo "selected";}?> >Inactive</option>
                </select>
				<label id="error_status" class="error">Please Select Status.</label>
              </div>
            </div> 
			
			<input type="hidden" id="product_id" value="<?=$id?>">
            <input type="hidden" id="file1" value="<?=$productDetail['product_image']?>">
			
            <div class="form-actions">
              <input type="button" value="Update" class="btn btn-success edit_product" >
            </div>
          </form>
        </div>
      </div>
      
      
    </div>
    
  </div>
 
</div></div>
<!--Footer-part-->
 <?php include("segment/footer.php");?>
<!--end-Footer-part-->

<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script>  
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/developer.js"></script> 
<script src="js/developer-validation.js"></script> 


</body>
</html>

<script type="text/javascript">
$(document).ready(function () {
    $("#checkAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });
});

</script>

			
			
