<?php
	
	$user = $_SESSION['customer_email'];
	
	if(isset($_POST['yes'])){
		$delete_customer = "DELETE FROM tbl_customer WHERE customer_email='$user'";
		$pre_delete = mysqli_query($conn, $delete_customer);
		
		echo "<script>alert('We are sorry, your account has been deleted!')</script>";
		echo "<script>window.open('../index.php','_self'))</script>";
		
	}
	if(isset($_POST['no'])){
	
		echo "<script>alert('Your account has not been deleted!')</script>";
		echo "<script>window.open('my_account.php','_self')</script>";
		
	
	}
	
	
?>


<h2>Do you really want to delete your account!</h2>
<form action="" method="post">

<input type="submit" name="yes" value="Yes" />
<input type="submit" name="no" value="No" />



</form>