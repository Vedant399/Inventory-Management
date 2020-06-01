<?php

include_once('./database/constants.php');
if (!isset($_SESSION["userid"])) {
	header('location:'.DOMAIN.'/');
}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Inventory Management</title>
	<meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit-no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	 

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js">
    	
    </script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="js/numberToWords.js"></script>
    <script type="text/javascript" src="js/order.js"></script>
   <style type="text/css">
   	#spinner { display:none; } 
	body.busy .spinner { display:block !important; }
   </style>
    
</head>
<body>
	<?php include_once("./database/constants.php")?>

	<?php include("./templates/navbar.php"); ?>

	<div class="container" style="margin-top:1.5%">
		<nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li> 
                <?php

                if (isset($_GET["invoice_no"])) {
                	?>

                	<li class="breadcrumb-item"><a href="new_order.php">Edit Order</a></li>

                	<?php
                	
                }
                else
                {
                	?>

                	<li class="breadcrumb-item"><a href="new_order.php">New Order</a></li>

                	<?php
                }

                ?>
                
              </ol>
          </nav>
		<div class="row">
			<div class="col-md-10">
				<div class="card" style="width:70rem">
					  <div class="card-header">
					  	<?php

					  	if (isset($_GET["invoice_no"])) {
					  		?>

					  		<h5>Edit Order</h5>

					  		<?php
					  	}

					  		else
					  		{
					  			?>

					  			<h5>Place New Order</h5>

					  			<?php
					  		}
					  	

					  	?>
					    
					  </div>
					  <div class="card-body" style="width: 100%">
					   <!-- <h1>Shree Ganeshay Namah</h1> -->
					  <form id="new_order" method="POST" action="./includes/invoice_bill.php" onsubmit="return false" autocomplete="off">
						  <div class="form-row">
						    <div class="form-group col-md-3">
						      <label for="chalan_no" class="col-for-label"><b>Chalan NO.</b></label>
						    <?php

						    $conn = mysqli_connect("localhost","root","","project_inventory_management","3306");
						    if (isset($_GET["invoice_no"])) {
						    	$query=mysqli_query($conn,"SELECT * FROM invoice where invoice_no = ".$_GET["invoice_no"]);
						    }
						    else{
								$query=mysqli_query($conn,"SELECT * FROM invoice where invoice_no = (SELECT MAX(invoice_no) FROM invoice)");
							}
								$row=mysqli_fetch_array($query);
						    ?>
						    </div>
						    <?php

						    if (isset($_GET["invoice_no"])) {
						    	

						    	?>

						    	<div class="form-group col-md-8">
						      	<input type="text" class="form-control" id="chalan_no" name="chalan_no" value="<?php echo $_GET['invoice_no']?>" readonly>
						    	</div>

						    	<?php
						    }
						    else
						    {
						    	?>
						    	<div class="form-group col-md-8">
						      	<input type="text" class="form-control" id="chalan_no" name="chalan_no" value="<?php echo $row['invoice_no']+1?>" readonly>
						    	</div>
						    	<?php
						    }

						    ?>
						    
						  </div>
						  <div class="form-row">
						    <div class="form-group col-md-3">
						      <label for="orderdate" class="col-for-label"><b>Order Date</b></label>
						    </div>
						    <?php


						    if (isset($_GET["invoice_no"])) {
						    	?>
						    	<div class="form-group col-md-8">
						    		<?php

						    		$newDate = date("d-m-Y", strtotime($row["order_date"]));
						    		?>
						      	<input type="text" class="form-control" id="orderdate" name="orderdate" value="<?php echo $newDate?>">
						    	</div>
						    	<?php
						    }
						    else{

						    	?>

						    	<div class="form-group col-md-8">
						      <input type="text" class="form-control" id="orderdate" name="orderdate" value="<?php
						      date_default_timezone_set("Asia/Calcutta");
							  echo date("d-m-Y");
						      ?>">
						    </div>

						    	<?php
						    }

						    ?>
						    
						  </div>
						  <div class="form-row">
						    <div class="form-group col-md-3">
						      <label for="customername" class="col-for-label"><b>Customer Name</b>&nbsp;<span class="text-danger">*</span></label>
						    </div>
						    <div class="form-group col-md-8">
						      <select class="form-control" id="customername" name="customername">
						      	
						      	
						      </select>
						      <small id="customername_error" class="form-text text-muted"></small>
						    </div>
						  </div>
						  <div class="form-group">
						  	 <div class="card">
							  <div class="card-header">
							    <h5>Order List&nbsp;<span class="text-danger">*</span></h5>
							  </div>
							  <div class="card-body">
							    <table class="table table-striped" align="center">
								  <thead>
								    <tr>
								      <th scope="col" style="text-align: center;">#</th>
								      <th scope="col" style="text-align: center;">Item Name</th>
								      <th scope="col" style="text-align: center;width:20%">Remark</th>
								      <th scope="col" style="text-align: center;width:15%">Stock</th>
								      <th scope="col" style="text-align: center;width:15%">Quantity</th>
								      <th scope="col" style="text-align: center;width:15%">Price /pc</th>
								      <th scope="col" style="text-align: center;">Total&nbsp;(<i class="fas fa-rupee-sign">)</i></th>
								    </tr>
								  </thead>
								  <tbody id="invoice_item" style="text-align: center">
								  		
								    <!-- <tr>
								      <td><b id="number">1</b></td>
								      <td><select name="pid[]" class="form-control ">
								      	<option>Washing Machine</option>
								      </select></td>
								      <td>
								      	<input type="text" name="tqty[]" class="form-control " readonly>
								      </td>
								      <td>
								      	<input type="text" name="qty[]" class="form-control ">
								      </td>
								      <td>
								      	<input type="text" name="price[]" class="form-control " readonly>
								      </td>
								      <td>1540</td>
								    </tr> -->
								  </tbody>
								</table>
								<center class="form-group">
									<a href="#" id="add" style="width:200px;" class="btn btn-success"><i class="fas fa-shopping-cart"></i>&nbsp;&nbsp;Add Order</a>
									<a href="#" id="remove" style="width:200px;margin-left: 3%" class="btn btn-danger"><i class="fas fa-eraser"></i>&nbsp;&nbsp;Remove Order</a>
								</center>
							  </div>
							</div>
						  </div>

						  <div class="form-row">
						    <div class="form-group col-md-3">
						      <label for="sub_total" class="col-for-label"><b>Sub Total</b></label>
						    </div>
						    <div class="form-group col-md-8">
						      <input type="text" class="form-control" id="sub_total" name="sub_total" readonly>
						    </div>
						  </div>
						  <div class="form-row">
						    <div class="form-group col-md-3">
						      <label for="gst" class="col-for-label"><b>Freight</b></label>
						    </div>
						    <?php

						    if (isset($_GET["invoice_no"])) {
						    	?>


						    	<div class="form-group col-md-8">
							      <input type="number" class="form-control gst" id="gst" name="gst" value="<?php echo $row['gst']?>">
							      <small id="gst_error" class="form-text text-muted"></small>
							    </div>

						    	<?php
						    }
						    else
						    {
						    	?>

						    	<div class="form-group col-md-8">
						      <input type="number" class="form-control gst" id="gst" name="gst" value="0">
						      <small id="gst_error" class="form-text text-muted"></small>
						    </div>

						    	<?php
						    }

						    ?>
						    
						  </div>
						  <div class="form-row">
						    <div class="form-group col-md-3">
						      <label for="discount" class="col-for-label"><b>Discount</b></label>
						    </div>
						    <div class="form-group col-md-8">
						      <input type="number" class="form-control discount" id="discount" name="discount" value="0">
						      <small id="discount_error" class="form-text text-muted"></small>
						    </div>
						  </div>
						  <div class="form-row">
						    <div class="form-group col-md-3">
						      <label for="net_total" class="col-for-label"><b>Net Total</b></label>
						    </div>
						    <div class="form-group col-md-8">
						      <input type="text" class="form-control" id="net_total" name="net_total" readonly value="0">
						    </div>
						  </div>
						  <div class="form-row">

						    <div class="form-group col-md-3">
						      <label for="paid" class="col-for-label"><b>Paid&nbsp;<span class="text-danger">*</span></b></label>
						    </div>
						    <?php

						  	if (isset($_GET["invoice_no"])) {
						  		?>
							<div class="form-group col-md-8">
						      <input type="number" class="form-control paid" id="paid" name="paid" value="<?php echo $row['paid']?>" readonly>
						      <small id="paid_error" class="form-text text-muted"></small>
						    </div>

						  		<?php
						  	}
						  	else
						  	{
						  		?>

						  		<div class="form-group col-md-8">
						      <input type="number" class="form-control paid" id="paid" name="paid" value="0">
						      <small id="paid_error" class="form-text text-muted"></small>
						    </div>

						  		<?php
						  	}


						  	?>
						    
						  </div>
						  <div class="form-row">
						    <div class="form-group col-md-3">
						      <label for="due" class="col-for-label"><b>Due</b></label>
						    </div>
						    <div class="form-group col-md-8">
						      <input type="number" class="form-control" id="due" name="due" readonly>
						    </div>
						  </div>
						  <div class="form-row">
						    <div class="form-group col-md-3">
						      <label for="payment_type" class="col-for-label"><b>PO NO.</b></label>
						    </div>
						    <div class="form-group col-md-8">
						      
						      <input type="text" class="form-control" name="payment_type" id="payment_type">
						    </div>
						  </div>	
						  <center class="fom-group">
						  	<button type="submit" style="width:200px" class="btn btn-info" id="order_form"><i class="fas fa-print"></i>&nbsp;&nbsp;Place Order</button>
						  	<button type="submit" style="width:200px" id="print_invoice" class="btn btn-primary d-none"><i class="fas fa-print"></i>&nbsp;&nbsp;Print Invoice</button>
						  </center>
						</form>
					  </div>
					</div>
			</div>
		</div>
	</div>

</body>
</html>
