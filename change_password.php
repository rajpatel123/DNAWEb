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
<style> .error{ color:red; display:none; } </style>
		
			
			
		
		
		
<div id="content">
  <div id="content-header">
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a><a href="javascript:void(0);" class="current">Change Password</a> </div>
    <h1>Change Password</h1>
  </div>
  <div class="container-fluid"><hr>
    <div class="row-fluid">
      <div class="span12">
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"> <i class="icon-pencil"></i> </span>
            <h5>Change Password</h5>
          </div>
          <div class="widget-content nopadding">
		  
            <form class="form-horizontal" method="post" action="" id="changep_validation">
			
			    <!--Message-Part-Start-->
				<div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                    <strong>Success!</strong> password update Successfully. 
				</div>
				 <div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error!</strong> Something went wrong.please try again. 
				</div>
				<div class="alert alert-error1" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error!</strong> Old password does not match.please try again. 
				</div>
				<div class="alert alert-error2" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error!</strong> New password and confirm new password does not match.please try again. 
				</div>
				<!--Message-Part-End-->
			
			     <div class="control-group">
                  <label class="control-label">Old Password</label>
                  <div class="controls">
                    <input type="password" class="span6" id="oldp" />
					<p id="error_old_pass" class="error">Please Enter Current Password.</p>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">New Password</label>
                  <div class="controls">
                    <input type="password" class="span6" id="pwd" />
					<p id="error_new_pass" class="error">Please Enter New Password.</p>
                  </div>
                </div>
                <div class="control-group">
                  <label class="control-label">Confirm New password</label>
                  <div class="controls">
                    <input type="password" class="span6" id="pwd2" />
					<p id="error_cnew_pass" class="error">Please Enter Confirm New Password.</p>
                  </div>
                </div>
                <div class="form-actions">
                  <input type="button" value="Change Password" class="btn btn-success cpassword" >
                </div>
              </form>
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

<script src="js/matrix.js"></script> 
<script src="js/jquery.validate.js"></script>
<script src="js/developer.js"></script>
<script src="js/developer-validation.js"></script> 
</body>
</html>



