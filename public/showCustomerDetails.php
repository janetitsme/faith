<?php
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");

	$page_title = 'Edit Customer Profile';
	include ("../includes/layouts/header.php");
	//echo '<p>First Name: ' .$_SESSION['first_name']. '</p>';;
	//echo '<p>Email: ' .$_SESSION['email']. '</p>';

	//if (!isset($_SESSION['staff'])) {
	//redirect_to("index.php");
//}
?>

<h3>Customer Information </h3>
<?php
	$query = 'SELECT * FROM faith_customer WHERE cust_FName = "' . $_SESSION['first_name'] . '" AND cust_Email="' . $_SESSION['email'] . '";';
	$result=@mysqli_query($connection,$query);
	$num_rows = mysqli_num_rows($result);
	
	if ($result) {

		if ($num_rows > 0) {

				while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
				{
					echo'<form action="updateCustomer.php" method="post">	';
					echo '<tr><td><p><input type="hidden" name="customer_Id" value="' . $row['customer_Id'] . '"></p></td></tr>';
 					echo '<tr><td><p>First Name : <input type="text" name="cust_FName" value="' . $row['cust_FName'] . '"></p></td></tr>';
					echo '<tr><td><p>Middle Name : <input type="text" name="cust_MName" value="' . $row['cust_MName'] . '"></p></td></tr>';
					echo '<tr><td><p>Last Name : <input type="text" name="cust_LName" value="' . $row['cust_LName'] . '"></p></td></tr>';
					echo '<tr><td><p>DOB : <input type="text" name="cust_DOB" value="' . $row['cust_DOB'] . '"></p></td></tr>';
					echo '<tr><td><p>Email Id: <input type="email" name="cust_Email" value="' . $row['cust_Email'] . '"></p></td></tr>';
					echo '<tr><td><p>Address Line 1 : <textarea name="cust_address1" rows="5" cols="30">' . $row['cust_Address1'] . '</textarea></p></td></tr>';
					echo '<tr><td><p>Address Line 2 :<textarea name="cust_address2" rows="5" cols="30">' . $row['cust_Address2'] . '</textarea></p></td></tr>';
					echo '<tr><td><p>Town : <input type="text" name="cust_Town" value="' . $row['cust_Town'] . '"></p></td></tr>';
					echo '<tr><td><p>Postcode : <input type="text" name="cust_Postcode" value="' . $row['cust_Postcode'] . '"></p></td></tr>';
					echo '<tr><td><p>Home Phone Number : <input type="text" name="cust_Homephone" value="' . $row['cust_Homephone'] . '"></p></td></tr>';
					echo '<tr><td><p>Mobile Phone Number : <input type="text" name="cust_Mobilephone" value="' . $row['cust_Mobilephone'] . '"></p></td></tr>';
					echo '<tr><td><p>Personal Information Information : <input type="text" name="cust_Personal_Info" value="' . $row['cust_Personal_Info'] . '"></p></td></tr>';
					echo '<tr><td></td></tr>';
					echo '<input type="submit" value="Change Details"></form></td>';
					
					echo '</tr></table></div>';
					//
				}

		} 
		else 
		{
			echo '<p class="error">This customer does not exist.</p>';
			echo '<p>' . mysqli_error($connection) . '</p>';
		}
	} 
	else 
	{
		echo '<h3 class="error">System Error</h3>
		<p class="error">customer information could not be retrieved.</p>';
		echo '<p>' . mysqli_error($connection) . '</p>';
	}	

	mysqli_free_result($result);
	mysqli_close($connection);
?>


<?php
	include ("../includes/layouts/footer.php");
?>