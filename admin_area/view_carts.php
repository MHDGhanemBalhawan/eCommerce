<?php 
//if(!isset($_SESSION['user_email'])){
	
	// echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
//} 
//else {

?>
<div class="container-fluid">
<table class="responsive" width="100%" bgcolor="#A6D6ED">
	<tr>
		<td colspan="6"><h2>View Carts</h2></td>
	</tr>
	<tr bgcolor="#F0B30A">
		<th>S.N</th>
		<th>Cart Product Id</th>
		<th>Cart IP Address</th>
		<th>Cart Quantity</th>
		<th>Time Stamp</th>
		<th>Delete</th>
	</tr>
	<?php 
		include("includes/db.php");
	$get_cart = "SELECT * FROM `tbl_cart`";
	$run_cart = mysqli_query($conn, $get_cart); 
	$i = 0;
	while ($row_cart=mysqli_fetch_array($run_cart)){
		$cart_pro_id = $row_cart['cart_pro_id'];
		$cart_ip_add = $row_cart['cart_ip_add'];
		$cart_qty = $row_cart['cart_qty'];
		$timestamp = $row_cart['timestamp'];
		$i++;
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $cart_pro_id; ?></td>
		<td><?php echo $cart_ip_add; ?></td>
		<td><?php echo $cart_qty; ?></td>
		<td><?php echo $timestamp; ?></td>
		
		<td><a href="delete_cart.php?delete_cart=<?php echo $cart_ip_add;?>"><b><i class="glyphicon glyphicon-trash text-danger"></i></b></a></td>
	</tr>
	<?php } ?>
</table>
</div>