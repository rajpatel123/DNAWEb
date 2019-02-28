<?php
include("../lib/database.php");
include("../lib/function.php");

$color_name = $_POST['color_name'];

$exit = mysql_num_rows(mysql_query("SELECT * FROM color WHERE name='".$color_name."'"));
if($exit > 0){
	echo "0";
}else{
	
	$insertcolor = mysql_query("INSERT INTO color SET name='$color_name',status='1',created_on=Now()");
	
	if($insertcolor){
		
		echo "1";
		
	}else{
		
		echo "2";
		
	}
	
}


?>