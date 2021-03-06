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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_payment.php" class="tip-bottom">Manage Payment</a> <a href="javascript:void(0);" class="current">Add Payment</a> </div>
  <h1>Add Payment</h1>
</div>
<div class="container-fluid">
  <hr>
  <div id="show"></div>
  
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Payment</h5>
        </div>
        <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="" autocomplete="off">
		  
		    <!--Message-Part-Start-->
		    <div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Payment Added Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Something went wrong.please try again. 
			</div>
			<!--Message-Part-End-->
			<div class="test"></div>
			
			<div class="control-group">
              <label class="control-label">Shop Name :</label>
              <div class="controls">
                <select id="shop_id" class="span6">
                  <option value="">Select Shop Name</option>
				   <?php $shop = mysql_query("SELECT * FROM gosaloon_onwer WHERE type='Vendor'");
				       while($details = mysql_fetch_array($shop)){?>
					      <option value="<?=$details['id']?>"><?=ucfirst($details['shop_name'])?></option>
				   <?php } ?>
                </select>
				<label id="error_shop_id" class="error">Please Select Shop Name.</label>
              </div>
            </div>
			
			
			<div class="control-group">
              <label class="control-label">Starting Date</label>
               <div class="controls">
                <div  data-date="02-12-2012" class="input-append date datepicker">
				  <span class="add-on"><i class="icon-th"></i></span>
                  <input type="text" value="" data-date-format="dd-mm-yyyy" class="datepicker" id="start_date">
				   <label id="error_start_date" class="error">Please Enter Starting Date.</label>
                  </div>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Ending Date</label>
              <div class="controls">
                <div  data-date="02-12-2012" class="input-append date datepicker">
				  <span class="add-on"><i class="icon-th"></i></span>
                  <input type="text" value="" class="datepicker" data-date-format="dd-mm-yyyy"  id="end_date">
				  <label id="error_end_date" class="error">Please Enter Ending Date.</label>
				  <label id="error_date" class="error">Please Enter Ending Date Is Lower Than Coupon Starting Date.</label>
                  </div>
              </div>
            </div>
			
		   
		  
		    <div class="control-group">
              <label class="control-label">Price :</label>
              <div class="controls">
                <input type="text" placeholder="Price" class="span6" id="price"/>
				<label id="error_price" class="error">Please Enter Price.</label>
              </div>
            </div>
           
       
            <div class="form-actions">
              <input type="button" value="Submit" class="btn btn-success add_payment" >
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
	        $(document).delegate(".add_payment","click",function(){
				   
					   
                    var shop_id = $("#shop_id").val();
                    var start_date = $("#start_date").val();
                    var end_date = $("#end_date").val();
			        var price = $("#price").val();
			        
				
					var form_data = new FormData();
					form_data.append('shop_id', shop_id);
					form_data.append('start_date', start_date);
					form_data.append('end_date', end_date);
                    form_data.append('price', price);	
                    

                    if(AddPayment()){
						

					$.ajax({
					url: 'ajax/add_payment.php', // point to server-side PHP script 
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
					  }else{
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }
				     }
				    });
				
					}
				
				
		});
		
	});
	
	function AddPayment() {
		///alert();
		var shop_id=document.getElementById("shop_id").value;
		var start_date=document.getElementById("start_date").value;
		var end_date=document.getElementById("end_date").value;
		var price=document.getElementById("price").value;
		
		if(shop_id=="")
	   {	   
		   hideAllErrorscheck_blankpayment();
		   document.getElementById('error_shop_id').style.display="inline";
		   document.getElementById('shop_id').focus();
		   return false;
		   
	   }else if(start_date=="")
	   {	   
		   hideAllErrorscheck_blankpayment();
		   document.getElementById('error_start_date').style.display="inline";
		   document.getElementById('start_date').focus();
		   return false;
		   
	   }else if(end_date==""){
		   hideAllErrorscheck_blankpayment();
		   document.getElementById('error_end_date').style.display="inline";
		   document.getElementById('end_date').focus();
		   return false;
		   
	   }else if(start_date >= end_date){
		   hideAllErrorscheck_blankpayment();
		   document.getElementById('error_date').style.display="inline";
		   document.getElementById('end_date').focus();
		   return false;
		   
	   }else if(price==""){
		   hideAllErrorscheck_blankpayment();
		   document.getElementById('error_price').style.display="inline";
		   document.getElementById('price').focus();
		   return false;
		   
		   
	   }else{
		   
		   return true;
	   }
		
	}
	
	function hideAllErrorscheck_blankpayment()
    {
	
	document.getElementById("error_shop_id").style.display="none";
	document.getElementById("error_start_date").style.display="none";
	document.getElementById("error_end_date").style.display="none";
	document.getElementById("error_date").style.display="none";
	document.getElementById("error_price").style.display="none";
	

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
<script>
 $(function () {
     $('.datepicker').datepicker({  
         minDate:new Date()
      });
 });

</script>



</body>
</html>


			
			
