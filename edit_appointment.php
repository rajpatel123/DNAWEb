<?php
require_once("lib/database.php");
require_once("lib/function.php");

if($_GET['id']!=''){
	$id = base64_decode($_GET['id']);
}else{
	header("Location:logout.php");
}

$appointment = mysql_fetch_array(mysql_query("SELECT * FROM gosaloon_appointment WHERE id='".$id."'"));

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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_appointment.php" class="tip-bottom">Manage Appointment</a> <a href="javascript:void(0);" class="current">Edit Appointment</a> </div>
  <h1>Edit Appointment</h1>
</div>
<div class="container-fluid">
  <hr>
  <div id="show"></div>
  
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Appointment</h5>
        </div>
        <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="" id="sub_cat_validation" enctype="multipart/form-data" autocomplete="off">
		  
		    <!--Message-Part-Start-->
		    <div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Appointment Update Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Warning ! </strong>Please Select One Status. 
			</div>
			
			<div class="alert alert-error1" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Warning ! </strong>Something went wrong.please try again. 
			</div>
			
		    
			<div class="control-group">
              <label class="control-label">Appointment Status :</label>
              <div class="controls">
                <select id="status" class="span6">
                  <option value="">Appointment Status</option>
				  <option value="0" <?php if($appointment['work_status']=='0'){echo "selected";}?> >Awaited</option>
				  <option value="1" <?php if($appointment['work_status']=='1'){echo "selected";}?> >Progress</option>
                  <option value="2" <?php if($appointment['work_status']=='2'){echo "selected";}?> >Completed</option>
				  <option value="3" <?php if($appointment['work_status']=='3'){echo "selected";}?> >Cancel</option>
                </select>
              </div>
            </div> 
			
       
            <div class="form-actions">
			  
			  <input type="hidden" id="aid" value="<?=$id?>"> 
              <input type="button" value="Submit" class="btn btn-success edit_appointment" >
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



			
			
