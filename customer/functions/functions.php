<?php

// Connecting to the Database
$conn = mysqli_connect("","","","");

if(mysqli_connect_error()){
	echo "The Connection was not established:".mysqli_connect_error();
}

// Getting User Ip Address
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    return $ip;
}

// Create the Shopping Cart
function cart(){
	if(isset($_GET['add_cart'])){

		global $conn;

		$ip = getIp();

		$add_pro_id = $_GET['add_cart'];

		$check_pro = "SELECT * FROM tbl_cart where cart_pro_id = '$add_pro_id' AND cart_ip_add = '$ip'";

		$pre_check =  mysqli_query($conn, $check_pro);

		if(mysqli_num_rows($pre_check)>0){

			echo"";

		} else {

			$ins_pro = "INSERT INTO tbl_cart (cart_pro_id,cart_ip_add,cart_qty ) VALUES ('$add_pro_id','$ip','1')";

			$pre_pro = mysqli_query($conn, $ins_pro);

			echo "<script>window.open('index.php','_self')</script>";
		}
	}
}
function total_items(){
	global $conn;

	if(isset($_GET['add_cart'])){

		$ip = getIp();

	$query = "SELECT  SUM(cart_qty) FROM tbl_cart  WHERE cart_ip_add = '$ip'";

	$result = mysqli_query($conn, $query) or die(mysqli_error());

	// Print out result
		while($row = mysqli_fetch_array($result)){
			echo $row['SUM(cart_qty)'];

		}
	}else{
		$ip = getIp();

		$query = "SELECT  SUM(cart_qty) FROM tbl_cart  WHERE cart_ip_add = '$ip'";

		$result = mysqli_query($conn, $query) or die(mysqli_error());

	// Print out result
		while($row = mysqli_fetch_array($result)){
			echo $row['SUM(cart_qty)'];

		}

	}
}

// Getting The Total Price for the Cart
function total_price(){

	$total = 0;

	$values = 0;

	global $conn;

	$ip = getIp();

	$sel_price = "SELECT * FROM tbl_cart WHERE cart_ip_add ='$ip'";

	$pre_price = mysqli_query($conn,$sel_price);

	while($pro_price = mysqli_fetch_array($pre_price)){

		$pro_id = $pro_price['cart_pro_id'];

		$pro_price = "SELECT * FROM tbl_product WHERE product_id = '$pro_id'";

		$pre_pro_price = mysqli_query($conn,$pro_price);

		while($p_pro_price = mysqli_fetch_array($pre_pro_price)){

			$product_price = array($p_pro_price['product_price']);

			$values = array_sum($product_price);

			$total +=$values;
		}

	}
	echo $total;

}

// Getting Categories for the Sidebar

function getCats(){
	global $conn;
	$get_cats = "SELECT * FROM tbl_category";
	$pre_cats = mysqli_query($conn, $get_cats);
	while($row_cats = mysqli_fetch_array($pre_cats)){
		$cat_id = $row_cats['cat_id'];
		$cat_title = $row_cats['cat_title'];

		echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
	}
}

// Getting Brands for the Sidebar

function getBrands(){
	global $conn;
	$get_brands = "SELECT * FROM tbl_brand";
	$pre_brands = mysqli_query($conn, $get_brands);
	while($row_brands = mysqli_fetch_array($pre_brands)){
		$brand_id = $row_brands['brand_id'];
		$brand_title = $row_brands['brand_title'];

		echo "<li><a href='index.php?brand=$brand_id'>$brand_title</a></li>";
	}
}

// Getting the Products on the Main Page
function getPro(){

	if(!isset($_GET['cat'])){
		if(!isset($_GET['brand'])){
			global $conn;

			$get_pro = "SELECT * FROM tbl_product ORDER BY rand() LIMIT 0,6";

			$pre_pro = mysqli_query($conn, $get_pro);

			while($row_pro = mysqli_fetch_array($pre_pro)){

			$pro_id = $row_pro['product_id'];
			$pro_cat = $row_pro['product_category'];
			$pro_brand = $row_pro['product_brand'];
			$pro_title = $row_pro['product_title'];
			$pro_price = $row_pro['product_price'];
			$pro_image = $row_pro['product_image'];

			echo "
				<div id='single_product'>
					<h4>$pro_title</h4>
					<img src='admin_area/product_images/$pro_image' width='180px' height='180px' />

					<p><b> Price: £$pro_price </b></p>

					<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
					<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>
				</div>
			";
			}
		}
	}
}

// Getting the Products by Category on the Main Page
function getCatPro(){

	if(isset($_GET['cat'])){

	$cat_id= $_GET['cat'];

		global $conn;

		$get_cat_pro = "SELECT * FROM tbl_product WHERE product_category='$cat_id'";

		$pre_cat_pro = mysqli_query($conn, $get_cat_pro);

		$count_cats = mysqli_num_rows($pre_cat_pro);

		if($count_cats == 0){

			echo "<div id='single_product'>
						<h3>There is no product in this category!</h3>
					</div>";
			/* echo "<h1>There is no product in this category!</h1>";	 */
		}

			while($row_cat_pro = mysqli_fetch_array($pre_cat_pro)){

			$pro_id = $row_cat_pro['product_id'];
			$pro_cat = $row_cat_pro['product_category'];
			$pro_brand = $row_cat_pro['product_brand'];
			$pro_title = $row_cat_pro['product_title'];
			$pro_price = $row_cat_pro['product_price'];
			$pro_image = $row_cat_pro['product_image'];



				echo "
					<div id='single_product'>
						<h4>$pro_title</h4>
						<img src='admin_area/product_images/$pro_image' width='180px' height='180px' />

						<p><b> Price: £$pro_price </b></p>

						<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
						<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>
					</div>
				";
			}


	}
}

// Getting the Products by The Brand on the Main Page
function getBrandPro(){


	if(isset($_GET['brand'])){

		$brand_id=$_GET['brand'];

		global $conn;

		$get_brand_pro = "SELECT * FROM tbl_product WHERE product_brand='$brand_id'";

		$pre_brand_pro = mysqli_query($conn, $get_brand_pro);

		$count_brands = mysqli_num_rows($pre_brand_pro);

		if($count_brands == 0){

			echo "<div id='single_product'>
						<h3>There is no product in this category!</h3>
					</div>";
			/* echo "<h1>There is no brand in this category!</h1>";	 */
		}

		while($row_brand_pro = mysqli_fetch_array($pre_brand_pro)){

		$pro_id = $row_brand_pro['product_id'];
		$pro_cat = $row_brand_pro['product_category'];
		$pro_brand = $row_brand_pro['product_brand'];
		$pro_title = $row_brand_pro['product_title'];
		$pro_price = $row_brand_pro['product_price'];
		$pro_image = $row_brand_pro['product_image'];

		echo "
			<div id='single_product'>
				<h4>$pro_title</h4>
				<img src='admin_area/product_images/$pro_image' width='180px' height='180px' />

				<p><b> Price: £$pro_price </b></p>

				<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
				<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>
			</div>
		";
		}
	}

}

// Getting All Products on The all_Product Page
function getAllPro(){


	global $conn;

	$get_pro = "SELECT * FROM tbl_product";

	$pre_pro = mysqli_query($conn, $get_pro);

	while($row_pro = mysqli_fetch_array($pre_pro)){

		$pro_id = $row_pro['product_id'];
		$pro_cat = $row_pro['product_category'];
		$pro_brand = $row_pro['product_brand'];
		$pro_title = $row_pro['product_title'];
		$pro_price = $row_pro['product_price'];
		$pro_image = $row_pro['product_image'];

		echo "
			<div id='single_product'>
				<h4>$pro_title</h4>
				<img src='admin_area/product_images/$pro_image' width='180px' height='180px' />

				<p><b> Price: £$pro_price </b></p>

				<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
				<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>
			</div>
		";
	}
}

// Getting The Search result on the Search Page
function getSearchPro(){

	if(isset($_GET['search'])){

		$search_query = $_GET['user_query'];

		global $conn;

		$get_search_pro = "SELECT * FROM tbl_product WHERE product_keyword LIKE '%$search_query%'";

		$pre_search_pro = mysqli_query($conn, $get_search_pro);

		while($row_search_pro = mysqli_fetch_array($pre_search_pro)){

			$pro_id = $row_search_pro['product_id'];
			$pro_cat = $row_search_pro['product_category'];
			$pro_brand = $row_search_pro['product_brand'];
			$pro_title = $row_search_pro['product_title'];
			$pro_price = $row_search_pro['product_price'];
			$pro_image = $row_search_pro['product_image'];

			echo "
				<div id='single_product'>
					<h4>$pro_title</h4>
					<img src='admin_area/product_images/$pro_image' width='180px' height='180px' />

					<p><b> Price: £$pro_price </b></p>

					<a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
					<a href='index.php?add_cart=$pro_id'><button style='float:right'>Add to Cart</button></a>
				</div>
			";

		}

	}

}

?>
