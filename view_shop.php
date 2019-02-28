<?php
require_once("lib/database.php");
require_once("lib/function.php");

if($_GET['id']!=''){
	$id = base64_decode($_GET['id']);
}else{
	header("Location:logout.php");
}

$shopDetail = mysql_fetch_array(mysql_query("SELECT * FROM gosaloon_onwer WHERE id='".$id."'"));

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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_shop.php" class="tip-bottom">Manage Shop</a> <a href="#" class="current">View Shop</a> </div>
  <h1>View Shop Details</h1>
</div>



<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
	<div class="widget-box">
          <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i> </span>
         
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab1">Basic Details</a></li>
              <li><a data-toggle="tab" href="#tab2">Tab2</a></li>
              <li><a data-toggle="tab" href="#tab3">Tab3</a></li>
            </ul>
          </div>
          <div class="widget-content tab-content">
            <div id="tab1" class="tab-pane active">
              <div class="table-responsive">
				  <table border="1" class="Tabledata" cellpadding="5" cellspacing="5">
					<tr>
					  <td>User Name</td>
					  <td><?=$shopDetail['username'];?></td>
					</tr>
					<tr>
					  <td>Name</td>
					  <td><?=ucfirst($shopDetail['shop_name']);?></td>
					</tr>
					<tr>
					  <td>Email ID</td>
					  <td><?=$shopDetail['email'];?></td>
					</tr>
					<tr>
					  <td>Address</td>
					  <td><?=$shopDetail['adress'];?></td>
					</tr>
					
					<tr>
					  <td>Profile Pic</td>
					  <td><img src="img/gallery/imgbox2.jpg" width="50px;" height="50px;"></td>
					</tr>
					<tr>
					  <td>Mobile No</td>
					  <td><?=$shopDetail['mobile_no'];?></td>
					</tr>
					<tr>
					  <td>Status</td>
					  <td><?php if($shopDetail['status']=='1'){ echo "Active"; }else{ echo "Inactive";} ?></td>
					</tr>
				  </table>
                </div>
			</div>
			
            <div id="tab2" class="tab-pane"> <img src="img/demo/demo-image2.jpg" alt="demo-image"/>
              <p>And is full of waffle to It has multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment.</p>
            </div>
			
            <div id="tab3" class="tab-pane">
              <p>And is full of waffle to It has multiple paragraphs and is full of waffle to pad out the comment. Usually, you just wish these sorts of comments would come to an end.multiple paragraphs and is full of waffle to pad out the comment. </p>
              <img src="img/demo/demo-image3.jpg" alt="demo-image"/></div>
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
