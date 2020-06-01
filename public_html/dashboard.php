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

    <script type="text/javascript" src="js/main.js"></script>
   
    
</head>
<body>
	<?php include_once("./database/constants.php")?>

	<?php include("./templates/navbar.php"); ?>
	<?php

		if (isset($_GET["msg"]) AND !(empty($_GET["msg"])) AND isset($_GET["category"]) AND !(empty($_GET["category"]))) {
			?>
			<div class="alert alert-<?php echo $_GET["category"]?> alert-dismissible fade show" role="alert">
				  <strong><?php echo $_GET["msg"]?></strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="dashboard_close">
				    <span aria-hidden="true">&times;</span>
				  </button>
			</div>
			<?php
		}

		?>
	<br>
	
	<div class="container dashboard" style="margin-top: 0.5%">
		<nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
              </ol>
          </nav>
		<div class="row">
			<div class="col-md-4">
				<div class="card mx-auto" style="width: 20rem;">
				  <img src="images/user_dashboard.png" class="card-img-top mx-auto" style="width:75%;margin-top:5%" alt="user logged in">
				  <div class="card-body">
				    <h5 class="card-title">Profile Info</h5>				    
				    <p class="card-text"><i class="fas fa-user"></i>&nbsp;&nbsp;<strong><?php echo $_SESSION['username']?></strong></p>
				    <p class="card-text"><i class="fas fa-user-cog"></i>&nbsp;&nbsp;<strong><?php echo $_SESSION['usertype']?></strong></p>
				    <p class="card-text"><i class="far fa-clock"></i>&nbsp;&nbsp;Last Login <strong><?php echo $_SESSION['last_login']?></strong></p>
				    <a href="#" class="btn btn-primary"><i class="fas fa-user-edit"></i>&nbsp;&nbsp;Edit Profile</a>
				  </div>
				</div>
			</div>
			<div class="col-md-8 mx-auto">
				
				<div class="jumbotron" style="width: 100%;height: 100%;">
					<div class="row">
						<div class="col-md-6"><h1>Welcome Admin</h1></div>
						<div class="col-md" style="margin-top: 2%"><iframe src="http://free.timeanddate.com/clock/i7altvdv/n44/tlin/fs20/tct/pct/ftb/tt0/tw0/tm1/tb2" frameborder="0" width="202" height="27" allowTransparency="true"></iframe>
						</div>
						
					</div>
					<div class="row">
						<div class="col-sm-6" style="margin-top:2%">
							<div class="card">
						      <div class="card-body">
						        <h5 class="card-title">New Customers</h5>
						        <p class="card-text">Here you can add new Customers to advance you business</p>
						        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#customer_add_modal"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a>
						        
						        <a href="manage_customer.php" class="btn btn-success"><i class="fas fa-edit"></i>&nbsp;Manage</a>
						      </div>
						    </div>
						</div>
						<div class="col-sm-6" style="margin-top:2%">
							<div class="card">
						      <div class="card-body">
						        <h5 class="card-title">New Orders</h5>
						        <p class="card-text">Here you can make invoices and create new Orders</p>
						        <a href="new_order.php" class="btn btn-primary"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add</a>
						        <a href="manage_invoices.php" class="btn btn-success"><i class="fas fa-edit"></i>&nbsp;&nbsp;Manage</a>
						      </div>
						    </div>
							
						</div>
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container" style="margin-top: 2%">
	<div class="row">
		<div class="col-md-4">
			<div class="card mx-auto" style="width: 20rem;">
		      <div class="card-body">
		        <h5 class="card-title">Manage Categories & Brands</h5>
		        <p class="card-text">Here you can manage your categories and add new parent categories</p>
		        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#category_add_modal"><i class="fas fa-plus"></i>&nbsp;Cat</a>
		        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#brand_add_modal"><i class="fas fa-plus"></i>&nbsp;Brand</a>
		        <a href="manage_categories.php" class="btn btn-success"><i class="fas fa-edit"></i>&nbsp;Manage</a>
		      </div>
		    </div>
		</div>
		<div class="col-md-4">
			<div class="card" style="width: 21rem;">
		      <div class="card-body">
		        <h5 class="card-title">Suppliers</h5>
		        <p class="card-text">Here you can manage Supplier Purchase and add new suppliers</p>
		        
		        <a href="#" class="btn btn-info" data-toggle="modal" data-target="#supplier_add_modal"><i class="fas fa-plus"></i>&nbsp;Suplier</a>
		        <a href="manage_suppliers.php" class="btn btn-success"><i class="fas fa-edit"></i>&nbsp;Manage</a>
		      </div>
		    </div>
		</div>
		<div class="col-md-4">
			<div class="card" style="width: 22rem;">
		      <div class="card-body">
		        <h5 class="card-title">Products</h5>
		        <p class="card-text">Here you can manage Products and add new Products</p>
		        <a href="#" id="product_add_modal_button" class="btn btn-primary" data-toggle="modal" data-target="#product_add_modal"><i class="fas fa-plus"></i>&nbsp;Add</a>
		        <a href="#" class="btn btn-info stock_add" data-toggle="modal" data-target="#stock_add_modal" id="stock_add"><i class="fas fa-boxes"></i>&nbsp;Stock</a>
		        <a href="manage_products.php" class="btn btn-success"><i class="fas fa-edit"></i>&nbsp;Manage</a>

		      </div>
		    </div>
		</div>
	</div>
</div>

<?php 

include('templates/category_add_modal.php');
include('templates/brand_add_modal.php');
include('templates/products_add_modal.php');
include('templates/customer_add_modal.php');
include('templates/stock_add_modal.php');
include('templates/supplier_add_modal.php');

?>

</body>
</html>
