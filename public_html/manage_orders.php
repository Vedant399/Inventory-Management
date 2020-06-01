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
    <style type="text/css">
    	#category_add_modal
		{
		    background: rgba(240, 248, 255, 0.18);
		}
    </style>
</head>
<body>
	<?php include_once("./database/constants.php");?>

	<?php include("./templates/navbar.php"); ?>
	

<div class="container" style="margin-top:2%;margin-bottom: 2%">
	<nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <?php

                if (isset($_GET["product_name"])) {
                	?>
                	<li class="breadcrumb-item"><a href="manage_products.php">Manage Products</a></li>
                	<?php
                }
                else
                {
                	if (isset($_GET["invoice_no"])) {
                		?>

                		<li class="breadcrumb-item"><a href="manage_invoices.php">Manage Invoices</a></li>

                		<?php

                	}

                	else if (isset($_GET["customer_name"])) {
                		?>

                		<li class="breadcrumb-item"><a href="manage_customer.php">Manage Customers</a></li>

                		<?php

                	}
                }

                ?>
                <li class="breadcrumb-item"><a href="manage_orders.php">Manage Orders</a></li>               
              </ol>
          </nav>
          <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom" style="margin-top: 3%;">
          	<?php

          	if (isset($_GET["product_name"])) {
          		?>
          		<h4>Total Sale of <?php echo $_GET["product_name"]?></h4>
          		<?php
          	}
          	else
          	{
          	?>
          	<h4>Total Sale to <?php echo $_GET["customer_name"]?></h4>
          	<?php	
          	}

          	?>
            
          
          </div>
	<table id="example_orders" class="display" style="width:100%; font-size: 20px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Invoice No</th>
                <th>Customer</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
         <tbody>

	<?php
		$count=1;
		$conn = mysqli_connect("localhost","root","","project_inventory_management","3306");
		if (isset($_GET["invoice_no"])) {
			$query=mysqli_query($conn,"SELECT * FROM invoice I LEFT JOIN invoice_details ID ON I.invoice_no = ID.invoice_no where ID.invoice_no =".$_GET["invoice_no"]);
		}
		else
		{
			if (isset($_GET["customer_name"])) {
				
				$query=mysqli_query($conn,"SELECT * FROM invoice I LEFT JOIN invoice_details ID ON I.invoice_no = ID.invoice_no where customer_name= '".$_GET["customer_name"]."'");

			}
			else
			{
		$query=mysqli_query($conn,"SELECT * FROM invoice I LEFT JOIN invoice_details ID ON I.invoice_no = ID.invoice_no where product_name= '".$_GET["product_name"]."'");
	}
	}
        while($row=mysqli_fetch_array($query))
        {
    ?>
			<tr>
	            <td style="width: 5%"><?php echo $count++?></td>
	            <td><?php echo $row['product_name']; ?></td>
	            <td align="center"><?php echo $row['invoice_no']; ?></td>
	            <td><?php echo $row['customer_name']; ?></td>
	            <td align="center" style="width: 5%"><?php echo $row['qty']; ?></td>
	            <td><?php echo $row['price']; ?></td>
	            <td><?php echo date("d-m-Y", strtotime($row['order_date'])); ?></td>

	            <td>
	              <div class="row">
	                <div class="btn-group">
	                  
	                  <a href="new_order.php?invoice_no=<?php echo $row['invoice_no'] ?>&customer_name=<?php echo $row['customer_name'] ?>" class="btn btn-success"><span class="fas fa-print"></span></a>
	                  
	                </div>
	              </div>
	            </td>
	           
	    	</tr>
	    	<?php
	    }?>
		</tbody>
		        <tfoot>
		            <tr>
		                <th>ID</th>
		                <th>Product Name</th>
		                <th>Invoice No</th>
		                <th>Customer</th>
		                <th>Quantity</th>
		                <th>Price</th>
		                <th>Date</th>
		                <th>Action</th>
		            </tr>
		        </tfoot>
		    </table>
		    </div>
</body>
</html>