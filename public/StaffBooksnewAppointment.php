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
<form name="StaffBooksnewAppointment.php" method="Post">
<p>Booking appointment for :</p>
<?php 
	echo $_SESSION["email"];
	
	?>
<p>Please enter the appointment Date and Time here >>: </p>
Date: <input readonly type="text" value="choose date" tabindex=1 name="datepicker" id="datepicker">
Time: <input readonly type="text" value="choose time" tabindex=2 name="timepicker" id="timepicker">
<p>Choose Treatment <input type="hidden" size="1" tabindex=2  readonly onkeyup="showHint(this.value)">
<p><span id="txtHint"></span></p>
<p>Which treatment you are interested in?</p>
<select id="treatment" tabindex=3 onchange="javascript:showStaff(this.value);showDuration(this.value)";>
	
	<?php
	
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
				//$duration=$row['treatment_duration'];
				?>
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
			<p class="error">treatment data could not be retrieved.</p>';
		}
if(isset($_POST['submit']))
{
	$email1=$_SESSION['email'];
	echo $email;
	$queryUser = mysql_query("SELECT * FROM faith_customer WHERE cust_Email='".$email."'");
	$resultsUser = @mysqli_query($connection, $queryUser);
 	$numrows=mysqli_num_rows($resultsUser);
    if($resultsUser)
		{
			if($numrows>0)
			{
			echo "Email already exists";
			while($row=mysqli_fetch_array($resultsUser,MYSQLI_ASSOC))
						{
							$customer=$row['customer_Id'];
							echo  "Customer Name" . $row['cust_FName']. " " . $row['cust_MName']. " " . $row['cust_LName'];
						}
			}
	}
		else
		{
			echo '<h3 class="error"> System Error</h3>
			<p class="error">User data could not be retrieved.</p>';
		}
	//
	$datepicker=mysqli_real_escape_string($connection,$_REQUEST['datepicker']);
		$datepicker=strtotime($datepicker);
		$datepicker= date('Y-m-d',$datepicker);
	$timepicker=mysqli_real_escape_string($connection,$_REQUEST['timepicker']);
		$date = date_create($timepicker);
		$timepicker = date_format($date, 'H:i');
	
	$currentdate=date("Y-m-d");
	$date_to_compare = date("Y-m-d",time()+86400); //1 day later
if (strtotime($datepicker) < strtotime($currentdate)) 
	{
		echo "Please choose valid date you cannot book appointments on past dates";
	}
	else
	{
	
	$time =(strtotime($timepicker) + strtotime($duration)) - strtotime('00:00:00');
		$timepicked = date('H:i', $time);
		
		echo "Time Picked + duration: " . $timepicked;
		echo "checking the finishing time of appointment : ". date('H:i',$time);
	if (date('H:i',$time) > 18) 
	{
		echo 'Salon closes at 6PM. Please choose some other day or time';  
	}
 		
	else
	{		
		// Now insert all the data into the appointments table
		$query2 = "INSERT INTO faith_appointment (customer_Id, treatment_Id, appointment_Date, appointment_startTime,appointment_endTime, staff_Id)
					VALUES (".$customer.",". $treatID .",'". $datepicker ."','". $timepicker ."','". $timepicked ."',". $staffID .")";
		echo $query2;
		//
		$custResult=mysqli_query($connection,$query2);
		if ($custResult) 
		{
			echo '<p>' . $_SESSION['email'] . ' successfully inserted into the database</p>';
			
			$_SESSION['message'] = 'Appointment created';
			
		}
		else
		{
			$_SESSION['message'] = 'Appointment not created';
		}	
	
	}	
		}	
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
  <div id="staff_name"></div>
  <div id="treatmentTime"></div>

<?php

	
	
	
?>
 <p><p><p><input type="submit" name="submit" value="Add Appointment" /></p></p></p>
</form>


<?php
	mysqli_close($connection);
	include ("../includes/layouts/footer.php");
?>