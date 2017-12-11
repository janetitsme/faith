<?php
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");

	$page_title = 'Faith Hair & Beauty on google map';
	include ("../includes/layouts/header.php");
	?>
    
		<link rel="stylesheet" href="stylesheets/findusStyle.css">
		
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAncba9sa6Jvzy0Iyv1HxeemCxyLN6wD6k&sensor=false"></script>
		
		<script src="../includes/mapScript.js"></script>
		<div id="main">
		<p align="left">
			<fieldset>
				<h1>Faith Hair & Beauty</h1>
				<p>116 Oxford Street<br/>
					Werneth<br/>
					Oldham - OL9 7SJ<br/>
					Email : info@faith.co.uk<br/>
					Ph: (0161) 624 9700<br/>
					Opening Days: Wednesday, Thursday, Friday, Saturday and sunday.<br/>
					Opening Time: 11a.m. to 6p.m.</p>
			</fieldset>	
			
	
		<!--<section id="mapBackground">	this section will include background image-->
			<div id="mapArea"></div>	<!--used to identify the map in javascript-->
		<!--</section> -->
		
		<!--Google maps API
		<script src="https://maps.googleapis.com/maps/api/js"></script>
		<!--Service Management
		<script src="scripts/mapScriptWithMarkers.js"></script>-->
		
		
		</div>
    
	 <!-- ends main -->
	
 <?php
 	include ("../includes/layouts/footer.php");
 ?>