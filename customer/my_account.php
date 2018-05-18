<!DOCTYPE>
<?php 
	SESSION_START();
	include 'functions/functions.php';
	$error = '';
?>
<html>
<head>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<script src="bootstrap/js/myscript.js"></script>
	<script src="bootstrap/js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
	
	<link rel="stylesheet" href="styles/style.css" media="all">
</head>
<body>
	<div><?php include 'includes/navigation.php'; ?></div>
	
	<div><?php include 'includes/rightsidebar.php'; ?></div>

			
		<div id="myacc_wrap">
		
				
		
		<?php cart(); ?>
			
				

				<?php
					if(!isset($_SESSION['customer_email'])){
						include("includes/customer_login.php");
						exit();
					} 
					
				?>
				<?php echo $error; ?>
				
				<?php
					if(!isset($_GET['my_orders'])){
						if(!isset($_GET['edit_account'])){
							if(!isset($_GET['change_password'])){
								if(!isset($_GET['delete_account'])){
									
									echo  "
									<h2 style='padding:20px;'> Welcome!</h2><br />
									<b>You can see your orders progress by clicking this <a href='my_account.php?my_orders'>link</a></b>";
								}
							}
						}
					}
				?>
				<?php
					if(isset($_GET['edit_account'])){
						
						include 'edit_account.php';
					}
					if(isset($_GET['change_password'])){
						
						include 'change_password.php';
					}
					if(isset($_GET['delete_account'])){
						
						include 'delete_account.php';
					}
					if(isset($_GET['my_ordres'])){
						
						include 'delete_account.php';
					}
				?>
					
	
			</div>

	<div><?php include 'includes/footer.php'; ?></div>

</body>
</html>