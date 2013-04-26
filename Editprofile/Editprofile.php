<?php
 session_start();
$memId =$_SESSION['userId'];
$_SESSION['memid'] =$memId;
include("../xajax.inc.php");
include("processEdit.php");




include("../dbinfo.inc.php");
$query = "select * from member where Member_Id ='$memId'";
$result = mysql_query($query);
$num = mysql_numrows($result);
if($num != 0)
	{
	$first = mysql_result($result,0,"F_Name");
	 $last = mysql_result($result,0,"L_Name");
	 $address = mysql_result($result,0,'Address');
	 $Email = mysql_result($result,0,"Email");
	 $Date = mysql_result($result,0,"DOB");
	 $Country = mysql_result($result,0,"Country");
	 $Password = mysql_result($result,0,"Password");
	}///if
//for memprofile
	$query = "select * from memprofile where Mem_Id ='$memId'";
$result = mysql_query($query);
$num = mysql_numrows($result);
if($num != 0)
	{
	$sex = mysql_result($result,0,"Sex");
	
	 $status = mysql_result($result,0,"status");
	 $interest = mysql_result($result,0,'Interests');
	
	}///if
	
	mysql_close();


$xajax = new xajax();
$xajax->registerFunction("processForm");
$xajax->processRequests();



?>
<HTML>
<HEAD><link rel="Stylesheet" href="../icons/spgm_style.css" />
<link rel = "stylesheet" href = "../css/style.css">
<TITLE>Member</TITLE>

<?php $xajax->printJavascript('../');
?>


<script src="date.js">
		</script>





<script type="text/javascript">
<!---
		function submitSignup()
		{
			xajax.$('submitButton').disabled=true;
			xajax.$('submitButton').value="please wait...";
			xajax_processForm(xajax.getFormValues("register"));
			return false;
		}
		-->
		</script>
		<script src="date.js">
		</script>
</HEAD>

<BODY >

<div id="formwrapper">
<div id="title"class="RegisterTitle"><h3><b>Edit Your Profile</b></h3>
</div><div id = "save"class = "hidemsg">Saved!!!</div>
<form id="register"action="javascript:void(null);"onsubmit="submitSignup();">

<table >
<tr><td class ="Register">First Name</td>
<td class ="Register">
<input type=text size="20"name= "Fname" id="fname" value =<?php echo $first; ?>  > *</td>
<td class ="Register">
<div id="checkfname" class="hidemsg">First Name Required</div>
</td>
</tr>


<tr><td class ="Register">
Last Name</td>
<td class ="Register">
<input type=text size="20" name= "Lname" id="lname"value =<?php echo $last; ?>> *</td>
<td class ="Register">

<Div id ="checklname" class= "hidemsg">Last Name Required</Div>
</td></tr>

<tr><td class ="Register">
Sex</td>
<td class ="Register">
<select  name= "sex" id="sex1">
<option value ="<?php echo $sex; ?>"> <?php echo $sex; ?></option>
<option value ="Male"> Male</option>
<option value ="Female">Female</option>
</select>
*</td>
<td class ="Register">

<Div id ="checksex" class= "hidemsg">missing</Div>
</td></tr>

<tr><td class ="Register">
Status</td>
<td class ="Register">
<input type=text size="20" name= "status" id="status1"value =<?php echo $status; ?>> </td>
</tr>

<tr><td class ="Register">
Interested in </td>
<td class ="Register">
<input type=text size="20" name= "interest" id="interest1"value =<?php echo $interest; ?>> </td></tr>


<tr><td class ="Register"></td><td class ="Register"></td><td class ="Register"></td></tr>
<tr><td class ="Register">Address</td>

<td class ="Register">
<input type=text name="address" id="Uaddr" size="25" value =<?php echo $address; ?>>
</td>
<td class ="Register">

</td></tr>

<tr><td class ="Register">Email</td>

<td class ="Register"><input type=text size="20"name= "email" id="uemail" value =<?php echo $Email; ?>> *</td>

<td class ="Register">
<div id="checkemail" class="hidemsg">Email&nbsp; Required</div>
</td></tr>
<tr>
<td class ="Register">Country</td>

<td class ="Register"><input type=text size="20"name= "country" id="ucontry"value =<?php echo $Country; ?>> *</td>

<td class ="Register">
<div id="checkcountry" class="hidemsg">country&nbsp; Required</div>
</td></tr>




</tr>
<tr><td class ="Register">Date of Birth(Use European format(25/01/06))</td>

<td class ="Register">
<INPUT type="text" name=testdat size='10' maxlength="10" onblur="check_date(this)"value =<?php echo $Date; ?>>
</td><td class ="Register">

<div id="checkdate" class="hidemsg">Date Required</div>

</td></tr>


<tr><td class ="Register">Password</td>
<td class ="Register"><input type=password size="20" name="passwrd1"id="pword1" value =<?php echo $Password; ?>> *</td>
<td class ="Register">
<div id= "checkpasswrd1"class="hidemsg">Password Required</div>
</td></tr>
 <tr><td class ="Register">
 Re enter
 </td><td class ="Register">
 <div id="checksame" class="hidemsg">Passwords should be the same</div>
 </td><td class ="Register">
 </td></tr>
<tr><td class ="Register">Password </td>

<td class ="Register">
<input type=password size="20"name="passwrd2" id="pword2" value =<?php echo $Password; ?>> *
</td><td class ="Register">
<div id="checkpasswrd2" class="hidemsg">Password Required</div>
</td></tr>

<tr><td class ="Register">

<input type =button value =" cancel"onclick = "window.self.location='../useraccount/content.php';"></td>

<td class ="Register">

</td>

<td class ="Register">
<input type="submit" value ="Edit" id ="submitButton">
</td></tr>
</table>

 
</form>

</div>
</BODY>
</HTML>