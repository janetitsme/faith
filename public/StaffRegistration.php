<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
$page_title='Staff Registration';
include('../includes/layouts/header.php');

if($_SERVER["REQUEST_METHOD"]=="POST")
{
	require_once('../includes/db_connection.php');
	$errors=array();
	if(empty($_POST['first_name']))
	{
		$errors[]='You forgot to enter your first name. ';
	}
	else
	{	
		$staff_FName=mysqli_real_escape_string($connection,trim($_POST['first_name']));
	}
	if(empty($_POST['mid_name']))
	{
		$staff_MNAame='NULL';
	}
	else
	{	
		$staff_MName=mysqli_real_escape_string($connection,trim($_POST['mid_name']));
	}
	
	if(empty($_POST['last_name']))
	{
		$errors[]='You forgot to enter your last name. ';
	}
	else
	{	
		$staff_LName=mysqli_real_escape_string($connection,trim($_POST['last_name']));
	}	
	
	if(empty($_POST['job_role']))
	{
		$errors[]='You forgot to enter Job Role. ';
	}
	else
	{	
		$staff_JobRole=mysqli_real_escape_string($connection,trim($_POST['job_role']));
	}	
	
	$staff_Homephone=mysqli_real_escape_string($connection,trim($_POST['homephone']));
	
	if(empty($_POST['mobilephone']))
	{
		$errors[]='You forgot to enter your Mobile phone number. ';
	}
	else
	{	
		$staff_Mobilephone=mysqli_real_escape_string($connection,trim($_POST['mobilephone']));
	}	
	

	if(empty($_POST['email']))
	{
		$errors[]='You forgot to enter your email address. ';
	}
	else
	{	
		$staff_Email=mysqli_real_escape_string($connection,trim($_POST['email']));
	}
	if(!empty($_POST['pass1']))
	{
		if($_POST['pass1'] != $_POST['pass2'])
		{
		$errors[]='Your passwords did not match. ';
		}
		else 
		{	
			$staff_Password=mysqli_real_escape_string($connection,trim($_POST['pass1']));
		}
	}
	else
	{
		$errors[]='You forgot to enter your password.';
	}	
	if(empty($errors))
	{
		$query="INSERT INTO faith_staff(staff_FName, staff_MName, staff_LName, staff_JobRole, 
				staff_Homephone,staff_Mobilephone,staff_Email,staff_Password) VALUES
				('$staff_FName', '$staff_MName','$staff_LName','$staff_JobRole',
				'$staff_Homephone','$staff_Mobilephone','$staff_Email',SHA1('$staff_Password'))";
		$results=@mysqli_query($connection,$query);
		//echo $query;
		echo '<p class="error">' . mysqli_error($connection) . '</p>';

		if($results)
		{
			echo '<h3>Thank you!</h3> <p>You have successfully registered.</p>';	
		} 
		else
		{ 			
			echo '<h3 class="error">System Error</h3>
			<p class="error">Registration failed because of a system error:</p>'; 
		} 
	mysqli_close($connection);
	
	include ('../includes/layouts/footer.php'); 
	exit();
} 
else 
{ 
	echo '<h3 class="error">Error</h3><p class="error">The following error(s) occurred:</p>';
		foreach ($errors as $message)
		{ 
			echo "<p class='error'>$message</p>";
		}
	echo '<p>Please try again.</p>';
} 
mysqli_close($connection);
} 

?>

<h1 >Staff Registration</h1>
<p align="left">
<form action="StaffRegistration.php" method="post">

<fieldset>
<legend>Staff Registration</legend>
<p>
	First Name: <input type="text" name="first_name" size="20" 
	maxlength="20" value="<?php if(isset($_POST['first_name'])) 
	echo $_POST['first_name']; ?>" />
	Middle Name: <input type="text" name="mid_name" size="20" 
	maxlength="25" value="<?php if(isset($_POST['mid_name'])) 
	echo $_POST['mid_name']; ?>" />
	Last Name: <input type="text"  name="last_name" size="30" 
	maxlength="30" value="<?php if (isset($_POST['last_name'])) 
	echo $_POST['last_name']; ?>" />
	<br><br>Job Role: <input type="text" align="right" name="job_role" size="25" 
	maxlength="25" value="<?php if (isset($_POST['job_role'])) 
	echo $_POST['job_role']; ?>" />
	<br><br>Home Telephone: <input type="text"  name="homephone" size="11" 
	maxlength="11" value="<?php if (isset($_POST['homephone'])) 
	echo $_POST['homephone']; ?>" />
	Mobile Phone: <input type="text"  name="mobilephone" size="11" 
	maxlength="11" value="<?php if (isset($_POST['mobilephone'])) 
	echo $_POST['mobilephone']; ?>" />
	<br><br>Email Address: <input type="text" name="email" size="50" 
	maxlength="50" value="<?php if (isset($_POST['email'])) 
	echo $_POST['email']; ?>"  /> 
	<br><br>Password: <input type="password" name="pass1" size="50" 
	maxlength="50" />
	<br><br>Confirm Password: <input type="password"  name="pass2" 
	size="50" maxlength="50" />
	<br><br><input type="submit" name="submit" value="Register" /></p>
</fieldset>	

</form>

<?php  include ("../includes/layouts/footer.php");?>