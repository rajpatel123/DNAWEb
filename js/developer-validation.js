/*** GOOGLE ADDRESS ***/
function initializeAutocomplete(){   
    var input = document.getElementById('locality');
    // var options = {
    //   types: ['(regions)'],
    //   componentRestrictions: {country: "IN"}
    // };
    var options = {}

    var autocomplete = new google.maps.places.Autocomplete(input, options);

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
      var place = autocomplete.getPlace();
      var lat = place.geometry.location.lat();
      var lng = place.geometry.location.lng();
      var placeId = place.place_id;
      // to set city name, using the locality param
      var componentForm = {
        locality: 'short_name',
      };
      for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        if (componentForm[addressType]) {
          var val = place.address_components[i][componentForm[addressType]];
          document.getElementById("city").value = val;
        }
      }
      document.getElementById("latitude").value = lat;
      document.getElementById("longitude").value = lng;
      document.getElementById("location_id").value = placeId;
    });
  }
  
  
  /*** SHOP REGISTRATION VALIDATION **/
  function registvalidate() {

       var username=document.getElementById("username").value;
       var shopname=document.getElementById("shopname").value;
       var email=document.getElementById("email").value;
	   var regex= /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	   var address=document.getElementById("locality").value;
	   var mobile=document.getElementById("mobile").value;
	   var type=document.getElementById("type").value;
	   var privacy=document.getElementById("privacy").checked;
	   
		
	   if(username=="")
	   {	   
		   hideAllErrorscheck_blank();
		   document.getElementById('error_username').style.display="inline";
		   document.getElementById('username').focus();
		   return false;
		   
	   }else if(shopname=="")
	   {
		   hideAllErrorscheck_blank();
		   document.getElementById('error_shopname').style.display="inline";
		   document.getElementById('shopname').focus();
		   return false;
		   
	   }else if(email=="")
	   {
		   hideAllErrorscheck_blank();
		   document.getElementById('error_email').style.display="inline";
		   document.getElementById('email').focus();
		   return false;
		   
	   }else if(email!='' && (!regex.test(email))){
		    hideAllErrorscheck_blank();
			document.getElementById("error_validemail").style.display="inline";
			document.getElementById("email").focus();
			return false;
	   
	   }else if(address=="")
	   {
		   hideAllErrorscheck_blank();
		   document.getElementById('error_address').style.display="inline";
		   document.getElementById('locality').focus();
		   return false;
		   
	   }else if(mobile=="")
	   {
		   hideAllErrorscheck_blank();
		   document.getElementById('error_mobile').style.display="inline";
		   document.getElementById('mobile').focus();
		   return false;
		   
	   }else if(isNaN(mobile)||mobile.indexOf(" ")!=-1)
	   {    
  		   hideAllErrorscheck_blank();
		   document.getElementById('error_numeric').style.display="inline";
		   document.getElementById('mobile').focus();
		   return false;
			   
        }else if (mobile.length<10)
        {     
		   hideAllErrorscheck_blank();
		   document.getElementById('error_minlenth').style.display="inline";
		   document.getElementById('mobile').focus();
		   return false;
		   
        }else if (mobile.length>12)
        {     
		   hideAllErrorscheck_blank();
		   document.getElementById('error_maxlenth').style.display="inline";
		   document.getElementById('mobile').focus();
		   return false;

        }else if(type=="")
        {     
		   hideAllErrorscheck_blank();
		   document.getElementById('error_type').style.display="inline";
		   document.getElementById('type').focus();
		   return false;

        }else if(privacy=="")
        {     
		   hideAllErrorscheck_blank();
		   document.getElementById('error_privacy').style.display="inline";
		   document.getElementById('privacy').focus();
		   return false;

        }else{
		   
		   return true;
		   
	   }

}

function hideAllErrorscheck_blank()
{
	
	document.getElementById("error_username").style.display="none";
	document.getElementById("error_shopname").style.display="none";
	document.getElementById("error_email").style.display="none";
	document.getElementById("error_validemail").style.display="none";
	document.getElementById("error_address").style.display="none";
	document.getElementById("error_mobile").style.display="none";
	document.getElementById("error_numeric").style.display="none";
	document.getElementById("error_minlenth").style.display="none";
	document.getElementById("error_type").style.display="none";
	document.getElementById("error_privacy").style.display="none";
	
}

/***  Change Password ***/
function changePassword() {  

       var oldp=document.getElementById("oldp").value;
       var pwd=document.getElementById("pwd").value;
       var pwd2=document.getElementById("pwd2").value;
	   
	   if(oldp=="")
	   {	   
		   hideAllErrorscheck_blankc();
		   document.getElementById('error_old_pass').style.display="inline";
		   document.getElementById('oldp').focus();
		   return false;
		   
	   }else if(pwd=="")
	   {
		   hideAllErrorscheck_blankc();
		   document.getElementById('error_new_pass').style.display="inline";
		   document.getElementById('pwd').focus();
		   return false;
		   
	   }else if(pwd2=="")
	   {
		   hideAllErrorscheck_blankc();
		   document.getElementById('error_cnew_pass').style.display="inline";
		   document.getElementById('pwd2').focus();
		   return false;
		   
	   }else{
		   return true;
	   }
	
}


function hideAllErrorscheck_blankc()
{
	document.getElementById("error_old_pass").style.display="none";
	document.getElementById("error_new_pass").style.display="none";
	document.getElementById("error_cnew_pass").style.display="none";
}


/*** Add Category ***/
function category() {
	   
       var cat_name=document.getElementById("cat_name").value;
       var file=document.getElementById("file").value;
	   
	   if(cat_name=="")
	   {
		   hideAllErrorscheck_blankcat();
		   document.getElementById('error_cat_name').style.display="inline";
		   document.getElementById('cat_name').focus();
		   return false;
		   
	   }/*else if(file=="")
	   {
		   hideAllErrorscheck_blankcat();
		   document.getElementById('error_file').style.display="inline";
		   document.getElementById('file').focus();
		   return false;
		   
	   }*/else{
		   return true;
	   }
}
function hideAllErrorscheck_blankcat()
{
	document.getElementById("error_cat_name").style.display="none";
	document.getElementById("error_file").style.display="none";
}



/*** Edit Category ***/
function Editcategory() {
	
	var cat_name=document.getElementById("cat_name").value;
	var cat_status=document.getElementById("cat_status").value;
	
	if(cat_name=="")
	   {
		   hideAllErrorscheck_blankEcat();
		   document.getElementById('error_cat_name').style.display="inline";
		   document.getElementById('cat_name').focus();
		   return false;
		   
	   }/*else if(cat_status=="")
	   {
		   hideAllErrorscheck_blankEcat();
		   document.getElementById('error_status').style.display="inline";
		   document.getElementById('cat_status').focus();
		   return false;
		   
	   }*/else{
		   
		 return true;  
	   }
}

function hideAllErrorscheck_blankEcat()
{
	
	document.getElementById("error_cat_name").style.display="none";
	document.getElementById("error_status").style.display="none";
	
}

/*** ADD SUB CATEGORY ***/
function AddSubcategory(){
	//alert();
	var cat_id=document.getElementById("cat_id").value;
	var sub_cat_name=document.getElementById("sub_cat_name").value;
	
	if(cat_id=="")
	   {	   
		   hideAllErrorscheck_blankAddSubcat();
		   document.getElementById('error_cat_id').style.display="inline";
		   document.getElementById('cat_id').focus();
		   return false;
		   
	   }else if(sub_cat_name==""){
		   hideAllErrorscheck_blankAddSubcat();
		   document.getElementById('error_sub_cat_name').style.display="inline";
		   document.getElementById('sub_cat_name').focus();
		   return false;
		   
	   }else{
		 
        return true;		 
		   
	   }
	
}

function hideAllErrorscheck_blankAddSubcat(){
	
	document.getElementById("error_cat_id").style.display="none";
	document.getElementById("error_sub_cat_name").style.display="none";
	
}

/*** EDIT SUB CATEGORY ***/
function EditSubcategory() {
	
	var sub_cat_name=document.getElementById("sub_cat_name").value;
	var status=document.getElementById("status").value;
	
	if(sub_cat_name=="")
	   { 
		   hideAllErrorscheck_blankEditSubCat();
		   document.getElementById('error_sub_cat_name').style.display="inline";
		   document.getElementById('sub_cat_name').focus();
		   return false;
		   
	   }else if(status=="")
	   {
		   hideAllErrorscheck_blankEditSubCat();
		   document.getElementById('error_status').style.display="inline";
		   document.getElementById('status').focus();
		   return false;
		   
	   }else{
		   
		 return true;  
	   }
}

function hideAllErrorscheck_blankEditSubCat()
{
	
	document.getElementById("error_sub_cat_name").style.display="none";
	document.getElementById("error_status").style.display="none";
	
}



/*** ADD SUB CHILD CATEGORY ***/
function AddSubChildcategory(){
	//alert();
	var cat_id=document.getElementById("cat_id").value;
	var sub_cat_id=document.getElementById("sub_cat_id").value;
	var sub_childcat_name=document.getElementById("sub_childcat_name").value;
	
	if(cat_id==""){//alert();
		   hideErrorscheck_blanSubChildcats();
		   document.getElementById('error_cat_id').style.display="inline";
		   document.getElementById('cat_id').focus();
		   return false;
		   
	   }else if(sub_cat_id==""){
		   hideErrorscheck_blanSubChildcats();
		   document.getElementById('error_sub_cat_id').style.display="inline";
		   document.getElementById('sub_cat_id').focus();
		   return false;
		   
	   }else if(sub_childcat_name==""){
		   hideErrorscheck_blanSubChildcats();
		   document.getElementById('error_sub_childcat_name').style.display="inline";
		   document.getElementById('sub_childcat_name').focus();
		   return false;
		   
	   }else{
		 
        return true;		 
		   
	   }
	
}

function hideErrorscheck_blanSubChildcats(){
	
	document.getElementById("error_cat_id").style.display="none";
	document.getElementById("error_sub_cat_id").style.display="none";
	document.getElementById("error_sub_childcat_name").style.display="none";
	
}

/*** EDIT SUB CHILD CATEGORY ***/

function EditSubChildcategory() {
	
	var sub_child_cat_name=document.getElementById("sub_child_cat_name").value;
	var status=document.getElementById("status").value;
	
	if(sub_child_cat_name=="")
	   { 
		   hideAllErrorscheck_blankEditSubChil();
		   document.getElementById('error_sub_child_cat_name').style.display="inline";
		   document.getElementById('sub_child_cat_name').focus();
		   return false;
		   
	   }else if(status=="")
	   {
		   hideAllErrorscheck_blankEditSubChil();
		   document.getElementById('error_status').style.display="inline";
		   document.getElementById('status').focus();
		   return false;
		   
	   }else{
		   
		 return true;  
	   }
}

function hideAllErrorscheck_blankEditSubChil()
{
	
	document.getElementById("error_sub_child_cat_name").style.display="none";
	document.getElementById("error_status").style.display="none";
	
}

/*** ADD PRODUCT ***/
function addProduct(){
			//alert();
			var cat_id=document.getElementById("cat_id").value;
			var product_name=document.getElementById("product_name").value;
			var product_price=document.getElementById("product_price").value;
			var product_sprice=document.getElementById("product_sprice").value;
			var product_quantity=document.getElementById("product_quantity").value;
			var file=document.getElementById("file").value;
            
			if(cat_id=="")
            {     
		      hideAllErrorscheck_blankproduct();
		      document.getElementById('error_cat_id').style.display="inline";
		      document.getElementById('cat_id').focus();
		      return false;

            }else if(product_name==""){
			  hideAllErrorscheck_blankproduct();
		      document.getElementById('error_product_name').style.display="inline";
		      document.getElementById('product_name').focus();
		      return false;
				
			}else if(product_price==""){
			  hideAllErrorscheck_blankproduct();
		      document.getElementById('error_product_price').style.display="inline";
		      document.getElementById('product_price').focus();
		      return false;
				
			}else if(product_sprice==""){
			  hideAllErrorscheck_blankproduct();
		      document.getElementById('error_product_sprice').style.display="inline";
		      document.getElementById('product_sprice').focus();
		      return false;
				
			}else if(product_quantity==""){
			  hideAllErrorscheck_blankproduct();
		      document.getElementById('error_product_quantity').style.display="inline";
		      document.getElementById('product_quantity').focus();
		      return false;
				
			}else if(file==""){
			  hideAllErrorscheck_blankproduct();
		      document.getElementById('error_file').style.display="inline";
		      document.getElementById('product_file').focus();
		      return false;
				
			}else{
		   
		      return true;
		   
	        }
			
		}
		
		function hideAllErrorscheck_blankproduct(){
			
			document.getElementById("error_cat_id").style.display="none";
			document.getElementById("error_product_name").style.display="none";
			document.getElementById("error_product_price").style.display="none";
			document.getElementById("error_product_sprice").style.display="none";
			document.getElementById("error_product_quantity").style.display="none";
			document.getElementById("error_file").style.display="none";
			
		}

		
/*** EDIT PRODUCT ***/
function editProduct(){
	var product_name=document.getElementById("product_name").value;
	var product_price=document.getElementById("product_price").value;
	var product_sprice=document.getElementById("product_sprice").value;
	var product_quantity=document.getElementById("product_quantity").value;
	
	if(product_name==""){
	  hideAllErrorscheck_blankEDITproduct();
	  document.getElementById('error_product_name').style.display="inline";
	  document.getElementById('product_name').focus();
	  return false;
		
	}else if(product_price==""){
	  hideAllErrorscheck_blankEDITproduct();
	  document.getElementById('error_product_price').style.display="inline";
	  document.getElementById('product_price').focus();
	  return false;
		
	}else if(product_sprice==""){
	  hideAllErrorscheck_blankEDITproduct();
	  document.getElementById('error_product_sprice').style.display="inline";
	  document.getElementById('product_sprice').focus();
	  return false;
		
	}else if(product_quantity==""){
	  hideAllErrorscheck_blankEDITproduct();
	  document.getElementById('error_product_quantity').style.display="inline";
	  document.getElementById('product_quantity').focus();
	  return false;
		
	}else if(file==""){
	  hideAllErrorscheck_blankEDITproduct();
	  document.getElementById('error_file').style.display="inline";
	  document.getElementById('product_file').focus();
	  return false;
		
	}else{
   
	  return true;
   
	}
	
		
}

function hideAllErrorscheck_blankEDITproduct(){
   
    document.getElementById("error_product_name").style.display="none";
	document.getElementById("error_product_price").style.display="none";
    document.getElementById("error_product_sprice").style.display="none";
	document.getElementById("error_product_quantity").style.display="none";
  
}	
/*** EDIT SHOP DETAILS ***/
function EditShopDetail(){
//alert();
	 var username=document.getElementById("username").value;
	 var shopname=document.getElementById("shopname").value;
     var email=document.getElementById("email").value;
	 var regex= /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	 var address=document.getElementById("locality").value;
	 var mobile=document.getElementById("mobile").value;
	 var price_rating=document.getElementById("price_rating").value;
	 var type=document.getElementById("type").value;
	 var status=document.getElementById("status").value;
	 
	  if(username=="")
	   {	   
		   hideAllErrorscheck_blankshop();
		   document.getElementById('error_username').style.display="inline";
		   document.getElementById('username').focus();
		   return false;
		   
	   }else if(shopname=="")
	   {
		  hideAllErrorscheck_blankshop();
		   document.getElementById('error_shopname').style.display="inline";
		   document.getElementById('shopname').focus();
		   return false;
		   
	   }else if(email=="")
	   {
		  hideAllErrorscheck_blankshop();
		   document.getElementById('error_email').style.display="inline";
		   document.getElementById('email').focus();
		   return false;
		   
	   }else if(email!='' && (!regex.test(email))){
		    hideAllErrorscheck_blankshop();
			document.getElementById("error_validemail").style.display="inline";
			document.getElementById("email").focus();
			return false;
	   
	   }else if(address=="")
	   {
		   hideAllErrorscheck_blankshop();
		   document.getElementById('error_address').style.display="inline";
		   document.getElementById('locality').focus();
		   return false;
		   
	   }else if(mobile=="")
	   {
		   hideAllErrorscheck_blankshop();
		   document.getElementById('error_mobile').style.display="inline";
		   document.getElementById('mobile').focus();
		   return false;
		   
	   }else if(isNaN(mobile)||mobile.indexOf(" ")!=-1)
	   {    
  		   hideAllErrorscheck_blankshop();
		   document.getElementById('error_numeric').style.display="inline";
		   document.getElementById('mobile').focus();
		   return false;
			   
        }else if (mobile.length<10)
        {     
		   hideAllErrorscheck_blankshop();
		   document.getElementById('error_minlenth').style.display="inline";
		   document.getElementById('mobile').focus();
		   return false;
		   
        }else if (mobile.length>12)
        {     
		   hideAllErrorscheck_blankshop();
		   document.getElementById('error_maxlenth').style.display="inline";
		   document.getElementById('mobile').focus();
		   return false;

        }else if (price_rating=="")
        {     
		   hideAllErrorscheck_blankshop();
		   document.getElementById('error_price_rating').style.display="inline";
		   document.getElementById('price_rating').focus();
		   return false;

        }else if(type=="")
        {     
		   hideAllErrorscheck_blankshop();
		   document.getElementById('error_type').style.display="inline";
		   document.getElementById('type').focus();
		   return false;

        }else if(status=="")
        {     
		   hideAllErrorscheck_blankshop();
		   document.getElementById('error_status').style.display="inline";
		   document.getElementById('status').focus();
		   return false;

        }else{
		   
		   return true;
		   
	   }
	
}

function hideAllErrorscheck_blankshop(){
	
	document.getElementById("error_username").style.display="none";
	document.getElementById("error_shopname").style.display="none";
	document.getElementById("error_email").style.display="none";
	document.getElementById("error_validemail").style.display="none";
	document.getElementById("error_address").style.display="none";
	document.getElementById("error_mobile").style.display="none";
	document.getElementById("error_numeric").style.display="none";
	document.getElementById("error_minlenth").style.display="none";
	document.getElementById("error_price_rating").style.display="none";
	document.getElementById("error_type").style.display="none";
	document.getElementById("error_status").style.display="none";
}


/*** Add Color ***/
function color() {
	   
       var color_name=document.getElementById("color_name").value;
      
	   
	   if(color_name=="")
	   {
		   hideAllErrorscheck_blankcolor();
		   document.getElementById('error_color_name').style.display="inline";
		   document.getElementById('color_name').focus();
		   return false;
		   
	   }else{
		   return true;
	   }
}
function hideAllErrorscheck_blankcolor()
{
	document.getElementById("error_color_name").style.display="none";
	
}

/*** Add Size ***/
function sizeA() {
	   
       var size=document.getElementById("size").value;
      
	   
	   if(size=="")
	   {
		   hideAllErrorscheck_blanksize();
		   document.getElementById('error_size').style.display="inline";
		   document.getElementById('size').focus();
		   return false;
		   
	   }else{
		   return true;
	   }
}
function hideAllErrorscheck_blanksize()
{
	document.getElementById("error_size").style.display="none";
	
}

/*** EDIT SHOP BASIC DETAILS ***/
function BasicShop(){
	
	var facilities=document.getElementById("facilities").value;
	var brand=document.getElementById("brand").value;
	
	   if(facilities=="")
	   {	   
		   hideAllErrorscheck_blankshopBasicinfo();
		   document.getElementById('error_facilities').style.display="inline";
		   document.getElementById('facilities').focus();
		   return false;
		   
	   }else if(brand=="")
	   {
		   hideAllErrorscheck_blankshopBasicinfo();
		   document.getElementById('error_brand').style.display="inline";
		   document.getElementById('brand').focus();
		   return false;
		   
	   }else{
		   
		  return true; 
		   
	   }
	
}

function hideAllErrorscheck_blankshopBasicinfo(){
	
	document.getElementById("error_facilities").style.display="none";
	document.getElementById("error_brand").style.display="none";
	
}


/*** ADD BANNER ***/
function AddBanner(){
	
	var file=document.getElementById("file").value;
	
	if(file=="")
	   {	   
		   hideAllErrorscheck_blankbanner();
		   document.getElementById('error_file').style.display="inline";
		   document.getElementById('file').focus();
		   return false;
		   
	   }else{
		 
        return true;		 
		   
	   }
	
}

function hideAllErrorscheck_blankbanner(){
	
	document.getElementById("error_file").style.display="none";
	
}

