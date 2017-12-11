<div id="staff_name"></div>
 <?php
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");
			
$q = intval($_GET['q']);

$sql="SELECT faith_staff.staff_Id, staff_FName FROM faith_staff JOIN faith_staffskills on
		faith_staff.staff_Id=faith_staffskills.staff_Id JOIN faith_treatment on
		faith_treatment.treatment_Id=faith_staffskills.treatment_Id where
		faith_treatment.treatment_Id = ".$q.";";
		
$resultStaff = mysqli_query($connection,$sql);
$numrows1=mysqli_num_rows($resultStaff);
    echo 'Total Staffs who can do the selected treatment is/are : '.$numrows1;
?>
<form>
  <select name="staff_name">
  
  <?php
  if(numrows1>=0)
  {
	  
	while($row = mysqli_fetch_array($resultStaff,MYSQLI_ASSOC)) {
		$_SESSION['staff_Id']=$row['staff_Id'];
		echo  "<option value=" . $row['staff_Id'] . ">" . $row['staff_FName'] . "</option>";
		
	}
  }
  
  else
  {
	  echo "Sorry no staff available to do the treatment";
  }
	?>
</select>
</form>
	
