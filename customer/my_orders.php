<table width="795" align="center" bgcolor="#A6D6ED"> 

	
	<tr align="center">
		<td colspan="6"><h2>View Products</h2></td>
	</tr>
	
	<tr align="center" bgcolor="#F0B30A">
		<th>S.N</th>
		<th>Product (s)</th>
		<th>Quanity</th>
		<th>Invoice No</th>
		<th>Order Date</th>
		<th>Status</th>
	</tr>
	<?php 
	include("includes/db.php");
	
			//customer details
		$user = $_SESSION['customer_email'];

		$get_customer = "SELECT * FROM tbl_customer WHERE customer_email = '$user'";

		$pre_customer = mysqli_query($conn, $get_customer);
		
		$row_customer = mysqli_fetch_array($pre_customer);

		$customer_id = $row_customer['customer_id'];
	
	$get_order = "SELECT * FROM tbl_order WHERE order_customer_id='$customer_id'";
	
	$run_order = mysqli_query($conn, $get_order); 
	
	$i = 0;
	
	while ($row_pro=mysqli_fetch_array($run_order)){
		
		$order_id = $row_order['order_product_id'];
		$pro_title = $row_order['product_title'];
		$pro_image = $row_order['product_image'];
		$pro_price = $row_order['product_price'];
		$i++;
	
	?>
	<tr align="center">
		<td><?php echo $i;?></td>
		<td><?php echo $pro_title;?></td>
		<td><img src="product_images/<?php echo $pro_image;?>" width="60" height="60"/></td>
		<td><?php echo $pro_price;?></td>
		<td><a href="index.php?edit_pro=<?php echo $pro_id; ?>">Edit</a></td>
		<td><a href="delete_pro.php?delete_pro=<?php echo $pro_id;?>">Delete</a></td>
	
	</tr>
	<?php } ?>
</table>