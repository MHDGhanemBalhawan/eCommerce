<?php

// Set Session variable email & id

					$user = $_SESSION['customer_email'];
					
					$get_customer = "SELECT * FROM tbl_customer WHERE customer_email = '$user'";
					
					$pre_customer = mysqli_query($conn, $get_customer);
					
					$row_customer = mysqli_fetch_array($pre_customer);
					
					$customer_img = $row_customer['customer_image'];
					
						
					$id = $row_customer['customer_id'];
					
					$_SESSION['id'] = $id;
					
					
// Print Session variables


<div><?php echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>'; ?></div>

<div><?php echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>'; ?></div>


?>


