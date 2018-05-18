<?php
 include_once 'includes/db.php';
 	ob_start();
	$error = ''; 
	if(isset($_POST['update_account'])){
	
	$ip=getIp();
		
		$customer_username = mysqli_real_escape_string($conn, $_POST['customer_username']);
		$title = strip_tags($_POST['title']);
		$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
		$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
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
			$image_path = '/customer/customer_images/'.$image_name;
			$image_db_path = 'customer_images/'.$image_name;
			
			if($image_size < 10000000){
				if($image_ext == 'jpg' || $image_ext == 'png' || $image_ext == 'gif'){
					if(move_uploaded_file($image_tmp,$image_path)){
						$update_sql = "UPDATE tbl_customer SET customer_username= '$customer_username', customer_title = '$title', customer_first_name= '$first_name', customer_last_name = '$last_name', customer_email = '$email', customer_address = '$address', customer_post_code = '$post_code', customer_city = '$city', customer_country = '$country', customer_phone = '$phone', customer_mobile = '$mobile', customer_image = '$image_db_path', customer_date='$date' WHERE customer_id = '$_POST[cid]'";
						if(mysqli_query($conn,$update_sql)){
						$error = '<div class="alert alert-success">Record updated successfully</div>';
							/*echo "<script>window.open('my_account.php?edit_account','_self')</script>";*/
						} else{
							/*echo "Error updating record: ";*/
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
			$update_sql = "UPDATE tbl_customer SET customer_username= '$customer_username', customer_title = '$title', customer_first_name= '$first_name', customer_last_name = '$last_name', customer_email = '$email', customer_address = '$address', customer_post_code = '$post_code', customer_city = '$city', customer_country = '$country', customer_phone = '$phone', customer_mobile = '$mobile', customer_date='$date' WHERE customer_id = '$_POST[cid]'";
			if(mysqli_query($conn,$update_sql)){
				//echo "<script>window.open('my_account.php','_self')</script>";
			} else{
				$error = '<div class="alert alert-danger">The query was not executed.</div>';
			}
		}

	}
	
?>

				
	<form action="" method="post" enctype="multipart/form-data">
	<!-- Hidden Test for id -->
	 <input type="hidden" name="cid" value="<?php if(session_id() == '') {session_start();} echo $_SESSION['id']; ?>"> 
	 
	 <div id="update_acc" style="overflow-x:auto;">
<div><?php print_r($_SESSION);
	
	/*print_r($update_sql);*/
	
	
	?></div>
		<table width="90%" height="100%" border="0px">
			<tr>
				<td colspan="2" align="center"><h2>Update Your Account</h2></td>
			</tr>
			<tr>
				<td align="right">User Name: *</td>
				<td><input type="text" class="form-control" name="customer_username" placeholder="User Name" value="<?php echo $customer_username ?>" maxlength="60" id="customer_username" required/></td>
			</tr>
			<tr>
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
				<td><input type="text" class="form-control" name="first_name" placeholder="First Name" value="<?php echo $first_name ?>" maxlength="60" id="first_name" required/></td>
			</tr>
			<tr>
				<td align="right">Last Name: *</td>
				<td><input type="text" class="form-control" name="last_name" placeholder="Last Name" value="<?php echo $last_name ?>"id="last_name" maxlength="60" required/></td>
			</tr>
			<tr>
				<td align="right">Email Address: *</td>
				<td><input type="text" class="form-control" name="email" placeholder="Email Address" value="<?php echo $email ?>" id="email" maxlength="60" required/></td>
			</tr>
			<tr>
			<tr>
				<td align="right">Address Line 1: *</td>
				<td><input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo $address ?>" id="address" maxlength="60" required/></td>
			</tr>
			<tr>
				<td align="right">Post Code: *</td>
				<td><input type="text" class="form-control" name="post_code" placeholder="Post Code" maxlength="60" value="<?php echo $post_code ?>" id="post_code" required/></td>
			</tr>
			<tr>
				<td align="right">Country: *</td>
				<td><input type="text" class="form-control" name="country" placeholder="country" maxlength="60" value="<?php echo $country ?>" id="country" required/></td>
			</tr>
			<tr>
				<td align="right">City: *</td>
				<td><input type="text" class="form-control" name="city" placeholder="city" maxlength="60" value="<?php echo $country ?>" id="city" required/></td>
			</tr>
			<tr>
				<td align="right">Phone: *</td>
				<td><input type="text" class="form-control" name="phone" placeholder="phone" maxlength="60" value="<?php echo $phone ?>" id="phone" required/></td>
			</tr>					
			<tr>
				<td align="right">Mobile: *</td>
				<td><input type="text" class="form-control" name="mobile" placeholder="mobile" maxlength="60" value="<?php echo $mobile ?>" id="mobile" required/></td>
			</tr>
			<tr>
				<td align="right">Image: </td>
				<td align="left"><input type="file" class="form-control" name="image" id="image" /><img src="<?php echo $image ?>" width="70" height="70"alt="Image" /></td>
			</tr>
			<tr>
				<td><input type="submit" name="update_account" value="Update Account" /></td>
			</tr>
		</table>
		</div>
			
	</form>


<?php ob_end_flush(); ?>