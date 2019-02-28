<?php

include("lib/database.php");

?>


<!DOCTYPE html>
<html lang="en">
<head>
        <title>Go Salon</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="css/matrix-login.css" />
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXlLYYvMfEQbbFyHn0TJuJyCTTihFsGyM&libraries=places"></script>
		<style>
		.error{
			color:red;
			display:none;
		}
		
		</style>
</head>
    
    <body style="margin-top: 4%;">
        <div id="loginbox">            
            <form class="form-vertical" action="" method="post" autocomplete="off" id="form">
				<!--<div class="control-group normal_text"> <h3><img src="img/logo.png" alt="Logo" /></h3></div>-->
				 <div class="control-group normal_text"> <h3 style="font-size:40px;"><span style="color:red;">Go</span> Salon</h3></div>
				 
				<!--Message-Part-Start-->
				 <div class="alert alert-error" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Error!</strong> Something went wrong.please try again.  </div>
				  
				 <div class="alert alert-error1" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Error!</strong> This User Name Already Exit. Try other User Name </div>
				  
				  <div class="alert alert-error2" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Error!</strong> This Email-id Already Exit. Try other User Name </div>
				  
				 <div class="alert alert-success" style="display:none;">
                  <button class="close" data-dismiss="alert">×</button>
                  <strong>Success ! </strong> Registration Successfully.Your Username And Password Has Been Sent Your Email Id And Mobile No. Please Check. 
			      </div>
				  <div class="anil"></div>
				<!--Message-Part-End-->  
				 
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" placeholder="Username (eg. Admin)"  id="username" />
							<p class="clearfix" style="margin: 0px;padding: 0px;"></p>
							<p id="error_username" class="error">Please Enter Username.</p>
                        </div>
                    </div>
					
                </div>
				
				<div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-home"> </i></span><input type="text" placeholder="Shop name (eg. Unisex Parlor)"  id="shopname" />
							<p class="clearfix" style="margin: 0px;padding: 0px;"></p>
							<p id="error_shopname" class="error">Please Enter Username.</p>
                        </div>
                    </div>
                </div>
				
				<div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-envelope"> </i></span><input type="text" placeholder="Shop Email (eg. aaa@gmail.com)" id="email"/>
							<p class="clearfix" style="margin: 0px;padding: 0px;"></p>
							<p id="error_email" class="error">Please Enter Email Id.</p>
							<p id="error_validemail" class="error">Please Enter Valid Email Id.</p>
                        </div>
                    </div>
                </div>
				
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-map-marker"></i></span><input type="text"  placeholder="Shop address"  onFocus="initializeAutocomplete()" id="locality">
							<p class="clearfix" style="margin: 0px;padding: 0px;"></p>
							<p id="error_address" class="error">Please Enter Shop Address.</p>
                        </div>
                    </div>
                </div>
				
				<div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-phone"></i></span><input type="text"  placeholder="Shop mobile no (eg. XXXXXXXXXX)" id="mobile">
							<p class="clearfix" style="margin: 0px;padding: 0px;"></p>
							<p id="error_mobile" class="error">Please Enter Shop mobile No.</p>
							<p id="error_numeric" class="error">Please Enter Numeric Value.</p>
							<p id="error_maxlenth" class="error">Please Enter Maximum 10 Number.</p>
							<p id="error_minlenth" class="error">Please Enter Minimum 10 Number.</p>
                        </div>
                    </div>
                </div>
				
				<div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-user"></i></span>
							<select id="type">
							  <option value="">Select Shop Type</option>
							  <option value="Male">Male</option>
							  <option value="Female">Female</option>
							  <option value="Unisex">Unisex</option>
							</select>
							<p class="clearfix" style="margin: 0px;padding: 0px;"></p>
							<p id="error_type" class="error">Please Select Shop Type.</p>
                        </div>
                    </div>
                </div>
				
				<div class="control-group">
                    <div class="controls" style="margin-left:20px;">
					  
                              <input type="checkbox" name="radios" id="privacy"/> &nbsp;&nbsp;&nbsp;<span style="color:white;"><a href="#">Privacy policy </a></span>&nbsp;&nbsp;<p id="error_privacy" class="error">Please Checked Privacy.</p>
				
                      
				    </div>
                </div>
				
                <div class="form-actions">
				<div class="col-sm-12 col-xs-12">
                   <button type="button" class="btn btn-md btn-success btn-block register" style="width:91%;margin: 0px auto; padding:10px;">
				   <i class="icon-lock"></i> Submit
				   </button>
				</div>
				</div>
				
				<div class="control-group">
					<div class="text-right" style="margin-right:40px; font-color:white;">
						<a href="index.php">Already a member ? Click here</a>
					</div>
				</div>
				
            </form>
			
        </div>
        
        <script src="js/jquery.min.js"></script>  
        <script src="js/matrix.login.js"></script> 
		<script src="js/jquery.validate.js"></script>
        <script src="js/developer.js"></script> 
        <script src="js/developer-validation.js"></script> 
		

    </body>

</html>

	
