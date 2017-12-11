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
  //Reference w3schools.com using AJAX in PHP
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
<form name="newAppointment.php" method="Post">
<p>Please enter the appointment Date and Time here >>: </p>
Date: <input readonly type="text" value="choose date" tabindex=1 name="datepicker" id="datepicker">
Time: <input readonly type="text" value="choose time" tabindex=2 name="timepicker" id="timepicker">
<p>Choose Treatment <input type="hidden" size="1" readonly onkeyup="showHint(this.value)">
<p><span id="txtHint"></span></p>
<p>Which treatment you are interested in?</p>
<select id="treatment" tabindex=3 onchange="javascript:showStaff(this.value);showDuration(this.value)";>
	<?php
/*	if(!(isset($_POST['datepicker']) &&(isset($_POST['timepicker']) && (isset($_POST['treatment']) ))
	{
		echo "Please fill all the information in boxes";
	}*/
?>
	<?php 
	//
	$query_treatment = 'SELECT treatment_Id, treatment_Name FROM faith_treatment ORDER BY treatment_Name';
	$results = @mysqli_query($connection, $query_treatment);
 	$numrows=mysqli_num_rows($results);
    
	$treatID=0;
	$selected_value=0;
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
		
		
?></p>		
</select>
 
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

//get duration
function showDuration(str)
{
	
	
	if(str==null)
	{
		document.getElementById("treatmentTime").innerHTML="";
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
				document.getElementById("treatmentTime").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET", "getDuration.php?q=" + str, true);
		xmlhttp.send();
		
	}
}
</script>

  <br>
  <div id="staff_name"><b>Staff Names will be listed here...</b></div>
  <div id="treatmentTime"><b>Treatment time will be listed here...</b></div>

<?php

	
	
	//get treatment_Id
	$queryTreatment2='SELECT treatment_Id, treatment_Duration from faith_treatment where treatment_Id='.$treatID;
	$Treatmentresults = @mysqli_query($connection, $queryTreatment2);
 	$numrows1=mysqli_num_rows($Treatmentresults);
		
    echo 'Total Treatments Available: '.$numrows1;
	$duration=0;
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
		echo $_SESSION['staff_Id'];
		$staffID=$_SESSION['staff_Id'];	
		
		//Escape user inputs for security
		//$datepicker=mysqli_real_escape_string(htmlspecialchars($_POST['datepicker'])); 
		$datepicker=mysqli_real_escape_string($connection, $_POST['datepicker']);
		$currentdate=date("Y-m-d");
		$date_to_compare = date("Y-m-d",time()+86400); //1 day later
		if (strtotime($datepicker) < strtotime($currentdate)) 
		{
			echo "Please choose valid date you cannot book appointments on past dates";
		}
		else
		{
	

		$datepicker=strtotime($datepicker);
		$datepicker= date('Y-m-d',$datepicker);
		
		
		$timepicker=mysqli_real_escape_string($connection,$_POST['timepicker']);
		
		$date = date_create($timepicker);
		$timepicker = date_format($date, 'H:i');
	
		echo $timepicker;
		echo $datepicker;
		
		$time =(strtotime($timepicker) + strtotime($duration)) - strtotime('00:00:00');
		$timepicked = date('H:i', $time);
		
		echo "Time Picked + duration: " . $timepicked;
		
		
		//check if the same appointment existing in the database
		$query_appointment= "SELECT * from faith_appointment where customer_Id=".$customer. 
		" AND treatment_Id=".$treatment . " AND staff_Id=".$staffID . " AND appointment_date='".$datepicker.
		"' AND appointment_startTime='".$timepicker."' ORDER BY appointment_date desc";
		
		echo $query_appointment;
		$resultsAp=@mysqli_query($connection,$query_appointment);
		$numrows2 = mysqli_num_rows($resultsAp);
		if($resultsAp)
		{
			if($numrows2)
			{
				while ($row = mysqli_fetch_array($resultsAp, MYSQLI_ASSOC)) 
				{
					if((($row['customer_Id'])==$customer) && (($row['treatment_Id'])==$treatID)&&
				  (($row['appointment_date'])==$datepicker)&& (($row['appointment_startTime'])==$timepicker)&& 
				  (($row['staff_Id'])==$staffID))
				  {			
					echo '<p class="error">This appointment already exist.</p>';
				  }
				  else
				  {
					echo $row['customer_Id'] . "-->".$customer;
					echo $row['treatment_Id']. "-->".$treatID;
					echo $row['appointment_date']. "-->".$datepicker;
					echo $row['appointment_startTime']. "-->".$timepicker;
					echo $row['staff_Id']. "-->".$staffID;
					  $query3 = "INSERT INTO faith_appointment (customer_Id, treatment_Id, appointment_Date, appointment_startTime,appointment_endTime, staff_Id)
						VALUES (".$customer.",". $treatID .",'". $datepicker ."','". $timepicker ."','". $timepicked ."',". $staffID .")";
						echo $query3;
				  
						//
						if (mysqli_query($connection, $query3)) 
						{
							echo '<p>' . $_SESSION['first_name'] . ' successfully inserted into the database</p>';											
						} 
						else 
						{
							echo 'Error occurred: ' . mysqli_error($connection);
						}	
					}	
				}
			}
			else
			{
				echo 'No appointments found';
			}
			
		}	
		else 
			{
			echo '<h3 class="error">System Error</h3>
			<p class="error">Appointment information could not be retrieved.</p>';
			//echo '<p>' . mysqli_error($connection) . '</p>';
		}
		}
		
	/*if (date('H:i',$time) > 18) 
	{
		echo 'Salon closes at 6PM. Please choose some other day or time';  
	}
 		
	*/	
		
/*	 // Now insert all the data into the appointments table
		$query2 = "INSERT INTO faith_appointment (customer_Id, treatment_Id, appointment_Date, appointment_startTime,appointment_endTime, staff_Id)
					VALUES (".$customer.",". $treatID .",'". $datepicker ."','". $timepicker ."','". $timepicked ."',". $staffID .")";
		echo $query2;
		//
		if (mysqli_query($connection, $query2)) {
			echo '<p>' . $_SESSION['first_name'] . ' successfully inserted into the database</p>';
			
			$_SESSION['message'] = 'added';
			
		} else {
			echo 'Error occurred: ' . mysqli_error($connection);
		}	*/
	
		
		
?>
 <p><p><p><input type="submit" name="submit" value="Add Appointment" /></p></p></p>
</form>


<?php
	mysqli_close($connection);
	include ("../includes/layouts/footer.php");
?>