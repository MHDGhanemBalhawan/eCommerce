<?php

// disable error reporting

//error_reporting(0);


ini_set('display_errors', 'Off');



// Connecting to the Database
$conn = mysqli_connect("","","","");

//if(mysqli_connect_error()){	echo "The Connection was not established:".mysqli_connect_error();}

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
// calculate total items in cart
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
			$subtotal=0;
			global $conn;
			$ip = getIp();
			$sel_price = "SELECT cart_pro_id, cart_ip_add, cart_qty FROM tbl_cart WHERE cart_ip_add ='$ip'";
			$pre_price = mysqli_query($conn,$sel_price);
			$i = 0;
			while($pro_price = mysqli_fetch_array($pre_price)){
				$pro_id = $pro_price['cart_pro_id'];
				$qty = $pro_price['cart_qty'];
				$pro_price = "SELECT * FROM tbl_product WHERE product_id = '$pro_id'";
				$pre_pro_price = mysqli_query($conn,$pro_price);
				while($p_pro_price = mysqli_fetch_array($pre_pro_price)){
					$product_price = array($p_pro_price['product_price']);
					$product_id = $p_pro_price['product_id'];
					$product_title = $p_pro_price['product_title'];
					$product_image = $p_pro_price['product_image'];
					$single_price = $p_pro_price['product_price'];
					 $values = array_sum($product_price);

					$subtotal =$values*$qty;
					$total+=$subtotal;
					$i++;
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

					<a href='details.php?pro_id=$pro_id'><button type='button' class='btn btn-xs' style='float:left;transform:scale(1.25,1);margin-left:6px;'>Details</button></a>
					<a href='index.php?add_cart=$pro_id'><button type='button' class='btn btn-xs' style='float:right;'>Add to Cart</button></a>
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

			echo "<div class='panel panel-info' style='min-height: 100vh;'>
				<div class='panel panel-heading'>
						<h3 style='text-align:center;'>There is no product in this category!</h3>

				</div>
				</div>";


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

						<a href='details.php?pro_id=$pro_id'><button type='button' class='btn btn-xs' style='float:left;transform:scale(1.25,1);margin-left:6px;'>Details</button></a>
						<a href='index.php?add_cart=$pro_id'><button type='button' class='btn btn-xs' style='float:right;'>Add to Cart</button></a>
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

				echo "<div class='panel panel-info' style='min-height: 100vh;'>
				<div class='panel panel-heading'>
						<h3 style='text-align:center;'>There is no product in this brand!</h3>

				</div>
				</div>";



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
				<a href='details.php?pro_id=$pro_id'><button type='button' class='btn btn-xs' style='float:left;transform:scale(1.25,1);margin-left:6px;'>Details</button></a>
				<a href='index.php?add_cart=$pro_id'><button  type='button' class='btn btn-xs' style='float:right;'>Add to Cart</button></a>
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

				<a href='details.php?pro_id=$pro_id'><button type='button' class='btn btn-xs' style='float:left;transform:scale(1.25,1);margin-left:6px;'>Details</button></a>
				<a href='index.php?add_cart=$pro_id'><button  type='button' class='btn btn-xs' style='float:right;'>Add to Cart</button></a>
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

					<a href='details.php?pro_id=$pro_id'><button type='button' class='btn btn-xs' style='float:left;transform:scale(1.25,1);margin-left:6px;'>Details</button></a>
					<a href='index.php?add_cart=$pro_id'><button  type='button' class='btn btn-xs' style='float:right;'>Add to Cart</button></a>
				</div>
			";

		}

	}

}
function updateCustomerAcc(){
	global $conn;

	$user = $_SESSION['customer_email'];

	$get_customer = "SELECT * FROM tbl_customer WHERE customer_email = '$user'";

	$pre_customer = mysqli_query($conn, $get_customer);
	$row_customer = mysqli_fetch_array($pre_customer);
	$customer_img = $row_customer['customer_image'];
	$id = $row_customer['customer_id'];
	$_SESSION['id'] = $id;
	/* $c_id = $_GET['c_id']; */

	$c_id = $row_customer['customer_id'];
	$id = $row_customer['customer_id'];
	$customer_username = $row_customer['customer_username'];
	$title = $row_customer['customer_title'];
	$first_name = $row_customer['customer_first_name'];
	$last_name = $row_customer['customer_last_name'];
	$email = $row_customer['customer_email'];
	$address = $row_customer['Customer_address'];
	$post_code = $row_customer['customer_post_code'];
	$city = $row_customer['customer_city'];
	$country = $row_customer['customer_country'];
	$phone = $row_customer['customer_phone'];
	$mobile = $row_customer['customer_mobile'];
	$image = $row_customer['customer_image'];
	echo "<p style='text-algin:center; border'2px solid white;'><img src='customer/$customer_img' alt='Image' width='150' height='150' /></p>";
	echo $customer_username = $row_customer['customer_username'];

}

function createCustomerAcc(){
	global $conn;
		$error = '';
	if(isset($_POST['register_customer'])){

	$ip=getIp();

		$title = strip_tags($_POST['title']);
		$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
		$strip_first_name = strip_tags($first_name);
		$secure_first_name = htmlspecialchars($strip_first_name);
		$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
		$secure_last_name = htmlspecialchars($last_name);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$secure_password = mysqli_real_escape_string($conn, $_POST['password']);
		//$secure_password = password_hash($password, PASSWORD_BCRYPT);
		$address = mysqli_real_escape_string($conn, $_POST['address']);
		$post_code = mysqli_real_escape_string($conn, $_POST['address']);
		$city = mysqli_real_escape_string($conn, $_POST['city']);
		$country = mysqli_real_escape_string($conn, $_POST['country']);
		$phone = mysqli_real_escape_string($conn, $_POST['phone']);
		$mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
		$date = date('Y-m-d h:i:s');
		if($_FILES['image']['name'] != ''){
			$image_name = $_FILES['image']['name'];
			$image_tmp = $_FILES['image']['tmp_name'];
			$image_size = $_FILES['image']['size'];
			$image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
			$image_path = 'customer/customer_images/'.$image_name;
			$image_db_path = 'customer/customer_images/'.$image_name;

			if($image_size < 1000){
				if($image_ext == 'jpg' || $image_ext == 'png' || $image_ext == 'gif'){
					if(move_uploaded_file($image_tmp,$image_path)){
						$ins_sql = "INSERT INTO tbl_customer (customer_ip,customer_title, customer_first_name, customer_last_name, customer_email, customer_password, customer_address, customer_post_code, customer_city, customer_country, customer_phone, customer_mobile, customer_image, customer_date) VALUES ('$ip', '$title', '$secure_first_name', '$secure_last_name', '$email', '$secure_password', '$address', '$post_code', '$city', '$country', '$phone', '$mobile', '$image_db_path', '$date')";

						if(mysqli_query($conn,$ins_sql)){
							$success = 'Account created successfully!';
							$_SESSION['customer_email'] = $email;

							//header('customer_register.php');
						} else{
							$error = '<div class="alert alert-danger">Error The query was not executed.</div>';
						}
					} else {
						$error = '<div class="alert alert-danger">Sorry, image was not uploaded!</div>';
					}

				} else {
					$error = '<div class="alert alert-danger">Image format is not supported!</div>';

				}
			}else{
				$error = '<div class="alert alert-danger">Image size is bigger than 1 mb.</div>';
			}

			// register customer without image
		} else {
			$ins_sql = "INSERT INTO tbl_customer (customer_ip,customer_title, customer_first_name, customer_last_name, customer_email, customer_password, customer_address, customer_post_code, customer_city, customer_country, customer_phone, customer_mobile, customer_date) VALUES ('$ip', '$title', '$first_name', '$last_name', '$email', '$secure_password', '$address', '$post_code', '$city', '$country', '$phone', '$mobile', '$date')";
			if(mysqli_query($conn,$ins_sql)){
				header('customer_register.php');
				$_SESSION['customer_email'] = $email;
				$success = 'Account created successfully without image';
			} else{
				$error = '<div class="alert alert-danger">The query was not executed.</div>';
			}
		}
	$sel_cart = "SELECT * FROM tbl_cart WHERE cart_ip_add = '$ip'";

	$pre_cart = mysqli_query($conn, $sel_cart);

	$check_cart = mysqli_num_rows($pre_cart);

	if($check_cart == 0){

	//$_SESSION['customer_email'] = $email;

	//echo "<script>alert('Account has been created successfully. Thanks!')</script>";

	//echo "<script>window.open('customer/my_account.php','_self')</script>";

	} else{

	//$_SESSION['customer_email'] = $email;

	//echo "<script>alert('Account has been created successfully. Thanks!')</script>";

	//echo "<script>window.open('checkout.php','_self')</script>";


	}
	}



}




?>
