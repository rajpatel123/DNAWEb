<?php
require_once("lib/database.php");
require_once("lib/function.php");
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_color.php" class="tip-bottom">Manage Color</a> <a href="javascript:void(0);" class="current">Add Color</a> </div>
  <h1>Add Color</h1>
</div>
<div class="container-fluid">
  <hr>
  <div id="show"></div>
  
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Color</h5>
        </div>
        <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="" id="cat_validation" enctype="multipart/form-data">
		  
		    <!--Message-Part-Start-->
		    <div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Color Added Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Something went wrong.please try again. 
			</div>
			
			<div class="alert alert-error1" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Warning ! </strong>Color Name already exit. Please try to new. 
			</div>
			<!--Message-Part-End-->
		  
		    <div class="control-group">
              <label class="control-label">Color Name :</label>
              <div class="controls">
                <input type="text" placeholder="Category name" class="span6" id="color_name"/>
				<p id="error_color_name" class="error">Please Enter Color Name.</p>
              </div>
            </div>
			
            <div class="form-actions">
              <input type="button" value="Submit" class="btn btn-success add_color" >
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

			
			
