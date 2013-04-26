<?php
session_start();

//require('xajax.inc.php');
//login form

//set a session for 1
//Memberid





function processlogin($aFormValues)
{
	$objResponse = new xajaxResponse();
	
	$bError = false;
	
	if (trim($aFormValues['user']) == "")
		{
			$objResponse->addAssign("user1","innerHTML","Username missing");
			$objResponse->addAssign("user1","className","showmsg2");
			$objResponse->addAssign("wrong","className","hidemsg");
			$bError = true;
	}
	if (trim($aFormValues['pass']) == "")
	{
		$objResponse->addAssign("pass1","innerHTML","Password missing");
		$objResponse->addAssign("pass1","className","showmsg2");
		$objResponse->addAssign("wrong","className","hidemsg");
		$bError = true;
	}
	
	
	if (trim($aFormValues['user']) != "")
		{
			
			$objResponse->addAssign("user1","className","hidemsg");
		
	}
	
	
	if (trim($aFormValues['pass']) != "")
	{
		
		$objResponse->addAssign("pass1","className","hidemsg");
	
		
	}
	if (!$bError)
	{
			//if all data are correct, then
	
			//check in db if values are correct
	
			$user= trim($aFormValues['user']);
			$pass = trim($aFormValues['pass']);
	
			//open db connection
	
			//include("dbinfo.inc.php");
	
			$query ="SELECT UserName,Password,Member_Id FROM member WHERE UserName='$user'and Password='$pass'";
	
			$result=mysql_query($query)or die(mysql_error());
	
			//check if user name & password are correct
	
			$num =mysql_numrows($result);
	
				if($num==0)
					//wrong pass & user
						{
						$objResponse->addClear("username","value");
						$objResponse->addClear("password","value");
						$objResponse->addAssign("wrong","innerHTML","Wrong password or username");
						$objResponse->addAssign("wrong","className","showmsg");
						$objResponse->addAssign("user1","className","hidemsg");
						$objResponse->addAssign("pass1","className","hidemsg");
						$objResponse->addAssign("mybutt","value","Submit");
						$objResponse->addAssign("mybutt","disabled",false);
						}//if
	
				else
				//valid
				//set cookie and session
					{
						$userId=mysql_result($result,0,"member_Id");
						//setcookie("username","$user",time()+100)
						//setcookie("userId","$userId",time()+100)
						$_SESSION['username']=$user;
						$_SESSION['userId']=$userId;
						$_SESSION['Login']=true;
						$objResponse->addAssign("log","innerHTML","You are login");
						$objResponse->addAssign("log","className","showmsg2");
						$objResponse->addAssign("user1","className","hidemsg");
						$objResponse->addAssign("pass1","className","hidemsg");
						$objResponse->addAssign("loginform","className","hidemsg");
						$objResponse->addAssign("loginbutton","className","hidemsg");//hide login button
						$objResponse->addAssign("logoutbutton","className","");//show logout button
						///Show Your Profile menu
						$objResponse->addAssign("UserProfilebutton","className","");//Show Your Profile menu
						$objResponse->addClear("username","value");//clear text box
						$objResponse->addClear("password","value");//clear text box
						$objResponse->addAssign("mybutt","value","Submit");//enable button
						$objResponse->addAssign("mybutt","disabled",false);
						mysql_close();
					}
	}//if
	
	else
	{
	$objResponse->addAssign("mybutt","value","Submit");
	$objResponse->addAssign("mybutt","disabled",false);
	}//else
	
	return $objResponse->getXML();
	}
	
	//$xajax = new xajax();
	//$xajax->debugOn(); // Uncomment this line to turn debugging on
//$xajax->registerFunction("processlogin");
//$xajax->registerFunction("check");

//$xajax->processRequests();



?>
<html>
<head><link rel="Stylesheet" href="../icons/spgm_style.css" />
<?php //$xajax->printJavascript();
?>


<script type="text/javascript">
<!---
		function submitform()
		{
			xajax.$('mybutt').disabled=true;
			xajax.$('mybutt').value="Wait";
			xajax_processlogin(xajax.getFormValues("loggin"));
			return false;
		}
		-->
		</script>
		</head><body>
<form id ="loggin" action="javascript:void(null);"onsubmit="submitform();">
<table align ="center" fpstyle="1,111111100" style="border-left-style: none; border-right-style: none; border-top: 1.5pt solid green; border-bottom: 1.5pt solid green" height="94" width="231">
<tr>
  <td class="Register" style="border-left-style: none; border-right-style: none; border-top-style: none; border-bottom: .75pt solid green" height="24" bgcolor="#E0EAF8" width="66">
  Username </td>
  <td style="border-left-style: none; border-right-style: none; border-top-style: none; border-bottom: .75pt solid green" height="24" bgcolor="#E0EAF8" width="155"><Input type ="text" name ="user" id="username"size ="15"></td>
  <td style="border-left-style: none; border-right-style: none; border-top-style: none; border-bottom: .75pt solid green" height="24" bgcolor="#E0EAF8" width="5"><div id ="user1"class= "hidemsg"></div></td></tr>
<tr>
  <td class="Register" style="border-style: none" height="23" bgcolor="#E0EAF8" width="66">Password </td>
  <td style="border-style: none" height="23" bgcolor="#E0EAF8" width="155">
  <span style="background-color: #E0EAF8"><Input type ="password" name="pass"id="password"size ="15"></span></td>
  <td style="border-style: none" height="23" width="5" bgcolor="#E0EAF8">
  <div id ="pass1"class= "hidemsg" style="width: 0; height: 0"></div></td></tr>
<tr> 
  <td rowpadding =2 colspan="2" align="center" style="border-style: none" height="34" bgcolor="#E0EAF8" width="225"><Input type ="submit" value= "submit" id ="mybutt"><Input type ="button" value= "Hide" id ="hideme"onclick="xajax_hideformlogin();"></td>
  <td bgcolor="#E0EAF8"></td></tr>
<tr>
  <td style="border-style: none" height="2" width="199" bgcolor="#E0EAF8" colspan="2"><div id="wrong"></div></td></tr>

</table>






</body>


</html>

<?php 
function processlogout()
{

$objResponse = new xajaxResponse();
//unset session values
// if the user is logged in, unset the session
if (isset($_SESSION['Login'])&& isset($_SESSION['username'])&&isset($_SESSION['userId'])) 
{
   unset($_SESSION['Login']);
   unset($_SESSION['username']);
   unset($_SESSION['userId']);
 $objResponse->addAssign("log","innerHTML","You are logout");
 $objResponse->addAssign("loginbutton","className","showmsg");//show login button
$objResponse->addAssign("logoutbutton","className","hidemsg");//hidelogout button
//hide userprofile menu///
$objResponse->addAssign("UserProfilebutton","className","hidemsg");
 //hide useraccount div
 $objResponse->addAssign("UserAccountDiv","className","hidemsg");
}
return $objResponse->getXML();
}


function hideformlogin()

{$objResponse = new xajaxResponse();


$objResponse->addAssign("loginform","className","hidemsg");
$objResponse->addClear("username","value");//clear text box
$objResponse->addClear("password","value");//clear text box
$objResponse->addAssign("mybutt","value","Submit");//enable button
$objResponse->addAssign("mybutt","disabled",false);
$objResponse->addAssign("user1","className","hidemsg");
$objResponse->addAssign("pass1","className","hidemsg");
$objResponse->addAssign("wrong","className","hidemsg");
//hide userprofile menu///
$objResponse->addAssign("UserProfilebutton","className","hidemsg");

return $objResponse->getXML();
}

function checkstatus()

{
$objResponse = new xajaxResponse();

if(isset($_SESSION['Login'])&& isset($_SESSION['username'])&&isset($_SESSION['userId'])) 
	{
	$objResponse->addAssign("loginbutton","className","hidemsg");//hide login button
	$objResponse->addAssign("logoutbutton","className","");//show logout button
	///Show Your Profile menu
	$objResponse->addAssign("UserProfilebutton","className","");//Show Your Profile menu
	}
return $objResponse->getXML();
}
?>

