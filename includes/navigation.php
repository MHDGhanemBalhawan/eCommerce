		<!--Header -->
	<header id="header" class="headroom">
		<div id="bannerdiv">
			<a href="index.php"><img alt="banner" id="banner" src="images/banner.gif"></a>
		</div>

    <div class="navbar navbar- navbar-inverse fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <p class="pull-left visible-xs">
                    <button id="offcanvasleft" class="btn btn-xs btn-info" type="button" data-toggle="offcanvasleft"><i class="glyphicon glyphicon-chevron-left"></i></button>
                </p>
                <p class="pull-right visible-xs">
                    <button id="offcanvasright" class="btn btn-xs btn-info" type="button" data-toggle="offcanvasright"><i class="glyphicon glyphicon-chevron-right"></i></button>
                </p>
				
			 <!-- Second navbar for search -->
   
        <!-- Brand and toggle get grouped for better mobile display -->
       
	   <div class="navbar-header">
		
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-3">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
		
        <div class="collapse navbar-collapse" id="navbar-collapse-3">
          <ul class="nav navbar-nav navbar-right">
			<li id="Home"><a href="index.php">Home</a></li>
			<li id="Products"><a href="all_products.php">Products</a></li>
			<li id="MyAccount"><a href="my_account.php">My Account</a></li>
			<li id="SignIn"><a href="customer_register.php">Sign Up</a></li>
			<li id="ShoppingCart"><a href="cart.php">Shopping Cart</a></li>
			<li id="ContactUs"><a href="contact.php">Contact Us</a></li>
            <li>
              <a class="btn btn-default btn-outline btn-circle collapsed"  data-toggle="collapse" href="#nav-collapse3" aria-expanded="false" aria-controls="nav-collapse3">Search</a>
            </li>
          </ul>
          <div class="collapse nav navbar-nav nav-collapse slide-down" id="nav-collapse3">
            <form class="navbar-form navbar-right" role="search" method="get" action="search.php" enctype="multipart/form-data">
              <div class="form-group">
                <input type="text" class="form-control" placeholder="Search" name="user_query">
              </div>
              <button type="submit" class="btn btn-danger" name="search"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
            </form>
          </div>	
        </div><!-- /.navbar-collapse -->
         </div>
            <!-- /.nav-collapse -->
			


			
	<span id="shopping_cart" class="pull-right">
							<?php
								if(isset($_SESSION['customer_email'])){
									echo "<b>Welcome </b>" . $_SESSION['customer_email'] ."<b style='color:yellow;'>Your</b> ";
									
								} else {
								echo "<b>Welcome Guest!</b>";
								}
							?>
							<b style="color:yellow">Cart:</b> Items: <?php total_items(); ?>-Price:£<?php total_price(); ?><a href="cart.php" style="color:yellow;">Go to Cart</a>
							<?php
								if(!isset($_SESSION['customer_email'])){
								echo "<a href='checkout.php' style='color:orange;'>Login</a>";
								} else{
								echo "<a href='logout.php' style='color:orange;'>Logout</a>";
								}
							?>
	</span>
	</div>
	</div>
     <!-- /.container -->	

    <!-- /.navbar -->
	</header>