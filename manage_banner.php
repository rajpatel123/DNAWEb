<?php 
require_once("lib/database.php");
require_once("lib/function.php");

$banner = mysql_query("SELECT * FROM banner order by created_on desc");



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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Banner</a> </div>
    <h1>Manage Banner</h1>
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
		<div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Banner Delete Successfully. 
		</div>
		<!--Message-Part-End-->
		
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Banner Category</h5>
          </div>
          <div class="widget-content nopadding">
		  <div class="table-responsive">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S.No</th>
                  
                  <th>Banner Image </th>
                  <th>Banner Status </th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
			  $sn=1;
			  while($banner_detail = mysql_fetch_array($banner)){?>
                <tr class="gradeX<?=$banner_detail['id'];?>">
                  <td class="center"><?=$sn;?></td>
                  
                  <td><?php if($banner_detail['image']!='' && file_exists('img/banner/'.$banner_detail['image'])){?> 
			      <img src="img/banner/<?=$banner_detail['image']?>" height="75" width="75" ><?php } ?></td>
				  
                  <td><?php if($banner_detail['status']=='1'){ echo '<button class="btn btn-success btn-mini">Active</button>'; }else{ echo '<button class="btn btn-danger btn-mini">Inactive</button>';} ?></td>
                  <td>
				  <a href="javascript:void(0);" onclick="Delete('<?php print $banner_detail['id'];?>','<?php print "Banner";?>')"><span class="icon-trash"><span></a></td>
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
