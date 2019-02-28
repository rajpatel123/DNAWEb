<?php
session_start();
include("../lib/database.php");


$username = $_POST['username'];
$password = md5($_POST['password']);

$sql = "select * from users where username='$username' and password='$password'";

	$rs = mysql_query($sql) or die(mysql_error());
	if(mysql_num_rows($rs) > 0){
		$rc = mysql_fetch_array($rs);
		
		 if($rc['status']==1){
			 
			 if($rc['type']=='Admin'){
			     echo "1";
			 }else{
				 echo "2"; 
			 }
			 $_SESSION['id'] = $rc['id'];
			 $_SESSION['name'] = $rc['name'];
			 $_SESSION['email'] = $rc['email'];
			 $_SESSION['type'] = $rc['type'];
			 
		 }else{
			 
			echo "3"; 
			
		 }
		
	}else{
		
		echo "0";
		
	}


?>