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

 <script>
  $( function() {
    $( "#datepicker" ).datepicker({
    	beforeShowDay: function(date){
        var day = date.getDay();
        if (day == 1 || day == 2) {
          return [false];
        }
        else {
          return [true];
        }
      }
    ,
    minDate:0
  });
  });
  
  //Call to php
  function showHint(str) {
    if (str.length == 0) {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "data.php?q=" + str, true);
        xmlhttp.send();
    }
}

  </script>

<table id="table" >
<tr>
	
<?php

$query_staff='SELECT DISTINCT(staff_FName) FROM faith_staff ORDER BY staff_FName';
$results = @mysqli_query($connection, $query_staff);
if (!$connection || mysqli_num_rows($connection) == 0)
 	$numrows=mysqli_num_rows($results);
   
	
		if($results)
		{
			if($numrows>0)
			{
				//echo '<p>There are '.$numrows . ' appointments booked;</p>';
				echo '<table>';
				echo '<tr>';
				while($row=mysqli_fetch_array($results,MYSQLI_ASSOC))
				{
					echo '<th><b>'.$row['staff_FName'].'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>';
					
				}
				echo '</tr>';
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


		
	//
$query_appointment = 'SELECT appointment_date,appointment_startTime ,appointment_endTime,cust_FName, cust_LName, staff_FName, treatment_Name
FROM faith_customer c JOIN faith_appointment a on c.customer_Id=a.customer_Id JOIN faith_treatment ft ON
ft.treatment_Id=a.treatment_Id JOIN  faith_staff s ON s.staff_Id =a.staff_Id  JOIN faith_staffskills sk 
on sk.treatment_Id=ft.treatment_Id ORDER BY appointment_date';

	$results1 = @mysqli_query($connection, $query_appointment);
 	$numrows=mysqli_num_rows($results1);
	
		if($results1)
		{
			if($numrows>0)
			{
				
				echo '<tr>>';
				
				while($row=mysqli_fetch_array($results1,MYSQLI_ASSOC))
				{
					echo '<td><br>'.substr($row['appointment_startTime'],1,5).'<br>'.$row['cust_FName'] .'<br>'.$row['treatment_Name'].'</td>';
				}
				echo '</tr>';
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
<p>Please enter the appointment Date </p>
Date: <input readonly type="text" value="choose date" tabindex=1 name="datepicker" id="datepicker">
<input type="hidden" size="1" readonly onkeyup="showHint(this.value)">
<p><span id="txtHint"></span></p>
</form>
<?php
	mysqli_close($connection);
	include ("../includes/layouts/footer.php");
?>