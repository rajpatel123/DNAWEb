<?php
require_once("lib/database.php");
require_once("lib/function.php");

if($_GET['id']!=''){
	$id = base64_decode($_GET['id']);
}else{
	header("Location:logout.php");
}

$categoryDetail = mysql_fetch_array(mysql_query("SELECT * FROM category WHERE id='".$id."'"));

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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_shop" class="tip-bottom">Manage Category</a> <a href="javascript:void(0);" class="current">Edit Category</a> </div>
  <h1>Edit Shop Category</h1>
</div>
<div class="container-fluid">
  <hr>
  <div id="show"></div>
  
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Category</h5>
        </div>
        <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="" id="cat_validation" enctype="multipart/form-data">
		  
		    <!--Message-Part-Start-->
			<div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Category Update Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Something went wrong.please try again. 
			</div>
			
			<div class="alert alert-error1" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Warning ! </strong>Category Type & Name already exit. Please try to new. 
			</div>
			<!--Message-Part-End-->
			
		   
		    <div class="control-group">
              <label class="control-label">Category Name :</label>
              <div class="controls">
                <input type="text" placeholder="Category name" class="span6" value="<?=$categoryDetail['category_name']?>" id="cat_name"/>
                <p id="error_cat_name" class="error">Please Enter Category Name.</p>
			  </div>
            </div> 
           <!--
            <div class="control-group">
              <label class="control-label">Category Image : </label>
              <div class="controls">
                <input type="file" id="file" />
				 <?php if($categoryDetail['category_image']!='' && file_exists('img/category/'.$categoryDetail['category_image'     ])){?> 
			      <img src="img/category/<?=$categoryDetail['category_image']?>" height="25" width="25" ><?php } ?>
              </div>
            </div>-->
			
			<div class="control-group">
              <label class="control-label">Category Status :</label>
              <div class="controls">
                <select id="cat_status" class="span6">
                  <option value="">Select Status</option>
				  <option value="1" <?php if($categoryDetail['status']=='1'){echo "selected";}?> >Active</option>
                  <option value="2" <?php if($categoryDetail['status']=='2'){echo "selected";}?> >Inactive</option>
                </select>
				<p id="error_status" class="error">Please Select Category Status.</p>
              </div>
            </div> 
			
			
			
			<input type="hidden" id="file1" value="<?=$categoryDetail['category_image']?>">
			<input type="hidden" id="cat_id" value="<?=$id?>">
       
            <div class="form-actions">
              <input type="button" value="Update" class="btn btn-success edit_category" >
            </div>
          </form>
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
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/developer.js"></script> 
<script src="js/developer-validation.js"></script> 


</body>
</html>

			
			
