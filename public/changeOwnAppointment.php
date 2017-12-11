<?php
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");

	$page_title = 'Cancel Appointment | Faith Hair & Beauty';
	include ("../includes/layouts/header.php");

	
?>

<h3 align=center>Change Appointments</h3>

<?php 
	
$query = "SELECT fc.customer_Id, ft.treatment_Id, cust_FName, cust_LName, treatment_Name,
appointment_date,appointment_startTime,appointment_endTime,staff_FName, fs.staff_Id FROM 
faith_staffskills fsk JOIN faith_staff fs ON fsk.staff_Id=fs.staff_Id JOIN
faith_treatment ft ON fsk.treatment_Id=ft.treatment_Id JOIN 
faith_appointment fa ON fa.treatment_Id=ft.treatment_Id JOIN
faith_customer fc ON fc.customer_Id=fa.customer_Id";
	
	$results = @mysqli_query($connection, $query);
	$num_rows = mysqli_num_rows($results);
	
	if ($results) {
		if ($num_rows > 0) {

			// If there are results, they are displayed in a table
			echo '<table border="2">
			<tr><th><b>Customer Name</b></th><th>treatment Booked</th><th>Appointment Booked Date</th><th>Appointment Booked Time</th><th>Appointment Finish Time</th><th>Appoint Booked with staff</th><th>Delete Appointment</th></tr>';

			while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
				echo '<tr><td>' .$row['cust_FName']. '</td><td>' . $row['treatment_Name']. '    </td><td align="right">      ' . $row['appointment_date'] . '</td><td align="right">' . $row['appointment_startTime'] . '</td><td align="right">' . $row['appointment_endTime'] . '</td><td>
				<form action="appointmentToChange.php" method="POST">
				
					<input type="hidden" name="customer_Id" value=' . $row['customer_Id'] . '>
					<input type="hidden" name="treatment_Id" value=' . $row['treatment_Id'] . '>
					<input type="hidden" name="staff_Id" value=' . $row['staff_Id'] . '>
					<input type="hidden" name="appointment_date" value=' . $row['appointment_date'] . '>
					<input type="hidden" name="appointment_startTime" value=' . $row['appointment_startTime'] . '>
					
					<input type="submit" value="Change Appointment"></form></td></tr>';
					
			}
			
			echo '</table>';

		} else {
			// If the system was able to query the database but returned no results, we end up here
			echo '<p class="error">There are no appointments to cancel.</p>';
		}
	} else {
		// If there was a a problem with the database query itself, we end up here.
		echo '<h3 class="error">System Error</h3>
		<p class="error">Customer data could not be retrieved.</p>';
		//DEBUGGING
		 echo '<p class="error">'.mysqli_error($connection).'</p>';
		//DEBUGGING
		 echo '<p class="error">Query:'. $query . '</p>';
	}
	
	

	// Clean up variables and close the connection
	mysqli_free_result($results);
	//mysqli_free_result($results1);
	mysqli_close($connection);
?>


<?php
	include ("../includes/layouts/footer.php");
?>