<?php
include("../lib/database.php");
include("../lib/function.php");



$cat_name = $_POST['cat_name'];

if($_FILES['file']['name']!=""){
$tmp=$_FILES['file']['tmp_name'];
$file=time().basename($_FILES['file']['name']);
$serverpath="../img/category/".$file;
move_uploaded_file($tmp,$serverpath);
}
/*
$total = "SELECT * FROM category WHERE status='1'";
$totals= mysql_query($total);
if(mysql_num_rows($totals) > 2){
    	echo "3";
}else{ */   

$chkExit = "SELECT * FROM category WHERE status='1' and category_name='".$cat_name."'";
$chkExits= mysql_query($chkExit);

if(mysql_num_rows($chkExits) > 0){
	
	echo "0";
	
}else{
	
	$insertCategory = mysql_query("INSERT INTO `category` SET category_name='$cat_name',category_image='$file',status='1',created_on=Now()");
	
	if($insertCategory){
		
		echo "1";
		
	}else{
		
		echo "2";
		
	}
	
/*}*/
}

?>