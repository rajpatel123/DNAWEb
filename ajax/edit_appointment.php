<?php
include("../lib/database.php");
include("../lib/function.php");


$appointment_id = $_POST['aid'];
$status = $_POST['status'];

if($status!=''){
	
	$edit = mysql_query("UPDATE gosaloon_appointment SET work_status='$status' WHERE id='".$appointment_id."'");
	
	if($edit){
		
		echo "1";
		
		$details = mysql_fetch_array(mysql_query("SELECT * FROM gosaloon_appointment goa , gosaloon_customer goc WHERE goa.customer_id=goc.id AND goa.id='".$appointment_id."'"));
		
		$customer_name = $details['fname'].' '.$details['lname'];
		$customer_mobile = $details['mobile_no'];
		$date = $details['appointment_date'];					
		$time = $details['appointment_time'];					
		$time_status = $details['appointment_time_status'];					
		$appointment_no = $details['appointment_no'];
		
		if($time_status=='Morning'){
			$t_status="AM";
		}else{
			$t_status="PM";
		}
		
		$sms_customer = $date.' At '.$time.' '.$t_status.' In '.$shop_name.' Your Appointment No Is '.$appointment_no;
		
		
		
		if($status=='2'){
			
			$sms_cutomer = "Dear $customer_name, Welcome to GoSalon .Your Services Has Been Completed For $sms_customer. </br> Regard Go Salon Team.";
			
			$to_mobile=$customer_mobile;   // $customer_contact_no;
		    $post_values = array(    								
							"uname"      => constant('SMS_UName'),								
							"pwd"        => constant('SMS_UPass'),							
							"msg"        => $sms_cutomer,								
							"to"         => $to_mobile,								
							"senderid"   => constant('SMS_USenderid'),								
							"route"      => constant('SMS_URoute'),						
							);								
			$post_results = customer_completed_message($post_values); 

        }else if ($status=='3'){

		    $sms_cutomer = "Dear $customer_name, Welcome to GoSalon .Your Services Has Been Cancel For $sms_customer. </br> Regard Go Salon Team.";
			
			$to_mobile=$customer_mobile;   // $customer_contact_no;
		    $post_values = array(    								
							"uname"      => constant('SMS_UName'),								
							"pwd"        => constant('SMS_UPass'),							
							"msg"        => $sms_cutomer,								
							"to"         => $to_mobile,								
							"senderid"   => constant('SMS_USenderid'),								
							"route"      => constant('SMS_URoute'),						
							);								
			$post_results = customer_completed_message($post_values); 
		 
		}
		
		
	}else{
		
		echo "0";
		
	}
	
}else{
	
	echo "2";
	
}


function customer_completed_message($post_values) 							
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

?>