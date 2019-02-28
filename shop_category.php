<?php 
require_once("lib/database.php");
require_once("lib/function.php");

if($_GET['id']!=''){
	$id = base64_decode($_GET['id']);
}else{
	header("Location:logout.php");
}

$shopDetails = mysql_fetch_array(mysql_query("SELECT * FROM gosaloon_onwer WHERE id='".$id."'"));

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

<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_shop.php" class="tip-bottom">Manage Shop</a> <a href="javascript:void(0);" class="current">Shop Category</a> </div>
  <h1>Shop Category Details</h1>
</div>
<div class="container-fluid">
  <hr>
  <div class="row-fluid">
    <div class="span12">
	
	
	    <!--Message-Part-Start-->
        <div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Something went wrong.please try again. 
		</div>
		<div class="alert alert-error1" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Please at least check one of the checkbox In category. 
		</div>
		<div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Shop Category Addes Successfully. 
		</div>
		<div class="alert alert-success1" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Shop Category Update Successfully. 
		</div>
		<!--Message-Part-End-->
	
	
	
	
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
           <ul class="nav nav-tabs">
		       
			   <?php if($shopDetails['shop_type']=='Male'){?>
                  <li class="active"><a data-toggle="tab" href="#tab1">Man Category</a></li>
			   <?php }else if($shopDetails['shop_type']=='Female'){ ?>
                  <li class="active"><a data-toggle="tab" href="#tab2">Woman Category</a></li>
			   <?php }else{ ?>
			      <li class="active"><a data-toggle="tab" href="#tab3">Unisex Category</a></li>
			   <?php } ?>
            </ul>
        </div>
        
		<div class="widget-content tab-content">
            <div id="tab1" class="tab-pane <?php if($shopDetails['shop_type']=='Male'){ echo "active"; } ?>"> <!--- MALE TAB --->
            <div class="widget-content nopadding">
            <form action="#" method="get" class="form-horizontal">
				
			<div class="control-group">
              <label class="control-label">Category : </label>
              <div class="controls">
                <?php 
				 $detail = mysql_fetch_array(mysql_query("SELECT * FROM gosaloon_onwer WHERE id='".$id."'"));
				 $category_type=array();
				 if($detail['category']!=''){$category_type=explode(',',$detail['category']);}
				 $man_category = mysql_query("SELECT * FROM gosaloon_category WHERE status='1' AND category_type='1'");
			     while($CatDetail = mysql_fetch_array($man_category)){?>
                  <label>
				  
                  <input type="checkbox" value="<?=$CatDetail['id']?>" class="man" <?php if(in_array($CatDetail['id'],$category_type)){?> checked="checked" <?php } ?> /> 
				  
				  <?php if($CatDetail['category_image']!='' && file_exists('img/category/'.$CatDetail['category_image'])){?> 
			      <img src="img/category/<?=$CatDetail['category_image']?>" height="50px" width="50px" style="border-radius:50%;"><?php }else{?> <img src="img/gallery/blank.png" width="50px;" height="50px;" style="border-radius:50%;"> <?php } ?>
				  
                  <?=ucfirst($CatDetail['category_name'])?>
				  
				  </label>
			    <?php } ?>
              </div>
            </div>
			
			<div class="form-actions">
			<input type="hidden" id="cat_type" value="1">
			<input type="hidden" id="shop_id" value="<?=$id?>">
              <input type="button" class="btn btn-success man_category" value="Submit">
            </div>
			</form>
            </div>
			</div>
			
			<div id="tab2" class="tab-pane <?php if($shopDetails['shop_type']=='Female'){ echo "active"; } ?>" >   <!--- FEMALE TAB --->
            <div class="widget-content nopadding">
            <form action="#" method="get" class="form-horizontal">
			<div class="control-group">
              <label class="control-label">Category : </label>
              <div class="controls">
                <?php  
				 $detail = mysql_fetch_array(mysql_query("SELECT * FROM gosaloon_onwer WHERE id='".$id."'"));
				 $category_type=array();
				 if($detail['category']!=''){$category_type=explode(',',$detail['category']);}
				 $woman_category = mysql_query("SELECT * FROM gosaloon_category WHERE status='1' AND category_type='2'");
			     while($CatDetail = mysql_fetch_array($woman_category)){?>
                  <label>
				  
                  <input type="checkbox" value="<?=$CatDetail['id']?>" class="woman" <?php if(in_array($CatDetail['id'],$category_type)){?> checked="checked" <?php } ?> /> 
				  
				   <?php if($CatDetail['category_image']!='' && file_exists('img/category/'.$CatDetail['category_image'])){?> 
			      <img src="img/category/<?=$CatDetail['category_image']?>" height="50px" width="50px" style="border-radius:50%;"><?php }else{?> <img src="img/gallery/blank.png" width="50px;" height="50px;" style="border-radius:50%;"> <?php } ?>
				  
                  <?=ucfirst($CatDetail['category_name'])?>
				  
				  </label>
			    <?php } ?>
              </div>
            </div>
			<div class="form-actions">
			  <input type="hidden" id="cat_types" value="2">
			  <input type="hidden" id="shop_id" value="<?=$id?>">
              <input type="button" class="btn btn-success woman_category" value="Submit">
            </div>
			</form>
            </div>
			</div>
			
			<div id="tab3" class="tab-pane <?php if($shopDetails['shop_type']=='Unisex'){ echo "active"; } ?>" ><!--- FEMALE TAB --->
            <div class="widget-content nopadding">
            <form action="#" method="get" class="form-horizontal">
			<div class="control-group">
              <label class="control-label">Unisex Category : </label>
              <div class="controls">
                <?php  
				 $detail = mysql_fetch_array(mysql_query("SELECT * FROM gosaloon_onwer WHERE id='".$id."'"));
				 $category_type=array();
				 if($detail['category']!=''){$category_type=explode(',',$detail['category']);}
				 $unisex_category = mysql_query("SELECT * FROM gosaloon_category WHERE status='1'");
			     while($CatDetail = mysql_fetch_array($unisex_category)){?>
                  <label>
				  
                  <input type="checkbox" value="<?=$CatDetail['id']?>" class="woman" <?php if(in_array($CatDetail['id'],$category_type)){?> checked="checked" <?php } ?> /> 
				  
				   <?php if($CatDetail['category_image']!='' && file_exists('img/category/'.$CatDetail['category_image'])){?> 
			      <img src="img/category/<?=$CatDetail['category_image']?>" height="50px" width="50px" style="border-radius:50%;"><?php }else{?> <img src="img/gallery/blank.png" width="50px;" height="50px;" style="border-radius:50%;"> <?php } ?>
				  
                  <?=ucfirst($CatDetail['category_name'])?> &nbsp;&nbsp;( <?php if($CatDetail['category_type']=='1') { echo "Male"; }else{ echo "Female";} ?> ) 
				  </label>
			    <?php } ?>
              </div>
            </div>
			<div class="form-actions">
			  <input type="hidden" id="cat_types" value="2">
			  <input type="hidden" id="shop_id" value="<?=$id?>">
              <input type="button" class="btn btn-success woman_category" value="Submit">
            </div>
			</form>
            </div>
			</div>
			
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

</body>
</html>
