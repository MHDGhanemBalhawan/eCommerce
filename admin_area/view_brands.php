<div class="container-fluid">
<table width="100%" bgcolor="#A6D6ED"> 
	<thead>
		<td colspan="4"><h2>View All Brands</h2></td>
	</thead>
	<tr bgcolor="#F0B30A">
		<th>Brand ID</th>
		<th>Brand Title</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php 
	include("includes/db.php");
	$get_brand = "select * from tbl_brand";
	$run_brand = mysqli_query($conn, $get_brand); 
	$i = 0;
	while ($row_brand=mysqli_fetch_array($run_brand)){
		$brand_id = $row_brand['brand_id'];
		$brand_title = $row_brand['brand_title'];
		$i++;
	?>
	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $brand_title; ?></td>
		<td><a href="index.php?edit_brand=<?php echo $brand_id; ?>"><i class="glyphicon glyphicon-edit text-info"></i></a></td>
		<td><a href="delete_brand.php?delete_brand=<?php echo $brand_id;?>"><i class="glyphicon glyphicon-trash text-danger"></i></a></td>
	</tr>
	<?php } ?>
</table>
</div>