<?php
	include_once'functions/functions.php';
	if(!isset($_SESSION['customer_email'])){
	
			echo '<div class="cust_sidebar">

			<div id="CUST_sidebar_title">My Account</div>
			
				<ul id="cats">
				
					<li><a href="my_account.php?my_orders">My Orders</a></li>
					<li><a href="my_account.php?edit_account">Edit Account</a></li>
					<li><a href="my_account.php?change_password">Change Password</a></li>
					<li><a href="my_account.php?delete_account">Delete Account</a></li>
					<li><a href="logout.php">Log Out</a></li>
				</ul>
		</div>
		';
	
		include("includes/customer_login.php");
		exit();
	} else{
		?>
            <!--/span-->
            <div class="col-xs-6 col-sm-2 sidebar-offcanvas pull-right" id="rightsidebar" role="navigation">
			  <div class="sidebar-offcanvas" id="rightsidebar" role="navigation">
				<div id="cust_sidebar_title">My Account</div>
                <div class="well sidebar-nav">
                    <ul class="nav" id="cats">
                       <?php
				
					$user = $_SESSION['customer_email'];
					
					$get_customer = "SELECT * FROM tbl_customer WHERE customer_email = '$user'";
					
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
                </div>
                <!--/.well -->
            </div>
            <!--/span-->
	</div>
			<?php } ?>
		