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
	<div class="container">
		<div class="row" style="margin-top: 3%">
			<div class="col-md-6">
				<div class="card mx-auto">
				  <div class="card-header">
				    <h5>Sales Report</h5>
				  </div>
				  <div class="card-body">
				    <h5 class="card-title">Get Sales Report</h5>
				    <form id="sales_report_1" method="POST" onsubmit="return false">
				    	<div class="row">
				    		<div class="col-md-6">
				    			<div class="form-group">
				    				<label for="start_date_sales_report">From</label>
						    		<input type="date" name="start_date_sales_report" id="start_date_sales_report" class="form-control">
						    	</div>
				    		</div>
				    		<div class="col-md-6">
				    			<div class="form-group">
				    				<label for="end_date_sales_report">To</label>
						    		<input type="date" name="end_date_sales_report" id="end_date_sales_report" class="form-control" >
						    	</div>
				    		</div>
				    	</div>
				    		<button type="submit" class="btn btn-success" style="width: 100%"><i class="fas fa-print"></i>&nbsp;Sales Report</button>
				    </form>
				  </div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card mx-auto">
				  <div class="card-header">
				    <h5>Purchase Report</h5>
				  </div>
				  <div class="card-body">
				    <h5 class="card-title">Get Purchase Report</h5>
				    <form id="purchase_report" onsubmit="return false">
				    	<div class="row">
				    		<div class="col-md-6">
				    			<div class="form-group">
				    				<label for="start_date_purchase_report">From</label>
						    		<input type="date" name="start_date_purchase_report" id="start_date_purchase_report" class="form-control" required>
						    	</div>
				    		</div>
				    		<div class="col-md-6">
				    			<div class="form-group">
				    				<label for="end_date_purchase_report">To</label>
						    		<input type="date" name="end_date_purchase_report" id="end_date_purchase_report" class="form-control" required>
						    	</div>
				    		</div>
				    	</div>
				    	<center>
				    		<button type="submit" class="btn btn-primary" style="width: 100%"><i class="fas fa-print"></i>&nbsp;Purchase Report</button>
				    	</center>
				    </form>
				  </div>
				</div>
			</div>
		</div>

		<div class="row" style="margin-top: 5%">
			<div class="col-md-6">
				<div class="card mx-auto">
				  <div class="card-header">
				    <h5>Purchase Stocks</h5>
				  </div>
				  <div class="card-body">
				    <h5 class="card-title">Get Purchase stocks Report</h5>
				    <form id="purchase_stocks" onsubmit="return false">
				    	<div class="row">
				    		<div class="col-md-6">
				    			<div class="form-group">
				    				<label for="start_date_purchase_stocks">From</label>
						    		<input type="date" name="start_date_purchase_stocks" id="start_date_purchase_stocks" class="form-control" required>
						    	</div>
				    		</div>
				    		<div class="col-md-6">
				    			<div class="form-group">
				    				<label for="end_date_purchase_stocks">To</label>
						    		<input type="date" name="end_date_purchase_stocks" id="end_date_purchase_stocks" class="form-control" required>
						    	</div>
				    		</div>
				    	</div>
				    	<center>
				    		<button type="submit" class="btn btn-primary" style="width: 100%"><i class="fas fa-print"></i>&nbsp;Purchase Stocks Report</button>
				    	</center>
				    </form>
				  </div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card mx-auto">
				  <div class="card-header">
				  	<h5>Stocks Reports</h5>
				  </div>
				  <div class="card-body">
				    <h5 class="card-title">Get Stocks Report</h5>
				    <form id="stocks_report" onsubmit="return false">
				    	<div class="row">
				    		<div class="col-md-6">
				    			<div class="form-group">
				    				<label for="start_date_stocks_report">From</label>
						    		<input type="date" name="start_date_stocks_report" id="start_date_stocks_report" class="form-control" required>
						    	</div>
				    		</div>
				    		<div class="col-md-6">
				    			<div class="form-group">
				    				<label for="end_date_stocks_report">To</label>
						    		<input type="date" name="end_date_stocks_report" id="end_date_stocks_report" class="form-control" required>
						    	</div>
				    		</div>
				    	</div>
				    	<center>
				    		<button type="submit" class="btn btn-success" style="width: 100%"><i class="fas fa-print"></i>&nbsp;Stocks Report</button>
				    	</center>
				    </form>
				  </div>
				</div>
			</div>
		</div>





	</div>

</body>
</html>
