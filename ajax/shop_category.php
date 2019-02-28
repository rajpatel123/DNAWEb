<?php
include("../lib/database.php");
include("../lib/function.php");


$shop_id = $_POST['shop_id'];
$category_type = $_POST['category_type'];
$selected = $_POST['selected'];
//print_r($_POST);die;

if($category_type=='1'){ // Man Category
	
$chkExit = "SELECT * FROM gosaloon_onwer WHERE id='".$shop_id."' and category=''";
$chkExits= mysql_query($chkExit);
if(mysql_num_rows($chkExits) > 0){
	
	$Update = "UPDATE gosaloon_onwer SET category='$selected' WHERE id='".$shop_id."'";
	if(mysql_query($Update)){
		echo "1";
	}else{
		echo "0";
	}
	
}else{
	
	$Update = "UPDATE gosaloon_onwer SET category='$selected' WHERE id='".$shop_id."'";
	if(mysql_query($Update)){
		echo "2";
	}else{
		echo "0";
	}
}
	
}else if($category_type=='2'){ // Woman Category

$chkExit = "SELECT * FROM gosaloon_onwer WHERE id='".$shop_id."' and category=''";
$chkExits= mysql_query($chkExit);
if(mysql_num_rows($chkExits) > 0){
	
	$Update = "UPDATE gosaloon_onwer SET category='$selected' WHERE id='".$shop_id."'";
	if(mysql_query($Update)){
		echo "1";
	}else{
		echo "0";
	}
	
}else{
	
	$Update = "UPDATE gosaloon_onwer SET category='$selected' WHERE id='".$shop_id."'";
	if(mysql_query($Update)){
		echo "2";
	}else{
		echo "0";
	}
}

}else{ //Unisex Category

$chkExit = "SELECT * FROM gosaloon_onwer WHERE id='".$shop_id."' and category=''";
$chkExits= mysql_query($chkExit);
if(mysql_num_rows($chkExits) > 0){
	
	$Update = "UPDATE gosaloon_onwer SET category='$selected' WHERE id='".$shop_id."'";
	if(mysql_query($Update)){
		echo "1";
	}else{
		echo "0";
	}
	
}else{
	
	$Update = "UPDATE gosaloon_onwer SET category='$selected' WHERE id='".$shop_id."'";
	if(mysql_query($Update)){
		echo "2";
	}else{
		echo "0";
	}
}

	
	
}
?>