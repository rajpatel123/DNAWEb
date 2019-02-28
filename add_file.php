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
<style> .error{ color:red;display:none; }</style>
	
<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_banner.php" class="tip-bottom">Manage Banner</a> <a href="javascript:void(0);" class="current">Add Banner</a> </div>
  <h1>Add Banner</h1>
</div>
<div class="container-fluid">
  <hr>
  <div id="show"></div>
  
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Banner</h5>
        </div>
        <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="" id="validation" enctype="multipart/form-data">
		  
		    <!--Message-Part-Start-->
		    <div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong>Added Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Something went wrong.please try again. 
			</div>
		   <div class="test"></div>
			<!--Message-Part-End-->
			<div class="control-group">
			    
			 <div class="span4">    
              <label class="control-label">File Type : </label>
              <div class="controls">
			   <input type="radio" name="file_type" value="video" class="file" checked> Video
               <input type="radio" name="file_type" value="pdf" class="file"> Pdf
		     </div>
            </div>
            
            <div class="span6"> 
            <label class="control-label">Sub Child Category : </label>
		      <div class="controls">
			    <select name="category[]">
			       <option value="">Select Sub Child Category </option>
			       <?php 
			       $suc_child_cat = mysql_query("select * from sub_child_category where status='1'");
			       while($detail = mysql_fetch_array($suc_child_cat)){?>
			       <option value="<?php echo $detail['id']; ?>"><?php echo $detail['sub_child_name']; ?></option>
                   <?php } ?>
               </select>
		      </div>
		    </div>  
            
            </div> 
            
            <div id="show_more">
                
            <div class="control-group">
              <div class="span4">    
              <label class="control-label">Title : </label>
              <div class="controls">
			   <input type="text" name="title[]" placeholder="Title" value="">
		      </div>
		     </div>
		     
		     <div class="span3">    
              <label class="control-label">Sub Title : </label>
              <div class="controls">
			   <input type="text" name="sub_title[]" placeholder="Sub Title" value="">
		      </div>
		     </div>
		     
		     <div class="span3"> 
		      <div class="controls">
			    <select name="type[]">
			       <option value="">Select </option>
                   <option value="1">Free</option>
                   <option value="2">Price</option>
               </select>
		      </div>
		    </div>    
		      
            </div>
		     
             <div class="control-group">
                 
             <div class="span4">      
              <label class="control-label">File : </label>
              <div class="controls">
                <input type="file" name="file[]" id="file" />
              </div>
             </div>
             
             <div class="span3">    
              <label class="control-label">Description: </label>
              <div class="controls">
			   <input type="text" name="descp[]" placeholder="Description" value="">
		      </div>
		     </div>
		     
		     <div class="span3" style="display:none;">    
               <a href="javascript:void(0)" id="add_more" rel="1" class="btn btn-success btn-mini anil" style="float:right; margin-top:14px;">
			  <strong><i class="icon icon-plus"></i> Add More</strong></a>
		     </div>
             
            </div>
            
            </div>
       
            <div class="form-actions">
              <input type="button" value="Submit" class="btn btn-success add_file" >
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
<script src="js/developer.js"></script> 
 <script src="js/developer-validation.js"></script> 

</body>
</html>

<script>
$(document).ready(function(){
	
$("#add_more").click(function(){

	var rowNum = document.getElementById("add_more").rel;
	
	rowNum ++;
	
   var res='<div id="rowNum'+rowNum+'"><div class="control-group"><div class="span4"><label class="control-label">Title : </label><div class="controls"><input type="text" name="title[]" placeholder="Title" value=""></div></div><div class="span3"><label class="control-label">Sub Title : </label><div class="controls"><input type="text" name="sub_title[]" placeholder="Sub Title" value=""></div></div><div class="span3"> <div class="controls"><select name="type[]"><option value="">Select </option><option value="1">Free</option><option value="2">Price</option></select></div></div></div><div class="control-group"><div class="span4"><label class="control-label">File : </label><div class="controls"><input type="file" name="file[]" /></div></div><div class="span3"><label class="control-label">Description: </label><div class="controls"><input type="text" name="descp[]" placeholder="Description" value=""></div></div><div class="span3"><a href="javascript:void(0);" onClick="removeRow('+rowNum+');" class="btn btn-danger btn-mini" style="float:right; margin-top:14px;"><strong><i class="icon icon-minus"></i> Remove</strong></a></div></div></div>';
	
	$(".anil").attr('rel',rowNum);
   $("#show_more").append(res);
   //$(".anil").hide();
   
});

$(document).delegate(".add_file","click",function(){
    
    var file_type = $('.file:checked').val();
	var category = $("select[name='category[]']")
              .map(function(){return $(this).val();}).get();
	var type = $("select[name='type[]']")
              .map(function(){return $(this).val();}).get();
    var title = $("input[name='title[]']")
              .map(function(){return $(this).val();}).get();
    var sub_title = $("input[name='sub_title[]']")
              .map(function(){return $(this).val();}).get(); 
    var descp = $("input[name='descp[]']")
              .map(function(){return $(this).val();}).get();
    var file = $('#file').prop('files')[0];          
          //alert(file_type);return false;   
    var form_data = new FormData();
        form_data.append('file_type', file_type);
		form_data.append('category', category);
		form_data.append('type', type);
		form_data.append('title', title);	
		form_data.append('sub_title', sub_title);	
		form_data.append('descp', descp);
		form_data.append('file', file);
		
		//alert(category);return false;   
		
		$.ajax({
			url: 'ajax/add_file.php', // point to server-side PHP script 
			dataType: 'text',  // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,                        
			type: 'post',
		    success: function (result) {
		      //$('.test').html(result);
			 //alert(result);return false;
			 if(result==1){
    			  $("#validation")[0].reset();
    			  $(".error").hide();
    			  $('.alert-success').show();
    			  setTimeout(function() { $(".alert-success").hide(); }, 3000);
    		  }else if (result==2){
    			  $('.alert-error').show();
    			  setTimeout(function() { $(".alert-error").hide(); }, 3000);
    		  }else if (result==3){
    			  $('.alert-error2').show();
    			  setTimeout(function() { $(".alert-error2").hide(); }, 3000);
    		  }else{
    			  $("#cat_validation")[0].reset();
    			  $(".error").hide();
    			  $('.alert-error1').show();
    			  setTimeout(function() { $(".alert-error1").hide(); }, 3000);
    		  }
			  
		}
		});
              	

});

});

function removeRow(rnum) {
$('#rowNum'+rnum).remove();
}
</script>
<!--
	<div class="control-group"><div class="span4"><label class="control-label">Title : </label><div class="controls"><input type="text" name="title[]" placeholder="Title" value=""></div></div><div class="span3"><label class="control-label">Sub Title : </label><div class="controls"><input type="text" name="sub_title[]" placeholder="Sub Title" value=""></div></div><div class="span3"> <div class="controls"><select><option value="">Select </option><option value="1">Free</option><option value="2">Price</option></select></div></div></div>		
-->			
