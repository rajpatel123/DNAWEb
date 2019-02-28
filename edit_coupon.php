<?php
require_once("lib/database.php");
require_once("lib/function.php");

if($_GET['id']!=''){
	$id = base64_decode($_GET['id']);
}else{
	header("Location:logout.php");
}

$couponDetail = mysql_fetch_array(mysql_query("SELECT * FROM gosaloon_coupon WHERE id='".$id."'"));

?>
<!DOCTYPE html>
<html lang="en">
<!--Head-part-->
   <?php include("segment/head.php");?>
  <link rel="stylesheet" href="css/datepicker.css" />

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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_coupon.php" class="tip-bottom">Manage Coupon</a> <a href="javascript:void(0);" class="current">Edit Coupon</a> </div>
  <h1>Edit Coupon</h1>
</div>
<div class="container-fluid">
  <hr>
  <div id="show"></div>
  
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Coupon</h5>
        </div>
        <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="" autocomplete="off">
		  
		    <!--Message-Part-Start-->
		    <div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Coupon Update Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Something went wrong.please try again. 
			</div>
			
			
			<!--Message-Part-End-->
			<div class="test"></div>
			<div class="control-group">
              <label class="control-label">Coupon Starting Date</label>
               <div class="controls">
                <div  data-date="02-12-2012" class="input-append date datepicker">
				  <span class="add-on"><i class="icon-th"></i></span>
                  <input type="text" value="<?=$couponDetail['start_date']?>" data-date-format="dd-mm-yyyy" class="datepicker" id="start_date">
				   <label id="error_start_date" class="error">Please Enter Coupon Starting Date.</label>
                  </div>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Coupon Ending Date</label>
              <div class="controls">
                <div  data-date="02-12-2012" class="input-append date datepicker">
				  <span class="add-on"><i class="icon-th"></i></span>
                  <input type="text" value="<?=$couponDetail['end_date']?>" class="datepicker" data-date-format="dd-mm-yyyy"  id="end_date">
				  <label id="error_end_date" class="error">Please Enter Coupon Ending Date.</label>
				  <label id="error_date" class="error">Please Enter Coupon Ending Date Is Grater Than Coupon Starting Date.</label>
                  </div>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Applied Shop :</label>
              <div class="controls">
                <select id="shop_id" class="span6">
                  <option value="">Select Shop</option>
				  <option value="0" <?php if($couponDetail['shop_id']=='0'){ echo "selected";}?>>All Shop</option>
                  <?php $shop = mysql_query("SELECT * FROM gosaloon_onwer WHERE type='Vendor'");
				       while($details = mysql_fetch_array($shop)){?>
					      <option value="<?=$details['id']?>" <?php if($couponDetail['shop_id']==$details['id']){ echo "selected";}?>><?=ucfirst($details['shop_name'])?></option>
				   <?php } ?>
                </select>
				
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Coupon Name :</label>
              <div class="controls">
                <input type="text" placeholder="Coupon Name" value="<?=$couponDetail['name']?>" class="span6" id="name"/>
				<label id="error_name" class="error">Please Enter Coupon Name.</label>
              </div>
            </div>
		    <div class="control-group">
              <label class="control-label">Coupon Type :</label>
              <div class="controls">
                <select id="coupon_type" class="span6">
                  <option value="">Select Coupon Type</option>
				  <option value="Fixed Price Coupon" <?php if($couponDetail['coupon_type']=='Fixed Price Coupon'){ echo "selected";}?>>Fixed Price Coupon</option>
                  <option value="Percentage Amount Coupon" <?php if($couponDetail['coupon_type']=='Percentage Amount Coupon'){ echo "selected";}?>>Percentage Amount Coupon</option>
                </select>
				<label id="error_coupon_type" class="error">Please Select Coupon Type.</label>
              </div>
            </div> 
		  
		    <div class="control-group">
              <label class="control-label">Price :</label>
              <div class="controls">
                <input type="text" placeholder="Coupon Price" value="<?=$couponDetail['price']?>" class="span6" id="price"/>
				<label id="error_price" class="error">Please Enter Coupon Price.</label>
              </div>
            </div>
             <div class="control-group">
              <label class="control-label">Coupon Code :</label>
              <div class="controls">
                <input type="text" placeholder="Coupon Price" value="<?=$couponDetail['code']?>" class="span6" id="code"/>
				<label id="error_code" class="error">Please Enter Coupon Code.</label>
              </div>
            </div>  			
            <div class="control-group">
              <label class="control-label">Coupon Description :</label>
              <div class="controls">
                <textarea id="desc" placeholder="Coupon Description" class="span6" ><?=$couponDetail['description']?></textarea>
				<label id="error_desc" class="error">Please Enter Coupon Description.</label>
              </div>
            </div>
			<div class="control-group">
              <label class="control-label"> Status :</label>
              <div class="controls">
                 <select id="status" class="span6">
                  <option value="">Select Status</option>
				  <option value="1" <?php if($couponDetail['status']=='1'){echo "selected";}?> >Active</option>
                  <option value="2" <?php if($couponDetail['status']=='2'){echo "selected";}?> >Inactive</option>
                </select>
				<p id="error_status" class="error">Please Select Shop status.</p>
              </div>
            </div>
             <!--<div class="control-group">
              <label class="control-label">Category Image : </label>
              <div class="controls">
                <input type="file" id="file" />
				<p id="error_file" class="error">Please Select Category Image.</p>
              </div>
            </div>-->
       
            <div class="form-actions">
              <input type="hidden" id="cid" value="<?=$id?>" >
              <input type="button" value="Submit" class="btn btn-success add_coupon" >
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
<script src="js/developer.js"></script> 
<script src="js/developer-validation.js"></script>

<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script>  
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/matrix.js"></script> 

<script>
$(document).ready(function() { 
	        $(document).delegate(".add_coupon","click",function(){
				   //alert();return false;
					   
                    var start_date = $("#start_date").val();
                    var end_date = $("#end_date").val();
                    var shop_id = $("#shop_id").val();
                    var name = $("#name").val();
			        var coupon_type = $("#coupon_type").val();
			        var price = $("#price").val();
			        var code = $("#code").val();
			        var desc = $("#desc").val();
			        var status = $("#status").val();
			        var cid = $("#cid").val();
                    
				
					var form_data = new FormData();
					form_data.append('start_date', start_date);
					form_data.append('end_date', end_date);
					form_data.append('shop_id', shop_id);
					form_data.append('name', name);
                    form_data.append('coupon_type', coupon_type);	
                    form_data.append('price', price);	
                    form_data.append('code', code);	
                    form_data.append('desc', desc);
                    form_data.append('status', status);
                    form_data.append('cid', cid);

                    if(EditCoupon()){
						

					$.ajax({
					url: 'ajax/edit_coupon.php', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                        
					type: 'post',
				    success: function (result) {
						//alert(result);return false;
						//$('.test').html(result);
					 if(result==1){
						  $(".form-horizontal")[0].reset();
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); location.reload(); }, 3000);
					  }else if (result==2){
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }else{
						  $('.alert-error1').show();
				          setTimeout(function() { $(".alert-error1").hide(); }, 3000);
					  }
				     }
				    });
				
					}
				
				
		});
		
	});
	
	function EditCoupon() {
		///alert();
		var start_date=document.getElementById("start_date").value;
		var end_date=document.getElementById("end_date").value;
		var name=document.getElementById("name").value;
		var coupon_type=document.getElementById("coupon_type").value;
		var price=document.getElementById("price").value;
		var code=document.getElementById("code").value;
		var desc=document.getElementById("desc").value;
		var status=document.getElementById("status").value;
		
		if(start_date=="")
	   {	   
		   hideAllErrorscheck_blankcoupon();
		   document.getElementById('error_start_date').style.display="inline";
		   document.getElementById('start_date').focus();
		   return false;
		   
	   }else if(end_date==""){
		   hideAllErrorscheck_blankcoupon();
		   document.getElementById('error_end_date').style.display="inline";
		   document.getElementById('end_date').focus();
		   return false;
		   
	   }else if(start_date >= end_date){
		   hideAllErrorscheck_blankcoupon();
		   document.getElementById('error_date').style.display="inline";
		   document.getElementById('end_date').focus();
		   return false;
		   
	   }else if(name==""){
		   hideAllErrorscheck_blankcoupon();
		   document.getElementById('error_name').style.display="inline";
		   document.getElementById('name').focus();
		   return false;
		   
		   
	   }else if(coupon_type==""){
		   hideAllErrorscheck_blankcoupon();
		   document.getElementById('error_coupon_type').style.display="inline";
		   document.getElementById('coupon_type').focus();
		   return false;
		   
		   
	   }else if(price==""){
		   hideAllErrorscheck_blankcoupon();
		   document.getElementById('error_price').style.display="inline";
		   document.getElementById('price').focus();
		   return false;
		   
		   
	   }else if(code==""){
		   hideAllErrorscheck_blankcoupon();
		   document.getElementById('error_code').style.display="inline";
		   document.getElementById('code').focus();
		   return false;
		   
		   
	   }else if(desc==""){
		   hideAllErrorscheck_blankcoupon();
		   document.getElementById('error_desc').style.display="inline";
		   document.getElementById('desc').focus();
		   return false;
		   
		   
	   }else if(status==""){
		   hideAllErrorscheck_blankcoupon();
		   document.getElementById('error_status').style.display="inline";
		   document.getElementById('status').focus();
		   return false;
		   
		   
	   }else{
		   
		   return true;
	   }
		
	}
	
	function hideAllErrorscheck_blankcoupon()
    {
	
	document.getElementById("error_start_date").style.display="none";
	document.getElementById("error_end_date").style.display="none";
	document.getElementById("error_date").style.display="none";
	document.getElementById("error_name").style.display="none";
	document.getElementById("error_coupon_type").style.display="none";
	document.getElementById("error_price").style.display="none";
	document.getElementById("error_code").style.display="none";
	document.getElementById("error_desc").style.display="none";
	document.getElementById("error_status").style.display="none";

	} 
	
	
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


<script src="js/bootstrap-colorpicker.js"></script> 
<script src="js/matrix.form_common.js"></script> 
<script src="js/bootstrap-datepicker.js"></script> 




</body>
</html>


			
			
