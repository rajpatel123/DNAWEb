<?php
include("../lib/database.php");
include("../lib/function.php");

$cat_id = $_POST['cat_Id'];


	$sub_cat = mysql_query("SELECT * FROM sub_category WHERE cat_id='".$cat_id."'");
	$sub_cat_no = mysql_num_rows($sub_cat);
	if($sub_cat_no > 0){
		echo "<option value=''>Select Sub Category</option>";
		while($sub_cat_details = mysql_fetch_array($sub_cat)){
			echo '<option value="'.$sub_cat_details['id'].'">'.$sub_cat_details['sub_cat_name'].'</option>';
		}
		
	}else{
		echo "<option value=''>First Add Sub Category</option>";
	}
	
	


?>