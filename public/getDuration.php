<div id="staff_name"><b>Staff Names will be listed here...</b></div>
 <?php
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");
			
$q = intval($_GET['q']);

$sql="SELECT treatment_Duration FROM faith_treatment where faith_treatment.treatment_Id = ".$q.";";
		
$resultTreatment = mysqli_query($connection,$sql);
$numrows1=mysqli_num_rows($resultTreatment);

?>
<form>
   
  <?php
if($resultTreatment)
{	
  if($numrows1>=0)
  {
	while($row = mysqli_fetch_array($resultTreatment,MYSQLI_ASSOC)) {
	echo  "<p>" . SUBSTR($row['treatment_Duration'],1,5) . "</p>";
		
	}
  }
  
  else
  {
	  echo "Sorry this treatment duration and cost not found";
  }
}  
	?>
</select>
</form>
	
