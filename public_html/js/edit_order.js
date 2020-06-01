$(document).ready(function(){

	var DOMAIN="http://localhost/InventoryManagement/public_html";
	var count=1;
	var due_or=0;
	
	fetch_customer()

	function fetch_customer(){
	$.ajax({
		url : DOMAIN + "/includes/process.php",
		method:"POST",
		data:{getCustomer:1,},
		success: function(data){
			var root="<option value=''>Customer Name</option>"
			$("#customername_update").html(root+data);
		}
	})
}

})