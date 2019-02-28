<?php
include("../lib/database.php");
include("../lib/function.php");

$size = $_POST['size'];

$exit = mysql_num_rows(mysql_query("SELECT * FROM size WHERE size='".$size."'"));
if($exit > 0){
	echo "0";
}else{
	
	$insertsize = mysql_query("INSERT INTO size SET size='$size',status='1',created_on=Now()");
	
	if($insertsize){
		
		echo "1";
		
	}else{
		
		echo "2";
		
	}
	
}


?>