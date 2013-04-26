<?php

session_start();


?>





<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">

<head>
 <?php $xajax->printJavascript();

 ?>
<title> Nu Zimazz</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="chrometheme/chromestyle2.css" />

<script type="text/javascript" src="chromejs/chrome.js">

/***********************************************
* Chrome CSS Drop Down Menu- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

</script>
		<script src="Register/date.js">
		//because am calling the page register/register.php from here. i would not have done tht if the browser was jt ie, but in firefox..i need to di tht, else it will not work
		</script>

		<script src="history.js">
		//manage history
		</script>
</head>

<body  onload ="return pollHash();">

<div id="chromemenu">
<ul>
<li><a href="javascript:void(null);"onclick="makeHistory(1);xajax_HideImageDetailDiv(); xajax_showRegister();xajax_hideRegisterForm();xajax_showHome();">Home</a></li>

<li><a href="javascript:void(null);"onclick="makeHistory(3);xajax_HideImageDetailDiv();xajax_showRegister();xajax_hideRegisterForm();xajax_DisplayAlbums('','');"> All Albums </a></li>
<li><a href="javascript:void(null);" onclick="xajax_HideImageDetailDiv();xajax_showRegister();xajax_hideRegisterForm();xajax_DisplayEvents('','');">Events</a></li>
<li><a href="javascript:void(null);"onclick="xajax_HideImageDetailDiv();xajax_showRegister();xajax_hideRegisterForm();xajax_DisplaySites('');">Sites</a></li>
<li><a href="javascript:void(null);"onclick="xajax_HideImageDetailDiv();xajax_showRegister();xajax_hideRegisterForm();xajax_DisplayMembers('');">Members</a></li>
<li><div id="UserProfilebutton" class="hidemsg"><a href="./useraccount/Holder.php">


Your Profile</a></div></li>
<li><a href="javascript:void(null);"onclick="makeHistory(2);xajax_HideImageDetailDiv();xajax_showRegister();xajax_showDiv('registerdiv','Register');">Sign Up for Free</a></li>

<li><a href="#abtus">Contact Us</a></li>
<li><div id="logoutbutton" class="hidemsg"><a href="javascript:void(null);"onclick="xajax_processlogout();">Logout</a></div></li>

<li><div id="loginbutton"><a href="javascript:void(null);"onclick="xajax_showDiv('loginform','Login');">Login</a></div></li>

<li><div id= "log" class ="hidemsg">Login</div></li>

</ul>
</div>


<!--0th drop down menu -->

<!--1st drop down menu -->



<!--3rd anchor link and menu -->
<div id="dropmenu3" class="dropmenudiv" style="width: 150px;">
<a href="http://www.google.com/">In All Categories</a>
<a href="http://www.yahoo.com">Event Categories</a>
<a href="http://www.msn.com">People Categories</a>
</div>


</body>

</html>