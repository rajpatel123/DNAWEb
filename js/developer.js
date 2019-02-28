/*** REGISTRATION ***/

$(document).ready(function() {
		$(document).delegate(".register","click",function(){
					
                    var username = $("#username").val();
			        var shopname = $("#shopname").val();
			        var email = $("#email").val();
			        var address = $("#locality").val();
			        var mobile = $("#mobile").val();
			        var type = $("#type").val();
                   
					
					var form_data = new FormData();
					form_data.append('username', username);
                    form_data.append('shopname', shopname);	
                    form_data.append('email', email);	
                    form_data.append('address', address);	
                    form_data.append('mobile', mobile);	
                    form_data.append('type', type);	

					if(registvalidate()){
						
						$.ajax({
							url: 'ajax/add_registration.php', // point to server-side PHP script 
							dataType: 'text',  // what to expect back from the PHP script, if anything
							cache: false,
							contentType: false,
							processData: false,
							data: form_data,                        
							type: 'post',
							success: function (result) {
							 //alert(result);return false;
							  
							  if(result==1){
								  $("#form")[0].reset();
								  $(".error").hide();
								  $('.alert-success').show();
								  setTimeout(function() { $(".alert-success").hide(); }, 5000);
							  }else if (result==0){
								  $('.alert-error').show();
								  setTimeout(function() { $(".alert-error").hide(); }, 3000);
							  }else if(result==3){
								  //$("#cat_validation")[0].reset();
								  $('.alert-error2').show();
								  setTimeout(function() { $(".alert-error2").hide(); }, 3000);
							  }else{
								 $('.alert-error1').show();
								  setTimeout(function() { $(".alert-error1").hide(); }, 3000);
							  }
						    }
						});
				
					}else{
					      //$('.alert-error').show();
				          //setTimeout(function() { $(".alert-error").hide(); }, 3000);	
						
					}
				
				
		});
		
});



/*** LOGIN ***/

$('#password').keypress(function (e) {
    var key = e.which;
    if(key == 13)  // the enter key code
    {
		$('.login').click();
		
	}
});
/*$('#password').keypress(function (e) {
    var key = e.which;
    if(key == 13)  // the enter key code
    {
		$('.login').click();
	}
});*/

$(document).ready(function() {
		$(document).delegate(".login", "click", function(e) {
			
					var username = $('#username').val();
			        var password = $('#password').val();
					
                    $.ajax({
				    url: "ajax/login.php",
				    data: {username:username,password:password},
				    type: 'POST',
				    success: function (result) {
						//alert(result);return false;
						if(result==1){
						   window.open("dashboard.php","_self");
						}else if (result==2){
						   window.open("vendor/dashboard.php","_self");
						}else if (result==3){
						   $('.alert-suspend').show();return false;
						}else{
						   $('.alert-error').show();return false;
						}
					}
                    });
		});
		
});

/*** RECOVER PASSWORD ***/

$(document).ready(function() {
		$(document).delegate(".recover_password", "click", function(e) {
			
			       e.preventDefault();
			       var email_id = $('#email_id').val();
				
                    $.ajax({
				    url: "ajax/recovery_password.php",
				    data: {email_id:email_id},
				    type: 'POST',
				    success: function (result) {
						//alert(result);return false;
						if(result==1){
					      $("#recoverform")[0].reset();
						  $('.alert-success').show();
					      setTimeout(function() { $(".alert-success").hide(); }, 5000);
						}else if(result==2){
						   $('.alert-error1').show();
					       setTimeout(function() { $(".alert-error1").hide(); }, 3000);
						}else{
						   $('.alert-error').show();
					       setTimeout(function() { $(".alert-error").hide(); }, 3000); 
						}
					}
                    });
		           
		});
		
});

/*** ADD CATEGORY ***/

$(document).ready(function() {
		
				   $(document).delegate(".add_category","click",function(){
					 
                    var cat_name = $("#cat_name").val();
                    //var file = $('#file').prop('files')[0];
					
					var form_data = new FormData();                  
					//form_data.append('file', file);
					form_data.append('cat_name', cat_name);

					//if(category()){
						
						$.ajax({
							url: 'ajax/add_category.php', // point to server-side PHP script 
							dataType: 'text',  // what to expect back from the PHP script, if anything
							cache: false,
							contentType: false,
							processData: false,
							data: form_data,                        
							type: 'post',
							success: function (result) {
							 //alert(result);return false;
							  if(result==1){
								  $("#cat_validation")[0].reset();
								  $(".error").hide();
								  $('.alert-success').show();
								  setTimeout(function() { $(".alert-success").hide(); }, 3000);
							  }else if (result==2){
								  $('.alert-error').show();
								  setTimeout(function() { $(".alert-error").hide(); }, 3000);
							  }else if (result==3){
								  $('.alert-error2').show();
								  setTimeout(function() { $(".alert-error2").hide(); }, 3000);
							  }else{
								  $("#cat_validation")[0].reset();
								  $(".error").hide();
								  $('.alert-error1').show();
								  setTimeout(function() { $(".alert-error1").hide(); }, 3000);
							  }
						    }
						});
				
					//}
				
				
		});
		
	});
	
	
	/*** EDIT CATEGORY ***/
	$(document).ready(function() {
		
				   $(document).delegate(".edit_category","click",function(){
					 
                    var cat_id = $("#cat_id").val();
                    var file1 = $("#file1").val();
                    var cat_name = $("#cat_name").val();
			        var cat_status = $("#cat_status").val();
                    var file = $('#file').prop('files')[0];
					
					var form_data = new FormData();                  
					form_data.append('file', file);
					form_data.append('cat_name', cat_name);
                    form_data.append('cat_id', cat_id);	
                    form_data.append('file1', file1);	
                    form_data.append('cat_status', cat_status);	
					
					if(Editcategory()){

					$.ajax({
					url: 'ajax/edit_category.php', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                        
					type: 'post',
				    success: function (result) {
					 //alert(result);return false;
					  if(result==1){
						  $("#cat_validation")[0].reset();
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); location.reload();}, 3000);
						   
					  }else if (result==2){
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }else{
						  $("#cat_validation")[0].reset();
						  $('.alert-error1').show();
				          setTimeout(function() { $(".alert-error1").hide(); }, 3000);
					  }
				}
				});
				
				}
				
				
		});
		
	});
	
	/*** ADD SUB CATEGORY ***/
	$(document).ready(function() { 
	        $(document).delegate(".add_subcategory","click",function(){
				
					   
                    var cat_id = $("#cat_id").val();
			        var sub_cat_name = $("#sub_cat_name").val();
				
					var form_data = new FormData();
					form_data.append('cat_id', cat_id);
                    form_data.append('sub_cat_name', sub_cat_name);	
                   
					
					if(AddSubcategory()){

					$.ajax({
					url: 'ajax/add_subcategory.php', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                        
					type: 'post',
				    success: function (result) {
						//alert(result);return false;
					 if(result==1){
						  $("#sub_cat_validation")[0].reset();
						  $(".error").hide();
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); }, 3000);
					  }else if (result==2){
						  $("#sub_cat_validation")[0].reset();
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }else{
						  
						  $('.alert-error1').show();
				          setTimeout(function() { $(".alert-error1").hide(); }, 3000);
					  }
				}
				});
				
				}
				
				
		});
		
	});
	
	/*** EDIT SUB CATEGORY ***/
	$(document).ready(function() { 
	        $(document).delegate(".edit_subcategory","click",function(){
				//alert();
                    var sub_cat_id = $("#sub_cat_id").val();
			        var sub_cat_name = $("#sub_cat_name").val();
			        var status = $("#status").val();
			        
				
					var form_data = new FormData();
					form_data.append('sub_cat_id', sub_cat_id);
                    form_data.append('sub_cat_name', sub_cat_name);
                    form_data.append('status', status);	

					if(EditSubcategory()){
					
					$.ajax({
					url: 'ajax/edit_subcategory.php', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                        
					type: 'post',
				    success: function (result) {
						//alert(result);return false;
					 if(result==1){
						  $("#sub_cat_validation")[0].reset();
						  $(".error").hide();
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); location.reload();}, 3000);
					  }else if (result==2){
						  $("#sub_cat_validation")[0].reset();
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }else{
						  
						  $('.alert-error1').show();
				          setTimeout(function() { $(".alert-error1").hide(); }, 3000);
					  }
				}
				});
				
					}
				
				
		});
		
	});

	/*** ADD SUB CHILD CATEGORY ***/
	
	$(document).ready(function() { 
	        $(document).delegate(".add_subchildcat","click",function(){
				
					   
                    var cat_id = $("#cat_id").val();
                    var sub_cat_id = $("#sub_cat_id").val();
			        var sub_childcat_name = $("#sub_childcat_name").val();
				
					var form_data = new FormData();
					form_data.append('cat_id', cat_id);
					form_data.append('sub_cat_id', sub_cat_id);
                    form_data.append('sub_childcat_name', sub_childcat_name);	
                   
					
					if(AddSubChildcategory()){
                   
					$.ajax({
					url: 'ajax/add_subchildcategory.php', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                        
					type: 'post',
				    success: function (result) {
						
					 if(result==1){
						  $("#sub_cat_validation")[0].reset();
						  $(".error").hide();
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); }, 3000);
					  }else if (result==2){
						  $("#sub_cat_validation")[0].reset();
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }else{
						  
						  $('.alert-error1').show();
				          setTimeout(function() { $(".alert-error1").hide(); }, 3000);
					  }
				}
				});
				
				}
				
				
		});
		
	});
	
	/*** EDIT SUB CHILD CATEGORY ***/
	$(document).ready(function() { 
	        $(document).delegate(".edit_subchildcategory","click",function(){
				//alert();
					   
                    var sub_child_id = $("#sub_child_id").val();
                    var status = $("#status").val();
			        var sub_child_cat_name = $("#sub_child_cat_name").val();
				
					var form_data = new FormData();
					form_data.append('sub_child_id', sub_child_id);
					form_data.append('status', status);
                    form_data.append('sub_child_cat_name', sub_child_cat_name);	
                   
					
					if(EditSubChildcategory()){
                  
					$.ajax({
					url: 'ajax/edit_subchildcategory.php', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                        
					type: 'post',
				    success: function (result) {
						//alert(result);return false;
					 if(result==1){
						  $("#sub_cat_validation")[0].reset();
						  $(".error").hide();
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); }, 3000);
					  }else if (result==2){
						  $("#sub_cat_validation")[0].reset();
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }else{
						  
						  $('.alert-error1').show();
				          setTimeout(function() { $(".alert-error1").hide(); }, 3000);
					  }
				}
				});
				
				}
				
				
		});
		
	});
	
	
	/*** ADD PRODUCT ***/
	$(document).delegate(".add_product","click",function(){
			
			 var cat_id = $("#cat_id").val();
			 var sub_cat_id = $("#sub_cat_id").val();
			 var sub_child_cat_id = $("#sub_child_cat_id").val();
			 var product_name = $("#product_name").val();
			 var product_price = $("#product_price").val();
			 var product_sprice = $("#product_sprice").val();
			 var product_quantity = $("#product_quantity").val();
			 var file = $('#file').prop('files')[0];
			 var ins = document.getElementById('multiFiles').files.length;
			 
			 var specification = $("#specification").val();
			 var shipping = $("#shipping").val();
		     var returns = $("#returns").val();
			 
			var chkArray = [];
				$(".color:checked").each(function() {
					chkArray.push($(this).val());
				});
				
		    var color;
				color = chkArray.join(',') ;
				
			var chkArrays = [];
				$(".size:checked").each(function() {
					chkArrays.push($(this).val());
				});
				
		    var size;
				size = chkArrays.join(',') ;	
				
				
			 var sub_file = $("input[name='sub_file[]']")
              .map(function(){return $(this).val();}).get();
			  
			  var form_data = new FormData();
		          form_data.append('cat_id', cat_id);
		          form_data.append('sub_cat_id', sub_cat_id);
		          form_data.append('sub_child_cat_id', sub_child_cat_id);
		          form_data.append('product_name', product_name);
		          form_data.append('product_price', product_price);
		          form_data.append('product_sprice', product_sprice);
		          form_data.append('product_quantity', product_quantity);
		          form_data.append('file', file);
		          form_data.append('sub_file', sub_file);
		          form_data.append('color', color);
		          form_data.append('size', size);
		          for (var x = 0; x < ins; x++) {
                     form_data.append("multiFiles[]", document.getElementById('multiFiles').files[x]);
                  }
			      form_data.append('specification', specification);
			      form_data.append('shipping', shipping);
			      form_data.append('returns', returns);
			      
            if(addProduct()){ 
              
			$.ajax({
			url: 'ajax/add_product.php', // point to server-side PHP script 
			dataType: 'text',  // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,                        
			type: 'post',
			success: function (result) {
			//alert(result);return false;
			 //$('.test').html(result);
			  
			  if(result==1){
				  $("#sub_cat_validation")[0].reset();
				  $(".error").hide();
				  $('.alert-success').show();
				  setTimeout(function() { $(".alert-success").hide(); }, 5000);
			  }else if (result==0){
				  $('.alert-error').show();
				  setTimeout(function() { $(".alert-error").hide(); }, 3000);
			  }else if(result==3){
				  //$("#cat_validation")[0].reset();
				  $('.alert-error2').show();
				  setTimeout(function() { $(".alert-error2").hide(); }, 3000);
			  }else{
				 $('.alert-error1').show();
				  setTimeout(function() { $(".alert-error1").hide(); }, 3000);
			  }
			}
		});	  
			}
        });
	
	/*** EDIT PRODUCT ***/
	
	$(document).delegate(".edit_product","click",function(){
			
			 var product_id = $("#product_id").val();
			 var cat_id = $("#cat_id").val();
			 var sub_cat_id = $("#sub_cat_id").val();
			 var sub_child_cat_id = $("#sub_child_cat_id").val();
			 var product_name = $("#product_name").val();
			 var product_price = $("#product_price").val();
			 var product_sprice = $("#product_sprice").val();
			 var product_quantity = $("#product_quantity").val();
			 var file = $('#file').prop('files')[0];
			 var file1 = $('#file1').val();
			 var status = $('#status').val();
			 //alert(product_sprice);return false;
			 var specification = $("#specification").val();
			 var shipping = $("#shipping").val();
		     var returns = $("#returns").val();
			 
			 var chkArray = [];
				$(".color:checked").each(function() {
					chkArray.push($(this).val());
				});
				
		    var color;
				color = chkArray.join(',') ;
				
			var chkArrays = [];
				$(".size:checked").each(function() {
					chkArrays.push($(this).val());
				});
				
		    var size;
				size = chkArrays.join(',') ;
			 
			 var sub_file = $("input[name='sub_file[]']")
              .map(function(){return $(this).val();}).get();
			  
			  var form_data = new FormData();
		          form_data.append('product_id', product_id);
		          form_data.append('cat_id', cat_id);
		          form_data.append('sub_cat_id', sub_cat_id);
		          form_data.append('sub_child_cat_id', sub_child_cat_id);
		          form_data.append('product_name', product_name);
		          form_data.append('product_price', product_price);
		          form_data.append('product_sprice', product_sprice);
		          form_data.append('product_quantity', product_quantity);
		          form_data.append('file', file);
		          form_data.append('file1', file1);
		          form_data.append('sub_file', sub_file);
		          form_data.append('status', status);
		          form_data.append('color', color);
		          form_data.append('size', size);
		          form_data.append('specification', specification);
			      form_data.append('shipping', shipping);
			      form_data.append('returns', returns);
			
            if(editProduct()){ 
              
			$.ajax({
			url: 'ajax/edit_product.php', // point to server-side PHP script 
			dataType: 'text',  // what to expect back from the PHP script, if anything
			cache: false,
			contentType: false,
			processData: false,
			data: form_data,                        
			type: 'post',
			success: function (result) {
			//alert(result);return false;
			//$('.test').html(result);
			  
			  if(result==1){
				  $("#sub_cat_validation")[0].reset();
				  $(".error").hide();
				  $('.alert-success').show();
				  setTimeout(function() { $(".alert-success").hide(); location.reload();}, 3000);
			  }else{
				 $('.alert-error').show();
				  setTimeout(function() { $(".alert-error").hide(); }, 3000);
			  }
			}
		});	  
			}
        });
	
	/*** DELETE ***/
	
	function Delete(id,action){
		
		var x = confirm("Are you sure you want to delete?");
        if (x == true){
			
			$.ajax({
				url :'ajax/delete.php',
				type: 'POST',
				data : {id:id,action:action},
				success: function(result){
				    //alert(result);return false;
					if(result==1){
						
					$('.alert-success').show();	
					setTimeout(function(){
					   $(".gradeX"+id).hide();
					   $(".alert-success").hide();
					},3000);
					
					}else{
						
						$('.alert-error').show();
						setTimeout(function() { $(".alert-error").hide(); }, 3000);
						
					}
				}
			});
		
		}else{
         
        }

 }
	
/*** ADD COLOR ***/
$(document).ready(function() {
		
				   $(document).delegate(".add_color","click",function(){
					 
                    var color_name = $("#color_name").val();
					
					var form_data = new FormData(); 
					form_data.append('color_name', color_name);

					if(color()){
					
						$.ajax({
							url: 'ajax/add_color.php', // point to server-side PHP script 
							dataType: 'text',  // what to expect back from the PHP script, if anything
							cache: false,
							contentType: false,
							processData: false,
							data: form_data,                        
							type: 'post',
							success: function (result) {
							 //alert(result);return false;
							  if(result==1){
								  $("#cat_validation")[0].reset();
								  $(".error").hide();
								  $('.alert-success').show();
								  setTimeout(function() { $(".alert-success").hide(); }, 3000);
							  }else if (result==2){
								  $('.alert-error').show();
								  setTimeout(function() { $(".alert-error").hide(); }, 3000);
							  }else{
								  $("#cat_validation")[0].reset();
								  $(".error").hide();
								  $('.alert-error1').show();
								  setTimeout(function() { $(".alert-error1").hide(); }, 3000);
							  }
						    }
						});
				
					}
				
		});
		
	});
		
/*** ADD SIZE ***/
$(document).ready(function() {
		
				   $(document).delegate(".add_size","click",function(){
					 
                    var size = $("#size").val();
					
					var form_data = new FormData(); 
					form_data.append('size', size);

					if(sizeA()){
					   //alert();
						$.ajax({
							url: 'ajax/add_size.php', // point to server-side PHP script 
							dataType: 'text',  // what to expect back from the PHP script, if anything
							cache: false,
							contentType: false,
							processData: false,
							data: form_data,                        
							type: 'post',
							success: function (result) {
							 //alert(result);return false;
							  if(result==1){
								  $("#cat_validation")[0].reset();
								  $(".error").hide();
								  $('.alert-success').show();
								  setTimeout(function() { $(".alert-success").hide(); }, 3000);
							  }else if (result==2){
								  $('.alert-error').show();
								  setTimeout(function() { $(".alert-error").hide(); }, 3000);
							  }else{
								  $("#cat_validation")[0].reset();
								  $(".error").hide();
								  $('.alert-error1').show();
								  setTimeout(function() { $(".alert-error1").hide(); }, 3000);
							  }
						    }
						});
				
					}
				
		});
		
	});	
	
	
	/*** MESSAGE HIDE ***/
	
	    $(".close").click(function(){
			$(".alert-success").hide();
			$(".alert-success1").hide();
			$(".alert-error").hide();
			$(".alert-error1").hide();
			$(".alert-error2").hide();
			$(".alert-suspend").hide();
		});
	
	/*** CHANGE PASSWORD ***/
	
	$(document).ready(function() {
		$(document).delegate(".cpassword", "click", function(e) {
			
					var old = $('#oldp').val();
			        var pwd = $('#pwd').val();
			        var pwd2 = $('#pwd2').val();
					
					if(changePassword()){
       
				    $.ajax({
				    url: "ajax/change_password.php",
				    data: {old:old,pwd:pwd,pwd2:pwd2},
				    type: 'POST',
				    success: function (result) {
				    
						
					  //alert(result);return false;
					  
					  if(result==1){
						  $("#changep_validation")[0].reset();
						  $(".error").hide();
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); }, 3000);
					  }else if (result==2){
						  $('.alert-error1').show();
				          setTimeout(function() { $(".alert-error1").hide(); }, 3000);
					  }else if (result==0){
						  $('.alert-error2').show();
				          setTimeout(function() { $(".alert-error2").hide(); }, 3000);
					  }else{
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }
				}
				});
				
		        } else{
                 //alert('validation error');
				}				
		
        });
	});
	
	
	/*** ADD SHOP CATEGORY ***/
	$(document).ready(function() { // Man Category
		$(document).delegate(".man_category", "click", function(e) {
			
				var chkArray = [];
				$(".man:checked").each(function() {
					chkArray.push($(this).val());
				});
				
				var selected;
				selected = chkArray.join(',') ;
				var category_type = $("#cat_type").val();
				var shop_id = $("#shop_id").val();
				
				
				if(selected.length > 0){
					
				   $.ajax({
				   url: "ajax/shop_category.php",
				   data: {shop_id:shop_id,category_type:category_type,selected:selected},
				   type: 'POST',
				   success: function (result) {
					   
					   //alert(result);return false;
					  
					  if(result==1){
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); }, 3000);
					  }else if (result==2){
						  $('.alert-success1').show();
				          setTimeout(function() { $(".alert-success1").hide(); }, 3000);
					  }else{
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }
				    }
				    });
				
				}else{
					$('.alert-error1').show();
				    setTimeout(function() { $(".alert-error1").hide(); }, 3000);
				}
			
			
		});
	});
	
	$(document).ready(function() { //Woman Category
		$(document).delegate(".woman_category", "click", function(e) {
				var chkArray = [];
				
				$(".woman:checked").each(function() {
					chkArray.push($(this).val());
				});
				
				var selected;
				selected = chkArray.join(',') ;
				var category_type = $("#cat_types").val();
				var shop_id = $("#shop_id").val();
				
				
				if(selected.length > 0){
					
				   $.ajax({
				   url: "ajax/shop_category.php",
				   data: {shop_id:shop_id,category_type:category_type,selected:selected},
				   type: 'POST',
				   success: function (result) {
					  //alert(result);return false;
					  if(result==1){
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); }, 3000);
					  }else if (result==2){
						  $('.alert-success1').show();
				          setTimeout(function() { $(".alert-success1").hide(); }, 3000);
					  }else{
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }
				    }
				    });
				
				}else{
					$('.alert-error1').show();
				    setTimeout(function() { $(".alert-error1").hide(); }, 3000);
				}
			
			
		});
	});
	
	
	
/*** EDIT SHOP DETAILS ***/
$(document).ready(function() { 
	        $(document).delegate(".edit_shop_detail","click",function(){	
			
			    var shop_id = $("#shop_id").val();
			    var username = $("#username").val();
				var shopname = $("#shopname").val();
				var email = $("#email").val();
				var address = $("#locality").val();
				var mobile = $("#mobile").val();
				var type = $("#type").val();  
				var status = $("#status").val();
				var file = $('#file').prop('files')[0];
				var file1 = $("#file1").val();
				var price_rating = $("#price_rating").val();
				//alert(price_rating);return false;
				var form_data = new FormData();                  
					form_data.append('file', file);
					form_data.append('file1', file1);
					form_data.append('username', username);
                    form_data.append('shopname', shopname);	
                    form_data.append('email', email);	
                    form_data.append('address', address);	
                    form_data.append('mobile', mobile);	
                    form_data.append('type', type);	
                    form_data.append('status', status);	
                    form_data.append('shop_id', shop_id);	
                    form_data.append('price_rating', price_rating);	
                    

                 if(EditShopDetail()){
					 
				$.ajax({
						url: 'ajax/edit_shopdetail.php', // point to server-side PHP script 
						dataType: 'text',  // what to expect back from the PHP script, if anything
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,                        
						type: 'post',
						success: function (result) {
							//alert(result);return false;
							//$('.test').html(result);
						 if(result==1){
							  
							  $('.alert-success').show();
							  setTimeout(function() { $(".alert-success").hide(); location.reload();}, 3000);
						  }else{
							  $('.alert-error').show();
							  setTimeout(function() { $(".alert-error").hide(); }, 3000);
						  }
					    }
					});
					 
					 
				 }					 
			
            });
		
	});

/*** EDIT SHOP BASIC DETAILS ***/

$(document).ready(function() { 
	        $(document).delegate(".edit_shop_bdetail","click",function(){	
			
			    var facilities = $("#facilities").val();
			    var brand = $("#brand").val();
				var shop_id = $("#shop_id").val();
				
				var form_data = new FormData();                  
					form_data.append('facilities', facilities);
					form_data.append('brand', brand);
					form_data.append('shop_id', shop_id);
				
				 if(BasicShop()){
					 
					 $.ajax({
						url: 'ajax/edit_shopbasicdetail.php', // point to server-side PHP script 
						dataType: 'text',  // what to expect back from the PHP script, if anything
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,                        
						type: 'post',
						success: function (result) {
							//alert(result);return false;
							//$('.test').html(result);
						 if(result==1){
							  
							  $('.alert-success').show();
							  setTimeout(function() { $(".alert-success").hide();}, 3000);
						  }else{
							  $('.alert-error').show();
							  setTimeout(function() { $(".alert-error").hide(); }, 3000);
						  }
					    }
					});
					
				 }

			});
		
});
/*** Add Day & Time In Shop ***/
	$(document).ready(function() { 
        $(document).delegate(".day", "click", function(e) { // ADD OPEN DAY

	        var favorite = [];
            $.each($("input[name='day']:checked"), function(){            
                favorite.push($(this).val());
            });
	        var checked = favorite.join(",");
	        var action = 'days';
	        var shop_id = $("#shop_id").val();
			
			  $.ajax({
                type:'POST',
                url:'ajax/shop_daytime.php',
                data:{checked:checked,action:action,shop_id:shop_id},
                success:function(result){
					//alert(result);return false;
					
					  if(result==1){
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); }, 3000);
					  }else if (result==2){
						  $('.alert-success1').show();
				          setTimeout(function() { $(".alert-success1").hide(); }, 3000);
					  }else{
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }
                    
                }
            });
	        
        });
		
		
		$(document).delegate(".morning_time", "click", function(e) { // ADD MORNING TIME
	
	        var favorite = [];
            $.each($("input[name='morning']:checked"), function(){            
                favorite.push($(this).val());
            });
	        var checked = favorite.join(",");
	        var action = 'morning';
	        var shop_id = $("#shop_id").val();
			
			  $.ajax({
                type:'POST',
                url:'ajax/shop_daytime.php',
                data:{checked:checked,action:action,shop_id:shop_id},
                success:function(result){
					//alert(result);return false;
					
					  if(result==1){
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); }, 3000);
					  }else if (result==2){
						  $('.alert-success1').show();
				          setTimeout(function() { $(".alert-success1").hide(); }, 3000);
					  }else{
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }
                    
                }
            });
	        
        });
		
		$(document).delegate(".evening_time", "click", function(e) { // ADD EVENING TIME
	
	        var favorite = [];
            $.each($("input[name='evening']:checked"), function(){            
                favorite.push($(this).val());
            });
	        var checked = favorite.join(",");
	        var action = 'evening';
	        var shop_id = $("#shop_id").val();
			
			  $.ajax({
                type:'POST',
                url:'ajax/shop_daytime.php',
                data:{checked:checked,action:action,shop_id:shop_id},
                success:function(result){
					  if(result==1){
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); }, 3000);
					  }else if (result==2){
						  $('.alert-success1').show();
				          setTimeout(function() { $(".alert-success1").hide(); }, 3000);
					  }else{
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }
                    
                }
            });
	        
        });
		
		$(document).delegate(".night_time", "click", function(e) { // ADD NIGHT TIME
	
	        var favorite = [];
            $.each($("input[name='night']:checked"), function(){            
                favorite.push($(this).val());
            });
	        var checked = favorite.join(",");
	        var action = 'night';
	        var shop_id = $("#shop_id").val();
			
			  $.ajax({
                type:'POST',
                url:'ajax/shop_daytime.php',
                data:{checked:checked,action:action,shop_id:shop_id},
                success:function(result){
					  if(result==1){
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); }, 3000);
					  }else if (result==2){
						  $('.alert-success1').show();
				          setTimeout(function() { $(".alert-success1").hide(); }, 3000);
					  }else{
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }
                    
                }
            });
	        
        });


});
	
/*** Add Banner ***/

$(document).ready(function() { 
	        $(document).delegate(".add_banner","click",function(){	
			
				var file = $('#file').prop('files')[0];
				
				var form_data = new FormData();                  
					form_data.append('file', file);
				
                 if(AddBanner()){
					 
				$.ajax({
						url: 'ajax/add_banner.php', // point to server-side PHP script 
						dataType: 'text',  // what to expect back from the PHP script, if anything
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,                        
						type: 'post',
						success: function (result) {
							//alert(result);return false;
							//$('.test').html(result);
						 if(result==1){
							  
							  $('.alert-success').show();
							  setTimeout(function() { $(".alert-success").hide(); location.reload();}, 3000);
						  }else{
							  $('.alert-error').show();
							  setTimeout(function() { $(".alert-error").hide(); }, 3000);
						  }
					    }
					});
					 
					 
				 }					 
			
            });
	});
	
	/*** Edit Appointment ***/	
$(document).ready(function() { 
	        $(document).delegate(".edit_order","click",function(){
				
                    var aid = $("#aid").val();
                    var ptype = $("#ptype").val();
                    var status = $("#status").val();
                    
					var form_data = new FormData();                  
					form_data.append('aid', aid);
					form_data.append('ptype', ptype);
					form_data.append('status', status);
					
					$.ajax({
					url: 'ajax/edit_order.php', // point to server-side PHP script 
					dataType: 'text',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                        
					type: 'post',
				    success: function (result) {
						//alert(result);return false;
					//	$(".test").show();return false;
					 if(result==1){
						  $("#sub_cat_validation")[0].reset();
						  $('.alert-success').show();
				          setTimeout(function() { $(".alert-success").hide(); location.reload();}, 3000);
					  }else if(result==2){
						  $('.alert-error').show();
				          setTimeout(function() { $(".alert-error").hide(); }, 3000);
					  }else{
						  $('.alert-error1').show();
				          setTimeout(function() { $(".alert-error1").hide(); }, 3000);
					  }
				}
				});
			
				
				
		});
		
	});
	

/*** only Enter Numeric Value ***/
$(document).ready(function(){
    $('#mobile').keypress(validateNumbers);
    $('#product_price').keypress(validateNumbers);
    $('#product_sprice').keypress(validateNumbers);
    $('#product_quantity').keypress(validateNumbers);
    
});

function validateNumbers(event) {
    var key = window.event ? event.keyCode : event.which;
    if (event.keyCode === 8 || event.keyCode === 46) {
        return true;
    } else if ( key < 48 || key > 57 ) {
        return false;
    } else {
    	return true;
    }
};	

	