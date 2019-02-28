<?php
include("../lib/database.php");
include("../lib/function.php");

//print_r($_POST);die;
$product_id = $_POST['product_id'];
$cat_id = $_POST['cat_id'];
$sub_cat_id = $_POST['sub_cat_id'];
$sub_child_cat_id = $_POST['sub_child_cat_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_sprice = $_POST['product_sprice'];
$product_quantity = $_POST['product_quantity'];
$status = $_POST['status'];
$color = $_POST['color'];
$size = $_POST['size'];
//$sub_file = $_POST['sub_file'];

$specification = $_POST['specification'];
$shipping = $_POST['shipping'];
$returns = $_POST['returns'];

if($_FILES['file']['name']!=""){
  
/*    
$tmp=$_FILES['file']['tmp_name'];
$file=time().basename($_FILES['file']['name']);
$serverpath="../img/product/".$file;
move_uploaded_file($tmp,$serverpath);*/

$uploadedFile = $_FILES['file']['tmp_name']; 
$sourceProperties = getimagesize($uploadedFile);
$FileName = $_FILES['file']['name'];
$ext = substr($FileName, strrpos($FileName, "."));
$newFiles = time().basename($FileName, $ext);
$file = time().basename($FileName, $ext)."_thump".$ext;
$dirPath = "../img/product/";
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
$file = $_POST['file1'];	
}


	
	$editProduct = mysql_query("UPDATE product SET cat_id='$cat_id',sub_cat_id='$sub_cat_id=',sub_child_cat_id='$sub_child_cat_id',product_name='$product_name',product_price='$product_price',product_sprice='$product_sprice',product_quantity='$product_quantity',product_image='$file',status='$status',color='$color',size='$size',specification='$specification',shipping='$shipping',returns='$returns' WHERE id='".$product_id."'");
	
	//echo "UPDATE product SET cat_id='$cat_id',sub_cat_id='$sub_cat_id=',sub_child_cat_id='$sub_child_cat_id',product_name='$product_name',product_price='$product_price',product_sprice='$product_sprice',product_quantity='$product_quantity',product_image='$file',status='$status',color='$color',size='$size',specification='$specification',shipping='$shipping',returns='$returns' WHERE id='".$product_id."'";die;
	
	
	if($editProduct){
		
		echo "1";
		
	}else{
		
		echo "0";
		
	}
	

function imageResize($imageSrc,$imageWidth,$imageHeight) {

    $newImageWidth =190;
    $newImageHeight =190;

    $newImageLayer=imagecreatetruecolor($newImageWidth,$newImageHeight);
    imagecopyresampled($newImageLayer,$imageSrc,0,0,0,0,$newImageWidth,$newImageHeight,$imageWidth,$imageHeight);

    return $newImageLayer;
}


?>