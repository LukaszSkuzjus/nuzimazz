<?php

function GetAllPictureDetails($albumid,$imageid)

{	$objResponse = new xajaxResponse();

		$query="select * from images ,albumcontainsimages,album,viewimage,view where
				images.ImageId=albumcontainsimages.ImageId and 
				albumcontainsimages.AlbumId=album.AlbumId and images.ImageId=viewimage.ImageId 
				and view.ViewId=viewimage.ViewId and images.ImageId=$imageid";
		
		$result=mysql_query($query)or die(mysql_error());
		$num=mysql_numrows($result);
		$msg;
		if($num==0)
		{$msg= "No Records founds";
			$objResponse->addAssign("table","innerHTML",$msg);
		}//if
		
		else{
		
		//displayimageName
			$ImgName= mysql_result($result,0,'images.ImageName');
			//display Creation Date
			$Date = mysql_result($result,0,'images.DateCreated');
			//display description of album
			$des= mysql_result($result,0,'images.Description');
			//display Date uploaded
			$Dateuploaded = mysql_result($result,0,'images.DateUploaded');
			//display no of times viewed
			$view =mysql_result($result,0,'view.Times');
		//get path of image
					$path="Images/";
					$path .= mysql_result($result,0,"images.Url");
		
		//Draw table
		
		$msg.="<table>
		<tr><td><a href=\"javascript:void(null);\" >";
		//GetImage path 
		$msg.="<IMG SRC=\"".$path."\"width=150 height=160 
		align=bottom alt=$ImgName>
		</a></td>";
		
		$msg.="<td>
		<table>
		<tr><td>Name:$ImgName</td></tr>
		<tr><td>Description:$des</td></tr>
		<tr><td>Date Created:$Date</td></tr>
		<tr><td>Date Uploaded:$Dateuploaded </td></tr>
		<tr><td>viewed:$view</td></tr>
		</tr>
		</table>
		</td>
		<!--//table to show the options-->
		<td>
		<table>
		<tr><td></td></tr>
		<tr><td><a href=\"\">Find Related Images</a></td></tr>
		<tr><td><a href=\"\">Post a Comment</a></td></tr>
		<tr><td><a href=\"\">Edit Image</a></td></tr>
		<tr><td><a href=\"\">Zoom</a></td></tr>
		<tr><td><a href=\"\">Find The Events in this image</a></td></tr>
		</tr>
		</table>
		</td>
		</tr>
		
		
		</table>
		<table><tr><td><a href=\"javascript:void(null);\" onclick=\"xajax_createAlbumView($albumid,'');return false;\">Back</a>
		</td></tr></table>";
		$objResponse->addAssign("table","innerHTML",$msg);
		}//else
		
		return $objResponse->getXML();
}//end of function

?>