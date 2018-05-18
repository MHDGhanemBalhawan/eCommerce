<?php 
//if(!isset($_SESSION['user_email'])){
	
	// echo "<script>window.open('login.php?not_admin=You are not an Admin!','_self')</script>";
//} 
//else {

?>
<div class="container-fluid">
<table class="responsive" width="100%" bgcolor="#A6D6ED">
	<tr>
		<td colspan="6"><h2>View Products</h2></td>
	</tr>
	<tr bgcolor="#F0B30A">
		<th>S.N</th>
		<th>Title</th>
		<th>Image</th>
		<th>Price</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php 
	include("includes/db.php");
	$get_pro = "SELECT * FROM tbl_product";
	$run_pro = mysqli_query($conn, $get_pro); 
	$i = 0;
	while ($row_pro=mysqli_fetch_array($run_pro)){
		$pro_id = $row_pro['product_id'];
		$pro_title = $row_pro['product_title'];
		$pro_image = $row_pro['product_image'];
		$pro_price = $row_pro['product_price'];
		$i++;
	?>
	<tr>
		<td><?php echo $i;?></td>
		<td><?php echo $pro_title;?></td>
		<td><img src="product_images/<?php echo $pro_image;?>" width="60" height="60"/></td>
		<td><?php echo $pro_price;?></td>
		<td><a href="index.php?edit_pro=<?php echo $pro_id; ?>"><b><i class="glyphicon glyphicon-edit text-INFO"></i></b</a></td>
		<td><a href="delete_pro.php?delete_pro=<?php echo $pro_id;?>"><b><i class="glyphicon glyphicon-trash text-danger"></i></b></a></td>
	</tr>
	<?php } ?>
</table>
</div>