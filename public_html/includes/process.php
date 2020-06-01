<?php

include("user.php");
include("DBOperation.php");
include("manage.php");

if (isset($_POST["username"]) AND isset($_POST["email"])) {
	$user = new User();
	echo $user ->createUserAccount($_POST["username"],$_POST["email"],$_POST["password"],$_POST["usertype"]);
	exit();
}
elseif (isset($_POST["password"]) AND isset($_POST["email"])) {
	$user = new User();
	echo $user ->userLogin($_POST["email"],$_POST["password"]);
	exit();
}
if(isset($_POST["category_name"]) AND isset($_POST["parent_cat"]))
{
	$obj = new DBOperation();
	echo $obj->addCategory($_POST["parent_cat"],$_POST["category_name"]);
	exit();
}
if(isset($_POST["product_for_stock"]) AND isset($_POST["add_stock"]))
{
	$obj = new DBOperation();
	echo $obj->addStock($_POST["product_for_stock"],$_POST["add_stock"],$_POST["current_stock"],$_POST["purchase_date"],$_POST["supplier_name_for_purchase"],$_POST["bill_no"],$_POST["price_purchase"]);
	exit();
}
if(isset($_POST["product_for_stock_edit"]) AND isset($_POST["add_stock_edit"]))
{
	$obj = new Manage();
	echo $obj->editStock($_POST["purchase_id"],$_POST["product_for_stock_edit"],$_POST["add_stock_edit"],$_POST["current_stock_edit"],$_POST["purchase_date_edit"],$_POST["supplier_name_for_purchase_edit"],$_POST["bill_no_edit"],$_POST["price_purchase_edit"]);
	exit();
}
if(isset($_POST["category_name_update"]) AND isset($_POST["parent_cat_update"]))
{
	$obj = new Manage();
	echo $obj->editCategory($_POST["parent_cat_update"],$_POST["category_name_update"],$_POST["status"],$_POST["cid"]);
	exit();
}
if(isset($_POST["brand_name"]))
{
	$obj = new DBOperation();
	echo $obj->addBrand($_POST["brand_name"]);
	exit();
}
if(isset($_POST["customer_name"]))
{
	$obj = new DBOperation();
	echo $obj->addCustomer($_POST["customer_name"],$_POST["gst_no"],$_POST["mobile_no"],$_POST["address"],$_POST["email_cust"],$_POST["city"]);
	exit();
}
if(isset($_POST["supplier_name"]))
{
	$obj = new DBOperation();
	echo $obj->addSupplier($_POST["supplier_name"],$_POST["supplier_gst"],$_POST["supplier_mobile"],$_POST["supplier_address"],$_POST["supplier_email"],$_POST["supplier_city"]);
	exit();
}

if(isset($_POST["customer_name_update"]))
{
	$obj = new DBOperation();
	echo $obj->editCustomer($_POST["company_id"],$_POST["customer_name_update"],$_POST["gst_no_update"],$_POST["mobile_no_update"],$_POST["address_update"],$_POST["email_update"],$_POST["city_update"]);
	exit();
}
if(isset($_POST["supplier_name_update"]))
{
	$obj = new DBOperation();
	echo $obj->editSupplier($_POST["supplier_id"],$_POST["supplier_name_update"],$_POST["supplier_gst_no_update"],$_POST["supplier_mobile_no_update"],$_POST["supplier_address_update"],$_POST["supplier_email_update"],$_POST["supplier_city_update"]);
	exit();
}

if(isset($_POST["brand_name_update"]))
{
	$obj = new Manage();
	echo $obj->editBrand($_POST["bid"],$_POST["brand_name_update"],$_POST["status_brand"]);
	exit();
}
if(isset($_POST["paid_update"]))
{
	$obj = new Manage();
	echo $obj->editInvoice($_POST["invoice_no_update"],$_POST["paid_update"],$_POST["due_update"],$_POST["payment_date"]);
	exit();
}
if(isset($_POST["deleteCategory"]))
{
	$obj = new Manage();
	$rows= $obj->deleteRecord("categories","cid",$_POST["id"]);
	echo $rows;
 }
 //if(isset($_POST["editCategory"]))
// {
// 		$conn = mysqli_connect("localhost","root","","project_inventory_management","3306");
// 		$query=mysqli_query($conn,"SELECT * FROM categories where cid =".$_POST["id"]);
// 		$row=mysqli_fetch_array($query);
// 		echo $row["category_name"];

// }
if(isset($_POST["editCategory"]))
{
	$obj = new Manage();
	$row=$obj->getRecord("categories","cid",$_POST["id"]);
	echo json_encode($row);

}
if(isset($_POST["getPurchaseDetails"]))
{
	$obj = new Manage();
	$row=$obj->getRecord("purchase","id",$_POST["id"]);
	echo json_encode($row);

}
if(isset($_POST["editProduct"]))
{
	$obj = new Manage();
	$row=$obj->getRecord("products","pid",$_POST["id"]);
	echo json_encode($row);

}
if(isset($_POST["getPriceAndQty"]))
{
	$obj = new Manage();
	$row=$obj->getRecord("products","pid",$_POST["id"]);
	echo json_encode($row);

}
if(isset($_POST["getPriceAndQtyEdit"]))
{
	$obj = new Manage();
	$row=$obj->getRecordInvoiceDetails($_POST["id"],$_POST["product_name"]);
	echo json_encode($row);

}
if(isset($_POST["deleteBrand"]))
{
	$obj = new Manage();
	echo $obj->deleteRecord("brands","bid",$_POST["id"]);
}
if(isset($_POST["deleteCustomer"]))
{
	$obj = new Manage();
	echo $obj->deleteRecord("customers","id",$_POST["id"]);
}
if(isset($_POST["deleteSupplier"]))
{
	$obj = new Manage();
	echo $obj->deleteRecord("suppliers","id",$_POST["id"]);
}
if(isset($_POST["editBrand"]))
{
	$obj = new Manage();
	$row = $obj->getRecord("brands","bid",$_POST["id"]);
	echo json_encode($row);
}
if(isset($_POST["getCompany"]))
{
	$obj = new Manage();
	$row = $obj->getRecord("customers","id",$_POST["id"]);
	echo json_encode($row);
}
if(isset($_POST["getSupplier"]))
{
	$obj = new Manage();
	$row = $obj->getRecord("suppliers","id",$_POST["id"]);
	echo json_encode($row);
}
if(isset($_POST["getInvoice"]))
{
	$obj = new Manage();
	$row = $obj->getRecord("invoice","invoice_no",$_POST["id"]);
	echo json_encode($row);
}
if(isset($_POST["deleteProduct"]))
{
	$obj = new Manage();
	echo $obj->deleteRecord("products","pid",$_POST["id"]);
}
if(isset($_POST["select_cat"]) AND isset($_POST["select_brand"]) AND isset($_POST["product_name"]) AND isset($_POST["product_price"]) AND isset($_POST["product_qty"]) AND isset($_POST["added_date"]))
{
	$obj = new DBOperation();
	echo $obj->addProduct($_POST["select_cat"],$_POST["select_brand"],$_POST["product_name"],$_POST["product_price"],$_POST["product_qty"],$_POST["added_date"]);
	exit();
}
if(isset($_POST["select_cat_update"]) AND isset($_POST["select_brand_update"]) AND isset($_POST["product_name_update"]) AND isset($_POST["product_price_update"]) AND isset($_POST["product_qty_update"]) AND isset($_POST["added_date_update"]))
{
	$obj = new Manage();
	echo $obj->editProduct($_POST["pid"],$_POST["select_cat_update"],$_POST["select_brand_update"],$_POST["product_name_update"],$_POST["product_price_update"],$_POST["product_qty_update"],$_POST["status_product"]);
	exit();
}


//to get cattegory

if(isset($_POST["getCategory"]) AND !isset($_POST["id"]))
{
	$obj = new DBOperation();
	$rows=$obj->getAllRecord("categories");
	foreach ($rows as $row) {
		echo "<option value=".$row["cid"].">".$row["category_name"]."</option>";
	}
	exit();
}
if(isset($_POST["getCustomer"]))
{
	$obj = new DBOperation();
	$rows=$obj->getAllRecord("customers");
	foreach ($rows as $row) {
		echo "<option value='".$row["company_name"]."''>".$row["company_name"]."</option>";
	}
	exit();
}
if(isset($_POST["getSupplierForInvoice"]))
{
	$obj = new DBOperation();
	$rows=$obj->getAllRecord("suppliers");
	foreach ($rows as $row) {
		echo "<option value='".$row["supplier_name"]."''>".$row["supplier_name"]."</option>";
	}
	exit();
}
if(isset($_POST["getSupplierForInvoice_edit"]))
{
	$obj = new DBOperation();
	$rows=$obj->getAllRecord("suppliers");
	foreach ($rows as $row) {
		if ($_POST["supp"] == $row["supplier_name"]) {
			echo "<option value='".$row["supplier_name"]."'' selected>".$row["supplier_name"]."</option>";	
		}
		else
		{
			echo "<option value='".$row["supplier_name"]."''>".$row["supplier_name"]."</option>";
		}
	}
	exit();
}
if(isset($_POST["getCustomerwithID"]) AND isset($_POST["id"]))
{
	$obj = new DBOperation();
	$rows=$obj->getAllRecord("customers");
	foreach ($rows as $row) {
		if ($row["company_name"] == $_POST["id"]) {
			echo "<option value='".$row["company_name"]."'' selected> ".$row["company_name"]."</option>";
		}
		else
		{
		echo "<option value='".$row["company_name"]."''>".$row["company_name"]."</option>";
	}
	}
	exit();
}
if(isset($_POST["get_Product_for_stock"]))
{
	$obj = new DBOperation();
	$rows=$obj->getAllRecord("products");
	foreach ($rows as $row) {
		echo "<option value='".$row["pid"]."''>".$row["product_name"]."</option>";
	}
	exit();
}
if(isset($_POST["get_Product_for_stock_id"]))
{
	$obj = new DBOperation();
	$rows=$obj->getAllRecord("products");
	foreach ($rows as $row) {
		if ($row["pid"] == $_POST["id"]) {
			echo "<option value='".$row["pid"]."'' selected>".$row["product_name"]."</option>";
		}
		else
		{
			echo "<option value='".$row["pid"]."''>".$row["product_name"]."</option>";
		}
	}
	exit();
}

if(isset($_POST["get_Product_for_current_stock"]))
{
	$obj = new Manage();
	$row=$obj->getRecord("products","pid",$_POST["id"]);
	echo json_encode($row);
}
if(isset($_POST["getCurrStock"]))
{
	$obj = new Manage();
	$row=$obj->getRecord("products","pid",$_POST["id"]);
	echo json_encode($row);
}

if(isset($_POST["getOrderItem"]))
{
	$obj = new DBOperation();
	$rows=$obj->getAllRecord("products");
	$count=1;
	?>

	<tr>

      <td><b id="number"><?php echo $_POST["count"]?></b></td>
      <td><select name="pid[]" class="form-control pid">
      	<option value="">Choose Product</option>
      	<?php

      	foreach ($rows as $row) {
      		?>
      		<option value="<?php echo $row['pid'];?>"><?php echo $row["product_name"];?></option>
      		<?php
      	}

      	?>
      	
      </select>
      <small id="product_select" class="form-text text-muted product_select"></small>
  </td>
      <td>
      	<input type="text" name="des[]" class="form-control" id="des[]">
      </td>
      <td>
      	<input type="text" name="tqty[]" class="form-control tqty" readonly>
      </td>
      <td>
      	<input type="number" name="qty[]" class="form-control qty">
      	<span><small id="order_qty_error" class="form-text text-muted order_qty_error"></small></span>
      </td>
      <td>
      	<input type="number" name="price[]" class="form-control price">
      </td>
      <td hidden="true">
      	<input type="hidden" name="pro_name[]" class="form-control pro_name">
      </td>
      <td><span class="amt">0</span></td>
    </tr>

    $count++;

	<?php
	exit();
}

if (isset($_POST["getInvoiceRecord"])) {
	$count=1;

	$obj = new DBOperation();
	$rows=$obj->getInvoiceRecord_of_invoice($_POST["invoice_no"]);
	foreach ($rows as $row)
	{
		$obr = new DBOperation();
		$rows1=$obr->getAllRecord("products");
		?>

	<tr>
		<td><b class="number"><?php echo $count++?></b></td>
      <td><select name="pid[]" class="form-control pid">
      	<option value="">Choose Product</option>
      	<?php

      	foreach ($rows1 as $row1) {
      		if ($row1["product_name"] == $row["product_name"]) {
      			?>
      			<option value="<?php echo $row1['pid'];?>" selected><?php echo $row1["product_name"];?></option>
      			<?php
      		}
      		else
      		{
      			?>
      			<option value="<?php echo $row1['pid'];?>"><?php echo $row1["product_name"];?></option>
      			<?php
      		}
      	}

      	?>
      	
      </select>
      <small id="product_select" class="form-text text-muted product_select"></small>
  </td>
      <td>
      	<input type="text" name="des[]" class="form-control" id="des[]">
      </td>
      <td>
      	<input type="text" name="tqty[]" class="form-control tqty" readonly>
      </td>
      <td>
      	<input type="number" name="qty[]" class="form-control qty">
      	<span><small id="order_qty_error" class="form-text text-muted order_qty_error"></small></span>
      </td>
      <td>
      	<input type="number" name="price[]" class="form-control price">
      </td>
      <td hidden="true">
      	<input type="hidden" name="pro_name[]" class="form-control pro_name">
      </td>
      <td><span class="amt">0</span></td>
    </tr>
    <?php
}

	
	exit();
	
}

if(isset($_POST["getCategory"]) AND isset($_POST["id"]))
{
	$obj = new DBOperation();
	$rows=$obj->getAllRecordExcept("categories","cid",$_POST["id"]);
	foreach ($rows as $row) {
		echo "<option value=".$row["cid"].">".$row["category_name"]."</option>";
	}
	exit();
}

if(isset($_POST["getBrand"]))
{
	$obj = new DBOperation();
	$rows=$obj->getAllRecord("brands");
	foreach ($rows as $row) {
		echo "<option value=".$row["bid"].">".$row["brand_name"]."</option>";
	}
	exit();
}
if(isset($_POST["orderdate"]) AND isset($_POST["customername"]))
{
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
	echo $obj->addInvoice($customername,$orderdate,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type);
}



if (isset($_POST["getInvoiceMonth"])) {
	
	$obj=new Manage();
	$rows= ($obj->MonthInvoice(($_POST["month"]."-01")));
	if ($rows=="NO_DATA") {
			echo $rows;
			exit();
		}	
	foreach ($rows as $row)
	{
		$newDate = date("d-m-Y", strtotime($row["order_date"]));
		?>

		<tr>
	            <td><?php echo $row["invoice_no"]?></td>
	            <td><?php echo $newDate; ?></td>
	            <td><?php echo $row['customer_name']; ?></td>
	           	<td align="center"><?php echo $row['due']; ?></td>
	            <td align="center"><a style="color: black;" title ="Show payment history of this invoice" href="payments_details.php?invoice_no=<?php echo $row['invoice_no']?>"><?php echo $row['paid']; ?></a></td>

	            <?php
	            if($row['due'] == 0)
	            {
	            ?>
	            	<td><span class="btn btn-success" style="width:6rem"><span class="fas fa-check"></span>&nbsp;&nbsp;Paid</span></td>
	            <?php
	            }
	            else
	            {
	            ?>
	            	<td><span class="btn btn-warning" style="width:6rem"><i class="far fa-hand-paper"></i>&nbsp;&nbsp;Due</span></td>
	            <?php
	            }
	            ?>

	            <td>
	              <div class="row">
	                <div class="btn-group">
	                	<a href="manage_orders.php?invoice_no=<?php echo $row['invoice_no']?>&customer_name=<?php echo $row['customer_name']?>
	                	" class="btn btn-info" style="margin-right:10px;"><span class="far fa-eye" ></span></a>
	                  <a href="new_order.php?invoice_no=<?php echo $row['invoice_no']?>&customer_name=<?php echo $row['customer_name']?>" class="btn btn-success" style="margin-right:10px;"><span class="fas fa-edit"></span></a>
	                  <a href="#" class="btn btn-primary edit_invoice" data-toggle="modal" data-target="#invoice_edit_modal" eid="<?php echo $row['invoice_no']?>"><span class="fas fa-rupee-sign"></span></a>
	                </div>
	              </div>
	            </td>
	           
	    	</tr>


		<?php
	}
}




?>