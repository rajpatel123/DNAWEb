<?php
include("../lib/database.php");
include("../lib/function.php");

$cat_id = $_POST['cat_id'];
$cat_name = $_POST['cat_name'];
$status = $_POST['cat_status'];



if($_FILES['file']['name']!=""){
$tmp=$_FILES['file']['tmp_name'];
$file=time().basename($_FILES['file']['name']);
$serverpath="../img/category/".$file;
move_uploaded_file($tmp,$serverpath);
}else{
$file = $_POST['file1'];	
}

//print_r($_POST);die;

$chkExit = "SELECT * FROM category WHERE category_name='".$cat_name."' AND id!='".$cat_id."'";
$chkExits= mysql_query($chkExit);

if(mysql_num_rows($chkExits) > 0){
	
	echo "0";
	
}else{
	
	$updateCategory = mysql_query("UPDATE `category` SET category_name='$cat_name',category_image='$file',status='$status',created_on=Now() WHERE id='".$cat_id."'");
	
	if($updateCategory){
		
		echo "1";
		
	}else{
		
		echo "2";
		
	}
	
}


?>