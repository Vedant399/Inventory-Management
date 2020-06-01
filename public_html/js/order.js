$(document).ready(function(){
	var DOMAIN="http://localhost/InventoryManagement/public_html";
	var count=1;
	var count1=1;
	var count2=0;
	var due_or=0;
	var sp_name="";
	var searchParams = new URLSearchParams(window.location.search)

	if ($(location).attr('search'))
	{
		// alert("YES");
		var sel=searchParams.get('customer_name')
		var sei=searchParams.get('invoice_no')
		fetch_customer_with_id(sel);
		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method:"POST",
			data:{getInvoiceRecord:1,invoice_no:sei,count:count},
			success:function(data){
				$("#invoice_item").append(data);
				count=parseInt($("#invoice_item").children("tr:last").find(".number").html())+1;
				$("#invoice_item").children("tr").each(function(){
					var tr = $(this)
					var pid = tr.children().find(".pid").val();

					$.ajax({
						url:DOMAIN+"/includes/process.php",
						method:"POST",
						dataType: "json",
						data:{getPriceAndQty:1,id:pid},
						success:function(data)			{
							count2=0
							console.log(data);
							tr.find(".tqty").val(data["product_stock"]);
							//tr.find(".qty").val(1);
							tr.find(".pro_name").val(data["product_name"]);
							//tr.find(".price").val(data["product_price"]);
							tr.find(".amt").html((tr.find(".qty").val()*data["product_price"]).toFixed(2));
							$.ajax({
						url:DOMAIN+"/includes/process.php",
						method:"POST",
						dataType: "json",
						data:{getPriceAndQtyEdit:1,id:sei,product_name:data["product_name"]},
						success:function(data2)			{
							console.log(data2.length);
							if (data2.length>=2)
							{
								tr.find(".qty").val(data2[count2]["qty"]);
							// tr.find(".pro_name").val(data["product_name"]);
								 tr.find(".price").val(data2[count2]["price"]);
								 tr.find(".amt").html((tr.find(".qty").val()*data2[count2++]["price"]).toFixed(2));
							}
							else
							{
							// tr.find(".tqty").val(data["product_stock"]);
							 tr.find(".qty").val(data2[0]["qty"]);
							// tr.find(".pro_name").val(data["product_name"]);
							 tr.find(".price").val(data2[0]["price"]);
							 tr.find(".amt").html((tr.find(".qty").val()*data2[0]["price"]).toFixed(2));
							}
							// calculate();
							calculate();
						}
					})
							
						}
					})

				})
			}
		})
	}
	else
	{
		// alert("NO");
		fetch_customer();
		addNewRow();
	}





	function fetch_customer(){
	$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		data:{getCustomer:1,},
		success: function(data){
			var root="<option value=''>Customer Name</option>"
			$("#customername").html(root+data);
		}
	})
}
	function fetch_customer_with_id(selectid){
	$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		data:{getCustomerwithID:1,id:selectid},
		success: function(data){
			var root="<option value=''>Customer Name</option>"
			$("#customername").html(root+data);
		}
	})
}
	

	function addNewRow(){

		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method:"POST",
			data : {getOrderItem:1,count:count},
			success:function(data){
				count++;
				setTimeout(() => {  $("#invoice_item").append(data); }, 600);
				calculate();
				
			}
		})

	}
	
		$("#add").on("click",function(){
			$("#add").html(
	        `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true" style = "margin-right:5px"></span>Adding ...`
	      	);

			addNewRow();
			setTimeout(() => {  $("#add").children("span:first").remove();$("#add").html(
	        `<i class="fas fa-shopping-cart"></i>&nbsp;&nbsp;Add Order`
	      	); }, 600);
	})
	$("#remove").on("click",function(){
		$("#invoice_item").children("tr:last").remove();
		count--;
		calculate();
	})


	$('#invoice_item').undelegate("change").delegate(".pid","change",function(){
		var pid = $(this).val();
		var tr = $(this).parent().parent();

		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method:"POST",
			dataType: "json",
			data:{getPriceAndQty:1,id:pid},
			success:function(data)			{
				console.log(data);
				tr.find(".tqty").val(data["product_stock"]);
				tr.find(".qty").val(1);
				tr.find(".pro_name").val(data["product_name"]);
				tr.find(".price").val(data["product_price"]);
				tr.find(".amt").html((tr.find(".qty").val()*data["product_price"]).toFixed(2));
				calculate();
			}
		})

	})

	$('#invoice_item').delegate(".qty","change",function(){
		var qty =$(this);
		var tr = $(this).parent().parent();
		
			tr.find(".qty").removeClass("border-danger");
			$("#order_qty_error").html("");
			tr.find(".amt").html((tr.find(".qty").val() * tr.find(".price").val()).toFixed(2));
			calculate();

	})
	$('#invoice_item').delegate(".price","keyup",function(){
		var qty =$(this);
		var tr = $(this).parent().parent();
		// alert(tr.find(".tqty").val());
		tr.find(".qty").removeClass("border-danger");
		$("#order_qty_error").html("");
		tr.find(".amt").html((tr.find(".qty").val() * tr.find(".price").val()).toFixed(2));
		calculate();
	})
	$('#new_order').delegate(".discount","change",function(){

		calculate();

	})
	$('#new_order').delegate(".paid","change",function(){

		calculate();

	})
	$('#new_order').delegate(".gst","change",function(){

		calculate();

	})
	calculate();
	function calculate(){
		var sub_total=0;
		var gst=0;
		var net_total=0;
		var discount=0;
		var paid=0;
		var due=0;
		$(".amt").each(function(){
			sub_total=parseFloat(sub_total)+parseFloat($(this).html());
		})
		if((sub_total-Math.floor(sub_total))>0.5)
		{
			sub_total=Math.ceil(sub_total);
		}
		else
		{
			sub_total=Math.floor(sub_total);
		}
		gst=parseInt($("#gst").val());

		paid=parseInt($("#paid").val());
		discount=parseInt($("#discount").val());
		//console.log(net_total,sub_total,gst);
		net_total=(sub_total+gst)-discount;
		if((net_total-Math.floor(net_total))>0.5)
		{
			net_total=Math.ceil(net_total);
		}
		else
		{
			net_total=Math.floor(net_total);
		}
		due=net_total-paid;
		$("#sub_total").val((sub_total).toFixed(2));
		// $("#gst");
		// $("#discount");
		
		$("#net_total").val((net_total).toFixed(2));
		
		// $("#paid");
		$("#due").val((due).toFixed(2));
	}

	$('#new_order').off("submit").on("submit",function(){

		var status=false;
		if($("#invoice_item tr").length == 0)
		{
			alert("Select Atleast one order");
			status=false;
		}
		else
		{
			$(".pid").each(function(){
				if(!($(this).val()))
				{
					$(this).addClass('border-danger');
					$(this).parent().find(".product_select").html("<span class='text-danger'>Please Select Product Name</span>")
					status=false;
				}
				else
				{
					$(this).removeClass('border-danger');
					$(this).parent().find(".product_select").html("")
					status=true;
					$(".qty").each(function(){
				if ($(this).val() === "")
				{
					$(this).addClass('border-danger');
					$(this).parent().find(".order_qty_error").html("<span class='text-danger'>Please Enter QTY</span>")
					status=false;
				}
				else
				{
					if(parseInt($(this).val())>parseInt($(this).parent().parent().find('.tqty').val()))
					{
						$(this).addClass('border-danger');
						$(this).parent().find(".order_qty_error").html("<span class='text-danger'>Negative Stock</span>")
						alert("Negative Stock");
					}
					$(this).removeClass('border-danger');
					$(this).parent().find(".order_qty_error").html("")
					status=true;
					if ($("#customername").val() === "")
					{
						$("#customername").addClass('border-danger');
						$("#customername_error").html("<span class='text-danger'>Please Select Customer Name</span>")
						status=false;
					}
					else
					{
						$("#customername").removeClass('border-danger');
						$("#customername_error").html("");
						status=true;
						if ($("#discount").val() === "")
						{
							$("#discount").addClass('border-danger');
							$("#discount_error").html("<span class='text-danger'>Please Enter discount</span>")
							status=false;
						}
						else
						{
							$("#discount").removeClass('border-danger');
							$("#discount_error").html("");
							status=true;
							if ($("#paid").val() === "")
							{
								$("#paid").addClass('border-danger');
								$("#paid_error").html("<span class='text-danger'>Please Enter paid amount</span>")
								status=false;
							}
							else
							{
								$("#paid").removeClass('border-danger');
								$("#paid_error").html("");
								status=true;
								if ($("#gst").val() === "")
								{
									$("#gst").addClass('border-danger');
									$("#gst_error").html("<span class='text-danger'>Please Enter Frieght Amount</span>")
									status=false;
								}
								else
								{
									$("#gst").removeClass('border-danger');
									$("#gst_error").html("");
									status=true;
								}
							}
						}
					}
					
				}
			})
				}
			})
	}

	
	
	if (status == true)
	{
		var searchParams = new URLSearchParams(window.location.search)
		// alert("YES");
		var sel=searchParams.get('customer_name')
		var sei=searchParams.get('invoice_no')
		if (sei)
		{
		var company =$("#customername").val();
		var invoice_no =$("#chalan_no").val();
		var net_total =$("#net_total").val();
		var invoice = $("#new_order").serialize();
		$.ajax({
			url:DOMAIN+"/includes/special_process.php",
			method:"POST",
			data:$("#new_order").serialize(),
			success:function(data){
				
				if (data == "INVOICE_SAVED")
				{
					if (confirm("Do You want to print invoice"))
					{
						window.location.href=DOMAIN + "/includes/invoice_bill.php?"+invoice+"&amt="+numberToWords.toWords(net_total);
					}
					//window.location.href=encodeURI(DOMAIN + "/manage_orders.php?msg=Invoice of "+company+" made Successfully&category=success");
				}
				else
				{
					if (data == "INVOICE_EDITTED")
					{
						if (confirm("Do You want to print invoice"))
						{
							window.location.href=DOMAIN + "/includes/invoice_bill.php?"+invoice+"&amt="+numberToWords.toWords(net_total);
						}
						//window.location.href=encodeURI(DOMAIN + "/manage_orders.php?msg=Invoice of "+company+" made Successfully&category=success");
					}
					else
					{
						alert(data);
						window.location.href=encodeURI(DOMAIN + "/manage_invoices.php?msg=Something Went Wrong Please Try Again&category=danger");
					}
				}
			}
		})
		}
		else
		{
		var company =$("#customername").val();
		var invoice_no =$("#chalan_no").val();
		var net_total =$("#net_total").val();
		var invoice = $("#new_order").serialize();
		$.ajax({
			url:DOMAIN+"/includes/process.php",
			method:"POST",
			data:$("#new_order").serialize(),
			success:function(data){
				
				if (data == "INVOICE_SAVED")
				{
					if (confirm("Do You want to print invoice"))
					{
						window.location.href=DOMAIN + "/includes/invoice_bill.php?"+invoice+"&amt="+numberToWords.toWords(net_total);
					}
					//window.location.href=encodeURI(DOMAIN + "/manage_orders.php?msg=Invoice of "+company+" made Successfully&category=success");
				}
				else
				{
					if (data == "INVOICE_EDITTED")
					{
						if (confirm("Do You want to print invoice"))
						{
							window.location.href=DOMAIN + "/includes/invoice_bill.php?"+invoice+"&amt="+numberToWords.toWords(net_total);
						}
						//window.location.href=encodeURI(DOMAIN + "/manage_orders.php?msg=Invoice of "+company+" made Successfully&category=success");
					}
					else
					{
						alert(data);
						window.location.href=encodeURI(DOMAIN + "/manage_invoices.php?msg=Something Went Wrong Please Try Again&category=danger");
					}
				}
			}
		})
		}
	}
})

	$("#manage_order_close").click(function(){

	window.location.href=encodeURI(DOMAIN + "/manage_orders.php");
})

	$('#invoice_body').undelegate("click").delegate(".edit_invoice","click",function(){
	var eid = $(this).attr("eid");
	console.log("HELO");
	$.ajax({
		url:DOMAIN+"/includes/process.php",
		method:"POST",
		dataType: "json",
		data:{getInvoice:1,id:eid},
		success:function(data)
		{
			$("#invoice_no_update").val(data["invoice_no"]);
			$("#due_update").val(data["due"]);
			due_or=data["due"];
		}
	})
})

	$("#invoice_edit_modal").delegate(".paid_update","change",function(){
	var form = $(this).parent().parent();
	form.find("#due_update").val(parseInt(due_or)-parseInt($(this).val()));
})

	$("#update_invoice_form").off("submit").on("submit",function(){
		var paid = $("#paid_update").val();
		if (paid === "")
		{
			$("#paid_update").addClass("border-danger");
			$("#paid_update_error").html("<span class='text-danger'>Please Enter paid amount</span>");
		}
		else
		{
			$("#paid_update").removeClass("border-danger");
			$("#paid_update_error").html("");
			$.ajax({
				url:DOMAIN+"/includes/process.php",
				method:"POST",
				data:$("#update_invoice_form").serialize(),
				success:function(data){
					if (data == "INVOICE_EDITTED")
					{
						window.location.href=encodeURI(DOMAIN + "/manage_invoices.php?msg=Invoice editted Successfully&category=success");
					}
					else
					{
					alert(data);
					window.location.href=encodeURI(DOMAIN + "/manage_invoices.php?msg=Something Went Wrong Please Try Again&category=danger");
					}
				}
			})
		}
	})
	
})