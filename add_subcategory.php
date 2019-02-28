<?php
require_once("lib/database.php");
require_once("lib/function.php");

if($_SESSION['id']!=''){
	$id = $_SESSION['id'];
}else{
	header("Location:logout.php");
}
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
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_subcategory.php" class="tip-bottom">Manage Sub Category</a> <a href="javascript:void(0);" class="current">Add Sub Category</a> </div>
  <h1>Add Shop Sub Category</h1>
</div>
<div class="container-fluid">
  <hr>
  <div id="show"></div>
  
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Sub Category</h5>
        </div>
        <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="" id="sub_cat_validation" enctype="multipart/form-data" autocomplete="off">
		  
		    <!--Message-Part-Start-->
		    <div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Sub Category Added Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Category  & Sub Category Name already exit. Please try to new. 
			</div>
			
			<div class="alert alert-error1" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Warning ! </strong>Something went wrong.please try again. 
			</div>
			
			
			<div class="control-group">
              <label class="control-label">Category Name :</label>
              <div class="controls">
                <select id="cat_id" class="show span6">
				<option value="">Select Category</value>
				  <?php
				  $cat=mysql_query("SELECT * FROM category WHERE status='1' ORDER BY category_name ASC");
					 while($cat_detals = mysql_fetch_array($cat)){?>     
							   <option value="<?php echo $cat_detals['id'];?>"><?php echo ucfirst($cat_detals['category_name']);?></value>
					 <?php } ?>	 
                </select>
				<label id="error_cat_id" class="error">Please Select Category Name.</label>
              </div>
            </div>
		  
		    <div class="control-group">
              <label class="control-label">Sub Category Name :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Category name" id="sub_cat_name"/>
				<label id="error_sub_cat_name" class="error">Please Enter Sub Category Name.</label>
              </div>
            </div> 
			
            <div class="form-actions">

              <input type="button" value="Submit" class="btn btn-success add_subcategory" >
			  
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

<script>
$(document).ready(function(){
    $('#cat_type').on('change',function(){
        var cat_type = $(this).val();
        var shop_id = '<?=$shop_id?>';
		var action = 'type';
        if(cat_type){
            $.ajax({
                type:'POST',
                url:'ajax/add_subcategory.php',
                data:{cat_type:cat_type,action:action,shop_id:shop_id},
                success:function(result){
					//alert(result);return false;
                    $('.show').html(result);
                    
                }
            }); 
        }
});

});

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

			
			
