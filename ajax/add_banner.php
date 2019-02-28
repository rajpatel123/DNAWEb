<?php
include("../lib/database.php");
include("../lib/function.php");

$tmp=$_FILES['file']['tmp_name'];
$file=time().basename($_FILES['file']['name']);
$serverpath="../img/banner/".$file;
move_uploaded_file($tmp,$serverpath);

	$insertbanner = mysql_query("INSERT INTO banner SET image='$file',status='1',created_on=Now()");
	
	if($insertbanner){
		
		echo "1";
		
	}else{
		
		echo "2";
		
	}
	



?>