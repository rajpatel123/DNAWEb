<?php
require_once("lib/database.php");
require_once("lib/function.php");

if($_GET['id']!=''){
	$id = base64_decode($_GET['id']);
}else{
	header("Location:logout.php");
}

$adminDetail = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='".$id."'"));

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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_admin.php" class="tip-bottom">Manage Admin</a> <a href="#" class="current">View Admin</a> </div>
  <h1>View Admin Details</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Personal-info</h5>
        </div>
        <div class="widget-content nopadding">
          
		 <div class="table-responsive">
		  <table border="1" class="Tabledata" cellpadding="5" cellspacing="5">
    
		    <tr>
			  <td>Name</td>
			  <td><?=ucfirst($adminDetail['name']);?></td>
			</tr>
			
			<tr>
			  <td>User Name</td>
			  <td><?=$adminDetail['username'];?></td>
			</tr>
			<tr>
			  <td>Email ID</td>
			  <td><?=$adminDetail['email'];?></td>
			</tr>
			<tr>
			  <td>Profile Pic</td>
			  <td><img src="img/gallery/imgbox2.jpg" width="50px;" height="50px;"></td>
			</tr>
			<tr>
			  <td>Mobile No</td>
			  <td><?=$adminDetail['mobile_no'];?></td>
			</tr>
			<tr>
			  <td>Status</td>
			  <td><?php if($adminDetail['status']=='1'){ echo "Active"; }else{ echo "Inactive";} ?></td>
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
