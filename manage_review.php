<?php 
require_once("lib/database.php");
//require_once("lib/function.php");
if($_SESSION['id']!=''){
	$id = $_SESSION['id'];
}else{
	header("Location:logout.php");
}

$review = mysql_query("SELECT * FROM review order by created_on desc");

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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Review</a> </div>
    <h1>Manage Review</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Manage Review</h5>
          </div>
          <div class="widget-content nopadding">
		  <div class="table-responsive">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Customer Name</th>
                  <th>Product Name</th>
                  <th>Review</th>
                  <th>Rating</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
			  $sn=1;
			  while($review_detail = mysql_fetch_array($review)){?>
                <tr class="gradeX<?=$review_detail['id']?>">
                  <td class="center"><?=$sn;?></td>
                  <td><?php $cus_name = mysql_fetch_array(mysql_query("SELECT * FROM customer WHERE id='".$review_detail['customer_id']."'")); echo ucfirst($cus_name['fname']);?></td>
                  <td><?php $pro_name = mysql_fetch_array(mysql_query("SELECT * FROM product WHERE id='".$review_detail['product_id']."'")); echo ucfirst($pro_name['product_name']);?></td>
                  <td><?=$review_detail['review'];?></td>
                  <td><?=$review_detail['rating'];?></td>
                  <td>
				  <a href="javascript:void(0);" onclick="Delete('<?php print $review_detail['id'];?>','<?php print "Review";?>')"><span class="icon-trash"><span></a></td>
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
