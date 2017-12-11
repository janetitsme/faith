<?php
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");
		
	$page_title = 'View Appointment';
	include ("../includes/layouts/header.php");
	/*if (!isset($_SESSION['customer'])) {
		redirect_to("index.php");
	}*/

    
 /*   if (isset($_GET["date"])){

        $currentDate = $_GET["date"];
    }
 
*/
?>


<table id="table" >
<tr>
	
<?php

$query_appointment = 'SELECT appointment_date, appointment_startTime,
appointment_endTime, staff_FName, treatment_Name FROM faith_customer c 
JOIN faith_appointment a on c.customer_Id=a.customer_Id 
JOIN faith_treatment ft ON ft.treatment_Id=a.treatment_Id 
JOIN  faith_staff s ON s.staff_Id =a.staff_Id  JOIN faith_staffskills sk 
ON sk.treatment_Id=ft.treatment_Id where appointment_date>=CURDATE() ORDER BY appointment_date, s.staff_Id';

	$results1 = @mysqli_query($connection, $query_appointment);
 	$numrows=mysqli_num_rows($results1);
	echo '<table><tr><b><td colspan=2> </td><td> Appointment Date </b></td><td colspan=3>Appointment Time</td><td> </td><td colspan=2></td><td>Staff </td><td colspan=3></td><td> </td><td>Treatment</b></td></tr></table>';
		if($results1)
		{
			if($numrows>0)
			{
				while($row=mysqli_fetch_array($results1,MYSQLI_ASSOC))
				{
					echo '<table><tr><td colspan=2>'.$row['appointment_date'].'</td><td colspan=2>  </td><td> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.substr($row['appointment_startTime'],1,4).'</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row['staff_FName'] .'</td><td>&nbsp;&nbsp;&nbsp;'.$row['treatment_Name'].'</td></tr></table>';
				}
			}
			else
			{
				echo '<p class="error"> There are no treatments available</p>';
			}
		}
		else
		{
			echo '<h3 class="error"> System Error</h3>
			<p class="error">User data could not be retrieved.</p>';
		}
		
		
?></p>		
<form name="viewAppointment.php" method="Post">

</form>
<?php
	mysqli_close($connection);
	include ("../includes/layouts/footer.php");
?>