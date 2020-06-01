<?php

/**
 * DB Operation
 */
class DBOperation
{
	private $conn;
	function __construct()
	{
		include_once("../database/db.php");
		$db= new database();
		$this->conn = $db->connect();
	}
	public function addCategory($parent,$cat)
	{
		$pre_stmt=$this->conn->prepare("INSERT INTO `categories`(`parent_cat`, `category_name`, `status`) VALUES (?,?,?)");
		$status=1;
		$pre_stmt->bind_param("isi",$parent,$cat,$status);
		$result=$pre_stmt->execute() or die($this->conn->error);
		if ($result) {
			return "CATEGORY_ADDED";
		}
		else
		{
			return 0;
		}
	}
	
	public function getAllRecord($table)
	{
		$pre_stmt=$this->conn->prepare("SELECT * FROM ".$table);
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

	public function getAllRecordinvoice_details($invoice_no)
	{
		$pre_stmt=$this->conn->prepare("SELECT * FROM invoice_details where invoice_no=".$invoice_no);
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

	public function getAllRecordExcept($table,$pk,$id)
	{
		$pre_stmt=$this->conn->prepare("SELECT * FROM ".$table." WHERE ".$pk." != ".$id);
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
	
	public function addBrand($brand_name)
	{
		$pre_stmt=$this->conn->prepare("INSERT INTO `brands`(`brand_name`, `status`) VALUES (?,?)");
		$status=1;
		$pre_stmt->bind_param("si",$brand_name,$status);
		$result=$pre_stmt->execute() or die($this->conn->error);
		if ($result) {
			return "BRAND_ADDED";
		}
		else
		{
			return 0;
		}
	}
	public function addProduct($cid,$bid,$product_name,$product_price,$product_qty,$added_date)
	{
		$added_date = date("Y-m-d", strtotime($added_date));
		$pre_stmt=$this->conn->prepare("INSERT INTO `products`(`cid`, `bid`, `product_name`, `product_price`, `product_stock`, `added_date`, `p_status`) VALUES (?,?,?,?,?,?,?)");
		$status=1;
		$pre_stmt->bind_param("iisdisi",$cid,$bid,$product_name,$product_price,$product_qty,$added_date,$status);
		$result=$pre_stmt->execute() or die($this->conn->error);
		if ($result) {
			return "PRODUCT_ADDED";
		}
		else
		{
			return 0;
		}
	}
	public function addCustomer($company,$gst,$mobile,$address,$email,$city)
	{
		$pre_stmt=$this->conn->prepare("INSERT INTO `customers`(`company_name`, `gst`, `mobile`, `address`,`email`,`city`) VALUES (?,?,?,?,?,?)");
		$pre_stmt->bind_param("ssssss",$company,$gst,$mobile,$address,$email,$city);
		$result=$pre_stmt->execute() or die($this->conn->error);
		if ($result) {
			return "CUSTOMER_ADDED";
		}
		else
		{
			return 0;
		}
	}
	public function addSupplier($supplier_name,$supplier_gst,$supplier_mobile,$supplier_address,$supplier_email,$supplier_city)
	{
		$pre_stmt=$this->conn->prepare("INSERT INTO `suppliers`(`supplier_name`, `supplier_gst`, `supplier_mobile`, `supplier_address`, `supplier_email`, `supplier_city`) VALUES (?,?,?,?,?,?)");
		$pre_stmt->bind_param("ssssss",$supplier_name,$supplier_gst,$supplier_mobile,$supplier_address,$supplier_email,$supplier_city);
		$result=$pre_stmt->execute() or die($this->conn->error);
		if ($result) {
			return "SUPPLIER_ADDED";
		}
		else
		{
			return 0;
		}
	}
	public function addStock($product_id,$stock_added,$current_stock,$purchase_date,$supplier_name,$bill_no,$price_purchase)
	{
		$pre_stmt=$this->conn->prepare("INSERT INTO `purchase`(`product_id`, `stock_added`, `purchase_date`,`supplier_name`,`bill_no`,`price_purchase`) VALUES (?,?,?,?,?,?)");
		$purchase_date = date("Y-m-d", strtotime($purchase_date));
		$pre_stmt->bind_param("issssd",$product_id,$stock_added,$purchase_date,$supplier_name,$bill_no,$price_purchase);
		$result=$pre_stmt->execute() or die($this->conn->error);
		if ($result) 
		{
			$pre_stmt1=$this->conn->prepare("UPDATE `products` SET `product_stock`= product_stock + ? WHERE pid = ".$product_id);
				
			$pre_stmt1->bind_param("i",$stock_added);
			$result1=$pre_stmt1->execute() or die($this->conn->error);
			if ($result1)
			{

				return "STOCK_ADDED";
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
	
	public function editCustomer($id,$company,$gst,$mobile,$address,$email,$city)
	{
		$pre_stmt=$this->conn->prepare("UPDATE `customers` SET `company_name`= ?,`gst`= ?,`mobile`=?,`address`= ?,`email`= ?,`city`= ? WHERE id = ?");
		$pre_stmt->bind_param("ssssssi",$company,$gst,$mobile,$address,$email,$city,$id);
		$result=$pre_stmt->execute() or die($this->conn->error);
		if ($result) {
			return "CUSTOMER_EDITTED";
		}
		else
		{
			return 0;
		}
	}
	public function editSupplier($supplier_id,$supplier_name,$supplier_gst,$supplier_mobile,$supplier_address,$supplier_email,$supplier_city)
	{
		$pre_stmt=$this->conn->prepare("UPDATE `suppliers` SET `supplier_name`=?,`supplier_gst`=?,`supplier_mobile`=?,`supplier_address`=?,`supplier_email`=?,`supplier_city`=? WHERE id = ?");
		$pre_stmt->bind_param("ssssssi",$supplier_name,$supplier_gst,$supplier_mobile,$supplier_address,$supplier_email,$supplier_city,$supplier_id);
		$result=$pre_stmt->execute() or die($this->conn->error);
		if ($result) {
			return "SUPPLIER_EDITTED";
		}
		else
		{
			return 0;
		}
	}
	public function getInvoiceRecord_of_invoice($id)
	{
		$pre_stmt=$this->conn->prepare("SELECT * FROM invoice I LEFT JOIN invoice_details ID ON I.invoice_no = ID.invoice_no where I.invoice_no = ".$id);
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
  // $opr= new DBOperation();
  // print_r( $opr->getInvoiceRecord_of_invoice(7));

// // print_r($opr->getAllRecord("categories"));
//  echo $opr->editCustomer(1,"Ganpati Bappa","123456789","9821426800","C","V","India","Mah","Mum","400068")
?>