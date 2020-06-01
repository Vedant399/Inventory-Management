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
	<?php include_once("./database/constants.php")?>

	<?php include("./templates/navbar.php"); ?>
	<?php

		if (isset($_GET["msg"]) AND !(empty($_GET["msg"])) AND isset($_GET["category"]) AND !(empty($_GET["category"]))) {
			?>
			<div class="alert alert-<?php echo $_GET["category"]?> alert-dismissible fade show" role="alert">
				  <strong><?php echo $_GET["msg"]?></strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="manage_brands_close">
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
                <li class="breadcrumb-item"><a href="manage_brands.php">Manage Brands</a></li>
              </ol>
          </nav>
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            
          <h1 class="h2">Brands</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
              </div>
              <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#brand_add_modal"><i class="fas fa-plus"></i>&nbsp;Add Brand</a>
            </div>
          </div>
	<table id="example_brand" class="display" style="width:100%; font-size: 20px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Brand</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
         <tbody id="manage_brand">

	<?php
	$count=1;
		$conn = mysqli_connect("localhost","root","","project_inventory_management","3306");
		$query=mysqli_query($conn,"SELECT * from brands");
        while($row=mysqli_fetch_array($query))
        {
    ?>
			<tr>
	            <td style="width: 8%"><?php echo $count++?></td>
	            <td><?php echo $row['brand_name']; ?></td>
	           	<?php
	            if($row['status'] == 1)
	            {
	            ?>
	            	<td><span class="btn btn-success" style="width: 8rem"><span class="fas fa-running"></span>&nbsp;&nbsp;Active</span></td>
	            <?php
	            }
	            else
	            {
	            ?>
	            	<td><span class="btn btn-warning" style="width:8rem"><span class="fas fa-male"></span>&nbsp;&nbsp;DeActivate</span></td>
	            <?php
	            }
	            ?>
	            
	            
	            <td>
	              <div class="row">
	                <div class="btn-group">
	                  <a href="#" class="btn btn-primary edit_brand" data-toggle="modal" data-target="#brand_update_modal" style="margin-right:10px;" eid="<?php echo $row['bid']?>"><span class="fas fa-edit"></span></a>
	                  <a href="#" did="<?php echo $row['bid']?>" class="btn btn-danger delete_brand"><span class="fas fa-trash"></span></a>
	                  
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
		                <th>Brand</th>
		                <th>Status</th>
		                <th>Action</th>
		            </tr>
		        </tfoot>
		    </table>
		    </div>
		    <?php 
				include('./templates/brand_add_modal.php');
				include('./templates/brand_update_modal.php');
		    ?>

	
</body>
</html>