<?php
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");

	$page_title = 'Edit Customer Profile';
	include ("../includes/layouts/header.php");

	if (!isset($_SESSION['staff'])) {
	redirect_to("index.php");
	}
	
	$email = htmlspecialchars($_GET['email']);
	//$post = htmlspecialchars($_GET['postcode']);
	
	// check that email field is filled in
 if ($email == '')
 {
	// generate error message
	$error = 'ERROR: Please fill in email !';
 }
 
	$query = 'SELECT * FROM faith_customer WHERE cust_Email = "' . $email .'";';
	$results=@mysqli_query($connection,$query);
	$num_rows = mysqli_num_rows($results);
	
	//echo '<p>Num Rows: ' . $num_rows . '</p>';	
	//echo "Query: ". $query;
?>

<div id="main">
<?php	
	if ($results) {
		if ($num_rows > 0) {
				while ($row = mysqli_fetch_array($results, MYSQLI_ASSOC)) 
				{ ?>					
					<form name="update" method="POST" action="updateCustomer.php">
						<?php $email=$row['cust_Email']; ?>
						<table cellspacing="30" style="margin-left:100">
							<input type="hidden" 	name="customerId" 	value="<?php echo $row['customerId'] ?>" />

							<tr><td align="right"><p class="label">First Name:</td><td>
		 					<input type="text" 		name="cust_FName" 		value="<?php echo $row['cust_FName'] ?>" /></p></td></tr>

							<tr><td align="right"><p class="label">Mid Name:</td><td>
		 					<input type="text" 		name="cust_MName" 		value="<?php echo $row['cust_MName'] ?>" /></p></td></tr>
							
		 					<tr><td align="right"><p class="label">Last Name:</td><td>
							<input type="text" 		name="cust_LName" 		value="<?php echo $row['cust_LName']?>" /></p></td></tr>
							
							<tr><td align="right"><p class="label">Email address:</td><td>
							<input type="email" 	name="cust_Email" 		value="<?php echo $row['cust_Email']?>" /></p></td></tr>

							<tr><td align="right"><p class="label">Address line 1:</td><td>
							<input type="text" 		name="cust_Address1"		value="<?php echo $row['cust_Address1']?>" /></p></td></tr>

							<tr><td align="right"><p class="label">Address line 2:</td><td>
							<input type="text" 		name="cust_Address2"		value="<?php echo $row['cust_Address2']?>" /></p></td></tr>

							<tr><td align="right"><p class="label">Town / City:</td><td>
							<input type="text" 		name="cust_Town" 		value="<?php echo $row['cust_Town']?>" /></p></td></tr>

							<tr><td align="right"><p class="label">Postcode:</td><td>
							<input type="text" 		name="cust_Postcode" 	value="<?php echo $row['cust_Postcode']?>" /></p></td></tr>

							<tr><td align="right"><p class="label">Home number:</td><td>
							<input type="text" 		name="cust_Homephone" 	value="<?php echo $row['cust_Homephone']?>" /></p></td></tr>

							<tr><td align="right"><p class="label">Mobile number:</td><td>
							<input type="text" 		name="cust_Mobilephone" 	value="<?php echo $row['cust_Mobilephone']?>" /></p></td></tr>
	
							
							<tr><td align="right">Confirm changes:</td><td><p><input type="submit" value="Save"></p></td></tr>
						</table>
					</form>
		<?php	}

			} else {
				echo '<p class="error">This customer does not exist.</p>';
				//echo '<p>' . mysqli_error($connection) . '</p>';
			}
		} else {
			echo '<h3 class="error">System Error</h3>
			<p class="error">customer information could not be retrieved.</p>';
			//echo '<p>' . mysqli_error($connection) . '</p>';
		}
	mysqli_free_result($results);
	mysqli_close($connection);
?>
</div> <!--ends main-->
<?php
	include ("../includes/layouts/footer.php");
?>