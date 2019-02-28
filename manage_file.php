<?php 
require_once("lib/database.php");
require_once("lib/function.php");

$file = mysql_query("SELECT * FROM video_pdf order by created_on desc");



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
    <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="#" class="current">Manage Files</a> </div>
    <h1>Manage Files</h1>
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
                  <strong>Success ! </strong> File Delete Successfully. 
		</div>
		<!--Message-Part-End-->
		
        <div class="widget-box">
          <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
            <h5>Manage Category</h5>
          </div>
          <div class="widget-content nopadding">
		  <div class="table-responsive">
            <table class="table table-bordered data-table">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>File</th>
                  <th>Sub Child Category</th>
                  <th>File Type </th>
                  <th>File Title </th>
                  <th>File Sub Title </th>
                  <th>File Description</th>
                  <th>File Url </th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
			  <?php 
			  $sn=1;
			  while($file_detail = mysql_fetch_array($file)){
			  $suc_child_cat = mysql_query("select sub_child_name from sub_child_category where id='".$file_detail['sub_child_cat']."'");
			       $detail = mysql_fetch_array($suc_child_cat);
			  ?>
                <tr class="gradeX<?=$file_detail['id'];?>">
                  <td class="center"><?=$sn;?></td>
                  <td><?php if($file_detail['file_type']=='video'){ echo "Video";}else{ echo "PDF";}?></td>
                  <td><?=$detail['sub_child_name'];?></td>
                  <td><?php if($file_detail['type']=='1'){ echo 'Free'; }else{ echo 'Price';} ?></td>
                  <td><?=$file_detail['title'];?></td>
                  <td><?=$file_detail['sub_title'];?></td>
                  <td><?=$file_detail['desc'];?></td>
                  <td><a href="img/file/<?php echo $file_detail['file'];?>"   target="_blank"><button class="btn btn-success btn-mini">Play</button></a></td>
                  
                  <td>
                      <!--<a href="edit_category.php?id=<?=base64_encode($Category_detail['id']);?>"><span class="icon-edit"><span></a>--> &nbsp;&nbsp;
				  <a href="javascript:void(0);" onclick="Delete('<?php print $file_detail['id'];?>','<?php print "File";?>')"><span class="icon-trash"><span></a></td>
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
