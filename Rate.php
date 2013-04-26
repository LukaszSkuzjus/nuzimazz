<?php
function  RateImage($imageid)
{
$objResponse = new xajaxResponse();
$query="select view.Times from view,viewimage where view.ViewId=viewimage.ViewId 
	and viewimage.ImageId =$imageid ";
	
	$result=mysql_query($query)or die(mysql_error()); 
	$num=mysql_numrows($result);
	if(!$num==0)
	{$Add =mysql_result($result,0,"view.Times");
	$Add=$Add+1;//increment it
	
	//insert it in the table
	
	$query="update view,viewimage set view.Times =$Add where view.ViewId=viewimage.ViewId 
	and viewimage.ImageId =$imageid ";
	
	$result=mysql_query($query)or die(mysql_error()); 
	}
	
	else
	
	//the record does not exists..need to create the record
	//the image has been viewed 0 time
	{$query="insert into view values ('','1')";
	$result=mysql_query($query)or die(mysql_error()); 
	//maintain the referenciality in table viewimage
	
	//get the last viewid from  table view 
	$query="select view.ViewId from view";
	$result=mysql_query($query)or die(mysql_error()); 
	$num=mysql_numrows($result);
	if($num)
	{
	//retrieve the last row
	$viewid=mysql_result($result,$num-1,"view.ViewId");
	//now
	//maintain the referenciality in table viewimage
	$query="insert into viewimage values ($viewid,$imageid)";
	$result=mysql_query($query)or die(mysql_error()); 
	}//inner if
	}
	return $objResponse->getXML();
}
function  RateAlbum($albumid)
{

$objResponse = new xajaxResponse();
$query="select view.Times from view,viewalbum where view.ViewId=viewalbum.ViewId 
	and viewalbum.AlbumId =$albumid ";
	
	$result=mysql_query($query)or die(mysql_error()); ;
	$num=mysql_numrows($result);
	if(!$num==0)
	{
	$Add =mysql_result($result,0,"view.Times");
	$Add=$Add+1;//increment it
	
	//insert it in the table
	$query="update view,viewalbum set view.Times =$Add where view.ViewId=viewalbum.ViewId 
	and viewalbum.AlbumId =$albumid ";
	
	$result=mysql_query($query)or die(mysql_error()); 
	}
	
	else{
	//the record does not exists..need to create the record
	//the image has been viewed 0 time
	{$query="insert into view values ('','1')";
	$result=mysql_query($query)or die(mysql_error()); 
	//maintain the referenciality in table viewimage
	
	//get the last viewid from  table view 
	$query="select view.ViewId from view";
	$result=mysql_query($query)or die(mysql_error()); 
	$num=mysql_numrows($result);
	if($num)
	{
	//retrieve the last row
	$viewid=mysql_result($result,$num-1,"view.ViewId");
	//now
	//maintain the referenciality in table viewimage
	$query="insert into viewalbum values ($viewid,$albumid)";
	$result=mysql_query($query)or die(mysql_error()); 
	}//inner if
	}
	
	}//else
	return $objResponse->getXML();
}
?>