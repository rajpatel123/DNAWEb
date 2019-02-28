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
<style> .error{ color:red;display:none; }</style>


<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_childcategory.php" class="tip-bottom">Manage Sub Child Category</a> <a href="javascript:void(0);" class="current">Add Sub Child Category</a> </div>
  <h1>Add Sub Child Category</h1>
</div>
<div class="container-fluid">
  <hr>
  <div id="show"></div>
  
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Sub Child Category</h5>
        </div>
        <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="" id="sub_cat_validation" enctype="multipart/form-data" autocomplete="off">
		  
		    <!--Message-Part-Start-->
		    <div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Sub Child Category Added Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Category  & Sub Category  & Sub Child Category Name already exit. Please try to new. 
			</div>
			
			<div class="alert alert-error1" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Warning ! </strong>Something went wrong.please try again. 
			</div>
			
			
			<div class="control-group">
              <label class="control-label">Category :</label>
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
              <label class="control-label">Sub Child Category Name :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Sub Child Category Name" id="sub_childcat_name"/>
				<label id="error_sub_childcat_name" class="error">Please Enter Sub Child Category Name.</label>
              </div>
            </div> 
			
            <div class="form-actions">

              <input type="button" value="Submit" class="btn btn-success add_subchildcat" >
			  
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
    $('#cat_id').on("change",function () {
            var cat_Id = $(this).find('option:selected').val();
		
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

</script>


			
			
