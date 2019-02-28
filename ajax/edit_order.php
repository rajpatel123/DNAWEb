<?php
include("../lib/database.php");
include("../lib/function.php");


$order_id = $_POST['aid'];
$ptype = $_POST['ptype'];
$status = $_POST['status'];
$date = date("Y-m-d");

//print_r($_POST);die;
if($status!=''){
	
	if($ptype==2 && $status==1){
	  $edit = mysql_query("UPDATE `order` SET delivery_status='$status' WHERE order_id='".$order_id."'");
	}else if($ptype==1 && $status==1){
	  $edit = mysql_query("UPDATE `order` SET delivery_status='$status',payment_date='$date',payment_status='1' WHERE order_id='".$order_id."'");
	}
	
	if($edit){
		
		echo "1";
		
		$details = mysql_fetch_array(mysql_query("SELECT * FROM order o , customer c WHERE o.customer_id=c.id AND o.order_id='".$order_id."'"));
		
		$customer_name = $details['fname'].' '.$details['lname'];
		$customer_mobile = $details['mobile_no'];
		
		$sms_customer = "Dear $customer_name , Welcome to KCJewellers. your order no : $order_id has been placed successfully, thank you.";
		
			
			$to_mobile=$customer_mobile;   // $customer_contact_no;
		    $post_values = array(    								
							"uname"      => constant('SMS_UName'),								
							"pwd"        => constant('SMS_UPass'),							
							"msg"        => $sms_customer,								
							"to"         => $to_mobile,								
							"senderid"   => constant('SMS_USenderid'),								
							"route"      => constant('SMS_URoute'),						
							);								
			$post_results = customer_completed_message($post_values); 
		
		
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