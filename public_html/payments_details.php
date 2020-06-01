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

                    if (isset($_GET["invoice_no"])) {
                        ?>

                        <li class="breadcrumb-item"><a href="manage_invoices.php">Manage Invoices</a></li>

                        <?php

                    }

                ?>
                <li class="breadcrumb-item"><a href="payment_details.php">Payment Details</a></li>               
              </ol>
          </nav>
          <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom" style="margin-top: 3%;">
            <?php


            if (isset($_GET["invoice_no"])) {
                ?>
                
                <?php

            }
            ?>
            <?php
            $conn = mysqli_connect("localhost","root","","project_inventory_management","3306");
            $query1=mysqli_query($conn,"SELECT * FROM `invoice` WHERE `invoice_no` = ".$_GET["invoice_no"]);
               while( $row1=mysqli_fetch_array($query1))
               {

            if ($row1["due"] == 0) {
                ?>
                <h4>Payment Details of Invoice NO. <?php echo $_GET["invoice_no"]?>&nbsp;&nbsp;<span class="fas fa-check text-success"></span><span class="text-success">&nbsp;&nbsp;Paid</span></h4>
                <?php
            }
            else
            {
                ?>
                <h4>Payment Details of Invoice NO. <?php echo $_GET["invoice_no"]?>&nbsp;&nbsp;<span class="far fa-hand-paper text-warning"></span><span class="text-warning">&nbsp;&nbsp;Due</span></h4>
                <?php
            }
        }

            ?>
            
            
          
          </div>
    <table id="example_payments" class="display" style="width:100%; font-size: 20px;">
        <thead>
            <tr>
                <th>#</th>
                <th style="width:25%">Customer Name</th>
                <th style="width: 25%">Date</th>
                <th style="width: 25%">Paid</th>
                <th>Due</th>
            </tr>
        </thead>
         <tbody>

    <?php
        $count=1;
        $conn = mysqli_connect("localhost","root","","project_inventory_management","3306");
        if (isset($_GET["invoice_no"])) {
            $query=mysqli_query($conn,"SELECT * FROM payment_details P LEFT JOIN invoice I ON I.invoice_no = P.invoice_no where P.invoice_no =".$_GET["invoice_no"]);
        }
        while($row=mysqli_fetch_array($query))
        {
    ?>
            <tr>
                <td style="width: 5%"><?php echo $count++?></td>
                <td><?php echo $row['customer_name']; ?></td>
                <td ><?php echo $row['paid']; ?></td>
                <td><?php echo date("d-m-Y", strtotime($row['payment_date'])); ?></td>
                <td><?php echo $row['due']; ?></td>                              
            </tr>
            <?php
        }?>
        </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Date</th>
                        <th>Paid</th>
                        <th>Due</th>
                    </tr>
                </tfoot>
            </table>
            </div>
</body>
</html>