<?php
	function redirect_to($new_location) {
	  header("Location: " . $new_location);
	  exit;
	}

	function staff_member() {
		return isset($_SESSION['staff']);
	}
	
	/*function checkAppointment($customer, $treatment, $staff,$appointmentDt,$appointmentTime)
	{
	require_once ("../includes/db_connection.php");
	$query_appointment= "SELECT * from faith_appointment where customer_Id=".$customer. " AND treatment_Id=".$treatment . "AND appointment_date='".$appointmentDt."' AND appointment_startTime='".$appointmentTime."' FROM faith_appointment ORDER BY appointment_date desc";
	$results = @mysqli_query($connection, $query_appointment);
 	$numrows=mysqli_num_rows($results);
    
		while($row=mysql_fetch_array($result))
		{
			if(((!$row[$customer_Id])==$customer) && ((!$row[$treatment_Id])==$treatment)&&((!$row[$appointment_date])==$appointmentDt)&& ((!$row[$appointment_startTime])==$appointmentTime))
			{
				return "Available";
			}
			else
			{
				return "Not Available";
			}
		}
	}*/
?>