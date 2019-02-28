<?php
include("../lib/database.php");
include("../lib/function.php");

//print_r($_POST);die;
$cat_id = $_POST['cat_id'];
$sub_cat_id = $_POST['sub_cat_id'];
$sub_child_cat_id = $_POST['sub_child_cat_id'];
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_sprice = $_POST['product_sprice'];
$product_quantity = $_POST['product_quantity'];
$color = $_POST['color'];
$size = $_POST['size'];
$count = count($_FILES['multiFiles']['name']);
$specification = $_POST['specification'];
$shipping = $_POST['shipping'];
$returns = $_POST['returns'];

if($_FILES['file']['name']!=""){
/*    
$tmp=$_FILES['file']['tmp_name'];
$file=time().basename($_FILES['file']['name']);
$serverpath="../img/product/".$file;
move_uploaded_file($tmp,$serverpath);
*/


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
$file='';	
}

$sku = mt_rand(10,1000);
$sku_id = 'Pro'.$sku;
	
	$addProduct = mysql_query("INSERT INTO product SET sku_id='$sku_id',cat_id='$cat_id',sub_cat_id='$sub_cat_id=',sub_child_cat_id='$sub_child_cat_id',product_name='$product_name',product_price='$product_price',product_sprice='$product_sprice',product_quantity='$product_quantity',product_image='$file',color='$color',size='$size',specification='$specification',shipping='$shipping',returns='$returns',status='1',created_on=Now()");
	
  //echo "INSERT INTO product SET sku_id='$sku_id',cat_id='$cat_id',sub_cat_id='$sub_cat_id=',sub_child_cat_id='$sub_child_cat_id',product_name='$product_name',product_price='$product_price',product_sprice='$product_price',product_quantity='$product_quantity',product_image='$file',color='$color',size='$size',specification='$specification',shipping='$shipping',returns='$returns',status='1',created_on=Now()";die;
	
	$last_id = mysql_insert_id();
	if($addProduct){
		
      for ($i = 0; $i < $count; $i++) {
	
          $tmp=$_FILES['multiFiles']['tmp_name'][$i];
          $files=time().basename($_FILES['multiFiles']['name'][$i]);
          $serverpath="../img/product/".$files;
          move_uploaded_file($tmp,$serverpath);
          
		  $addImage = mysql_query("INSERT INTO product_image SET sku_id='$sku_id',product_id='$last_id',product_sub_image='$files',status='1',created_on=Now()");		  

        }

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