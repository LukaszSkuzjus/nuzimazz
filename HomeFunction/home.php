<?php

include('dbinfo.inc.php');
/*
1 -- create function which generates random number from 0 to number of records in a table
2--create a function to display album
3--create a function to display latest albums
4--function which return no of records in a query
*/
srand((double)microtime()*1000000);  
Function GetRandomNumber($maxlimit)
{

$random = (rand()%$maxlimit);

return $random;
}
function GetNoOfRecords($Query)
{

if(isset($Query))
{

$result=mysql_query($Query)or die(mysql_error());
$num=mysql_numrows($result);
if($num ==0)
$num =0;
else
$num =$num;
}
return $num;
}

function  displayAlbum()
{//display a picture of an album
		//$objResponse = new xajaxResponse();
		//get 5 distinct random numbers
		$randomnumber = array();
		$lowerlimit=GetRandomNumber(GetNoOfRecords('select * from album'));
		//assign array to $lowerlimit
		$myarray = array();
		do{
		
		//assign values to array
		{$randomnumber[]= GetRandomNumber(GetNoOfRecords('select * from album'));
		$myarray = array_unique($randomnumber);
		}
		}while(count($myarray)!=5);
	
		//sort the array
		
		sort($myarray);
			
		
		
		
		//echo $lowerlimit;
		$Query="select * from album ";
		$result=mysql_query($Query)or die(mysql_error());
		$num = mysql_numrows($result);
		$msg;
		if($num)
			{//record exits
			$msg="<table align =center><tr>";

					for($i =0;$i<5;$i++)
		{
		
		
				//getpath of image
				$path= Getpath(mysql_result($result,$myarray[$i],"album.AlbumId"));
				$description = mysql_result($result,$myarray[$i],"album.Description");
				$AlbumName= mysql_result($result,$myarray[$i],"album.AlbumName");
				$albumId =mysql_result($result,$myarray[$i],"album.AlbumId");
				$msg.="<td><table class=\"table-shadows\" >
					<tr>
					<td class=\"td-shadows-main\" height =130>
    		
					<a href=\"javascript:void(null);\" onclick =\"xajax_ShowGallery();xajax_showImageDetailDiv();xajax_createHomeAlbumview($albumId,'');xajax_RateAlbum($albumId);makeHistory(1);\">";//end of echo
					//GetImage path 
					$msg.="<IMG SRC=\"$path\"width=130 height=130
					align= \"center\" >
					</a>
					</td>
					<td class=\"td-shadows-right\"></td>
					</tr>
					<tr>
					<td class=\"td-shadows-bottom\"></td>
					<td class=\"td-shadows-bottomright\">
					</td>
					</tr>
					
					</table><!--end of  table shadows-->";//$msg
					//new table to hold desc & name
					$msg.="<table><tr><td class =\"td-thumbnails-navi\">$AlbumName</tr></td>
					<tr><td width =160 height = 20 class =\"td-thumbnails\">$description</td></tr></table></td>";
}//for
$msg.="</tr></table>";
}

else 
$msg= "No Records founds";

//$objResponse->addAssign("table","innerHTML",$msg);
return $msg;
}//func


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
	
	

$lowerlimit=GetRandomNumber($num);
	$Url=mysql_result($result,$lowerlimit,"images.Url");//random image from the album
	
	$msg="Images/".$Url;
	

}//else
	return $msg;
	
	}//end of function
    
    function latestAlbum()
    
    {
        $Query="select * from album ,ownalbum ,member where album.AlbumId =ownalbum.AlbumId and
		member.Member_Id=ownalbum.OwnerId
		ORDER BY album.CreationDate  DESC  limit 0,5 ";
		$result=mysql_query($Query)or die(mysql_error());
		$num = mysql_numrows($result);
        if($num)
        {
      $myarray = array();
       $i =0;
        while($i<$num)
        {
			$owner =mysql_result($result,$i,"member.F_Name")." ".mysql_result($result,$i,"member.L_Name");
			$path= Getpath(mysql_result($result,$i,"album.AlbumId"));
		$Date =mysql_result($result,$i,"album.CreationDate");
		$albumId =mysql_result($result,$i,"album.AlbumId");
		$msg="<table class=\"table-shadows\" >
					<tr>
					<td class=\"td-shadows-main\" height =130>
    		
					<a href=\"javascript:void(null);\"onclick =\"xajax_ShowGallery();xajax_createAlbumView($albumId,'');xajax_RateAlbum($albumId);\">";//end of echo
					//GetImage path 
					$msg.="<IMG SRC=\"$path\"width=130 height=130
					align= \"center\" >
					</a>
					</td>
					<td class=\"td-shadows-right\"></td>
					</tr>
					<tr>
					<td class=\"td-shadows-bottom\"></td>
					<td class=\"td-shadows-bottomright\">
					</td>
					</tr>
					
					</table><!--end of  table shadows-->";//$msg
					//new table to hold desc & name
					$msg.="<table><tr><td class =\"td-thumbnails-navi\">by $owner</tr></td>
					<tr><td width =160 height = 20 class =\"td-thumbnails\">on $Date</td></tr>";
					
					
					$msg.="</table>";
			
     $myarray[$i] = $msg;
    
     $i++;
      
        }
        
    $output="  <table align =center>
  <tr>
   <td >$myarray[0]</td>
      <td >$myarray[1] </td> 
	  <td >$myarray[2] </td>
	   <td >$myarray[3] </td>
    <td >$myarray[4] </td>
     
	  
	 
		
		 <td ><p align=\"right\"></p></td>
    
  </tr>
 
</table>";
return $output;
       
        }//if
        else return "no records found ";
        
       
     
    }
    
    function getRandommembers()
    {
   
    $Query="SELECT * FROM member ";
	$result=mysql_query($Query)or die(mysql_error());
	$num = mysql_numrows($result);
	$msg;
		if($num)
			{//record exits
            $myarray =array();
            $i =0;
                    while($i<$num)
                        {	//getpath of image containing the random  member
                             $lowerlimit=GetRandomNumber($num);
							 $owner =mysql_result($result,$lowerlimit,"member.F_Name")." ".mysql_result($result,$lowerlimit,"member.L_Name");
                            $path= GetImageMember(mysql_result($result,$lowerlimit,"member.Member_Id"));
							$MemID = mysql_result($result,$lowerlimit,"member.Member_Id");
							
							$msg="<table class=\"table-shadows\" >
					<tr>
					<td class=\"td-shadows-main\" height =130>
    		
					<a href=\"javascript:void(null);\"onclick=\"xajax_ShowGallery();xajax_viewAlbumOfMem($MemID,'');\">";//end of echo
					//GetImage path 
					$msg.="<IMG SRC=\"$path\"width=130 height=130
					align= \"center\" >
					</a>
					</td>
					<td class=\"td-shadows-right\"></td>
					</tr>
					<tr>
					<td class=\"td-shadows-bottom\"></td>
					<td class=\"td-shadows-bottomright\">
					</td>
					</tr>
					
					</table><!--end of  table shadows-->";//$msg
					//new table to hold desc & name
					$msg.="<table><tr><td class =\"td-thumbnails-navi\">by $owner</tr></td><td ><p ></p></td>";
					//<tr><td width =160 height = 20 class =\"td-thumbnails\">on $Date</td></tr>";
					
					
					$msg.="</table>";
							
							
                             $myarray[$i] =$msg;
                            $i++;
                }//while 
                
                
                //got to display the array in a table
                
                //Genrate a random member to show
				$random= GetRandomNumber($i);
                $output="  <table class =\"myphotoposition\">
  <tr>
    <td >$myarray[$random]</td>
	
   
  </tr>
 
</table>";
return $output;
                
               }//if
               
               else
               return "no image found ";
    }
    
    
  function   GetImageMember($memberID)
  {
  //get rendom image containing member pic
  
  $query="SELECT memprofile.Image_Url FROM memprofile where memprofile.Mem_Id =$memberID";
  $result=mysql_query($query)or die(mysql_error());
  
  $num=mysql_numrows($result);
	//check
	$msg;
	if($num==0)
	
		$msg= "No Picture Available";
		else
		
		{
	
	

$lowerlimit=GetRandomNumber($num);
	$Url=mysql_result($result,$lowerlimit,"memprofile.Image_Url");//random image from 
	
	$msg="Images/profile/".$Url;
	

}//else
	return $msg;
  
  }
  
 function drawTable()
{


$msg= "<p align=\"center\"class =\"HomeTitle\">Random Albums</p>
<table align =center><tr>
<td> ";
$msg.= displayAlbum();
$msg.="</td>
<td><td><p align=\"right\"></p></td>";

$msg.="</tr></table>";//msg


$msg.="<p class =\"HomeTitle\" align=\"center\">Latest Albums</p>";


 $msg.= latestAlbum();

 
 $msg.="<p  class =\"myHeaderposition\">Random  Members</p>";
 $msg.= getRandommembers(); 

return $msg;
}


//$xajax = new xajax();
//$xajax->debugOn(); 
//$xajax->registerFunction("drawTable");//function in other page

//$xajax->registerFunction("displayAlbum");//function in other page
//$xajax->processRequests();

//mysql_close();
?>
<html>
<head>
<script src="../history.js">
		//manage history
		</script>
</head>
<body>
<?php echo drawTable(); ?>
</body>
</html>
   
  




