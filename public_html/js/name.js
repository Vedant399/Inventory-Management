$(document).ready(function(){
	var DOMAIN = "http://localhost/InventoryManagement/public_html"
  //alert('Hello');
  $("#register_form").submit(function(){
  	// alert("HI");
  	var status = false;
  	var name = $("#username").val();
  	var email= $("#email").val();
  	var password= $("#password").val();
  	var repassword= $("#repassword").val();
  	var usertype= $("#usertype").val();

  	// var n_patt = new RegExp(/^[A-Za-z _]+$/);
	 	// vedantmehta25001@gmail.com
	var email_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
	var pass_patt = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
	// alert(email_patt.test(email));
	if(name == "" || name.length < 6)
 	{
 		$("#username").addClass("border-danger");
 		$("#u_error").html("<span class='text-danger'>Please Enter Name and Name Length should be more than 6 charecters</span>");
 		status=false;
 	}
 	else
 	{
 		$("#username").removeClass("border-danger");
 		$("#u_error").html("");
 		status=true;
 	}
 	if(!email_patt.test(email))
 	{
 		$("#email").addClass("border-danger");
 		$("#e_error").html("<span class='text-danger'>Please Enter valid Email Address ex xyz@abc.com</span>");
 		status=false;
 	}
 	else
 	{
 		$("#email").removeClass("border-danger");
 		$("#e_error").html("");
 		status=true;
 	}
 	if(password== "" || !(pass_patt.test(password)))
 	{
 		$("#password").addClass("border-danger");
 		$("#p_error").html("<span class='text-danger'>Please Enter Strong Password</span>");
 		status=false;
 	}
 	else
 	{
 		$("#password").removeClass("border-danger");
 		$("#p_error").html("");
 		status=true;
 	}
 	if(repassword== "")
 	{
 		$("#repassword").addClass("border-danger");
 		$("#rp_error").html("<span class='text-danger'>Please Enter Password</span>");
 		status=false;
 	}
 	else
 	{
 		$("#repassword").removeClass("border-danger");
 		$("#rp_error").html("");
 		status=true;
 	}
 	if(usertype == "")
 	{
 		$("#usertype").addClass("border-danger");
 		$("#t_error").html("<span class='text-danger'>Please Choose User Type</span>");
 		status=false;
 	}
 	else
 	{
 		$("#usertype").removeClass("border-danger");
 		$("#t_error").html("");
 		status=true;
 	}
 	if (password != repassword)
 	{
 		$("#repassword").addClass("border-danger");
 		$("#password").addClass("border-danger");
 		$("#rp_error").html("<span class='text-danger'>Password Doesn't Match</span>");
 		$("#p_error").html("<span class='text-danger'>Password Doesn't Match</span>");
 		status=false;
 	}
 	else
 	{
 		$("#repassword").removeClass("border-danger");
 		$("#password").removeClass("border-danger");
 		$("#rp_error").html("");
 		$("#p_error").html("");
 		if(status == true)
 		{
	 		$.ajax({
	 			url: DOMAIN+"/includes/process.php",
	 			method:"POST",
	 			data: $("#register_form").serialize(),
	 			success: function(data)
	 			{
	 				if(data == "Email_Already_Exist")
	 				{
	 					alert("This Email Is already Used");
	 				}
	 				else
	 				{
	 					if(data == "Some_Error")
	 					{
	 						alert("Please Try Again something went wrong")
	 					}
	 					else
	 					{
	 						window.location.href=encodeURI(DOMAIN + "/index.php?msg=You are registerd Now you can Login");
	 					}
	 				}
	 			}
	 		});
 		}
 	}
  })


  // for login part


$("#login_form").submit(function(){
	var status = false;
	var email = $("#email").val();
	var password = $("#password").val();
	var email_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);
	if(!email_patt.test(email))
 	{
 		$("#email").addClass("border-danger");
 		$("#e_error").html("<span class='text-danger'>Please Enter valid Email Address ex xyz@abc.com</span>");
 		status=false;
 	}
 	else
 	{
 		$("#email").removeClass("border-danger");
 		$("#e_error").html("");
 		status=true;
 	}
 	if(password== "")
 	{
 		$("#password").addClass("border-danger");
 		$("#p_error").html("<span class='text-danger'>Please Enter Password</span>");
 		status=false;
 	}
 	else
 	{
 		$("#password").removeClass("border-danger");
 		$("#p_error").html("");
 		status=true;
 	}
 	if(status ==true)
 	{
 		alert("reached");
 		// alert("ready");
 		$.ajax({
 			url: DOMAIN + "/includes/process.php",
 			method:"POST",
 			data:$("#login_form").serialize(),
 			success : function(data){
 				if(data == "Please Register")
 				{
 					window.location.href=encodeURI(DOMAIN + "/register.php?msg=You aren't registerd So Please Register First");
 				}
 				else
 				{
 					if(data == "Password Doesn't match")
 					{
 						$("#password").addClass("border-danger");
 						$("#p_error").html("<span class='text-danger'>Please Enter Correct Password</span>");
 					}
 					else
 					{
 						window.location.href=encodeURI(DOMAIN + "/dashboard.php");
 					}
 				}
 			}
 		})
 	}
})

//for adding category
fetch_category();
function fetch_category(){
	$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		data:{getCategory:1},
		success: function(data){
			var root="<option value='0'>Root</option>"
			var choose="<option value=''>Choose Product Category</option>"
			$("#parent_cat").html(root+data);
			$("#select_cat").html(choose+data);
		}
	})
}
fetch_brand();
function fetch_brand(){
	$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		data:{getBrand:1},
		success: function(data){
			var choose="<option value=''>Choose Product Brand</option>"
			$("#select_brand").html(choose+data);
		}
	})
}

// for adding category

$("#add_category_form").off('submit').on('submit',function(){
	var category= $("#category_name").val();
	var parent_cat= $("#parent_cat").val();
	var status = false;
	if(category== "")
 	{
 		$("#category_name").addClass("border-danger");
 		$("#cat_error").html("<span class='text-danger'>Please Enter Password</span>");
 		status=false;
 	}
 	else
 	{
 		$("#category_name").removeClass("border-danger");
 		$("#cat_error").html("");
 		status=true;
 	}
 	if(status == true)
 	{
 		$.ajax({
 			url:DOMAIN+"/includes/process.php",
 			method:"POST",
 			data:$("#add_category_form").serialize(),
 			success:function(data){
 				if(data == "CATEGORY_ADDED")
 				{
 					$("#category_name").removeClass("border-danger");
 					$("#category_name").val("");
			 		$("#cat_error").html("<span class='text-success'>Category added successfully</span>");
			 		status=true;
			 		window.location.href=encodeURI(DOMAIN + "/dashboard.php?msg=Category "+category+" Added Successfully&category=success");
 				}
 				else
 				{
 					window.location.href=encodeURI(DOMAIN + "/dashboard.php?msg=Something Went Wrong Please Try Again&category=danger");
 				}
 			}
 		})
 	}

})




// for adding brand

$("#add_brand_form").off('submit').on('submit',function()
{
	var brand= $("#brand_name").val();
	var status=true;
	if(brand == "")
 	{
 		$("#brand_name").addClass("border-danger");
 		$("#brand_error").html("<span class='text-danger'>Please Enter Brand Name</span>");
 		status=false;
 	}
 	else
 	{
 		$.ajax({
 			url:DOMAIN+"/includes/process.php",
 			method:"POST",
 			data:$("#add_brand_form").serialize(),
 			success:function(data){
 				if (data == "BRAND_ADDED")
 				{
 					$("#brand_name").removeClass("border-danger");
					$("#brand_name").val("");
		 			$("#brand_error").html("<span class='text-success'>Brand added successfully</span>");
		 			window.location.href=encodeURI(DOMAIN + "/dashboard.php?msg=Brand "+brand+" Added Successfully&category=success");
 				}
 				else
 				{
 					$("#brand_name").addClass("border-danger");
 					$("#brand_error").html("<span class='text-danger'>Something went wrong please try again</span>");
 					window.location.href=encodeURI(DOMAIN + "/dashboard.php?msg=Something Went Wrong Please Try Again&category=danger");
 				}
 				
 			}
 		})
 	}


})


$("#add_product_form").off('submit').on('submit',function(){
	var product_name=$("#product_name").val();
	var added_date=$("#added_date").val();
	var select_cat=$("#select_cat").val();
	var select_brand=$("#select_brand").val();
	var product_price=$("#product_price").val();
	var product_qty=$("#product_qty").val();
	var status=false;
	if(product_name == "")
 	{
 		$("#product_name").addClass("border-danger");
 		$("#name_error").html("<span class='text-danger'>Please Enter Product Name</span>");
 		status=false;
 	}
 	else
 	{
 		$("#product_name").removeClass("border-danger");
 		$("#name_error").html("");
 		status=true;
 	}if(product_price == "")
 	{
 		$("#product_price").addClass("border-danger");
 		$("#price_error").html("<span class='text-danger'>Please Enter Product Price</span>");
 		status=false;
 	}
 	else
 	{
 		$("#product_price").removeClass("border-danger");
 		$("#price_error").html("");
 		status=true;
 	}if(product_qty == "")
 	{
 		$("#product_qty").addClass("border-danger");
 		$("#qty_error").html("<span class='text-danger'>Please Enter Product Quantity</span>");
 		status=false;
 	}
 	else
 	{
 		$("#product_qty").removeClass("border-danger");
 		$("#qty_error").html("");
 		status=true;
 	}if(select_cat == "")
 	{
 		$("#select_cat").addClass("border-danger");
 		$("#cat_error").html("<span class='text-danger'>Please Enter Product Category</span>");
 		status=false;
 	}
 	else
 	{
 		$("#select_cat").removeClass("border-danger");
 		$("#cat_error").html("");
 		status=true;
 	}if(select_brand == "")
 	{
 		$("#select_brand").addClass("border-danger");
 		$("#brand_error").html("<span class='text-danger'>Please Enter Product Brand</span>");
 		status=false;
 	}
 	else
 	{
 		$("#select_brand").removeClass("border-danger");
 		$("#brand_error").html("");
 		status=true;
 	}
	if(status==true)
	{
		$.ajax({
		url: DOMAIN + "/includes/process.php",
		method: "POST",
		data:$("#add_product_form").serialize(),
		success : function(data){
			$("#product_name").removeClass("border-danger");
			$("#product_name").val("");
 			$("#name_error").html("");
 			$("#product_price").removeClass("border-danger");
 			$("#product_price").val("");
	 		$("#price_error").html("");
	 		$("#product_qty").removeClass("border-danger");
	 		$("#product_qty").val("");
	 		$("#qty_error").html("");
	 		$("#select_cat").removeClass("border-danger");
	 		$("#select_cat").val("");
	 		$("#cat_error").html("");
	 		$("#select_brand").removeClass("border-danger");
	 		$("#select_brand").val("");
	 		$("#brand_error").html("");
			if(data == "PRODUCT_ADDED")
			{
				window.location.href=encodeURI(DOMAIN + "/dashboard.php?msg=Product "+product_name+" Added Successfully&category=success");
			}
			else
			{
				window.location.href=encodeURI(DOMAIN + "/dashboard.php?msg=Something Went Wrong Please Try Again&category=danger");
			}
		}
	})
	}
})

$("#product_add_modal_button").click(function(){

	const now = new Date();
	$("#added_date").val(now.getFullYear()+"-"+(now.getMonth()+1)+"-"+now.getDate()+" "+now.getHours()+":"+now.getMinutes()+":"+now.getSeconds());
})
$("#product_manage_modal_button").click(function(){

	const now = new Date();
	$("#added_date").val(now.getFullYear()+"-"+(now.getMonth()+1)+"-"+now.getDate()+" "+now.getHours()+":"+now.getMinutes()+":"+now.getSeconds());
})

$("#dashboard_close").click(function(){

	window.location.href=encodeURI(DOMAIN + "/dashboard.php");
})
$("#manage_category_close").click(function(){

	window.location.href=encodeURI(DOMAIN + "/manage_categories.php");
})
$("#manage_brands_close").click(function(){

	window.location.href=encodeURI(DOMAIN + "/manage_brands.php");
})
$("#manage_products_close").click(function(){

	window.location.href=encodeURI(DOMAIN + "/manage_products.php");
})
$('#example').DataTable();

deleteCat()
function deleteCat(){
$(".delete_cat").on("click",function(){
	var did =$(this).attr("did");
	alert(did);
	if(confirm("Are You Sure ? You Want to Delete ...!") == true)
	{
		$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		data:{deleteCategory:1,id:did},
		success: function(data){
			if(data == "DEPENDENT_CATEGORY")
			{
				alert(data);
				window.location.href=encodeURI(DOMAIN + "/manage_categories.php?msg=You Cannot Delete this Category as Categories are dependent on this &category=warning");
			}
			else
			{
				alert(data);
				window.location.href=encodeURI(DOMAIN + "/manage_categories.php?msg=Category Deleted Successfully&category=success");
			}
		}
	})
	}
	else
	{
	}
})	
}

$(".delete_brand").off("click").on("click",function(){
	var did =$(this).attr("did");
	if(confirm("Are You Sure ? You Want to Delete ...!") == true)
	{
		$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		data:{deleteBrand:1,id:did},
		success: function(data){
			if(data != "DELETED")
			{
				if (data == "Cannot delete or update a parent row: a foreign key constraint fails (`project_inventory_management`.`products`, CONSTRAINT `products_ibfk_2` FOREIGN KEY (`bid`) REFERENCES `brands` (`bid`))") {
					window.location.href=encodeURI(DOMAIN + "/manage_brands.php?msg=You cannot delete this brand as you hav product of this brand in stock&category=warning");
				}
				window.location.href=encodeURI(DOMAIN + "/manage_brands.php?msg=Something Went Wrong Please Try Again&category=danger");
			}
			else
			{
				alert(data);
				window.location.href=encodeURI(DOMAIN + "/manage_brands.php?msg=Brand Deleted Successfully&category=success");
			}
		}
	})
	}
	else
	{
	}
})
$(".delete_product").off("click").on("click",function(){
	var did =$(this).attr("did");
	if(confirm("Are You Sure ? You Want to Delete ...!") == true)
	{
		$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		data:{deleteProduct:1,id:did},
		success: function(data){
			if(data != "DELETED")
			{
				window.location.href=encodeURI(DOMAIN + "/manage_products.php?msg=Something Went Wrong Please Try Again&category=danger");
			}
			else
			{
				alert(data);
				window.location.href=encodeURI(DOMAIN + "/manage_products.php?msg=Product Deleted Successfully&category=success");
			}
		}
	})
	}
	else
	{
	}
})
$("#delete_cat").click(function(){
	alert("hello");
})

})