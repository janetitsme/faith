<link rel="stylesheet" type="text/css" href="stylesheets/style.css" media="all">			
		
<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
$page_title='Customer Registration';
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
		$cust_FName=mysqli_real_escape_string($connection,trim($_POST['first_name']));
	}
	
	$cust_MName=mysqli_real_escape_string($connection,trim($_POST['mid_name']));
	
	if(empty($_POST['last_name']))
	{
		$errors[]='You forgot to enter your last name. ';
	}
	else
	{	
		$cust_LName=mysqli_real_escape_string($connection,trim($_POST['last_name']));
	}	
	
	$cust_DOB=mysqli_real_escape_string($connection,trim($_POST['dob']));
	
	if(empty($_POST['email']))
	{
		$errors[]='You forgot to enter your email address. ';
	}
	else
	{	
		$cust_Email=mysqli_real_escape_string($connection,trim($_POST['email']));
	}
	
	if(empty($_POST['address1']))
	{
		$errors[]='You forgot to enter first line of your address. ';
	}
	else
	{	
		$cust_Address1=mysqli_real_escape_string($connection,trim($_POST['address1']));
	}	
	
	$cust_Address2=mysqli_real_escape_string($connection,trim($_POST['address2']));
		
	if(empty($_POST['town']))
	{
		$errors[]='You forgot to enter your Town. ';
	}
	else
	{	
		$cust_Town=mysqli_real_escape_string($connection,trim($_POST['town']));
	}	
	if(empty($_POST['postcode']))
	{
		$errors[]='You forgot to enter your PostCode. ';
	}
	else
	{	
		$cust_Postcode=mysqli_real_escape_string($connection,trim($_POST['postcode']));
	}	
	
	$cust_Homephone=mysqli_real_escape_string($connection,trim($_POST['homephone']));
	
	if(empty($_POST['mobilephone']))
	{
		$errors[]='You forgot to enter your Mobile phone number. ';
	}
	else
	{	
		$cust_Mobilephone=mysqli_real_escape_string($connection,trim($_POST['mobilephone']));
	}	
	
	$cust_Personal_Info=mysqli_real_escape_string($connection,trim($_POST['personalinfo']));

	
	if(!empty($_POST['pass1']))
	{
		if($_POST['pass1'] != $_POST['pass2'])
		{
		$errors[]='Your passwords did not match. ';
		}
		else 
		{	
			$cust_Password=mysqli_real_escape_string($connection,trim($_POST['pass1']));
		}
	}
	else
	{
		$errors[]='You forgot to enter your password.';
	}	
	if(empty($errors))
	{
		$query="INSERT INTO faith_customer(cust_FName, cust_MName, cust_LName, cust_DOB, 
				cust_Email,cust_Address1,cust_Address2, cust_Town, cust_Postcode, 
				cust_Homephone,cust_Mobilephone, cust_Personal_Info,cust_Password) VALUES
				('$cust_FName', '$cust_MName','$cust_LName',STR_TO_DATE('$cust_DOB','%Y-%m-%d'),'$cust_Email',
				'$cust_Address1','$cust_Address2','$cust_Town','$cust_Postcode',
				'$cust_Homephone','$cust_Mobilephone','$cust_Personal_Info',SHA1('$cust_Password'))";
		$results=@mysqli_query($connection,$query);
		//echo $query;
		echo '<p class="error">' . mysqli_error($connection) . '</p>';

		if($results)
		{
			echo '<h3>Thank you!</h3> <p>You have successfully registered.</p>';
			
			/*	include('email.php');
				$to=$cust_Email;
				$subject="Email Verification";
				$body='Hi, <br/> Welcome to Faith Hair & Beauty website.  You are sucessfully registered. <br/>This is a verification email<br/>';
				sendEmail($to,$subject,$body);
				$msg="Well done! Registration successful :)";
				echo $msg;*/
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


<h1 >Customer Registration</h1>
<form action="customerRegistration.php" method="post">
<fieldset>
<legend>Customer Registration</legend>
	First Name: <input type="text" name="first_name" pattern="[A-Za-z]{1,20}" title="Type the spelling of your first name"
	 size="20" maxlength="20" required value="<?php if(isset($_POST['first_name'])) 
	echo $_POST['first_name']; ?>" />
	Middle Name: <input type="text" name="mid_name" pattern="[A-Za-z]{0,20}" title="Type the spelling of your middle name" size="20" 
	maxlength="20" value="<?php if(isset($_POST['mid_name'])) 
	echo $_POST['mid_name']; ?>" />
	Last Name: <input type="text"  name="last_name" pattern="[A-Za-z]{1,30}" title="Type the spelling of your last name" size="30" 
	maxlength="30" required value="<?php if (isset($_POST['last_name'])) 
	echo $_POST['last_name']; ?>" />

	<br><br>Date of Birth(YYYY-MM-DD): <input type="date" name="dob" placeholder="YYYY-MM-DD" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" 
	title="Enter a date in this formart YYYY-MM-DD"
	value="<?php if (isset($_POST['dob'])) 
	echo $_POST['dob']; ?>" />
	Email Address: <input type="text" name="email" size="50" 
	maxlength="50" value="<?php if (isset($_POST['email'])) 
	echo $_POST['email']; ?>"  /> 
	
	<legend>Customer Address</legend>
	Address Line 1: <input type="text" align="right" name="address1" size="50" 
	maxlength="50" value="<?php if (isset($_POST['address1'])) 
	echo $_POST['address1']; ?>" />
	Address Line 2: <input type="text" name="address2" size="50" 
	maxlength="50" value="<?php if (isset($_POST['address2'])) 
	echo $_POST['address2']; ?>" />
	<br/><br/>City / Town: <input type="text" name="town" size="15" 
	maxlength="15" value="<?php if (isset($_POST['town'])) 
	echo $_POST['town']; ?>" />
	PostCode: <input type="text" name="postcode" size="15" required pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}"
	maxlength="15" value="<?php if (isset($_POST['postcode'])) 
	echo $_POST['postcode']; ?>" />
	
	<legend>Contact telephone numbers & comments</legend>
	Do not leave gap in the middle of the phone numbers<br/>
	<br/>Home Phone: <input type="text"  name="homephone" size="11" placeholder=""
	required pattern="^\s*\(?(020[7,8]{1}\)?[ ]?[1-9]{1}[0-9{2}[ ]?[0-9]{4})|(0[1-8]{1}[0-9]{3}\)?[ ]?[1-9]{1}[0-9]{2}[ ]?[0-9]{3}\s*$"
	maxlength="11" value="<?php if (isset($_POST['homephone'])) 
	echo $_POST['homephone']; ?>" />
	Mobile Phone: <input type="text"  name="mobilephone" size="11" 
	maxlength="11" value="<?php if (isset($_POST['mobilephone'])) 
	echo $_POST['mobilephone']; ?>" />
	<br/>Personal Information: <br><input type="text" name="personalinfo" size="50" 
	maxlength="50" value="<?php if (isset($_POST['personalinfo'])) 
	echo $_POST['personalinfo']; ?>" />

<legend>Customer Password</legend>
	Password: <input type="password" name="pass1" size="50" 
	maxlength="50" />
	Confirm Password: <input type="password"  name="pass2" 
	size="50" maxlength="50" />
	<br/><input type="submit" name="submit" value="Register" /></p>
	</fieldset>
</form>

<?php
	
	include ("../includes/layouts/footer.php");
?>

