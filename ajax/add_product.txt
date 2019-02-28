<?php
include("../lib/database.php");
include("../lib/function.php");

$sub_child_id = $_POST['sub_child_id'];
$sub_child_cat_name = $_POST['sub_child_cat_name'];
$status = $_POST['status'];



	
	$updateSubCategory = mysql_query("UPDATE sub_child_category SET sub_child_name='$sub_child_cat_name',status='$status=',created_on=Now() WHERE id='".$sub_child_id."'");
	
	if($updateSubCategory){
		
		echo "1";
		
	}else{
		
		echo "2";
		
	}
	



?>