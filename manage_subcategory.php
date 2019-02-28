<?php 
require_once("lib/database.php");
require_once("lib/function.php");

if($_SESSION['id']!=''){
	$id = $_SESSION['id'];
}else{
	header("Location:logout.php");
}

$Detials = mysql_query("SELECT * FROM sub_category WHERE status='1' ORDER By cat_id ASC");
//print_r($Detials);die;
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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="tip-bottom">Manage Sub Category</a> <a href="javascript:void(0);" class="current">Shop Sub Category</a></div>
    <h1>Manage Shop</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
       
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Manage Sub Category</h5>
			<!--<a href="add_subcategory.php?shop_id=<?=base64_encode($id)?>"><button class="btn btn-success pull-right">Add Sub Category</button></a>-->
          </div>
          <div class="widget-content nopadding">
		  <div class="table-responsive">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Category Name</th>
                  <th>Sub Category Name</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
			  $sn=1;
			  while($SubCatDetials = mysql_fetch_array($Detials)){?>
			      
                <tr class="gradeX<?=$SubCatDetials['id']?>">
                  <td class="center"><?=$sn;?></td>
                  <td><?php $cat_name = mysql_fetch_array(mysql_query("SELECT * FROM category WHERE id='".$SubCatDetials['cat_id']."'")); echo ucfirst($cat_name['category_name']);?></td>
                  <td><?=ucfirst($SubCatDetials['sub_cat_name']);?></td>
                  <td><?php if($SubCatDetials['status']=='1'){ echo '<button class="btn btn-success btn-mini">Active</button>'; }else{ echo '<button class="btn btn-danger btn-mini">Inactive</button>';} ?></td>
                  <td><a href="edit_subcategory.php?id=<?=base64_encode($SubCatDetials['id']);?>"><span class="icon-edit"><span></a> &nbsp;&nbsp;
				  <a href="javascript:void(0);" onclick="Delete('<?php print $SubCatDetials['id'];?>','<?php print "SubCategory";?>')"><span class="icon-trash"><span></a></td>
                </tr>
			  <?php $sn++;} ?>
              </tbody>
            </table>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
    <?php include("include/footer.php");?>
<!--end-Footer-part-->
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.tables.js"></script>
<script src="js/developer.js"></script>

</body>
</html>
