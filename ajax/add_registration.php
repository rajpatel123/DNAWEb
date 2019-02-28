<?php
include("../lib/database.php");
include("../lib/function.php");
require("../phpmailer/class.phpmailer.php"); 


$name = $_POST['username'];
$username = str_replace(' ','',$name);
$shopname = $_POST['shopname'];
$email = $_POST['email'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$type = $_POST['type'];
$privacy = '1';
$pass = mt_rand(10,1000);
$password = 'salon'.$pass;

       
//$address = $dlocation; // Google HQ
$prepAddr = str_replace(' ','+',$address);
$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
$output= json_decode($geocode);
$latitude = $output->results[0]->geometry->location->lat;
$longitude = $output->results[0]->geometry->location->lng;

//print_r($_POST);die;
$chkExitEmail = "SELECT * FROM gosaloon_onwer WHERE email='".$email."'";
$chkExitsEmail= mysql_query($chkExitEmail);
if(mysql_num_rows($chkExitsEmail) > 0){
	
	echo "3";
	
}else{


$chkExit = "SELECT * FROM gosaloon_onwer WHERE username='".$username."'";
$chkExits= mysql_query($chkExit);
if(mysql_num_rows($chkExits) > 0){
	
	echo "2";
	
}else{
	$insert = "INSERT INTO gosaloon_onwer SET name='$name',username='$username',shop_name='$shopname',shop_type='$type',email='$email',mobile_no='$mobile',password='$password',address='$address',latitude='$latitude',longitude='$longitude',privacy_policy='$privacy',type='Vendor',status='1',created_on=Now()";
	
	if(mysql_query($insert)){
		
		echo "1";
		
		// SMS Integration	
		
			$sms_login = "Dear $name, Your username : $username and password : $password Regard Go Salon Team.";		
		 
			$to_mobile=$mobile;   // $customer_contact_no;	
			
				
			$post_values = array(    								
								"uname"      => constant('SMS_UName'),								
								"pwd"        => constant('SMS_UPass'),							
								"msg"        => $sms_login,								
								"to"         => $to_mobile,								
								"senderid"   => constant('SMS_USenderid'),								
								"route"      => constant('SMS_URoute'),						
								);	
						
				function do_address_message($post_values) 							
				{								
					$post_url = "http://sms.sms4anyone.in/sendsms?";								
					// This section takes the input fields and converts them to the proper format							
					$post_string = "";								
					foreach ($post_values as $key => $value) 
					{									
						$post_string .= "$key=" . urlencode($value) . "&";								
					}								
					$post_string = rtrim($post_string, "& ");	 
					$request = curl_init($post_url); // initiate curl object								
					curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response								
					curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)								
					curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data								
					curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.								
					$post_response = curl_exec($request); // execute curl post and store results in $post_response								
					// additional options may be required depending upon your server configuration								
					// you can find documentation on curl options at http://www.php.net/curl_setopt								
					curl_close($request); // close curl object								
					// This line takes the response and breaks it into an array using the specified delimiting character								 							
				}	 													
				$post_result = do_address_message($post_values); 
																							
		// End SMS Integration
		
		//mail Integration
				$FromEmail="noreply@gosalon.com";
				$FromName ="Go Salon";
				$to_email = $email; // Customer
				
                $mail_conent = '<div style="background-color: #eeeeef; padding: 50px 0; ">
                                <div style="max-width:640px; margin:0 auto; "> 
                                <div style="color: #fff; text-align: center; background-color:#33333e; padding: 30px; border-top-left-radius: 3px; border-top-right-radius: 3px; margin: 0;">  
                                <h1>Login Details</h1>
                                </div>
                                <div style="padding: 20px; background-color: rgb(255, 255, 255);">           
								<p style="color: rgb(85, 85, 85); font-size: 14px;"> Hello '.$name.',<br><br>An account has been created for you.</p>            
								<p style="color: rgb(85, 85, 85); font-size: 14px;"> Please use the following info to login your account:</p>            <hr>         
								<p style="color: rgb(85, 85, 85); font-size: 14px;">URL:&nbsp;<a href="https://aigpl.com/Gosalon" target="_blank">Go Salon</a></p>    
								<p style="color: rgb(85, 85, 85); font-size: 14px;"></p>      
								<p style=""><span style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;">User Name: '.$username.'</span><br></p>       
								<p style=""><span style="color: rgb(85, 85, 85); font-size: 14px; line-height: 20px;">Password:&nbsp;'.$password.'</span></p>      
								<p style="color: rgb(85, 85, 85);"><br></p>    
								<p style="color: rgb(85, 85, 85); font-size: 14px;">Thanks.</p> 
								<p style="color: rgb(85, 85, 85); font-size: 14px;">GoSalon Team.</p> '; 
								
				$mail = new PHPMailer();  
				$mail->From = $FromEmail;
				$mail->FromName = $FromName;
				$mail->AddAddress($to_email); 
				$mail->AddAddress("admin@gosalon.com");   // Main Admin
				$mail->WordWrap = 50; // set word wrap to 50 characters
				$mail->IsHTML(true); // set email format to HTML
				$mail->Subject = "Go Salon Login Details";
				$mail->Body = $mail_conent;
				if($mail->send())
				{
				}
		
		
		
		
	}else{
		
		echo "0";
		
	}
}
}

?>