<?php

//using xajax
//client/server interaction
//process.php is a server script


?>





<HTML>
<HEAD><link rel="Stylesheet" href="../icons/spgm_style.css" />
<TITLE>Member</TITLE>

<?php //$xajax->printJavascript();
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
<div id="title"class="RegisterTitle">
</div>
<form id="register"action="javascript:void(null);"onsubmit="submitSignup();">

<table >
<tr><td class ="Register">First Name</td>
<td class ="Register">
<input type=text size="20"name= "Fname" id="fname"> *</td>
<td class ="Register">
<div id="checkfname" class="hidemsg">First Name Required</div>
</td>
</tr>


<tr><td class ="Register">
Last Name</td>
<td class ="Register">
<input type=text size="20" name= "Lname" id="lname"> *</td>
<td class ="Register">

<Div id ="checklname" class= "hidemsg">Last Name Required</Div>
</td></tr>

<tr><td class ="Register"></td><td class ="Register"></td><td class ="Register"></td></tr>
<tr><td class ="Register">Address</td>

<td class ="Register">
<input type=text name="address" id="Uaddr" size="20">
</td>
<td class ="Register">

</td></tr>

<tr><td class ="Register">Email</td>

<td class ="Register"><input type=text size="20"name= "email" id="uemail"> *</td>

<td class ="Register">
<div id="checkemail" class="hidemsg">Email&nbsp; Required</div>
</td></tr>
<tr>
<td class ="Register">Country</td>

<td class ="Register"><input type=text size="20"name= "country" id="ucontry"> *</td>

<td class ="Register">
<div id="checkcountry" class="hidemsg">country&nbsp; Required</div>
</td></tr>




</tr>
<tr><td class ="Register">Date of Birth(Use European format(25/01/06))</td>

<td class ="Register">
<INPUT type="text" name=testdat size='10' maxlength="10" onblur="check_date(this)">
</td><td class ="Register">

<div id="checkdate" class="hidemsg">Date Required</div>

</td></tr>

<tr><td class ="Register">Username</td>

<td class ="Register"><input type=text size="20" name="username" id="uuser" onblur="xajax_check(document.getElementById('uuser').value);"
> *</td>

<td class ="Register">
<div id= "uuser1" class="hidemsg">Username Required</div><div id= "uuser2" class="hidemsg">This Username already exists</div>
</td>
</tr>
<tr><td class ="Register">Password</td>
<td class ="Register"><input type=password size="20" name="passwrd1"id="pword1"> *</td>
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
<input type=password size="20"name="passwrd2" id="pword2"> *
</td><td class ="Register">
<div id="checkpasswrd2" class="hidemsg">Password Required</div>
</td></tr>

<tr><td class ="Register">

<input type =reset value = Clear></td>

<td class ="Register">

</td>

<td class ="Register">
<input type="submit" value ="Send" id ="submitButton">
</td></tr>
</table>

 
</form>

</div>
</BODY>
</HTML>
