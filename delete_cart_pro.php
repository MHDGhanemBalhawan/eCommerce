<?php 
	include("includes/db.php"); 
	
	if(isset($_GET['delete_cart_pro'])){
	
		$delete_id = $_GET['delete_cart_pro'];
		
		$delete_cart_pro = "DELETE FROM tbl_cart WHERE cart_pro_id='$delete_id'"; 
		
		$run_delete = mysqli_query($conn, $delete_cart_pro);
		
	}
	
	if($run_delete){
	
		echo "<script>alert('The product has been deleted!')</script>";
		echo "<script>window.open('cart.php','_self')</script>";
	}
	


?>