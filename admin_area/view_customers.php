<div class="container-fluid">
<table id="tbl_customer" width="100%"> 
	<tr>
		<td colspan="6"><h2>View Customers</h2></td>
	</tr>
	<tr>
		<th>S.N</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<th>Image</th>
		<th>Delete</th>
	</tr>
	<?php 
	include("includes/db.php");
	$get_c = "SELECT * FROM tbl_customer";
	$run_c = mysqli_query($conn, $get_c); 
	$i = 0;
	while ($row_c=mysqli_fetch_array($run_c)){
		$c_id = $row_c['customer_id'];
		$c_first_name = $row_c['customer_first_name'];
		$c_last_name = $row_c['customer_last_name'];
		$c_email = $row_c['customer_email'];
		$c_image = $row_c['customer_image'];
		$i++;
	?>
	<tr>
		<td><?php echo $i;?></td>
		<td><?php echo $c_first_name;?></td>
		<td><?php echo $c_last_name;?></td>
		<td><?php echo $c_email;?></td>
		<td><img src="<?php echo "../$c_image"; ?>" alt="Image" width="50" height="50" ></td> 
		<td><a href="delete_c.php?delete_c=<?php echo $c_id;?>"><b><i class="glyphicon glyphicon-trash text-danger"></i></b></a></td>
	</tr>
	<?php } ?>
</table>
</div>