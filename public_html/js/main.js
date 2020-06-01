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
 	// alert(status);
 	if(status ==true)
 	{
 		alert("reached");
 		// alert("ready");
 		$.ajax({
 			url: DOMAIN + "/includes/process.php",
 			method:"POST",
 			data:$("#login_form").serialize(),
 			success : function(data){
 				// alert(data);
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
 		$("#cat_error").html("<span class='text-danger'>Please Enter Category Name</span>");
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
			 		window.location.href=encodeURI(DOMAIN + "/manage_categories.php?msg=Category "+category+" Added Successfully&category=success");
 				}
 				else
 				{
 					window.location.href=encodeURI(DOMAIN + "/manage_categories.php?msg=Something Went Wrong Please Try Again&category=danger");
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
		 			window.location.href=encodeURI(DOMAIN + "/manage_brands.php?msg=Brand "+brand+" Added Successfully&category=success");
 				}
 				else
 				{
 					$("#brand_name").addClass("border-danger");
 					$("#brand_error").html("<span class='text-danger'>Something went wrong please try again</span>");
 					window.location.href=encodeURI(DOMAIN + "/manage_brands.php?msg=Something Went Wrong Please Try Again&category=danger");
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
		$("#add_product").html(
        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Adding...`
      );
		
		$.ajax({
		url: DOMAIN + "/includes/process.php",
		method: "POST",
		data:$("#add_product_form").serialize(),
		success : function(data){
			$("#add_product").html(
       		 
     		 );
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
				setTimeout(() => {  window.location.href=encodeURI(DOMAIN + "/manage_products.php?msg=Product "+product_name+" Added Successfully&category=success"); }, 1000);
			}
			else
			{
				window.location.href=encodeURI(DOMAIN + "/manage_products.php?msg=Something Went Wrong Please Try Again&category=danger");
			}
		}
	})
	}
})

$("#product_add_modal_button").click(function(){

	const now = new Date();
	$("#added_date").val(now.getDate()+"-"+(now.getMonth()+1)+"-"+now.getFullYear());
})
$("#product_manage_modal_button").click(function(){

	const now = new Date();
	$("#added_date").val(now.getDate()+"-"+(now.getMonth()+1)+"-"+now.getFullYear());
})

$("#dashboard_close").click(function(){

	window.location.href=encodeURI(DOMAIN + "/dashboard.php");
})

$("#manage_invoice_close").click(function(){

	window.location.href=encodeURI(DOMAIN + "/manage_invoices.php");
})
$("#customer_manage_close").click(function(){

	window.location.href=encodeURI(DOMAIN + "/manage_customer.php");
})
$("#supplier_manage_close").click(function(){

	window.location.href=encodeURI(DOMAIN + "/manage_suppliers.php");
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
$('#example_category').DataTable();
$('#example_brand').DataTable();
$('#example_product').DataTable();
$('#example_orders').DataTable();
$('#example_purchase').DataTable();
$('#example_invoices').DataTable();
$('#example_payments').DataTable();
$('#example_supplier').DataTable();


$('#example_customer').DataTable();


function fetch_category_update($not_id){
	$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		data:{getCategory:1,id:$not_id},
		success: function(data){
			var root="<option value='0'>Root</option>"
			$("#parent_cat_update").html(root+data);
		}
	})
}
$("#category_table").undelegate("click").delegate(".edit_cat","click",function(){
	var eid =$(this).attr("eid");
	fetch_category_update(eid);
	// alert(eid);
	if(true)
	{
		$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		dataType: "json",
		data:{editCategory:1,id:eid},
		success: function(data){
		$("#cid").val(data["cid"]);
		$("#category_name_update").val(data["category_name"]);
		if (data["status"]==1)
		{
			$("input[name='status'][value='1']").prop('checked', true);
		}
		else
		{
			$("input[name='status'][value='0']").prop('checked', true);
		}
		
		$("#parent_cat_update").val(data["parent_cat"]);
		}
	})
	}
	else
	{
	}
})


// update category

$("#update_category_form").off("submit").on("submit",function(){
	var cid=$("#cid").val();
	var category_name=$("#category_name_update").val();
	var parent_cat = $("#parent_cat_update").val();
	var status=0;
	var status_check=false;
	if($("#status1").is(":checked"))
	{
		status=1;
	}
	if(category_name == "")
 	{
 		$("#category_name_update").addClass("border-danger");
 		$("#cat_error_update").html("<span class='text-danger'>Please Enter Category Name</span>");
 		status_check=false;
 	}
 	else
 	{
 		$("#category_name_update").removeClass("border-danger");
 		$("#cat_error").html("");
 		status_check=true;
 	}
	if(status_check==true)
	{
		$.ajax({
		url:DOMAIN+"/includes/process.php",
		method:"POST",
		data:$("#update_category_form").serialize(),
		success:function(data){
			if(data == "CATEGORY_EDITTED")
			{
				window.location.href=encodeURI(DOMAIN + "/manage_categories.php?msg=Category "+category_name+" Editted Successfully&category=success");
			}
			else
			{
				window.location.href=encodeURI(DOMAIN + "/manage_categories.php?msg=Something Went Wrong Please Try Again&category=danger");
			}
		}
	})
	}
})


$("#example_category").undelegate("click").delegate(".delete_cat","click",function(){
	var did =$(this).attr("did");
	if(confirm("Are You Sure ? You Want to Delete ...!") == true)
	{
		$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		data:{deleteCategory:1,id:did},
		success: function(data){
			if(data == "DEPENDENT_CATEGORY")
			{
				window.location.href=encodeURI(DOMAIN + "/manage_categories.php?msg=You Cannot Delete this Category as Categories are dependent on this &category=warning");
			}
			else
			{
				if (data == "Cannot delete or update a parent row: a foreign key constraint fails (`project_inventory_management`.`products`, CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `categories` (`cid`))")
				{
					window.location.href=encodeURI(DOMAIN + "/manage_categories.php?msg=This Category Cannot be deleted as you have product of this category in stock&category=warning");
				}
				else
				{
					window.location.href=encodeURI(DOMAIN + "/manage_categories.php?msg=Category Deleted Successfully&category=success");
				}
			}
		}
	})
	}
	else
	{
	}
})	

$("#manage_brand").undelegate("click").delegate(".delete_brand","click",function(){
	var did =$(this).attr("did");
	// alert(did);
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
				window.location.href=encodeURI(DOMAIN + "/manage_brands.php?msg=Brand Deleted Successfully&category=success");
			}
		}
	})
	}
	else
	{
	}
})
$("#example_brand").undelegate("click").delegate(".edit_brand","click",function(){
	var eid =$(this).attr("eid");
	//alert(eid);
	if(true)
	{
		$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		data:{editBrand:1,id:eid},
		success: function(data){
			data=$.parseJSON(data);
			// console.log(data["bid"]);
			$("#bid").val(data["bid"]);
			$("#brand_name_update").val(data["brand_name"]);
			if (data["status"]==1)
		{
			$("input[name='status_brand'][value='1']").prop('checked', true);
		}
		else
		{
			$("input[name='status_brand'][value='0']").prop('checked', true);
		}
		
		}
	})
	}
	else
	{
	}
})
$("#update_brand_form").off("submit").on("submit",function(){
	var brand= $("#brand_name_update").val();
	var status=true;
	if(brand == "")
 	{
 		$("#brand_name_update").addClass("border-danger");
 		$("#brand_error_update").html("<span class='text-danger'>Please Enter Brand Name</span>");
 		status=false;
 	}
 	else{
 		$("#brand_name_update").removeClass("border-danger");
 		$("#brand_error_update").html("");
 		$.ajax({
 			url:DOMAIN+"/includes/process.php",
 			method:"POST",
			data:$("#update_brand_form").serialize(),
			success:function(data)
			{
				if(data == "BRAND_EDITTED")
				{
					window.location.href=encodeURI(DOMAIN + "/manage_brands.php?msg=Brand "+brand+" Editted Successfully&category=success");
				}
				else
				{
					window.location.href=encodeURI(DOMAIN + "/manage_brands.php?msg=Something Went Wrong Please Try Again&category=danger");
				}
			}
 		})
 	}
})
$('#example_product').undelegate("click").delegate(".delete_product","click",function(){
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


function fetch_category_update_product(){
	$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		data:{getCategory:1},
		success: function(data){
			$("#select_cat_update").html(data);
		}
	})
}
function fetch_brand_update_product(){
	$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		data:{getBrand:1},
		success: function(data){
			$("#select_brand_update").html(data);
		}
	})
}
$('#product_body').undelegate("click").delegate(".edit_product","click",function(){
	var eid = $(this).attr("eid");
	fetch_category_update_product();
	fetch_brand_update_product();
	$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		dataType: "json",
		data:{editProduct:1,id:eid},
		success: function(data){
			console.log(data);
			$("#pid").val(data["pid"]);
			$("#product_name_update").val(data["product_name"]);
			if (data["p_status"]==1)
			{
				$("input[name='status_product'][value='1']").prop('checked', true);
			}
			else
			{
				$("input[name='status_product'][value='0']").prop('checked', true);
			}
			//$newDate = date("d-m-Y", strtotime(a));
			var date    = new Date(data["added_date"]),
		    yr      = date.getFullYear(),
		    month   = date.getMonth() < 10 ? '0' + (parseInt(date.getMonth())+1) : (parseInt(date.getMonth())+1),
		    day     = date.getDate()  < 10 ? '0' + date.getDate()  : date.getDate(),
		    newDate = day + '-' + month + '-' + yr;
			$("#added_date_update").val(newDate);
			$("#select_cat_update").val(data["cid"]);
			$("#select_brand_update").val(data["bid"]);
			$("#product_price_update").val(data["product_price"]);
			$("#product_qty_update").val(data["product_stock"]);
		}
	})
})


$("#update_product_form").off("submit").on("submit",function(){
	var product_name=$("#product_name_update").val();
	var added_date=$("#added_date").val();
	var select_cat=$("#select_cat_update").val();
	var select_brand=$("#select_brand_update").val();
	var product_price=$("#product_price_update").val();
	var product_qty=$("#product_qty_update").val();
	var status=false;
	if(product_name == "")
 	{
 		$("#product_name_update").addClass("border-danger");
 		$("#name_error_update").html("<span class='text-danger'>Please Enter Product Name</span>");
 		status=false;
 	}
 	else
 	{
 		$("#product_name_update").removeClass("border-danger");
 		$("#name_error_update").html("");
 		status=true;
 		if(product_price == "")
	 	{
	 		$("#product_price_update").addClass("border-danger");
	 		$("#price_error_update").html("<span class='text-danger'>Please Enter Product Price</span>");
	 		status=false;
	 	}
	 	else
	 	{
	 		$("#product_price_update").removeClass("border-danger");
	 		$("#price_error_update").html("");
	 		status=true;
	 		if(product_qty == "")
		 	{
		 		$("#product_qty_update").addClass("border-danger");
		 		$("#qty_error_update").html("<span class='text-danger'>Please Enter Product Quantity</span>");
		 		status=false;
	 		}
		 	else
		 	{
		 		$("#product_qty_update").removeClass("border-danger");
		 		$("#qty_error_update").html("");
		 		status=true;
		 		if(select_cat == "")
			 	{
			 		$("#select_cat").addClass("border-danger");
			 		$("#cat_error_update_product").html("<span class='text-danger'>Please Enter Product Category</span>");
			 		status=false;
			 	}
			 	else
			 	{
			 		$("#select_cat_update").removeClass("border-danger");
			 		$("#cat_error_update_product").html("");
			 		status=true;
			 		if(select_brand == "")
				 	{
				 		$("#select_brand_update").addClass("border-danger");
				 		$("#brand_error_update_product").html("<span class='text-danger'>Please Enter Product Brand</span>");
				 		status=false;
				 	}
			 		else
				 	{
				 		$("#select_brand_update").removeClass("border-danger");
				 		$("#brand_error_update_product").html("");
				 		status=true;
				 	}
			 	}
 			}
 		}
 	}
	if(status==true)
	{
		// alert("HELLO");
		$.ajax({
		url:DOMAIN+"/includes/process.php",
		method:"POST",
		data:$("#update_product_form").serialize(),
		success:function(data){
			if(data == "PRODUCT_EDITTED")
			{
				//alert(data);
				window.location.href=encodeURI(DOMAIN + "/manage_products.php?msg=Product "+product_name+" Editted Successfully&category=success");
			}
			else
			{
				//alert(data);
				window.location.href=encodeURI(DOMAIN + "/manage_products.php?msg=Something Went Wrong Please Try Again&category=danger");
			}
		}
	})
	}
})

$('#customer_add_form').off("submit").on("submit",function(){
	// alert("hello");
	var name = $("#customer_name_1").val();
	alert(name);
	var gst = $("#gst_no").val();
	var mobile = $("#mobile_no").val();
	var address = $("#address_1").val();
	var status=false;
	if (name == "")
	{
		alert(name);
		$("#customer_name_1").addClass("border-danger");
		$("#cust_name_error").html("<span class = text-danger>Please Enter Name</span>");
		status=false;
	}
	else
	{
		$("#customer_name_1").removeClass("border-danger");
		$("#cust_name_error").html("");
		status=true;
		if (gst == "")
		{
			$("#gst_no").addClass("border-danger");
			$("#gst_error").html("<span class = text-danger>Please Enter GST NO</span>");
			status=false;
		}
		else
		{
			$("#gst_no").removeClass("border-danger");
			$("#gst_error").html("");
			status=true;
			if (mobile == "" || mobile.length !=10)
			{
				$("#mobile_no").addClass("border-danger");
				$("#mob_error").html("<span class = text-danger>Please Enter Valid Phone Number</span>");
				status=false;
			}
			else
			{
				$("#mobile_no").removeClass("border-danger");
				$("#mob_error").html("");
				status=true;
				if (address == ""){
					$("#address").addClass("border-danger");
					$("#add_error").html("<span class = text-danger>Please Enter Address</span>");
					status=false;
				}
				else
				{
					$("#address").removeClass("border-danger");
					$("#add_error").html("");
					status=true;
				}	
			}
		}
	}
	if (status == true)
	{
		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method:"POST",
			data:$("#customer_add_form").serialize(),
			success:function(data)
			{
				if (data == "CUSTOMER_ADDED")
				{
					window.location.href=encodeURI(DOMAIN + "/manage_customer.php?msg=Customer "+name+" Added Successfully&category=success");
				}
				else
				{
					alert(data);
					window.location.href=encodeURI(DOMAIN + "/manage_customer.php?msg=Something Went Wrong Please Try Again&category=danger");
				}
			}
		})
	}
	// console.log($("#customer_add_form").serialize());
	// console.log("Hello");
})


$('#example_customer').delegate(".edit_cust","click",function(){
	var eid = $(this).attr("eid");
	// alert(eid);
	$.ajax({
		url:DOMAIN+"/includes/process.php",
		method:"POST",
		dataType:"json",
		data:{getCompany:1,id:eid},
		success:function(data){
			console.log(data);
			$("#company_id").val(data["id"]);
			$("#customer_name_update").val(data["company_name"]);
			$("#gst_no_update").val(data["gst"]);
			$("#mobile_no_update").val(data["mobile"]);
			$("#address_update").val(data["address"]);
			$("#email_update").val(data["email"]);
			$("#city_update").val(data["city"]);
		}
	})
})

$('#example_supplier').delegate(".edit_supplier","click",function(){
	var eid = $(this).attr("eid");
	// alert(eid);
	$.ajax({
		url:DOMAIN+"/includes/process.php",
		method:"POST",
		dataType:"json",
		data:{getSupplier:1,id:eid},
		success:function(data){
			console.log(data);
			$("#supplier_id").val(data["id"]);
			$("#supplier_name_update").val(data["supplier_name"]);
			$("#supplier_gst_no_update").val(data["supplier_gst"]);
			$("#supplier_mobile_no_update").val(data["supplier_mobile"]);
			$("#supplier_address_update").val(data["supplier_address"]);
			$("#supplier_email_update").val(data["supplier_email"]);
			$("#supplier_city_update").val(data["supplier_city"]);
		}
	})
})

$("#customer_update_form").off('submit').on('submit',function(){
	var id = parseInt($("#company_id").val());
	var name = $("#customer_name_update").val();
	var gst = $("#gst_no_update").val();
	var mobile = $("#mobile_no_update").val();
	var address = $("#address_update").val();
	var status=false;
	if (name == "")
	{
		$("#customer_name_update").addClass("border-danger");
		$("#cust_name_error_update").html("<span class = text-danger>Please Enter Name</span>");
		status=false;
	}
	else
	{
		$("#customer_name_update").removeClass("border-danger");
		$("#cust_name_error_update").html("");
		status=true;
		if (gst == "")
		{
			$("#gst_no_update").addClass("border-danger");
			$("#gst_error_update").html("<span class = text-danger>Please Enter GST NO</span>");
			status=false;
		}
		else
		{
			$("#gst_no_update").removeClass("border-danger");
			$("#gst_error_update").html("");
			status=true;
			if (mobile == "" || mobile.length !=10)
			{
				$("#mobile_no_update").addClass("border-danger");
				$("#mob_error_update").html("<span class = text-danger>Please Enter Valid Phone Number</span>");
				status=false;
			}
			else
			{
				$("#mobile_no_update").removeClass("border-danger");
				$("#mob_error_update").html("");
				status=true;
				if (address == ""){
					$("#address_update").addClass("border-danger");
					$("#add_error_update").html("<span class = text-danger>Please Enter Address</span>");
					status=false;
				}
				else
				{
					$("#address_update").removeClass("border-danger");
					$("#add_error_update").html("");
					status=true;
				}	
			}
		}
	}
	if (status == true)
	{
		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method:"POST",
			data:$("#customer_update_form").serialize(),
			success:function(data){
				if (data == "CUSTOMER_EDITTED")
				{
					window.location.href=encodeURI(DOMAIN + "/manage_customer.php?msg=Customer "+name+" Editted Successfully&category=success");
				}
				else
				{
					alert(data);
					window.location.href=encodeURI(DOMAIN + "/manage_customer.php?msg=Something Went Wrong Please Try Again&category=danger");
				}
			}
		})
	}
})

$("#supplier_update_form").off('submit').on('submit',function(){
	var id = parseInt($("#supplier_id").val());
	var name = $("#supplier_name_update").val();
	var gst = $("#supplier_gst_no_update").val();
	var mobile = $("#supplier_mobile_no_update").val();
	var address = $("#supplier_address_update").val();
	var status=false;
	if (name == "")
	{
		$("#supplier_name_update").addClass("border-danger");
		$("#supplier_name_error_update").html("<span class = text-danger>Please Enter Name</span>");
		status=false;
	}
	else
	{
		$("#supplier_name_update").removeClass("border-danger");
		$("#supplier_name_error_update").html("");
		status=true;
		if (gst == "")
		{
			$("#supplier_gst_no_update").addClass("border-danger");
			$("#supplier_gst_error_update").html("<span class = text-danger>Please Enter GST NO</span>");
			status=false;
		}
		else
		{
			$("#supplier_gst_no_update").removeClass("border-danger");
			$("#supplier_gst_error_update").html("");
			status=true;
			if (mobile == "" || mobile.length !=10)
			{
				$("#supplier_mobile_no_update").addClass("border-danger");
				$("#supplier_mob_error_update").html("<span class = text-danger>Please Enter Valid Phone Number</span>");
				status=false;
			}
			else
			{
				$("#supplier_mobile_no_update").removeClass("border-danger");
				$("#supplier_mob_error_update").html("");
				status=true;
				if (address == ""){
					$("#supplier_address_update").addClass("border-danger");
					$("#supplier_add_error_update").html("<span class = text-danger>Please Enter Address</span>");
					status=false;
				}
				else
				{
					$("#supplier_address_update").removeClass("border-danger");
					$("#supplier_add_error_update").html("");
					status=true;
				}	
			}
		}
	}
	if (status == true)
	{
		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method:"POST",
			data:$("#supplier_update_form").serialize(),
			success:function(data){
				if (data == "SUPPLIER_EDITTED")
				{
					window.location.href=encodeURI(DOMAIN + "/manage_suppliers.php?msg=Supplier "+name+" Editted Successfully&category=success");
				}
				else
				{
					alert(data);
					window.location.href=encodeURI(DOMAIN + "/manage_supplier.php?msg=Something Went Wrong Please Try Again&category=danger");
				}
			}
		})
	}
})

$('#example_customer').delegate(".add_cust","click",function(){
	var eid = $(this).attr("id");
	// alert(eid);
	$.ajax({
		url:DOMAIN+"/includes/process.php",
		method:"POST",
		dataType:"json",
		data:{getCompany:1,id:eid},
		success:function(data){
			console.log(data);
			$("#address_of_customer").html(data["address"]);
		}
	})
})
$('#example_supplier').delegate(".add_supplier","click",function(){
	var eid = $(this).attr("id");
	// alert(eid);
	$.ajax({
		url:DOMAIN+"/includes/process.php",
		method:"POST",
		dataType:"json",
		data:{getSupplier:1,id:eid},
		success:function(data){
			console.log(data);
			$("#address_of_supplier").html(data["supplier_address"]);
		}
	})
})

$('#example_customer').delegate(".delete_cust","click",function(){
	var did = $(this).attr("did");
	 // alert(did);
	if(confirm("Are You Sure you want to Delete Customer ...!"))
	{
		$.ajax({
		url:DOMAIN+"/includes/process.php",
		method:"POST",
		data:{deleteCustomer:1,id:did},
		success:function(data){
			if (data == "DELETED")
				{
					window.location.href=encodeURI(DOMAIN + "/manage_customer.php?msg=Customer Deleted Successfully&category=success");
				}
				else
				{
					alert(data);
					window.location.href=encodeURI(DOMAIN + "/manage_customer.php?msg=Something Went Wrong Please Try Again&category=danger");
				}
		}
	})
	}
})
$('#example_supplier').delegate(".delete_supplier","click",function(){
	var did = $(this).attr("did");
	 // alert(did);
	if(confirm("Are You Sure you want to Delete Customer ...!"))
	{
		$.ajax({
		url:DOMAIN+"/includes/process.php",
		method:"POST",
		data:{deleteSupplier:1,id:did},
		success:function(data){
			if (data == "DELETED")
				{
					window.location.href=encodeURI(DOMAIN + "/manage_suppliers.php?msg=Supplier Deleted Successfully&category=success");
				}
				else
				{
					alert(data);
					window.location.href=encodeURI(DOMAIN + "/manage_suppliers.php?msg=Something Went Wrong Please Try Again&category=danger");
				}
		}
	})
	}
})

$("#stock_add").click(function(){
	$.ajax({
		url:DOMAIN+"/includes/process.php",
		method:"POST",
		data:{get_Product_for_stock:1},
		success:function(data){
			var root = "<option value=''>Choose Product</option>"
			$("#product_for_stock").html(root+data);
		}
	})
})

$('#stock_add_modal').undelegate("change").delegate(".product_for_stock","change",function(){
	var id=$(this).val()
	if (id =="") {$("#current_stock").val(0);}
	else{
	$.ajax({
		url:DOMAIN+"/includes/process.php",
		method:"POST",
		dataType: "json",
		data:{get_Product_for_current_stock:1,id:id},
		success:function(data){
			$("#current_stock").val(data["product_stock"]);
		}
	})
}
})

$("#add_stock_form").off("submit").on("submit",function(){
	var product = $("#product_for_stock").val();
	var product_name = $("#product_for_stock").html();
	var add_stock = $("#add_stock").val();
	var status=false;
	if (product == "")
	{
		$("#product_for_stock").addClass("border-danger");
		$("#product_for_stock_error").html('<span class="text-danger">Please Select Product</span>');
		status=false;
	}
	else
	{
		$("#product_for_stock").removeClass("border-danger");
		$("#product_for_stock_error").html("");
		status=true;
		if (add_stock == "")
		{
			$("#add_stock").addClass("border-danger");
			$("#add_stock_error").html('<span class="text-danger">Please Enter Valid Stock</span>');
			status=false;
		}
		else
		{
			$("#add_stock").removeClass("border-danger");
			$("#add_stock_error").html("");
			status=true;	
		}	
	}
	if (status == true)
	{
		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method:"POST",
			data:$("#add_stock_form").serialize(),
			success:function(data){
				if (data == "STOCK_ADDED")
				{
					window.location.href=encodeURI(DOMAIN + "/manage_products.php?msg=Stock of Product Added Successfully&category=success");
				}
				else
				{
					alert(data);
					window.location.href=encodeURI(DOMAIN + "/manage_products.php?msg=Something Went Wrong Please Try Again&category=danger");
				}
			}
		})
	}
})

$('#supplier_add_modal').off("submit").on("submit",function(){
	// alert("HELLO");
	var name = $("#supplier_name_1").val();
	//alert(name);
	var gst = $("#supplier_gst").val();
	var mobile = $("#supplier_mobile").val();
	var address = $("#supplier_address").val();
	var email = $("#supplier_email").val();
	var city = $("#supplier_city").val();
	var status = false;
	if (name == "")
	{
		$("#supplier_name").addClass("border-danger");
		$("#supplier_name_error").html('<span class="text-danger">Please Enter Valid Name</span>');
		status=false;
	}
	else
	{
		$("#supplier_name").removeClass("border-danger");
		$("#supplier_name_error").html('');
		status=true;
		if (gst == "")
		{
			$("#supplier_gst").addClass("border-danger");
			$("#supplier_gst_error").html('<span class="text-danger">Please Enter GST Number</span>');
			status=false;
		}
		else
		{
			$("#supplier_gst").removeClass("border-danger");
			$("#supplier_gst_error").html('');
			status=true;
			if (mobile == "" || mobile.length !=10)
			{
				$("#supplier_mobile").addClass("border-danger");
				$("#supplier_mobile_error").html("<span class = text-danger>Please Enter Valid Phone Number</span>");
				status=false;
			}
			else
			{
				$("#supplier_mobile").removeClass("border-danger");
				$("#supplier_mobile_error").html("");
				status=true;
				if (address == "")
				{
					$("#supplier_address").addClass("border-danger");
					$("#supplier_address_error").html("<span class = text-danger>Please Enter Valid Address</span>");
					status = false;
				}
				else
				{
					$("#supplier_address").removeClass("border-danger");
					$("#supplier_address_error").html("");
					status = true;
					if (email == "")
					{
						$("#supplier_email").addClass("border-danger");
						$("#supplier_email_error").html("<span class = text-danger>Please Enter Valid Email</span>");
						status = false;
					}
					else
					{
						$("#supplier_email").removeClass("border-danger");
						$("#supplier_email_error").html("");
						status = true;
						if (city == "")
						{
							$("#supplier_city").addClass("border-danger");
							$("#supplier_city_error").html("<span class = text-danger>Please Enter Valid City</span>");
							status = false;
						}
						else
						{
							$("#supplier_city").removeClass("border-danger");
							$("#supplier_city_error").html("");
							status = true;
						}
					}
				}
			}
		}
	}
	if (status == true)
	{
		//alert("reached");
		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method:"POST",
			data:$("#supplier_add_form").serialize(),
			success:function(data){
				if (data == "SUPPLIER_ADDED")
				{
					window.location.href=encodeURI(DOMAIN + "/manage_suppliers.php?msg=Supplier "+name+" Added Successfully&category=success");
				}
				else
				{
					alert(data);
					window.location.href=encodeURI(DOMAIN + "/manage_suppliers.php?msg=Something Went Wrong Please Try Again&category=danger");
				}
			}
		})
	}
})

function fetch_supplier(){
	$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		data:{getSupplierForInvoice:1},
		success: function(data){
			var root="<option value=''>Supplier Name</option>"
			$("#supplier_name_for_purchase").html(root+data);
		}
	})
}
fetch_supplier()


$('#date_picker').undelegate("change").delegate(".date","change",function(){
	var month = $(this).val()
	$.ajax({
		url:DOMAIN+"/includes/process.php",
		method:"POST",
		data:{getInvoiceMonth:1,month:month},
		success:function(data){
			if (data=="NO_DATA")
			{
				$('#invoice_body').html("<tr><td></td><td></td><td></td><td align='center'><h4>No Invoice</h4></td></tr>");
			}
			else
			{
				$('#invoice_body').html(data);
			}
		}
	})
})
	
	$("#sales_report_1").off("submit").on("submit",function(){
		//alert("HELLO");
		var sales=$("#sales_report_1").serialize();
		window.location.href = DOMAIN+"/includes/reports.php?"+sales; 
	})
	$("#purchase_report").off("submit").on("submit",function(){
		//alert("HELLO");
		var purchase=$("#purchase_report").serialize();
		window.location.href = DOMAIN+"/includes/reports_purchase.php?"+purchase; 
	})

function fetch_product_for_stock(id){
	$.ajax({
		url:DOMAIN+"/includes/process.php",
		method:"POST",
		data:{get_Product_for_stock_id:1,id:id},
		success:function(data){
			//var root = "<option value=''>Choose Product</option>"
			$("#product_for_stock_edit").html(data);
		}
	})
}
function fetch_current_stock_for_edit(id){
	$.ajax({
		url:DOMAIN+"/includes/process.php",
		method:"POST",
		dataType:"json",
		data:{getCurrStock:1,id:id},
		success:function(data){
			//var root = "<option value=''>Choose Product</option>"
			$("#current_stock_edit").val(data["product_stock"]);
		}
	})
}

function fetch_supplier_for_stock(supplier_name){
	$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		data:{getSupplierForInvoice_edit:1,supp:supplier_name},
		success: function(data){
			$("#supplier_name_for_purchase_edit").html(data);
		}
	})
}

$('#stock_edit_modal').undelegate("change").delegate(".product_for_stock","change",function(){
	var id=$(this).val()
	if (id =="") {$("#current_stock").val(0);}
	else{
	$.ajax({
		url:DOMAIN+"/includes/process.php",
		method:"POST",
		dataType: "json",
		data:{get_Product_for_current_stock:1,id:id},
		success:function(data){
			$("#current_stock_edit").val(data["product_stock"]);
		}
	})
}
})


	$('#example_purchase').undelegate("click").delegate(".edit_stock","click",function(){
		//alert("Hello");
		var eid = $(this).attr("eid");
		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method:"POST",
			dataType : "json",
			data:{getPurchaseDetails:1,id:eid},
			success:function(data){
				console.log(data);
				$("#purchase_id").val(data["id"]);
				$("#purchase_date_edit").val(data["purchase_date"]);
				$("#bill_no_edit").val(data["bill_no"]);
				$("#add_stock_edit").val(data["stock_added"]);
				$("#price_purchase_edit").val(data["stock_added"]);
				fetch_product_for_stock(data["product_id"]);
				fetch_supplier_for_stock(data["supplier_name"]);
				fetch_current_stock_for_edit(data["product_id"]);
			}
		})
	})



	$('#edit_stock_form').off("submit").on("submit",function(){
		//alert("Hello");
		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method:"POST",
			data:$('#edit_stock_form').serialize(),
			success:function(data){
				alert(data);
			}
		})
	})

})

