<?php

function GetSitespath($siteid)

{

$query="SELECT images.Url FROM images,imagetakeninsites where images.ImageId=imagetakeninsites.ImageId and imagetakeninsites.SiteId=$siteid";
	
	$result=mysql_query($query)or die('error here');
	
	$num=mysql_numrows($result);
	//check
	$msg;
	if($num==0)
	
		$msg= "No Records founds";
		else
		
		{
	
	


	$Url=mysql_result($result,$num-1,"images.Url");
	
	$msg="/Images/".$Url;
	

}//else
	return $msg;
	
	
	

}



	function Getlocation($siteid)
		{
			$query="SELECT *  FROM location ,locationcontainsites where location.LocationId =locationcontainsites.LocationId and 

locationcontainsites.SiteId=$siteid";

	
	$result=mysql_query($query)or die('error here');
	
	$num=mysql_numrows($result);
	//check
	$msg;
	if($num==0)
	
		$msg= "No Records founds";
		else
		
		{
	
	


	$location = mysql_result($result,$num-1,"location.Country");
	
	$msg=$location;
	

}//else
	return $msg;


}//end 
function DisplaySites($jumpto)

{
$objResponse = new xajaxResponse();
	// how many rows to show per page 
	$rowsPerPage = 4;
	
	// if $jumpto  defined, use it as page number 
	if($jumpto!="") 
 
			$pageNum = $jumpto;
	else
			// by default show first page 
			$pageNum = 1;
	$start = ($pageNum -1) * $rowsPerPage;
	
	// enter  query and display stuff
	
	$objResponse->addAssign("title1","innerHTML","Sites");
	if($orderby =="")
	{$query="select * from sites limit $start, $rowsPerPage";
	}
	
	//assign variable to another variable
	
	$result=mysql_query($query)or die(mysql_error());
	$num=mysql_numrows($result);
	$msg;
	if($num==0)
		{$msg= "No Records founds";
		$objResponse->addAssign("table","innerHTML",$msg);
		}
	else
		{
			
			
			//create a table to display events pictures now
			$msg.="<table class=\"table-wrapper\">";//echo
			

			for($S=0;$S<$num;$S++)
				{	//get path of image
					$path= GetSitespath(mysql_result($result,$S,"sites.SiteId"));
					
					//get des of events
					$description= mysql_result($result,$S,"sites.Description");
					//get name of events
					$sitesName=mysql_result($result,$S,"sites.SiteName");
					//get datecreated of image
					
					//eventsid
					$Located =Getlocation(mysql_result($result,$S,"sites.SiteId"));
					$siteId = mysql_result($result,$S,"sites.SiteId");
					
					
					$msg.="<tr><td rowspan=\"3\">";//end of echo
					
					$msg.="<table class=\"table-shadows\" >
					<tr>
					<td class=\"td-shadows-main\">
    		
					<a href=\"javascript:void(null);\"onclick=\"xajax_viewAlbumsInSites($siteId,'')\" >";//end of echo
					//GetImage path 
					$msg.="<IMG SRC=\".$path\"width=100 height=100
					align=bottom alt=$sitesName>
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
					

					</td>
					
					
					<td class=\"Register\">Name $sitesName</td></tr>
					
					<td class=\"Register\">Description $description</td></tr>
					<tr ><td class=\"Register\">$Located</td></tr>";//end of echo	
			}//for
			$msg.="<table>";
			//############## End of display stuff
			// how many rows we have in database 

		$query="select  COUNT(*) AS numrows from sites";
				
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
							$prev="<input type=\"button\" name=\"prev\" onclick =\"xajax_DisplaySites($page);\" value=\"Prev\">"; 

							$first = "<input type=\"button\" name=\"first\" onclick =\"xajax_DisplaySites(1);\" value=\"First\">";  

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
						$next = "<input type=\"button\" name=\"next\"onclick=\"xajax_DisplaySites($page);\"value=\"Next\">";  
						$last = "<input type=\"button\" name=\"Last\"onclick=\"xajax_DisplaySites($maxPage);\"value=\"Last\">";   
 
						} 
				else 
						{ 
						$next = '  ';      // we're on the last page, don't enable 'next' link 
						$last = '  '; // nor 'last page' link 
						} 
				// print the page navigation link	
				$msg.=$first . $prev . " Page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages " . $next . $last; 				
			
			//*********now display a select box in div orderby*********//
				
			//****************END******************//

			$objResponse->addAssign("table","innerHTML",$msg);
			
			
		}//else
		return $objResponse->getXML();

}

?>
