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
		#product_name_for_order:link
		{
			text-decoration: none;
		}
		#product_name_for_order:hover
		{
			text-decoration: underline;
		}
		#product_id_for_order:link
		{
			text-decoration: none;
		}
		#product_id_for_order:hover
		{
			text-decoration: underline;
		}
    </style>
</head>
<body>
	<?php include_once("./database/constants.php")?>

	<?php include("./templates/navbar.php"); ?>
	<?php

		if (isset($_GET["msg"]) AND !(empty($_GET["msg"])) AND isset($_GET["category"]) AND !(empty($_GET["category"]))) {
			?>
			<div class="alert alert-<?php echo $_GET["category"]?> alert-dismissible fade show" role="alert">
				  <strong><?php echo $_GET["msg"]?></strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="manage_products_close">
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
                <?php

                if (isset($_GET["product_category"])) {
                	?>
                	<li class="breadcrumb-item"><a href="manage_categories.php">Manage Categories</a></li>
                	<?php
                }

                ?>
                <li class="breadcrumb-item"><a href="manage_products.php">Manage Products</a></li>
              </ol>
          </nav>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            
          <h1 class="h2">Products</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
              </div>
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#product_add_modal" id="product_manage_modal_button"><i class="fas fa-plus" ></i>&nbsp;Add Products</a>
            </div>
          </div>
	<table id="example_product" class="display" style="width:100%; font-size: 18px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
         <tbody id="product_body">

	<?php
	$count=1;
	$conn = mysqli_connect("localhost","root","","project_inventory_management","3306");
	if (isset($_GET["product_category"])) {
		$query=mysqli_query($conn,"SELECT P.pid,P.product_name,P.product_price,C.category_name,B.brand_name,P.product_stock,P.p_status FROM products P LEFT JOIN categories C ON P.cid=C.cid LEFT JOIN brands B ON P.bid=B.bid where C.cid = '".$_GET['product_category']."'");
	}
		else
		{
		$query=mysqli_query($conn,"SELECT P.pid,P.product_name,P.product_price,C.category_name,B.brand_name,P.product_stock,P.p_status FROM products P LEFT JOIN categories C ON P.cid=C.cid LEFT JOIN brands B ON P.bid=B.bid");
	}
        while($row=mysqli_fetch_array($query))
        {
    ?>
			<tr>
	            <td style="width: 5%"><?php echo $count++?></td>
	            <td><a title="show transaction of this product" style="color: black;" id="product_name_for_order" href="manage_orders.php?product_name=<?php echo $row['product_name']; ?>"><?php echo $row['product_name']; ?></a></td>
	            <td><?php echo $row['product_price']; ?></td>
	            <td><?php echo $row['category_name']; ?></td>
	            <td><?php echo $row['brand_name']; ?></td>
	            <td align="center"><a href="purchase.php?product_id=<?php echo $row['pid']?>&product_name=<?php echo $row['product_name']?>" style = "color: black;" title = "Show purchase of this Item" id="product_id_for_order"><?php echo $row['product_stock']; ?></a></td>
	           	<?php
	            if($row['p_status'] == 1)
	            {
	            ?>
	            	<td><span class="btn btn-success" style="width:7rem"><span class="fas fa-running"></span>&nbsp;&nbsp;Active</span></td>
	            <?php
	            }
	            else
	            {
	            ?>
	            	<td><span class="btn btn-warning" style="width:7rem"><span class="fas fa-male"></span>&nbsp;&nbsp;DeActive</span></td>
	            <?php
	            }
	            ?>
	            
	            
	            <td>
	              <div class="row">
	                <div class="btn-group">
	                  <a href="#" class="btn btn-primary edit_product" data-toggle="modal" data-target="#product_update_modal" eid="<?php echo $row['pid']?>" style="margin-right:10px;"><span class="fas fa-edit"></span></a>
	                  <a href="#" did="<?php echo $row['pid']?>" class="btn btn-danger delete_product"><span class="fas fa-trash"></span></a>
	                  
	                </div>
	              </div>
	            </td>
	    	</tr>

    <?php
		}
	?>

		</tbody>
		        <tfoot>
		            <tr>
		                <th>ID</th>
		                <th>Product Name</th>
		                <th>Price</th>
		                <th>Category</th>
		                <th>Brand</th>
		                <th>Stock</th>
		                <th>Status</th>
		                <th>Action</th>
		            </tr>
		        </tfoot>
		    </table>
		    </div>
		    <?php 
				include('./templates/products_add_modal.php');
				include('./templates/products_update_modal.php');
		    ?>

	
</body>
</html>