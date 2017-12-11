<?php
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");
		
	$page_title = 'Appointment Reports';
	include ("../includes/layouts/header.php");
?>

 <link rel="stylesheet" type="text/css" href="stylesheets/style.css" media="all">			
<?php 
	
/*if (isset($_SESSION['staff'])) { //only displays page if logged in as staff member*/
	
	$query = "SELECT DISTINCT staff_FName FROM faith_staff ORDER BY staff_LName ASC"; //gets all staff
	$results = @mysqli_query($connection, $query);
	$num_rows = mysqli_num_rows($results);
?>	
<div id ="main">
	<form action="staffAppointmentQuery.php" method="POST">
						
<p>


<?php //1st report
	echo "List all staff at ";
	if($results) {
		if($num_rows > 0) { ?>
			<select name="name" selected="<?php echo $option['staff_FName']?>">
				<option>Select Staff name</option>
				<?php while($option = mysqli_fetch_array($results, MYSQLI_ASSOC)) { ?>
					<option><?php echo $option['staff_FName']; ?></option>
			<?php } ?>
			</select> <?php
		}
	}
?>	
<input type="submit" value="Submit"></form>
<br/><br/>


<!-- 2nd Report -->
<form action="AllStaffAppointments.php" method="POST">
<p>
<?php
	echo "List all Appointments";
?>	

<input type="submit" value="Submit"></form>
<br/><br/>


<!-- 3rd Report -->
<form action="totalMonthlyAppointments.php" method="POST">
<p>
<?php 
echo "List of customer orders with a total value of"
?>	<select name="month">
		<option value="January">January</option>
		<option value="February">February</option>
		<option value="March">March</option>
		<option value="April">April</option>
		<option value="May">May</option>
		<option value="June">June</option>
		<option value="July'">July<option>
		<option value="August">August</option>
		<option value="September">September</option>
		<option value="October">October</option>
		<option value="November">November</option>
		<option value="December">December</option>
	<select>
<input type="submit" value="Submit"></form>

</div> <!-- end of main div -->

<?php	
/*} 
else {
	redirect_to("index.php"); //redirects to index.php if not logged in as staff
}*/

	mysqli_free_result($results);
	mysqli_close($connection);

	include ("../includes/layouts/footer.php");
?>