
<?php
	//include_once 'includes/db.php';
	//ob_start();
	//print_r($_SESSION);
	
	if(isset($_POST['cust_login'])& !empty($_POST['cust_login'])){
	$email = strip_tags(mysqli_real_escape_string($conn, $_POST['email']));
	$password = strip_tags(mysqli_real_escape_string($conn, $_POST['password']));
	$secure_password = password_hash($password, PASSWORD_BCRYPT);

	//$sel_cust = "SELECT * FROM `tbl_customer` WHERE (`customer_email`='$email' || `customer_username` = '$email') AND `active` = 1 AND customer_password='$secure_password'";
	//$pre_sel = mysqli_query($conn, $sel_cust );
	//$check_cust = mysqli_num_rows($pre_sel);
	

	$sel_cust = "SELECT * FROM tbl_customer WHERE customer_email = '$email'";  
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
							echo "cust exist an cart 0";
							//print_r($check_cust);
							//print_r($_SESSION);
						//echo "<script>alert('You logged in successfully. Thanks!')</script>";
						//echo "<script>window.open('index.php','_self')</script>";
						print_r($_SESSION);
						} else {
							while($row_cust = mysqli_fetch_assoc($pre_sel)){
								//$_SESSION['customer_username'] = $row_cust['customer_username'];
								//$_SESSION['customer_email'] = $row_cust['customer_email'];
								echo "cust exist an cart 1";
								//print_r($check_cust);
								//print_r($_SESSION);
							}
						echo "<script>alert('You logged successfully. Thanks!')</script>"; 
						echo "<script>window.open('checkout.php','_self')</script>"; 
						}
 
						//echo "Password verified<br/>";

                          //return true;  
                          //$_SESSION["username"] = $username;  
                         // header("location:entry.php"); 
						 
                     }  
                     else  
                     {  
						echo "<script>alert('Password or email is inncorrect. Please try again!')</script>";		
						echo "<script>window.open('my_account.php','_self')</script>";
						//echo "Wrong Password.<br/>";
                          //return false;  
                        //  echo '<script>alert("Wrong User Details")</script>';  
                     }  
                }  
           }  
           else  
           {  
	   		echo "<script>alert('Password or email is inncorrect. Please try again!')</script>";		
			echo "<script>window.open('my_account.php','_self')</script>";
			unset($_SESSION['customer_email']);
			unset($_SESSION['customer_username']);
				//echo "No User found";
            //    echo '<script>alert("Wrong User Details")</script>';  
           }  
	
		}

	
?>
<p id="msg"></p>
<div id="" align="center">
	
	<form action="" method="post" enctype="multipart/form-data">
		<table align="center" width="80%" bgcolor="skyblue">
			<tr align="center">

			</tr>					
			<col width="30%">
	  		<col width="70%">
			<tr>
				<td align="right"><b>User Email: *</b></td>
				<td align="left" width="80%" ><input type="text" id="email" name="email" placeholder="Username or Email" minlength="3" maxlength="60" required/></td>

			</tr>
			<tr>
				<td align="center" colspan="12"><input type="submit" name="forgot_passwor" value="Retrive Password" /></td>
			</tr>

		</table>
				
	</form>
<p id="msg"></p>
</div>
