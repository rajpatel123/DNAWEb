<?php
include("../lib/database.php");
include("../lib/function.php");

$cat_id = $_POST['cat_id'];
$sub_cat_id = $_POST['sub_cat_id'];
$sub_childcat_name = $_POST['sub_childcat_name'];

$chkExit = "SELECT * FROM sub_child_category WHERE  cat_id='".$cat_id."' AND sub_cat_id='".$sub_cat_id."' AND sub_child_name='".$sub_childcat_name."'";
$chkExits= mysql_query($chkExit);
if(mysql_num_rows($chkExits) > 0){
	
	echo "2";
	
}else{
	
	$insertSubCategory = mysql_query("INSERT INTO sub_child_category SET cat_id='$cat_id',sub_cat_id='$sub_cat_id',sub_child_name='$sub_childcat_name',status='1',created_on=Now()");
	
	if($insertSubCategory){
		
		echo "1";
		
	}else{
		
		echo "0";
		
	}
	
}

?>