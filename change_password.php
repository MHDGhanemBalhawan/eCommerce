<?php
	echo $error;
	//print_r($_SESSION);
	if(isset($_POST['change_password'])){
		$cust_email=$_SESSION['customer_email'];
		$password = strip_tags(mysqli_real_escape_string($conn, $_POST['password']));
		$secure_password = password_hash($password, PASSWORD_BCRYPT);
		$new_password = strip_tags(mysqli_real_escape_string($conn, $_POST['new_password']));
		$secure_new_pass = password_hash($new_password, PASSWORD_BCRYPT);
		$confirm_password = strip_tags(mysqli_real_escape_string($conn, $_POST['confirm_password']));
		if($new_password!=$confirm_password){
			$error= "New password do not match!";
			
		} else {

	   $sel_cust = "SELECT * FROM tbl_customer WHERE customer_email = '$cust_email'";  
	   $pre_sel = mysqli_query($conn, $sel_cust);  
	   if(mysqli_num_rows($pre_sel) > 0)  
	   {  
			while($row_cust = mysqli_fetch_array($pre_sel))  
			{  
				if(password_verify($password, $row_cust["customer_password"]))  
				 {  
					//echo "Password verified<br/>";
					$update_pass = "UPDATE tbl_customer SET customer_password='$secure_new_pass' WHERE customer_email='$cust_email'";
					$run_update =mysqli_query($conn,$update_pass);
					$success = 'Your Password is Change!';
				 }  
				 else  
				 {  
					$error = 'Your current password is wrong!';		
					//echo "Wrong Password.<br/>";
					  //return false;  
				 }  
			}  
	   }  
	   else  
	   {  
		//echo "<script>alert('Password or email is inncorrect. Please try again!')</script>";		
		//echo "<script>window.open('my_account.php','_self')</script>";
		//unset($_SESSION['customer_email']);
		//unset($_SESSION['customer_username']);
		//echo "No User found";
		//echo '<script>alert("Wrong User Details")</script>';  
	   }
	   }

	}
?>
<div >
	
	<form class="form-horizontal" action="" method="post" role="form">
	<div class="panel panel-info">
	<div class="panel panel-heading" style="background-color:#D9EDF7";>
			<h3 style="background-color:#D9EDF7;color:#3182B4;">Change Your Password</h3>
	<!-- PHP errors handeling -->		
	<?php if(isset($error) & !empty($error)){ ?><div class="alert alert-danger" role="alert"><?php echo $error; ?></div><?php } ?>
	<?php if(isset($success) & !empty($success)){ ?><div class="alert alert-success" role="alert"><?php echo $success; ?></div><?php } ?>
	</div>
	
	<div class="form-group">
		<label for="password" class="col-sm-3 control-label" style="padding-top:20px;">Current Password: *</label>
		<div class="col-sm-7" style="padding-top:20px;">
			<input type="password" class="form-control" name="password" placeholder="Current Password" id="password"  maxlength="60"required/>
		</div>
	</div><!--form-group-->
	<div class="form-group">
		<label for="password" class="col-sm-3 control-label" style="padding-top:20px;">New Password: *</label>
		<div class="col-sm-7" style="padding-top:20px;">
			<input type="password" class="form-control" name="new_password" placeholder="New Password" id="new_password"  maxlength="60"required/>
		</div>
	</div><!--form-group-->
	<div class="form-group">
		<label for="password" class="col-sm-3 control-label" style="padding-top:20px;">Confirm Password: *</label>
		<div class="col-sm-7" style="padding-top:20px;">
			<input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password" id="confirm_password"  maxlength="60"required/>
		</div>
	</div><!--form-group-->
	<div class="form-group">
			<label class="col-sm-3 control-label" style="padding-top:20px;"></label>
			<div class="col-sm-7" style="padding-top:20px;">
			<input type="submit" value="Change Password" class="btn btn-block btn-success" name="change_password" id="cust_login">
			</div>
	</div><!--form-group-->
	</div>
	</form>
</div>