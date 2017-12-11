<!DOCTYPE HTML>
<HTML>
	<HEAD>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		
		<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
		
		<link rel="stylesheet" type="text/css" href="stylesheets/imageGallery.css" media="all">
		<link rel="stylesheet" type="text/css" href="stylesheets/menu.css" media="all">
		<!--<script src="../includes/datetimepicker_css.js"></script>-->
		<link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
	</HEAD>		 
	<BODY>
		<header>
			<div class="wrapper">
					
					<ul class="social_media_icon">
						<li><a href="https://www.facebook.com/Faith-Hair-Beauty-154122081353839/"><img src="images/fb.png" alt="Facebook"></a></li>
						<li><a href="#"><img src="images/rss.png" alt="rss"></a></li>
						<li><a href="#"><img src="images/tw.png" alt="Twitter"></a></li>
						<li><a href="#"><img src="images/g.png" alt="google+"></a></li>
					</ul>
					
				<div class="header-top"> <a href="index.php"><img src="images/logotext.png" alt="Faith Logo"/></a>
						<ul class="social_media_icon">
							<li><a href="login.php">Sign up / Join</a></li>
						</ul>
				</div>	
				
			</div>		
			<nav id="wrap-menu">
			   	<ul id="menu">
							<li><a href="index.php" accesskey="h">HOME</a></li>
				<li><a href="#">CUSTOMER</a>
					<ul>
						<li><a href="customerRegistration.php" accesskey="r">REGISTER</a></li>
						<li><a href="password.php" accesskey="p">CHANGE PASSWORD</a></li>
						<li><a href="confirmEmailCustomer.php" accesskey="f">CHANGE PROFILE</a></li>						
						<li><a href="#">APPOINTMENT</a>
							<ul>
								<li><a href="newAppointment.php" accesskey="a">BOOK</a></li>
								<li><a href="#">CHANGE</a></li>
								<li><a href="deleteCustomerAppointment.php" accesskey="c">CANCEL</a></li>
							</ul>
						</li>
					</ul>
				</li>
				<li><a href="#">STAFF</a>
					<ul>
						<li><a href="StaffRegistration.php" accesskey="s">REGISTER</a></li>
						<li><a href="password.php" accesskey="p">CHANGE PASSWORD</a></li>
						<li><a href="staffChangeCustomer.php" accesskey="u">CUSTOMER PROFILE</a></li>
						<li><a href="#">APPOINTMENT</a>
							<ul>
								<li><a href="verificationUser.php" accesskey="b">BOOK</a></li>
								<li><a href="staffChangeCustomer.php">CHANGE</a></li>
								<li><a href="deleteCustomerAppointment.php">CANCEL</a></li>
							</ul>
						</li>
					</ul>
				</li>	
				<li><a href="treatments.php" accesskey="t">TREATMENTS</a></li>
				<li><a href="imageGallery.php" accesskey="g">IMAGE GALLERY</a></li>
				<li><a href="reports.php" accesskey="o">REPORTS</a></li>		
				<li><a href="findUs.php" accesskey="n">FIND US</a></li>
				<li><a href="contactUs1.php">CONTACT US</a></li>
				<li><?php
						if ((isset($_SESSION['first_name'])) && (!strpos($_SERVER['PHP_SELF'], 'logout.php')) ) 
						{
							echo '<a href="logout.php">LOGOUT</a>';
						} 
						else 
						{
							echo '<a href="login.php">LOGIN</a>';
						}
						?>
					</li>
				</ul>
			</nav>
				
			</header>	
	<section id="maincontent">