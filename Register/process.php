<?php

//process.php
//check from register
//require("xajax.inc.php");


function processForm($aFormValues)
{
	if (array_key_exists("Fname",$aFormValues))
	{
		return processAccountData($aFormValues);
	}
	else if (array_key_exists("firstName",$aFormValues))
	{
		return processPersonalData($aFormValues);
	}
}

function processAccountData($aFormValues)
{
	$objResponse = new xajaxResponse();
	
	$bError = 0;
	
	if (trim($aFormValues['Fname']) != "")
		{
			$objResponse->addAssign("checkfname","className","hidemsg");
			//$bError = false;
	}
	if (trim($aFormValues['Fname']) =="")
	{
		$objResponse->addAssign("checkfname","className","showmsg");
		$bError++;
	}
	if (trim($aFormValues['Lname']) == "")
		{
			$objResponse->addAssign("checklname","className","showmsg");
			$bError++;
	}
	if (trim($aFormValues['Lname']) != "")
			{
				$objResponse->addAssign("checklname","className","hidemsg");
				//$bError = false;
	}
	if (!eregi("^[a-zA-Z0-9]+[_a-zA-Z0-9-]*(\.[_a-z0-9-]+)*@[a-z??????0-9]+(-[a-z??????0-9]+)*(\.[a-z??????0-9-]+)*(\.[a-z]{2,4})$", $aFormValues['email']))
		{
			$objResponse->addAssign("checkemail","className","showmsg");
			$bError ++;
	}
	if (eregi("^[a-zA-Z0-9]+[_a-zA-Z0-9-]*(\.[_a-z0-9-]+)*@[a-z??????0-9]+(-[a-z??????0-9]+)*(\.[a-z??????0-9-]+)*(\.[a-z]{2,4})$", $aFormValues['email']))
			{
				$objResponse->addAssign("checkemail","className","hidemsg");
				//$bError = false;
	}
    
    
    if (trim($aFormValues['country']) != "")
		{
			$objResponse->addAssign("checkcountry","className","hidemsg");
			//$bError = false;
	}
    
    	if (trim($aFormValues['country']) == "")
	{
		$objResponse->addAssign("checkcountry","className","showmsg");
		$bError ++;
	}
	if (trim($aFormValues['testdat']) == "")
			{
				$objResponse->addAssign("checkdate","className","showmsg");
				$bError ++;
	}
	
	if (trim($aFormValues['testdat']) != "")
				{
					$objResponse->addAssign("checkdate","className","hidemsg");
					//$bError = false;
	}
	
	if (trim($aFormValues['username']) == "")
				{
					$objResponse->addAssign("uuser1","className","showmsg");
					$bError ++;
	}
	
	if (trim($aFormValues['username']) != "")
					{
						$objResponse->addAssign("uuser1","className","hidemsg");
						//$bError = false;
	}
	
	if (trim($aFormValues['passwrd1']) == "")
	{
		$objResponse->addAssign("checkpasswrd1","className","showmsg");
		$bError ++;
	}
	if (trim($aFormValues['passwrd1']) != "")
		{
			$objResponse->addAssign("checkpasswrd1","className","hidemsg");
			//$bError = false;
	}
	if (trim($aFormValues['passwrd2']) == "")
		{
			$objResponse->addAssign("checkpasswrd2","className","showmsg");
			$bError ++;
	}
	if (trim($aFormValues['passwrd2']) != "")
			{
				$objResponse->addAssign("checkpasswrd2","className","hidemsg");
				//$bError = false;
	}
	if ($aFormValues['passwrd1'] != $aFormValues['passwrd2'])
	{
		$objResponse->addAssign("checksame","className","showmsg");
		$bError ++;
	}
	if ($aFormValues['passwrd1'] == $aFormValues['passwrd2'] && $aFormValues['passwrd1'] !="" &&$aFormValues['passwrd2'] !=""  )
		{
			$objResponse->addAssign("checksame","className","hidemsg");
			//$bError = false;
	}

	if ($bError==0)
	{
	//if all data are correct, then
	
	//insert in db
	
	$first = trim($aFormValues['Fname']);
	$last = trim($aFormValues['Lname']);
	$dob = trim($aFormValues['testdat']);
	$addr = trim($aFormValues['address']);
	$email= trim($aFormValues['email']);
    $country = trim($aFormValues['country']);
	$user = trim($aFormValues['username']);
	$passwrd= trim($aFormValues['passwrd1']);
	
	
	//include("../dbinfo.inc.php");
	//check if username already exists
	
	$query ="SELECT UserName FROM member WHERE UserName='$user'";
	$result=mysql_query($query);
	$num =mysql_numrows($result);
	
	if($num !=0)
	{//alert the member that this name already exists
		$objResponse->addAssign("user2","className","showmsg");
	
		}//if
	else
	{
	
		$objResponse->addAssign("user2","className","hidemsg");
	
		$query ="INSERT INTO member VALUES('','$first','$last','$addr',' $country   ','$email','$dob','$user','$passwrd')";
		mysql_query($query);
	//must create a directory for the user naming it the user id
	//get the last user id just registered
	
	$query ="SELECT Member_Id FROM member WHERE UserName='$user'";
	$result=mysql_query($query)or die(mysql_error()) ;
	$num =mysql_numrows($result);
	if($num !=0)
	{
	$memID = mysql_result($result,0,"Member_Id");
	//create a directory and naming it $memID
	@mkdir("./Images/$memID",777);
	//make another dir in side the directory
	@mkdir("./Images/$memID/temp",777);
	
	//create the profile photo to default
	//enter the profile photo in the database
	$query ="INSERT INTO memprofile VALUES('$memID','ros.jpg','','',' ','')";
	mysql_query($query);
	}
	
	
			//should redirect the user to his account here
			//$_SESSION['username']=$user;
			//$_SESSION['userId']=$memID;
		$objResponse->addAlert("You have successfully registered !!");
		$objResponse->addAssign("HomeTable","className","showmsg2");
		$objResponse->addAssign("title1","innerHTML","Home");
		$objResponse->addAssign("registerdiv","className","hidemsg");
		$objResponse->addAssign("submitButton","value","Send");
		$objResponse->addAssign("submitButton","disabled",false);
	}//else
	//close db
	
	
	$objResponse->addAssign("submitButton","value","Send");
	$objResponse->addAssign("submitButton","disabled",false);
	//mysql_close();
	
	}//outer if
	else
	{
	
		$objResponse->addAssign("submitButton","value","Send");
		$objResponse->addAssign("submitButton","disabled",false);
	}//else
	
	return $objResponse->getXML();
}//function



function check($value)

{$objResponse = new xajaxResponse();

if($value =="")
{


	$objResponse->addAssign("user1","className","showmsg");
	$objResponse->addAssign("user2","className","hidemsg");

}

else


{	//check if name exists in db
	//include("dbinfo.inc.php");

	$query ="SELECT UserName FROM member WHERE UserName='$value'";
	$result=mysql_query($query);
	$num =mysql_numrows($result);
	
		if($num !=0)
			{//alert the member that this name already exists
			$objResponse->addAssign("uuser2","className","showmsg");
			$objResponse->addAssign("uuser1","className","hidemsg");
			}//if
		
		
		else	{
				$objResponse->addAssign("uuser2","className","hidemsg");
		
			}
			
	$objResponse->addAssign("uuser1","className","hidemsg");
	
	}//else
return $objResponse->getXML();

}


?>
