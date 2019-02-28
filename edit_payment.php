<?php
require_once("lib/database.php");
require_once("lib/function.php");

if($_GET['id']!=''){
	$id = base64_decode($_GET['id']);
}else{
	header("Location:logout.php");
}

$paymentDetail = mysql_fetch_array(mysql_query("SELECT * FROM gosaloon_payment WHERE id='".$id."'"));

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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_payment.php" class="tip-bottom">Manage Payment</a> <a href="javascript:void(0);" class="current">Edit Payment</a> </div>
  <h1>Edit Payment</h1>
</div>
<div class="container-fluid">
  <hr>
  <div id="show"></div>
  
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Edit Payment</h5>
        </div>
        <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="" autocomplete="off">
		  
		    <!--Message-Part-Start-->
		    <div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Payment Update Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Something went wrong.please try again. 
			</div>
			<!--Message-Part-End-->
			<div class="test"></div>
			
			<div class="control-group">
              <label class="control-label">Shop Name :</label>
              <div class="controls" >
                <select id="shop_id" class="span6" readonly="readonly">
                  <option value="">Select Shop Name</option>
				   <?php $shop = mysql_query("SELECT * FROM gosaloon_onwer WHERE type='Vendor'");
				       while($details = mysql_fetch_array($shop)){?>
					      <option value="<?=$details['id']?>" <?php if($details['id']==$paymentDetail['shop_id']){ echo "selected";}?>><?=ucfirst($details['shop_name'])?></option>
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
                  <input type="text" value="<?=$paymentDetail['start_date']?>" data-date-format="dd-mm-yyyy" class="datepicker" id="start_date" readonly="">
				   <label id="error_start_date" class="error">Please Enter Starting Date.</label>
                  </div>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Ending Date</label>
              <div class="controls">
                <div  data-date="02-12-2012" class="input-append date datepicker">
				  <span class="add-on"><i class="icon-th"></i></span>
                  <input type="text" value="<?=$paymentDetail['end_date']?>" class="datepicker" data-date-format="dd-mm-yyyy"  id="end_date" readonly="">
				  <label id="error_end_date" class="error">Please Enter Ending Date.</label>
				  <label id="error_date" class="error">Please Enter Ending Date Is Lower Than Coupon Starting Date.</label>
                  </div>
              </div>
            </div>
			
		   
		  
		    <div class="control-group">
              <label class="control-label">Price :</label>
              <div class="controls">
                <input type="text" placeholder="Price" value="<?=$paymentDetail['price']?>" class="span6" id="price" readonly=""/>
				<label id="error_price" class="error">Please Enter Price.</label>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">payment Status :</label>
              <div class="controls">
                <select id="status" class="span6">
                  <option value="">Select Status</option>
				  <option value="1" <?php if($paymentDetail['status']=='0'){echo "selected";}?> >Pending</option>
                  <option value="2" <?php if($paymentDetail['status']=='1'){echo "selected";}?> >Done</option>
                </select>
				<p id="error_status" class="error">Please Select payment Status.</p>
              </div>
            </div> 
           
       
            <div class="form-actions">
              <input type="hidden" value="<?=$id?>" id="pid" >
              <input type="button" value="Update" class="btn btn-success update_payment" >
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
	        $(document).delegate(".update_payment","click",function(){
				 
			        var pid = $("#pid").val();
			        var status = $("#status").val();
			        
				
					var form_data = new FormData();
					form_data.append('pid', pid);
					form_data.append('status', status);
					
                    

                    if(UpdatePayment()){
						
                    
					$.ajax({
					url: 'ajax/update_payment.php', // point to server-side PHP script 
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
	
	function UpdatePayment() {
		
		var status=document.getElementById("status").value;
		
		
	   if(status=="")
	   {	   
		 //alert();
		 hideAllErrorscheck_blankspayment();
		   document.getElementById('error_status').style.display="inline";
		   document.getElementById('status').focus();
		   return false;
		   
	   }else{
		   
		   return true;
	   }
		
	}
	
	function hideAllErrorscheck_blankspayment()
    {
	
	document.getElementById("error_status").style.display="none";
	
	} 
	
	

</script>



<script src="js/matrix.form_common.js"></script> 




</body>
</html>


			
			
