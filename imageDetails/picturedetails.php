<?php

session_start();
require ("Editcomments.php");
include( "./Ratings/Ratingsystem.php");
 

function GetAllPictureDetails($imageid)

{	/*    Show image in larger dimension
		show link of Image edit tool if owner of image == user
		calls function No of times viewed	
		calls function to rate image only if user is a member
		call function to show similar images
		show comments posted on this image
		post comments
		*/


	$objResponse = new xajaxResponse();

		$query="select * from images where imageId ='$imageid'";
		$result=mysql_query($query)or die(mysql_error());
		$num=mysql_numrows($result);
		$msg;
		if($num==0)
		{$msg= "No Records founds";
			$objResponse->addAssign("imageDetails","innerHTML",$msg);
		}//if
		
		else{
		
		//displayimageName
			$ImgName= mysql_result($result,0,'images.ImageName');
			//display Creation Date
			
			//display description of album
			$des= mysql_result($result,0,'images.Description');
			//display Date uploaded
			$Dateuploaded = mysql_result($result,0,'images.DateUploaded');
			//display no of times viewed
			//call function get times of image viewed
			$viewedTimes =GetViewed($imageid);
		//get path of image
					$path="./Images/";
					$path .= mysql_result($result,0,"images.Url");
		$rating = showCurrentRating($imageid);
		//Draw table
		
		$msg.="<table class=\"table-shadows\" >
		<tr>
		<td class=\"td-shadows-main\"><a href=\"javascript:void(null);\" >";
		//GetImage path 
		$msg.="<IMG SRC=\"".$path."\"width=220 height=230
		align=bottom alt=$ImgName>
		</a></td>
					<td class=\"td-shadows-right\"></td>
					</tr>
					<tr>
					<td class=\"td-shadows-bottom\"></td>
					<td class=\"td-shadows-bottomright\">
					</td>
					</tr>
					<!--end of  table shadows-->
					</table>";
					
					

		
		$msg.="<table>
		
		<tr><td width =150 class =\"td-thumbnails-navi\">Name:$ImgName</td></tr>
		<tr><td width =150 class =\"td-thumbnails-navi\">Description:$des</td></tr>
		
		<tr><td width =150 class =\"td-thumbnails-navi\">Date Uploaded:$Dateuploaded </td></tr>
		<tr><td width =150 class =\"td-thumbnails-navi\">viewed:$viewedTimes</td></tr>
		
		<tr><td width =150 class =\"td-thumbnails-navi\">$rating";//end
		if(isset($_SESSION['Login'])&& isset($_SESSION['userId']))
			{
		$msg.="<a href = \"javascript:void(null);\"onclick =\"window.open('Ratings/Ratingform.php?imageid=$imageid&userid=$_SESSION[userId]','Rating','width=250,height=150,left=50,top=100,scrollbars=no');\"> Rate</a>";
		}
		else $msg.="</td></tr>
		
		<!--//table to show the options-->
		
		
		
		<tr><td></td></tr>
		
		<tr><td></td></tr>
		
		
		
		</table>";
		
		//load function GetImageComments($imageid,$jumpto,$commentsid)
		//$objResponse->loadXML(GetImageComments($imageid,'',''));
		$objResponse->addAssign("imageDetails","innerHTML",$msg);
		}//else
		
		return $objResponse->getXML();
}//end of function
function GetViewed($imageid)
 {
	$query="select view.Times from view,viewimage where view.ViewId=viewimage.ViewId 
	and viewimage.ImageId =$imageid ";
	
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	if($num==0)
		$view= 0;
	else $view =mysql_result($result,0,'view.Times');
		return $view;
 }//end of  function
 function GetMemberWhoPostedTheComment($commentid)
 {
 $query = "select MemberId from postimagecomments where CommentId = $commentid";
 
 $result = mysql_query($query) or die('your query failed');
 if($result)
 {$msg = mysql_result($result,0,"MemberId");
 
 }//if
 else $msg ="no result found ";
 return $msg;
 }//emd of func
 
 function GetImageComments($imageid,$jumpto,$commentsid)
 {
	
			

 $objResponse = new xajaxResponse();
 //show comment only if user is login
		if(isset($_SESSION['Login'])&& isset($_SESSION['userId']))
			{
 
 $_SESSION['IMAGEID']=$imageid;
	
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
	
	if($commentsid=="")
	{
 $query="select member.F_Name,comments.Comments,comments.CommentId,comments.Date,member.Member_Id
		from comments, member ,postimagecomments where 
		comments.CommentId= postimagecomments.CommentId and 
		postimagecomments.MemberId=member.Member_Id and
		postimagecomments.ImageId =$imageid limit $start, $rowsPerPage";
  }
  else
  {		$query="select member.F_Name,comments.Comments,comments.CommentId,comments.Date,member.Member_Id
		from comments, member ,postimagecomments where 
		comments.CommentId= postimagecomments.CommentId and 
		postimagecomments.MemberId=member.Member_Id and
		postimagecomments.ImageId = $imageid  and comments.CommentId='$commentsid' limit $start, $rowsPerPage";
  }
  
		$result= mysql_query($query)or die(' Error, your query failed');
		$num=mysql_numrows($result);
  $msg;
  
		if($num==0 && $_SESSION['userId']!="")
		{
		
			
			$msg= "No comment written on this image";
			$msg.="<p><input type=\"button\" name=\"hideme\" value=\"Post a Comment\"
				onclick =\"xajax_showImageCommentDIV();\" /></p></td></tr>";
				$objResponse->addAssign("imagecomments","className","showmsg2");
			$objResponse->addAssign("imagecomments","innerHTML",$msg);
			}
			
			else
			{
				$msg="<table class=\"table-wrapper-comment\"id=\"comment\" >";
				

				for($i=0;$i<$num;$i++)
				{	$date =mysql_result($result,$i,'comments.Date');
					$commentid =mysql_result($result,$i,'comments.CommentId');

					$member=mysql_result($result,$i,'member.F_Name');
					$comment =mysql_result($result,$i,'comments.Comments');

					$msg.="<tr><td class=\" td-comments\">
					<br>";
					$msg.="<p>On $date, $member wrote :</p>

					</td></tr>
					<tr><td width = \"20\" class =\"td-commentcell\">
					$comment</td>";
					//should show the lines below if the user is the one who posted the comment
					$writer =GetMemberWhoPostedTheComment($commentid);
					if($writer ==$_SESSION['userId'])
					{
					$msg.="<tr><td class =\"td-commentcell\"><input type =\"button\" value =\"Edit\" onclick=\"xajax_EditImageEvent($commentid,$imageid);\";>
					
					<input type =\"button\" value =\"Delete\" onclick=\"xajax_DeleteImagecomment($commentid,$imageid)\";>
					</td></tr>";
					}
					else
					{
					$msg.="</tr>";
					}

				}//for
				$msg.="<tr><td class=\" td-comments\">
				<br>";
				$msg.="<p><input type=\"button\" name=\"hideme\" value=\"Hide Comments\"
				onclick=\"xajax_HideImageCommentDIV($imageid);\" /><input type=\"button\" name=\"hideme\" value=\"Post a Comment\"
				onclick=\"xajax_showImageCommentDIV();\" /></p></td></tr>";
				//############## End of display stuff
				
			
				// how many rows we have in database 	
				$query="select COUNT(*) AS numrows
				from comments, member ,postimagecomments where 
				comments.CommentId= postimagecomments.CommentId and 
				postimagecomments.MemberId=member.Member_Id and
				postimagecomments.ImageId =$imageid";	
				
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
							$prev="<input type=\"button\" name=\"prev\" onclick =\"xajax_GetImageComments($imageid,$page,'');\" value=\"Prev\">"; 

							$first = "<input type=\"button\" name=\"first\" onclick =\"xajax_GetImageComments($imageid,1,'');\" value=\"First\">";  

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
						$next = "<input type=\"button\" name=\"next\"onclick=\"xajax_GetImageComments($imageid,$page,'');\"value=\"Next\">";  
						$last = "<input type=\"button\" name=\"Last\"onclick=\"xajax_GetImageComments($imageid,$maxPage,'');\"value=\"Last\">";   
 
						} 
				else 
						{ 
						$next = '  ';      // we're on the last page, don't enable 'next' link 
						$last = '  '; // nor 'last page' link 
						} 
				// print the page navigation link
				$msg.="<tr><td class=\" td-comments\">$first  $prev   Page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages   $next  $last</td></tr></table>"; 
				$objResponse->addAssign("imagecomments","className","showmsg2");
				$objResponse->addAssign("imagecomments","innerHTML",$msg);
			}//else
			}//if
		
			
	return $objResponse->getXML();
 }//function
 
 function postimagecomment($mformValues)
{

		//1st check form values
	$imageid=$_SESSION['IMAGEID'];
		$objResponse=new xajaxResponse();
		if(isset($_SESSION['userId']))
			{
		 $userid =$_SESSION['userId'];
		$last=0;
		//check if user has enter the comment
		if($mformValues =="")
		{ 
			$objResponse->addAlert("Comment not Entered");
			}
		else//comment entered
		{
			//assign formvalues to a variable;
			$Data =  $mformValues;
			//enter comments in table comments
			//get the last comment id first
			//insert the comment
		$today = date("Y-m-d");
			$query = "INSERT INTO comments VALUES ('','$Data','$today')";
			mysql_query($query)or die(mysql_error());
					
			$query="select CommentId from comments";
			$result=mysql_query($query)or die(mysql_error());
			$num= mysql_numrows($result);
			if($num !=0)
			{
			$last =mysql_result($result,$num-1,"CommentId");
			
			
														
		//update table post albumcomments.Here i need  memberid, albumid, commentid
		$query2 ="INSERT INTO postimagecomments VALUES ('$userid','$imageid','$last')";
											
		mysql_query($query2)or die(mysql_error());
		//now we show the user his comment
		$objResponse->addAssign("Form100","className","hidemsg");
		$objResponse->addClear("com2","value");//clear textfield
		$objResponse->loadXML(GetImageComments($imageid,'',$last));
	
		}//if
		}//else
		
		}
		return $objResponse->getXML();
		}//end of function	
	
?>