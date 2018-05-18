<!DOCTYPE html>

<?php
	SESSION_START();
	include_once 'functions/functions.php';
?>
<html>
	<head>
	<title>Checkout</title>
	
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<script src="bootstrap/js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
	<script src="bootstrap/js/myscript.js"></script>
<link rel="stylesheet" href="styles/style.css" media="all">
</head>
<body>
	<div><?php include 'includes/navigation.php'; ?></div>
		<div><?php include 'includes/sidebar.php'; ?></div>
		<div id="checkout">
		<?php/*  cart(); */
		?>
				<?php
					if(!isset($_SESSION['customer_email'])){
						include("includes/customer_login_left.php");
						} else{
						include("payment.php");
					}
				?>
		</div>
		
		<div class="clearfix"></div>
		<div class="clearfix"></div>
	
	<div><?php include "includes/footer.php"; ?></div>
	
</body>
</html>