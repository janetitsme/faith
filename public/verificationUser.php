<?php
//session_start();
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");
		
	$page_title = 'Verify User already has an account -Satff Booking  Appointment';
	include ("../includes/layouts/header.php");
	/*if (!isset($_SESSION['staff'])) {
		redirect_to("index.php");
	}*/
	
	
?>
<form name="verificationUser.php" method="POST">

<p>Please enter Customer Email :

<input type="email" placeholder="Enter your email" name="email" tabindex=1></p>
<input type="submit" value="Verify the Customer" name="submit" tabindex=2>
</form>


<?php
if(isset($_POST['submit']))
{
	if(isset($_POST['email']) && !empty($_POST['email']))
	{
		$email=mysql_escape_string($_POST['email']);
		echo $email;
		$query_user = "SELECT customer_Id, cust_FName FROM faith_customer where cust_Email='" .$email."'";
		$query_user;
		$results = @mysqli_query($connection, $query_user);
		$numrows=mysqli_num_rows($results);
		
		if($results)
		{
			if($numrows>0)
			{
				$_SESSION['email']=$email;
				print_r($_SESSEION);
				echo "Hello print something";
				// email  exit re direct to Staff Booking newAppointment page  
				header("Location:StaffBooksnewAppointment.php");
			}
			else
			{
				// email does not exit re direct to regristration page  
				$msg='Customer need an account to book appointment';
				echo $msg;				
				header("Location:customerRegistration.php");
				
			}
		}
		else
		{ 
			echo "no email found";
		}
	}
	else
	{ 
		echo "Please enter customers email Address";
	}
}
?>
<?php
	mysqli_close($connection);
	include ("../includes/layouts/footer.php");
?>