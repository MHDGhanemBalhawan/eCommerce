<DOCTYPE html>

<?php
	
	SESSION_START();
	
?>

<html>
	<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	
	<body>
		
		<h2> Welcome <?php echo $_SESSION['customer_email']; ?></h2>
		<h3>Your Payment was successful, please check your account.</h3>
		<!-- fill href with the url provided from paypal to redirect -->
		<h3><a href="">Check Your Account</a></h3>
		
<?php
include("includes/db.php");
include("functions/functions.php");

		$total = 0;
		$values = 0;
		$subtotal=0;
		global $conn;
		$ip = getIp();

		// product details
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
		
		
		//customer details
		$user = $_SESSION['customer_email'];

		$get_customer = "SELECT * FROM tbl_customer WHERE customer_email = '$user'";

		$pre_customer = mysqli_query($conn, $get_customer);
		
		$row_customer = mysqli_fetch_array($pre_customer);

		$customer_id = $row_customer['customer_id'];
		
		// get order id
		
		$get_order = "SELECT tbl_order.order_id, tbl_customer.customer_id, tbl_order.order_date 
		FROM tbl_order INNER JOIN tbl_customer ON order_customer_id=tbl_customer.customer_id"; 

		$pre_order = mysqli_query($conn, $get_order);
		
		$row_order = mysqli_fetch_array($pre_order);

		$order_id = $row_order['order_id'];
		
		// get quantity
		
		$get_qty ="SELECT * FROM tbl_cart WHERE cart_pro_id='$pro_id'";
		
		$pre_qty = mysqli_query($conn,$get_qty);
		
		$pre_qty = mysqli_fetch_array($pre_qty);
		
		$qty = $row_qty['qty'];
		
		//create random number and set it up as invoice no
		$invoice_no = mt_rand();

		
		//payment details from paypal
		
		$amount = $_GET['amt'];
		$currency =  $_GET['cc'];
		$trx_id = $_GET['tx'];
		
		// insert payment into the table
		$insert_payment ="INSERT INTO tbl_payment (pay_amount,pay_customer_id,pay_product_id,pay_trx_id,pay_currency,pay_order_id,payment_date) VALUE('$amount','$customer_id','$product_id',$trx_id','$currency','$order_id','$date')";
		$pre_payment = mysqli_query($conn,$insert_payment);
		
		
		//insert order to the table
		$insert_order = "INSERT INTO tbl_order (order_customer_id, order_date,order_status,order_invoice_no) VALUES ('$customer_id',''$date','in progress','$invoice_no')";
		
		$pre_order = mysqli_query($conn,$insert_order);
		
		//insert order line to the table
		$insert_order_line = "INSERT INTO tbl_order_line (line_order_id,line_product_id,line_qty) VALUES ('$order_id','$productr_id','$qty')";
		
		$pre_order_line = mysqli_query($conn,$insert_order_line);
		
		
		// empty cart
		$empty_cart ="DELETE * FROM tbl_cart WHERE cart_ip_add='$ip'";
		$pre_delete = mysqli_query($conn,$empty_cart);
		
		
		if($amount==$total){
		
			echo "<h2>Welcome: </h2>". $_SESSION['customer_email']. "<br/>"."<h2>Your payment was successful!</h2>";
		
			echo "<a href="  ">Go to Your Account</a>";
		
		} else{
			echo "<h2>Welcome Guest, Payment was not successful</h2><br/>";
				// href to shop page url
			echo "<a href="   ">Go Back to Shop</a>";
		
		}
		
?>
		
		
		
	</body>

</html>