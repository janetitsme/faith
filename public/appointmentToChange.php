<?php
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");

	// Get the customer appointment details from the POST request
	$id = $_POST['customer_Id'];
	$tid=$_POST['treatment_Id'];
	$sid=$_POST['staff_Id'];
	$aptDate=$_POST['appointment_date'];
	$aptTime=$_POST['appointment_startTime'];
	
	$page_title = $id . ' | Faith Hair & Beauty';
	include ("../includes/layouts/header.php");

	$query = "DELETE FROM faith_appointment WHERE customer_Id = " . $id . " AND treatment_Id=" .$tid . 
	" AND appointment_date='".$aptDate. "' AND appointment_startTime='" . $aptTime."'";
	$results = @mysqli_query($connection, $query);
	$num_rows = mysqli_affected_rows($connection);
	//echo $query;
	if ($results) {
		if ($num_rows == 1) {
			echo 'Customer Id ' . $id . ' has been removed from the database';
			$_SESSION['message'] = "deleted";
			$_SESSION['id'] = $id;
			header ("location: newAppointment.php");
		} else {
			echo '<p>The appointment was not deleted</p>';
			echo '<p>' . mysqli_error($connection) . '</p>';
		}
	} else {
		echo 'There was a database error';
		echo '<p>' . mysqli_error($connection) . '</p>';
	}
?>


<?php
	include ("../includes/layouts/footer.php");
?>