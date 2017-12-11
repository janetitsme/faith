<?php
	require_once ("../includes/session.php");
	require_once ("../includes/db_connection.php");
	require_once ("../includes/functions.php");

	
	$page_title = 'Salon image gallery';
	include ("../includes/layouts/header.php");?>

<div class="gallery">
  <a target="_blank" href="images/vert1.jpg">
    <img src="images/vert1.jpg" alt="Long Hair style" width="300" height="200">
  </a>
  <div class="descri">Back view of the Long Hair style - Party </div>
</div>

<div class="gallery">
  <a target="_blank" href="images/vert2.jpg">
    <img src="images/vert2.jpg" alt="Long Hair Style front view" width="600" height="400">
  </a>
  <div class="descri">Front view of the Long party hair style</div>
</div>

<div class="gallery">
  <a target="_blank" href="images/vert3.jpg">
    <img src="images/vert3.jpg" alt="Curly Hair Bun" width="600" height="400">
  </a>
  <div class="descri">Neat curly hair bun for long hair</div>
</div>

<div class="gallery">
  <a target="_blank" href="images/vert4.jpg">
    <img src="images/vert4.jpg" alt="elegant curly hair with puff" width="600" height="400">
  </a>
  <div class="descri">Elegant curly hair with puff with beautiful tiara - Medium length hair suitable Wedding or party</div>
</div>	

<div class="gallery">
  <a target="_blank" href="images/vert5.jpg">
    <img src="images/vert5.jpg" alt="elegant curly hair with puff" width="600" height="400">
  </a>
  <div class="descri">An Elegant large donut bun with curls in the middle - Long hair suitable Wedding or party</div>
</div>	

<div class="gallery">
  <a target="_blank" href="images/vert6.jpg">
    <img src="images/vert6.jpg" alt="elegant straight hair puff with curled hair bun" width="600" height="400">
  </a>
  <div class="descri">Elegant straight hair puff with beautiful curly bun.</div>
</div>	
<div class="gallery">
  <a target="_blank" href="images/vert7.jpg">
    <img src="images/vert7.jpg" alt="curly hair piece bun" width="600" height="400">
  </a>
  <div class="descri">clean finished hair with side fringe and a beautiful bun with flowery curls- perfect for party or wedding<div>
</div>	
<?php
mysqli_close($connection);
		
include ("../includes/layouts/footer.php");
?>