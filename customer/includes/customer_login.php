<?php
	
	include 'includes/db.php';
	ob_start();
	
	
	if(isset($_POST['login'])){
	

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	

	
	$sel_cust = "SELECT * FROM tbl_customer WHERE customer_password ='$password' AND customer_email = '$email'";
	
	$pre_sel = mysqli_query($conn, $sel_cust );
	
	$check_cust = mysqli_num_rows($pre_sel);
	
		if($check_cust==0){
		
			echo "<script>alert('Password or email is inncorrect. Please try again!')</script>";
			exit();
		
		} 
		$ip =getIp();
		
		$sel_cart = "SELECT * FROM tbl_cart WHERE cart_ip_add = '$ip'";
	
		$pre_cart = mysqli_query($conn, $sel_cart);
		
		$check_cart = mysqli_num_rows($pre_cart);
		
		if($check_cust>0 AND $check_cart==0){
		
		$_SESSION['customer_email'] = $email;
	
		echo "<script>alert('You logged in successfully. Thanks!')</script>";
		
		echo "<script>window.open('customer/myaccount.php','_self')</script>";
		
		} else {
		
		$_SESSION['customer_email'] = $email;
	
		echo "<script>alert('You logged successfully. Thanks!')</script>";
		
		echo "<script>window.open('../view_cart.php','_self')</script>";
		}
		
		
	}
?>

<div id="customer_login" align="center">

	<form action="" method="post" enctype="multipart/form-data">
		<table align="center" width="70%" bgcolor="skyblue">
			<tr align="center">
				<td colspan="12"><h2>Login or Register to buy!</h2></td>
			</tr>					
			<col width="45%">
	  		<col width="55%">
			<tr>
				<td align="right"><b>Email: *</b></td>
				<td align="left"><input type="text" name="email" placeholder="Enter Email" maxlength="60" required/></td>
			</tr>
			<tr>
				<td align="right"><b>Password: *</b></td>
				<td align="left"><input type="text" name="password" placeholder="Enter Password" maxlength="60" required/></td>
			</tr>
			<tr>
				<td colspan="2" align="left"></td>
			</tr>
			<tr>
				<td width="40%" align="right"></td>
				<td colspan="3" align="left"><a href=""  /></td></a>
			</tr>
			<tr>
				<td align="center" colspan="12"><input type="submit" name="login" value="Login" /></td>
			</tr>
		</table>
		<h2 style="float:left; padding-left:10px;"><a href="../customer_register.php" style="text-decoration:none;">New! Register Here<a/></h2>
					
	</form>
<div><?php include '../includes/footer.php' ?></div>
</div>