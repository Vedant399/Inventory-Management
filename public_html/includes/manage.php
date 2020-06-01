<?php

/**
 * 
 */
class Manage
{
	
	private $conn;
	function __construct()
	{
		include_once("../database/db.php");
		$db= new database();
		$this->conn = $db->connect();
	}
	public function deleteRecord($table,$pk,$id)
	{
		if($table == "categories")
		{
			$pre_stmt=$this->conn->prepare("SELECT cid FROM `categories` WHERE `parent_cat` = ?");
			$pre_stmt->bind_param("i",$id);
			$pre_stmt->execute();
			$result = $pre_stmt->get_result() or die($this->conn->error);
			if ($result->num_rows>0) {
				return "DEPENDENT_CATEGORY";
			}
			else
			{
				$pre_stmt=$this->conn->prepare("DELETE FROM `categories` WHERE cid = ?");
				$pre_stmt->bind_param("i",$id);
				$result=$pre_stmt->execute() or die($this->conn->error);
				if($result)
				{
					return 0;
				}
			}

		}
		else
		{
			//echo $table.$pk;
			$pre_stmt=$this->conn->prepare("DELETE FROM ".$table." WHERE ".$pk." = ?");
			$pre_stmt->bind_param("i",$id);
			$result=$pre_stmt->execute() or die($this->conn->error);
			if($result)
			{
				return "DELETED";
			}
		}
	}
	public function editStock($id,$product_id,$stock_added,$current_stock,$purchase_date,$supplier_name,$bill_no,$price_purchase){
		$pre_stmt = $this->conn->prepare("SELECT * from `purchase` where id = ".$id);
	 	$pre_stmt->execute() or die($this->conn->error);
	 	$result=$pre_stmt->get_result();
	 	if ($result->num_rows>0)
	 	{
	 		$row = $result->fetch_assoc();
 			$pre_stmt1 = $this->conn->prepare("UPDATE `products` set product_stock = product_stock- ?  where pid = ?");
 			$pre_stmt1->bind_param("di",$row["stock_added"],$row["product_id"]);
 			$pre_stmt1->execute() or die($this->conn->error);
 		

 			$pre_stmt2 = $this->conn->prepare("UPDATE `purchase` SET `product_id`= ? ,`stock_added`= ? ,`purchase_date`= ? ,`supplier_name`= ? ,`bill_no`= ? ,`price_purchase`= ?  WHERE id = ?");
 			$pre_stmt2->bind_param("issssdi",$product_id,$stock_added,$purchase_date,$supplier_name,$bill_no,$price_purchase,$id);
 			$pre_stmt2->execute() or die($this->conn->error);

 			$pre_stmt3 = $this->conn->prepare("UPDATE `products` set product_stock = product_stock + ?  where pid = ?");
 			$pre_stmt3->bind_param("di",$stock_added,$product_id);
 			$pre_stmt3->execute() or die($this->conn->error());
 			return "PURCHASE_EDITTED";				
	 	}
	}

	public function editCategory($parent,$cat,$status,$cid)
	{
		$pre_stmt=$this->conn->prepare("UPDATE `categories` SET `parent_cat`=?,`category_name`=?,`status`=? WHERE cid = ?");
		$pre_stmt->bind_param("isii",$parent,$cat,$status,$cid);
		$result=$pre_stmt->execute() or die($this->conn->error);
		if ($result) {
			return "CATEGORY_EDITTED";
		}
		else
		{
			return 0;
		}
	}
	public function editProduct($pid,$cid,$bid,$product_name,$product_price,$product_stock,$p_status)
	{
		$pre_stmt=$this->conn->prepare("UPDATE `products` SET `cid`=?,`bid`=?,`product_name`=?,`product_price`=?,`product_stock`=?,`p_status`=? WHERE pid = ?");
		$pre_stmt->bind_param("iisdiii",$cid,$bid,$product_name,$product_price,$product_stock,$p_status,$pid);
		$result=$pre_stmt->execute() or die($this->conn->error);
		if ($result) {
			return "PRODUCT_EDITTED";
		}
		else
		{
			return 0;
		}
	}
	public function editBrand($bid,$brand_name,$status)
	{
		$pre_stmt=$this->conn->prepare("UPDATE `brands` SET `brand_name`=?,`status`=? WHERE bid=?");
		$pre_stmt->bind_param("sii",$brand_name,$status,$bid);
		$result=$pre_stmt->execute() or die($this->conn->error);
		if ($result) {
			return "BRAND_EDITTED";
		}
		else
		{
			return 0;
		}
	}
	public function editInvoice($invoice_no,$paid_update,$due_update,$payment_date)
	{
		$payment_date = date("Y-m-d", strtotime($payment_date));
		$pre_stmt=$this->conn->prepare("UPDATE `invoice` SET `paid`= paid + ?,`due`=? WHERE invoice_no = ?");
		$pre_stmt->bind_param("ddi",$paid_update,$due_update,$invoice_no);
		$result=$pre_stmt->execute() or die($this->conn->error);
		if ($result) {

			$pre_stmt1=$this->conn->prepare("INSERT INTO `payment_details`(`invoice_no`, `paid_time`, `payment_date`) VALUES (?,?,?)");
			$pre_stmt1->bind_param("ids",$invoice_no,$paid_update,$payment_date);
			$result=$pre_stmt1->execute() or die($this->conn->error);

			return "INVOICE_EDITTED";
		}
		else
		{
			return 0;
		}
	}
	public function getRecord($table,$pk,$id)
	{
		
		$pre_stmt=$this->conn->prepare("SELECT * FROM ".$table." WHERE ".$pk."= ?");
		$pre_stmt->bind_param("i",$id);
		$pre_stmt->execute() or die($this->conn->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if($result->num_rows==1)
		{
			$row=$result->fetch_assoc();
			return $row;
		}

		}
public function getRecordInvoiceDetails($invoice_no,$product_name)
	{
		
		$pre_stmt=$this->conn->prepare("SELECT * FROM `invoice_details` WHERE invoice_no=".$invoice_no." AND product_name = '".$product_name."'");
		$pre_stmt->execute() or die($this->conn->error);
		$result = $pre_stmt->get_result();
		$rows=array();
		if ($result->num_rows>0) {
			while($row = $result->fetch_assoc())
			{
				$rows[]=$row;
			}
			return $rows;
		}

		}

	public function addInvoice($customer_name,$order_date,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type)
	{
		$order_date = date("Y-m-d", strtotime($order_date));
		$pre_stmt = $this->conn->prepare("INSERT INTO `invoice`(`customer_name`, `order_date`, `sub_total`, `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`) VALUES (?,?,?,?,?,?,?,?,?)");
		$pre_stmt->bind_param("ssdddddds",$customer_name,$order_date,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type);
		$pre_stmt->execute() or die($this->conn->error);
		$result=$pre_stmt->get_result();
		$invoice_no=$pre_stmt->insert_id;
		if($invoice_no!=null)
		{
			for ($i=0; $i <count($ar_pro_name) ; $i++) { 
				$insert_stmt=$this->conn->prepare("INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`) VALUES (?,?,?,?)");
				$insert_stmt->bind_param("isdi",$invoice_no,$ar_pro_name[$i],$ar_price[$i],$ar_qty[$i]);
				$result_product_insert=$insert_stmt->execute() or die($this->conn->error);

				$stock_stmt=$this->conn->prepare("UPDATE `products` SET `product_stock`= product_stock-? WHERE product_name = ?");
				$stock_stmt->bind_param("is",$ar_qty[$i],$ar_pro_name[$i]);
				$result=$stock_stmt->execute() or die($this->conn->error);
			}
			
			return 'INVOICE_SAVED';
		}
		else
		{
			return 0;
		}
	}

	public function updateInvoice($chalan_no,$customer_name,$order_date,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type)
	{
		$order_date = date("Y-m-d", strtotime($order_date));
		$pre_stmt=$this->conn->prepare("SELECT * FROM invoice_details WHERE invoice_no = ".$chalan_no);
		$pre_stmt->execute() or die($this->conn->error);
		$result=$pre_stmt->get_result();
		if ($result->num_rows>0) {
			while($row = $result->fetch_assoc())
			{
				$pre_stmt1=$this->conn->prepare("UPDATE `products` SET `product_stock`= product_stock + ".$row["qty"]." WHERE product_name = '".$row["product_name"]."'");
				$pre_stmt1->execute() or die($this->conn->error);

			}
			$pre_stmt2=$this->conn->prepare("DELETE FROM invoice_details WHERE invoice_no =".$chalan_no);
			$result=$pre_stmt2->execute() or die($this->conn->error);
			$pre_stmt3=$this->conn->prepare("UPDATE `invoice` SET `customer_name`=?,`order_date`=?,`sub_total`=?,`gst`=?,`discount`=?,`net_total`=?,`paid`=?,`due`=?,`payment_type`=? WHERE `invoice_no` = ?");
			$pre_stmt3->bind_param("ssddddddsi",$customer_name,$order_date,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type,$chalan_no);
		$result=$pre_stmt3->execute() or die($this->conn->error);
		if($result)
		{
			for ($i=0; $i <count($ar_pro_name) ; $i++) { 
				$insert_stmt=$this->conn->prepare("INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`) VALUES (?,?,?,?)");
				$insert_stmt->bind_param("isdi",$chalan_no,$ar_pro_name[$i],$ar_price[$i],$ar_qty[$i]);
				$result_product_insert=$insert_stmt->execute() or die($this->conn->error);

				$stock_stmt=$this->conn->prepare("UPDATE `products` SET `product_stock`=product_stock - ? WHERE product_name = ?");
				$stock_stmt->bind_param("is",$ar_qty[$i],$ar_pro_name[$i]);
				$result=$stock_stmt->execute() or die($this->conn->error);
			}
			
			return 'INVOICE_EDITTED';
		}
		else
			{return 0;}

		}
		else
		{
			return "NO_DATA";
		}




	}
	public function monthInvoice($date)
	{
		$pre_stmt = $this->conn->prepare("SELECT * from invoice where MONTH(order_date) = MONTH('".$date."')");
		$pre_stmt->execute() or die($this->conn->error);
		$result=$pre_stmt->get_result();
		$rows=array();
		if ($result->num_rows>0) {
			while($row = $result->fetch_assoc())
			{
				$rows[]=$row;
			}
			return $rows;
		}
		else
		{
			return "NO_DATA";
		}
	}
}

// $obj = new Manage();
// print_r( $obj->getRecord("products","pid",25));

?>