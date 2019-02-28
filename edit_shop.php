<?php
require_once("lib/database.php");
require_once("lib/function.php");

if($_GET['id']!=''){
	$id = base64_decode($_GET['id']);
}else{
	header("Location:logout.php");
}

$shopDetail = mysql_fetch_array(mysql_query("SELECT * FROM gosaloon_onwer WHERE id='".$id."'")); // Shop Details
$detail=mysql_fetch_array(mysql_query("SELECT * FROM gosaloon_daytime WHERE shop_id='".$id."'"));// DayTime Details

?>


<!DOCTYPE html>
<html lang="en">
<!--Head-part-->
   <?php include("segment/head.php");?>
   <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXlLYYvMfEQbbFyHn0TJuJyCTTihFsGyM&libraries=places"></script>
  
    
   <link rel="stylesheet" href="css/star-rating.css" />
   

   <style>.error{color:red;display:none;}</style>
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_shop.php" class="tip-bottom">Manage Shop</a> <a href="#" class="current">Edit Shop</a> </div>
  <h1>Shop Details</h1>
</div>



<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
	
	        <!--Message-Part-Start-->
		    <div class="alert alert-success1" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong>  Added Successfully. 
			</div>
			<div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Update Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Something went wrong.please try again. . 
			</div>
			<!--Message-Part-End-->
	<div class='test'></div>

	<div class="widget-box">
          <div class="widget-title"><span class="icon"> <i class="icon-align-justify"></i> </span>
         
            <ul class="nav nav-tabs">
              <li class="active"><a data-toggle="tab" href="#tab1"> Shop Details</a></li>
              <li><a data-toggle="tab" href="#tab2">Open / Closed Detail</a></li>
              <li><a data-toggle="tab" href="#tab3"> Basic Details</a></li>
            </ul>
          </div>
          <div class="widget-content tab-content">
		  <!--tab1-->
            <div id="tab1" class="tab-pane active">
              <form action="" method="post" class="form-horizontal" id="details">
		  
		    <div class="control-group">
              <label class="control-label">Name :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="User name" value="<?=$shopDetail['username'];?>" id="username"/>
				<p id="error_username" class="error">Please Enter Username.</p>
              </div>
            </div> 
            <div class="control-group">
              <label class="control-label">Shop Name :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Shop name" value="<?=ucfirst($shopDetail['shop_name']);?>" id="shopname"/>
				<p id="error_shopname" class="error">Please Enter Username.</p>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Email :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="mobile No" value="<?=ucfirst($shopDetail['email']);?>" id="email"/>
				<p id="error_email" class="error">Please Enter Email Id.</p>
				<p id="error_validemail" class="error">Please Enter Valid Email Id.</p>
              </div>
            </div>
			<div class="control-group">
              <label class="control-label">Address :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Shop Address" value="<?=$shopDetail['address'];?>" onFocus="initializeAutocomplete()" id="locality"/>
				<p id="error_address" class="error">Please Enter Shop Address.</p>
              </div>
            </div>
            <div class="control-group">
              <label class="control-label">Profile Pic :</label>
              <div class="controls">
                <input type="file"  class="span6" id="file"/>
				<?php if($shopDetail['profile_pic']!='' && file_exists('img/shop/'.$shopDetail['profile_pic'])){?><img src="img/shop/<?=$shopDetail['profile_pic']?>" height="50" width="50" ><?php } ?>
              </div>
            </div>
			<div class="control-group">
              <label class="control-label">Mobile No :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Shop Mobile No" value="<?=$shopDetail['mobile_no'];?>" id="mobile"/>
				<p id="error_mobile" class="error">Please Enter Shop mobile No.</p>
				<p id="error_numeric" class="error">Please Enter Numeric Value.</p>
				<p id="error_maxlenth" class="error">Please Enter Maximum 12 Number.</p>
				<p id="error_minlenth" class="error">Please Enter Minimum 10 Number.</p>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Shop Price Rating :</label>
              <div class="controls">
                <input type="text" id="price_rating" class="rating rating-loading" value="<?=$shopDetail['price_rating']?>" data-size="xs" title="">
				<p id="error_price_rating" class="error">Please Select Shop Price Rating.</p>
              </div>
            </div>
			
				
			<div class="control-group">
              <label class="control-label"> Shop Type :</label>
              <div class="controls">
                 <select id="type" class="span6">
                  <option value="">Select Shop Type</option>
				  <option value="Male" <?php if($shopDetail['shop_type']=='Male'){echo "selected";}?> >Male</option>
                  <option value="Female" <?php if($shopDetail['shop_type']=='Female'){echo "selected";}?> >Female</option>
                  <option value="Unisex" <?php if($shopDetail['shop_type']=='Unisex'){echo "selected";}?> >Unisex</option>
                </select>
				<p id="error_type" class="error">Please Select Shop Type.</p>
              </div>
            </div>	
			<div class="control-group">
              <label class="control-label"> Status :</label>
              <div class="controls">
                 <select id="status" class="span6">
                  <option value="">Select Status</option>
				  <option value="1" <?php if($shopDetail['status']=='1'){echo "selected";}?> >Active</option>
                  <option value="2" <?php if($shopDetail['status']=='2'){echo "selected";}?> >Inactive</option>
                </select>
				<p id="error_status" class="error">Please Select Shop status.</p>
              </div>
            </div>
            
            <div class="form-actions">
			  <input type="hidden" id="file1" value="<?=$shopDetail['profile_pic']?>"> 
			  <input type="hidden" id="shop_id" value="<?=$id?>"> 
              <input type="button" class="btn btn-success edit_shop_detail" value="Update">
            </div>
          </form>
			</div>
			
			<!--tab2-->
            <div id="tab2" class="tab-pane">
			
			<input type="hidden" value="<?=$id?>" id="shop_id">
			
			 <div class="control-group">
              <label class="control-label">Open Days : </label>
              <div class="controls" style="padding-left:85px;">
                <?php
				 $open_days=array();
				 if($detail['open_day']!=''){$open_days=explode(',',$detail['open_day']);}
				 ?>
				<?php
				$day = array ('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
				foreach ($day as $value) {?>
				<input type="checkbox" value="<?=$value?>" class="day" name="day" <?php if(in_array($value,$open_days)){?> checked="checked" <?php } ?> /> &nbsp;<?=$value?>&nbsp;&nbsp;
				<?php } ?>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Morning Time Slots : </label>
              <div class="controls" style="padding-left:85px;">
                <?php
				 $mornning_time=array();
				 if($detail['morning_time']!=''){$mornning_time=explode(',',$detail['morning_time']);}
				 ?>
				<?php
				    $minutes = get_minutes('08:00', '12:00');
					
					function get_minutes ( $start, $end ) {
					while ( strtotime($start) <= strtotime($end) ) {  
					$minutes[] = date("H:i", strtotime( "$start" ) );  
					$start = date("H:i", strtotime( "$start + 45 mins")) ;      
					}  
					return $minutes;  
					}  

					foreach($minutes as $minute) {?> 
                    <input type="checkbox" value="<?=$minute?>" class="morning_time" name="morning" <?php if(in_array($minute,$mornning_time)){?> checked="checked" <?php } ?>/>&nbsp;<?=$minute?> &nbsp;&nbsp;<?php } ?>				
					
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Evening Time Slot: </label>
              <div class="controls" style="padding-left:85px;">
                <?php
				 $evening_time_array=array();
				 if($detail['evening_time']!=''){$evening_time_array=explode(',',$detail['evening_time']);}
				 ?>
				<?php
				    $evening = get_evening('01:30', '06:00');
					
					function get_evening ( $start, $end ) {
					while ( strtotime($start) <= strtotime($end) ) {  
					$evening[] = date("H:i", strtotime( "$start" ) );  
					$start = date("H:i", strtotime( "$start + 45 mins")) ;      
					}  
					return $evening;  
					}  

					foreach($evening as $evening_time) {?> 
                    <input type="checkbox" value="<?=$evening_time?>" class="evening_time" name="evening" <?php if(in_array($evening_time,$evening_time_array)){?> checked="checked" <?php } ?> />&nbsp; <?=$evening_time?>&nbsp;&nbsp; <?php } ?>			
					
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Night Time Slot: </label>
              <div class="controls" style="padding-left:85px;">
                <?php
				 $night_time=array();
				 if($detail['night_time']!=''){$night_time=explode(',',$detail['night_time']);}
				 ?>
				<?php
				    $night = get_night('06:00', '11:15');
					
					function get_night ( $start, $end ) {
					while ( strtotime($start) <= strtotime($end) ) {  
					$night[] = date("H:i", strtotime( "$start" ) );  
					$start = date("H:i", strtotime( "$start + 45 mins")) ;      
					}  
					return $night;  
					}  

					foreach($night as $minute) {?> 
                    <input type="checkbox" value="<?=$minute?>" class="night_time" name="night" <?php if(in_array($minute,$night_time)){?> checked="checked" <?php } ?> />&nbsp; <?=$minute?>&nbsp;&nbsp; <?php } ?>				
					
              </div>
            </div>
			
            </div>
			
			
			<!--tab3-->
			<div id="tab3" class="tab-pane">
			
			  <form action="" method="post" class="form-horizontal" id="basic">
		  
		         <div class="control-group">
                    <label class="control-label">Available Facilities : </label>
                       <div class="controls">
                           <textarea class="span6" placeholder="Available Facilities Like (Wifi , Ac)" id="facilities"><?=$shopDetail['facilities'];?></textarea>
						   <p id="error_facilities" class="error">Please Enter Available Facilities.</p>
                       </div>
                 </div>
				 
				 <div class="control-group">
                    <label class="control-label">Available Brand : </label>
                       <div class="controls">
                           <textarea class="span6" placeholder="Available Brand Like (L'Oreal Paris , Oley)" id="brand"><?=$shopDetail['brand'];?></textarea>
						   <p id="error_brand" class="error">Please Enter Available Brand.</p>
                       </div>
                 </div>
				 
            
				<div class="form-actions">
				  <input type="hidden" id="shop_id" value="<?=$id?>"> 
				  <input type="button" class="btn btn-success edit_shop_bdetail" value="Update">
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
<!--<script src="js/jquery.uniform.js"></script>--> 
<script src="js/select2.min.js"></script> 
<!--<script src="js/jquery.dataTables.min.js"></script>--> 
<script src="js/matrix.js"></script> 
<!--<script src="js/matrix.tables.js"></script>-->

<script src="js/star-rating.js"></script>
<script src="js/developer.js"></script>
<script src="js/developer-validation.js"></script> 

</body>
</html>

<script>

</script>
<script>
	
</script>