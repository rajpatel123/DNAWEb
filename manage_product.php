<?php 
require_once("lib/database.php");
require_once("lib/function.php");
if($_SESSION['id']!=''){
	$id = $_SESSION['id'];
}else{
	header("Location:logout.php");
}

$product = mysql_query("SELECT * FROM product  order by created_on desc");

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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Product</a> </div>
    <h1>Manage Product</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
       
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Manage Product</h5>
          </div>
          <div class="widget-content nopadding">
		  <div class="table-responsive">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Category Name</th>
                  <th>Product Name</th>
                  <th>Product Image</th>
                  <th>Sale Price</th>
                  <th>Total Quantity</th>
                  <th>Available Quantity</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
			  $sn=1;
			  while($product_detail = mysql_fetch_array($product)){?>
                <tr class="gradeX<?=$product_detail['id']?>">
                  <td class="center"><?=$sn;?></td>
                  <td><?php $cat_name = mysql_fetch_array(mysql_query("SELECT * FROM category WHERE id='".$product_detail['cat_id']."'")); echo ucfirst($cat_name['category_name']);?></td>
                  <td><?=ucfirst($product_detail['product_name']);?></td>
                  <td><?php if($product_detail['product_image']!='' && file_exists('img/product/'.$product_detail['product_image'])){?> 
			      <img src="img/product/<?=$product_detail['product_image']?>" height="50" width="50" ><?php } ?></td>
                  <td><?=$product_detail['product_sprice'];?></td>
                  <td><?=$product_detail['product_quantity'];?></td>
                 <td><?php $quentity = mysql_fetch_array(mysql_query("select COUNT(quantity) as qs from `order` where product_id='".$product_detail['id']."' and delivery_status!='2'"));
                      echo $available_quentity = $product_detail['product_quantity']-$quentity['qs']; ?></td>
                  <td><?php if($product_detail['status']=='1'){ echo '<button class="btn btn-success btn-mini">Active</button>'; }else{ echo '<button class="btn btn-danger btn-mini">Inactive</button>';} ?></td>
                  <td><a href="view_product.php?id=<?=base64_encode($product_detail['id']);?>"><span class="icon-eye-open"><span></a>
				  &nbsp;&nbsp;<a href="edit_product.php?id=<?=base64_encode($product_detail['id']);?>"><span class="icon-edit"><span></a> &nbsp;
				  <a href="javascript:void(0);" onclick="Delete('<?php print $product_detail['id'];?>','<?php print "Product";?>')"><span class="icon-trash"><span></a></td>
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
    <?php include("segment/footer.php");?>
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
