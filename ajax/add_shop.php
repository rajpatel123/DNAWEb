<?php
include("../lib/database.php");
include("../lib/function.php");


$user_name = $_POST['user_name'];
$shop_name = $_POST['shop_name'];
$mobile = $_POST['mobile'];
$password = $_POST['password'];
$address = $_POST['address'];

$chkExit = "SELECT * FROM gosaloon_onwer WHERE username='".$shop_name."' and address='".$address."'";
$chkExits= mysql_query($chkExit);
if(mysql_num_rows($rs) > 0){
	
}else{
	echo "1";
}


?>