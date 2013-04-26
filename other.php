<?php
session_start();
///////////////////////////////
function GetViewed($albumid)
 {
	$query2="select view.Times from view,viewalbum where view.ViewId=viewalbum.ViewId 
	and viewalbum.AlbumId =$albumid ";
	
	$result2=mysql_query($query2);
	$num2=mysql_numrows($result2);
	if($num2==0)
		$view= "No Records founds";
	else $view =mysql_result($result2,0,'view.Times');
		return $view;
 }//end of  function
 //////////////////////////////////
 
 //function for getting owner of album
 //takes albumid as parameter
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
 
 ///////////////////////////////////
 
function createAlbumView($albumid,$jumpto)

 {if ($albumid=="")
$albumid= $_SESSION['historyid'];
 
 
 $_SESSION['ALBUMID']=$albumid;
 $_SESSION['empty']=$albumid;
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
	$slideshowlink="<td width = 250><a href=\"slideshowAjax/slideshow.php?albumid=$albumid\"target=\"_blank\" >slideshow</a></td></tr><table>";
	$objResponse->addAssign("title1","innerHTML","Album");
	//$objResponse->addAssign("option","innerHTML",$slideshowlink);
	//show back button
	$backlink="<table ><tr><td><a href=\"javascript:void(null);\" onclick =\"xajax_showRegister();xajax_hideRegisterForm();
xajax_DisplayAlbums('','');\">Back&nbsp;&nbsp;</a></td>";
$backlink.=$slideshowlink;
	$objResponse->addAssign("option","innerHTML",$backlink);
	$query="select * from images ,albumcontainsimages,album where
	images.ImageId=albumcontainsimages.ImageId and 
	albumcontainsimages.AlbumId=album.AlbumId and album.AlbumId =$albumid limit $start, $rowsPerPage";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	$msg;
	if($num==0)
		{$msg= "No Records founds";
		$objResponse->addAssign("table","innerHTML",$msg);
		}
	else
		{
			//display Album Name
			$AlbumName= mysql_result($result,0,'album.AlbumName');
			//display Creation Date
			$Date = mysql_result($result,0,'album.CreationDate');
			//display description of album
			$des= mysql_result($result,0,'album.Description');
			//display no of times viewed
			//call function GetViewed($albumid)
			$view =GetViewed($albumid);
			
			////display owername
			//call function	GetOwner($albumid)
			$owner =GetOwner($albumid);
			//create a table to display album details first
			$msg="<table ><tr >";//end of echo
			
			$msg.= "<td class =\"td-thumbnails-navi\">Album Name :$AlbumName</td></tr>";
			$msg.= "<tr><td class =\"td-thumbnails-navi\">Created on :$Date</td></tr>";
			$msg.= "<tr><td class =\"td-thumbnails-navi\">Description :$des</td></tr>";
			$msg.= "<tr><td class =\"td-thumbnails-navi\">Viewed :$view</td></tr>";
			$msg.= "<tr><td class =\"td-thumbnails-navi\">Owned by :$owner</td></tr>";
			
			$msg.= "</table>";	
			
			//create a table to display album pictures now
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

		$query="select  COUNT(*) AS numrows from images ,albumcontainsimages,album where
				images.ImageId=albumcontainsimages.ImageId and 
				albumcontainsimages.AlbumId=album.AlbumId and album.AlbumId =$albumid ";
				
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
							$prev="<input type=\"button\" name=\"prev\" onclick =\"xajax_createAlbumView($albumid,$page);\" value=\"Prev\">"; 

							$first = "<input type=\"button\" name=\"first\" onclick =\"xajax_createAlbumView($albumid,1);\" value=\"First\">";  

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
						$next = "<input type=\"button\" name=\"next\"onclick=\"xajax_createAlbumView($albumid,$page);\"value=\"Next\">";  
						$last = "<input type=\"button\" name=\"Last\"onclick=\"xajax_createAlbumView($albumid,$maxPage);\"value=\"Last\">";   
 
						} 
				else 
						{ 
						$next = '  ';      // we're on the last page, don't enable 'next' link 
						$last = '  '; // nor 'last page' link 
						} 
				// print the page navigation link	
				$msg.=$first . $prev . " Page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages " . $next . $last; 				
			if(isset($_SESSION['userId']))
			{
			
			$msg.="<table><tr><td class =\"td-thumbnailsHeader\"><input type=\"image\" src=\"css/SampleAnimation.gif\" name=\"User comments\"width=80 height=70 onclick=\"xajax_GetComments($albumid,'','');\"alt=\"view users comments\">Comments</td>
			</tr></table>";
			}
	
 	

			$objResponse->addAssign("table","innerHTML",$msg);
			//$objResponse->addAssign("but","innerHTML",$but);
		}//else
		return $objResponse->getXML();
}//end of function
////////////////////////////////


 
?>

