<?php
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");

	$page_title = 'Change Password | Faith Hair & Beauty';

	include ("../includes/layouts/header.php");
echo "test";

// If the user opens this page without being logged in, they are redirected to the login page
//echo $_SESSION['customer_Id'];
if ((!isset($_SESSION['customer'])) || (!isset($_SESSION['staff']))) {
	redirect_to("login_page.php");
}

// Check that the information is coming in through POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Array to store any errors to be displayed later
	$errors = array();

	// User has to enter their current password in order to change it
	if (empty($_POST['pass'])) {
		$errors[] = 'You forgot to enter your current password.';
	} else {
		$pass = mysqli_real_escape_string($connection, trim($_POST['pass']));
	}

	// The new password is entered twice and checked to ensure they match
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your new passwords did not match.';
		} else {
			$newpass = mysqli_real_escape_string($connection, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your new password.';
	}

	// If there are no errors (the form has all the data) go ahead and process it
	if (empty($errors)) {

		// The form can handle changing either the customer or staff passwords
		// First get their current password from the database so it can be checked with the one entered in the form
		// Checking the ID against the ID in the SESSION because to change their password, the user must be logged in and can only change their own password
		if ($_SESSION['staff']) {
			$query1 = "SELECT staff_Password FROM faith_staff WHERE staff_Id = {$_SESSION['staff_Id']}";
		} else {
			$query1 = "SELECT cust_Password FROM faith_customer WHERE customer_Id = {$_SESSION['customer_Id']}";
		}
		$results1 = @mysqli_query($connection, $query1);
		$row = mysqli_fetch_array($results1, MYSQLI_ASSOC);
		if ($_SESSION['staff']) {
			$current_password = $row['staff_Password'];
		} else {
			$current_password = $row['cust_Password'];
		}

		// If the user entered their current password correctly, go ahead and update it with the new one
		if (SHA1($_POST['pass']) == $current_password) {

			if ($_SESSION['staff']) {
				$query2 = "UPDATE faith_staff SET staff_Password = SHA1('$newpass') WHERE staff_Id = {$_SESSION['staff_Id']}";
				echo $query2;
				// Get the staff ID from the SESSION
				$staff_Id = (int)$_SESSION['staff_Id'];

				// Create the query using prepared statement.
				$query2 = mysqli_prepare($connection, "UPDATE faith_staff SET staff_Password = SHA1('$newpass') WHERE staff_Id = ?");
				if ($query2 === false) { trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($connection)), E_USER_ERROR); }

				$bind2 = mysqli_stmt_bind_param($query2, "i", $staff_Id);
				if ($bind2 === false) { trigger_error('Bind parameters failed! ' . E_USER_ERROR); }

				$exec2 = mysqli_stmt_execute($query2);
				if ($exec2 === false) {
					trigger_error('Statement execution failed! ' . htmlspecialchars(mysqli_error($query)), E_USER_ERROR);
				} else {
					echo '<h3>Thank you!</h3>
					<p>Your password has been changed.</p>';
				}

			} else {
				$query2 = "UPDATE faith_customer SET cust_Password = SHA1('$newpass') WHERE customer_Id = {$_SESSION['customer_Id']}";
				echo $query2;
				// Get the staff ID from the SESSION
				// Get the customer ID from the SESSION
				$customer_Id = (int)$_SESSION['customer_Id'];

				// Create the query using prepared statement.
				$query2 = mysqli_prepare($connection, "UPDATE faith_customer SET cust_Password = SHA1('$newpass') WHERE customer_Id = ?");
				if ($query2 === false) { trigger_error('Statement failed! ' . htmlspecialchars(mysqli_error($connection)), E_USER_ERROR); }

				$bind2 = mysqli_stmt_bind_param($query2, "i", $customer_Id);
				if ($bind2 === false) { trigger_error('Bind parameters failed! ' . E_USER_ERROR); }

				$exec2 = mysqli_stmt_execute($query2);
				if ($exec2 === false) {
					trigger_error('Statement execution failed! ' . htmlspecialchars(mysqli_error($query)), E_USER_ERROR);
				} else {
					echo '<h3>Thank you!</h3>
					<p>Your password has been changed.</p>';
				}
			}
		} else {
			// End up here if the user's current password is not entered correctly
			echo '<p class="error">Your old password is not correct</p>';
			// DEBUGGING <P class="error">mysqli_error($connection) . '</p>
			// DEBUGGING <P class="error">Query: ' . $query . '</p>';
		}
		include ("../includes/layouts/footer.php");
		exit();
	} else {
		echo '<h3>Error</h3>
			<p class="error">The following error(s) occurred:</p>';
		foreach ($errors as $message) {
			echo "<p class='error'>$message</p>";
		}
		echo '<p>Please try again.</p>';
	}
	
	mysqli_close($connection);

}
?>

<h3>Change Your Password </h3>
<form action="password.php" method="post">
<p align="center">	
	<fieldset>
	<legend>Change your Password</legend>
		<table class="no_border>"
			<tr><td><p>Current Password:</td><td><input type="password" name="pass" size="40" maxlength="40" required/> </p></td></tr>
			<tr><td><p>New Password:</td><td><input type="password" name="pass1" size="40" maxlength="40" required/> </p></td></tr>
			<tr><td><p>Confirm New Password:</td><td><input type="password" name="pass2" size="40" maxlength="40" required/> </p></td></tr>
			<tr><td colspan="2"><center><p><input type="submit" name="submit" value="Change Password" /> </p><center></td></tr>
		</table>
	</fieldset>	
</p>	
</form>
<?php
include ("../includes/layouts/footer.php");
?>
