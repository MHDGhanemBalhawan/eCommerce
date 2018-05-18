<!DOCTYPE html>
<?php
	SESSION_START();
	include_once 'functions/functions.php';
	include_once 'includes/db.php';
?>
<html>
<head>
	
	<title></title>
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
		<!-- inner sidebar
            <div class="col-xs-6 col-sm-2 sidebar-offcanvas" id="sidebarLeft" role="navigation">

			    <div class="well sidebar-nav">
                    <ul class="nav">
							 <div id="sidebar_title">Caterogies</div>
						<ul id="cats">
							<?php /*
							getCats();
							?>
							</ul>
					<div id="sidebar_title">Brands</div>
						<ul id="cats">
							<?php
							getBrands(); */
							?>
						</ul>
                    </ul>
                </div>
                <!--/.well -->
          <!--  </div>  inner sidebar-->
            <!--/span-->

            <div class="col-xs-12 col-sm-8">
<!-- 
                <div class="jumbotron">
                    <h1>Hello, world!</h1>
                    <p>This is an example to show the potential of responsive two sidebars layout pattern in Bootstrap. Try some responsive-range viewport sizes to see it in action.</p>
                </div>-->

                <div class="row">
				<?php cart(); 
		?>
			<div id="edit_item" align="center" style="overflow-x:auto;">
				<form action="" method="post" enctype="multipart/form-data">
					<table class="table responsive-table stripped" id="tbl_edit_item" align="center" width="100%" bgcolor="skyblue">
						<thead align="center" bgcolor="#ADD8E6">
							<th id='tblhead' colspan="1">Remove</th>
							<th id='tblhead' colspan="2">Product(s)</th>
							<th id='tblhead'>Quantity</th>
							<th id='tblhead'>Total Price</th>
						</thead>
						<?php
						$total = 0;
						$values = 0;
						global $conn;
						$ip = getIp();
						$edit_id = $_GET['edit_pro'];
						$sel_price = "SELECT cart_pro_id, cart_ip_add, cart_qty FROM tbl_cart WHERE cart_ip_add ='$ip' AND cart_pro_id='$edit_id'";
						$pre_price = mysqli_query($conn,$sel_price);
						while($pro_price = mysqli_fetch_array($pre_price)){
							$pro_id = $pro_price['cart_pro_id'];
							$qty = $pro_price['cart_qty'];
							$pro_price = "SELECT * FROM tbl_product WHERE product_id = '$pro_id'";
							$pre_pro_price = mysqli_query($conn,$pro_price);
							while($p_pro_price = mysqli_fetch_array($pre_pro_price)){
								$product_price = array($p_pro_price['product_price']);
								$product_title = $p_pro_price['product_title'];
								$product_image = $p_pro_price['product_image'];
								$single_price = $p_pro_price['product_price'];
								$total = $single_price * $qty;
						?>
						<tr align="center">
							<td colspan="1"><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"/></td>
							<td colspan="2"><?php echo $product_title; ?></br>
							<img src="admin_area/product_images/<?php echo $product_image; ?>" alt="product image" width="60px" height="60px" />
							</td>
							<td><input id="qty" type="number" name="qty" size="2" onkeypress="return isNumberKey(event)" value="<?php echo $qty; ?>"></td>
							<?php
							if(isset($_POST['update_cart'])){
								$qty = $_POST['qty'];
								$update_qty = "UPDATE tbl_cart SET cart_qty = '$qty' WHERE cart_pro_id='$pro_id'";
								$pre_qty = mysqli_query($conn, $update_qty);
								echo "<script>window.open('cart.php','_self')</script>";
							}
							?>
							<td><?php echo "£". $single_price; ?></td>
						</tr>
						<?php }} ?>
						<tr align="right">
							<th colspan="3" align="right"></th>
							<th colspan="1" align="right">Sub Total: </th>
							<th colspan="1" align="left"><?php echo "£". $total; ?></th>
						</tr>
						<tr align="center">
							<th colspan="3"><input type="submit" name="update_cart" class="button" value="Update Cart"/></th>
							<th colspan="1"><input type="submit" class="button" name="continue" value="Continue Shopping"/></th>
							<th><input type="submit"  class="button" name="checkout" value="Checkout"/></th>
						</tr>
					</table>
				</form>
				<?php
				function updateCart(){	
					global $conn;
					$ip = getIp();
						if(isset($_POST['update_cart'])){
							foreach($_POST['remove'] as $remove_id){
								$delete_product = "DELETE FROM tbl_cart WHERE cart_pro_id='$remove_id' AND cart_ip_add='$ip'";
								$pre_delete = mysqli_query($conn,$delete_product);
								if($pre_delete){
								echo "<script>window.open('cart.php','_self')</script>";
								}
							}
						} 
				}
				if(isset($_POST['continue'])){
					echo "<script>window.open('index.php','_self')</script>";
				}
				if(isset($_POST['checkout'])){
				echo "<script>window.open('checkout.php','_self')</script>";
				}
					echo @$up_cart = updateCart();	
				?>
			</div>
				
				
                </div>
                <!--/row-->
				</div>
            <!--/span-->
<div><?php include_once 'includes/rightsidebar.php'; ?></div>
<!--
            <div class="col-xs-6 col-sm-2 sidebar-offcanvas" id="sidebarRight" role="navigation">
	
                <div class="well sidebar-nav">
                    <ul class="nav">
							 <div id="sidebar_title">Caterogies</div>
						<ul id="cats">
							
							</ul>
					<div id="sidebar_title">Brands</div>
						<ul id="cats">
						
						</ul>
                    </ul>
                </div>
                <!--/.well -->
          <!--  </div>-->
            <!--/span-->
        </div>
    </div>
    <!--/row-->
    <hr>
</div>
	<div><?php include 'includes/footer.php'; ?></div>
</body>
</html>



















