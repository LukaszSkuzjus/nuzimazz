<?php
function createEventView($Eventid,$jumpto)

 {if ($Eventid=="")
$Eventid= $_SESSION['historyid'];
 //show all pics in this category of events
 
 $_SESSION['EventID']=$Eventid;
 $_SESSION['empty']=$Eventid;
	$objResponse = new xajaxResponse();
	// how many rows to show per page 
	$rowsPerPage = 15;
	
	// if $jumpto  defined, use it as page number 
	if($jumpto!="") 
 
			$pageNum = $jumpto;
	else
			// by default show first page 
			$pageNum = 1;
	$start = ($pageNum -1) * $rowsPerPage;
	
	// enter  query and display stuff
	$slideshowlink="<td width = 250><a href=\"slideshowAjax/slideshow.php?Eventid=$Eventid\"target=\"_blank\" >slideshow</a></td></tr><table>";
	$objResponse->addAssign("title1","innerHTML","Event");
	//$objResponse->addAssign("option","innerHTML",$slideshowlink);
	//show back button
	$backlink="<table ><tr><td><a href=\"javascript:void(null);\" onclick =\"xajax_showRegister();xajax_hideRegisterForm();
xajax_DisplayEvents('','');\">Back&nbsp;&nbsp;</a></td>";
$backlink.=$slideshowlink;
	$objResponse->addAssign("option","innerHTML",$backlink);
	$query="select * from images ,Eventcontainsimages,Event where
	images.ImageId=Eventcontainsimages.ImageId and 
	Eventcontainsimages.EventId=Event.EventId and Event.EventId =$Eventid limit $start, $rowsPerPage";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	$msg;
	if($num==0)
		{$msg= "No Records founds";
		$objResponse->addAssign("table","innerHTML",$msg);
		}
	else
		{
			//display Event Name
			$EventName= mysql_result($result,0,'Event.EventName');
			//display Creation Date
			$Date = mysql_result($result,0,'Event.CreationDate');
			//display description of Event
			$des= mysql_result($result,0,'Event.Description');
			//display no of times viewed
			//call function GetViewed($Eventid)
			$view =GetViewed($Eventid);
			
			////display owername
			//call function	GetOwner($Eventid)
			$owner =GetOwner($Eventid);
			//create a table to display Event details first
			$msg="<table ><tr >";//end of echo
			
			$msg.= "<td class =\"td-thumbnails-navi\">Event Name :$EventName</td></tr>";
			$msg.= "<tr><td class =\"td-thumbnails-navi\">Created on :$Date</td></tr>";
			$msg.= "<tr><td class =\"td-thumbnails-navi\">Description :$des</td></tr>";
			$msg.= "<tr><td class =\"td-thumbnails-navi\">Viewed :$view</td></tr>";
			$msg.= "<tr><td class =\"td-thumbnails-navi\">Owned by :$owner</td></tr>";
			
			$msg.= "</table>";	
			
			//create a table to display Event pictures now
			$msg.="<table class=\"table-wrapper\">";//echo
			$msg.="<tr>";//end of echo

			for($S=0;$S<$num;$S++)
				{	//get path of image
					$path="Images/";
					$path .= mysql_result($result,$S,"images.Url");
					//get des of image
					$imgdescription= mysql_result($result,$S,"images.Description");
					//get dateuploaded of image
					$dateUploaded=mysql_result($result,$S,"images.DateUploaded");
					//get name of image
					$ImgName=mysql_result($result,$S,"images.ImageName");
					//get datecreated of image
					
					$imageId=mysql_result($result,$S,"images.ImageId");
				
					$msg.="<td>
				
					
					";
					$msg.="<table class=\"table-shadows\" >
					<tr>
					<td class=\"td-shadows-main\">
    		
					<a href=\"javascript:void(null);\"onclick=\"xajax_GetAllPictureDetails($imageId);xajax_GetImageComments($imageId,'','');xajax_RateImage($imageId);\" >";//end of echo
					//GetImage path 
					$msg.="<IMG SRC=\"".$path."\"width=150 height=160 
					align=bottom alt=$ImgName>
					</a>
					</td>
					<td class=\"td-shadows-right\"></td>
					</tr>
					<tr>
					<td class=\"td-shadows-bottom\"></td>
					<td class=\"td-shadows-bottomright\">
					</td>
					</tr>
					
					</table><!--end of  table shadows-->
					

					</td>";//end of echo
					//if no if col = 5 then new row
						if(($S %3 )==0 &&($S+1)!==1 )
							$msg.="</tr><tr>";
							
							
			}//for
			$msg.="</tr><table>";
			//############## End of display stuff
			// how many rows we have in database 

		$query="select  COUNT(*) AS numrows from images ,Eventcontainsimages,Event where
				images.ImageId=Eventcontainsimages.ImageId and 
				Eventcontainsimages.EventId=Event.EventId and Event.EventId =$Eventid ";
				
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
							$prev="<input type=\"button\" name=\"prev\" onclick =\"xajax_createEventView($Eventid,$page);\" value=\"Prev\">"; 

							$first = "<input type=\"button\" name=\"first\" onclick =\"xajax_createEventView($Eventid,1);\" value=\"First\">";  

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
						$next = "<input type=\"button\" name=\"next\"onclick=\"xajax_createEventView($Eventid,$page);\"value=\"Next\">";  
						$last = "<input type=\"button\" name=\"Last\"onclick=\"xajax_createEventView($Eventid,$maxPage);\"value=\"Last\">";   
 
						} 
				else 
						{ 
						$next = '  ';      // we're on the last page, don't enable 'next' link 
						$last = '  '; // nor 'last page' link 
						} 
				// print the page navigation link	
				$msg.=$first . $prev . " Page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages " . $next . $last; 				
			if(isset($_SESSION[Login]))
			{
			
			$msg.="<table><tr><td class =\"td-thumbnailsHeader\"><input type=\"image\" src=\"css/SampleAnimation.gif\" name=\"User comments\"width=80 height=70 onclick=\"xajax_GetComments($Eventid,'','');\"alt=\"view users comments\">Comments</td>
			</tr></table>";
			}
	
 	

			$objResponse->addAssign("table","innerHTML",$msg);
			//$objResponse->addAssign("but","innerHTML",$but);
		}//else
		return $objResponse->getXML();
}//end of function
////////////////////////////////

?>