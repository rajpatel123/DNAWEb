<?php
require_once("lib/database.php");
require_once("lib/function.php");

if($_SESSION['id']!=''){
	$id = $_SESSION['id'];
	$tid = $_GET['tid'];
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
<style> .error{ color:red;display:none; } .span{color:red;}</style>


<div id="content">
<div id="content-header">
  <div id="breadcrumb"> <a href="dashboard.php" title="Go to Home" class="tip-bottom"><i class="icon-home"></i> Home</a> <a href="manage_test_question.php?tid=<?=$tid?>" class="tip-bottom">Manage Question</a> <a href="javascript:void(0);" class="current">Add Question</a> </div>
  <h1>Add Question</h1>
</div>
<div class="container-fluid">
  <hr>
  <div id="show"></div>
  
  <div class="row-fluid">
    <div class="span12">
      <div class="widget-box">
        <div class="widget-title"> <span class="icon"> <i class="icon-align-justify"></i> </span>
          <h5>Add Question</h5>
        </div>
        <div class="widget-content nopadding">
         <form class="form-horizontal" method="post" action="" id="sub_cat_validation" enctype="multipart/form-data" autocomplete="off">
		  
		    <!--Message-Part-Start-->
		    <div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Question Added Successfully. 
			</div>
			
			<div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error ! </strong> Question already exit. Please try to new. 
			</div>
			
			<div class="alert alert-error1" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Warning ! </strong>Something went wrong.please try again. 
			</div>
			
			<div class="test"></div>
		
		    <div class="control-group">
              <label class="control-label">Question :</label>
              <div class="controls">
                <textarea id="question" class="span6" placeholder="Enter Question"></textarea>
              </div>
            </div>
			
			<div class="control-group">
              <label class="control-label">Answer 1 <span style="color:red;">*</span> :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Answer 1" id="ans1"/>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Answer 2 <span style="color:red;">*</span> :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Answer 2" id="ans2"/>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Answer 3 <span style="color:red;">*</span> :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Answer 3" id="ans3"/>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Answer 4 <span style="color:red;">*</span> :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Answer 4" id="ans4"/>
              </div>
            </div>
            
            <div class="control-group">
              <label class="control-label">Currect Answer <span style="color:red;">*</span> :</label>
              <div class="controls">
                <input type="text" class="span6" placeholder="Currect Answer" id="answer"/>
              </div>
            </div>

            <div class="form-actions">

              <input type="button" value="Submit" class="btn btn-success add_question" >
			  
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
$(document).ready(function() { 
	        $(document).delegate(".add_question","click",function(){
				     
                    var question = $("#question").val();
                    var ans1 = $("#ans1").val();
                    var ans2 = $("#ans2").val();
			        var ans3 = $("#ans3").val();
			        var ans4 = $("#ans4").val();
			        var answer = $("#answer").val();
			        var tid = "<?=$tid?>";
			        
					var form_data = new FormData();
					form_data.append('question', question);
					form_data.append('ans1', ans1);
					form_data.append('ans2', ans2);
                    form_data.append('ans3', ans3);	
                    form_data.append('ans4', ans4);	
                    form_data.append('answer', answer);	
                    form_data.append('tid', tid);
                    //if(AddCoupon()){
						

					$.ajax({
					url: 'ajax/add_question.php', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                        
					type: 'post',
				    success: function (result) {
					//	alert(result);return false;
						//$('.test').html(result);
					 if(result==1){
						  $(".form-horizontal")[0].reset();
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); location.reload(); }, 3000);
					  }else if (result==2){
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }else{
						  $('.alert-error1').show();
				          setTimeout(function() { $(".alert-error1").hide(); }, 3000);
					  }
				     }
				    });
				
					//}
				
				
		});
		
	});
	</script>


			
			
