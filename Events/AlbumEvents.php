<?php

include('./select_album/selectalbum.php');

function AlbumEvent($jumpto,$EventId)
 {	
 
 //show all the abums in this album
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
	
	$objResponse->addAssign("title1","innerHTML","Albums");
	$backlink="<table ><tr><td><a href=\"javascript:void(null);\" onclick =\"
xajax_DisplayEvents('','');\">Back&nbsp;&nbsp;</a></td>";
$objResponse->addAssign("option","innerHTML",$backlink);
	if($orderby =="")
	{$query=" SELECT *
FROM album, albumcontainsimages, imagetakenonevent
WHERE imagetakenonevent.ImageId = albumcontainsimages.ImageId
AND albumcontainsimages.AlbumId = album.AlbumId
AND imagetakenonevent.EventId =$EventId GROUP BY album.AlbumId
 
 limit $start, $rowsPerPage";
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
			
			
			//create a table to display album pictures now
			$msg.="<table class=\"table-wrapper\">";//echo
			

			for($S=0;$S<$num;$S++)
				{	//get path of image
					$path= Getpath(mysql_result($result,$S,"album.AlbumId"));
					
					//get des of album
					$description= mysql_result($result,$S,"album.Description");
					//get name of album
					$albumName=mysql_result($result,$S,"album.AlbumName");
					//get datecreated of image
					//get datecreated of image
					$dateCreated=mysql_result($result,$S,"album.CreationDate");
					//albumid
					$albumId =mysql_result($result,$S,"album.AlbumId");
					$owner=GetOwner($albumId);
					//get viewed
					$viewed =GetViewed($albumId);
					
					
					$msg.="<tr><td rowspan=\"3\">";//end of echo
					
					$msg.="<table class=\"table-shadows\" >
					<tr>
					<td class=\"td-shadows-main\">
    		
					<a href=\"javascript:void(null);\"onclick=\"xajax_ShowGallery();xajax_createEventAlbumView($albumId,'');xajax_RateAlbum($albumId);\" >";//end of echo
					//GetImage path 
					$msg.="<IMG SRC=\".$path\"width=100 height=100
					align=bottom alt=$albumName>
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
					
					<td class=\"Register\">by $owner</td>
					<td class=\"Register\">Name $albumName</td></tr>
					<tr ><td class=\"Register\">Viewed $viewed</td>
					<td class=\"Register\">Description $description</td></tr>
					<tr ><td class=\"Register\"></td>
					<td class=\"Register\">Created on $dateCreated</td></tr>";//end of echo	
			}//for
			$msg.="<table>";
			//############## End of display stuff
			// how many rows we have in database 

		$query="select  *  FROM album, albumcontainsimages, imagetakenonevent
WHERE imagetakenonevent.ImageId = albumcontainsimages.ImageId
AND albumcontainsimages.AlbumId = album.AlbumId
AND imagetakenonevent.EventId =$EventId GROUP BY album.AlbumId";
				
		$result  = mysql_query($query) or die('Error, query failed'); 
				  
				$numrows = mysql_numrows($result);
				
				// how many pages we have when using paging? 
				
				$maxPage = ceil($numrows/$rowsPerPage);
				//#################################### 
				// creating 'previous' and 'next' link 
				if ($pageNum > 1) 
						{ 
							$page = $pageNum -1; 
							$prev="<input type=\"button\" name=\"prev\" onclick =\"xajax_AlbumEvent($page,$EventId);\" value=\"Prev\">"; 

							$first = "<input type=\"button\" name=\"first\" onclick =\"xajax_AlbumEvent(1,$EventId);\" value=\"First\">";  

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
						$next = "<input type=\"button\" name=\"next\"onclick=\"xajax_AlbumEvent($page,$EventId);\"value=\"Next\">";  
						$last = "<input type=\"button\" name=\"Last\"onclick=\"xajax_AlbumEvent($maxPage,$EventId);\"value=\"Last\">";   
 
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
}//end of function


?>