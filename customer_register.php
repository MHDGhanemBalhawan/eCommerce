<!DOCTYPE html>
<?php
	//error_reporting(E_ALL);
	//ini_set('display_errors', '1');
	include_once 'functions/functions.php';
	include_once 'includes/security.php';
	include_once 'includes/useremailconfig.php';
	include_once 'includes/db.php';
	include_once 'user_management/recaptchalib.php';
	require_once 'phpmailer/PHPMailerAutoload.php';
	//include_once 'checkdata.php';
	SESSION_START();
	$response = null;
	$ReCaptcha = new ReCaptcha($secret);
	$captcha ='';
	//ob_start();

	//print_r($_SESSION);

	if(isset($_POST['register_customer'])){
/*		
		if(isset($_POST['g-recaptcha-response'])){
			$response = $reCaptacha->verifyResponse(
				$_SERVER['REMOTE_ADDR'],
				$_POST['g-recaptcha-response']
			);
		}
	if($response !=null && $response->success){
		echo "create user";
	}else{
		echo "submit again";
	}
	*/
	
	if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
		echo $captcha;
          $error = 'Please check the the captcha form.';
         
        }
        $secretKey = "6LeoBywUAAAAAGj7WSa6DSXXVgFbBpV4PsJ8-jut";
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);
        if(intval($responseKeys["success"]) !== 1) {
		 //$error = 'Please check the the captcha form.';
          $error = 'You are spammer ! Get out of here.';
		  } else {
		//echo $captcha;
          //$success = 'Account has been created.';
		  
	$ip=getIp();

		//$cust_username = strip_tags(mysqli_real_escape_string($conn, $_POST['cust_username']));
		
		$title = strip_tags($_POST['title']);
		$first_name = strip_tags(mysqli_real_escape_string($conn, $_POST['first_name']));
		$last_name = strip_tags(mysqli_real_escape_string($conn, $_POST['last_name']));
		$email = strip_tags(mysqli_real_escape_string($conn, $_POST['email']));
		$password = strip_tags(mysqli_real_escape_string($conn, $_POST['password']));
		$secure_password = password_hash($password, PASSWORD_BCRYPT);
		$customer_password_hint = strip_tags(mysqli_real_escape_string($conn, $_POST['password_hint']));
		$address = strip_tags(mysqli_real_escape_string($conn, $_POST['address']));
		$post_code = strip_tags(mysqli_real_escape_string($conn, $_POST['address']));
		$city = strip_tags(mysqli_real_escape_string($conn, $_POST['city']));
		$country = strip_tags(mysqli_real_escape_string($conn, $_POST['country']));
		$phone = strip_tags(mysqli_real_escape_string($conn, $_POST['phone']));
		$mobile = strip_tags(mysqli_real_escape_string($conn, $_POST['mobile']));
		$date = date('Y-m-d h:i:s');
		$verification_key = md5($first_name);
		
		//Check user name if exists
		//$sel_username = "SELECT customer_username FROM tbl_customer WHERE customer_username='$cust_username'";
		//$pre_sql = mysqli_query($conn,$sel_username);
		//$resusername= mysqli_num_rows($pre_sql);
		//if($resusername == 1){
			//$error = 'Username exists in databse, please try different username. ';				
			//}//end of if username
			
		//Check user email if exists
		$sel_email = "SELECT customer_email FROM tbl_customer WHERE customer_email='$email'";
		$pre_sql = mysqli_query($conn,$sel_email);
		$resemail= mysqli_num_rows($pre_sql);
		if($resemail == 1){
			$error = 'Email exists in databse, please try different email.';				
			}//end of if email	
			
		if($_FILES['image']['name'] != ''){
			$image_name = $_FILES['image']['name'];
			$image_tmp = $_FILES['image']['tmp_name'];
			$image_size = $_FILES['image']['size']; 
			$image_ext = pathinfo($image_name, PATHINFO_EXTENSION);
			$image_path = 'customer/customer_images/'.$image_name;
			$image_db_path = 'customer/customer_images/'.$image_name;
			
			if($image_size < 1048576){
				if($image_ext == 'jpg' || $image_ext == 'png' || $image_ext == 'gif'){
					if(move_uploaded_file($image_tmp,$image_path)){
						$ins_sql = "INSERT INTO tbl_customer (customer_ip, customer_title, customer_first_name, customer_last_name, customer_email, customer_password, customer_password_hint, customer_address, customer_post_code, customer_city, customer_country, customer_phone, customer_mobile, customer_image, cust_date_created, verification_key) VALUES ('$ip', '$title', '$first_name', '$last_name', '$email', '$secure_password', '$customer_password_hint', '$address', '$post_code', '$city', '$country', '$phone', '$mobile', '$image_db_path', '$date','$verification_key')";
						$result= mysqli_query($conn,$ins_sql);
						if($result){
							// display success message
							$success = 'Account created successfully!';
							// setting the user info into the session
							//$_SESSION['cust__username'] = $cust_username;
							
							$_SESSION['title'] = $title;
							$_SESSION['first_name'] = $first_name;
							$_SESSION['last_name'] = $last_name;
							$_SESSION['customer_email'] = $email;
							$_SESSION['address'] = $address;
							$_SESSION['post_code'] = $post_code;
							$_SESSION['city'] = $city;
							$_SESSION['country'] = $country;
							$_SESSION['phone'] = $phone;
							$_SESSION['mobile'] = $mobile;
							
							$id=mysqli_insert_id($conn);
							$_SESSION['id'] = $id;
							
							//phpmailer
							
							
							$mail = new PHPMailer;
							$mail->isSMTP();                                     
							$mail->Host = $smtphost;  					 
							$mail->SMTPAuth = true;                               
							$mail->Username = $smtpuser;            
							$mail->Password = $smtppass;                       
							$mail->SMTPSecure = 'ssl';                            
							$mail->Port = 465;


							$mail->setFrom('info@modelledSoft.com', 'Mailer');
						
							$mail->addAddress($email, 'Registeration New User');     // Add a recipient
							$mail->AddCC('mghanemb@hotmail.com', 'Registeration New User'); // Add cc
							
							$mail->isHTML(true);                                  // Set email format to HTML

							$mail->Subject = 'Please Verify Your Email';
							$mail->Body    = "http://localhost/verify.php?key=$verification_key&id=$id";
							$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

							if(!$mail->send()) {
								$error = 'Message could not be sent.';
								$error .= 'Mailer Error: ' . $mail->ErrorInfo;
							} else {
								$success = 'Message has been sent. Please activate you account.';
								echo "<script>alert('Message has been sent. Please activate you account.')</script>";
	
								echo "<script>window.open('checkout.php','_self')</script>";
							}
							
					
							
							//end phpmailer
	
							//header('customer_register.php');
						} else{
							//$error = 'Something went wrong the account was not created.';
						}
					} else {
						$error = 'Sorry, image was not uploaded!';
					}
					
				} else {
					$error = 'Image format should be jpg or gif or png!';
					
				}
			}else{
				$error = 'File size is bigger than 1 mb.';
			}
			
			// register customer without image
		} else {
		//Check user name if exists
		//$sel_username = "SELECT customer_username FROM tbl_customer WHERE customer_username='$cust_username'";
		//$pre_sql = mysqli_query($conn,$sel_username);
		//$resusername= mysqli_num_rows($pre_sql);
		//if($resusername == 1){
			//$error = 'Username exists in databse, please try different username. ';				
			//}//end of if username
		//Check user email if exists
		$sel_email = "SELECT customer_email FROM tbl_customer WHERE customer_email='$email'";
		$pre_sql = mysqli_query($conn,$sel_email);
		$resemail= mysqli_num_rows($pre_sql);
		if($resemail == 1){
			$error = 'Email exists in databse, please try different email.';				
			}//end of if email	
			else{
			$ins_sql = "INSERT INTO tbl_customer (customer_ip, customer_title,  customer_first_name, customer_last_name, customer_email, customer_password, customer_password_hint, customer_address, customer_post_code, customer_city, customer_country, customer_phone, customer_mobile, cust_date_created, verification_key) VALUES ('$ip', '$title', '$first_name', '$last_name', '$email', '$secure_password', '$customer_password_hint', '$address', '$post_code', '$city', '$country', '$phone', '$mobile', '$date', '$verification_key')";
			$result = mysqli_query($conn,$ins_sql);
			
			if($result) {
			$sel_cart = "SELECT * FROM tbl_cart WHERE cart_ip_add = '$ip'";
			$pre_cart = mysqli_query($conn, $sel_cart);
			$check_cart = mysqli_num_rows($pre_cart);
			if($check_cart == 0){
			//$_SESSION['customer_email'] = $email;
			$success = 'Message has been sent. Please activate you account.';
			//echo "<script>window.open('my_account.php','_self')</script>";
			} else{
			//$_SESSION['customer_email'] = $email;
			$success = 'Message has been sent. Please activate you account.';
			//echo "<script>window.open('checkout.php','_self')</script>";

			}
				//header('customer_register.php');

				// display success message
				$success = 'Account created successfully!';
				// setting the user info into the session
				//$_SESSION['cust__username'] = $cust_username;
				//$_SESSION['id'] = $id;
				$_SESSION['title'] = $title;
				$_SESSION['first_name'] = $first_name;
				$_SESSION['last_name'] = $last_name;
				$_SESSION['customer_email'] = $email;
				$_SESSION['address'] = $address;
				$_SESSION['post_code'] = $post_code;
				$_SESSION['city'] = $city;
				$_SESSION['country'] = $country;
				$_SESSION['phone'] = $phone;
				$_SESSION['mobile'] = $mobile;
				
				$id=mysqli_insert_id($conn);
				$_SESSION['id'] = $id;
	
				//phpmailer
				$mail = new PHPMailer;
							$mail->isSMTP();                                     
							$mail->Host = $smtphost;  					 
							$mail->SMTPAuth = true;                               
							$mail->Username = $smtpuser;            
							$mail->Password = $smtppass;                       
							$mail->SMTPSecure = 'ssl';                            
							$mail->Port = 465;


							$mail->setFrom('info@modelledSoft.com', 'Mailer');
							$mail->addAddress('mghanemb@hotmail.com', 'Registeration New User');     
							$mail->isHTML(true);                                

							$mail->Subject = 'Verify Your Email';
							$mail->Body    = "http://localhost:/verify.php?key=$verification_key&id=$id";
							$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

							if(!$mail->send()) {
								$error = 'Message could not be sent.';
								//$error .= 'Mailer Error: ' . $mail->ErrorInfo;
							} else {
								$success = 'Message has been sent. Please activate you account.';
								echo "<script>alert('Message has been sent. Please activate you account.')</script>";
	
								echo "<script>window.open('checkout.php','_self')</script>";
							}
							
				//end phpmailer
				
			} else{
				$error .= 'The query was not executed.';
			}
		}
		}
		  
        
		}
	
}

?>

<html>
<head>
	<title>Customer Register</title>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<script src="bootstrap/js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
	<script src="bootstrap/js/myscript.js"></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<link rel="stylesheet" href="styles/style.css" media="all">
	<style>
.headroom {
    transition: transform 200ms linear;
	}
.headroom--pinned {
    transform: translateY(0%);
}
.headroom--unpinned {
    transform: translateY(-100%);
}
.animated{-webkit-animation-duration:.5s;-moz-animation-duration:.5s;-o-animation-duration:.5s;animation-duration:.5s;-webkit-animation-fill-mode:both;-moz-animation-fill-mode:both;-o-animation-fill-mode:both;animation-fill-mode:both}@-webkit-keyframes slideDown{0%{-webkit-transform:translateY(-100%)}100%{-webkit-transform:translateY(0)}}@-moz-keyframes slideDown{0%{-moz-transform:translateY(-100%)}100%{-moz-transform:translateY(0)}}@-o-keyframes slideDown{0%{-o-transform:translateY(-100%)}100%{-o-transform:translateY(0)}}@keyframes slideDown{0%{transform:translateY(-100%)}100%{transform:translateY(0)}}.animated.slideDown{-webkit-animation-name:slideDown;-moz-animation-name:slideDown;-o-animation-name:slideDown;animation-name:slideDown}@-webkit-keyframes slideUp{0%{-webkit-transform:translateY(0)}100%{-webkit-transform:translateY(-100%)}}@-moz-keyframes slideUp{0%{-moz-transform:translateY(0)}100%{-moz-transform:translateY(-100%)}}@-o-keyframes slideUp{0%{-o-transform:translateY(0)}100%{-o-transform:translateY(-100%)}}@keyframes slideUp{0%{transform:translateY(0)}100%{transform:translateY(-100%)}}.animated.slideUp{-webkit-animation-name:slideUp;-moz-animation-name:slideUp;-o-animation-name:slideUp;animation-name:slideUp}@-webkit-keyframes swingInX{0%{-webkit-transform:perspective(400px) rotateX(-90deg)}100%{-webkit-transform:perspective(400px) rotateX(0deg)}}@-moz-keyframes swingInX{0%{-moz-transform:perspective(400px) rotateX(-90deg)}100%{-moz-transform:perspective(400px) rotateX(0deg)}}@-o-keyframes swingInX{0%{-o-transform:perspective(400px) rotateX(-90deg)}100%{-o-transform:perspective(400px) rotateX(0deg)}}@keyframes swingInX{0%{transform:perspective(400px) rotateX(-90deg)}100%{transform:perspective(400px) rotateX(0deg)}}.animated.swingInX{-webkit-transform-origin:top;-moz-transform-origin:top;-ie-transform-origin:top;-o-transform-origin:top;transform-origin:top;-webkit-backface-visibility:visible!important;-webkit-animation-name:swingInX;-moz-backface-visibility:visible!important;-moz-animation-name:swingInX;-o-backface-visibility:visible!important;-o-animation-name:swingInX;backface-visibility:visible!important;animation-name:swingInX}@-webkit-keyframes swingOutX{0%{-webkit-transform:perspective(400px) rotateX(0deg)}100%{-webkit-transform:perspective(400px) rotateX(-90deg)}}@-moz-keyframes swingOutX{0%{-moz-transform:perspective(400px) rotateX(0deg)}100%{-moz-transform:perspective(400px) rotateX(-90deg)}}@-o-keyframes swingOutX{0%{-o-transform:perspective(400px) rotateX(0deg)}100%{-o-transform:perspective(400px) rotateX(-90deg)}}@keyframes swingOutX{0%{transform:perspective(400px) rotateX(0deg)}100%{transform:perspective(400px) rotateX(-90deg)}}.animated.swingOutX{-webkit-transform-origin:top;-webkit-animation-name:swingOutX;-webkit-backface-visibility:visible!important;-moz-animation-name:swingOutX;-moz-backface-visibility:visible!important;-o-animation-name:swingOutX;-o-backface-visibility:visible!important;animation-name:swingOutX;backface-visibility:visible!important}@-webkit-keyframes flipInX{0%{-webkit-transform:perspective(400px) rotateX(90deg);opacity:0}100%{-webkit-transform:perspective(400px) rotateX(0deg);opacity:1}}@-moz-keyframes flipInX{0%{-moz-transform:perspective(400px) rotateX(90deg);opacity:0}100%{-moz-transform:perspective(400px) rotateX(0deg);opacity:1}}@-o-keyframes flipInX{0%{-o-transform:perspective(400px) rotateX(90deg);opacity:0}100%{-o-transform:perspective(400px) rotateX(0deg);opacity:1}}@keyframes flipInX{0%{transform:perspective(400px) rotateX(90deg);opacity:0}100%{transform:perspective(400px) rotateX(0deg);opacity:1}}.animated.flipInX{-webkit-backface-visibility:visible!important;-webkit-animation-name:flipInX;-moz-backface-visibility:visible!important;-moz-animation-name:flipInX;-o-backface-visibility:visible!important;-o-animation-name:flipInX;backface-visibility:visible!important;animation-name:flipInX}@-webkit-keyframes flipOutX{0%{-webkit-transform:perspective(400px) rotateX(0deg);opacity:1}100%{-webkit-transform:perspective(400px) rotateX(90deg);opacity:0}}@-moz-keyframes flipOutX{0%{-moz-transform:perspective(400px) rotateX(0deg);opacity:1}100%{-moz-transform:perspective(400px) rotateX(90deg);opacity:0}}@-o-keyframes flipOutX{0%{-o-transform:perspective(400px) rotateX(0deg);opacity:1}100%{-o-transform:perspective(400px) rotateX(90deg);opacity:0}}@keyframes flipOutX{0%{transform:perspective(400px) rotateX(0deg);opacity:1}100%{transform:perspective(400px) rotateX(90deg);opacity:0}}.animated.flipOutX{-webkit-animation-name:flipOutX;-webkit-backface-visibility:visible!important;-moz-animation-name:flipOutX;-moz-backface-visibility:visible!important;-o-animation-name:flipOutX;-o-backface-visibility:visible!important;animation-name:flipOutX;backface-visibility:visible!important}@-webkit-keyframes bounceInDown{0%{opacity:0;-webkit-transform:translateY(-200px)}60%{opacity:1;-webkit-transform:translateY(30px)}80%{-webkit-transform:translateY(-10px)}100%{-webkit-transform:translateY(0)}}@-moz-keyframes bounceInDown{0%{opacity:0;-moz-transform:translateY(-200px)}60%{opacity:1;-moz-transform:translateY(30px)}80%{-moz-transform:translateY(-10px)}100%{-moz-transform:translateY(0)}}@-o-keyframes bounceInDown{0%{opacity:0;-o-transform:translateY(-200px)}60%{opacity:1;-o-transform:translateY(30px)}80%{-o-transform:translateY(-10px)}100%{-o-transform:translateY(0)}}@keyframes bounceInDown{0%{opacity:0;transform:translateY(-200px)}60%{opacity:1;transform:translateY(30px)}80%{transform:translateY(-10px)}100%{transform:translateY(0)}}.animated.bounceInDown{-webkit-animation-name:bounceInDown;-moz-animation-name:bounceInDown;-o-animation-name:bounceInDown;animation-name:bounceInDown}@-webkit-keyframes bounceOutUp{0%{-webkit-transform:translateY(0)}30%{opacity:1;-webkit-transform:translateY(20px)}100%{opacity:0;-webkit-transform:translateY(-200px)}}@-moz-keyframes bounceOutUp{0%{-moz-transform:translateY(0)}30%{opacity:1;-moz-transform:translateY(20px)}100%{opacity:0;-moz-transform:translateY(-200px)}}@-o-keyframes bounceOutUp{0%{-o-transform:translateY(0)}30%{opacity:1;-o-transform:translateY(20px)}100%{opacity:0;-o-transform:translateY(-200px)}}@keyframes bounceOutUp{0%{transform:translateY(0)}30%{opacity:1;transform:translateY(20px)}100%{opacity:0;transform:translateY(-200px)}}.animated.bounceOutUp{-webkit-animation-name:bounceOutUp;-moz-animation-name:bounceOutUp;-o-animation-name:bounceOutUp;animation-name:bounceOutUp}
/* Off Canvas */
@media screen and (max-width: 768px) {
  .row-offcanvas {
    position: relative;
    -webkit-transition: all 0.4s ease-out;
    -moz-transition: all 0.4s ease-out;
    transition: all 0.4s ease-out;
  }
  .row-offcanvas-left
  #sidebarLeft {
    left: -50%;
  }
  .row-offcanvas-left.active {
    left: 50%;
  }
  .row-offcanvas-right 
  #sidebarRight {
    right: -50%;
  }
  .row-offcanvas-right.active {
    right: 50%;
  }
  .sidebar-offcanvas {
    position: absolute;
    top: 0;
    width: 50%;
    margin-left: 10px;
  }
  #offcanvasleft,#offcanvasright{margin-top:10px;}
  .footer{
  display:none;
  }
  body{
  min-height:100%;
  }
}
	</style>
</head>
<body>
<div><?php include 'includes/navigation.php'; ?></div>
<div class="container-fluid">
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="row-offcanvas row-offcanvas-right">
		<div><?php include_once 'includes/leftsidebar.php'; ?></div>
            <div class="col-xs-12 col-sm-8">
                <div class="row">
				<?php cart(); ?>

				<div class="panel panel-info">				
				<div class="panel panel-heading">
						<h3 align="center">Create an Account</h3>
						<!-- Javascript error haneling -->
					<div class="alert alert-danger" align="left" style="padding-left:5%;" id="regerror"></div>
					<!-- PHP errors handeling -->
					<?php if(isset($error) &!empty($error)){ ?><div class="alert alert-danger" role="alert"><?php echo $error; ?> </div><?php } ?>
				
				<!-- Javascript error haneling -->
				<div class="alert alert-success" align="left" style="padding-left:5%;" id="regsucess"></div>
			    <!-- PHP errors handeling -->
				<?php if(isset($success)){ ?><div class="alert alert-success" role="alert"><?php echo $success; ?></div><?php } ?>
				</div>


		<div id="customer_register" style="overflow-x:auto;">

		<?php cart(); ?>
			<form name="RegisterForm" action="customer_register.php" method="post" enctype="multipart/form-data" onsubmit="return ValidateRegisterForm();">
				<table class="table table-inverse" width="100%" id="tbl_register" border="0px">
			
					<tr>
						<th align="right">Title: </th>
						<td>
							<div>
								<select class="form-control" name="title" id="title">
								<option value="<?php if(isset($title) & !empty($title)){ echo $title;} ?>"><?php if(isset($title) & !empty($title)){ echo $title; } ?></option> 
					
									<option value="Miss">Miss</option>
									<option value="Mr">Mr</option>
									<option value="Mrs">Mrs</option>
									<option value="Ms">Ms</option>
								</select>
							</div>
						</td>
						
					</tr>
					<tr>
						<th align="right">First Name: *</th>
						<td><input type="text" class="form-control" name="first_name" placeholder="First Name" maxlength="60" id="first_name" value="<?php if(isset($first_name) & !empty($first_name)){echo $first_name;} ?>" /></td>
					</tr>
					<tr>
						<th align="right">Last Name: *</th>
						<td><input type="text" class="form-control" name="last_name" placeholder="Last Name" id="last_name" maxlength="60" value="<?php if(isset($last_name) & !empty($last_name)){echo $last_name;} ?>" /></td>
					</tr>
					<tr>
						<th align="right">Email Address: *</th>
						<td><input type="text" class="form-control" name="email" placeholder="Email Address" id="email" maxlength="60" value="<?php if(isset($email) & !empty($email)){echo $email;} ?>" onkeyup="checkemail();"  /></td>
						<td id="email_status"></td>
					</tr>
					<tr>
						<th align="right">Password: *</th>
						<td><input type="password" class="form-control" name="password" placeholder="Password" id="password" maxlength="60" /></td>
					</tr>
					<tr>
						<th align="right">Confirm Password: *</th>
						<td><input type="password" class="form-control" name="password_two" placeholder="Verify Password" id="password_two" maxlength="60" /></td>
					</tr>
					<tr>
						<th align="right">Password Hint: *</th>
						<td><input type="text" class="form-control" name="password_hint" placeholder="Password Hint" id="password_hint" maxlength="60" value="<?php if(isset($password_hint) & !empty($password_hint)){echo $password_hint;} ?>" /></td>
					</tr>
					<tr>
						<th align="right">Address Line : *</th>
						<td><input type="text" class="form-control" name="address" placeholder="Address" id="address" maxlength="60" value="<?php if(isset($address) & !empty($address)){echo $address;} ?>" /></td>
					</tr>
					<tr>
						<th align="right">Post Code: *</th>
						<td><input type="text" class="form-control" name="post_code" placeholder="Post Code" maxlength="60" id="post_code" value="<?php if(isset($post_code) & !empty($post_code)){echo $post_code;} ?>" /></td>
					</tr>
					<tr>
						<th align="right">Country: *</th>
						<td><input type="text" class="form-control" name="country" placeholder="Country" maxlength="60" id="country" value="<?php if(isset($country) & !empty($country)){echo $country;} ?>"  /></td>
					</tr>
					<tr>
						<th align="right">City: *</th>
						<td><input type="text" class="form-control" name="city" placeholder="City" maxlength="60" id="city" value="<?php if(isset($city) & !empty($city)){echo $city;} ?>" /></td>
					</tr>
					<tr>
						<th align="right">Phone: *</th>
						<td><input type="text" class="form-control" name="phone" placeholder="Phone" maxlength="60" id="phone" value="<?php if(isset($phone) & !empty($phone)){echo $phone;} ?>" /></td>
					</tr>					
					<tr>
						<th align="right">Mobile: *</th>
						<td><input type="text" class="form-control" name="mobile" placeholder="Mobile" maxlength="60" id="mobile"value="<?php if(isset($mobile) & !empty($mobile)){echo $mobile;} ?>" /></td>
					</tr>	
					<tr>
						<th align="right">Image: </th>
						<td><input type="file" class="form-control" name="image" placeholder="Image" id="image" style="width:100%;height:50%;" /></td>
					</tr>
					<tr>
						<th></th>
						<td>
						<div class="g-recaptcha" data-sitekey="6LeoBywUAAAAAIIwlKA0q4er2NNtkuNihDFftZe2" align="right"></div>
						</td>
					</tr>
					<tr>
						<td><input type="submit" name="register_customer" class="btn btn-block btn-success" value="Create an Account" /></td>
					</tr>
				</table>
			</form>
		</div>
		</div>
	</div>  <!--/row-->	
				</div>
            <!--/span-->
<div><?php include_once 'includes/rightsidebar.php'; ?></div>
        </div>
    </div>
    <!--/row-->
    <hr>
</div>
	<div><?php include 'includes/footer.php'; ?></div>
</body>
</html>
<?php
	//unset($_SESSION['cust_username']);
	
	?>