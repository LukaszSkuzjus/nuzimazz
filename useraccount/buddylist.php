<?php
//Invitation Received
//function to get all invitations received bt the user


function Getsenderpic($From)

{
$query="SELECT Image_Url FROM memprofile where Mem_Id=$From";
	
	$result=mysql_query($query)or die(mysql_error());
	
	$num=mysql_numrows($result);
	//check
	$msg;
	if($num==0)
	
		$msg= "No Records founds";
		else
		
		{
	
	


	$Url=mysql_result($result,0,"Image_Url");//get image 
	
	$msg="../Images/profile/".$Url;
	

}//else
	return $msg;
	

}//func

function GetUserName($From)
{
	$query="SELECT member.UserName FROM member where Member_Id= $From";
	
	$result=mysql_query($query)or die(mysql_error());
	
	$num=mysql_numrows($result);
	//check
	$msg;
	if($num==0)
	
		$msg= "No UserName founds";
		else
		
		{
	
	


	$Name=mysql_result($result,0,"member.UserName");//get image 
	
	$msg=$Name;
	

}//else
	return $msg;
	}
function Getsendername($From)
{
	$query="SELECT member.F_Name,member.L_Name  FROM member where Member_Id= $From";
	
	$result=mysql_query($query)or die(mysql_error());
	
	$num=mysql_numrows($result);
	//check
	$msg;
	if($num==0)
	
		$msg= "No Name founds";
		else
		
		{
	
	


	$Name=mysql_result($result,0,"member.F_Name")." ".mysql_result($result,0,"member.L_Name");//get image 
	
	$msg=$Name;
	

}//else
	return $msg;
}//fuction
function GetInbox($userid,$jumpto)

		{
			
			
			
		
	//list all the  items where "To"field in table networkinvite = the userid
				$objResponse = new xajaxResponse();
				// how many rows to show per page 
				$rowsPerPage = 5;
	
				// if $jumpto  defined, use it as page number 
				if($jumpto!="") 
 
				$pageNum = $jumpto;
				else
				// by default show first page 
				$pageNum = 1;
				$start = ($pageNum -1) * $rowsPerPage;
				// enter  query and display stuff

			$query = "select * from networkinvite where networkinvite.To ='$userid' limit $start, $rowsPerPage";
			$result=mysql_query($query)or die(mysql_error());
			$count =mysql_numrows($result);
			$msg;
			if($count==0)
			{$msg= "No invitation Received";
				$objResponse->addAssign("mytable","innerHTML",$msg);
		
			}
				else{
				
				//create a table to display album pictures now
					$msg.="<table class=\"table-wrapper\">";//echo
					
					for($S=0;$S<$count;$S++)
		
						{
							$From =mysql_result($result,$S,"From");
							
							$Status= mysql_result($result,$S,"Status");
							if($Status==0)
							$Status ="cancelled";
							if($Status==1)
							$Status ="Accepted";
							if($Status==2)
							$Status ="Pending";
							//now display the sender pic
							
							$senderpicture =Getsenderpic($From);
							$senderName = Getsendername($From);
						
					$msg.="<tr><td>";
				
					
				
				$msg.="<table class=\"table-shadows\" >
					<tr>
					<td class=\"td-shadows-main\">
    		
					<a href=\"javascript:void(null);\"onclick=\"xajax_GetAllPictureDetails($albumid,$imageId);\" >";//end of echo
					//GetImage path 
					$msg.="<IMG SRC=\"".$senderpicture."\"width=50 height=60>
					</a>
					</td >
					<td class=\"td-shadows-right\"></td>
					</tr>
					<tr>
					<td class=\"td-shadows-bottom\"></td>
					<td class=\"td-shadows-bottomright\">
					</td>
					
					</tr>
					
					</table><!--end of  table shadows-->
					

					</td>";//end of echo
					$msg.="<td>$senderName</td>
					
					
					<td>\"viewprofile\"</td>
					<td>\"view Albums\"</td>";
						if($Status !="Accepted")	
						$msg.="<td><a href=\"javascript:void(null);\"onclick=\"xajax_processAccept($From,$userid);\" >Accept</a></td>";
						if($Status !="cancelled" && $Status !="Accepted")	
						
						$msg.="<td><a href=\"javascript:void(null);\"onclick=\"xajax_processCancel($From,$userid);\" >Cancel </a></td>";
						if($Status =="Accepted")
						$msg.="<td><a href=\"javascript:void(null);\"onclick=\"xajax_processDelete($userid,$From);\" >Delete</a></td>	";
						$msg.="<td>$Status</td></tr>";//end of msg
			}//for
			$msg.="<table>";
			//############## End of display stuff
			// how many rows we have in database 

		$query="select  COUNT(*) AS numrows from networkinvite where networkinvite.To ='$userid' ";
				
		$result  = mysql_query($query) or die('Error, query failed'); 
				$row     = mysql_fetch_array($result, MYSQL_ASSOC); 
				$numrows = $row['numrows'];
				
				// how many pages we have when using paging? 
				
				$maxPage = ceil($numrows/$rowsPerPage);
				//#################################### 
				// creating 'previous' and 'next' link 
				if ($pageNum > 1) 
						{ 
							$page = $pageNum -1; 
							$prev="<input type=\"button\" name=\"prev\" onclick =\"xajax_GetInbox($userid,$page);\" value=\"Prev\">"; 

							$first = "<input type=\"button\" name=\"first\" onclick =\"xajax_GetInbox($userid,1);\" value=\"First\">";  

						} 
				else 
						{ 
							$prev  = ' ';       // we're on page one, don't enable 'previous' link 
							$first = '  '; // nor 'first page' link 
						} 

				// print 'next' link only if we're not 
				// on the last page 
				if ($pageNum < $maxPage) 
						{ 
						$page = $pageNum + 1; 
						$next = "<input type=\"button\" name=\"next\"onclick=\"xajax_GetInbox($userid,$page);\"value=\"Next\">";  
						$last = "<input type=\"button\" name=\"Last\"onclick=\"xajax_GetInbox($userid,$maxPage);\"value=\"Last\">";   
 
						} 
				else 
						{ 
						$next = '  ';      // we're on the last page, don't enable 'next' link 
						$last = '  '; // nor 'last page' link 
						} 
				// print the page navigation link	
				$msg.=$first . $prev . " Page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages " . $next . $last; 				
			
 	

			$objResponse->addAssign("mytable","innerHTML",$msg);
			//$objResponse->addAssign("but","innerHTML",$but);
		}//else
		return $objResponse->getXML();



		}//func


//invitation Sent


function Getoutbox($userid,$jumpto)

		{
			
			
			
		
	//list all the  items where "To"field in table networkinvite = the userid
				$objResponse = new xajaxResponse();
				// how many rows to show per page 
				$rowsPerPage = 5;
	
				// if $jumpto  defined, use it as page number 
				if($jumpto!="") 
 
				$pageNum = $jumpto;
				else
				// by default show first page 
				$pageNum = 1;
				$start = ($pageNum -1) * $rowsPerPage;
				// enter  query and display stuff

			$query = "select * from networkinvite where networkinvite.From ='$userid' limit $start, $rowsPerPage";
			$result=mysql_query($query)or die(mysql_error());
			$count =mysql_numrows($result);
			$msg;
			if($count==0)
			{$msg= "No invitation sent";
				$objResponse->addAssign("mytable","innerHTML",$msg);
		
			}
				else{
				
				//create a table to display album pictures now
					$msg.="<table class=\"table-wrapper\">";//echo
					
					for($S=0;$S<$count;$S++)
		
						{
							$To =mysql_result($result,$S,"networkinvite.To");
						
							$Status= mysql_result($result,$S,"networkinvite.Status");
							if($Status==0)
							$Status ="cancelled";
							if($Status==1)
							$Status ="Accepted";
							if($Status==2)
							$Status ="Pending";
							//now display the sender pic
							
							$senderpicture =Getsenderpic($To);
							$senderName = Getsendername($To);
						
					$msg.="<tr><td>";
				
					
				
				$msg.="<table class=\"table-shadows\" >
					<tr>
					<td class=\"td-shadows-main\">
    		<a href=\"javascript:void(null);\"onclick=\"xajax_GetAllPictureDetails($albumid,$imageId);\" >
					";//end of echo
					//GetImage path 
					$msg.="<IMG SRC=\"".$senderpicture."\"width=50 height=60>
					</a>
					</td >
					<td class=\"td-shadows-right\"></td>
					</tr>
					<tr>
					<td class=\"td-shadows-bottom\"></td>
					<td class=\"td-shadows-bottomright\">
					</td>
					
					</tr>
					
					</table><!--end of  table shadows-->
					

					</td>";//end of echo
					$msg.="<td>$senderName</td>
					
					
					<td>\"viewprofile\"</td>
					<td>\"view Albums\"</td>";
						if($Status=="Accepted")
						
						$msg.="<td><a href=\"javascript:void(null);\"onclick=\"xajax_processDelete($userid,$To);\" >Delete</a></td>	";
						if($Status=="Pending")
						$msg.="<td><a href=\"javascript:void(null);\"onclick=\"xajax_deletepending($To,$userid);\" >Delete Request</a></td>	";
						$msg.="<td>$Status</td>	
						</tr>";//end of msg
			}//for
			$msg.="<table>";
			//############## End of display stuff
			// how many rows we have in database 

		$query="select  COUNT(*) AS numrows from networkinvite where networkinvite.From ='$userid' ";
				
		$result  = mysql_query($query) or die('Error, query failed'); 
				$row     = mysql_fetch_array($result, MYSQL_ASSOC); 
				$numrows = $row['numrows'];
				
				// how many pages we have when using paging? 
				
				$maxPage = ceil($numrows/$rowsPerPage);
				//#################################### 
				// creating 'previous' and 'next' link 
				if ($pageNum > 1) 
						{ 
							$page = $pageNum -1; 
							$prev="<input type=\"button\" name=\"prev\" onclick =\"xajax_Getoutbox($userid,$page);\" value=\"Prev\">"; 

							$first = "<input type=\"button\" name=\"first\" onclick =\"xajax_Getoutbox($userid,1);\" value=\"First\">";  

						} 
				else 
						{ 
							$prev  = ' ';       // we're on page one, don't enable 'previous' link 
							$first = '  '; // nor 'first page' link 
						} 

				// print 'next' link only if we're not 
				// on the last page 
				if ($pageNum < $maxPage) 
						{ 
						$page = $pageNum + 1; 
						$next = "<input type=\"button\" name=\"next\"onclick=\"xajax_Getoutbox($userid,$page);\"value=\"Next\">";  
						$last = "<input type=\"button\" name=\"Last\"onclick=\"xajax_Getoutbox($userid,$maxPage);\"value=\"Last\">";   
 
						} 
				else 
						{ 
						$next = '  ';      // we're on the last page, don't enable 'next' link 
						$last = '  '; // nor 'last page' link 
						} 
				// print the page navigation link	
				$msg.=$first . $prev . " Page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages " . $next . $last; 				
			
 	

			$objResponse->addAssign("mytable","innerHTML",$msg);
			//$objResponse->addAssign("but","innerHTML",$but);
		}//else
		return $objResponse->getXML();



		}//func

		
		function showbuddylist($userId)
		{
		$objResponse = new xajaxResponse();
		$msg ;
		$msg ="<table border=\"1\" cellpadding=\"15\"  style=\"border-collapse: collapse\" bordercolor=\"#C0C0C0\" width=\"150%\" id=\"AutoNumber1\">
  <tr>
    <td width=\"100%\">
    <table border=\"2\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse; border-width: 0\" bordercolor=\"#111111\" width=\"100%\" id=\"AutoNumber2\" >
      <tr>
        <td width=\"50%\"  style=\"border-left: medium none #111111; border-right-style: none; border-right-width: medium; border-top-style: none; border-top-width: medium; border-bottom-style: none; border-bottom-width: medium\">
        <p align=\"center\"><i><b><a href=\"javascript:void(null);\"onclick=\"xajax_GetInbox($userId,'');\" >Received</a></b></i></td>
        <td width=\"50%\"  style=\"border-left-style: none; border-left-width: medium; border-right: medium none #111111; border-top-style: none; border-top-width: medium; border-bottom-style: none; border-bottom-width: medium\">
        <p align=\"center\"><i><b><a href=\"javascript:void(null);\"onclick=\"xajax_Getoutbox($userId,'');\" >Sent  </a></b></i></td>
      </tr>
      <tr>
        <td width=\"100%\" colspan=\"2\" style=\"border-left: medium none #111111; border-right: medium none #111111; border-top-style: none; border-top-width: medium; border-bottom-style: none; border-bottom-width: medium\">&nbsp;</td>
      </tr>
     
    </table>
    </td>
  </tr>
</table>";//msg
$objResponse->addAssign("buddylist","innerHTML",$msg);
return $objResponse->getXML();
		}
		
		
	
function processAccept($sender,$Acceptedbyme)
{
$objResponse = new xajaxResponse();
//make  the 2 members Related


$query = "INSERT INTO relatedmembers( MemberId , RelatedId ) 
VALUES ('$sender', '$Acceptedbyme'), ('$Acceptedbyme', '$sender')";


mysql_query($query)or die(mysql_error());
//update the field status in table networkinvite to 1 where from = $sender To =$Accepter

$query ="UPDATE networkinvite SET Status = '1' WHERE networkinvite.From =' $sender' AND networkinvite.To = '$Acceptedbyme' LIMIT 1";
mysql_query($query)or die(mysql_error());

//update display
$objResponse->loadXML(viewuseringroup($Acceptedbyme,''));
$objResponse->loadXML(GetInbox($Acceptedbyme,''));
return $objResponse->getXML();
}
function processDelete($myid,$receiverid)
{//delete the record in table networkinvite
$objResponse = new xajaxResponse();
$query  = "DELETE FROM networkinvite WHERE networkinvite.From ='$receiverid' AND networkinvite.To ='$myid' LIMIT 1 ";
mysql_query($query)or die(mysql_error());
//now delete in relation relatedmembers

$query = "DELETE FROM relatedmembers WHERE MemberId = '$myid' AND RelatedId = '$receiverid' LIMIT 1";
$result =mysql_query($query)or die(mysql_error());
   
  $query ="  DELETE FROM relatedmembers WHERE MemberId = '$receiverid' AND RelatedId = '$myid' LIMIT 1"; 

   $result2 =mysql_query($query)or die(mysql_error());
	

$objResponse->addAssign("mytable","innerHTML","Member link deleted");
		
//update display

{
$objResponse->loadXML(viewuseringroup($myid,''));
$objResponse->loadXML(GetInbox($myid,''));
}
//update display

return $objResponse->getXML();
}

Function processCancel($sender,$cancelbyme)

{//update the field status in table networkinvite to 0 where from = $sender To =$Accepter
$objResponse = new xajaxResponse();
$query ="UPDATE networkinvite SET Status = '0' WHERE networkinvite.From ='$sender' AND networkinvite.To = '$cancelbyme' LIMIT 1";
mysql_query($query)or die(mysql_error());

return $objResponse->getXML();
}
	function deletepending($sendto,$deletebyme)
	{
	$objResponse = new xajaxResponse();
$query ="Delete from networkinvite where networkinvite.From ='$deletebyme' AND networkinvite.To = '$sendto' LIMIT 1";
//update display
mysql_query($query)or die(mysql_error());
$objResponse->loadXML(Getoutbox($myid,''));
return $objResponse->getXML();
	}//func
	
function invite($fromid,$toid)
{
$objResponse = new xajaxResponse();
if($fromid!=$toid)//cannot invirte himself
{
	//check first if the record does not already exists
	$query = " select * from networkinvite where networkinvite.From='$fromid'and networkinvite.To ='$toid'";
	$result = mysql_query($query)or die(mysql_error());
	$query = " select * from networkinvite where networkinvite.To='$fromid'and networkinvite.From ='$toid'";
	$result2 = mysql_query($query)or die(mysql_error());
	$num=mysql_numrows($result);
	$num2=mysql_numrows($result2);
	$yourmsg;
	if($num ==0 && $num2==0)
	{
	$query = " insert into networkinvite values ('$fromid','$toid','2')";
	mysql_query($query)or die(mysql_error());
	
	$yourmsg =GetUserName($toid);
	$yourmsg .="  has been invited !! check your buddylist";
	$objResponse->addAssign("mytable","innerHTML",$yourmsg);
	}
	//else records already exists
	
	else 
	{
	$yourmsg =GetUserName($toid);
	$yourmsg .="  has  already been invited or just request you..See your buddylist..";
	$objResponse->addAssign("mytable","innerHTML",$yourmsg);
	}
	}//if
	else
	$objResponse->addAssign("mytable","innerHTML","you cannot invite yourself");
	return $objResponse->getXML();
}//func
	
	
	function SearchMember($aFormValues,$jumpto)
	{
	$objResponse = new xajaxResponse();
	
	$rowsPerPage = 4;
	$fromid = $_SESSION['userId'];
				// if $jumpto  defined, use it as page number 
				if($jumpto!="") 
 
				$pageNum = $jumpto;
				else
				// by default show first page 
				$pageNum = 1;
				$start = ($pageNum -1) * $rowsPerPage;
				// enter  query and display stuff

	$bError = false;
	
	if (trim($aFormValues['mem01']) == "")
		{
			$objResponse->addAssign("memerror","innerHTML","<img src = \"../icons/tips.gif\" >");
			$bError = true;
	}
	if (trim($aFormValues['mem01']) != "")
		{
		$objResponse->addAssign("memerror","innerHTML","");
			$membername =trim($aFormValues['mem01']);
			$bError = false;
	}
	if (trim($aFormValues['mem02']) != "")
	$country = trim($aFormValues['mem02']);
	if (trim($aFormValues['mem03']) != "")
	$albumname = trim($aFormValues['mem03']);
	
	if (!$bError)
	{
	
	//search in db
	if($membername !="" )
	{
	$query = "select distinct member.Member_Id,member.UserName from member,album where member.UserName like '%$membername%' and member.Country like '%$country%'
	and album.AlbumName like '%$albumname%'";
	}//if
	$result = mysql_query($query)or die(mysql_error());
	$num=mysql_numrows($result);
			if($num ==0)
				{
				
				$objResponse->addAssign("mytable","className","HomeTitle");
					$objResponse->addAssign("mytable","innerHTML","Member not found!!please try again");
				}//if
			else{
				//create a table to display album pictures now
					$msg.="<table class=\"table-wrapper\">";//echo
					$msg.="<tr>";//end of echo
					for($S=0;$S<$num;$S++)
		
						{
							$username=mysql_result($result,$S,"member.UserName");
							$memberid= mysql_result($result,$S,"member.Member_Id");
							//now display the album pic
							//1st get the image path of the pic
							// call a function to get member pic
							$path = Getsenderpic($memberid);
							// now display the album


						//3 by 2


		
	
			
			

			
					
					$msg.="<td>";
				
					
				
				$msg.="<table class=\"table-shadows\" >
					<tr>
					<td class=\"td-shadows-main\">
    		
					<a href=\"javascript:void(null);\" >";//end of echo
					//GetImage path 
					$msg.="<IMG SRC=\"".$path."\"width=50 height=60>
					</a>
					</td >
					<td class=\"td-shadows-right\"></td>
					</tr>
					<tr>
					<td class=\"td-shadows-bottom\"></td>
					<td class=\"td-shadows-bottomright\">
					</td>
					
					</tr>
					<tr><td width = 50>$username</td></tr>
					</table><!--end of  table shadows-->
					

					</td><td><a href=\"javascript:void(null);\"onclick =\"xajax_invite($fromid,$memberid);\">Send a Friend Request</a></td>";//end of echo
					//if no if col = 5 then new row
						if(($S %3 )==0 &&($S+1)!==1 )
							$msg.="</tr><tr>";
							
							
			}//for
			$msg.="</tr><table>";
			//############## End of display stuff
			// how many rows we have in database 
				$query="select  COUNT(*) AS numrows from member,album where 
				member.UserName like '%$membername%' and member.Country like '%$country%'
	and album.AlbumName like '%$albumname%'";
				
		$result  = mysql_query($query) or die('Error, query failed'); 
				$row     = mysql_fetch_array($result, MYSQL_ASSOC); 
				$numrows = $row['numrows'];
				
				// how many pages we have when using paging? 
				
				$maxPage = ceil($numrows/$rowsPerPage);
				//#################################### 
				// creating 'previous' and 'next' link 
				if ($pageNum > 1) 
						{ 
							$page = $pageNum -1; 
							$prev="<input type=\"button\" name=\"prev\" onclick =\"xajax_SearchMember($aFormValues,$page);\" value=\"Prev\">"; 

							$first = "<input type=\"button\" name=\"first\" onclick =\"xajax_SearchMember($aFormValues,1);\" value=\"First\">";  

						} 
				else 
						{ 
							$prev  = ' ';       // we're on page one, don't enable 'previous' link 
							$first = '  '; // nor 'first page' link 
						} 

				// print 'next' link only if we're not 
				// on the last page 
				if ($pageNum < $maxPage) 
						{ 
						$page = $pageNum + 1; 
						$next = "<input type=\"button\" name=\"next\"onclick=\"xajax_SearchMember($aFormValues,$page);\"value=\"Next\">";  
						$last = "<input type=\"button\" name=\"Last\"onclick=\"xajax_SearchMember($aFormValues,$maxPage);\"value=\"Last\">";   
 
						} 
				else 
						{ 
						$next = '  ';      // we're on the last page, don't enable 'next' link 
						$last = '  '; // nor 'last page' link 
						} 
				// print the page navigation link	
				$msg.=$first . $prev . " Page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages " . $next . $last; 				
			
 	

			$objResponse->addAssign("mytable","innerHTML",$msg);
			//$objResponse->addAssign("but","innerHTML",$but);
				
				
				}//else
				
	}//if
	
	return $objResponse->getXML();
	}//function
?>