<?php
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");

	
	$page_title = 'Reports';
	include ("../includes/layouts/header.php");
	function goback()
	{
		if(basename($_SERVER['PHP_SELF']) == 'index.php'){
		$GoBack = "";
		} else {
		$GoBack = htmlspecialchars($_SERVER['HTTP_REFERER']);
		}
	}
			
$name = $_POST['name'];
//display all appointments of selected staff based on todays date or higher
$query= "SELECT cust_FName, appointment_date, appointment_startTime,
appointment_endTime, staff_FName, treatment_Name FROM faith_customer c 
JOIN faith_appointment a on c.customer_Id=a.customer_Id 
JOIN faith_treatment ft ON ft.treatment_Id=a.treatment_Id 
JOIN  faith_staff s ON s.staff_Id =a.staff_Id  JOIN faith_staffskills sk 
ON sk.treatment_Id=ft.treatment_Id where appointment_date>=CURDATE() AND staff_FName='".$name."' Group by appointment_date ORDER BY appointment_date, appointment_startTime";

$results = @mysqli_query($connection, $query);
$num_rows = mysqli_num_rows($results);

if ($results) {
	if ($num_rows > 0) {
		echo '<H3>Appointments of the staff chosen</H3>'; 
		echo '<table>
		<tr> <th>  Appintment Date  </th> <th>   Appointment Time    </th> <th> <b>Customer Name    </th> <th>    Treatment Name     </th> </tr>';

		while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) {
			echo '<tr> <td>' . $row['appointment_date'] .  '</td><td align=center>' . substr($row['appointment_startTime'],0,5) .  '</td><td>' . $row['cust_FName'] .  '</td><td>'  . $row['treatment_Name'] .  '</td></tr>';
				
		}
		echo '</table>';
		echo '<br/>';
			
		mysqli_free_result($results);
	} else {
		echo '<p class="error">There are no appointments.</p>';
		header("Location:reports.php");
	}
} else {
	echo '<h3 class="error">System Error</h3>
	<p class="error">Report could not be retrieved.</p>';
}

mysqli_close($connection);
		
include ("../includes/layouts/footer.php");
?>