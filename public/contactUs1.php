<link rel="stylesheet" type="text/css" href="stylesheets/style.css" media="all">			
<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
$page_title='Faith - Contact us';
include('../includes/layouts/header.php');?>
<form name="contactform" method="post" action="sendEmail.php">
<fieldset>
<legend>Contact us</legend>
<table width="550px">
<tr>
 <td valign="top">
  <label for="first_name">First Name *</label>
 </td>
 <td valign="top">
  <input  type="text" name="first_name" maxlength="50" size="30">
 </td>
</tr>
<tr>
 <td valign="top"">
  <label for="last_name">Last Name *</label>
 </td>
 <td valign="top">
  <input  type="text" name="last_name" maxlength="50" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="email">Email Address *</label>
 </td>
 <td valign="top">
  <input  type="text" name="email" maxlength="80" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="telephone">Telephone Number</label>
 </td>
 <td valign="top">
  <input  type="text" name="telephone" maxlength="30" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="comments">Comments *</label>
 </td>
 <td valign="top">
  <textarea  name="comments" maxlength="1000" cols="50" rows="10"></textarea>
 </td>
</tr>
<tr>
 <td colspan="2" style="text-align:center">
  <input type="submit" id="Submit" value="Submit"> 
 </td>
</tr>
</table>
</fieldset>
</form>
<?php
	
	include ("../includes/layouts/footer.php");
?>