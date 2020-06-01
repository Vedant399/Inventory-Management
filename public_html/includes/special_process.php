<?php

include("user.php");
include("DBOperation.php");
include("manage.php");

if(isset($_POST["chalan_no"]))
{
	$chalan_no = $_POST["chalan_no"];
	$orderdate = $_POST["orderdate"];
	$customername = $_POST["customername"];
	$sub_total = $_POST["sub_total"];
	$gst = $_POST["gst"];
	$discount = $_POST["discount"];
	$net_total = $_POST["net_total"];
	$paid = $_POST["paid"];
	$due = $_POST["due"];
	$payment_type = $_POST["payment_type"];

	//fetching array

	$ar_tqty = $_POST["tqty"];
	$ar_qty = $_POST["qty"];
	$ar_price = $_POST["price"];
	$ar_pro_name = $_POST["pro_name"];

	

	$obj=new Manage();
	echo $obj->updateInvoice($chalan_no,$customername,$orderdate,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type);
}
?>