<?php 
require_once("lib/database.php");
require_once("lib/function.php");
if($_SESSION['id']!=''){
	$id = $_SESSION['id'];
	$tid = $_GET['tid'];
}else{
	header("Location:logout.php");
}

$test = mysql_query("SELECT * FROM test_question where test_id='".$tid."'  order by created_on desc");

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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_test.php" class="tip-bottom">Manage Test</a> <a href="javascript:void(0);" class="current">Manage Question Answer</a></div>
    <h1>Manage Question Answer</h1>
  </div>
  <div class="container-fluid">
    <hr>
    <div class="row-fluid">
      <div class="span12">
        
       
        
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Manage Question Answer</h5>
            <button class="float-left"><a href="add_question.php?tid=<?=$tid?>&limit=">Add Question Answer</a></button>
          </div>
          <div class="widget-content nopadding">
		  <div class="table-responsive">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Question</th>
                  <th>Answer 1</th>
                  <th>Answer 2</th>
                  <th>Answer 3</th>
                  <th>Answer 4</th>
                  <th>Currect Answer</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
			  $sn=1;
			  while($test_detail = mysql_fetch_array($test)){?>
                <tr class="gradeX<?=$test_detail['id']?>">
                  <td class="center"><?=$sn;?></td>
                  <td><?=$test_detail['question'];?></td>
                  <td><?=$test_detail['ans1'];?></td>
                  <td><?=$test_detail['ans2'];?></td>
                  <td><?=$test_detail['ans3'];?></td>
                  <td><?=$test_detail['ans4'];?></td>
                  <td><?=$test_detail['currect_ans'];?></td>
                  
                  <td><!--<a href="view_product.php?id=<?=base64_encode($product_detail['id']);?>"><span class="icon-eye-open"><span></a>
				  &nbsp;&nbsp;<a href="edit_product.php?id=<?=base64_encode($product_detail['id']);?>"><span class="icon-edit"><span></a> &nbsp;-->
				  <a href="javascript:void(0);" onclick="Delete('<?php print $test_detail['id'];?>','<?php print "Question";?>')"><span class="icon-trash"><span></a></td>
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
