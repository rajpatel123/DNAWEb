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
	    case "registration":  // Customer Registration 
        UserRegistration($conn);
        break;
		
		case "login":   // Customer Login
        UserLogin($conn);
        break;
		
		case "mobileverify":
        MobileVerify($conn);
        break;
		
		case "forgotpassword":
        ForgotPassword($conn);
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

        case "product":  //  Product 
        Product($conn);
        break;

        case "product_detail":  //  Product Details
        productDetail($conn);
        break;	

		case "add_cart":  //  Product Add To Cart
        AddCart($conn);
        break;
		
		case "cart_list":  // Add To Cart Listing
		CartListing($conn);
        break;
		
		case "remove_cart":  // Remove Cart Listing
        RemoveCart($conn);		
		break;
		
		case "search":
        Search($conn);
        break;
		
		case "shopdetails":
        ShopDetails($conn);
        break;
		
		case "shopsubcat":
        ShopSubCat($conn);
        break;
		
		case "addfavshop":
        AddFavShop($conn);
        break;
		
		case "favlisting":
        FavListing($conn);
        break;
		
		case "shopcoupon":
        ShopCoupon($conn);
        break;
		
		case "allcoupon":
        AllCoupon($conn);
        break;
		
		case "package":
        Package($conn);
        break;
		
		case "shopreview":
        ShopReview($conn);
        break;
		
		case "addshopreview":
        AddShopReview($conn);
        break;
		
		case "shopopenday":
        ShopOpenDay($conn);
        break;
		
		case "shoptime":
        ShopTime($conn);
        break;
		
		case "addcart":
        AddCart($conn);
        break;
		
		case "listingcart":
        ListingCart($conn);
        break;
		
		case "removeappointment":
        RemoveAppointment($conn);
        break;
		
		case "checkoffer":
        Checkoffer($conn);
        break;
		
		case "bookappointment":
        BookAppointment($conn);
        break;
		
		case "bookappointmentlisting":
        BookAppointmentListing($conn);
        break;
		
		
		case "cancilappointment":
        CancilAppointment($conn);
        break;
		
		case "banner":
        Banner($conn);
        break;
		
		case "writecomplaint":
        WriteComplaint($conn);
        break;
		
		
		
		default:
		errorpage();
		break;
		
	}
	
	function UserRegistration($conn){ // Customer Registration
	     
		$fname=$_REQUEST['fname'];
		$lname=$_REQUEST['lname'];
		$email_id=$_REQUEST['email_id'];
		$password=md5($_REQUEST['password']);
		$mobile=$_REQUEST['mobile'];
		//$mverify_code = mt_rand(1111,9999);
		//$name = $fname.' '.$lname;
		
		if($fname=="" || $lname=="" || $email_id=="" || $password=="" || $mobile=="")
		{
			$data['status']="3";
			$data["message"] = "Please Enter All Field Data !!";
			echo json_encode($data);
			
		}else{
			
			$check="SELECT * FROM customer WHERE email_id='".$email_id."'";
			$result = $conn->query($check);
			if($result->num_rows>0){
			
				$data['status']="2";
				$data["message"] = "This Email-Id Already Registration.Please Login anil!!";
				echo json_encode($data);
				
			}
			else
			{
				$check_mobile="SELECT * FROM customer WHERE mobile_no='".$mobile."'";
			    $resultMobile = $conn->query($check_mobile);
				if($resultMobile->num_rows>0){
					
					$data['status']="4";
				    $data["message"] = "This Mobile No Already Registration.Please Login !!";
				    echo json_encode($data);
					
				}else{
					
					$Insert="INSERT INTO customer SET fname='$fname',lname='$lname', email_id='$email_id',password='$password',mobile_no='$mobile',status ='1',created_on =now()";
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
			$sql1 = "SELECT * FROM customer WHERE email_id='".$email_id."' or mobile_no='".$email_id."' AND password='".md5($password)."'";
			$result = $conn->query($sql1);
			if($result->num_rows>0){
				 $row=$result->fetch_object();
				 
				 if($row->status=='0'){
					$data["status"] = "3";  
				    $data["message"] = "Your Account Suspend Due To Same Resign.Please Contact Kc Jeweller Administrator !!";
				    echo json_encode($data);
				 
				 }else{
					 $base_url="http://".$_SERVER['SERVER_NAME'];
					 $array_post['id']=$row->id;
					 $array_post['first_name']=$row->fname;
					 $array_post['last_name']=$row->lname;
					 $array_post['email_id']=$row->email_id;
					 $array_post['mobile_no']=$row->mobile_no;
					 $array_post['image_url'] = $base_url.'/admin/img/customer/';
					 $array_post['image']=$row->image;
					 
					 array_push($json_response,$array_post);
					 $data['status']="1";
					 $data['message']="Successfully";
					 $data['login details']=$json_response;
					 echo json_encode($data);
				 }
				 
			}else{
				$data["status"] = "0"; 
				$data["message"] = "Your Email-Id/Mobile No And Password is not correct !!";
				echo json_encode($data);
			}
		}else{
			 $data["status"] = "2";  
			 $data["message"] = "Please Enter Email-Id/Mobile No And Password !!";  
			 echo json_encode($data);
		}
		
		
	}
	
	
	function ForgotPassword($conn){ //Customer Forgot Password
		
		$mobile = $_REQUEST['mobile'];
		
		if($mobile!=''){
			
			$CheckExit = $conn->query("SELECT * FROM customer WHERE mobile_no='".$mobile."'");
			if($CheckExit->num_rows>0){
				
				$row=$CheckExit->fetch_object();
				
				$password = mt_rand(111111,999999); 
				$Update = $conn->query("UPDATE gosaloon_customer SET password='$password' WHERE id='".$row->id."'");
				
				// SMS Integration
                            $name = $row->fname.' '.$row->lname;						   
						    $mobile = $row->mobile_no;
							
							$sms_login = "Dear $name, Welcome to GoSalon .Your password : $password </br> Regard Go Salon Team.";		
						 
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
	
	function Product($conn){
		
		$json_response = [];
		
		$cat_id=$_REQUEST['cat_id']; 
		$sub_cat_id=$_REQUEST['sub_cat_id'];
		$sub_child_cat_id=$_REQUEST['sub_child_cat_id'];
		
		if($cat_id!="" && $sub_cat_id!="" && $sub_child_cat_id!=""){
			
			$product = $conn->query("SELECT * FROM product WHERE cat_id='".$cat_id."' AND sub_cat_id='".$sub_cat_id."' AND sub_child_cat_id='".$sub_child_cat_id."' AND status='1'");
			if($product->num_rows > 0){
				
				$array_data = [];
				
				while($productDetail=$product->fetch_object()){
					
					$array_data['p_id'] = $productDetail->id;
					$array_data['p_name'] = $productDetail->product_name;
					$array_data['p_image'] = URL."img/product/".$productDetail->product_image;
					$array_data['p_price'] = $productDetail->product_price;
					$array_data['p_sprice'] = $productDetail->product_sprice;
					
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
			
			
		}else if($cat_id!="" && $sub_cat_id!=""){
			
			$product = $conn->query("SELECT * FROM product WHERE cat_id='".$cat_id."' and sub_cat_id='".$sub_cat_id."' and status='1'");
			if($product->num_rows > 0){
				
				$array_data = [];
				
				while($productDetail=$product->fetch_object()){
					
					$array_data['p_id'] = $productDetail->id;
					$array_data['p_name'] = $productDetail->product_name;
					$array_data['p_image'] = URL."img/product/".$productDetail->product_image;
					$array_data['p_price'] = $productDetail->product_price;
					$array_data['p_sprice'] = $productDetail->product_sprice;
					
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
	
	
	function productDetail($conn){
		
		$product_id = $_REQUEST['product_id'];
		$json_response = [];
		$someArray = [];
		$someArray1 = [];
		$jsonResponse = [];
		
		if($product_id!=''){
			
			$productdetail = $conn->query("SELECT * FROM product WHERE id='".$product_id."'");
			$productDetails = $productdetail->fetch_object();
			
			$array_data['product_id'] = $productDetails->id;
			$array_data['product_name'] = $productDetails->product_name;
			$array_data['product_image_url'] = URL."img/product/";
			$array_data['product_image'] = $productDetails->product_image;
			$array_data['product_price'] = $productDetails->product_price;
			$array_data['product_sprice'] =$productDetails->product_sprice;
			$array_data['product_color'] = $productDetails->color;
			$array_data['product_size'] = $productDetails->size;
			$array_data['product_specification'] = "";
			$array_data['product_shiping'] = "";
			$array_data['product_return'] = "";
			
			
			array_push($json_response,$array_data);
			
			$data['status']="1"; 
		    $data['message']="Successfully"; 
		    $data['book_details']=$json_response;
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
		
		if($customer_id!="" && $product_id!=""){
			
			$checkExit = $conn->query("SELECT * FROM cart WHERE customer_id='".$customer_id."' AND product_id='".$product_id."'");
			
			if($checkExit->num_rows > 0){
				
			  $data['status']="3"; 
		      $data['message']="You Have Already Added In This Product In Cart !!"; 
		      echo json_encode($data);
				
			}else{
				
				$insertData = $conn->query("INSERT INTO cart SET customer_id='$customer_id',product_id='$product_id',status='1',created_on=Now()");
			  
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
	
	function Search($conn){ // Search Shop Name Based And Address Based
	
		
		$search_data = $_REQUEST['data'];
		$latTo=$_REQUEST['latTo']; 
		$longTo=$_REQUEST['longTo'];
		$json_response = [];
		
		if($search_data!=''){
			
			$CheckExit = $conn->query("SELECT * FROM gosaloon_onwer WHERE shop_name like '%".$_REQUEST['data']."%' OR address like '%".$_REQUEST['data']."%' AND status='1' AND type='Vendor'");
			
			if($CheckExit->num_rows>0){
				    
				    while($row = $CheckExit->fetch_object()){
					
					
					$base_url="http://".$_SERVER['SERVER_NAME'];
					$array_post['shop_id'] = $row->id;
					$array_post['shop_name'] = $row->shop_name; 
					$array_post['store_image'] = $base_url.'/admin/img/shop/'.$row->profile_pic;
					$array_post['shop_type'] = $row->shop_type; 
					
					$latitudeTo = $latTo; // user lat
					$longitudeTo = $longTo; // user long
					$latitudeFrom =$row->latitude; //store lat
					$longitudeFrom =$row->longitude; //store long
					 
					//Calculate distance from latitude and longitude
					$theta = $longitudeFrom - $longitudeTo;
					$dist = sin(deg2rad($latitudeFrom)) * sin(deg2rad($latitudeTo)) +  cos(deg2rad($latitudeFrom)) * cos(deg2rad($latitudeTo)) * cos(deg2rad($theta));
					$dist = acos($dist);
					$dist = rad2deg($dist);
					$miles = $dist * 60 * 1.1515;
					
					$distance = ($miles * 1.609344);
					$shop_distance = substr($distance, 0, 5).' km';
					$array_post['distance'] = $shop_distance;
					
					array_push($json_response,$array_post);  
					
				}
				
				    $data['status'] = "1";
					$data['message']="Successfully";
                    $data['store_details']=$json_response;					
					echo json_encode($data);
				
			}else{
				
				$data['status']="0"; 
		        $data['message']="No Data Available !!";
		        echo json_encode($data);
				
			}
			
		}else{
			
			$data['status']="2"; 
		    $data['message']="Data Is blank !!"; 
		    echo json_encode($data);
			
		}
	}
	
	
	
	
	
	function AddFavShop($conn){ // Customer Add Favorite Shop
		
		$customer_id=$_REQUEST['customer_id'];
		$shop_id=$_REQUEST['shop_id'];
		if($customer_id!='' && $shop_id!=''){
			
			$CheckExit=$conn->query("SELECT * FROM gosaloon_fav_shop WHERE customer_id='$customer_id' AND shop_id='$shop_id'");
		    if($CheckExit ->num_rows > 0){
			        $row = $CheckExit->fetch_object();
					if($row->status=='0'){
						
						$updateFav = $conn->query("UPDATE gosaloon_fav_shop SET status='1' WHERE id='".$row->id."'");
						if($updateFav){
							
							$data['status']="2";
					        $data['message']="Update Successfully";
			                echo json_encode($data);
							
						}else{
							
							$data['status']="0";
					        $data['message']="Something Went Wrong.Please try Again !!";
			                echo json_encode($data);
							
						}
						
					}else{
						
						$updateFav = $conn->query("UPDATE gosaloon_fav_shop SET status='0' WHERE id='".$row->id."'");
						if($updateFav){
							
							$data['status']="2";
					        $data['message']="Update Successfully";
			                echo json_encode($data);
							
						}else{
							
							$data['status']="0";
					        $data['message']="Something Went Wrong.Please try Again !!";
			                echo json_encode($data);
							
						}
						
					}
			
		    }else{
				
				$insertFav = $conn->query("INSERT INTO gosaloon_fav_shop SET customer_id='$customer_id',shop_id='$shop_id',status='1',created_on=Now()");
				
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
		   $data['message']="Shop Id And Customer Id Is blank !!"; 
		   echo json_encode($data);
			
		}
		
	}
	
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