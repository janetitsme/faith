
<?php
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");

	$page_title = 'Profile Change- Faith Customer';
	include ("../includes/layouts/header.php");

	/*if (!isset($_SESSION['customer'])) 
	{
		redirect_to("index.php");
	}	*/
/*Customer Edit own profile redirects to this page*/
	
	$fname			= $_POST['cust_FName'];
	$mname			= $_POST['cust_MName'];
	$lname 			= $_POST['cust_LName'];
	$Email			= $_POST['cust_Email'];
	$address1 		= $_POST['cust_Address1'];
	$address2 		= $_POST['cust_Address2'];
	$town 			= $_POST['cust_Town'];
	$postcode 		= $_POST['cust_Postcode'];
	$homephone 		= $_POST['cust_Homephone'];
	$mobilephone 	= $_POST['cust_Mobilephone'];	
	

	$page_title = 'Profile edited! |  Faith';
	 echo  $fname .'<p> You Profile updated</p>';
	 echo '<p>First Name	-' . $fname . '</p>';
	 echo '<p>Middle Name	-' . $mname . '</p>';
	 echo '<p>Last Name 	-' . $lname . '</p>';
	 echo '<p>Email			-' . $Email . '</p>';
	 echo '<p>Address Line1	-' . $address1 . '</p>';
	 echo '<p>Address Line2	-' . $address2 . '</p>';
	 echo '<p>Town/City		-' . $town . '</p>';
	 echo '<p>Postcode		-' . $postcode . '</p>';
	 echo '<p>Home Phone No.-' . $homephone . '</p>';
	 echo '<p>Mobile No.	-' . $mobilephone . '</p>';
	
	$query = "UPDATE faith_customer SET cust_FName='" . $fname . "',cust_MName='" . $mname . "', cust_LName ='" . $lname . "',cust_Email ='" . $Email . "', cust_Address1 = '" . $address1 . "', cust_Address2 = '" . $address2 . "', cust_Town = '" . $town . "', cust_Postcode = '" . $postcode . "', cust_Homephone = '" . $homephone . "', cust_Mobilephone = '" . $mobilephone . "' WHERE cust_Email = '" . $Email ."';";
	
	$results = @mysqli_query($connection, $query);
	$num_rows = mysqli_affected_rows($connection);

	if ($results) {
		if($num_rows > 0) 
		{
			echo '<p>customer information for ' . $lname . ' has been updated</p>';
			$_SESSION['message'] = 'edited';
			
		} 
		else 
		{
			echo '<p>Customer information for ' . $lname . ' could not be updated</p>';
			echo '<p>' . mysqli_error($connection) . '</p>';
		}
	} 
	else 
	{
		echo '<p>There was an error with the database</p>';
		echo '<p>' . mysqli_error($connection) . '</p>';
	}

	mysqli_close($connection);
?>


<?php
	include ("../includes/layouts/footer.php");
?>