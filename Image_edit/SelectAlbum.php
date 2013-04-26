<?php
session_start();
$_SESSION["Status"]=0;
 include("dbconn.php");
require ('../xajax.inc.php');
include("../dbinfo.inc.php");

 $memid=$_SESSION['userId'];
$_SESSION["userid"]=$memid;


function viewuseralbums($userid,$jumpto)
	{//list all the albums owned by the user
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

			$query = "select * from album, ownalbum where album.AlbumId =ownalbum.AlbumId and ownalbum.OwnerId ='$userid' limit $start, $rowsPerPage";
			$result=mysql_query($query)or die(mysql_error());
			$count =mysql_numrows($result);
			$msg;
			if($count==0)
			{$msg= "No Records founds";
				$objResponse->addAssign("mytable","innerHTML",$msg);
		
			}
				else{
				
				//create a table to display album pictures now
					$msg.="<table class=\"table-wrapper\">";//echo
					$msg.="<tr>";//end of echo
					for($S=0;$S<$count;$S++)
		
						{
							$albumid =mysql_result($result,$S,"album.AlbumId");
							$albumname= mysql_result($result,$S,"album.AlbumName");
							//now display the album pic
							//1st get the image path of the pic
							// call a function Getpath2
							$path = Getpath2($albumid);
							// now display the album


						//3 by 2


		
	
			
			

			
					
					$msg.="<td>";
				
					
				
				$msg.="<table class=\"table-shadows\" >
					<tr>
					<td class=\"td-shadows-main\">
    		
					<a href=\"javascript:void(null);\"onclick = \"xajax_createAlbumView($albumid,''); \" >";//end of echo
					//GetImage path 
					$msg.="<IMG SRC=\"".$path."\"width=150 height=160>
					</a>
					</td >
					<td class=\"td-shadows-right\"></td>
					</tr>
					<tr>
					<td class=\"td-shadows-bottom\"></td>
					<td class=\"td-shadows-bottomright\">
					</td>
					
					</tr>
					<tr><td width = 50 class =\"mytext_account\">$albumname</td></tr>
					</table><!--end of  table shadows-->
					

					</td>";//end of echo
					//if no if col = 5 then new row
						if(($S %5 )==0 &&($S+1)!==1 )
							$msg.="</tr><tr>";
							
							
			}//for
			$msg.="</tr><table>";
			//############## End of display stuff
			// how many rows we have in database 

		$query="select  COUNT(*) AS numrows from album, ownalbum 
		where album.AlbumId =ownalbum.AlbumId and ownalbum.OwnerId ='$userid'";
				
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
							$prev="<input type=\"button\" name=\"prev\" onclick =\"xajax_viewuseralbums($userid,$page);\" value=\"Prev\">"; 

							$first = "<input type=\"button\" name=\"first\" onclick =\"xajax_viewuseralbums($userid,1);\" value=\"First\">";  

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
						$next = "<input type=\"button\" name=\"next\"onclick=\"xajax_viewuseralbums($userid,$page);\"value=\"Next\">";  
						$last = "<input type=\"button\" name=\"Last\"onclick=\"xajax_viewuseralbums($userid,$maxPage);\"value=\"Last\">";   
 
						} 
				else 
						{ 
						$next = '  ';      // we're on the last page, don't enable 'next' link 
						$last = '  '; // nor 'last page' link 
						} 
				// print the page navigation link
				$msg.="<div class =\"mytext_account\">";
				$msg.=$first . $prev . " Page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages " . $next . $last; 				
				$msg.="</div>";
 	

			$objResponse->addAssign("mytable","innerHTML",$msg);
			//$objResponse->addAssign("but","innerHTML",$but);
		}//else
		return $objResponse->getXML();
}//end of function

function Getpath2($albumid)
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

	$msg="../Images/".$Url;


}//else
	return $msg;

	}//end of function
	function createAlbumView($albumid,$jumpto)

 {

 
 
 
 
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
	
	$query="select * from images ,albumcontainsimages,album where
	images.ImageId=albumcontainsimages.ImageId and 
	albumcontainsimages.AlbumId=album.AlbumId and album.AlbumId =$albumid limit $start, $rowsPerPage";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	$msg;
	if($num==0)
		{$msg= "No Records founds";
		$objResponse->addAssign("mytable","innerHTML",$msg);
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
			
			
			
			//create a table to display album details first
			$msg="<table ><tr >";//end of echo
			
			$msg.= "<td class =\"td-thumbnails-navi\">Album Name :$AlbumName</td></tr>";
			$msg.= "<tr><td class =\"td-thumbnails-navi\">Created on :$Date</td></tr>";
			$msg.= "<tr><td class =\"td-thumbnails-navi\">Description :$des</td></tr>";
			
		
			
			$msg.= "</table>";	
			
			//create a table to display album pictures now
			$msg.="<table class=\"table-wrapper\">";//echo
			$msg.="<tr>";//end of echo

			for($S=0;$S<$num;$S++)
				{	//get path of image
					$path="../Images/";
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
    		
					<a href=\"ImageZoom.php?ImgId=$imageId\" >";//end of echo
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
						if(($S %4 )==0 &&($S+1)!==1 )
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
		
	
 	

			$objResponse->addAssign("mytable","innerHTML",$msg);
			//$objResponse->addAssign("but","innerHTML",$but);
		}//else
		return $objResponse->getXML();
}//end of function
////////////////////////////////
	
	$xajax = new xajax();
	$xajax->registerFunction("viewuseralbums");
	$xajax->registerFunction("createAlbumView");
	
	$xajax->processRequests();
?>
<html><head><?php $xajax->printJavascript("../"); ?><title>Select Album</title>
<link href="../css/style.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../icons/spgm_style.css" />
</head><body onload = "xajax_viewuseralbums(<?php echo $memid ; ?>,'');">


<!--Start of footer table-->



<table id="wapper" border=0>
 <tr>
       <td id="topleft">&nbsp;</td>
       <td id="top">&nbsp;</td>
       <td id="topright">&nbsp;</td>
     </tr>


<tr><td id="left"></td>

<td id="logocenter">
       <p><span id="title">&nbsp;Select Album</span></p>
	<div id = "mytable"></div>
	
	
       </td>


       <td id="right">&nbsp;</td>
     </tr>
     <tr>
       <td id="bottomleft">&nbsp;</td>
       <td id="bottom">&nbsp;</td>
       <td id="bottomright">&nbsp;</td>
     </tr>
</table>


<!--End of footer table-->


<br>
<?php






     





?>
</body>
</html>