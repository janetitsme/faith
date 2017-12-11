<?php
	$page_title = 'Restricted Page';
	include ("../includes/layouts/header.php");
?>
<h1>Oops...you're not logged in.</h1>
<p>This is a restricted page available to registered users only.</p>
<p>Existing user? <a href="login.php">Login.</a></p>
<p>New user? <a href="customerRegistration.php">Register now.</a></p>
<?php
	include ("../includes/layouts/footer.php");
?>
