<?php
define("DB_SERVER", "127.0.0.1");
define("DB_USER", "root");
define("DB_PASS", "a1b2c3d4f5");
define("DB_NAME", "dsouzaj");

	// 1. Create a database connection
$connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
	// Test if connection occured
if (mysqli_connect_errno()) {
	die("Database connection failed: " .
		mysqli_connection_error() .
		" (" . mysqli_connection_errno() . ")"
		);
}
?>
