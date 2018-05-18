<?php include 'includes/db.php'; 
	if(isset($_POST['submit_comment'])){
	// escape variables for security
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$email = mysqli_real_escape_string($conn, $_POST['email']);
		$subject = mysqli_real_escape_string($conn, $_POST['subject']);
		$comment = mysqli_real_escape_string($conn, $_POST['comment']);
		$date = date('Y-m-d h:i:s');
		$ins_sql = "INSERT INTO tbl_comment (com_name, com_email, com_subject, com_comment, com_date) VALUES ('$name', '$email', '$subject', '$comment', '$date')";
		$pre_sql = mysqli_query($conn, $ins_sql);
	}
?>
<DOCTYPE html>
<html>
	<head>
	<?php include 'includes/db.php'; ?>
	<title>MHD Ghanem Balhawan</title>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.css">
	<script src="bootstrap/js/myscript.js"></script>
	<script src="bootstrap/js/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.js"></script>

	</head>
	
	<body>

	
	<?php include 'functions/functions.php'; ?>
		<div id="main">
		<?php include 'includes/navigation.php'; ?>


		<div id="myacc_wrap">
		
			<section class="col-lg-12">
				<div class="panel panel-info">
				<div class="panel panel-heading">
						<h3>Contact Us</h3>
				</div>
				<form class="form-horizontal" action="contact.php" method="post" role="form">
					<div class="form-group">
						<label for="name" class="col-sm-3 control-label">Name *</label>
						<div class="col-lg-7">
							<input type="text" class="form-control" name="name" placeholder="Name" id="name" required>
						</div>
						</div><!--form-group-->
					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">Email Address *</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="email" placeholder="Email" id="email" required>
						</div>
					</div><!--form-group-->
					<div class="form-group">
						<label for="subject" class="col-sm-3 control-label">Subject *</label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="subject" placeholder="Subject" id="subject" required>
						</div>
					</div><!--form-group-->
					<div class="form-group">
						<label for="comment" class="col-sm-3 control-label">Comment</label>
						<div class="col-sm-7">
							<textarea class="form-control" rows="10" name="comment" style="resize:none;"></textarea>
						</div>
					</div><!--form-group-->
					<div class="form-group">
						<label class="col-sm-3 control-label"></label>
						<div class="col-sm-7">
							<input type="submit" value="Submit Your Comment" class="btn btn-block btn-danger" name="submit_comment" id="submit_comment">
						</div>
					</div><!--form-group-->
				</div><!--panel-->	
				</form>	
			</section>
		
			<!--
		</article> -->

	
	</div>
	
	<!--container
	<div style="margin:50px;width:50px;height:50px;"></div>-->
	<div><?php include 'includes/footer.php'; ?></div>
	</body>
</html>