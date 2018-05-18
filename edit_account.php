
<?php
 include_once 'includes/db.php';
 include_once 'functions/functions.php';
 	ob_start();
	$error = ''; 
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
	//$customer_username = $row_customer['customer_username'];
	$title = $row_customer['customer_title'];
	$first_name = $row_customer['customer_first_name'];
	$last_name = $row_customer['customer_last_name'];
	$password_hint = $row_customer['customer_password_hint'];
	$email = $row_customer['customer_email'];
	$address = $row_customer['Customer_address'];
	$post_code = $row_customer['customer_post_code'];
	$city = $row_customer['customer_city'];
	$country = $row_customer['customer_country'];
	$phone = $row_customer['customer_phone'];
	$mobile = $row_customer['customer_mobile'];
	$image = $row_customer['customer_image']; 
	
	
	
	
	if(isset($_POST['update_account'])){
	
	$ip=getIp();
		/*$id =  $_POST['customer_id']; */
		//$customer_username = strip_tags(mysqli_real_escape_string($conn, $_POST['customer_username']));
		$title = strip_tags($_POST['title']);
		$first_name = strip_tags(mysqli_real_escape_string($conn, $_POST['first_name']));
		$last_name = strip_tags(mysqli_real_escape_string($conn, $_POST['last_name']));
		$password_hint = strip_tags(mysqli_real_escape_string($conn, $_POST['password_hint']));
		$email = strip_tags(mysqli_real_escape_string($conn, $_POST['email']));
		$address = strip_tags(mysqli_real_escape_string($conn, $_POST['address']));
		$post_code = strip_tags(mysqli_real_escape_string($conn, $_POST['address']));
		$city = strip_tags(mysqli_real_escape_string($conn, $_POST['city']));
		$country = strip_tags(mysqli_real_escape_string($conn, $_POST['country']));
		$phone = strip_tags(mysqli_real_escape_string($conn, $_POST['phone']));
		$mobile = strip_tags(mysqli_real_escape_string($conn, $_POST['mobile']));
		$date = date('Y-m-d h:i:s');

if($_FILES['image']['name'] != ''){
			$image_name = $_FILES['image']['name'];
			$image_tmp = $_FILES['image']['tmp_name'];
			$image_size = $_FILES['image']['size']; 
			$image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
			$image_path = 'customer/customer_images/'.$image_name;
			$image_db_path = 'customer/customer_images/'.$image_name;
			
			if($image_size < 10000000){
				if($image_ext == 'jpg' || $image_ext == 'png' || $image_ext == 'gif'){
					if(move_uploaded_file($image_tmp,$image_path)){
						$update_sql = "UPDATE tbl_customer SET customer_title = '$title', customer_first_name= '$first_name', customer_last_name = '$last_name', customer_password_hint = '$password_hint', customer_email = '$email', customer_address = '$address', customer_post_code = '$post_code', customer_city = '$city', customer_country = '$country', customer_phone = '$phone', customer_mobile = '$mobile', customer_image = '$image_db_path', cust_date_created='$date' WHERE customer_id = '$_POST[cid]'";
						if(mysqli_query($conn,$update_sql)){
						
							echo "<script>window.open('my_account.php?edit_account','_self')</script>";
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
		} else {
			$update_sql = "UPDATE tbl_customer SET customer_username = customer_title = '$title', customer_first_name= '$first_name', customer_last_name = '$last_name', customer_password_hint = '$password_hint', customer_email = '$email', customer_address = '$address', customer_post_code = '$post_code', customer_city = '$city', customer_country = '$country', customer_phone = '$phone', customer_mobile = '$mobile', cust_date_created='$date' WHERE customer_id = '$_POST[cid]'";
			if(mysqli_query($conn,$update_sql)){
				echo "<script>window.open('my_account.php','_self')</script>";
			} else{
				$error = '<div class="alert alert-danger">The query was not executed.</div>';
				
			} 
		}

	}
	
?>

				
	<form action="" method="post" enctype="multipart/form-data">
	<!-- Hidden Test for id -->
	 <input type="hidden" name="cid" value="<?php if(session_id() == '') {session_start();} echo $_SESSION['id']; ?>"> 
	 <div id="customer_register" style="overflow-x:auto;">
		<div class="panel panel-info">
		<div class="panel panel-heading">
				<h3>Update Your Account</h3>
		</div>
		<table width="100%" height="70%" border="0px">
<!--
			<tr>
				<td align="right">Username:</td>
				<td><input type="text" class="form-control" name="customer_username" placeholder="Username" value="<?php/* echo $customer_username */?>" maxlength="60" id="customer_username" required/></td>
				</tr>
			<tr>
			-->
				<td align="right">Title: </td>
				<td>
					<div>
						<select class="form-control" name="title" id="title">
							<option value="<?php echo $title ?>"><?php echo $title ?></option>
							<option value="Miss">Miss</option>
							<option value="Mr">Mr</option>
							<option value="Mrs">Mrs</option>
							<option value="Ms">Ms</option>
						</select>
					</div>
				</td>
			</tr>

			<tr>
				<td align="right">First Name: *</td>
				<td><input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo $first_name; ?>" maxlength="60" id="first_name" required/></td>
				<td></td>
			</tr>
			<tr>
				<td align="right">Last Name: *</td>
				<td><input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>"id="last_name" maxlength="60" required/></td>
				<td></td>
			</tr>
			<tr>
				<td align="right">Password Hint: *</td>
				<td><input type="text" class="form-control" name="password_hint" placeholder="Password Hint" value="<?php echo $password_hint; ?>"id=" "id="password_hint" maxlength="60" required/></td>
				<td></td>
			</tr>
			<tr>
				<td align="right">Email Address: *</td>
				<td><input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo $email; ?>" id="email" maxlength="60" required/></td>
				<td></td>
			</tr>
			<tr>
			<tr>
				<td align="right">Address Line 1: *</td>
				<td><input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo $address; ?>" id="address" maxlength="60" required/></td>
				<td></td>
			</tr>
			<tr>
				<td align="right">Post Code: *</td>
				<td><input type="text" class="form-control" name="post_code" placeholder="Post Code" maxlength="60" value="<?php echo $post_code; ?>" id="post_code" required/></td>
				<td></td>
			</tr>
			<tr>
				<td align="right">Country: *</td>
				<td><input type="text" class="form-control" name="country" placeholder="country" maxlength="60" value="<?php echo $country; ?>" id="country" required/></td>
				<td></td>
			</tr>
			<tr>
				<td align="right">City: *</td>
				<td><input type="text" class="form-control" name="city" placeholder="city" maxlength="60" value="<?php echo $country; ?>" id="city" required/></td>
				<td></td>
			</tr>
			<tr>
				<td align="right">Phone: *</td>
				<td><input type="text" class="form-control" name="phone" placeholder="phone" maxlength="60" value="<?php echo $phone; ?>" id="phone" required/></td>
				<td></td>
			</tr>					
			<tr>
				<td align="right">Mobile: *</td>
				<td><input type="text" class="form-control" name="mobile" placeholder="mobile" maxlength="60" value="<?php echo $mobile; ?>" id="mobile" required/></td>
				<td></td>
			</tr>
			<tr>
				<td align="right">Image: </td>
				<td align="right"><input type="file" class="form-control" name="image" id="image" style="width:100%;height:50%;" /><img  align="left" src=" <?php echo $image; ?>" width="70" height="70" style="margin-top:10px;" alt="Customer Image" /></td>
				<td></td>
				</tr>
			<tr>
				<td><input type="submit" name="update_account" value="Update Account" /></td>
			</tr>
		</table>
		</div>
	</div>	
	</form>


<?php ob_end_flush(); ?>