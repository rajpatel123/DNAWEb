<?php
include("../lib/database.php");
include("../lib/function.php");


$checked = $_POST['checked'];
$action = $_POST['action'];
$shop_id = $_POST['shop_id'];


if($action=='days'){
//echo "anil";
$chkExit = "SELECT * FROM gosaloon_daytime WHERE shop_id='".$shop_id."'";
$chkExits= mysql_query($chkExit);
if(mysql_num_rows($chkExits) > 0){
	
	$Update = "UPDATE gosaloon_daytime SET open_day='$checked' WHERE shop_id='".$shop_id."'";
	if(mysql_query($Update)){
		echo "1";
	}else{
		echo "0";
	}
	
}else{
	
	$Insert = "INSERT INTO gosaloon_daytime SET open_day='$checked' , shop_id='$shop_id'";
	if(mysql_query($Insert)){
		echo "2";
	}else{
		echo "0";
	}
}

}else if ($action=='morning'){ // ADD MORNING TIME
	
$chkExit = "SELECT * FROM gosaloon_daytime WHERE shop_id='".$shop_id."'";
$chkExits= mysql_query($chkExit);
if(mysql_num_rows($chkExits) > 0){
	
	$Update = "UPDATE gosaloon_daytime SET morning_time='$checked' WHERE shop_id='".$shop_id."'";
	if(mysql_query($Update)){
		echo "1";
	}else{
		echo "0";
	}
	
}else{
	
	$Insert = "INSERT INTO gosaloon_daytime SET morning_time='$checked' , shop_id='$shop_id'";
	if(mysql_query($Insert)){
		echo "2";
	}else{
		echo "0";
	}
}
	
	
}else if ($action=='evening'){ // ADD EVENING TIME
	
$chkExit = "SELECT * FROM gosaloon_daytime WHERE shop_id='".$shop_id."'";
$chkExits= mysql_query($chkExit);
if(mysql_num_rows($chkExits) > 0){
	
	$Update = "UPDATE gosaloon_daytime SET evening_time='$checked' WHERE shop_id='".$shop_id."'";
	if(mysql_query($Update)){
		echo "1";
	}else{
		echo "0";
	}
	
}else{
	
	$Insert = "INSERT INTO gosaloon_daytime SET evening_time='$checked' , shop_id='$shop_id'";
	if(mysql_query($Insert)){
		echo "2";
	}else{
		echo "0";
	}
}
	
	
}else if ($action=='night'){ // ADD NIGHT TIME
	
$chkExit = "SELECT * FROM gosaloon_daytime WHERE shop_id='".$shop_id."'";
$chkExits= mysql_query($chkExit);
if(mysql_num_rows($chkExits) > 0){
	
	$Update = "UPDATE gosaloon_daytime SET night_time='$checked' WHERE shop_id='".$shop_id."'";
	if(mysql_query($Update)){
		echo "1";
	}else{
		echo "0";
	}
	
}else{
	
	$Insert = "INSERT INTO gosaloon_daytime SET night_time='$checked' , shop_id='$shop_id'";
	if(mysql_query($Insert)){
		echo "2";
	}else{
		echo "0";
	}
}
	
	
}else{
	echo "0";
}
?>