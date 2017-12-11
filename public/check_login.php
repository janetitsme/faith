<?php 
function check_customer_login($connection, $emailin = '', $passin = '', $staff="0") {
	
	$errors = array(); 
	if (empty($emailin)) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$email = mysqli_real_escape_string($connection, trim($emailin));
	}
	if (empty($passin)) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$pass = mysqli_real_escape_string($connection, trim($passin));		
	}
	
	if (empty($errors)&& ($staff=="0"))
	{ 
		$query = "SELECT * FROM faith_customer WHERE 
		cust_Email='$email' AND cust_Password=SHA1('$pass')";		
		$results = @mysqli_query ($connection, $query);
	
		if (mysqli_num_rows($results) == 1) {
			$row = mysqli_fetch_array ($results, MYSQLI_ASSOC);
			return array(true, $row);
		} else { 
			$errors[] = 'The entered email address and password are incorrect.';
		}
	}	
return array(false, $errors);
} 

function check_staff_login($connection, $emailin = '', $passin = '', $staff="1") {
	$errors = array(); 
	if (empty($emailin)) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$email = mysqli_real_escape_string($connection, trim($emailin));
	}
	if (empty($passin)) {
		$errors[] = 'You forgot to enter your password.';
	} else {
		$pass = mysqli_real_escape_string($connection, trim($passin));	
	}
	
	if(empty($errors)&& ($staff=="1"))
	{ 
		$query = "SELECT * FROM faith_staff WHERE 
		staff_Email='$email' AND staff_Password=SHA1('$pass')";		
		$results = @mysqli_query ($connection, $query);
		if (mysqli_num_rows($results) == 1) 
		{
			$row = mysqli_fetch_array ($results, MYSQLI_ASSOC);
			return array(true, $row);
		} 
		else 
		{ 
			$errors[] = 'The entered email address and password are incorrect.';
		}
	}
return array(false, $errors);	
} 

?>
