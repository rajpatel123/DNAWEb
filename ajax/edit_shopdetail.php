<?php
include("../lib/database.php");
include("../lib/function.php");


$shop_id = $_POST['shop_id'];
$name = $_POST['username'];
$shopname = $_POST['shopname'];
$email = $_POST['email'];
$address = $_POST['address'];
$mobile = $_POST['mobile'];
$type = $_POST['type'];
$status = $_POST['status'];
$price_rating = $_POST['price_rating'];

//$address = $dlocation; // Google HQ
$prepAddr = str_replace(' ','+',$address);
$geocode=file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=false');
$output= json_decode($geocode);
$latitude = $output->results[0]->geometry->location->lat;
$longitude = $output->results[0]->geometry->location->lng;

if($_FILES['file']['name']!=""){
$tmp=$_FILES['file']['tmp_name'];
$file=time().basename($_FILES['file']['name']);
$serverpath="../img/shop/".$file;
move_uploaded_file($tmp,$serverpath);
}else{
$file = $_POST['file1'];	
}


	$UpdateDetail = mysql_query("UPDATE gosaloon_onwer SET name='$name',shop_name='$shopname',shop_type='$type',email='$email',mobile_no='$mobile',address='$address',latitude='$latitude',longitude='$longitude',price_rating='$price_rating',status='$status',profile_pic='$file' WHERE id='".$shop_id."'");
	
	
	if($UpdateDetail){
		
		echo "1";
		
	}else{
		
		echo "0";
		
	}



?>