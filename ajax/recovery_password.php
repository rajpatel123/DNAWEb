<?php
include("../lib/database.php");
include("../lib/function.php");
require("../phpmailer/class.phpmailer.php"); 

$email_id = $_POST['email_id'];
$pass = mt_rand(10,1000);
$password = 'salon'.$pass;


if($email_id!=''){
	
$chkExit = "SELECT * FROM gosaloon_onwer WHERE email='".$email_id."'";
$chkExits= mysql_query($chkExit);
$data= mysql_fetch_array($chkExits);

if(mysql_num_rows($chkExits) > 0){
	
	$send = mysql_query("UPDATE `gosaloon_onwer` SET password='$password' WHERE id='".$data['id']."'");
	//echo "UPDATE `gosaloon_onwer` SET password='$password' WHERE id='".$data['id']."'";
	if($send){
		
		echo "1";
		
		//mail Integration
				$FromEmail="noreply@gosalon.com";
				$FromName ="Go Salon";
				$to_email = $email_id; // Customer
				
                $mail_conent = '<div style="background-color: #eeeeef; padding: 50px 0; ">
                                <div style="max-width:640px; margin:0 auto; "> 
                                <div style="color: #fff; text-align: center; background-color:#33333e; padding: 30px; border-top-left-radius: 3px; border-top-right-radius: 3px; margin: 0;">  
                                <h1>Recovery Password Details</h1>
                                </div>
                                <div style="padding: 20px; background-color: rgb(255, 255, 255);">           
								<p style="color: rgb(85, 85, 85); font-size: 14px;"> Hello '.$data['name'].'</p>            
								<p style="color: rgb(85, 85, 85); font-size: 14px;"> Please use the following info to login your account:</p>            <hr>         
								<p style="color: rgb(85, 85, 85); font-size: 14px;">URL:&nbsp;<a href="https://aigpl.com/Gosalon" target="_blank">Go Salon</a></p>    
								<p style="color: rgb(85, 85, 85); font-size: 14px;"></p>
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
				$mail->Subject = "Go Salon Recovery Password";
				$mail->Body = $mail_conent;
				if($mail->send())
				{
				}
		
	}
	
}else{
	
	    echo "2";
	
	
}
}else{
	
	   echo "0";
	
}


?>