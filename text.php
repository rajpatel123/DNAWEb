<?php
require_once("lib/database.php");

	// SMS Integration
                            $name = "Anil Kumar";						   
						    $mobiles = $row->mobile_no;
							
							$sms_login = "Dear $name, Welcome KCJewellers . Cron Job Testing";		
						 
							$to_mobile="9131974355";   // $customer_contact_no;	
							
								
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
?>

