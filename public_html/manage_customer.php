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
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
	 

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js">
    	
    </script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="js/main.js"></script>
   
   <style type="text/css">
   	
   	#customer_name:link{
   		text-decoration: none;
   	}
   	#customer_name:hover{
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
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="customer_manage_close">
				    <span aria-hidden="true">&times;</span>
				  </button>
			</div>
			<?php
		}

		?>
	<br>
	
	<div class="container" style="margin-top: 0.5%;">
		<nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="manage_customer.php">Manage Customer</a></li>
              </ol>
          </nav>
          <!-- <h1>Shree Ganeshay Namah</h1> -->
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            
          <h1 class="h2">Customers</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
              </div>
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#customer_add_modal"><i class="fas fa-plus"></i>&nbsp;&nbsp;Add Customer</a>
            </div>
          </div>
          
			<table id="example_customer" class="display" style="width:100%; font-size: 18px;">
		        <thead>
		            <tr>
		                <th>ID</th>
		                <th>Company</th>
		                <th>Mobile</th>
		                <th>Email</th>
		                <th style="width:13%">GST</th>
		                <th>Address</th>
		                <th>Action</th>
		            </tr>
		        </thead>
		        <tbody id="customer_table">

				<?php
				$count=1;
					$conn = mysqli_connect("localhost","root","","project_inventory_management","3306");
					$query=mysqli_query($conn,"SELECT * FROM `customers`");
			        while($row=mysqli_fetch_array($query))
			        {
			    ?>
						<tr>
				            <td style="width: 4%"><?php echo $count++?></td>
				            <td><a href="manage_orders.php?customer_name=<?php echo $row['company_name']?>" title="Show Invoice of this Party" id="customer_name" style="color: black"><?php echo $row['company_name']; ?></a></td>
				            <td><?php echo $row['mobile']; ?></td>
				            <td><?php echo $row['email']; ?></td>
				            <td><?php echo $row['gst']; ?></td>
				            <td style="width: 20%"><a href="#" class="btn btn-info add_cust" id="<?php echo $row['id']?>" style="margin-right:10px;" data-toggle="modal" data-target="#address_modal"><i class="far fa-eye"></i>&nbsp;Address</a></td>
				            <td>
				              <div class="row">
				                <div class="btn-group">
				                  <a href="#" class="btn btn-primary edit_cust" eid="<?php echo $row['id']?>" style="margin-right:10px;" data-toggle="modal" data-target="#customer_update_modal"><span class="fas fa-edit"></span></a>
				                  <button did="<?php echo $row['id']?>" class="btn btn-danger delete_cust"><span class="fas fa-trash"></span></button> 
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
				                <th>Company</th>
				                <th>Mobile</th>
				                <th>Email</th>
				                <th>GST</th>
				                <th>Address</th>
				                <th>Action</th>
				            </tr>
				        </tfoot>
				    </table>
	</div>

<?php

include("./templates/customer_add_modal.php");
include("./templates/customer_update_modal.php");
include("./templates/address_modal.php");

?>
</body>
</html>
