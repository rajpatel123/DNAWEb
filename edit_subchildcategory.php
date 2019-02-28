<?php
require_once("lib/database.php");
require_once("lib/function.php");

if($_GET['id']!=''){
	$id = base64_decode($_GET['id']);
}else{
	header("Location:logout.php");
}

$SubChildCatDetail = mysql_fetch_array(mysql_query("SELECT * FROM sub_child_category WHERE id='".$id."'"));

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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_subchildcategory.php" class="tip-bottom">Manage Sub Child Category</a> <a href="javascript:void(0);" class="current">Edit Sub Child Category</a> </div>
  <h1>Edit Sub Child Category</h1>
</div>
<div class="container-fluid">
  <hr>
  <div id="show"></div>
  
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Sub Child Category</h5>
        </div>
        <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="" id="sub_cat_validation" enctype="multipart/form-data">
		    <!--Message-Part-Start-->
			<div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Sub Child Category Update Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Something went wrong.please try again. 
			</div>
			
			<div class="alert alert-error1" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Warning ! </strong>Sub Category Name already exit. Please try to new. 
			</div>
			
		  
		    <div class="control-group">
              <label class="control-label">Category :</label>
              <div class="controls">
                 <select id="cat_id" disabled="true">
				 <option value="">Select Category</value>
				  <?php $cat_detail = mysql_query("SELECT * FROM category WHERE id='".$SubChildCatDetail['cat_id']."'");
				  
				     while($Catdetail = mysql_fetch_array($cat_detail)){?>
				     <option value="<?=$Catdetail['id']?>" <?php if($SubChildCatDetail['cat_id']==$Catdetail['id']){echo "selected";}?> ><?=$Catdetail['category_name']?></option>
                     <?php }?>
					 

                </select>
				<label id="error_cat_id" class="error">Please Select Category Name.</label>
              </div>
            </div> 
			
			<div class="control-group">
              <label class="control-label">Sub Category :</label>
              <div class="controls">
                 <select id="cat_id" disabled="true">
				 <option value="">Select Sub Category</value>
				  <?php $cat_detail = mysql_query("SELECT * FROM sub_category WHERE id='".$SubChildCatDetail['sub_cat_id']."'");
				  
				     while($Catdetail = mysql_fetch_array($cat_detail)){?>
				     <option value="<?=$Catdetail['id']?>" <?php if($SubChildCatDetail['sub_cat_id']==$Catdetail['id']){echo "selected";}?> ><?=$Catdetail['sub_cat_name']?></option>
                     <?php }?>
					 

                </select>
				<label id="error_cat_id" class="error">Please Select Sub Category Name.</label>
              </div>
            </div> 
			
			<div class="control-group">
              <label class="control-label">Sub Child Category Name :</label>
              <div class="controls">
                <input type="text" placeholder="Sub Child Category name" value="<?=$SubChildCatDetail['sub_child_name']?>" id="sub_child_cat_name"/>
				<label id="error_sub_child_cat_name" class="error">Please Enter Sub Child Category Name.</label>
              </div>
            </div> 
			
			<div class="control-group">
              <label class="control-label">Sub Category Status :</label>
              <div class="controls">
                <select id="status">
                  <option value="">Select Status</option>
				  <option value="1" <?php if($SubChildCatDetail['status']=='1'){echo "selected";}?> >Active</option>
                  <option value="2" <?php if($SubChildCatDetail['status']=='2'){echo "selected";}?> >Inactive</option>
                </select>
				<label id="error_status" class="error">Please Select Status.</label>
              </div>
            </div> 
			
			<input type="hidden" id="sub_child_id" value="<?=$id?>">
       
            <div class="form-actions">
              <input type="button" value="Update" class="btn btn-success edit_subchildcategory" >
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

<script>
$(document).ready(function(){
    $('#price').keypress(validateNumber);
});

function validateNumber(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if ( key < 48 || key > 57 ) {
        return false;
    } else {
    	return true;
    }
};
</script>
			
			
