<?php
include_once("./database/constants.php");
if(isset($_SESSION["userid"]))
{
	header('location:'.DOMAIN."/dashboard.php");
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
	<link rel="stylesheet" type="text/css" href="./includes/style.css">
	 

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js">
    	
    </script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="js/main.js"></script>
   
    
</head>
<body>
	<?php include("./templates/navbar.php"); ?>
	<div class="container" style="margin-top:3%">

		<?php

		if (isset($_GET["msg"]) AND !(empty($_GET["msg"]))) {
			?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				  <strong><?php echo $_GET["msg"]?></strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
			</div>
			<?php
		}

		?>
		<div class="card mx-auto" style="width: 20rem; height: 34.5rem">
			<img src="images/user_login.png" class="card-img-top mx-auto" style="width:45%;margin-top:5%" alt="user login">
		<div class="card-body mx-auto">
			<h2 class="card-title">Login</h2>
		    <form method="POST" id="login_form" onsubmit="return false">
			  <div class="form-group">
			    <label for="email">Email address</label>
			    <input type="email" class="form-control" id="email" name="email" aria-describedby="e_error">
			    <small id="e_error" class="form-text text-muted">We'll never share your email with anyone else.</small>
			  </div>
			  <div class="form-group">
			    <label for="password">Password</label>
			    <input type="password" class="form-control" id="password" name="password">
			    <small id="p_error" class="form-text text-muted"></small>
			  </div>
			  <button type="submit" class="btn btn-primary"><i class="fas fa-lock">&nbsp;</i>Login</button>
			  <span><a href="register.php" >Register</a></span>
			  
			</form>
  		</div>
  		<div>
  			<div class="card-footer">
  				<a href="#">Forget Password?</a>
  			</div>
  		</div>
	</div>
</div>

</body>
</html>
