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
	
}

function processAccountData($aFormValues)
{
	$objResponse = new xajaxResponse();
	
	$Error_counter = 0;
	
	if (trim($aFormValues['Fname']) != "")
		{
			$objResponse->addAssign("checkfname","className","hidemsg");
			
			
	}
	if (trim($aFormValues['Fname']) == "")
	{
		$objResponse->addAssign("checkfname","className","showmsg");
		$Error_counter ++;
	}
	 if (trim($aFormValues['Lname']) == "")
		{
			$objResponse->addAssign("checklname","className","showmsg");
			$Error_counter ++;
	}
	if (trim($aFormValues['Lname']) != "")
			{
				$objResponse->addAssign("checklname","className","hidemsg");
				
	}
	if (!eregi("^[a-zA-Z0-9]+[_a-zA-Z0-9-]*(\.[_a-z0-9-]+)*@[a-z??????0-9]+(-[a-z??????0-9]+)*(\.[a-z??????0-9-]+)*(\.[a-z]{2,4})$", $aFormValues['email']))
		{
			$objResponse->addAssign("checkemail","className","showmsg");
			$Error_counter ++;
	}
	if (eregi("^[a-zA-Z0-9]+[_a-zA-Z0-9-]*(\.[_a-z0-9-]+)*@[a-z??????0-9]+(-[a-z??????0-9]+)*(\.[a-z??????0-9-]+)*(\.[a-z]{2,4})$", $aFormValues['email']))
			{
				$objResponse->addAssign("checkemail","className","hidemsg");
				
	}
    
    
    if (trim($aFormValues['country']) != "")
		{
			$objResponse->addAssign("checkcountry","className","hidemsg");
			
	}
    
    	if (trim($aFormValues['country']) == "")
	{
		$objResponse->addAssign("checkcountry","className","showmsg");
		$Error_counter ++;
	}
	if (trim($aFormValues['testdat']) == "")
			{
				$objResponse->addAssign("checkdate","className","showmsg");
				$Error_counter ++;
	}
	
	if (trim($aFormValues['testdat']) != "")
				{
					$objResponse->addAssign("checkdate","className","hidemsg");
					
	}
	
	
	
	if (trim($aFormValues['passwrd1']) == "")
	{
		$objResponse->addAssign("checkpasswrd1","className","showmsg");
		$Error_counter ++;
		
	}
	if (trim($aFormValues['passwrd1']) != "")
		{
			$objResponse->addAssign("checkpasswrd1","className","hidemsg");
			
	}
	if (trim($aFormValues['passwrd2']) == "")
		{
			$objResponse->addAssign("checkpasswrd2","className","showmsg");
			$Error_counter ++;
	}
	if (trim($aFormValues['passwrd2']) != "")
			{
				$objResponse->addAssign("checkpasswrd2","className","hidemsg");
			
	}
	if ($aFormValues['passwrd1'] != $aFormValues['passwrd2'])
	{
		$objResponse->addAssign("checksame","className","showmsg");
		$Error_counter ++;
	}
	if ($aFormValues['passwrd1'] == $aFormValues['passwrd2'] && $aFormValues['passwrd1'] !="" &&$aFormValues['passwrd2'] !=""  )
		{
			$objResponse->addAssign("checksame","className","hidemsg");
			
	}

	if ($Error_counter == 0)
	{
	//if all data are correct, then
	
	//insert in db
	
	$first = trim($aFormValues['Fname']);
	$last = trim($aFormValues['Lname']);
	$dob = trim($aFormValues['testdat']);
	$addr = trim($aFormValues['address']);
	$email= trim($aFormValues['email']);
    $country = trim($aFormValues['country']);
	
	$passwrd= trim($aFormValues['passwrd1']);
	
	//memprofile
	$sex = trim($aFormValues['sex']); ;
	$interest =trim($aFormValues['interest']); ;
	$Status = trim($aFormValues['status']);;
	
	
	
	
		$objResponse->addAssign("user2","className","hidemsg");
	include("../dbinfo.inc.php");
	$id =$_SESSION['memid'];
		$query ="UPDATE member set F_Name='$first',L_Name='$last',Address='$addr',Country='$country',Email='$email',DOB='$dob',Password='$passwrd' where Member_Id ='$id'";
		mysql_query($query)or die( mysql_error());
		$query ="UPDATE memprofile set Sex='$sex',status='$Status',Interests='$interest' where Mem_Id ='$id'";
		mysql_query($query)or die( mysql_error());
	unset($_SESSION['memid']);
	
		mysql_close();	
			
		
		$objResponse->addAssign("save","className","showmsg");
		$objResponse->addRedirect("../useraccount/content.php");

	
	
	
	
	
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