<?php
session_start();
 include("dbinfo.inc.php");
 
 require ('xajax.inc.php');

 //current user  id on this page is assumbed to be 2 if he is not a member
 //id 2 refers to guest
 //check if user is login
 if(isset($_SESSION['Login'])&& $_SESSION['Login']==true)
 $userid = $_SESSION['userId'];

 function GetComments($albumid,$jumpto,$commentsid)
 {$_SESSION['ALBUMID']=$albumid;
	$objResponse = new xajaxResponse();
	// how many rows to show per page 
	$rowsPerPage = 5;
	/////so as to access it in home.php

	////
	// if $jumpto  defined, use it as page number 
	if($jumpto!="") 
 
			$pageNum = $jumpto;
	else
			// by default show first page 
			$pageNum = 1;
 
 
	$start = ($pageNum -1) * $rowsPerPage;
	// enter  query and display stuff
	
	if($commentsid==""){
 $query="select member.F_Name,comments.Comments,comments.Date,member.Member_Id
		from comments, member ,postalbumcomments where 
		comments.CommentId= postalbumcomments.CommentId and 
		postalbumcomments.MemberId=member.Member_Id and
		postalbumcomments.AlbumId =$albumid limit $start, $rowsPerPage";
  }
  else
  {		$query="select member.F_Name,comments.Comments,comments.Date,member.Member_Id
		from comments, member ,postalbumcomments where 
		comments.CommentId= postalbumcomments.CommentId and 
		postalbumcomments.MemberId=member.Member_Id and
		postalbumcomments.AlbumId =$albumid  and comments.CommentId=$commentsid limit $start, $rowsPerPage";
  }
		$result=mysql_query($query);
		$num=mysql_numrows($result);
  $msg;
		if($num==0)
			{
			$msg= "No comment written on this album";
			$msg.="<p><input type=\"button\" name=\"hideme\" value=\"Post a Comment\"
				onclick=\"xajax_postcomment();\" /></p></td></tr>";
			$objResponse->addAssign("comments","innerHTML",$msg);
			}
			else
			{
				$msg="<table class=\"table-wrapper-comment\"id=\"comment\" >";
				//$msg.="<tr><td  class =\"td-thumbnailsHeader\">Comments<td></tr>";

				for($i=0;$i<$num;$i++)
				{	$date =mysql_result($result,$i,'comments.Date');

					$member=mysql_result($result,$i,'member.F_Name');
					$comment =mysql_result($result,$i,'comments.Comments');

					$msg.="<tr><td class=\" td-comments\">
					<br>";
					$msg.="<p>On $date, $member wrote :</p>

					</td></tr>
					<tr><td class =\"td-commentcell\">
					$comment</td></tr>";



				}//for
				$msg.="<tr><td class=\" td-comments\">
				<br>";
				$msg.="<p><input type=\"button\" name=\"hideme\" value=\"Hide Comments\"
				onclick=\"xajax_hide();\" /><input type=\"button\" name=\"hideme\" value=\"Post a Comment\"
				onclick=\"xajax_postcomment();\" /></p></td></tr>";
				//############## End of display stuff
				///DECLARING A SESSION VARIABLE to be used in the page home.php
				$_SESSION['ALBUMID']=$albumid;
				// how many rows we have in database 	
				$query="select COUNT(*) AS numrows
				from comments, member ,postalbumcomments where 
				comments.CommentId= postalbumcomments.CommentId and 
				postalbumcomments.MemberId=member.Member_Id and
				postalbumcomments.AlbumId =$albumid";	
				
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
							$prev="<input type=\"button\" name=\"prev\" onclick =\"xajax_GetComments($albumid,$page,'');\" value=\"Prev\">"; 

							$first = "<input type=\"button\" name=\"first\" onclick =\"xajax_GetComments($albumid,1,'');\" value=\"First\">";  

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
						$next = "<input type=\"button\" name=\"next\"onclick=\"xajax_GetComments($albumid,$page,'');\"value=\"Next\">";  
						$last = "<input type=\"button\" name=\"Last\"onclick=\"xajax_GetComments($albumid,$maxPage,'');\"value=\"Last\">";   
 
						} 
				else 
						{ 
						$next = '  ';      // we're on the last page, don't enable 'next' link 
						$last = '  '; // nor 'last page' link 
						} 
				// print the page navigation link
				$msg.="<tr><td class=\" td-comments\">$first  $prev   Page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages   $next  $last</td></tr></table>"; 
				$objResponse->addAssign("comments","className","");
				$objResponse->addAssign("comments","innerHTML",$msg);
			}//else
	return $objResponse->getXML();
 }//function
 //function for getting no of times the album has been viewed
 //paramenter =albumid
 
 
 function hide()
 { $objResponse = new xajaxResponse();
 $objResponse->addAssign("comments","className","hidemsg");
 return $objResponse->getXML();
 }
 
 function hideform($formobj)
 { $objResponse = new xajaxResponse();
 $objResponse->addAssign($formobj,"className","hidemsg");
 return $objResponse->getXML();
 }
  //xajax_postcomment($userid,$albumid)
  function postcomment()
  {/*show form;*/	
	$objResponse = new xajaxResponse();
	$objResponse->addAssign("formcomments","className","showmsg");
	return $objResponse->getXML();
	}//end of function
	
	
   function showDiv($objDiv,$msg)
  {/*show div;*/	
	$objResponse = new xajaxResponse();
	$objResponse->addAssign("title1","innerHTML",$msg);
	$objResponse->addAssign($objDiv,"className","");

	return $objResponse->getXML();
  }//end of function
  
  
  //function to get uers comments
   function EnterUserComments($formValues)
		{//1st check form values
	$albumid=$_SESSION['ALBUMID'];
		$objResponse=new xajaxResponse();
		global $userid;
		$last=0;
		//check if user has enter the comment
		if(trim($formValues['ucomment'])=="")
		{ 
			$objResponse->addAlert("Comment not entered");
			}
		else//comment entered
		{
			//assign formvalues to a variable;
			$Data =  trim($formValues['ucomment']);
			//enter comments in table comments
			//get the last comment id first
			//insert the comment
		$today = date("Y-m-d");
			$query = "INSERT INTO comments VALUES ('','$Data','$today')";
			mysql_query($query)or die(mysql_error());
					
			$query="select CommentId from comments";
			$result=mysql_query($query)or die(mysql_error());
			$num= mysql_numrows($result);
			if($num!=0)
			{
			$last =mysql_result($result,$num-1,"CommentId");
			}//if
														
		//update table post albumcomments.Here i need  memberid, albumid, commentid
		$query2 ="INSERT INTO postalbumcomments VALUES ('$userid','$albumid','$last')";
											
		mysql_query($query2)or die(mysql_error());
		//now we show the user his comment
		$objResponse->addAssign("formcomments","className","hidemsg");
		$objResponse->loadXML(GetComments($albumid,'',$last));
	//GetComments($albumid,'',$last);
		
		}//else
		return $objResponse->getXML();
		}//end of function											
							
		function loadArrayTag()
{
$objResponse=new xajaxResponse();
$query = "select Description from images";
$result=mysql_query($query);
$num=mysql_numrows($result);
if ($num)
{
$myarray = array();
for($i = 0;$i<$num;$i++)
	{

	$myarray[] = mysql_result($result,$i,'images.Description');
	}//for
}//if
$objResponse->addScriptCall("myJSFunction",$myarray);
return $objResponse->getXML();
}		
							
									
		
  
 $xajax = new xajax();
//$xajax->debugOn(); 
//rating functions
$xajax->registerExternalFunction("RateImage","Rate.php");//functionto rate image
$xajax->registerExternalFunction("RateAlbum","Rate.php");//functionto rate album
//end of rating functions
$xajax->registerExternalFunction("GetAllPictureDetails","imageDetails/picturedetails.php");//function to get more image details
//Image details related functions
$xajax->registerExternalFunction("GetImageComments","imageDetails/picturedetails.php");
$xajax->registerExternalFunction("postimagecomment","imageDetails/picturedetails.php");
$xajax->registerExternalFunction("showImageCommentDIV","imageDetails/picturedetails.php");
$xajax->registerExternalFunction("EditImagecomment","imageDetails/picturedetails.php");
$xajax->registerExternalFunction("DeleteImagecomment","imageDetails/picturedetails.php");//delete an image comment
//function to hide div imagecomments

$xajax->registerExternalFunction("HideImageCommentDIV","imageDetails/picturedetails.php");
$xajax->registerExternalFunction("HideImageEditFormDIV","imageDetails/picturedetails.php");
$xajax->registerExternalFunction("HideImageDetailDiv","clear.php");
$xajax->registerExternalFunction("showImageDetailDiv","clear.php");

$xajax->registerExternalFunction("EditImageEvent","imageDetails/picturedetails.php");
$xajax->registerFunction("GetComments");
$xajax->registerFunction("showDiv");
$xajax->registerFunction("hide");
$xajax->registerExternalFunction("createAlbumView","other.php");//function in other page
//$xajax->registerFunction("createAlbumView");
$xajax->registerFunction("EnterUserComments");

//function for events
$xajax->registerExternalFunction("DisplayEvents","Events/DisplayEvents.php");

$xajax->registerExternalFunction("createEventAlbumView","createEventview.php");//create a view of all pics in a particular event
$xajax->registerExternalFunction("AlbumEvent","Events/AlbumEvents.php");

///functions for places
$xajax->registerExternalFunction("DisplaySites","sites/DisplaySites.php");
$xajax->registerExternalFunction("createSiteAlbumView","createSiteView.php");
$xajax->registerExternalFunction("viewAlbumsInSites","sites/ViewAlbumInSites.php");

$xajax->registerFunction("hideform");
$xajax->registerFunction("postcomment");

//register the functions on the page process.php
 //require("process.php");
   $xajax->registerExternalFunction("hideRegisterForm","clear.php");//function to hide the registration form when search option is activated
  $xajax->registerExternalFunction("showsearch","clear.php");//function to search
 $xajax->registerExternalFunction("ShowGallery","clear.php");//function to clear all divs
 $xajax->registerExternalFunction("showAlbums","clear.php");//function to show albums galleries
 
 $xajax->registerExternalFunction("showRegister","clear.php");//function to clear 
  $xajax->registerExternalFunction("hideUserAccount","clear.php");//function to clear div usera ccount
  $xajax->registerExternalFunction("showUserAccount","clear.php");//function to clear  and show user account

$xajax->registerExternalFunction("processForm","Register/process.php");//function in other page
$xajax->registerExternalFunction("check","Register/process.php");//function in other page
//ratings of images

//display list of albums

$xajax->registerExternalFunction("DisplayAlbums","select_album/selectalbum.php");//function to display list of albums
//functions for members

$xajax->registerExternalFunction("DisplayMembers","Members/DisplayMembers.php");//function to display list of members
$xajax->registerExternalFunction("AlbumOwnbyMember","Members/MemberDetails.php");//function to display list of members
$xajax->registerExternalFunction("UserInGroup","Members/MemberDetails.php");//function to display list of members

//***************************
//function for login

$xajax->registerExternalFunction("processlogin","Sign_In/signin.php");//function to login member
$xajax->registerExternalFunction("processlogout","Sign_In/signin.php");
$xajax->registerExternalFunction("hideformlogin","Sign_In/signin.php");//clear form login
$xajax->registerExternalFunction("checkstatus","Sign_In/signin.php");//check status if login

/////*********search function of Avishake.*******


$xajax->registerExternalFunction("ListRelated","search/Search.php");//function in other page
$xajax->registerExternalFunction("processData","search/Search.php");//function in other page
$xajax->registerExternalFunction("display","search/functions.php");//function in other page

////////********end of registration of avishake functions

///home page

$xajax->registerExternalFunction("showHome","clear.php");//function in other page
$xajax->registerExternalFunction("createHomeAlbumview","HomeAlbumsView.php");//function in other page

//register function for member
$xajax->registerExternalFunction("DisplayMembers","Members/Select_member.php");//function in other page
$xajax->registerExternalFunction("viewAlbumOfMem","Members/CreateMemAlbumview.php");//function in other page
$xajax->registerExternalFunction("createMemAlbumView","createMemView.php");//function in other page

 
$xajax->registerFunction("loadArrayTag");//loads a php arrat to a js array-- in home.php

$xajax->processRequests();
 

 echo"
<link rel=\"Stylesheet\" href=\"icons/spgm_style.css\" />
";
 
mysql_close();
?>

<script type="text/javascript" src="slider.js"></script>
<script type="text/javascript" src="javascript/lib/LibCrossBrowser.js"></script>
<script type="text/javascript" src="javascript/lib/EventHandler.js"></script>
<script type="text/javascript" src="javascript/core/form/Bs_FormUtil.lib.js"></script>
<script type="text/javascript" src="javascript/core/gfx/Bs_ColorUtil.lib.js"></script>
<script type="text/javascript" src="javascript/components/slider/Bs_Slider.class.js"></script>


