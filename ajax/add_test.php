<?php
include("../lib/database.php");
include("../lib/function.php");

//print_r($_POST);die;
$start_date = $_POST['start_date'];
$question = $_POST['question'];
$name = $_POST['name'];
$duration = $_POST['duration'];
$category = $_POST['category'];
$paid = $_POST['paid'];


if($_FILES['file']['name']!=""){

$uploadedFile = $_FILES['file']['tmp_name']; 
$sourceProperties = getimagesize($uploadedFile);
$FileName = $_FILES['file']['name'];
$ext = substr($FileName, strrpos($FileName, "."));
$newFiles = time().basename($FileName, $ext);
$file = time().basename($FileName, $ext)."_thump".$ext;
$dirPath = "../img/test/";
$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$imageType = $sourceProperties[2];

switch ($imageType){
          
    case IMAGETYPE_PNG:
        $imageSrc = imagecreatefrompng($uploadedFile); 
        $tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
        imagepng($tmp,$dirPath. $newFiles. "_thump.". $ext);
        break;           

    case IMAGETYPE_JPEG:
        $imageSrc = imagecreatefromjpeg($uploadedFile); 
        $tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
        imagejpeg($tmp,$dirPath. $newFiles. "_thump.". $ext);
        break;
    
    case IMAGETYPE_GIF:
        $imageSrc = imagecreatefromgif($uploadedFile); 
        $tmp = imageResize($imageSrc,$sourceProperties[0],$sourceProperties[1]);
        imagegif($tmp,$dirPath. $newFiles. "_thump.". $ext);
        break;

    default:
        echo "Invalid Image type.";
        exit;
        break;
}



}else{
$file='';	
}

	
	$addtest = mysql_query("INSERT INTO test SET date='$start_date',question='$question',name='$name',duration='$duration',category='$category',paid='$paid',file='$file',status='1',created_on=Now()");
	
	if($addtest){
	
		echo "1";
		
	}else{
		
		echo "2";
		
	}
	

function imageResize($imageSrc,$imageWidth,$imageHeight) {

    $newImageWidth =190;
    $newImageHeight =190;

    $newImageLayer=imagecreatetruecolor($newImageWidth,$newImageHeight);
    imagecopyresampled($newImageLayer,$imageSrc,0,0,0,0,$newImageWidth,$newImageHeight,$imageWidth,$imageHeight);

    return $newImageLayer;
}

?>