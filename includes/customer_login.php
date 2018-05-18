
<?php
	include_once 'db.php';
	//print_r($_SESSION);
	
	if(isset($_POST['cust_login'])& !empty($_POST['cust_login'])){
	$email = strip_tags(mysqli_real_escape_string($conn, $_POST['email']));
	$password = strip_tags(mysqli_real_escape_string($conn, $_POST['password']));
	$secure_password = password_hash($password, PASSWORD_BCRYPT);


	$sel_cust = "SELECT * FROM tbl_customer WHERE customer_email = '$email' AND active IS NOT NULL";  
           $pre_sel = mysqli_query($conn, $sel_cust);  
           if(mysqli_num_rows($pre_sel) > 0)  
           {  
                while($row_cust = mysqli_fetch_array($pre_sel))  
                {  
                     if(password_verify($password, $row_cust["customer_password"]))  
                     {  
						$_SESSION['customer_username'] = $row_cust['customer_username'];
						$_SESSION['customer_email'] = $row_cust['customer_email'];
						$ip =getIp();
			
						$sel_cart = "SELECT * FROM tbl_cart WHERE cart_ip_add = '$ip'";
						$pre_cart = mysqli_query($conn, $sel_cart);
						$check_cart = mysqli_num_rows($pre_cart);
						//$pre_sel = mysqli_query($conn,$sel_cust);
						$check_cust = mysqli_num_rows($pre_sel);
			
						if($check_cust>0 AND $check_cart==0){
							while($row_cust = mysqli_fetch_assoc($pre_sel)){
								//$_SESSION['customer_username'] = $row_cust['customer_username'];
								//$_SESSION['customer_email'] = $row_cust['customer_email'];
							}
							//echo "cust exist an cart 0";
						$success = 'You logged in successfully. Thanks!';
						echo "<script>window.open('index.php','_self')</script>";
						//print_r($_SESSION);
						} else {
							while($row_cust = mysqli_fetch_assoc($pre_sel)){
								//$_SESSION['customer_username'] = $row_cust['customer_username'];
								//$_SESSION['customer_email'] = $row_cust['customer_email'];
								//echo "cust exist an cart 1";
								//print_r($check_cust);
								//print_r($_SESSION);
							}
						$success = 'You logged successfully. Thanks!'; 
						echo "<script>window.open('checkout.php','_self')</script>"; 
						}
						//echo "<script>window.open('index.php','_self')</script>";
						//echo "Password verified<br/>";
 
						 
                     }  
                     else  
                     {  
						$error = 'Password or email is inncorrect. Please try again!';		
						//echo "<script>window.open('my_account.php','_self')</script>";
						//echo "Wrong Password.<br/>";
                          //return false;  
                        //  echo '<script>alert("Wrong User Details")</script>';  
                     }  
                }  
           }  
           else  
           {  
	   		$error= 'Email is inncorrect or account is not activated. Please try again!';	
			//echo "<script>window.open('my_account.php','_self')</script>";
			//unset($_SESSION['customer_email']);
			//unset($_SESSION['customer_username']);
				//echo "No User found";
            //    echo '<script>alert("Wrong User Details")</script>';  
           }  
	
		}
	
?>
<p id="msg"></p>
<div id="customer_login" align="center">
	
	<form action="" method="post" enctype="multipart/form-data" autocomplete="off" onsubmit="return ValidateLoginForm();">

		<div class="panel panel-heading" style="background-color:#D9EDF7";>
			<h3 style="background-color:#D9EDF7;color:#3182B4">Login or Register to buy!</h3>
	<!-- PHP errors handeling -->		
	<?php if(isset($error) & !empty($error)){ ?><div class="alert alert-danger" role="alert"><?php echo $error; ?></div><?php } ?>
		<!-- JavaScript errors handeling -->	
	<div class="alert alert-danger" style="padding-left:5%;" id="error"></div>
	<?php if(isset($success) & !empty($success)){ ?><div class="alert alert-success" role="alert"><?php echo $success; ?></div><?php } ?>
		</div>
		<div class="form-group">
			<label for="email" class="col-sm-3 control-label" style="padding-top:20px;">User Email: *</label>
			<div class="col-sm-7" style="padding-top:20px;">
				<input type="text" class="form-control" name="email" placeholder="Email" id="email" minlength="3" maxlength="60" required/>
			</div>
		</div><!--form-group-->
		<div class="form-group">
			<label for="password" class="col-sm-3 control-label" style="padding-top:20px;">Password: *</label>
			<div class="col-sm-7" style="padding-top:20px;">
				<input type="password" class="form-control" name="password" placeholder="Password" id="password"  maxlength="60"required/>
			</div>
		</div><!--form-group-->
		
		<div class="form-group">
				<label class="col-sm-3 control-label" style="padding-top:20px;"></label>
				<div class="col-sm-7" style="padding-top:20px;">
				<input type="submit" value="Login" class="btn btn-block btn-success" name="cust_login" id="cust_login">
				</div>
		</div><!--form-group-->
		<div class="form-group">
			<label class="col-sm-3 control-label" style="padding-top:20px;"></label>
			<div class="col-sm-7" style="padding-top:20px;">
				<a href="customer_register.php"><input type="" value="Customer Register" class="btn btn-block btn-info" name="register" id="register"></a> 
			</div>
		</div><!--form-group-->
		
				
		<td width="1%" align="left" colspan="9"><h2 style="float:left; padding-left:20px;"><a href="forgot_password.php" style="text-decoration:none;font-size:20px;">Forgot Password<a/></h2></td>
				
	
	</form>

</div>
