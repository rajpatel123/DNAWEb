<?php
include("../lib/database.php");
include("../lib/function.php");

$sub_cat_id = $_POST['sub_cat_id'];
$sub_cat_name = $_POST['sub_cat_name'];
$status = $_POST['status'];



	
	$updateSubCategory = mysql_query("UPDATE sub_category SET sub_cat_name='$sub_cat_name',status='$status=',created_on=Now() WHERE id='".$sub_cat_id."'");
	
	if($updateSubCategory){
		
		echo "1";
		
	}else{
		
		echo "2";
		
	}
	



?>