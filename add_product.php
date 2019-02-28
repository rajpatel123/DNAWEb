<?php
require_once("lib/database.php");
require_once("lib/function.php");

if($_SESSION['id']!=''){
	$id = $_SESSION['id'];
}else{
	header("Location:logout.php");
}
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
<style> .error{ color:red;display:none; } .span{color:red;}</style>


<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_product.php" class="tip-bottom">Manage Product</a> <a href="javascript:void(0);" class="current">Add Product</a> </div>
  <h1>Add Product</h1>
</div>
<div class="container-fluid">
  <hr>
  <div id="show"></div>
  
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Product</h5>
        </div>
        <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="" id="sub_cat_validation" enctype="multipart/form-data" autocomplete="off">
		  
		    <!--Message-Part-Start-->
		    <div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Product Added Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Category  & Sub Category  & Sub Child Category Name already exit. Please try to new. 
			</div>
			
			<div class="alert alert-error1" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Warning ! </strong>Something went wrong.please try again. 
			</div>
			
			<div class="test"></div>
			<div class="control-group">
              <label class="control-label">Category <span style="color:red;">*</span> :</label>
              <div class="controls">
                <select id="cat_id" class="span6">
				<option value="">Select Category</value>
				  <?php
				  $cat=mysql_query("SELECT * FROM category WHERE status='1' ORDER BY category_name ASC");
					 while($cat_detals = mysql_fetch_array($cat)){?>     
							   <option value="<?php echo $cat_detals['id'];?>"><?php echo ucfirst($cat_detals['category_name']);?></value>
					 <?php } ?>	 
                </select>
				<label id="error_cat_id" class="error">Please Select Category Name.</label>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Sub Category :</label>
              <div class="controls">
                <select id="sub_cat_id" class="span6">
				<option value="">Select Sub Category</value>
				
			    </select>
				<label id="error_sub_cat_id" class="error">Please Select Sub Category .</label>
              </div>
            </div>	
		  
		    <div class="control-group">
              <label class="control-label">Sub Child Category :</label>
              <div class="controls">
                <select id="sub_child_cat_id" class="span6">
				  <option value="">Select Sub Child Category</value>
			    </select>
              </div>
            </div> 
			
			<div class="control-group">
              <label class="control-label">Product Name <span style="color:red;">*</span> :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Product Name" id="product_name"/>
				<label id="error_product_name" class="error">Enter Product Name.</label>
              </div>
            </div>
			<!--
			<div class="control-group">
              <label class="control-label">Product Price <span style="color:red;">*</span> :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Product Price" id="product_price"/>
				<label id="error_product_price" class="error">Enter Product Price.</label>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Product Sale Price <span style="color:red;">*</span> :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Product Sale Price" id="product_sprice"/>
				<label id="error_product_sprice" class="error">Enter Product Sale Price.</label>
              </div>
            </div>-->
            
            <div class="control-group">
              <label class="control-label">Product Price <span style="color:red;">*</span> :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Product Price" id="product_sprice"/>
				<label id="error_product_sprice" class="error">Enter Product  Price.</label>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Product Type <span style="color:red;">*</span> :</label>
              <div class="controls">
                <select id="product_price" class="span6">
				  <option value="Pair">Pair</value>
				  <option value="Piece">Piece</value>
			    </select>
				<label id="error_product_price" class="error">Select Product Type.</label>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Product Quantity <span style="color:red;">*</span> :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Product Quantity" id="product_quantity"/>
				<label id="error_product_quantity" class="error">Enter Product Quantity.</label>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Color <input type="checkbox" id="checkAll" title="All color select."> : </label>
              <div class="controls">
				    <?php $color = mysql_query("SELECT * FROM color");
				    while($color_detail = mysql_fetch_array($color)){?>
                    <input type="checkbox" value="<?=$color_detail['name']?>" class="color checkBoxClass" name="color" />&nbsp;<?=ucfirst($color_detail['name'])?> 
					&nbsp;&nbsp;<?php } ?>				
					
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Size : </label>
              <div class="controls">
				    <?php $color = mysql_query("SELECT * FROM size");
				    while($color_detail = mysql_fetch_array($color)){?>
                    <input type="checkbox" value="<?=$color_detail['size']?>" class="size" name="size" />&nbsp;<?=ucfirst($color_detail['size'])?> 
					&nbsp;&nbsp;<?php } ?>				
					
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Product Image <span style="color:red;">*</span> : </label>
              <div class="controls">
                <input type="file" id="file" />
				<label id="error_file" class="error">Please Select Product Image.</label>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Product Sub Image <a href="javascript:void(0);" data-toggle="tooltip" title="Select Multiple Image"><i class="icon-question-sign"></i> </a> : </label>
			  <div id="show_more">
              <div class="controls">
                <input type="file" id="multiFiles" name="multiFiles[]" multiple="multiple"/>
				<!--
				<label id="error_file" class="error">Please Select Sub Product Image.</label>
				<a href="javascript:void(0)" id="add_more" class="btn btn-success btn-mini anil" style=" margin-right:14px;">
			  <strong><i class="icon icon-plus"></i> Add More</strong></a>-->
              </div>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Product Specification :</label>
              <div class="controls">
                <textarea id="specification" class="span6" ></textarea>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Product Shipping :</label>
              <div class="controls">
                <textarea id="shipping" class="span6" ></textarea>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Product Exchange :</label>
              <div class="controls">
                <textarea id="returns" class="span6" ></textarea>
              </div>
            </div>
			
            <div class="form-actions">

              <input type="button" value="Submit" class="btn btn-success add_product" >
			  
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
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});


$(document).ready(function(){
    $('#cat_id').on("change",function () {
            //var cat_Id = $(this).find('option:selected').val();
            var cat_Id = $("#cat_id").val();
		
                $.ajax({
				  url: "ajax/getSubCat.php",
				  data: {cat_Id:cat_Id},
				  type: 'POST',
				  success: function (result) {
                    $("#sub_cat_id").html(result);
            },
        });
		
    }); 
	
});


$(document).ready(function () {
    $("#checkAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
	
	$('#sub_cat_id').on("change",function () {
		    var cat_id = $("#cat_id").val();
            var sub_cat_Id = $(this).find('option:selected').val();
		    
                $.ajax({
				  url: "ajax/getSubchildCat.php",
				  data: {cat_id:cat_id,sub_cat_Id:sub_cat_Id},
				  type: 'POST',
				  success: function (result) {
					  //alert(result);
                    $("#sub_child_cat_id").html(result);
                  },
        });
		
    });
	
});
</script>
<script>
$(document).ready(function(){
$("#add_more").click(function(){
	var rowNum = 0;
	rowNum ++;
	//alert('hiiii');return false;
	/*
var res='<div id="rowNum'+rowNum+'"><div class="control-group" style="margin-top:20px;"><label class="control-label">Add-ons<span class="required">*</span></label><div class="controls"><input id="" class="m-wrap span4" value="" type="text" name="exta_items[]" /></div></div><input type="hidden" value="" name="edit_id[]"><div class="control-group"><label class="control-label">Price<span class="required">*</span></label><div class="controls"><input id="pricee" class="m-wrap span2" value="" type="text" name="pricee[]" style="width:220px;"/>&nbsp;&nbsp;<a href="javascript:void(0);" onClick="removeRow('+rowNum+');" style="margin-top:20px; margin-left:10px;"><strong>Remove</strong></a></div></div></div>';*/


var res='<div id="rowNum'+rowNum+'"><div class="control-group"><label class="control-label">Product Sub Image : </label><div id="show_more"><div class="controls"><input type="file" id="files" name="sub_file[]"/><label id="error_file" class="error">Please Select Sub Product Image.</label>&nbsp;&nbsp;<a href="javascript:void(0);" onClick="removeRow('+rowNum+');" style="margin-top:0px; margin-left:10px;" class="btn btn-danger btn-mini"><strong><i class="icon icon-minus"></i> Remove</strong></a></div></div></div></div>';

$("#show_more").append(res);
});
});

function removeRow(rnum) {
$('#rowNum'+rnum).remove();
}
</script>



			
			
