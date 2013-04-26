<?php


function DisplayAlbums($jumpto,$orderby)
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
	
	$objResponse->addAssign("title1","innerHTML","Albums");
	if($orderby =="")
	{$query="select * from album limit $start, $rowsPerPage";
	}
	if($orderby =="Date")
	{$query="select * from album ORDER BY CreationDate DESC limit $start, $rowsPerPage";
	}
	if($orderby =="View")
	{
	$query="select *from view,viewalbum,album where view.ViewId=viewalbum.ViewId 
	and viewalbum.AlbumId =album.AlbumID ORDER BY Times DESC limit $start, $rowsPerPage";
	
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
					$path=Getpath(mysql_result($result,$S,"album.AlbumId"));
					
					//get des of album
					$description= mysql_result($result,$S,"album.Description");
					//get name of album
					$AlbumName=mysql_result($result,$S,"album.AlbumName");
					//get datecreated of image
					$dateCreated=mysql_result($result,$S,"album.CreationDate");
					//albumid
					$albumId =mysql_result($result,$S,"album.AlbumId");
					//getowner
					$owner=GetOwner($albumId);
					//get viewed
					$viewed =GetViewed($albumId);
					$msg.="<tr><td rowspan=\"3\">";//end of echo
					
					$msg.="<table class=\"table-shadows\" >
					<tr>
					<td class=\"td-shadows-main\">
    		
					<a href=\"javascript:void(null);\"onclick=\"makeHistory(3);xajax_ShowGallery();xajax_createAlbumView($albumId,'');xajax_RateAlbum($albumId);\" >";//end of echo
					//GetImage path 
					$msg.="<IMG SRC=\".$path\"width=100 height=100
					align=bottom alt=$AlbumName>
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
					
					<td class=\"Register\">Name $AlbumName</td></tr>
					<tr ><td class=\"Register\">Viewed $viewed</td>
					<td class=\"Register\">Description $description</td></tr>
					<tr ><td class=\"Register\"></td>
					<td class=\"Register\">Created on $dateCreated</td></tr>";//end of echo	
			}//for
			$msg.="<table>";
			//############## End of display stuff
			// how many rows we have in database 

		$query="select  COUNT(*) AS numrows from album";
				
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
							$prev="<input type=\"button\" name=\"prev\" onclick =\"xajax_DisplayAlbums($page,document.getElementById('orderselect').value);\" value=\"Prev\">"; 

							$first = "<input type=\"button\" name=\"first\" onclick =\"xajax_DisplayAlbums(1,document.getElementById('orderselect').value);\" value=\"First\">";  

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
						$next = "<input type=\"button\" name=\"next\"onclick=\"xajax_DisplayAlbums($page,document.getElementById('orderselect').value);\"value=\"Next\">";  
						$last = "<input type=\"button\" name=\"Last\"onclick=\"xajax_DisplayAlbums($maxPage,document.getElementById('orderselect').value);\"value=\"Last\">";   
 
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
			$objResponse->addAssign("orderby","className","showordertext");
			
		}//else
		return $objResponse->getXML();
}//end of function

function Getpath($albumid)
{
	
	$query="SELECT images.Url FROM images,albumcontainsimages where images.ImageId=albumcontainsimages.ImageId and albumcontainsimages.AlbumId=$albumid";
	
	$result=mysql_query($query);
	
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
	
	}//end of function
	
	function GetOwner($albumid)
 {
	//query for getting owner of album
	$query3="select member.F_Name,member.L_Name from member,ownalbum where member.Member_Id=ownalbum.OwnerId
	and ownalbum.AlbumId =$albumid ";
	$result3=mysql_query($query3);
	$num3=mysql_numrows($result3);
	if($num3==0)
			$owner= "No Records founds";
	else 
		{$owner =" ".mysql_result($result3,0,'member.F_Name');
			$owner.=" ".mysql_result($result3,0,'member.L_Name');					
		}//else
		return $owner;
 }//end of function
 
 
 function GetViewed($albumid)
 {
	$query2="select view.Times from view,viewalbum where view.ViewId=viewalbum.ViewId 
	and viewalbum.AlbumId =$albumid ";
	
	$result2=mysql_query($query2);
	$num2=mysql_numrows($result2);
	if($num2==0)
		$view= "0";
	else $view =mysql_result($result2,0,'view.Times');
		return $view;
 }//end of  function
 
 
 
?>
