<?php 
session_start();

?>
<!DOCTYPE>
<html>
	<head>
		<title>Login Form</title>
<link rel="stylesheet" href="styles/login_style.css" media="all" /> 

	</head>
<body>
<div class="login">
<h2 style="color:white; text-align:center;"><?php echo @$_GET['not_admin']; ?></h2>

<h2 style="color:white; text-align:center;"><?php echo @$_GET['logged_out']; ?></h2>
	
	<h1>Admin Login</h1>
    <form method="post" action="login.php">
    	<input type="text" name="email" placeholder="Eamil" required="required" />
        <input type="password" name="password" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large" name="login">Login</button>
    </form>
</div>


</body>
</html>
<?php 

include("includes/db.php"); 
	
	if(isset($_POST['login'])){
	

		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$password = mysqli_real_escape_string($conn, $_POST['password']);
		

		
		$sel_cust = "SELECT * FROM tbl_admin WHERE user_password ='$password' AND user_email = '$email'";
		
		$pre_sel = mysqli_query($conn, $sel_cust );
		
		$check_cust = mysqli_num_rows($pre_sel);
		
		if($check_cust==1){
	
			$_SESSION['user_email']=$email; 
		
			echo "<script>window.open('index.php?logged_in=You have successfully Logged in!','_self')</script>";
		
		} else {
		
			echo "<script>alert('Password or Email is wrong, try again!')</script>";
		
		}
	
	
	}
	

?>