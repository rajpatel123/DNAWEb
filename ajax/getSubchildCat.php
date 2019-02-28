<?php
include("../lib/database.php");
include("../lib/function.php");

$sub_child_cat = mysql_query("SELECT * FROM sub_child_category WHERE sub_cat_id='".$_POST['sub_cat_Id']."' AND cat_id='".$_POST['cat_id']."'");

$sub_child_cat_no = mysql_num_rows($sub_child_cat);
	if($sub_child_cat_no > 0){
		echo "<option value=''>Select Sub Child Category</option>";
		while($sub_child_cat_details = mysql_fetch_array($sub_child_cat)){
			echo '<option value="'.$sub_child_cat_details['id'].'">'.$sub_child_cat_details['sub_child_name'].'</option>';
		}
		
	}else{
		echo "<option value=''>First Add Sub Child Category</option>";
	}

?>