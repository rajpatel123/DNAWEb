<?php
include("../lib/database.php");
include("../lib/function.php");

$file_type = $_POST['file_type'];
$sub_child =  $_POST['category'];
$type = $_POST['type'];
$title = $_POST['title'];
$sub = $_POST['sub_title'];
$descp = $_POST['descp'];
/*print_r($_POST);die;
$typeArray = explode(",", $type);
$titleArray = explode(",", $title);
$subArray = explode(",", $sub);
$descpArray = explode(",", $descp);
*/
//for($i=0; $i < count($typeArray); $i++){

if($_FILES['file']['name']!=""){
$tmp=$_FILES['file']['tmp_name'];
$file=time().basename($_FILES['file']['name']);
$serverpath="../img/file/".$file;
move_uploaded_file($tmp,$serverpath);
}
			
		   $insertData = "INSERT INTO video_pdf SET file_type='$file_type',sub_child_cat='".$sub_child."',type='".$type."',file='$file',title='".$title."',sub_title='".$sub."',`desc`='".$descp."',status='1',created_on=Now()";
		   
			if(mysql_query($insertData)){
		
		        echo "1";
		
        	}else{
		
		       echo "2";
		
	       }
			
//}

?>