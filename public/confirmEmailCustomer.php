<?php
//session_start();
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");
		
	$page_title = 'Verify User already has an account -Satff Booking  Appointment';
	include ("../includes/layouts/header.php");
	/*if (!isset($_SESSION['customer'])) {
		redirect_to("index.php");
	}*/
	
	
?>
<form name="confirmEmailCustomer.php" method="POST">
<fieldset>
<legend>Verify your Email Address</legend>
<label> Please enter Email :</label>
<input type="email" placeholder="Enter your email here" title="yourname@email.co.uk" name="email" tabindex=1></p>
<input type="submit" value="Verify the Customer" name="submit" tabindex=2>
</fieldset>
</form>


<?php
if(isset($_POST['submit']))
{
	if(isset($_POST['email']) && !empty($_POST['email']))
	{
		$email=mysql_escape_string($_POST['email']);
		
		$query_user = "SELECT customer_Id, cust_FName FROM faith_customer where cust_Email='" .$email."'";
		$query_user;
		$results = @mysqli_query($connection, $query_user);
		$numrows=mysqli_num_rows($results);
		
		if($results)
		{
			if($numrows>0)
			{
				while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) 
				{
					if($_SESSION['first_name']==$row['cust_FName'])
					{
					$_SESSION['email']=$email;
					
					// email  exit re direct to Staff Booking newAppointment page  
					header("Location:changeOwnProfile.php");
					}
					else
					{
						echo 'You are not the authorised user of '.$email;
					}
					break;
				}
			}
			else
			{
				// email does not exit re direct to regristration page  
				$msg='Authorised Customer can only change their own profile';
				echo $msg;				
				header("Location:index.php");
				
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