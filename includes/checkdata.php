<?php
$server = '';
	$username = '';
	$password = '';
	$db = '';
	$conn = mysqli_connect($server,$username,$password,$db);

if(isset($_POST['cust_username']))
{
 $cust_username=$_POST['cust_username'];

 $checkdata=" SELECT customer_username FROM tbl_customer WHERE customer_username='$cust_username' ";

 $query=mysqli_query($conn,$checkdata);

 $row = mysqli_fetch_assoc($query);

 if(($row)>0){
  echo "Username Already Exist";
 }
 else
 {
  echo "OK";
 }
 exit();
}

if(isset($_POST['email']))
{
 $email=$_POST['email'];

 $checkdata=" SELECT customer_email FROM tbl_customer WHERE customer_email='$email' ";

 $query = mysqli_query($conn,$checkdata);
$row = mysqli_fetch_assoc($query);

 if(($row)>0)
 {
  echo "Email Already Exist";
 }
 else
 {
  echo "OK";
 }
 exit();
}
?>
