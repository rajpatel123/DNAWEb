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

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_shop" class="tip-bottom">Manage Shop</a> <a href="javascript:void(0);" class="current">Add Shop</a> </div>
  <h1>Add Shop Details</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span6">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Shop</h5>
        </div>
        <div class="widget-content nopadding">
          <form action="" method="post" class="form-horizontal">
		  
		    <div class="control-group">
              <label class="control-label">User Name :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="User name" id="user_name"/>
              </div>
            </div> 
            <div class="control-group">
              <label class="control-label">Shop Name :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Shop name" id="shop_name"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">mobile No :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="mobile No" id="mobile"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Password </label>
              <div class="controls">
                <input type="password"  class="span11" placeholder="Enter Password"  id="password"/>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Address :</label>
              <div class="controls">
                <input type="text" class="span11" placeholder="Shop Address"  id="address"/>
              </div>
            </div>
            
            
            <div class="form-actions">
              <input type="button" class="btn btn-success" id="save" name="submit" value="Submit">
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

</body>
</html>

<script>
	$(document).ready(function() {
		$(document).delegate(".btn-success", "click", function(e) {
			
			var user_name = $("#user_name").val();
			var shop_name = $("#shop_name").val();
			var mobile = $("#mobile").val();
			var password = $("#password").val();
			var address = $("#address").val();
			
			$.ajax({
				   url: "ajax/add_shop.php",
				   data: {user_name:user_name,shop_name:shop_name,mobile:mobile,password:password,address:address},
				   type: 'POST',
				   success: function (result) {
					  alert(result);return false;
					  if(result==1){
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); }, 3000);
					  }else if (result==2){
						  $('.alert-error1').show();
				          setTimeout(function() { $(".alert-error1").hide(); }, 3000);
					  }else{
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }
				}
				});
			
		});
	});
	
</script>
			
			
