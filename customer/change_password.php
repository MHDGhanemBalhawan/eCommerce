<?php

	if(isset($_POST['change_password'])){
		$user = $_SESSION['customer_email'];
		$current_password = $_POST['current_password'];
		$new_password = $_POST['new_password'];
		$confirm_password = $_POST['confirm_password'];
		
		$sel_pass = "SELECT * FROM tbl_customer WHERE customer_password ='$current_password' AND customer_email='$user' ";
		
		$pre_pass = mysqli_query($conn, $sel_pass);
		
		$check_pass = mysqli_num_rows($pre_pass);
		
		if($check_pass==0){
		
			echo "<script>alert('Your current password is wrong!')</script>";
			exit();
		}
		
		if($new_password!=$confirm_password){
		
			echo "<script>alert('New password do not match!')</script>";
			exit();
		
		} else {
		
			$update_pass = "UPDATE tbl_customer SET customer_password='$new_password' WHERE customer_email='$user'";
			
			$run_update =mysqli_query($conn,$update_pass);
			
			echo "<script>alert('Your Password is Change!')</script>";
			echo "<script>window.open('my_account.php?change_password','_self')</script>";
			
		}
	}
	
?>


<div>
	<h2>Change Your Password</h2>
	<form action="" method="post">
	<table id="tblpass"  width="60%" style="text-align:left;margin-left:20%;">
		<tr>
		<td><b>Enter Current Password: </b></td>
		<td><b><input type="text" name="current_password" required//></td>
		</tr>
		<tr>
		<td><b>Enter New Password: </b></td>
		<td><input type="text" name="new_password" required/></td>
		</tr>
		<tr>
		<td><b>Confirm Your Password: </b></td>
		<td><input type="text" name="confirm_password" required/></td>
		</tr>
		<tr>
		<td></td>
		<td align="left"><input type="submit" name="change_password" value="Change Password" /></td>
		</tr>
	</table>
	
	</form>


</div>