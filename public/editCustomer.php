<?php
/* 
  Allows user to edit specific entry in database
*/

 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($id, $firstname, $lastname, $error)
 {
 ?>

 <html>
 <head>
 <title>Edit Record</title>
 </head>
 <body>
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 
 
 <form action="" method="post">
 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
 <div>
 <p><strong>ID:</strong> <?php echo $id; ?></p>
 <strong>First Name: *</strong> <input type="text" name="first_name" value="<?php echo $firstname; ?>"/><br/>
 <strong>Last Name: *</strong> <input type="text" name="last_name" value="<?php echo $lastname; ?>"/><br/>
 <p>* Required</p>
 <input type="submit" name="submit" value="Submit">
 </div>
 </form> 
 </body>
 </html> 
 <?php
 }



 // connect to the database
 require_once('../includes/db_connection.php');
 
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['id']))
 {
 // get form data, making sure it is valid
 $id = $_POST['id'];
 $firstname = mysql_real_escape_string(htmlspecialchars($_POST['first_name']));
 $lastname = mysql_real_escape_string(htmlspecialchars($_POST['last_name']));
 
 // check that firstname/lastname fields are both filled in
 if ($firstname == '' || $lastname == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 //error, display form
 renderForm($id, $firstname, $lastname, $error);
 }
 else
 {
 // save the data to the database
 mysql_query("UPDATE faith_customer SET cust_FName='$firstname', cust_MName=$midname, cust_LName='$lastname' WHERE customer_Id='$id'")
 or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 //header("Location: view.php"); 
 }
 }
 else
 {
 // if the 'id' isn't valid, display an error
 echo 'Error!';
 }
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 
 // get the 'id' value from the URL (if it exists), making sure that it is valid (checking that it is numeric/larger than 0)
 if (isset($_GET['first_name']) && isset($_GET['last_name']))
 // query db
 $id = $_GET['id'];
 echo $id;
 $result = mysql_query("SELECT cust_FName, cust_MName, cust_LName, cust_DOB, cust_Email, cust_Address1, cust_Address2, cust_Town, cust_Postcode, cust_Homephone, cust_Mobilephone, cust_Personal_Info FROM faith_customer WHERE customer_Id=$id")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 //echo result;
 // check that the 'id' matches up with a row in the database
	 if($row)
	 {
	 
		// get data from db
		 $firstname = $row['first_name'];
		 $lastname = $row['last_name'];
		 
		 // show form
		 renderForm($id, $firstname, $lastname, '');
	 }
	 else
		 // if no match, display result
	 {
		 echo "No results!";
	 }
 }
  
?>