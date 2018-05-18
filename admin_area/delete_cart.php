<?php 
	include("includes/db.php"); 
	
	if(isset($_GET['delete_cart'])){
	
		$delete_ip_id = $_GET['delete_cart'];
		
		$delete_cart = "DELETE FROM tbl_cart WHERE cart_ip_add='$delete_ip_id'"; 
		
		$run_delete = mysqli_query($conn, $delete_cart);
		
	}
	
	if($run_delete){
	
		echo "<script>alert('A cart has been deleted!')</script>";
		echo "<script>window.open('index.php?view_carts','_self')</script>";
	}
	


?>