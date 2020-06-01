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

                if (isset($_GET["supplier_name"])) {
                    ?>
<li class="breadcrumb-item"><a href="manage_suppliers.php">Manage Suppliers</a></li>
                    <?php
                }
                else
                {
                    ?>

<li class="breadcrumb-item"><a href="manage_products.php">Manage Products</a></li>
                    <?php
                }

                ?>
                
                	
                <li class="breadcrumb-item"><a href="purchase.php">Manage Purchases</a></li>               
              </ol>
          </nav>
          <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom" style="margin-top:3%">
            
            <?php

            if (isset($_GET["supplier_name"])) {
               
               ?>
               <h4>Total Purchase from <?php echo $_GET["supplier_name"]?></h4>
               <?php 
            }
            else
            {
                ?>
                <h4>Total Purchase of <?php echo $_GET["product_name"]?></h4>
                <?php
            }

            ?>
          
          </div>
	<table id="example_purchase" class="display" style="width:100%; font-size: 20px;">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Supplier</th>
                <th>Bill NO.</th>
                <th>Cost</th>
                <th>Purchase</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
         <tbody>

	<?php
		$count=1;
		$conn = mysqli_connect("localhost","root","","project_inventory_management","3306");
        if (isset($_GET["supplier_name"])) {
          $query=mysqli_query($conn,"SELECT * FROM purchase where supplier_name = '".$_GET["supplier_name"]."'");  
        }
        else
        {
		$query=mysqli_query($conn,"SELECT * FROM purchase where product_id = ".$_GET["product_id"]);
    }
        while($row=mysqli_fetch_array($query))
        {
            if (isset($_GET["supplier_name"])) {
                $query1=mysqli_query($conn,"SELECT * FROM products where pid = ".$row["product_id"]);
                $row1=mysqli_fetch_array($query1);
            }
    ?>
			<tr>
	            <td><?php echo $count++?></td>
                <?php

                if (isset($_GET["supplier_name"])) {
                    ?><td><?php echo $row1['product_name']; ?></td><?php
                }
                else
                {
                    ?><td><?php echo $_GET['product_name']; ?></td><?php
                }

                ?>
	            
                <td><?php echo $row['supplier_name']; ?></td>
                <td><?php echo $row['bill_no']; ?></td>
                <td align="center"><?php echo $row['price_purchase']; ?></td>
	            <td align="center"><?php echo $row['stock_added']; ?></td>
	            <td><?php echo date("d-m-Y", strtotime($row["purchase_date"]));?></td>	           
                <td><a href="#" class="btn btn-primary edit_stock" data-toggle="modal" data-target="#stock_edit_modal" eid="<?php echo $row['id']?>"><span class="fas fa-edit"></span></a></td>             
	    	</tr>
	    	<?php
	    }?>
		</tbody>
		        <tfoot>
		            <tr>
		               <th>#</th>
                        <th>Product Name</th>
                        <th>Supplier</th>
                        <th>Bill NO.</th>
                        <th>Cost</th>
                        <th>Purchase</th>
                        <th>Date</th>
                        <th>Action</th>
		            </tr>
		        </tfoot>
		    </table>
		    </div>



            <?php

            include ('./templates/stock_edit_modal.php');

            ?>
</body>
</html>