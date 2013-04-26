<?php
session_start();

function EditImagecomment($newcomments)
{
$objResponse=new xajaxResponse();
//check if comment is set
if($newcomments =="")
		{ 
			$objResponse->addAlert("Comment not Entered");
		}
else {

//RETRIEVE THE COMMENT ID FORM THE SESSION AND UNSET THE SESSION 
$commentid = $_SESSION['COMMENTID'];

unset($_SESSION['COMMENTID']);
$query = "update comments set Comments = '$newcomments' where CommentId = '$commentid'limit 1";
mysql_query($query)or die('Edit not entered');
//update list comments
$imageid= $_SESSION['IMAGEID'];
$objResponse->loadXML(GetImageComments($imageid,'',''));
//hide edit form
$objResponse->addAssign("imageEditAreaBox","className","hidemsg");
unset($_SESSION['IMAGEID']);
}

return $objResponse->getXML();
}


function DeleteImagecomment($commentid,$imageid)
{

$objResponse=new xajaxResponse();

$query = "Delete from comments where CommentId = '$commentid'LIMIT 1";
 mysql_query($query)or die(mysql_error());
 //reload list of comments
 $objResponse->loadXML(GetImageComments($imageid,'',''));
 
return $objResponse->getXML();
}
function EditImageEvent($commentid,$imageid)
{
//show edit texbox
$objResponse=new xajaxResponse();


$objResponse->addAssign("imageEditAreaBox","className","showmsg2");
//store the comment so tht it is accessible
$_SESSION['COMMENTID']=$commentid;
$_SESSION['IMAGEID']=$imageid;
return $objResponse->getXML();
}

		
function showImageCommentDIV()
{
$objResponse=new xajaxResponse();
$objResponse->addAssign("Form100","className","");
return $objResponse->getXML();
}
function HideImageCommentDIV($imageid)
{
$objResponse=new xajaxResponse();

//show a button to show comments
$msg = "<input type =\"button\" align =center value =\"Show Comments\" onclick=\"xajax_GetImageComments($imageid,'','')\";>";
$objResponse->addAssign("imagecomments","innerHTML",$msg);
return $objResponse->getXML();
}
function HideImageEditFormDIV()

{
$objResponse=new xajaxResponse();

//show a button to show comments

$objResponse->addAssign("imageEditAreaBox","className","hidemsg");
return $objResponse->getXML();

}
?>