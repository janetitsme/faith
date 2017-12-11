<?php
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");
		
	$page_title = 'Book Appointment';
	include ("../includes/layouts/header.php");
	/*if (!isset($_SESSION['customer'])) {
		redirect_to("index.php");
	}*/
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
    minDate:10
  });
  });
  $( function() {
    $('#timepicker').timepicker({
      timeFormat: 'H:mm',
      interval: 15,
      minTime: '11',
      maxTime: '18:00',
      startTime: '11:00',
      dynamic: false,
      dropdown: true,
      scrollbar: true
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
<form name="addAppointment.php" method="Post">
	<fieldset>
		<legend>Booking Details</legend>
		<label for="datepicker">Booking Date: </label><input readonly type="text" name="datepicker" id="datepicker">
		<label for="timepicker">Booking Time: </label><input readonly type="text" name="timepicker" id="timepicker">
		<br>
		<label for="treatment">Choose Treatment: </label> <input type="hidden" size="1" readonly onkeyup="showHint(this.value)">
		<span id="txtHint"></span>
		<select name="treatment" required id="treatment" onchange="javascript:showStaff(this.value);showDuration(this.value)";>
				
		

<script> 

function showStaff(str)
{
	if(str=="")
	{
		document.getElementById("staff_name").innerHTML="";
		return;
	}
	else
	{
		if(window.XMLHttpRequest)
		{
			xmlhttp=new XMLHttpRequest();
		}
		else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
		xmlhttp.onreadystatechange=function()
		{
			if(this.readyState==4 && this.status==200)
			{
				document.getElementById("staff_name").innerHTML=this.responseText;
			}
		}
		xmlhttp.open("GET", "getStaff.php?q=" + str, true);
		xmlhttp.send();
		
	}
}
</script>


	
	
		<?php 
	//
	$query_treatment = 'SELECT treatment_Id, treatment_duration, treatment_Name FROM faith_treatment ORDER BY treatment_Name';
	$results = @mysqli_query($connection, $query_treatment);
 	$numrows=mysqli_num_rows($results);
    echo 'Total Treatments Available: '.$numrows;
	$treatID=0;
	$selected=0;
		if($results)
		{
			if($numrows>0)
			{
				echo '<p>There are '.$numrows . ' treatments available to choose from;</p>';
				$treatment= '';
				//$duration=$row['treatment_duration'];?>
				<option disabled selected>Please select</option>
				<?php while($row=mysqli_fetch_array($results,MYSQLI_ASSOC))
				{
					$treatID=$row['treatment_Id'];
					$selected_value = ($row['treatment_Id'] == $selected_value ) ? ' selected option' : '';
					echo  "<option value=" . $row['treatment_Id']. $selected. ">" . $row['treatment_Name'] . "</option>";
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
?>
</select>
		  
		  <div id="staff_name"><b>Staff Names will be listed here...</b></div>
		  <div id="treatmentTime"><b>Treatment time will be listed here...</b></div>
  
<?php
echo "duration from selected treatment : ".$row['duration'];
	//$treatmentIds = $_SESSION['treatmentIDD'];
	//$treatment_Duration=$row['treatment_Duration'];
	$customer=$_SESSION['customer_Id'];
	$staffID=$_SESSION['staff_Id'];	
	
	//get treatment_Id
	$queryTreatment2='SELECT treatment_Id, treatment_Duration from faith_treatment where treatment_Id='.$treatID;
	$Treatmentresults = @mysqli_query($connection, $queryTreatment2);
 	$numrows1=mysqli_num_rows($Treatmentresults);
	echo $numrows1;
    echo 'Total Treatments Available: '.$numrows1;
		if($Treatmentresults)
		{
			if($numrows1>0)
			{
				echo '<p>There are '.$numrows1 . ' treatment chosen;</p>';
				while($row=mysqli_fetch_array($Treatmentresults,MYSQLI_ASSOC))
				{
					$duration=$row['treatment_Duration'];
				}
				mysqli_free_result($Treatmentresults);
				echo '<p>duration of the treatment chosen: ' .$duration .'</p>';
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
		
		$customer=$_SESSION['customer_Id'];
		$staffID=$_SESSION['staff_Id'];	
		
		//Escape user inputs for security
		$datepicker=mysqli_real_escape_string($connection,$_REQUEST['datepicker']);
		
		$currentdate=date("Y-m-d");
		$date_to_compare = date("Y-m-d",time()+86400); //1 day later
		
		$datepicker=strtotime($datepicker);
		$datepicker= date('Y-m-d',$datepicker);
		
		$timepicker=mysqli_real_escape_string($connection,$_REQUEST['timepicker']);
		
		$date = date_create($timepicker);
		$timepicker = date_format($date, 'H:i');
	
		$date = date_create($duration);
		$duration = date_format($date, 'H:i');
		
		$time =(strtotime($timepicker) + strtotime($duration)) - strtotime('00:00:00');
		$timepicked = date('H:i', $time);
		
		echo "Time Picked + duration: " . $timepicked;
	
	if ($timepicked > '18:00') //(date('H:i',$time) > 18) 
	{
		echo 'Salon closes at 6PM. Please choose some other day or time';  
	}
 		
	else
	{	
 		//check if the appointment aleady existing for that date and time for the same staff
		$query_appointment= "SELECT * from faith_appointment where customer_Id=".$customer. " AND treatment_Id=".$treatment . "AND appointment_date='".$datepicker."' AND appointment_startTime='".$timepicker."' ORDER BY appointment_date DESC";
		echo $query_appointment;
		$appointmentResults = @mysqli_query($connection, $query_appointment);
		$numrows=mysqli_num_rows($appointmentResults);
    
		while($row=mysql_fetch_array($appointmentResults))
		{
			if(((!$row[$customer_Id])==$customer) && ((!$row[$treatment_Id])==$treatment)&&
			  ((!$row[$appointment_date])==$datepicker)&& ((!$row[$appointment_startTime])==$timepicker)&& 
			  ((!$row[$staff_Id])==$staffID))
			{
					 // Now insert all the data into the appointments table
				$query2 = "INSERT INTO faith_appointment (customer_Id, treatment_Id, appointment_Date, appointment_startTime,appointment_endTime, staff_Id)
						VALUES (".$customer.",". $treatID .",'". $datepicker ."','". $timepicker ."','". $timepicked ."',". $staffID .")";
				echo $query2;
				//
				if (mysqli_query($connection, $query2)) {
				echo '<p>' . $_SESSION['first_name'] . ' successfully inserted into the database</p>';
				
				$_SESSION['message'] = 'added';
				
				} else 
				{
					echo 'Error occurred: ' . mysqli_error($connection);
				}	
			}
			else
			{
				"Appointment Not Available for this time with the staff chosen";
			}
		}
		
	 /*Now insert all the data into the appointments table
		$query2 = "INSERT INTO faith_appointment (customer_Id, treatment_Id, appointment_Date, appointment_startTime,appointment_endTime, staff_Id)
					VALUES (".$customer.",". $treatID .",'". $datepicker ."','". $timepicker ."','". $timepicked ."',". $staffID .")";
		//echo $query2;
		*/
		if (mysqli_query($connection, $query2)) 
		{
			echo '<p>' . $_SESSION['customer'] . ' successfully inserted into the database</p>';
			//echo '<p>You will now be redirected to its product page.';
			$_SESSION['message'] = 'added';
			
		} else {
			echo 'Error occurred: ' . mysqli_error($connection);
		}	
	
	}	
	
?>

<p>Do you like to confirm you your appointment?</p>
		  <label for="yesAppointment">Yes</label><input id="yesAppointment" type="radio" name="appointment" value="yesAppointment">
		  <label for="noAppointment">No</label><input id="noAppointment" type="radio" name="appointment" value="NoAppointment">
		  <br>
	  
		<input id="submit" type="submit" name="submit" value="Add Appointment" />
	 </fieldset>
</form>

<?php
	mysqli_close($connection);
	include ("../includes/layouts/footer.php");
?>