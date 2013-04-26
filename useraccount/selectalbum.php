<?php
//select album the user owns

session_start();
require ('xajax.inc.php');
include("dbinfo.inc.php");




//need go check for this variables first/////very important

$username=$_SESSION['username'];
$userid =$_SESSION['userId'];
$login = $_SESSION['Login'];

//this page will create the user account
//i assumed that the user  is log in and that his id = 1 and  his user name is mike99


//assign the user name to the field username
//create a function to count no of albums


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
    		
					<a href=\"javascript:void(null);\" onclick=\"xajax_HideDiv();xajax_GetAlbumdetails($albumid);\" >";//end of echo
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

	
	function GetAlbumdetails($albumid)
	{
	$objResponse = new xajaxResponse();
	$query="SELECT * FROM album where album.AlbumId=$albumid";

	$result=mysql_query($query);

	$num=mysql_numrows($result);
	
	//check
	$msg;
	if($num==0)

		$msg= "No Records founds";
		else

		{//retrive the details
		$Des = mysql_result($result,0,"album.Description");
		$Name = mysql_result($result,0,"album.AlbumName");
		//create view
		
		$msg = "<p class =\"mytext_account\">Album Name : $Name <a href = \"javascript:void(null);\" onclick = \"xajax_ShowDiv('alName',$albumid);\">Edit</a></p>
				<p class =\"mytext_account\">Description : $Des <a href = \"javascript:void(null);\" onclick = \" xajax_ShowDiv('des',$albumid);\">Edit</a></p>";




	

	


}//else
$objResponse->addAssign("AlbumDetails","innerHTML",$msg);
	return $objResponse->getXML();
	}//func
	
	function ShowDiv($obj,$albumid)
	{
	$_SESSION['ALBUM'] = $albumid;
	$objResponse = new xajaxResponse();
	$objResponse->addAssign($obj,"className","showmsg2");
	return $objResponse->getXML();
	}//func
	
	function HideDiv()
	{
	$objResponse = new xajaxResponse();
	$objResponse->addClear("alName","value");
	$objResponse->addClear("des","value");
	$objResponse->addAssign("alName","className","Hidemsg");
	$objResponse->addAssign("des","className","Hidemsg");
	return $objResponse->getXML();
	}

	
	function EditName($newName)
	{	
	$objResponse = new xajaxResponse();
	if($newName =="")
	$objResponse->addAlert("Enter a Name");
	else
	{
	$albumId = $_SESSION['ALBUM'];
	unset($_SESSION['ALBUM']);
	$query = "update album set AlbumName = '$newName' where AlbumId = '$albumId'limit 1";
	mysql_query($query)or die('Edit not entered');
	//call function  again
	$objResponse->loadXML(GetAlbumdetails($albumId));
	$objResponse->loadXML(	HideDiv());

	}
	return $objResponse->getXML();
	}
	function EditDes($des)
	{
	$objResponse = new xajaxResponse();
	if($des =="")
	$objResponse->addAlert("Enter a Description");
	else
	{
	$albumId = $_SESSION['ALBUM'];
	unset($_SESSION['ALBUM']);
	$query = "update album set Description = '$des' where AlbumId = '$albumId'limit 1";
	mysql_query($query)or die('Edit not entered');
	//call function  again
	$objResponse->loadXML(GetAlbumdetails($albumId));
	$objResponse->loadXML(	HideDiv());

	}
	return $objResponse->getXML();
	}
	
$xajax = new xajax();
//$xajax->debugOn(); 
//rating functions

$xajax->registerFunction("viewuseralbums");
$xajax->registerFunction("GetAlbumdetails");
$xajax->registerFunction("ShowDiv");
$xajax->registerFunction("HideDiv");
$xajax->registerFunction("EditName");
$xajax->registerFunction("EditDes");
$xajax->processRequests();


?>



<html><head><?php $xajax->printJavascript(); ?><title></title>

<link href="css/style.css" type="text/css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="../icons/spgm_style.css" />


</head>


<body onload ="xajax_viewuseralbums(<?php echo $userid;?>,'')">

<!--Start of Menu-->

<!--End of Menu-->
<!--Start of footer table-->



<table id="wapper" border=0>
 <tr>
       <td id="topleft">&nbsp;</td>
       <td id="top">&nbsp;</td>
       <td id="topright">&nbsp;</td>
     </tr>


<tr><td id="left"></td>

<td id="logocenter">
       <p><span id="title">&nbsp;Edit Album Details</span></p>
	<div id = "mytable"></div><a href = "content.php " target = 'main'">Back to my Account </a>
	<div id = "AlbumDetails"></div>
	<div id = "alName" class="hidemsg"><input type ="text" id = "nametxt"><input type ="button" onclick = "xajax_EditName(document.getElementById('nametxt').value);" value ="Go"></div>
	<div id ="des" class="hidemsg"><input type ="text" id = "destxt"><input type ="button" onclick = "xajax_EditDes(document.getElementById('destxt').value);" value ="Go"></div>
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


