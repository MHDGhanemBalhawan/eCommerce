<!DOCTYPE html>

<?php 

include("includes/db.php");

if(isset($_GET['edit_cart_pro'])){

	$get_id = $_GET['edit_cart_pro']; 
	
	$get_pro = "SELECT * FROM tbl_product WHERE product_id='$get_id'";
	
	$run_pro = mysqli_query($conn, $get_pro); 
	
	$i = 0;
	
	$row_pro=mysqli_fetch_array($run_pro);
		
		$pro_id = $row_pro['product_id'];
		$pro_title = $row_pro['product_title'];
		$pro_image = $row_pro['product_image'];
		$pro_price = $row_pro['product_price'];
		$pro_desc = $row_pro['product_description']; 
		$pro_keyword = $row_pro['product_keyword']; 
		$pro_cat = $row_pro['product_category'];
		$pro_brand = $row_pro['product_brand'];
		
		$get_cat = "SELECT * FROM tbl_category WHERE cat_id='$pro_cat'";
		
		$run_cat=mysqli_query($conn, $get_cat); 
		
		$row_cat=mysqli_fetch_array($run_cat); 
		
		$category_title = $row_cat['cat_title'];
		$category_id = $row_cat['cat_id'];
		
		
		
		$get_brand = "SELECT * FROM tbl_brand WHERE brand_id='$pro_brand'";
		
		$run_brand=mysqli_query($conn, $get_brand); 
		
		$row_brand=mysqli_fetch_array($run_brand);
		
		$brand_title = $row_brand['brand_title'];
		$brand_id = $row_brand['brand_id'];
} 

?>
<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Edit Cart</title> 
		<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
		<!-- <script src="bootstrap/js/myscript.js"></script> -->
		<script src="bootstrap/js/jquery.js"></script>
		<script src="bootstrap/js/bootstrap.js"></script>
		<link rel="stylesheet" href="styles/style.css" media="all">
		
	</head>
	
<body bgcolor="skyblue">
	<form action="" method="post" enctype="multipart/form-data"> 
		<table align="center" width="795" border="2" bgcolor="#187eae">
			<tr align="center">
				<td colspan="7"><h2>Edit & Update Cart</h2></td>
			</tr>
			<tr>
				<td align="right"><b>Product Title:</b></td>
				<td><input type="text" name="title" size="60" value="<?php echo $pro_title;?>"/></td>
			</tr>
			<tr>
				<td align="right"><b>Product Category:</b></td>
				<td>
				<select name="category" >
					<option value='<?php echo $category_id ?>'><?php echo $category_title ?></option>"
					<?php 
						$get_cats = "SELECT * FROM tbl_category";
						$run_cats = mysqli_query($conn, $get_cats);
						while ($row_cats=mysqli_fetch_array($run_cats)){
							$cat_id = $row_cats['cat_id']; 
							$cat_title = $row_cats['cat_title'];
							echo "<option value='$cat_id'>$cat_title</option>";
						}	
					?>
				</select>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Brand:</b></td>
				<td>
					<select name="brand" >
						<option value='<?php echo $brand_id ?>'><?php echo $brand_title ?></option>
						<?php 
							$get_brands = "SELECT * FROM tbl_brand";
							$run_brands = mysqli_query($conn, $get_brands);
							while ($row_brands=mysqli_fetch_array($run_brands)){
								$brand_id = $row_brands['brand_id']; 
								$brand_title = $row_brands['brand_title'];
								echo "<option value='$brand_id'>$brand_title</option>";
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td align="right"><b>Product Image:</b></td>
				<td><input type="file" name="product_image" /><img src="product_images/<?php echo $pro_image; ?>" width="60" height="60"/></td>
			</tr>
			<tr>
				<td align="right"><b>Product Price:</b></td>
				<td><input type="text" name="price" value="<?php echo $pro_price;?>"/></td>
			</tr>
			<tr>
				<td align="right"><b>Product Description:</b></td>
				<td><textarea name="description" cols="20" rows="10"><?php echo $pro_desc;?></textarea></td>
			</tr>
			<tr>
				<td align="right"><b>Product Keywords:</b></td>
				<td><input type="text" name="keyword" size="50" value="<?php echo $pro_keyword;?>"/></td>
			</tr>
			<tr align="center">
				<td colspan="2"><input type="submit" name="update_product" value="Update Product"/></td>
				</tr>
		</table>
	</form>
</body> 
</html>
<?php 

	if(isset($_POST['update_product'])){
	
		//getting the text data from the fields
		
		$update_id = $pro_id;
		
		$product_cat= $_POST['category'];
		$product_brand = $_POST['brand'];
		$product_title = $_POST['title'];
		$product_price = $_POST['price'];
		$product_desc = $_POST['description'];
		$product_keyword = $_POST['keyword'];
		
		
		
	
		 $update_product = "UPDATE tbl_product SET product_category='$product_cat',product_brand='$product_brand',product_title='$product_title',product_price='$product_price',product_description='$product_desc',product_image='$product_image', product_keyword='$product_keyword' WHERE product_id='$update_id'";
		 
		/*  $update_product = "UPDATE tbl_product SET product_brand='$product_brand',product_category='$product_cat' WHERE product_id='$update_id'"; */
			 
		 $run_product = mysqli_query($conn, $update_product);
		 
		 if($run_product){
		 
		 echo "<script>alert('Product has been updated!')</script>";
		 
		 echo "<script>window.open('index.php?view_products','_self')</script>";
		 
		 }
	}

?>












