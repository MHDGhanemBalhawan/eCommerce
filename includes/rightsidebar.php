
<?php
	include_once'functions/functions.php';
	if(!isset($_SESSION['customer_email'])){
			echo '
			    <div class="col-xs-6 col-sm-2 sidebar-offcanvas" id="sidebarRight" role="navigation">
	
                <div class="well sidebar-nav" style="height: calc(100vh - 50px);">
                    <ul class="nav">
							 <div id="off_sidebar_title">Welcome Guest!</div>
							 <div id="off_sidebar_title">You are not login.</div>
							 <div id="off_sidebar_title">Please login!</div>



                    </ul>
                </div>
			<!--

			<!--<div class="container-fluid">
				<div class="col-xs-6 col-sm-2 sidebar-offcanvas pull-right" id="rightsidebar" role="navigation">
					<div class="sidebar-offcanvas" id="rightsidebar" role="navigation">
					<div id="cust_sidebar_title">My Account</div>
									
						<div class="well sidebar-nav" style="height: calc(100vh - 50px);">
							<ul class="nav" id="cats">
							<li><a href="my_account.php?my_orders">My Orders</a></li>
							<li><a href="my_account.php?edit_account">Edit Account</a></li>
							<li><a href="my_account.php?change_password">Change Password</a></li>
							<li><a href="my_account.php?delete_account">Delete Account</a></li>
							<li><a href="logout.php">Log Out</a></li>
							</ul>
						</div><!--/.well -->
					</div><!--/sidebar-offcanvas-->
				</div><!--/col-->
			<!--<div id="my_account"><?php include("includes/customer_login.php");</div>-->
			</div><!--/container-->
		';
		/*
		 include_once("includes/customer_login.php");
		include_once ("includes/footer.php");
		exit();*/
	} else{
		?>
            
			<div class="col-xs-6 col-sm-2 sidebar-offcanvas" id="sidebarRight" role="navigation">
				<div class="well sidebar-nav" style="height: calc(100vh - 50px);">
					<div id="cust_sidebar_title">My Account</div>
					<ul class="nav">
							<ul class="nav" id="cats">
							   <?php
						
							$user = $_SESSION['customer_email'];
							//echo "sidebar";
							$get_customer = "SELECT * FROM tbl_customer WHERE customer_email = '$user'";
							//$get_customer = "SELECT * FROM tbl_customer WHERE customer_email = '$_SESSION["customer_email"]'";
							
							$pre_customer = mysqli_query($conn, $get_customer);
							$row_customer = mysqli_fetch_array($pre_customer);
							$customer_img = $row_customer['customer_image'];
							$id = $row_customer['customer_id'];	
							$_SESSION['id'] = $id;	
							/* $c_id = $_GET['c_id']; */
							
							$c_id = $row_customer['customer_id'];
							
							$id = $row_customer['customer_id'];
							$customer_username = $row_customer['customer_username'];
							$title = $row_customer['customer_title'];
							$first_name = $row_customer['customer_first_name'];
							$last_name = $row_customer['customer_last_name'];
							$password_hint = $row_customer['customer_password_hint'];
							$email = $row_customer['customer_email'];
							$address = $row_customer['Customer_address'];
							$post_code = $row_customer['customer_post_code'];
							$city = $row_customer['customer_city'];
							$country = $row_customer['customer_country'];
							$phone = $row_customer['customer_phone'];
							$mobile = $row_customer['customer_mobile'];
							$image = $row_customer['customer_image']; 
											
							echo "<p style='text-algin:center; border'2px solid white;'><img src='$customer_img' alt='Image' width='150' height='150' /></p>";
							echo $customer_username = $row_customer['customer_username'];
							
						?>
							<li><a href="my_account.php?my_orders">My Orders</a></li>
							<li><a href="my_account.php?edit_account">Edit Account</a></li>
							<li><a href="my_account.php?change_password">Change Password</a></li>
							<li><a href="my_account.php?delete_account">Delete Account</a></li>
							<li><a href="logout.php">Log Out</a></li>
							</ul>
						</div><!--/.well -->
					
				</div><!--/sidebar-offcanvas-->
 
			
	
			<?php } ?>
		
