<?php 
require_once("lib/database.php");
require_once("lib/function.php");
if($_SESSION['id']!=''){
	$id = $_SESSION['id'];
}else{
	header("Location:logout.php");
}

$test = mysql_query("SELECT * FROM test  order by created_on desc");

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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Test</a> </div>
    <h1>Manage Test</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
       
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Manage Test</h5>
          </div>
          <div class="widget-content nopadding">
		  <div class="table-responsive">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Test Name</th>
                  <th>Date</th>
                  <th>Question</th>
                  <th>Duration</th>
                  <th>Category</th>
                  <th>Paid</th>
                  <th>Image</th>
                  <th>Option</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
			  $sn=1;
			  while($test_detail = mysql_fetch_array($test)){?>
                <tr class="gradeX<?=$test_detail['id']?>">
                  <td class="center"><?=$sn;?></td>
                  <td><?php  echo ucfirst($test_detail['name']);?></td>
                  <td><?=$test_detail['date'];?></td>
                  <td><?=$test_detail['question'];?></td>
                  <td><?=$test_detail['duration'];?></td>
                  <td><?php if($test_detail['category']=='Grand Test'){ echo 'Grand Test'; }else if($test_detail['category']=='Mini Test') { echo 'Mini Test';} else { echo 'Subject Wise Test';} ?></td>
                  <td><?php if($test_detail['paid']=='Yes'){ echo 'Yes'; } else { echo 'No';} ?></td>
                  <td><?php if($test_detail['file']!='' && file_exists('img/test/'.$test_detail['file'])){?> 
			      <img src="img/test/<?=$test_detail['file']?>" height="50" width="50" ><?php } ?></td>
                 
                  <td><?php if($test_detail['status']=='1'){ echo '<button class="btn btn-success btn-mini">Active</button>'; }else{ echo '<button class="btn btn-danger btn-mini">Inactive</button>';} ?></td>
                  <td><a href="manage_test_question.php?tid=<?=$test_detail['id']?>&limit=<?=$test_detail['question']?>">Test Question</a></td>
                  <td><!--<a href="view_product.php?id=<?=base64_encode($product_detail['id']);?>"><span class="icon-eye-open"><span></a>
				  &nbsp;&nbsp;<a href="edit_product.php?id=<?=base64_encode($product_detail['id']);?>"><span class="icon-edit"><span></a> &nbsp;-->
				  <a href="javascript:void(0);" onclick="Delete('<?php print $test_detail['id'];?>','<?php print "Test";?>')"><span class="icon-trash"><span></a></td>
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
