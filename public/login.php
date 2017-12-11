<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	require_once ('check_login.php');
	require_once('../includes/db_connection.php');

	if($_POST["staff"]=="0")
	{ 
	
		list($test, $data) = check_customer_login($connection, $_POST['email'], $_POST['pass'], $_POST['staff']);
		if ($test) {
			session_start();
			$_SESSION['customer_Id'] = $data['customer_Id'];
			$_SESSION['first_name'] = $data['cust_FName'];
			$_SESSION['email'] 	= $data['cust_Email'];
			$_SESSION['customer'] 		= true;
			header("Location: http://mudfoot.doc.stu.mmu.ac.uk/students/dsouzaj/faith/public/loggedin.php");
			
			exit(); 
		} else { 
			$errors = $data;
		}
	}
	
	if($_POST["staff"]=="1")
	{
		list($test, $data) = check_staff_login($connection, $_POST['email'], $_POST['pass'], $_POST['staff']);
		if ($test) {
			session_start();
			$_SESSION['staff_Id'] 	= $data['staff_Id'];
			$_SESSION['first_name'] = $data['staff_FName'];
			$_SESSION['email'] 		= $data['staff_Email'];
			$_SESSION['staff'] 		= true;
			header("Location: http://mudfoot.doc.stu.mmu.ac.uk/students/dsouzaj/faith/public/loggedin.php");
			
			exit(); 
		} else { 
			$errors = $data;
		}
	}
mysqli_close($connection); 
}
include('login_page.php');
?>