<?php
include("../lib/database.php");
include("../lib/function.php");


$shop_id = $_POST['shop_id'];
$facilities = mysql_real_escape_string($_POST['facilities']);
$brand = mysql_real_escape_string($_POST['brand']);



	$UpdateDetail = mysql_query("UPDATE gosaloon_onwer SET facilities='$facilities',brand='$brand' WHERE id='".$shop_id."'");
	
	if($UpdateDetail){
		
		echo "1";
		
	}else{
		
		echo "0";
		
	}



?>