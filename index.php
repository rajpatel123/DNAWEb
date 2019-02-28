<?php

include("lib/database.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
        <title>DNA</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/matrix-login.css" />
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
</head>
    
    <body>
        <div id="loginbox">            
            <form class="form-vertical" action="" method="post" autocomplete="off" id="loginform">
				<!--<div class="control-group normal_text"> <h3><img src="img/kc_logo.png" alt="Logo" /></h3></div>-->
				 <div class="control-group normal_text"> <h3 style="font-size:40px;"><span style="color:red;">DNA</span> Admin</h3></div>
				 
				 <div class="alert alert-error" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                  <strong>Error!</strong> The adminstrator username or password incorrect </div>
				 <div class="alert alert-suspend" style="display:none;">
                 <button class="close" data-dismiss="alert">×</button>
                 <strong>Suspend!</strong> Your account suspend due to some reason. GoSaloon Adminstrator </div>
				 
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" placeholder="Username (eg. Admin)" required="required" id="username"  maxlength="40" minlength="5"/>
                        </div>
                    </div>
                </div>
				
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password"  placeholder="Password" required="required" id="password" maxlength="40" minlength="5">
                        </div>
                    </div>
                </div>
				<!--
				<div class="control-group">
					<div class="col-sm-12 col-xs-12" style="text-align:center;margin-bottom:-14px;">
						<a href="javascript:void(0);" id="to-recover">Forgot Password <i class="icon-chevron-right"></i></a>
					</div>
				</div>-->
				
				
                <div class="form-actions">
				<div class="col-sm-12 col-xs-12">
                   <button type="button" class="btn btn-md btn-success btn-block login" style="width:91%;margin: 0px auto; padding:10px;">
				   <i class="icon-lock"></i> Secure Login 
				   </button>
				</div>
				</div>
				
				<div class="control-group">
					<div class="text-right" style="margin-right:40px; font-color:white;">
						<!--<a href="registration.php">Not a member ? Click here</a>-->
					</div>
				</div>
			
            </form>
			
			
			
			
            <form id="recoverform" action="" method="post" class="form-vertical">
			
			    <div class="control-group normal_text"> <h3><img src="img/logo.png" alt="Logo" /></h3></div>
			
				<p class="normal_text text-hide" >Enter your e-mail address below and we will send you dummy password in your e-mail.</p>
				
				<div class="alert alert-error" style="display:none;">
                <button class="close" data-dismiss="alert">×</button>
                <strong>Error ! </strong> Please enter email-id.
			    </div>
				<div class="alert alert-error1" style="display:none;">
                <button class="close" data-dismiss="alert">×</button>
                <strong>Error ! </strong> This e-mail address not register.please try again.
			    </div>
				<div class="alert alert-success" style="display:none;">
                <button class="close" data-dismiss="alert">×</button>
                <strong>Success ! </strong> Send successfully. please check your e-mail address
			    </div>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" id="email_id"/>
                        </div>
                    </div>
					
					<div class="control-group">
					  <div class="col-sm-12 col-xs-12" style="text-align:center;margin-bottom:-14px;">
						<a href="javascript:void(0);" id="to-login"><i class="icon-chevron-left"></i> Back to login </a>
					  </div>
				    </div>
               
				<div class="form-actions">
				<div class="col-sm-12 col-xs-12">
                   <button type="button" class="btn btn-md btn-success btn-block recover_password" style="width:91%;margin: 0px auto; padding:10px;">
				   <i class="icon-lock"></i> Reecover 
				   </button>
				</div>
				</div>
				
				
				
            </form>
        </div>
        
        <script src="js/jquery.min.js"></script>  
        <script src="js/matrix.login.js"></script> 
        <script src="js/developer.js"></script> 
        
    </body>

</html>

	
