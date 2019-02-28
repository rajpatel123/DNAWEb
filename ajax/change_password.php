<?php
include("../lib/database.php");
include("../lib/function.php");

$id = $_SESSION['id'];
$old_pass = md5($_POST['old']);
$new_pass = md5($_POST['pwd']);
$con_new_pass = md5($_POST['pwd2']);

if($new_pass==$con_new_pass){
	
	$sql = "SELECT * FROM users WHERE password='$old_pass' AND id='".$id."'";
    $rs = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($rs) > 0){
		
		$update =  "UPDATE gosaloon_onwer SET password='$new_pass' WHERE id='".$id."'";
		if(mysql_query($update)){
			
			echo "1";
			
		}else{
			
			echo "4";
			
		}
	
		
	}else{
		
		echo "2";
	}
	
}else{
	
	echo "0";
	
}


?>