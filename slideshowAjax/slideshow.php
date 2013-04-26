<?php

$albumid=$_GET["albumid"];
//$albumid =1;

require ('../xajax.inc.php');
include("../dbinfo.inc.php");
//$albumid =1;

function Getnum($albumid)

{$objResponse = new xajaxResponse();

$query="select  images.ImageId AS numrows from images ,albumcontainsimages,album where
				images.ImageId=albumcontainsimages.ImageId and 
				albumcontainsimages.AlbumId=album.AlbumId and album.AlbumId =$albumid";
	$result=mysql_query($query);			
	$num=mysql_numrows($result);
//if ($num ==0)
		
		$objResponse->addScript("count($albumid,$num)");
		return $objResponse->getXML();
		
}//function


function GetImage($albumid,$jumpto)
 {
	$objResponse = new xajaxResponse();
	// how many rows to show per page 
	$rowsPerPage = 1;
	
	// if $jumpto  defined, use it as page number 
	if($jumpto!="") 
 
			$pageNum = $jumpto;
	else
			// by default show first page 
			$pageNum = 1;
	$start = ($pageNum -1) * $rowsPerPage;
	if($jumpto==1) 
	$objResponse->addAssign("play","value","Replay");
	else
	$objResponse->addAssign("play","value","Play ");
	// enter  query and display stuff

	//$objResponse->addAssign("title1","innerHTML","Album");
	$query="select images.Url ,album.AlbumName,images.Description,images.ImageName
	from images ,albumcontainsimages,album where
	images.ImageId=albumcontainsimages.ImageId and 
	albumcontainsimages.AlbumId=album.AlbumId and album.AlbumId =$albumid limit $start, $rowsPerPage";
	$result=mysql_query($query);
	$num=mysql_numrows($result);
	$msg;
	if(!$num)
		{$msg= "No Records founds";
		$objResponse->addAssign("table","innerHTML",$msg);
		}
	else
		{
			//display Album Name
			$AlbumName= mysql_result($result,0,'album.AlbumName');
			
			$msg="<table ><tr >";//end of echo
			
			$msg.= "<td class =\"td-thumbnails-navi\">Album Name :$AlbumName</td></tr>";
			//get name of image
					$ImgName=mysql_result($result,$S,"images.ImageName");
			$msg.= "<tr><td class =\"td-thumbnails-navi\">Image Name :$ImgName</td></tr></table>";
			//display Creation Date
			//$Date = mysql_result($result,0,'album.CreationDate');
			//display description of album
			//$des= mysql_result($result,0,'album.Description');
			//display no of times viewed
			//call function GetViewed($albumid)
			//$view =GetViewed($albumid);
			
			////display owername
			//call function	GetOwner($albumid)
			//$owner =GetOwner($albumid);
			//create a table to display album details first
			
			
			//create a table to display album pictures now
			$msg.="<table>";//echo
			$msg.="<tr>";//end of echo

			for($S=0;$S<$num;$S++)
				{	//get path of image
					$path="../Images/";
					$path .= mysql_result($result,$S,"images.Url");
					//get des of image
					$imgdescription= mysql_result($result,$S,"images.Description");
					//get dateuploaded of image
					//$dateUploaded=mysql_result($result,$S,"images.DateUploaded");
					
					//get datecreated of image
					//$dateCreated=mysql_result($result,$S,"images.DateCreated");
					//$imageId=mysql_result($result,$S,"images.ImageId");
				
					$msg.="<td>
				
					
					";
					$msg.="<table class=\"table-shadows\" >
					<tr>
					<td class=\"td-shadows-main\">";//end of echo
    		
					
					//GetImage path 
					$msg.="<IMG SRC=\"".$path."\" 
					align=bottom alt=$ImgName >
					
					</td>
					<td class=\"td-shadows-right\"></td>
					</tr>
					<tr>
					<td class=\"td-shadows-bottom\"></td>
					<td class=\"td-shadows-bottomright\">
					</td>
					
					</tr>
					
					<td class=\"RegisterTitle\">$imgdescription</td>
					</table><!--end of  table shadows-->
					

					</td>";//end of echo
					//if no if col = 5 then new row
						if(($S %3 )==0 &&($S+1)!==1 )
							$msg.="</tr><tr>";
							
							
			}//for
			$msg.="</tr><table>";
			//############## End of display stuff
		

		
				
				
				
				
				//#################################### 
				
				

				
				
			
	
 	

			$objResponse->addAssign("table","innerHTML",$msg);
			
			
			
			
			
			
		}//else
		return $objResponse->getXML();
		mysql_close();
}//end of function
////////////////////////////////

$xajax = new xajax();
//$xajax->debugOn(); 


$xajax->registerFunction("GetImage");
$xajax->registerFunction("Getnum");

$xajax->processRequests();

?>




<html>
<head>
<?php $xajax->printJavascript("../");?>

<script type="text/javascript" src="slideshow.js"></script>
<script type="text/javascript" src="javascript/lib/LibCrossBrowser.js"></script>
<script type="text/javascript" src="javascript/lib/EventHandler.js"></script>
<script type="text/javascript" src="javascript/core/form/Bs_FormUtil.lib.js"></script>
<script type="text/javascript" src="javascript/core/gfx/Bs_ColorUtil.lib.js"></script>
<script type="text/javascript" src="javascript/components/slider/Bs_Slider.class.js"></script>



<style>
  .sliderInput {
  	height:20;
    width:40;
  	font-family : Arial, Helvetica, sans-serif;
  	font-size : 12px;
  }
  .smallTxt {
    font-size: 12px;
  }
  .slider
	{position: absolute;
	
top: 97px;
left: 400px;
width: 0px;
height:0px


	}
	#table{
height : 700px;
}
</style>
<link rel="Stylesheet" href="../css/style.css" type="text/css"/>
<link rel="Stylesheet" href="../icons/spgm_style.css" />
</head>
<body onLoad="init();" >









<!--Start of footer table-->
<table id="wapper" border=0>
 <tr>
       <td id="topleft">&nbsp;</td>
       <td id="top">&nbsp;</td>
       <td id="topright">&nbsp;</td>
     </tr>


<tr><td id="left"></td>

<td id="logocenter">
       <p><div id="title"class="RegisterTitle">Nu Zimazz Slideshow</div></p>
<table>
<td ><input type ="button" value ="Stop"onclick="stop();"></td>
<td><input type ="button" id="play" value ="Play"onclick="xajax_Getnum(<?php echo $albumid ;?>);"></td>
<span><td class="Register"><p>Slideshow Response time(sec)</p><span id="sliderDiv1" class="slider"></span></td></span>
<td colspan =2 width = 335 align = "right"><a href = "javascript: self.close ()" >Close Window </a></td></tr>
</table> 

<div id ="table"></div>
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
</body>

</html>
