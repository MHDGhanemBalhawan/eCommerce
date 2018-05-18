<div class="container-fluid">
<table width="100%" align="center" bgcolor="#A6D6ED"> 

	<tr align="center">
		<td colspan="4"><h2>View All Categories</h2></td>
	</tr>
	
	<tr align="center" bgcolor="#F0B30A">
		<th>Category ID</th>
		<th>Category Title</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	<?php 
	include("includes/db.php");
	
	$get_cat = "select * from tbl_category";
	
	$run_cat = mysqli_query($conn, $get_cat); 
	
	$i = 0;
	
	while ($row_cat=mysqli_fetch_array($run_cat)){
		
		$cat_id = $row_cat['cat_id'];
		$cat_title = $row_cat['cat_title'];
		$i++;
	
	?>
	<tr align="center">
		<td><?php echo $i;?></td>
		<td><?php echo $cat_title;?></td>
		<td><a href="index.php?edit_cat=<?php echo $cat_id; ?>"><i class="glyphicon glyphicon-edit text-info"></i></a></td>
		<td><a href="delete_cat.php?delete_cat=<?php echo $cat_id;?>"><i class="glyphicon glyphicon-trash text-danger"></i></a></td>
	</tr>
	<?php } ?>
</table>
</div>