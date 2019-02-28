<?php 
error_reporting(0);
@ob_end_flush();
@ob_flush();
require("../phpmailer/class.phpmailer.php"); 
include_once("database.php");

$site_path="http://kcjewellers.co.in/admin/";
if(isset($_REQUEST['req']) && !empty($_REQUEST['req']))
{
	
	$ServerRequest=$_REQUEST['req'];
	
	//$data=date('Y-m-d h:i:s')."##".$_REQUEST['req']."\n";
	$data=date('Y-m-d h:i:s')."##".$_REQUEST['req']."##".$_REQUEST['user']."##".$_REQUEST['pass']."\n";
	$data.=$_REQUEST."\n";
    $myfile = fopen("log-file.txt", "a") or die("Unable to open file!");
    $txt = $data;
    fwrite($myfile, $txt);

    fclose($myfile);

}
else
{
	$data['status']="404";
	
	echo json_encode($data);
}


    switch ($ServerRequest)
	{
	    
	    case "category":  // Category 
        Category($conn);
        break;
        
        case "allfile":  // File 
        AllFile($conn);
        break;
        
        case "subcategory":  // Sub Category 
        SubCategory($conn);
        break;
	    
	    case "registration":  // Customer Registration 
        UserRegistration($conn);
        break;
		
		case "login":   // Customer Login
        UserLogin($conn);
        break;
        
        case "facebook":   // Facebook Login
        Facebook($conn);
        break;
        
        case "test":   // Test
        Test($conn);
        break;
        
        case "question":   // Question
        Question($conn);
        break;
        
        case "final_test":   // Final Test
        FinalTest($conn);
        break;
        
        case "result":   // Test Result
        Result($conn);
        break;
        
        case "showresult":   // Test Result Show
        ShowResult($conn);
        break;
		
		case "mobileverify": 
        MobileVerify($conn);
        break;
		
		case "fpassword":   // Customer Forgot Password
        ForgotPassword($conn);
        break;
		
		case "cpassword":   // Customer Change Password
        ChangePassword($conn);
        break;
		
		case "profileupdate":  // Customer Profile Update
		ProfileUpdate($conn);
		break;
		
		case "profilepic":    // Customer Profile Pic Updtae
		ProfilePic($conn);
		break;
		
		case "allcat":    // All Category List
		AllCategory($conn);
		break;
		 
		case "home":  // Home 
        Display($conn);
        break; 	

        
        break;
		
		/*=========================*/
	
		
		default:
		errorpage();
		break;
		
	}
	
	function Category($conn){
		
		$json_response = [];
		
		$all="SELECT * FROM category WHERE status='1'";
		$result = $conn->query($all);
		
		if($result->num_rows>0){
			
		while ($row = $result->fetch_object()) 
		{
		$array_data = [];
		$array_sub = [];
		$array_sub_data = [];
		
			$array_data['cat_id'] = $row->id;
			$array_data['cat_name'] = $row->category_name;
			  
			  $sub_cat = $conn->query("SELECT * FROM sub_category WHERE cat_id='".$row->id."' AND status='1'");
			  while ($subCat = $sub_cat->fetch_object()) 
	          {	
		   
		         $array_sub_child = [];
		         $array_sub_child_data = []; 
				 
                $array_sub['sub_cat_id']=$subCat->id;
                $array_sub['sub_cat_name']=$subCat->sub_cat_name;
               
			      $sub_child_cat = $conn->query("SELECT * FROM sub_child_category WHERE cat_id='".$row->id."' AND sub_cat_id='".$subCat->id."' AND status='1'");
			      while ($subChildCat = $sub_child_cat->fetch_object()) 
	              {
					$array_sub_child['id']=$subChildCat->id;  
					$array_sub_child['sub_child_name']=$subChildCat->sub_child_name; 
                    array_push($array_sub_child_data,$array_sub_child);					
				  }
			      
				   $array_sub['sub_sub_child']=$array_sub_child_data;
				   
		        array_push($array_sub_data,$array_sub);
				
			  }
			 
			$array_data['sub_cat'] = $array_sub_data;
			                    
			array_push($json_response,$array_data);
		}
		
		    $data['status']="1"; 
			$data['message']="Successfully";
			$data['details']=$json_response; 
			 
			echo json_encode($data);
		}else{
			
			$data['status']="0"; 
			$data['message']="No Data Found !!"; 
			echo json_encode($data);
		}
		
	}
	
	function AllFile($conn){
		
		$json_fresponse = [];
		$json_presponse = [];
		$id=$_REQUEST['sub_child_cat'];
		$file_type=$_REQUEST['file_type'];
		
		if($id!='' && $file_type!=''){
		
		$sub_child_cat = "SELECT * FROM video_pdf WHERE  sub_child_cat='".$id."' AND file_type='".$file_type."' and status='1'";
		$results = $conn->query($sub_child_cat);
		if($results->num_rows>0){
		
		while ($row = $results->fetch_object()) 
		{
		    if($row->type==1){
		      $base_url="http://".$_SERVER['SERVER_NAME'];
		      $array_data['id']=$row->id;  
			  $array_data['title']=$row->title;
			  $array_data['sub_title']=$row->sub_title;
			  $array_data['description']=$row->desc;
			  $array_data['url'] = $base_url.'/demo/education/img/file/'.$row->file;
			  array_push($json_fresponse,$array_data);
		    }else{
		      $base_url="http://".$_SERVER['SERVER_NAME'];
		      $array_datas['id']=$row->id;  
			  $array_datas['title']=$row->title;
			  $array_datas['sub_title']=$row->sub_title;
			  $array_datas['description']=$row->desc;
			  $array_datas['url'] = $base_url.'/demo/education/img/file/'.$row->file;
			  array_push($json_presponse,$array_datas);  
		    }
		}
		
		    $data['status']="1"; 
			$data['message']="Successfully";
			$data['free']=$json_fresponse;
			$data['Price']=$json_presponse;
			 
			echo json_encode($data);
		}else{
			
			$data['status']="0"; 
			$data['message']="No Data Found !!"; 
			echo json_encode($data);
		}
		
		}else{
		    
		    $data['status']="0"; 
			$data['message']="First Click Sub Child Category Tab !!"; 
			echo json_encode($data);
		}
		
	}
	
	function SubCategory($conn){
		
		$json_response = [];
		$sub_cat=$_REQUEST['sub_cat'];
		
		if($sub_cat!=''){
		
		$sub_child_cat = "SELECT * FROM sub_child_category WHERE  sub_cat_id='".$sub_cat."' AND status='1'";
		$results = $conn->query($sub_child_cat);
		//echo $results->num_rows;die;
		if($results->num_rows>0){
		
		while ($row = $results->fetch_object()) 
		{
		      $array_data['id']=$row->id;  
			  $array_data['sub_child_name']=$row->sub_child_name; 
                    
			                    
			array_push($json_response,$array_data);
		}
		
		    $data['status']="1"; 
			$data['message']="Successfully";
			$data['details']=$json_response; 
			 
			echo json_encode($data);
		}else{
			
			$data['status']="0"; 
			$data['message']="No Data Found !!"; 
			echo json_encode($data);
		}
		
		}else{
		    
		    $data['status']="0"; 
			$data['message']="First select sub category !!"; 
			echo json_encode($data);
		}
		
	}
	
	
	
	function UserRegistration($conn){ // Customer Registration
	     
		$name=$_REQUEST['name'];
		$username=$_REQUEST['username'];
		$email_id=$_REQUEST['email_id'];
		$password=$_REQUEST['password'];
		
		if($name=="" || $username=="" || $email_id=="" || $password=="")
		{
			$data['status']="3";
			$data["message"] = "Please Enter All Field Data !!";
			echo json_encode($data);
			
		}else{
			
			$check="SELECT * FROM customer WHERE email_id='".$email_id."'";
			$result = $conn->query($check);
			if($result->num_rows>0){
			
				$data['status']="2";
				$data["message"] = "This Email-Id Already Registration.Please Login!!";
				echo json_encode($data);
				
			}
			else
			{
				$check_mobile="SELECT * FROM customer WHERE username='".username."'";
			    $resultMobile = $conn->query($check_mobile);
				if($resultMobile->num_rows>0){
					
					$data['status']="4";
				    $data["message"] = "This Username Already Registration.Please Login !!";
				    echo json_encode($data);
					
				}else{
					
					$Insert="INSERT INTO customer SET name='$name',username='$username', email_id='$email_id',password='$password',status ='1',created_on =now()";
					$InsertData=$conn->query($Insert);
					//$insert_id=$conn->insert_id;
					
					if($InsertData)
					{
					
							$data['status']="1";
							$data['message']="Registration Successfully.Please Login";
							echo json_encode($data);
							
					}
					else
					{
						
						$data['status']="0";
						$data["message"] = "Something Went Wrong.Please try Again !!";
						echo json_encode($data);
						
					}
				}	
			}
		
		}
		
	}
	
	function UserLogin($conn){ // Customer Login
	
	    $json_response = [];
		$email_id = $_REQUEST['email_id']; 
		$password = $_REQUEST['password']; 
		if($email_id!='' && $password!=''){
			$sql1 = "SELECT * FROM customer WHERE (email_id='".$email_id."' or username='".$email_id."') AND password='".$password."'";
			$result = $conn->query($sql1);
			if($result->num_rows>0){
				 $row=$result->fetch_object();
				 
				 if($row->status=='0'){
					$data["status"] = "3";  
				    $data["message"] = "Your Account Suspend Due To Same Resign.Please Contact DNA Administrator !!";
				    echo json_encode($data);
				 
				 }else{
					 
					 $array_post['id']=$row->id;
					 $array_post['name']=$row->name;
					 $array_post['username']=$row->username;
					 $array_post['email_id']=$row->email_id;
					
					 array_push($json_response,$array_post);
					 $data['status']="1";
					 $data['message']="Successfully";
					 $data['login details']=$json_response;
					 echo json_encode($data);
				 }
				 
			}else{
				$data["status"] = "0"; 
				$data["message"] = "Your Email-Id/Username No And Password is not correct !!";
				echo json_encode($data);
			}
		}else{
			 $data["status"] = "2";  
			 $data["message"] = "Please Enter Email-Id/Username No And Password !!";  
			 echo json_encode($data);
		}
	}
	
	function Facebook($conn){ // Facebook Registration
	     
		$name=$_REQUEST['name'];
		$email_id=$_REQUEST['email_id'];
		$fb=$_REQUEST['fb_id'];
		$json_response=[];
		if($name=="" || $email_id=="" || $fb=="")
		{
			$data['status']="3";
			$data["message"] = "Please Enter All Field Data !!";
			echo json_encode($data);
			
		}else{
			
			$check="SELECT * FROM customer WHERE fb_id='".$fb."'";
			$result = $conn->query($check);
			if($result->num_rows>0){
			    
			    $row=$result->fetch_object();
			
				 $array_post['id']=$row->id;
    			 $array_post['name']=$row->name;
    			 $array_post['username']=$row->username;
    			 $array_post['email_id']=$row->email_id;
    			
    			 array_push($json_response,$array_post);
    			 $data['status']="1";
    			 $data['message']="Successfully";
    			 $data['login details']=$json_response;
    			 echo json_encode($data);
    		
				
			}
			else
			{
			    $Insert="INSERT INTO customer SET name='$name',username='$name', email_id='$email_id',fb_id='$fb',status ='1',created_on =now()";
					
					$InsertData=$conn->query($Insert);
					$insert_id=$conn->insert_id;
					
					if($InsertData)
					{
                        $array_post['id']=$insert_id;
                        $array_post['name']=$name;
                        $array_post['username']=$name;
                        $array_post['email_id']=$email_id;
                        
                        array_push($json_response,$array_post);
                        $data['status']="1";
                        $data['message']="Successfully";
                        $data['login details']=$json_response;
                        echo json_encode($data);
							
					}
					else
					{
						
						$data['status']="0";
						$data["message"] = "Something Went Wrong.Please try Again !!";
						echo json_encode($data);
						
					}
					
			}
		
		}
		
	}
	
	function Test($conn){
	    
	    $json_All = [];
		$json_Grand = [];
		$json_Mini = [];
		$json_Subject = [];
		
		$all="SELECT * FROM test WHERE status='1'";
		$resultall = $conn->query($all);
		if($resultall->num_rows>0){
			
		  while ($rowall = $resultall->fetch_object()) 
		  { 
		    $base_url="http://".$_SERVER['SERVER_NAME'];    
			$array_data['test_id'] = $rowall->id;
			$array_data['test_name'] = $rowall->name;
			$array_data['test_date'] = $rowall->date;
			$array_data['test_duration'] = $rowall->duration;
			$array_data['test_queation'] = $rowall->question;
			$array_data['test_category'] = $rowall->category;
			$array_data['test_paid'] = $rowall->paid;
			$array_data['test_image'] = $base_url."/demo/education/img/test/".$rowall->file;
			
			$test = $conn->query("SELECT * FROM final_result WHERE user_id='".$_REQUEST['user_id']."' and test_id='".$rowall->id."'");
			$array_data['test_status'] = "$test->num_rows";
			
			array_push($json_All,$array_data);
		  }
		  
		  $grands="SELECT * FROM test WHERE category='Grand Test' and status='1'";
		  $resultgrand = $conn->query($grands);
		  while ($grand = $resultgrand->fetch_object()) 
		  { 
		    $base_url="http://".$_SERVER['SERVER_NAME'];    
			$array_data['test_id'] = $grand->id;
			$array_data['test_name'] = $grand->name;
			$array_data['test_date'] = $grand->date;
			$array_data['test_duration'] = $grand->duration;
			$array_data['test_queation'] = $grand->question;
			$array_data['test_category'] = $grand->category;
			$array_data['test_paid'] = $grand->paid;
			$array_data['test_image'] = $base_url."/demo/education/img/test/".$grand->file;
			$test = $conn->query("SELECT * FROM final_result WHERE user_id='".$_REQUEST['user_id']."' and test_id='".$grand->id."'");
			$array_data['test_status'] = "$test->num_rows";
			
			array_push($json_Grand,$array_data);
		  }
		  
		  $minis="SELECT * FROM test WHERE category='Mini Test' and status='1'";
		  $resultmini = $conn->query($minis);
		  while ($mini = $resultmini->fetch_object()) 
		  { 
		    $base_url="http://".$_SERVER['SERVER_NAME'];    
			$array_data['test_id'] = $mini->id;
			$array_data['test_name'] = $mini->name;
			$array_data['test_date'] = $mini->date;
			$array_data['test_duration'] = $mini->duration;
			$array_data['test_queation'] = $mini->question;
			$array_data['test_category'] = $mini->category;
			$array_data['test_paid'] = $mini->paid;
			$array_data['test_image'] = $base_url."/demo/education/img/test/".$mini->file;
			
			$test = $conn->query("SELECT * FROM final_result WHERE user_id='".$_REQUEST['user_id']."' and test_id='".$mini->id."'");
			$array_data['test_status'] = "$test->num_rows";
			
			array_push($json_Mini,$array_data);
		  }
		  
		  $subjects="SELECT * FROM test WHERE category='Subject Wise Test' and status='1'";
		  $resultsubject = $conn->query($subjects);
		  while ($subject = $resultsubject->fetch_object()) 
		  { 
		    $base_url="http://".$_SERVER['SERVER_NAME'];    
			$array_data['test_id'] = $subject->id;
			$array_data['test_name'] = $subject->name;
			$array_data['test_date'] = $subject->date;
			$array_data['test_duration'] = $subject->duration;
			$array_data['test_queation'] = $subject->question;
			$array_data['test_category'] = $subject->category;
			$array_data['test_paid'] = $subject->paid;
			$array_data['test_image'] = $base_url."/demo/education/img/test/".$subject->file;
			
			$test = $conn->query("SELECT * FROM final_result WHERE user_id='".$_REQUEST['user_id']."' and test_id='".$subject->id."'");
			$array_data['test_status'] = "$test->num_rows";
			
			array_push($json_Subject,$array_data);
		  }
		  
		  $data['status']="1"; 
		  $data['message']="Successfully";
		  $data['All_Test']=$json_All; 
		  $data['Grand_Test']=$json_Grand;
		  $data['Mini_Test']=$json_Mini;
		  $data['Subject_Test']=$json_Subject;
		  echo json_encode($data);
		  
		}else{
			
			$data['status']="0"; 
			$data['message']="No Data Found !!"; 
			echo json_encode($data);
			
		}
	    
	}
	
	function Question($conn){
	    
	    $test = $_REQUEST['test_id'];
		$json_responce=[];
		if($test!=''){
		    
		    $CheckExit = $conn->query("SELECT * FROM test_question WHERE test_id='".$test."'");
			if($CheckExit->num_rows>0){
			    
			while($row=$CheckExit->fetch_object()){
			    
			$array_data['qid'] = $row->id;
			$array_data['question'] = $row->question;
			$array_data['answer1'] = $row->ans1;
			$array_data['answer2'] = $row->ans2;
			$array_data['answer3'] = $row->ans3;
			$array_data['answer4'] = $row->ans4;
			$array_data['currect_answer'] = $row->currect_ans;
			array_push($json_responce,$array_data);        
			        
			}
			    
			$data['status']="1"; 
		    $data['message']="Successfully";
		    $data['detail']=$json_responce;
		    echo json_encode($data);
			    
			}else{
			$data['status']="2"; 
			$data['message']="No Question Availbale In This Test !!"; 
			echo json_encode($data);
			}
		    
		}else{
		    $data['status']="0"; 
			$data['message']="First Select Any One Test !!"; 
			echo json_encode($data);
		}
	    
	}
	
	function FinalTest($conn){
	    $user_id = $_REQUEST['user_id'];
	    $test_id = $_REQUEST['test_id'];
	    $tquestion = $_REQUEST['tquestion'];
	    $canswer = $_REQUEST['canswer'];
	    $wanswer = $_REQUEST['wanswer'];
	    $sanswer = $_REQUEST['sanswer'];
	    
	    if($user_id!='' && $test_id!='' && $tquestion!=''){
	        $insertData = $conn->query("INSERT INTO final_result SET user_id='$user_id',test_id='$test_id',tquestion='$tquestion',canswer='$canswer',wanswer='$wanswer',sanswer='$sanswer',created_on=NOW()");
	        if($insertData){
	         $average = round(($canswer*100)/$tquestion);
	         $data['status']="1";
	         $data['average']="$average"; 
			 $data['message']="Test Submited Successfully !!"; 
			 echo json_encode($data);
	            
	        }else{
	         $data['status']="2"; 
			 $data['message']="Something Went Wrong.Please Try Again !!"; 
			 echo json_encode($data);
	        }
	        
	    }else{
	        $data['status']="0"; 
			$data['message']="Some Field Are Blank !!"; 
			echo json_encode($data);
	    }
	}
	
	function Result($conn){
	    $user_id = $_REQUEST['user_id'];
	    $test_id = $_REQUEST['test_id'];
	    $json_All = [];
	    $json_result = [];
	    
	    if($user_id!='' && $test_id!=''){
	        
	        $CheckExit = $conn->query("SELECT * FROM final_result WHERE test_id='".$test_id."' order by canswer DESC");
			if($CheckExit->num_rows>0){
			    
			    $Checkresult = $conn->query("SELECT * FROM final_result WHERE test_id='".$test_id."' and user_id='".$user_id."' order by canswer DESC");
			    $rows=$Checkresult->fetch_object();
			    $array_datas['total_question'] = $rows->tquestion;
			    $array_datas['current_question'] = $rows->canswer;
			    $array_datas['wrong_question'] = $rows->wanswer;
			    $array_datas['skip_question'] = $rows->sanswer;
			    $average = round(($canswer*100)/$tquestion);
			    $array_datas['average'] = "$average";
			    array_push($json_result,$array_datas);
			    
			    $sn=1;
			   while($row=$CheckExit->fetch_object()){
			       
			     $user = $conn->query("SELECT name,image FROM customer WHERE id='".$row->user_id."'");
			     $user_resulyt=$user->fetch_object();
			     $base_url="http://".$_SERVER['SERVER_NAME'];  
			     $rank = $sn++;
			     $array_data['rank'] = "$rank";
			     $array_data['url']=$base_url."/demo/education/img/customer/";
			     $array_data['user'] = $user_resulyt->name;
			     $array_data['image'] = $user_resulyt->image;
			     $array_data['total_question'] = $row->tquestion;
			     $array_data['current_question'] = $row->canswer;
			     $array_datas['wrong_question'] = $row->wanswer;
			     $array_data['skip_question'] = $row->sanswer;
			     
			    $rows=$Checkresult->fetch_object();
			    array_push($json_All,$array_data);
			   }
			   
			   $data['status']="1"; 
		       $data['message']="Successfully";
		       $data['User_Result']=$json_result;
		       $data['All_Reult']=$json_All;
		       echo json_encode($data);
			
			}else{
			 $data['status']="2"; 
			 $data['message']="No Result Available"; 
			 echo json_encode($data); 
			}
	        
	    }else{
	        $data['status']="0"; 
			$data['message']="Some Field Are Blank !!"; 
			echo json_encode($data);
	    }
	}
	
	function ShowResult($conn){
	    
	    $user_id = $_REQUEST['user_id'];
	    $test_id = $_REQUEST['test_id'];
	    $json_responce = [];
	    if($user_id!='' && $test_id!=''){
	        
	        $CheckExit = $conn->query("SELECT * FROM test_question WHERE test_id='".$test_id."'");
			if($CheckExit->num_rows>0){
			    
			while($row=$CheckExit->fetch_object()){
			    
			$array_data['qid'] = $row->id;
			$array_data['question'] = $row->question;
			$array_data['answer1'] = $row->ans1;
			$array_data['answer2'] = $row->ans2;
			$array_data['answer3'] = $row->ans3;
			$array_data['answer4'] = $row->ans4;
			$array_data['currect_answer'] = $row->currect_ans;
			array_push($json_responce,$array_data);        
			        
			}
			    
			$data['status']="1"; 
		    $data['message']="Successfully";
		    $data['detail']=$json_responce;
		    echo json_encode($data);
			    
			}else{
			    
			$data['status']="2"; 
			$data['message']="No Question Availbale In This Test !!"; 
			echo json_encode($data);    
			    
			}
			
	    }else{
	        $data['status']="0"; 
			$data['message']="Some Field Are Blank !!"; 
			echo json_encode($data);
	    }
	    
	}
	
	function ForgotPassword($conn){ //Customer Forgot Password
		
		$mobile = $_REQUEST['mobile_no'];
		
		if($mobile!=''){
			
			$CheckExit = $conn->query("SELECT * FROM customer WHERE mobile_no='".$mobile."'");
			if($CheckExit->num_rows>0){
				
				$row=$CheckExit->fetch_object();
				
				$password = mt_rand(111111,999999); 
				$pass = md5($password);
				$Update = $conn->query("UPDATE customer SET password='$pass' WHERE id='".$row->id."'");
				
				// SMS Integration
                            $name = $row->fname.' '.$row->lname;						   
						    $mobiles = $row->mobile_no;
							
							$sms_login = "Dear $name, Welcome KCJewellers .Your password : $password </br> Regard KCJewellers.";		
						 
							$to_mobile=$mobiles;   // $customer_contact_no;	
							
								
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
				
				
				        $data["status"] = "1";
						$data["message"] = "Password Send Successfully";
				        echo json_encode($data);
				
				
				
			}else{
				
				$data['status']="0"; 
		        $data['message']="This Mobile No Not Register !!"; 
		        echo json_encode($data);
				
			}
			
			
		}else{
			
			$data['status']="2"; 
		    $data['message']="Mobile No Is blank !!"; 
		    echo json_encode($data);
			
		}
		
	}
	
	function ChangePassword($conn){    //Customer Change Update
	
         $cid=$_REQUEST['customer_id'];
         $old=$_REQUEST['oldpass'];
         $old1=md5($old);
         $new=$_REQUEST['newpass'];
         $new1=md5($new);
		 
		 if($cid!='' && $old!='' && $new!=''){
			 
			 $CheckExit = $conn->query("SELECT * FROM customer WHERE id='".$cid."' AND password='".$old1."'");
			 if($CheckExit->num_rows>0){
				 
                $update = $conn->query("UPDATE customer SET password='$new1' WHERE id='".$cid."'");
				
				if($update){

                    $data['status']="1";
				    $data['message']="Successfully.";
				    echo json_encode($data);
				
				}else{
				    
					$data['status']="0";
				    $data['message']="Something Went Wrong.Please try Again !!";
				    echo json_encode($data);
				}
				 
			 }else{
				 
				$data['status']="2"; 
				//$data['query'] = "SELECT * FROM customer WHERE id='".$cid."' AND password='".$old1."'";
		        $data['message']="Old Password Is Not Correct!!"; 
		        echo json_encode($data); 
				 
			 }
			 
			 
		 }else{
			 
			$data['status']="3"; 
		    $data['message']="Some Field Are blank!!"; 
		    echo json_encode($data);
			 
		 }
		
	}
	
	function ProfileUpdate($conn){ //Customer Profile Update
	
	     $customer_id=$_REQUEST['customer_id'];
		 $json_response = [];
		 
		 
		 if($customer_id!=""){
			 
			 $old_data = $conn->query("SELECT * FROM customer WHERE id='".$_REQUEST['customer_id']."'");
			 $result = $old_data->fetch_object();
			 
			 if(!empty($_REQUEST['fname'])){
		       $fname=$_REQUEST['fname'];
			 }
		      else {
			   $fname=$result->fname;
		     }
			 
			 if(!empty($_REQUEST['lname'])){
		       $lname=$_REQUEST['lname'];
			 }
		      else {
			   $lname=$result->lname;
		     }
			 
			 if(!empty($_REQUEST['email_id'])){
		       $email_id=$_REQUEST['email_id'];
			 }
		      else {
			   $email_id=$result->email_id;
		     }
			 
			 if(!empty($_REQUEST['mobile_no'])){
		       $mobile=$_REQUEST['mobile_no'];
			 }
		      else {
			   $mobile=$result->mobile_no;
		     }
			 
			$updateData = $conn->query("UPDATE customer SET fname='$fname',lname='$lname',email_id='$email_id',mobile_no='$mobile' WHERE id='".$_REQUEST['customer_id']."'");
			if($updateData){
				
				 $base_url="http://".$_SERVER['SERVER_NAME'];
				 $array_post['id']=$result->id;
				 $array_post['first_name']=$fname;
				 $array_post['last_name']=$lname;
				 $array_post['email_id']=$email_id;
				 $array_post['mobile_no']=$mobile;
				 $array_post['image_url'] = $base_url.'/admin/img/customer/';
				 $array_post['image']=$result->image;
				 
				 array_push($json_response,$array_post);
				 $data['status']="1";
				 $data['message']="Successfully";
				 $data['update details']=$json_response;
				 echo json_encode($data);
				
			}else{
				
				$data['status']="0";
				$data['message']="Something Went Wrong.Please try Again !!";
				echo json_encode($data);
				
			}
			 
			 
		 }else{
			 
			$data['status']="2"; 
		    $data['message']="Customer Id Is blank !!"; 
		    echo json_encode($data);
			
		 }
		
		
	}
	
	function ProfilePic($conn){ // Customer Profile Pic
		
		$customer_id=$_REQUEST['customer_id'];
		$json_response = [];
		
	    if($customer_id!=''){
			
			if(!empty($_FILES['file']['name'])){
			$file_path = "../img/customer/";
			$image_file = time().basename($_FILES['file']['name']);
			$file_paths = $file_path.$image_file;
			move_uploaded_file($_FILES['file']['tmp_name'], $file_paths);
			
			    $updateData = $conn->query("UPDATE customer SET image='$image_file' WHERE id='".$_REQUEST['customer_id']."'");
				
			    if($updateData){
					
					$base_url="http://".$_SERVER['SERVER_NAME'];
					$array_post['image_url'] = $base_url.'/admin/img/customer/';
				    $array_post['image']=$image_file;
				 
				    array_push($json_response,$array_post);
					
					$data['status']="1";
				    $data['message']="Successfully";
					$data['update details']=$json_response;
				    echo json_encode($data);
					
				}else{
					
					$data['status']="0";
				    $data['message']="Something Went Wrong.Please try Again !!";
				    echo json_encode($data);
					
				}
				
			}else{
				$data['status']="2";
				$data['message']="Please select Image First.";
				echo json_encode($data);
			}
			
		}else{
			 
			$data['status']="3"; 
		    $data['message']="Customer Id Is blank !!"; 
		    echo json_encode($data);
			
		 }
		
		
	}

	
	
	
	function AllCategory($conn){
		
		$json_response = [];
		
		$all="SELECT * FROM category WHERE status='1'";
		$result = $conn->query($all);
		
		if($result->num_rows>0){
			
		while ($row = $result->fetch_object()) 
		{
		$array_data = [];
		$array_sub = [];
		$array_sub_data = [];
		
			$array_data['cat_id'] = $row->id;
			$array_data['cat_name'] = $row->category_name;
			  
			  $sub_cat = $conn->query("SELECT * FROM sub_category WHERE cat_id='".$row->id."' AND status='1'");
			  while ($subCat = $sub_cat->fetch_object()) 
	          {	
		   
		         $array_sub_child = [];
		         $array_sub_child_data = []; 
				 
                $array_sub['sub_cat_id']=$subCat->id;
                $array_sub['sub_cat_name']=$subCat->sub_cat_name;
               
			      $sub_child_cat = $conn->query("SELECT * FROM sub_child_category WHERE cat_id='".$row->id."' AND sub_cat_id='".$subCat->id."' AND status='1'");
			      while ($subChildCat = $sub_child_cat->fetch_object()) 
	              {
					$array_sub_child['id']=$subChildCat->id;  
					$array_sub_child['sub_child_name']=$subChildCat->sub_child_name; 
                    array_push($array_sub_child_data,$array_sub_child);					
				  }
			      
				   $array_sub['sub_sub_child']=$array_sub_child_data;
				   
		        array_push($array_sub_data,$array_sub);
				
			  }
			 
			$array_data['sub_cat'] = $array_sub_data;
			                    
			array_push($json_response,$array_data);
		}
		
		    $data['status']="1"; 
			$data['message']="Successfully";
			$data['details']=$json_response; 
			 
			echo json_encode($data);
		}else{
			
			$data['status']="0"; 
			$data['message']="No Data Found !!"; 
			echo json_encode($data);
		}
		
	}
	
	
	function Display($conn){
		
		$json_response = [];
		$jsonResponses = [];
		$JsonArray = [];
		
		$all="SELECT * FROM category WHERE status='1'";
		$result = $conn->query($all);
		
		  
		if($result->num_rows>0){
			
		  while ($row = $result->fetch_object()) 
		  {
			$array_data['cat_id'] = $row->id;
			$array_data['cat_name'] = $row->category_name;
			$array_data['cat_image'] = URL."img/category/".$row->category_image;
			array_push($json_response,$array_data);
		  }
		  
		  $banner = $conn->query("SELECT * FROM banner");
          while($banner_data = $banner->fetch_object()){
				
				$array_datas['image'] = URL."/img/banner/".$banner_data->image;
				array_push($JsonArray,$array_datas);
		  }
		  
		  //$top_5 = $conn->query("SELECT product_id FROM `order` GROUP BY product_id ORDER BY SUM(quantity) DESC LIMIT 5");
		  $top_5 = $conn->query("SELECT * FROM `order` GROUP BY product_id ORDER BY SUM(quantity) DESC LIMIT 5");
		  $array_datass = array();
		    if($top_5->num_rows > 0){
			  
			  
		        while($top_5_product = $top_5->fetch_object()){
					$array_datass['product_id'] = $top_5_product->product_id;
					$product = $conn->query("SELECT * FROM product WHERE id='".$top_5_product->product_id."' AND status='1'");
					$productDetail=$product->fetch_object();
					$array_datass['product_image'] = URL."img/product/".$productDetail->product_image;
					array_push($jsonResponses,$array_datass);
                }
				
		    }else{
			  
				$array_datass['name'] = "Anil Kumar";
				array_push($JsonResponse,$array_datass);
				
		    }
		
		  $data['status']="1"; 
		  $data['message']="Successfully";
		  $data['details']=$json_response; 
		  $data['top_5_product']=$jsonResponses; 
		  $data['banner']=$JsonArray; 
		  echo json_encode($data);
		  
		}else{
			
			$data['status']="0"; 
			$data['message']="No Data Found !!"; 
			echo json_encode($data);
			
		}
		
	}
	
	function Product($conn){
		
		$json_response = [];
		
		$customer_id=$_REQUEST['customer_id']; 
		$cat_id=$_REQUEST['cat_id']; 
		$sub_cat_id=$_REQUEST['sub_cat_id'];
		$sub_child_cat_id=$_REQUEST['sub_child_cat_id'];
		
		//if($cat_id!="" && $sub_cat_id!="" && $sub_child_cat_id!=""){
		if($sub_child_cat_id!=""){
			
			//$product = $conn->query("SELECT * FROM product WHERE cat_id='".$cat_id."' AND sub_cat_id='".$sub_cat_id."' AND sub_child_cat_id='".$sub_child_cat_id."' AND status='1'");
			$product = $conn->query("SELECT * FROM product WHERE sub_child_cat_id='".$sub_child_cat_id."' AND status='1'");
			if($product->num_rows > 0){
				
				$array_data = [];
				
				while($productDetail=$product->fetch_object()){
					
					$array_data['p_id'] = $productDetail->id;
					$array_data['p_name'] = $productDetail->product_name;
					$array_data['p_image'] = URL."img/product/".$productDetail->product_image;
					$array_data['p_price'] = $productDetail->product_price;
					$array_data['p_sprice'] = $productDetail->product_sprice;
					$array_data['p_color'] = $productDetail->color;
			        $array_data['p_size'] = $productDetail->size;
					$array_data['p_stock'] = "1";
					
					
					if($customer_id!=""){
					$wish = $conn->query("SELECT * FROM wishlist WHERE product_id='".$productDetail->id."' AND customer_id='".$_REQUEST['customer_id']."'");
					$wishList = $wish->fetch_object();
					   if($wishList==null){
				            $array_data['wishlist'] = '0';
			           }else{
						   $array_data['wishlist'] = $wishList->status;
					   }
					
					}else{
					$array_data['wishlist'] = "";
					}
					
					array_push($json_response,$array_data);
				}
				
				$data['status']="1"; 
		        $data['message']="Successfully";
		        $data['p_details']=$json_response; 
		        echo json_encode($data);
				
			}else{
				
				$data['status']="0";
			    $data['message']="No Product Found !!"; 
			    echo json_encode($data);
			}
			
			
		//}else if($cat_id!="" && $sub_cat_id!=""){
		}else if($sub_cat_id!=""){
			
			//$product = $conn->query("SELECT * FROM product WHERE cat_id='".$cat_id."' and sub_cat_id='".$sub_cat_id."' and status='1'");
			$product = $conn->query("SELECT * FROM product WHERE sub_cat_id='".$sub_cat_id."' and status='1'");
			if($product->num_rows > 0){
				
				$array_data = [];
				
				while($productDetail=$product->fetch_object()){
					
					$array_data['p_id'] = $productDetail->id;
					$array_data['p_name'] = $productDetail->product_name;
					$array_data['p_image'] = URL."img/product/".$productDetail->product_image;
					$array_data['p_price'] = $productDetail->product_price;
					$array_data['p_sprice'] = $productDetail->product_sprice;
					$array_data['p_color'] = $productDetail->color;
			        $array_data['p_size'] = $productDetail->size;
					$array_data['p_stock'] = "1";
					
					if($customer_id!=""){
					$wish = $conn->query("SELECT * FROM wishlist WHERE product_id='".$productDetail->id."' AND customer_id='".$_REQUEST['customer_id']."'");
					$wishList = $wish->fetch_object();
					   if($wishList==null){
				            $array_data['wishlist'] = '0';
			           }else{
						   $array_data['wishlist'] = $wishList->status;
					   }
					
					}else{
					$array_data['wishlist'] = "";
					}
					
					array_push($json_response,$array_data);
				}
				
				$data['status']="1"; 
		        $data['message']="Successfully";
		        $data['p_details']=$json_response; 
		        echo json_encode($data);
				
			}else{
				
				$data['status']="0";
			    $data['message']="No Product Found !!"; 
			    echo json_encode($data);
			}
			
			
		}else if($cat_id!=""){
			
			$product = $conn->query("SELECT * FROM product WHERE cat_id='".$cat_id."' and status='1'");
			if($product->num_rows > 0){
				
				$array_data = [];
				
				while($productDetail=$product->fetch_object()){
					
					$array_data['p_id'] = $productDetail->id;
					$array_data['p_name'] = $productDetail->product_name;
					$array_data['p_image'] = URL."img/product/".$productDetail->product_image;
					$array_data['p_price'] = $productDetail->product_price;
					$array_data['p_sprice'] = $productDetail->product_sprice;
					$array_data['p_color'] = $productDetail->color;
			        $array_data['p_size'] = $productDetail->size;
			        $array_data['p_stock'] = "1";
					
					if($customer_id!=""){
					$wish = $conn->query("SELECT * FROM wishlist WHERE product_id='".$productDetail->id."' AND customer_id='".$_REQUEST['customer_id']."'");
					$wishList = $wish->fetch_object();
					   if($wishList==null){
				            $array_data['wishlist'] = '0';
			           }else{
						   $array_data['wishlist'] = $wishList->status;
					   }
					
					}else{
					$array_data['wishlist'] = "";
					}
					
					array_push($json_response,$array_data);
				}
				
				$data['status']="1"; 
		        $data['message']="Successfully";
		        $data['p_details']=$json_response; 
		        echo json_encode($data);
				
			}else{
				
				$data['status']="0";
			    $data['message']="No Product Found !!"; 
			    echo json_encode($data);
			}
			
		}else{
			
			$data['status']="2"; 
			$data['message']="Select Any One Category !!"; 
			echo json_encode($data);
		}
	}
	
	function AllProduct($conn){
		
		$json_response = [];
		
		$customer_id=$_REQUEST['customer_id'];
		
		$product = $conn->query("SELECT * FROM product WHERE status='1' ORDER BY id DESC");
			if($product->num_rows > 0){
				
				$array_data = [];
				
				while($productDetail=$product->fetch_object()){
					
					$array_data['p_id'] = $productDetail->id;
					$array_data['p_name'] = $productDetail->product_name;
					$array_data['p_image'] = URL."img/product/".$productDetail->product_image;
					$array_data['p_price'] = $productDetail->product_price;
					$array_data['p_sprice'] = $productDetail->product_sprice;
					$array_data['p_color'] = $productDetail->color;
			        $array_data['p_size'] = $productDetail->size;
			        $array_data['p_stock'] = "1";
					
					if($customer_id!=""){
					$wish = $conn->query("SELECT * FROM wishlist WHERE product_id='".$productDetail->id."' AND customer_id='".$_REQUEST['customer_id']."'");
					$wishList = $wish->fetch_object();
					   if($wishList==null){
				            $array_data['wishlist'] = '0';
			           }else{
						   $array_data['wishlist'] = $wishList->status;
					   }
					
					}else{
					$array_data['wishlist'] = "";
					}
					
					array_push($json_response,$array_data);
				}
				
				$data['status']="1"; 
		        $data['message']="Successfully";
		        $data['p_details']=$json_response; 
		        echo json_encode($data);
				
			}else{
				
				$data['status']="0";
			    $data['message']="No Product Found !!"; 
			    echo json_encode($data);
			}
		
	}
	
	
	function SearchProduct($conn){ // Search Product Name Based 
	
		
		$search_data = $_REQUEST['key'];
		$json_response = [];
		
		if($search_data!=''){
			
			$CheckExit = $conn->query("SELECT * FROM product WHERE product_name like '%".$_REQUEST['key']."%'  AND status='1' ORDER BY id DESC");
			
			if($CheckExit->num_rows>0){
				    
				    while($productDetail = $CheckExit->fetch_object()){
					
					
					$array_data['p_id'] = $productDetail->id;
					$array_data['p_name'] = $productDetail->product_name;
					$array_data['p_image'] = URL."img/product/".$productDetail->product_image;
					$array_data['p_price'] = $productDetail->product_price;
					$array_data['p_sprice'] = $productDetail->product_sprice;
					$array_data['p_color'] = $productDetail->color;
			        $array_data['p_size'] = $productDetail->size;
			        $array_data['p_stock'] = "1";
					
					if($customer_id!=""){
					$wish = $conn->query("SELECT * FROM wishlist WHERE product_id='".$productDetail->id."' AND customer_id='".$_REQUEST['customer_id']."'");
					$wishList = $wish->fetch_object();
					   if($wishList==null){
				            $array_data['wishlist'] = '0';
			           }else{
						   $array_data['wishlist'] = $wishList->status;
					   }
					
					}else{
					$array_data['wishlist'] = "";
					}
					
					array_push($json_response,$array_data);  
					
				}
				
				    $data['status'] = "1";
					$data['message']="Successfully";
                    $data['product_details']=$json_response;					
					echo json_encode($data);
				
			}else{
				
				$data['status']="0"; 
		        $data['message']="No Data Available !!";
		        echo json_encode($data);
				
			}
			
		}else{
			
			$data['status']="2"; 
		    $data['message']="Key Is blank !!"; 
		    echo json_encode($data);
			
		}
	}
	
	function AddWishlist($conn){ // Customer Add Favorite Product
		
		$customer_id=$_REQUEST['customer_id'];
		$product_id=$_REQUEST['product_id'];
		if($customer_id!='' && $product_id!=''){
			
			$CheckExit=$conn->query("SELECT * FROM wishlist WHERE customer_id='$customer_id' AND product_id='$product_id'");
		    if($CheckExit ->num_rows > 0){
			        $row = $CheckExit->fetch_object();
					
						$Remove = $conn->query("DELETE FROM wishlist WHERE  id='".$row->id."'");
						if($Remove){
							
							$data['status']="2";
					        $data['message']="Remove Successfully";
			                echo json_encode($data);
							
						}else{
							
							$data['status']="0";
					        $data['message']="Something Went Wrong.Please try Again !!";
			                echo json_encode($data);
							
						}
						
					
			
		    }else{
				
				$insertFav = $conn->query("INSERT INTO wishlist SET customer_id='$customer_id',product_id='$product_id',status='1',created_on=Now()");
				
				if($insertFav){
					
					$data['status']="1";
					$data['message']="Added Successfully";
			        echo json_encode($data);
					
				}else{
					
					$data['status']="0";
					$data['message']="Something Went Wrong.Please try Again !!";
			        echo json_encode($data);
					
				}
				
			}
			
		}else{
			
		   $data['status']="3"; 
		   $data['message']="Product Id And Customer Id Is blank !!"; 
		   echo json_encode($data);
			
		}
		
	}
	
	function WishListing($conn){ // Customer Wish Listing
		
		$customer_id = $_REQUEST['customer_id'];
		$json_response = [];
		if($customer_id!=''){
			
			//$fav = "SELECT p.id,p.product_name,p.product_image,p.product_price,p.product_sprice FROM wishlist w , product p WHERE w.product_id=p.id AND w.customer_id='".$customer_id."' AND w.status='1'";
			$wish = "SELECT * FROM wishlist WHERE customer_id='".$customer_id."' AND status='1'";
			$result = $conn->query($wish);
			if($result->num_rows>0){
				
				while($row = $result->fetch_object()){
					
				$wish_r = $conn->query("SELECT * FROM product WHERE id='".$row->product_id."'");
				$wish_result = $wish_r->fetch_object();
				
				$array_data['p_id'] = $wish_result->id;
				$array_data['p_name'] = $wish_result->product_name;
				$array_data['p_image'] = URL."img/product/".$wish_result->product_image;
				$array_data['p_price'] = $wish_result->product_price;
				$array_data['p_sprice'] = $wish_result->product_sprice;
				$array_data['p_color'] = $wish_result->color;
			    $array_data['p_size'] = $wish_result->size;
				$array_data['p_stock'] = "1";
				
				array_push($json_response,$array_data);
				
				}
				$data['status']="1";
				$data['message']="Successfully"; 
				$data['wishlist_details']=$json_response;
				echo json_encode($data);
				
			}else{
				
				$data['status']="0"; 
			    $data['message']="No Data Available!!"; 
			    echo json_encode($data);
				
			}
			
		}else{
			
			$data['status']="2"; 
		    $data['message']="Customer Id Is blank !!"; 
		    echo json_encode($data);
			
				
		}
		
	}
	
	
	
	function productDetail($conn){
		
		$product_id = $_REQUEST['product_id'];
		$json_response = [];
		$someArray = [];
		$someArray1 = [];
		$jsonResponse = [];
		
		if($product_id!=''){
			
			$productdetail = $conn->query("SELECT * FROM product WHERE id='".$product_id."'");
			$productDetails = $productdetail->fetch_object();
			
			$productsdetail = $conn->query("SELECT * FROM product_image WHERE product_id='".$product_id."'");
			if($productsdetail->num_rows > 0){
				$sub_image = array();
			    while($productsDetails = $productsdetail->fetch_object()){
					$sub_image[]=$productsDetails->product_sub_image;
				}
			     $sub_image = implode(',', $sub_image);
			     
			    $array_data['product_image'] = $productDetails->product_image.','.$sub_image; 
			}else{
			   //$sub_image = "demo.jpg";
			   $array_data['product_image'] = $productDetails->product_image; 
			   
			}
			
			$array_data['product_id'] = $productDetails->id;
			$array_data['product_name'] = $productDetails->product_name;
			$array_data['product_image_url'] = URL."img/product/";
			$array_data['product_image'] = $productDetails->product_image.','.$sub_image;
			
			$productsdetail = $conn->query("SELECT * FROM product_image WHERE product_id='".$product_id."'");
			if($productsdetail->num_rows > 0){
				$sub_image = array();
			    while($productsDetails = $productsdetail->fetch_object()){
					$sub_image[]=$productsDetails->product_sub_image;
				}
			     $sub_image = implode(',', $sub_image);
			}else{
			   //$sub_image = "demo.jpg";	
			}
			
			$array_data['product_price'] = $productDetails->product_price;
			$array_data['product_sprice'] =$productDetails->product_sprice;
			$array_data['product_color'] = $productDetails->color;
			$array_data['product_size'] = $productDetails->size;
			$array_data['product_stock'] = "1";
			
			$array_data['product_specification'] = $productDetails->specification;
			$array_data['product_shiping'] = $productDetails->shipping;
			$array_data['product_return'] = $productDetails->returns;
			
			array_push($json_response,$array_data);
			
			 /*************RATING***********/
			$review = "SELECT * FROM review WHERE status='1' AND product_id='".$product_id."' ORDER BY created_on DESC";
			$result = $conn->query($review);
			
			// First Array
			$ratingss=$conn->query("select AVG(rating) AS rating from review where product_id='".$product_id."'");
			$product_rating =$ratingss->fetch_object(); 
			$ratings = $product_rating->rating;
				 
			if($ratings==null){
				$rating = '0.0';
			}else{
				$rating = $ratings;
			}
			$array_post1['avg_rating'] = $rating;
			$array_post1['total_rating'] = $result->num_rows;
			array_push($someArray,$array_post1); 

			// Second Array
			$ratings1=$conn->query("SELECT * FROM review WHERE product_id='".$product_id."' AND rating='1'");
			$rat1 = $ratings1->num_rows;
			$ratings2=$conn->query("SELECT * FROM review WHERE product_id='".$product_id."' AND rating='2'");
			$rat2 = $ratings2->num_rows;
			$ratings3=$conn->query("SELECT * FROM review WHERE product_id='".$product_id."' AND rating='3'");
		    $rat3 = $ratings3->num_rows;
			$ratings4=$conn->query("SELECT * FROM review WHERE product_id='".$product_id."' AND rating='4'");
			$rat4 = $ratings4->num_rows;
			$ratings5=$conn->query("SELECT * FROM review WHERE product_id='".$product_id."' AND rating='5'");
			$rat5 = $ratings5->num_rows;
				 
			$array_post2['rating1'] = $rat1;
			$array_post2['rating2'] = $rat2;
			$array_post2['rating3'] = $rat3;
			$array_post2['rating4'] = $rat4;
			$array_post2['rating5'] = $rat5;
		    array_push($someArray1,$array_post2);
			
			// Third array
			while($row = $result->fetch_object()){
				
			$date = date("m-d-Y");
			$name=$conn->query("SELECT * FROM customer WHERE id='".$row->customer_id."'");
			$customer_name = $name->fetch_object();
			$array_post['customer_name'] = $customer_name->fname.' '.$customer_name->lname;
			$array_post['rating'] = $row->rating;
			$array_post['review'] = $row->review;
			if($row->created_on == $date){
				$array_post['date'] = 'Today'; 
			}else{
			    $array_post['date'] = $row->created_on;
			}
			    array_push($jsonResponse,$array_post);
				
			}
			
			$data['status']="1"; 
		    $data['message']="Successfully"; 
		    $data['book_details']=$json_response;
			$data['overoll_rating']=$someArray;
			$data['seprate_rating']=$someArray1;
			$data['review_rating']=$jsonResponse;
		    echo json_encode($data);
			
		}else{
			
			$data['status']="0"; 
			$data['message']="Product Id Is Blank!!"; 
			echo json_encode($data);
			
		}
		
	}
	
	function AddCart($conn){
		
		$customer_id=$_REQUEST['customer_id'];
		$product_id=$_REQUEST['product_id'];
		$color=$_REQUEST['color_id'];
		$size=$_REQUEST['size_id'];
		
		if($customer_id!="" && $product_id!=""){
			
			$checkExit = $conn->query("SELECT * FROM cart WHERE customer_id='".$customer_id."' AND product_id='".$product_id."'");
			
			if($checkExit->num_rows > 0){
				
			  $data['status']="3"; 
		      $data['message']="You Have Already Added In This Product In Cart !!"; 
		      echo json_encode($data);
				
			}else{
				
				$insertData = $conn->query("INSERT INTO cart SET customer_id='$customer_id',product_id='$product_id',color='$color',size='$size',quantity='1',status='1',created_on=Now()");
			  
			  if($insertData){
				
				$data['status']="1"; 
		        $data['message']="Added Successfully";
		        echo json_encode($data);
				
			  }else{
				
				$data['status']="0"; 
		        $data['message']="Something Went Wrong.Please try again !!";
		        echo json_encode($data);
				
			  }
				
			}
			
		}else{
			
			$data['status']="2"; 
			$data['message']="Product Id And Customer Id Are Blank!!"; 
			echo json_encode($data);
			
		}
		
	}
	
	function CartListing($conn){  // Cart Listing
		
		$customer_id = $_REQUEST['customer_id'];
		$JsonArray = [];
		
		If($customer_id!=''){
			
			$Listing = $conn->query("SELECT * FROM cart WHERE customer_id='".$customer_id."'");
		    if($Listing->num_rows>0){
				
			  while($cart_data =$Listing->fetch_object()){
				
			   $product = $conn->query("SELECT * FROM product WHERE id='".$cart_data->product_id."'");
			   $product_result = $product->fetch_object();
			   
			    $array_data['cart_id']=$cart_data->id; 
			    $array_data['product_id']=$product_result->id; 
			    $array_data['product_name'] = $product_result->product_name;
				$array_data['product_image'] = URL."img/product/".$product_result->product_image;
				$array_data['product_price'] = $product_result->product_price;
				$array_data['product_sprice'] = $product_result->product_sprice;
				$array_data['product_quantity'] = $cart_data->quantity;
				$array_data['product_size'] = $cart_data->color;
				$array_data['product_color'] = $cart_data->size;
				$array_data['product_message'] = $cart_data->message;
			   
			   array_push($JsonArray,$array_data);
			  } 
				
			   $data['status']="1"; 
		       $data['message']="Successfully";
		       $data['listing']=$JsonArray;
		       echo json_encode($data);
				
			}else{

			   $data['status']="0"; 
		       $data['message']="No Data Available !!"; 
		       echo json_encode($data);

			}
			
		}else{
			
			$data['status']="2"; 
		    $data['message']="Customer Id Is Blank !!"; 
		    echo json_encode($data);
			
		}
		
	}
	
	
	function ChangeQuantity($conn){ 
	
      $cart_id = $_REQUEST['cart_id'];
      $quantity= $_REQUEST['quantity'];
      $message = $_REQUEST['message'];
	  
	  if($cart_id!='' && $quantity!=''){
		  
		     $update = $conn->query("UPDATE cart SET quantity='$quantity',message='$message' WHERE id='".$cart_id."'");
				
				 if($update){
				  
				  $data['status']="1"; 
		          $data['message']="Successfully"; 
				  $data['quantity']=$_REQUEST['quantity'];
				  $data['message']=$_REQUEST['message'];
		          echo json_encode($data);
				  
			     }else{
				  
				  $data['status']="0"; 
		          $data['message']="Something Went Wrong.Please try Again update!!";
		          echo json_encode($data);
				  
			     }
		  
	  }else{
		  
		    $data['status']="2"; 
		    $data['message']="Cart Id Is Blank !!"; 
		    echo json_encode($data);
		  
	  }
		
		
	}
	
	function RemoveCart($conn){ // Remove Book In Cart
		
		$customer_id = $_REQUEST['customer_id'];
		$cart_id = $_REQUEST['cart_id'];
	    
		if($customer_id!='' && $cart_id!=''){
			
			$Delete = $conn->query("DELETE FROM cart WHERE id='".$cart_id."' AND customer_id='$customer_id'");
			
			if($Delete){
				
				$data['status']="1"; 
		        $data['message']="Remove Successfully";
		        echo json_encode($data);
				
			}else{
				
				$data['status']="0"; 
		        $data['message']="Something Went Wrong.Please try again !!"; 
		        echo json_encode($data);
				
			}
			
		}else{
			
			$data['status']="2"; 
		    $data['message']="Customer Id And Cart Id Is Blank !!"; 
		    echo json_encode($data);
		
		}
		
	}
	
	
	function Address($conn){
		
		$customer_id = $_REQUEST['customer_id'];
		
		if($customer_id!=""){
			
			$name = $_REQUEST['name'];
			$country = $_REQUEST['country'];
			$state = $_REQUEST['state'];
			$city = $_REQUEST['city'];
			$pincode = $_REQUEST['pincode'];
			$line1 = $_REQUEST['line1'];
			$line2 = $_REQUEST['line2'];
			$phone = $_REQUEST['phone'];
			
			$checkExit = $conn->query("SELECT * FROM address WHERE customer_id='".$customer_id."'");
			if($checkExit->num_rows>0){
				
				$update = $conn->query("UPDATE address SET customer_id='$customer_id',name='$name',country='$country',state='$state',
				 city='$city',pincode='$pincode',line1='$line1',line2='$line2',phone='$phone' WHERE customer_id='".$customer_id."'");
				
				 if($update){
				  
				  $data['status']="1"; 
		          $data['message']="Update Successfully"; 
		          echo json_encode($data);
				  
			     }else{
				  
				  $data['status']="0"; 
		          $data['message']="Something Went Wrong.Please try Again update!!";
		          echo json_encode($data);
				  
			     }
				
			}else{
				
				 $insert = $conn->query("INSERT INTO address SET customer_id='$customer_id',name='$name',country='$country',state='$state',city='$city',pincode='$pincode',line1='$line1',line2='$line2',phone='$phone',status='1',created_on=Now()");

				 if($insert){
				  
				  $data['status']="1"; 
		          $data['message']="Added Successfully"; 
		          echo json_encode($data);
				  
			     }else{
				  
				  $data['status']="0"; 
		          $data['message']="Something Went Wrong.Please try Again !!";
		          $data['query']="INSERT INTO address SET customer_id='$customer_id',name='$name',country='$country',state='$state',city='$city',pincode='$pincode',line1='$line1',line2='$line2',phone='$phone',status='1',created_on=Now()";
		          echo json_encode($data);
				  
			     } 
			}
			
			
		}else{
			
			$data['status']="2"; 
		    $data['message']="Customer Id Is Blank !!"; 
		    echo json_encode($data);
			
		}
		
	}
	
	
	function AddressView($conn){
		
		$customer_id = $_REQUEST['customer_id'];
		
		$Json_responce = [];
		
		if($customer_id!=''){
			
			$checkExit = $conn->query("SELECT * FROM address WHERE customer_id='".$customer_id."'");
			if($checkExit->num_rows>0){
				$result = $checkExit->fetch_object();
				
				$array_data['name'] = $result->name; 
				$array_data['country'] = $result->country; 
				$array_data['state'] = $result->state; 
				$array_data['city'] = $result->city; 
				$array_data['pincode'] = $result->pincode; 
				$array_data['line1'] = $result->line1; 
				$array_data['line2'] = $result->line2; 
				$array_data['phone'] = $result->phone; 
				
				array_push($Json_responce,$array_data);
				
				$data['status']="1"; 
		        $data['message']="Successfully";
		        $data['address']=$Json_responce;
		        echo json_encode($data);
			   
			   
			}else{
				
				$data['status']="0"; 
		        $data['message']="No Data Available !!";
		        echo json_encode($data);
				
			}
			
		}else{
			
			$data['status']="2"; 
		    $data['message']="Customer Id Is Blank !!"; 
		    echo json_encode($data);
			
		}
		
	}
	
	
	function Gst($conn){
		
		$json_response = [];
		
		$data['status']="1"; 
		$data['gst']="3";
		$data['delhi']="200";
		$data['out_delhi']="300";
		$data['Message']="Successfully";
		echo json_encode($data);
		
		
	}
	
	function checkout($conn){
		
       $json_response = [];	
	   
	   $customer_id = $_REQUEST['customer_id'];
	   $pmethod = $_REQUEST['payment_type'];
	   $cid = $_REQUEST['cart_id'];
	   $total_price = $_REQUEST['total_price'];
	   $order_id='ORD'.rand(1111,9999);
       $txt_no=rand(11111111,99999999);
       
	    if($txt_no!='' && $order_id!='' && $cid!='' && $pmethod!='' && $customer_id!='' && $total_price!=''){
            
          $c_id=explode(',',$cid);
		  $k = count($c_id);
		   if($k > 0){
			   for ($x = 0; $x < $k; $x++) {

					$cartData = $conn->query("SELECT * FROM cart WHERE id='".$c_id[$x]."'");
				    $cartDetails = $cartData->fetch_object();
					
					$product = $conn->query("SELECT * FROM product WHERE id='".$cartDetails->product_id."'");
                    $productDetail = $product->fetch_object();
					$price = $cartDetails->quantity*$productDetail->product_sprice;
					
					if($pmethod==1){
						
                    $insert = $conn->query("INSERT INTO `order` SET order_id='$order_id',customer_id='$customer_id',product_id='".$cartDetails->product_id."',quantity='".$cartDetails->quantity."',price='$price',total_price='$total_price',color='".$cartDetails->color."',size='".$cartDetails->size."',message='".$cartDetails->message."',txt_no='$txt_no',payment_type='$pmethod',payment_status='0',order_status='1',delivery_status='0',created_on=Now()");
				   
				    $Delete = $conn->query("DELETE FROM cart WHERE id='".$c_id[$x]."'");
					
                    }else{
					 
                    $insert = $conn->query("INSERT INTO `order` SET order_id='$order_id',customer_id='$customer_id',product_id='".$cartDetails->product_id."',quantity='".$cartDetails->quantity."',price='$price',total_price='$total_price',color='".$cartDetails->color."',size='".$cartDetails->size."',message='".$cartDetails->message."',txt_no='$txt_no',payment_type='$pmethod',payment_status='0',order_status='0',delivery_status='0',created_on=Now()");
                    
                    $Delete = $conn->query("DELETE FROM cart WHERE id='".$c_id[$x]."'");
				   					 
					  
				    }
						 					
				}
				
				
				if($pmethod==1){
					
					// SMS Integration	For Customer
					
					$info = $conn->query("SELECT * FROM customer WHERE id='".$customer_id."'");
					$sms_details = $info->fetch_object();
					
					$customer_mobile = $sms_details->mobile_no;					
                    $name = $sms_details->fname.' '.$sms_details->lname;
					
					$date = strtotime("+7 day");
                    $delivery_date =  date('d M Y', $date);
					
					$sms_cus = "Dear $name, Welcome to KCJewellers .Your Order Has Been Booked And Your Order no : $order_id. And Your Order Delivery Date : $delivery_date </br> Regard KCJewellers.";		
						 
					$to_mobile=$customer_mobile;   // $customer_contact_no;
					$post_value = array(    								
										"uname"      => constant('SMS_UName'),								
										"pwd"        => constant('SMS_UPass'),							
										"msg"        => $sms_cus,								
										"to"         => $to_mobile,								
										"senderid"   => constant('SMS_USenderid'),								
										"route"      => constant('SMS_URoute'),						
										);	
										
								 													
				    $post_result = customer_message($post_value);
					
					
					// SMS Integration	For Admin
					$admin = $conn->query("SELECT * FROM users");
					$sms_admin = $admin->fetch_object();
					
					$admin_mobile = $sms_admin->mobile_no;
					
					$date = strtotime("+7 day");
                    $delivery_date =  date('d M Y', $date);

                    $sms_confirmation = "Hello KCJewellers, Order Has Been Booked For $name And Order No : $order_id And Order Delivery Date : $delivery_date . Thank You.";

                    $post_values = array(    								
												"uname"      => constant('SMS_UName'),								
												"pwd"        => constant('SMS_UPass'),							
												"msg"        => $sms_confirmation,								
												"to"         => $admin_mobile,								
												"senderid"   => constant('SMS_USenderid'),								
												"route"      => constant('SMS_URoute'),						
												);	
										
																					
					$post_results = shop_message($post_values);
					
				}
				
				$data['status']="1"; 
		        $data['Message']="Successfully";
				if($pmethod!="1"){
                $data['order_id']=$order_id;
				$data['total_price']=$total_price;
			    $data['txt_no']=$txt_no;
				
				}
				
		        echo json_encode($data);

           }else{
			  
              $data['status']="0";
			  $data['Message']="Something Went Wrong.Please Try Again!!";
			  echo json_encode($data);			 
			 
		  }		  
			
		}else{

            $data['status']="2";
			$data['Message']="Some Field Are Blank!!";
			echo json_encode($data);
		
		}
		
	}
	
	function Order($conn){
		
		$customer_id = $_REQUEST['customer_id'];
		$JsonArray = [];
		if($customer_id!=''){
			
			$detail = $conn->query("SELECT * FROM `order` WHERE customer_id='$customer_id' AND order_status='1' GROUP BY Order_id");
			if($detail->num_rows > 0){
				
				while($orderdetail =$detail->fetch_object()){
					
					$array_data['order_id'] = $orderdetail->order_id;
					$array_data['Payment_type'] = $orderdetail->payment_type;
					
					$order_d = $conn->query("select * from `order` where order_id='".$orderdetail->order_id."' and delivery_status='2'");
				    if($order_d->num_rows > 0){
					
					 $price = "0";
					 while($order_details = $order_d->fetch_object()){
					 	$price = $price+$order_details->price;
					 }
					 $gst = (int)($price*(3/100));
					 $cancelPrice = $price+$gst;
					 
					}else{
						$cancelPrice = "0";
					}
                    
					$array_data['Total_price'] = $orderdetail->total_price-$cancelPrice;
					$array_data['cancel_price'] = $cancelPrice;
					$num = $conn->query("SELECT * FROM `order` WHERE order_id='".$orderdetail->order_id."'");
					$array_data['num_product'] = $num->num_rows;
					$array_data['order_date'] = $orderdetail->created_on;
					$array_data['delivery_status'] = $orderdetail->delivery_status;
					
					
					$date = date("Y-m-d", strtotime($orderdetail->created_on));
                  $array_data['delivery_date'] = date('Y-m-d', strtotime($date. ' + 7 days'));
					
					array_push($JsonArray,$array_data);
				}
				
				$data['status']='1';
				$data['message']='Successfully';
		        $data['order_detail']=$JsonArray;
		        echo json_encode($data);
				
			}else{
				
			  $data['status']="0";
			  $data['message']="No Data Available";
			  echo json_encode($data);
				
			}
			
			
		}else{
			
			$data['status']="2";
			$data['Message']="Customer Id Is Blank!!";
			echo json_encode($data);
			
		}
		
	}
	
	function OrderDetail($conn){
		
		$order_id = $_REQUEST['order_id'];
		$JsonArray = [];
		if($order_id!=''){
			
			$detail = $conn->query("SELECT * FROM `order` WHERE order_id='$order_id' AND order_status='1' order by created_on desc");
			if($detail->num_rows > 0){
				
				while($orderdetail =$detail->fetch_object()){
					$detail1 = $conn->query("SELECT * FROM product WHERE id='".$orderdetail->product_id."'");
					$product_result = $detail1->fetch_object();
					
					$array_data['order_id'] = $orderdetail->order_id;
					$array_data['customer_id'] = $orderdetail->customer_id;
					$array_data['product_id'] = $orderdetail->product_id;
					$array_data['product_name'] = $product_result->product_name;
					$array_data['product_image'] = URL."img/product/".$product_result->product_image;
				    $array_data['product_sprice'] = $product_result->product_sprice;
				    $array_data['total_price'] = $orderdetail->price;
				    $array_data['product_quantity'] =$orderdetail->quantity;
				    $array_data['delivery_status'] =$orderdetail->delivery_status;
				    $array_data['product_color'] = $orderdetail->color;
				    $array_data['product_size'] = $orderdetail->size;
					
					array_push($JsonArray,$array_data);
				}
				
				$data['status']='1';
				$data['message']='Successfully';
		        $data['order_detail']=$JsonArray;
		        echo json_encode($data);
				
			}else{
				
				$data['status']="0";
				$data['message']="No Data Available";
				echo json_encode($data);
				
			}
			
		}else{
			
			$data['status']="2";
			$data['Message']="Order Id Is Blank!!";
			echo json_encode($data);
			
		}
		
	}
	
	
	
	
	
	
	
	  function customer_message($post_values) 							
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
	
	
	function shop_message($post_values) 							
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

	
	function AddReview($conn){
		
		$customer_id = $_REQUEST['customer_id'];
		$product_id = $_REQUEST['product_id'];
		$rating = $_REQUEST['rating'];
		$review = $_REQUEST['review'];
		
		if($customer_id!='' && $product_id!='' && $rating!='' && $review!=''){
			
			$checkExit = $conn->query("SELECT * FROM review WHERE product_id='".$product_id."' AND customer_id='".$customer_id."'");
			if($checkExit->num_rows > 0){
				
			  $data['status']="3"; 
		      $data['message']="You Have Already Submitted Your Review !!"; 
		      echo json_encode($data);
				
			}else{
				
			  $InsertReview = $conn->query("INSERT INTO review SET product_id='$product_id',customer_id='$customer_id',rating='$rating',review='$review',status='1',created_on=Now()");
			  if($InsertReview){
				  
				  $data['status']="1"; 
		          $data['message']="Added Successfully"; 
		          echo json_encode($data);
				  
			  }else{
				  
				  $data['status']="0";
		          $data['message']="Something Went Wrong.Please try Again !!";
		          echo json_encode($data);
				  
			  }
				
			}
			
		}else{
			
			  $data['status']="2"; 
		      $data['message']="Please Check Some Field Are Blank !!"; 
		      echo json_encode($data);
			
		}

	}	
	
	function CancelProduct($conn){
	    
	    $product_id = $_REQUEST['product_id'];
	    $order_id = $_REQUEST['order_id'];
	    
	    if($product_id!='' && $order_id!=''){
	    
	        $cancil= $conn->query("UPDATE `order` SET delivery_status='2' WHERE product_id='".$product_id."' AND order_id='".$order_id."'");
	           
	        if($cancil){
			  	
			  $detail = $conn->query("select * from `order` where order_id='".$order_id."' and product_id='".$product_id."'");	
			  $order_detail = $detail->fetch_object(); // Product Info	
 
			  $cutomer_info = $conn->query("SELECT * FROM customer WHERE id='".$order_detail->customer_id."'");
		      $customer_details = $cutomer_info->fetch_object(); // Customer Info
			  
			  $product_info = $conn->query("SELECT * FROM product WHERE id='".$order_detail->product_id."'");
		      $product_details = $product_info->fetch_object(); // Product Info
			  
			  $admin_info = $conn->query("SELECT * FROM users");
		      $admin_details = $admin_info->fetch_object(); // Admin Info
				


		                $mobile = $admin_details->mobile_no;					
                        //$shop_name = $shop_appointment_details->shop_name;					
                        $customer_name = $customer_details->fname.' '.$customer_details->lname;					
                       
		                $sms_confirmation = "Hello KCJewellers, Order Has Been Cancel For $customer_name  And Order No is $order_id. ";		
						 
					    $to_mobile=$mobile;   // $admin_contact_no;	
							
								
						$post_values = array(    								
												"uname"      => constant('SMS_UName'),								
												"pwd"        => constant('SMS_UPass'),							
												"msg"        => $sms_confirmation,								
												"to"         => $to_mobile,								
												"senderid"   => constant('SMS_USenderid'),								
												"route"      => constant('SMS_URoute'),						
												);	
										
																					
						$post_results = cancil_product_message($post_values);
			
				
				$data['status']="1"; 
		        $data['message']="Cancel Successfully";
		        echo json_encode($data);
				
			}else{
				$data['status']="0"; 
		        $data['message']="Something Went Wrong.Please try again !!"; 
		        echo json_encode($data);
				
			}
			
	    }else{
	    
	      $data['status']="2"; 
		  $data['message']="Product Id Or Order Id Are Blank!!"; 
		  echo json_encode($data);
	    
	    
	    }

	}

	 function cancil_product_message($post_values) 							
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

	
	
	
	/*================END API=====================*/
	
	function FavListing($conn){ // Customer Favorite Shop Listing
		
		$customer_id = $_GET['customer_id'];
		$json_response = [];
		if($customer_id!=''){
			
			$fav = "SELECT * FROM gosaloon_fav_shop gfs , gosaloon_onwer go WHERE go.id=gfs.shop_id AND gfs.customer_id='".$customer_id."' AND gfs.status='1'";
			$result = $conn->query($fav);
			if($result->num_rows>0){
				
				while($row = $result->fetch_object()){
				
				$base_url="http://".$_SERVER['SERVER_NAME'];
				$array_post['shop_id'] = $row->id;
				$array_post['shop_name'] = $row->shop_name;
				$array_post['address'] = $row->address;
				$array_post['shop_type'] = $row->shop_type;
				$array_post['cat_image'] = $base_url.'/admin/img/shop/'.$row->profile_pic;
				
				/************rating***************/
			   $ratingss=$conn->query("SELECT AVG(rating) AS rating FROM gosaloon_review WHERE shop_id='".$row->shop_id."'");
			   $shop_rating = $ratingss->fetch_object();
			   $ratings = $shop_rating->rating;
			 
			   if($ratings==null){
				 $rating = '0.0';
			   }else{
				 $rating = $ratings;
			   }
			   $array_post['rating'] = $rating;
			   /************rating***************/
				
				array_push($json_response,$array_post);
				
				}
				$data['status']="1";
				$data['message']="Successfully"; 
				$data['fav details']=$json_response;
				echo json_encode($data);
				
			}else{
				
				$data['status']="0"; 
			    $data['message']="No Data Available!!"; 
			    echo json_encode($data);
				
			}
			
		}else{
			
			$data['status']="2"; 
		    $data['message']="Customer Id Is blank !!"; 
		    echo json_encode($data);
			
				
		}
		
	}
	
	
	
	
	function ShopReview($conn){ // Particular Shop Review Listing
		
		$shop_id = $_REQUEST['shop_id'];
		$json_response = [];
		$someArray = [];
		$someArray1 = [];
		
		if($shop_id!=''){
			
			$review = "SELECT * FROM gosaloon_review WHERE status='1' AND shop_id='".$shop_id."' ORDER BY created_on DESC";
			$result = $conn->query($review);
			if($result->num_rows>0){
				
				// First Array
				
				$ratingss=$conn->query("select AVG(rating) AS rating from gosaloon_review where shop_id='".$shop_id."'");
				$shop_rating =$ratingss->fetch_object(); 
				$ratings = $shop_rating->rating;
				 
				 if($ratings==null){
					 $rating = '0.0';
				 }else{
					 $rating = $ratings;
				 }
				 $array_post1['avg_rating'] = $rating;
				 $array_post1['total_rating'] = $result->num_rows;
				 array_push($someArray,$array_post1); 
				
				// Second Array
				 $ratings1=$conn->query("SELECT * FROM gosaloon_review WHERE shop_id='".$shop_id."' AND rating='1'");
				  $rat1 = $ratings1->num_rows;
				 $ratings2=$conn->query("SELECT * FROM gosaloon_review WHERE shop_id='".$shop_id."' AND rating='2'");
				  $rat2 = $ratings2->num_rows;
				 $ratings3=$conn->query("SELECT * FROM gosaloon_review WHERE shop_id='".$shop_id."' AND rating='3'");
				 $rat3 = $ratings3->num_rows;
				 $ratings4=$conn->query("SELECT * FROM gosaloon_review WHERE shop_id='".$shop_id."' AND rating='4'");
				  $rat4 = $ratings4->num_rows;
				 $ratings5=$conn->query("SELECT * FROM gosaloon_review WHERE shop_id='".$shop_id."' AND rating='5'");
				  $rat5 = $ratings5->num_rows;
				 
				 $array_post2['rating1'] = $rat1;
				 $array_post2['rating2'] = $rat2;
				 $array_post2['rating3'] = $rat3;
				 $array_post2['rating4'] = $rat4;
				 $array_post2['rating5'] = $rat5;
			     array_push($someArray1,$array_post2);
				
				// Third array
				while($row = $result->fetch_object()){
				
				$date = date("m-d-Y");
				$name=$conn->query("SELECT * FROM gosaloon_customer WHERE id='".$row->customer_id."'");
				$customer_name = $name->fetch_object();
				$array_post['customer_name'] = $customer_name->fname.' '.$customer_name->lname;
				$array_post['rating'] = $row->rating;
				$array_post['review'] = $row->review;
				if($row->created_on == $date){
					$array_post['date'] = 'Today'; 
				}else{
					$array_post['date'] = $row->created_on;
				}
				
				array_push($json_response,$array_post);
				
				}
				
				 
				
				$data['status']="1";
				$data['message']="Successfully"; 
				$data['review details']=$json_response;
				$data['overoll rating']=$someArray;
				$data['seprate rating']=$someArray1;
				echo json_encode($data);
				
			}else{
				
				$data['status']="0"; 
			    $data['message']="No Data Available!!"; 
			    echo json_encode($data);
				
			}
			
		}else{
			
			$data['status']="2"; 
		    $data['message']="Shop Id Is blank !!"; 
		    echo json_encode($data);
			
		}
		
	}
	
	
	function AddShopReview($conn){ // Add Shop Review By Customer
		
		$customer_id = $_REQUEST['customer_id'];
		$shop_id = $_REQUEST['shop_id'];
		$rating = $_REQUEST['rating'];
		$review = $_REQUEST['review'];
		
		if($customer_id!='' && $shop_id!='' && $rating!='' && $review!=''){
			
			$checkExit = $conn->query("SELECT * FROM gosaloon_review WHERE shop_id='".$shop_id."' AND customer_id='".$customer_id."'");
			if($checkExit->num_rows > 0){
				
			  $data['status']="3"; 
		      $data['message']="You Have Already Submitted Your Review !!"; 
		      echo json_encode($data);
				
			}else{
				
			  $InsertReview = $conn->query("INSERT INTO gosaloon_review SET shop_id='$shop_id',customer_id='$customer_id',rating='$rating',review='$review',status='1',created_on=Now()");
			  if($InsertReview){
				  
				  $data['status']="1"; 
		          $data['message']="Added Successfully"; 
		          echo json_encode($data);
				  
			  }else{
				  
				  $data['status']="0"; 
		          $data['message']="Something Went Wrong.Please try Again !!";
		          echo json_encode($data);
				  
			  }
				
			}
			
		}else{
			
			  $data['status']="2"; 
		      $data['message']="Please Check Some Field Are Blank !!"; 
		      echo json_encode($data);
			
		}
		
		
	}
	
	
	function ListingCart($conn){ // Listing Appointment In Cart
	
	$customer_id = $_REQUEST['customer_id'];
	$JsonArray = [];
	
	if($customer_id!=''){
		
		$Listing = $conn->query("SELECT * FROM gosaloon_cart WHERE customer_id='".$customer_id."'");
		if($Listing->num_rows>0){
			
			while($cart_data =$Listing->fetch_object()){
               
			   $shop = $conn->query("SELECT * FROM gosaloon_onwer WHERE id='".$cart_data->shop_id."'");
			   $shop_result = $shop->fetch_object();
			   
			   $array_data['cart_id'] = $cart_data->id;
			   $array_data['shop_id'] = $shop_result->id;
			   $array_data['shop_name'] = $shop_result->shop_name;
			   if($cart_data->package_id=='0'){
			   $sub_cat = $conn->query("SELECT * FROM gosaloon_sub_cat WHERE sub_cat_id='".$cart_data->sub_cat_id."'");
			   $sub_cat_result = $sub_cat->fetch_object();
			   $array_data['sub_cat'] = $sub_cat_result->sub_category_name;
			   $array_data['price'] = $sub_cat_result->price;
			   }else{
			   $package = $conn->query("SELECT * FROM gosaloon_package WHERE id='".$cart_data->package_id."'");
			   $package_result = $package->fetch_object();
			   $array_data['sub_cat'] = $package_result->package_name;
			   $array_data['price'] = $package_result->package_price;  
				   
			   }
			   $date = $cart_data->date;
               $dates = date("M d Y",strtotime($date));
			   $day = date('l', $date);
               $day = $day;
               $time = $cart_data->time;
			   $time_status = $cart_data->time_status;
			   if($time_status=="Morning"){
				   $status = "AM";
			   }else if($time_status=="Evening"){
				   $status = "PM";
			   }else{
				   $status = "PM";
			   }
               $array_data['date_time'] = $dates.', '.$day.', '.$time.' '.$status;
			   
			   array_push($JsonArray,$array_data);
            }	
            
			 
			
            $data['status']="1"; 
		    $data['message']="Successfully";
		    $data['listing']=$JsonArray;
		    echo json_encode($data);
                			
			
		}else{
			
			$data['status']="0"; 
		    $data['message']="No Data Available !!"; 
		    echo json_encode($data);
			
		}
		
	}else{
		
		$data['status']="2"; 
		$data['message']="Customer Id Is Blank !!"; 
		echo json_encode($data);
		
	}
		
	}
	
	function RemoveAppointment($conn){
		
		$customer_id = $_REQUEST['customer_id'];
		$cart_id = $_REQUEST['cart_id'];
	    $JsonArray = [];
		
		if($customer_id!='' && $cart_id!=''){
			
			$Delete = $conn->query("DELETE FROM gosaloon_cart WHERE id='".$cart_id."' AND customer_id='$customer_id'");
			
			if($Delete){
				
				$data['status']="1"; 
		        $data['message']="Remove Successfully";
		        echo json_encode($data);
				
			}else{
				
				$data['status']="0"; 
		        $data['message']="Something Went Wrong.Please try again !!"; 
		        echo json_encode($data);
				
			}
			
			
		}else{
			
			$data['status']="2"; 
		    $data['message']="Customer Id And Cart Id Is Blank !!"; 
		    echo json_encode($data);
		
		}
		
	}
     
    
	 
	function Checkoffer($conn){
       
	   $customer_id = $_REQUEST['customer_id'];
	   $offer_code = $_REQUEST['offer_code'];
	   $total_amount = $_REQUEST['total_amount'];
	   $shop_id = $_REQUEST['shop_id'];
	   $today_date = date('d-m-Y');
	   
	   
	   if($shop_id!='' && $offer_code!='' && $total_amount!=''){
		   
		   $checkExit = $conn->query("SELECT * FROM gosaloon_coupon WHERE shop_id IN(0,".$shop_id.") AND code='".$offer_code."' AND end_date >= '".$today_date."' AND status='1'");
		   
		   if($checkExit->num_rows > 0){
			   
			   $result =$checkExit->fetch_object();
			   
			   if($result->shop_id=='0'){
				   
					$cart = $conn->query("SELECT * FROM gosaloon_cart WHERE shop_id='".$result->shop_id."' AND customer_id='".$customer_id."'");
					$total_price = 0;
					
					if($cart->num_rows>0){
						
					while($cart_details = $cart->fetch_object()){
					   
					   $price = $conn->query("SELECT * FROM gosaloon_sub_cat WHERE sub_cat_id='".$cart_details->sub_cat_id."'");
					   $price_details = $price->fetch_object();
					   
					   $total_price = $total_price+$price_details->price;
					   
					}
			       
				   
				   if($result->coupon_type=='Fixed Price Coupon'){
					  $offer_amount  = $result->price;
					  $total_amounts = $total_amount-$offer_amount;
				   }else{
					   $offer_amount = ($total_price/100)*$result->price;
					   $total_amounts = $total_amount-$offer_amount;
				   }
				   
				   $data['status']="1"; 
		           $data['message']="Applied Successfully";
		           $data['amount']=$total_amounts;
		           $data['coupon_code']=$offer_code;
		           $data['offer_amount']=$offer_amount;
		           $data['applied_shop']=$result->shop_id;
		           echo json_encode($data);
				   
				   
					}else{
						
						$data['status']="0"; 
		                $data['message']="Invalid Code !!";
		                echo json_encode($data);
					}
				   
			   }else{
			   
			   $cart = $conn->query("SELECT * FROM gosaloon_cart WHERE shop_id='".$result->shop_id."' AND customer_id='".$customer_id."'");
			   $total_price = 0;
			   
			   if($cart->num_rows>0){
				   
			   while($cart_details = $cart->fetch_object()){
				   
				   $price = $conn->query("SELECT * FROM gosaloon_sub_cat WHERE sub_cat_id='".$cart_details->sub_cat_id."'");
				   $price_details = $price->fetch_object();
				   
				   $total_price = $total_price+$price_details->price;
				   
			   }
			   
				   if($result->coupon_type=='Fixed Price Coupon'){
					  $offer_amount  = $result->price;
					  $total_amounts = $total_amount-$offer_amount;
				   }else{
					   $offer_amount = ($total_price/100)*$result->price;
					   $total_amounts = $total_amount-$offer_amount;
				   }
				   
				   $data['status']="1"; 
		           $data['message']="Applied Successfully";
		           $data['amount']=$total_amounts;
		           $data['coupon_code']=$offer_code;
		           $data['offer_amount']=$offer_amount;
		           $data['applied_shop']=$result->shop_id;
		           echo json_encode($data);
				   
				   
					}else{
						
						$data['status']="0"; 
		                $data['message']="Invalid Code !!";
		                echo json_encode($data);
					}
				   
			  
			   }
			   
		   }else{
			   
			   $data['status']="0"; 
		       $data['message']="Invalid Code !!";
		       echo json_encode($data);
		   
		   }
		   
	   }else{
		   
		   $data['status']="2"; 
		   $data['message']="Some Field Are Blank !!"; 
		   echo json_encode($data);
		   
	   }

	}	
	

   function BookAppointment($conn){
		
		$customer_id = $_REQUEST['customer_id'];
		$payment_method = $_REQUEST['payment_method'];
		$cart_id = $_REQUEST['cart_id'];
		$coupon_code = $_REQUEST['coupon_code'];
		$offer_amount = $_REQUEST['offer_amount'];
		$offer_shop_id = $_REQUEST['shop_id'];
		$amount = $_REQUEST['amount'];
		$appoitment_no='No'.rand(1111,9999);
		$txt_no=rand(11111111,99999999);
		
		if($customer_id!='' && $payment_method!='' && $cart_id!=''){
			
			$CartId=explode(',',$cart_id);
			$k = count($CartId);
			if($k > 0){
				
			  for ($x = 0; $x < $k; $x++) {
				  
				$Details = $conn->query("SELECT * FROM gosaloon_cart WHERE id='".$CartId[$x]."'");
				$CartDetails = $Details->fetch_object();
				
				if($offer_shop_id==$CartDetails->shop_id){
					
					$coupon_shop_id=$offer_shop_id;
					$coupoun_off_amount = $offer_amount;
					
				}else{
					
					$coupon_shop_id='0';
					$coupoun_off_amount='0';
				}
				
				if($payment_method=='Cash'){
					
					$Insert = $conn->query("INSERT INTO gosaloon_appointment SET appointment_id='$appoitment_no',appointment_no='$CartDetails->time_position',appointment_date='$CartDetails->date',appointment_time='$CartDetails->time',appointment_time_status='$CartDetails->time_status',shop_id='$CartDetails->shop_id',customer_id='$customer_id',category_id='$CartDetails->category_id',sub_cat_id='$CartDetails->sub_cat_id',amount='$amount',coupon_code='$coupon_code',coupon_shop_id='$coupon_shop_id',coupon_off_amount='$coupoun_off_amount',package_id='$CartDetails->package_id',payment_method='$payment_method',payment_status='1',status='1',created_on=Now()");
					
					$Delete = $conn->query("DELETE FROM gosaloon_cart WHERE id='".$CartId[$x]."'");
					
					$shop_info = $conn->query("SELECT * FROM gosaloon_onwer WHERE id='".$CartDetails->shop_id."'");
					$sms_shop_details = $shop_info->fetch_object(); // Shop Info
					
					$cutomer_info = $conn->query("SELECT * FROM gosaloon_customer WHERE id='".$customer_id."'");
					$sms_customer_details = $cutomer_info->fetch_object(); // Customer Info

                    $shop_mobile = $sms_shop_details->mobile_no;					
                    $shop_name = $sms_shop_details->shop_name;					
                    $customer_name = $sms_customer_details->fname.' '.$sms_customer_details->lname;					
                    $date = $CartDetails->date;					
                    $time = $CartDetails->time;					
                    $time_status = $CartDetails->time_status;					
                    $appointment_no = $CartDetails->time_position;					
					if($time_status=='Morning'){
						$t_status="AM";
					}else{
						$t_status="PM";
					}
					// SMS Integration	For Shop
						
							$sms_confirmation = "Hello $shop_name, Appointment Has Been Booked For $customer_name On $date At $time $t_status And Appointment No is $appointment_no. Regard Go Salon Team.";		
						 
							$to_mobile=$shop_mobile;   // $customer_contact_no;	
							
								
							$post_values = array(    								
												"uname"      => constant('SMS_UName'),								
												"pwd"        => constant('SMS_UPass'),							
												"msg"        => $sms_confirmation,								
												"to"         => $to_mobile,								
												"senderid"   => constant('SMS_USenderid'),								
												"route"      => constant('SMS_URoute'),						
												);	
										
																					
								$post_results = shop_message($post_values); 
																											
						// End SMS Shop Integration
						
						$sms_cus[] = $date.' At '.$time.' '.$t_status.' In '.$shop_name.' Your Appointment No Is '.$appointment_no;
					
				}else{
					
					$Insert = $conn->query("INSERT INTO gosaloon_appointment SET appointment_id='$appoitment_no',appointment_no='$CartDetails->time_position',appointment_date='$CartDetails->date',appointment_time='$CartDetails->time',appointment_time_status='$CartDetails->time_status',shop_id='$CartDetails->shop_id',customer_id='$customer_id',category_id='$CartDetails->category_id',sub_cat_id='$CartDetails->sub_cat_id',amount='$amount',coupon_code='$coupon_code',coupon_shop_id='$coupon_shop_id',coupon_off_amount='$coupoun_off_amount',package_id='$CartDetails->package_id',payment_method='$payment_method',payment_status='1',status='1',created_on=Now()");
					
					//$Delete = $conn->query("DELETE FROM gosaloon_cart WHERE id='".$CartId[$x]."'");
					
				}
				
			  }
			  
			    $data['status']="1";
				$sms_customer = implode(" , ",$sms_cus);
				
				if($payment_method=='Cash'){
					
					$date =date("d-m-Y");
					$appointment_payment = $conn->query("INSERT INTO gosaloon_appointment_payment SET appointment_id='$appoitment_no',customer_id='$customer_id',payment_method='$payment_method',total_amount='$amount',transaction_date='$date',transaction_id='$txt_no',status='1',created_on=Now()");
					
					$info = $conn->query("SELECT * FROM gosaloon_customer WHERE id='".$customer_id."'");
					$sms_details = $info->fetch_object();
					
					$customer_mobile = $sms_details->mobile_no;					
                    $name = $sms_details->fname.' '.$sms_details->lname;					
					
					// SMS Integration	For Customer
						
							$sms_login = "Dear $name, Welcome to GoSalon .Your Appointment Has Been Booked At $sms_customer. </br> Regard Go Salon Team.";		
						 
							$to_mobile=$customer_mobile;   // $customer_contact_no;
							$post_values = array(    								
												"uname"      => constant('SMS_UName'),								
												"pwd"        => constant('SMS_UPass'),							
												"msg"        => $sms_login,								
												"to"         => $to_mobile,								
												"senderid"   => constant('SMS_USenderid'),								
												"route"      => constant('SMS_URoute'),						
												);	
										
								 													
								$post_result = customer_message($post_values); 
																											
						// End SMS Integration	
					
					$data['Message']="Booked Successfully.";
				}else{
					
					$date =date("d-m-Y");
					$appointment_payment = $conn->query("INSERT INTO gosaloon_appointment_payment SET appointment_id='$appoitment_no',customer_id='$customer_id',payment_method='$payment_method',total_amount='$amount',transaction_date='$date',transaction_id='$txt_no',status='0',created_on=Now()");
					
					$data['Message']="Online Payment Option Coming Soon.";
				}
				echo json_encode($data);
				
			}else{
				
				$data['status']="0"; 
		        $data['message']="Something Went Wrong.Please try again !!"; 
		        echo json_encode($data);
				
			}
			
			
		}else{
			
			$data['status']="2"; 
		    $data['message']="Some Field Are Blank !!"; 
		    echo json_encode($data);
		   
		}
		
	}
	
	

  

    function BookAppointmentListing($conn){

                $customer_id = $_GET['customer_id'];
				$JsonArray = [];
				
				if($customer_id!=''){
					
					$Fetch_data = $conn->query("SELECT * FROM gosaloon_appointment WHERE customer_id='".$customer_id."' AND status='1'");
					if($Fetch_data->num_rows>0){
						
						while($Fetch_Result = $Fetch_data->fetch_object()){
						
						        $array_data['appointment_id'] = $Fetch_Result->id;
							
						    $shop_info = $conn->query("SELECT * FROM gosaloon_onwer WHERE id='".$Fetch_Result->shop_id."'");
					        $shop_details = $shop_info->fetch_object();
							
							$array_data['shop_name'] = $shop_details->shop_name;
							
							if($Fetch_Result->sub_cat_id=="0"){
								
							$sub_cat_info = $conn->query("SELECT * FROM gosaloon_package WHERE id='".$Fetch_Result->package_id."'");
					        $sub_cat_details = $sub_cat_info->fetch_object();
							$array_data['sub_cat_name'] = $sub_cat_details->package_name;
								
							}else{
								
							$sub_cat_info = $conn->query("SELECT * FROM gosaloon_sub_cat WHERE sub_cat_id='".$Fetch_Result->sub_cat_id."'");
					        $sub_cat_details = $sub_cat_info->fetch_object();
							$array_data['sub_cat_name'] = $sub_cat_details->sub_category_name;
							
							}
							
							
							
						    $array_data['address'] = $shop_details->address;
						    $date = $Fetch_Result->appointment_date;
						    $dates = date("M d Y",strtotime($date));
						    $day = date('l', $date);
						    $time = $Fetch_Result->appointment_time;
						    $time_status = $Fetch_Result->appointment_time_status;
						   if($time_status=="Morning"){
							   $status = "AM";
						   }else if($time_status=="Evening"){
							   $status = "PM";
						   }else{
							   $status = "PM";
						   }
						   
						   
						   $array_data['date_time'] = $dates.', '.$day.', '.$time.' '.$status;
						   $array_data['appointment_no'] = $Fetch_Result->appointment_no;	
						   $array_data['work_status'] = $Fetch_Result->work_status;	
							
							
							array_push($JsonArray,$array_data);
						}
						
						$data['status']="1"; 
		                $data['message']="Successfully"; 
		                $data['data']=$JsonArray; 
		                echo json_encode($data);
						
					}else{
						
						$data['status']="0"; 
		                $data['message']="No Data Available !!"; 
		                echo json_encode($data);
						
					}
					
					
				}else{
					
					$data['status']="2"; 
		            $data['message']="Customer Id Is Blank!!"; 
		            echo json_encode($data);
					
				}
	}	
	
	
	function CancilAppointment($conn){
	    
	    $appointment_id = $_REQUEST['appointment_id'];
	    
	    if($appointment_id!=''){
	    
	           $cancil= $conn->query("UPDATE gosaloon_appointment SET work_status='3' WHERE id='".$appointment_id."'");
	           
	           if($cancil){
				
		      $details =  $conn->query("SELECT * FROM gosaloon_appointment goa , gosaloon_onwer gon WHERE goa.shop_id=gon.id AND goa.id='".$appointment_id."'");		
		      $shop_appointment_details	= $details->fetch_object();
		      
		      $cutomer_info = $conn->query("SELECT * FROM gosaloon_customer WHERE id='".$shop_appointment_details->customer_id."'");
		      $sms_customer_details = $cutomer_info->fetch_object(); // Customer Info	
				
		        $shop_mobile = $shop_appointment_details->mobile_no;					
                        $shop_name = $shop_appointment_details->shop_name;					
                        $customer_name = $sms_customer_details->fname.' '.$sms_customer_details->lname;					
                        $date = $shop_appointment_details->appointment_date;					
                        $time = $shop_appointment_details->appointment_time;					
                        $time_status = $shop_appointment_details->appointment_time_status;					
                        $appointment_no = $shop_appointment_details->appointment_no;					
					if($time_status=='Morning'){
						$t_status="AM";
					}else{
						$t_status="PM";
					}
					// SMS Integration	For Shop
						
		$sms_confirmation = "Hello $shop_name, Appointment Has Been Cancel For $customer_name On $date At $time $t_status And Appointment No is $appointment_no. ";		
						 
							$to_mobile=$shop_mobile;   // $customer_contact_no;	
							
								
							$post_values = array(    								
												"uname"      => constant('SMS_UName'),								
												"pwd"        => constant('SMS_UPass'),							
												"msg"        => $sms_confirmation,								
												"to"         => $to_mobile,								
												"senderid"   => constant('SMS_USenderid'),								
												"route"      => constant('SMS_URoute'),						
												);	
										
																					
								$post_results = cancil_shop_message($post_values); 
																											
						// End SMS Shop Integration		
				
				
			$data['status']="1"; 
		        $data['message']="Cancil Successfully";
		       
		        echo json_encode($data);
				
			}else{
				
				$data['status']="0"; 
		        $data['message']="Something Went Wrong.Please try again !!"; 
		        echo json_encode($data);
				
			}
	    
	    
	    }else{
	    
	          $data['status']="2"; 
		  $data['message']="Appointment Id Is Blank!!"; 
		  echo json_encode($data);
	    
	    
	    }
	    
	    
	    
	}
	


    function cancil_shop_message($post_values) 							
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



	
	function Banner($conn){
		
		$JsonArray = [];
		
		$result = $conn->query("SELECT * FROM gosaloon_banner");
		if($result->num_rows>0){
			
		    while($result_data = $result->fetch_object()){
				
				$base_url="http://".$_SERVER['SERVER_NAME'];
				$array_data['image'] = $base_url.'/admin/img/banner/'.$result_data->image;
				
				array_push($JsonArray,$array_data);
			}	

			$data['status']="1"; 
		    $data['message']="Successfully";
		    $data['banner']=$JsonArray;
		    echo json_encode($data);

			
        }else{
			
		    $data['status']="0"; 
		    $data['message']="No Data Available !!"; 
		    echo json_encode($data);
			
		}

	}	
	
	function WriteComplaint($conn){
		
		$customer_id = $_REQUEST['customer_id'];
		$text = $_REQUEST['text'];
		
		if(!empty($_FILES['file']['name'])){
			
		$file_path = "../img/cus_complaint/";
		$comp_file = time().basename($_FILES['file']['name']);
		$file_paths = $file_path.$comp_file;
		
		}else{
			
		$comp_file="";
		
		}
		
		if($customer_id!='' && $text!=''){
			
			$InsertComplaint = $conn->query("INSERT INTO gosaloon_complaint SET customer_id='$customer_id',text='$text',file='$comp_file',status='1',created_on=Now()");
			
			if($InsertComplaint){
				
				$data['status']="1"; 
		        $data['message']="Added Successfully";
		        echo json_encode($data);
				
			}else{
				
				$data['status']="0"; 
		        $data['message']="Something Went Wrong.Please try again !!"; 
		        echo json_encode($data);
				
			}
			
		}else{
			
			$data['status']="2"; 
		    $data['message']="Customer Id And Complaint Text Is Blank !!"; 
		    echo json_encode($data);
			
		}
		
	}
	
	 function uploadDocs($conn){ //  testing  Aigple
		
		$customer_id=$_REQUEST['customer_id'];
		$json_response = [];
		
	    if($customer_id!=''){
			
			if(!empty($_FILES['file']['name'])){
			$file_path = "../img/customer/";
			$image_file = time().basename($_FILES['file']['name']);
			$file_paths = $file_path.$image_file;
			move_uploaded_file($_FILES['file']['tmp_name'], $file_paths);
			
			    $InsertData = $conn->query("INSERT gosaloon_cus SET image='$image_file',status='1' ");
				
			    if($InsertData){
					
					$base_url="http://".$_SERVER['SERVER_NAME'];
					$array_post['image_url'] = $base_url.'/admin/img/customer/';
				    $array_post['image']=$image_file;
				 
				    array_push($json_response,$array_post);
					
					$data['status']="1";
				    $data['message']="Successfully";
					$data['update details']=$json_response;
				    echo json_encode($data);
					
				}else{
					
					$data['status']="0";
				    $data['message']="Something Went Wrong.Please try Again !!";
				    echo json_encode($data);
					
				}
				
			}else{
				$data['status']="2";
				$data['message']="Please select Image First.";
				echo json_encode($data);
			}
			
		}else{
			 
			$data['status']="3"; 
		    $data['message']="Customer Id Is blank !!"; 
		    echo json_encode($data);
			
		 }
		
	}
	
	function errorpage(){ // Error Page
	
		//404- server not found
		$data['status']="404";
		echo json_encode($data);
		
	}
	
?>