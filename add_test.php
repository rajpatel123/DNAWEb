<?php
require_once("lib/database.php");
require_once("lib/function.php");
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_test" class="tip-bottom">Manage Test</a> <a href="javascript:void(0);" class="current">Test Coupon</a> </div>
  <h1>Add Test</h1>
</div>
<div class="container-fluid">
  <hr>
  <div id="show"></div>
  
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Test Coupon</h5>
        </div>
        <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="" autocomplete="off">
		  
		    <!--Message-Part-Start-->
		    <div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Test Added Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Something went wrong.please try again. 
			</div>
			
			<div class="alert alert-error1" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Warning ! </strong>Test Name already exit. Please try to new. 
			</div>
			<!--Message-Part-End-->
			<div class="test"></div>
			
			
			<div class="control-group">
              <label class="control-label">Test Date</label>
               <div class="controls">
                <div  data-date="02-12-2012" class="input-append date datepicker">
				  <span class="add-on"><i class="icon-calendar"></i></span>
                  <input type="text" value="" data-date-format="dd-mm-yyyy" class="datepicker" id="start_date" disabled>
				   <label id="error_start_date" class="error">Please Enter Test Date.</label>
                  </div>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Test Image <span style="color:red;">*</span> : </label>
              <div class="controls">
                <input type="file" id="file" />
				<label id="error_file" class="error">Please Select Test Image.</label>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Test Name :</label>
              <div class="controls">
                <input type="text" placeholder="Test Name" class="span6" id="name"/>
				<label id="error_name" class="error">Please Enter Test Name.</label>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Total Question :</label>
              <div class="controls">
                <input type="text" placeholder="Total Question" class="span6" id="question"/>
				<label id="error_question" class="error">Please Enter Total Question.</label>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Test Duration :</label>
              <div class="controls">
                  <select id="duration" class="span6">
                  <option value="">Select Category</option>
				  <option value="30m">30m</option>
				  <option value="45m">45m</option>
				  <option value="1h">1h</option>
				  <option value="2h">2h</option>
				  <option value="3h">3h</option>
                </select>
                
				<label id="error_duration" class="error">Please Enter Test Duration.</label>
              </div>
            </div>
		
			 <div class="control-group">
              <label class="control-label">Category :</label>
              <div class="controls">
                <select id="category" class="span6">
                  <option value="">Select Category</option>
				  <option value="Grand Test">Grand Test</option>
				  <option value="Mini Test">Mini Test</option>
				  <option value="Subject Wise Test">Subject Wise Test</option>
                </select>
				
              </div>
            </div>
		
			
		    <div class="control-group">
              <label class="control-label">Is Paid :</label>
              <div class="controls">
                <select id="paid" class="span6">
                  <option value="">Select Paid Type</option>
				  <option value="Yes">Yes</option>
                  <option value="No">No</option>
                </select>
				<label id="error_coupon_type" class="error">Please Select Paid Type.</label>
              </div>
            </div> 
		  
            <div class="form-actions">
              <input type="button" value="Submit" class="btn btn-success add_test" >
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
	        $(document).delegate(".add_test","click",function(){
				     
                    var start_date = $("#start_date").val();
                    var file = $('#file').prop('files')[0];
                    var question = $("#question").val();
                    var name = $("#name").val();
			        var duration = $("#duration").val();
			        var category = $("#category").val();
			        var paid = $("#paid").val();
			        
					var form_data = new FormData();
					form_data.append('start_date', start_date);
					form_data.append('file', file);
					form_data.append('question', question);
					form_data.append('name', name);
                    form_data.append('duration', duration);	
                    form_data.append('category', category);	
                    form_data.append('paid', paid);	
                    
                    //if(AddCoupon()){
						

					$.ajax({
					url: 'ajax/add_test.php', // point to server-side PHP script 
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
				
					//}
				
				
		});
		
	});
	
	function AddCoupon() {
		///alert();
		var start_date=document.getElementById("start_date").value;
		var end_date=document.getElementById("end_date").value;
		var name=document.getElementById("name").value;
		var coupon_type=document.getElementById("coupon_type").value;
		var price=document.getElementById("price").value;
		var code=document.getElementById("code").value;
		var desc=document.getElementById("desc").value;
		
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


			
			
