<?php

include_once('./database/constants.php');
if (!isset($_SESSION["userid"])) {
	header('location:'.DOMAIN.'/');
}


?>
<!DOCTYPE html>
<html>
<head>
	<title>Inventory Management</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit-no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
	 

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js">
    	
    </script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/main.js"></script>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js">
    	
    </script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/order.js"></script>
    <style type="text/css">
    	#category_add_modal
		{
		    background: rgba(240, 248, 255, 0.18);
		}
		#payment_details:link
		{
			text-decoration: none;
			
		}
		#payment_details:hover
		{
			text-decoration: underline;
		}
    </style>
</head>
<body>
	<?php include_once("./database/constants.php");?>

	<?php include("./templates/navbar.php"); ?>

	<?php

		if (isset($_GET["msg"]) AND !(empty($_GET["msg"])) AND isset($_GET["category"]) AND !(empty($_GET["category"]))) {
			?>
			<div class="alert alert-<?php echo $_GET["category"]?> alert-dismissible fade show" role="alert">
				  <strong><?php echo $_GET["msg"]?></strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="manage_invoice_close">
				    <span aria-hidden="true">&times;</span>
				  </button>
			</div>
			<?php
		}

		?>
	

<div class="container" style="margin-top:2%;margin-bottom: 2%">
	<nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="manage_invoices.php">Manage Invoices</a></li>               
              </ol>
          </nav>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            
          <h1 class="h2">Invoices</h1>
          <form onsubmit="return false" id="date_picker">
              	<div class="form-group col-md-12" style="margin:auto;">
              		<h2><input type="month" name="date" id="date" class="form-control date"></h2>
              	</div>
              	</form>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
              </div>
              <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
              </div>
              <a href="new_order.php" class="btn btn-primary"><i class="fas fa-plus" ></i>&nbsp;Place New Order</a>
            </div>
          </div>
          
	<table id="example_invoices" class="display" style="width:100%; font-size: 20px;">

        <thead>
            <tr>
                <th style="width:15%">Chalan No</th>
                <th>Date</th>
                <th>Customer</th> 
                <th style="width:20%">Amount to Pay</th>           
                <th align="center">Paid</th>
                
                <th style="widows:10%">Complete</th>
                <th>Action</th>
            </tr>
        </thead>
         <tbody id="invoice_body">

	<?php
		$count=1;
		$conn = mysqli_connect("localhost","root","","project_inventory_management","3306");
		$query=mysqli_query($conn,"SELECT * FROM invoice");
        while($row=mysqli_fetch_array($query))
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
	    }?>
		</tbody>
		        <tfoot>
		            <tr>
		                <th>Chalan No</th>
		                <th>Date</th>
		                <th>Customer</th>  
						<th>Amount to Pay</th>          
		                <th>Paid</th>
		                <th>Complete</th>
		                <th>Action</th>
		            </tr>
		        </tfoot>
		    </table>
		    </div>

		    <?php

		    include ("./templates/invoice_edit_modal.php");

		    ?>
</body>
</html>