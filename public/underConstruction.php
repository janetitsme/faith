<?php
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");

	
	$page_title = 'Sorry under construction';
	include ("../includes/layouts/header.php");?>

<h1>Sorry this page is under construction</h1>

<?php
mysqli_close($connection);
		
include ("../includes/layouts/footer.php");
?>