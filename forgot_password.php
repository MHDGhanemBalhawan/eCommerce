<!DOCTYPE html>
<?php
	SESSION_START();
	include_once 'functions/functions.php';
	include_once 'includes/db.php';
	include_once 'includes/security.php';
	include_once 'includes/useremailconfig.php';
	require_once 'phpmailer/PHPMailerAutoload.php';
	
	if(isset($_POST) &!empty($_POST)){
	$pass = rand(99,99999);
	$email =strip_tags(mysqli_real_escape_string($conn,$_POST['email']));
	$sel_sql="SELECT * FROM tbl_customer where customer_email ='$email'";
	$result = mysqli_query($conn,$sel_sql);
	$count = mysqli_num_rows($result);

	if($count == 1){

		$row_cust = mysqli_fetch_assoc($result);
		$cust_email = $row_cust['customer_email'];
		$secure_password= password_hash($pass, PASSWORD_BCRYPT);
		$sql_update = "UPDATE `tbl_customer` SET customer_password='$secure_password', forgot_status=0 WHERE customer_email='$cust_email'";
		$pre_update = mysqli_query($conn,$sql_update);
		if($pre_update){
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
			$mail->addAddress('mghanemb@hotmail.com', 'Registeration New User');     // Add a recipient
			$mail->isHTML(true);                                  // Set email format to HTML
			$mail->Subject = 'Your New Password';
			$mail->Body    = "Your Password is $pass";
			$mail->AltBody = 'Your Password is $pass"';
			
			if(!$mail->send()) {
				$error = 'Message could not be sent.';
				//$error .= 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				$success = 'Message has been sent';
			}
			
			//end phpmailer
		
		
		
		
		}else{
		
		$error = "Something was wrong. Failed to update password.";
		
		}
		
		


		}else{
		$error = 'Email address Does not exist in database!';
		}

	}
	//$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
	//$fields = isset($_SESSION['fields']) ? $_SESSION['fields'] : [];
//echo e('<script>alert(1)</script>');

	//print_r($error);
?>
<html>
<head>
	
	<title>Forgot Password</title>
	<meta charset="utf-8"> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	
	<script src="bootstrap/js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>
	<script src="bootstrap/js/myscript.js"></script>
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
				<div id="contact">
				<div class="panel panel-default" bgcolor="#D9EDF7" style="margin:0px;pading:10px;">
					<h3 style="background-color:#D9EDF7;padding:30px;margin:0px;">Forgot Your Password!</h3>
				</div>
				<!-- error message no email-->
				<?php if(!empty($error)): ?>
				<div class="alert alert-danger" align="left" style="padding-left:5%;"><?php echo $error; ?>
				</div>
				<?php endif; ?>
				<!--  message sent-->
				<?php if(!empty($success)): ?>
				<div class="alert alert-success" align="left" style="padding-left:5%;"><?php echo $success; ?>
				</div>
				<?php endif; ?>
				<form class="form-horizontal" action="forgot_password.php" method="post" role="form"style="padding-top:30px;">
			
					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">Email Address *</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="email" placeholder="Email" id="email">
						</div>
					</div><!--form-group-->
					<div class="form-group">
						<label class="col-sm-3 control-label"></label>
						<div class="col-sm-7">
							<input type="submit" value="Reset Your Password" class="btn btn-block btn-danger" name="submit_email" id="submit_email">
						</div>
					</div><!--form-group-->
					<div class="form-group">
						<label class="col-sm-3 control-label"></label>
						<div class="col-sm-7">
							<a href="my_account.php"><input type="" value="Login" class="btn btn-block btn-success" name="Login" id="Login"></a> 
						</div>
					</div><!--form-group-->
					

					</form>	
		
</div>

	  <!--/row-->		
                </div>
                <!--/row-->
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
