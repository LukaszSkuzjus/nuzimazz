<?php
session_start();
include("dbconn.php");
$_SESSION["connect"]=$db;
   
   
    function phpFunctionInsertDetails($v1)
    {
$db= $_SESSION["connect"];
$Img2=array();
$Img2=$_SESSION["ImageTag"];
	// makes an array from the passed variable 
	// (note: $vars = 1 string while it used to be a javascript Array)
	// with explode you can make an array from 1 string. The seperator is a , 
	$var = explode(",", $v1);
   
    $img=$Img2[ $var[0]];
    
    $result=$db->query(" UPDATE images SET ImageName='$var[1]' ,Description='$var[2]' WHERE ImageId=$img");
	
   }
   
   function phpFunctionImageInfo($v1)
    {	$db= $_SESSION["connect"];
      $Img2=array();
      $Img2=$_SESSION["ImageTag"];
      $events=array();
      $sites=array();
       $events1=array();
      $sites1=array();
	// makes an array from the passed variable 
	// (note: $vars = 1 string while it used to be a javascript Array)
	// with explode you can make an array from 1 string. The seperator is a , 
	$var = explode(",", $v1);
    $img=$Img2[ $var[0]];
    //$img contains the imgid 

	//write all details about the img here
?>
  <div id="tagdiv">
  <table class="white">
  <th colspan="4">
   Tag image information
  </th>
  <th>
   <A href="#" onclick="hideIT('tagdiv');">CLOSE</a>
  </th>

  <tr>
    <td>Image Name: </td>
    <td colspan="3"><b><?//query from db
    $result = $db->query("Select * From images where ImageId=$img");
    while ($row = $result->fetch_assoc())
       {echo $row["ImageName"];
          
   ?></b></td>
    <td></td>
  </tr>

  <tr>
    <td>Description: </td>
    <td><b><?echo $row["Description"];
    }
    ?> </b></td>
    </tr>
    <tr>
      <tr>
    <td>From Album: </td>
    <td colspan="3"><b><?
     $result = $db->query("Select * from album as a where a.AlbumId IN(Select ac.AlbumId From albumcontainsimages as ac where ac.ImageId=$img)");
     while ($row = $result->fetch_assoc())
       {echo $row["AlbumName"];
          }
     ?></b></td>
    <td></td>
  </tr>
    <td><center>Linked To:</center> </td>
    <td></td>
  </tr>

  <tr>

    <td>Members: </td>
    <td><b><?
         $result = $db->query("Select * from member as m where m.Member_Id IN(Select mi.Mem_id From membersinimages as mi where mi.Img_id=$img)");
     while ($row = $result->fetch_assoc())
       {echo $row["L_Name"];echo" ". $row["F_Name"].",";
          }
    
    
    ?></b></td>
    </tr>
    <tr>
    <td>Sites: </td>
    <td><b><?
     $result = $db->query("Select * From sites as s where s.SiteId IN(Select i.SiteId From imagetakeninsites as i where i.ImageId=$img)");
  $count1 = $result->num_rows;
  if($count1==0)
     {
      $flag1=0;
     }
     else
     { $flag1=1;
     while ($row = $result->fetch_assoc())
       { echo $row["SiteName"].",";
            $sites[]=$row["SiteId"];
            $sites1[]=$row["SiteName"];
          }
          }
    ?></b></td>
    <td></td>
  </tr>

  <tr>

    <td>Events: </td>
    <td>
    <?   $result = $db->query("Select * From events as e where e.EventId IN(Select i.EventId From imagetakenonevent as i where i.ImageId=$img)");
    $count2 = $result->num_rows;
    if($count2==0)
     {
     
      $flag2=0;
     }
     else
     { $flag2=1;
     while ($row = $result->fetch_assoc())
       { 
       echo $row["EventName"].",";
       $events[]=$row["EventId"];
       $events1[]= $row["EventName"];
          }
          }
    ?>
    </td>

    <td></td>

  </tr>

  </table>
  </div>


    
    
    <? if($flag1*$flag2==1)
    {
      //use a new div to enter info about events occur in sites-confirm? 
      ?>
      <div id="esdiv">
<table border="0" cellspacing="2" cellpadding="2" class="white">
  <th >
    Link Events & Sites:
  </th>
  <th>
   <A href="#" onclick="hideIT('esdiv')">CLOSE</a>
  </th>
  <tr>
   <td>
   <?// $s=count($sites);
       // echo count($events);
        echo"Does Event/s ";
        for($i=0;$i<count($events1);$i++)
        { echo"<b>". $events1[$i]."</b>,";
        }
        echo" occur in Site/s ";
        for($j=0;$j<count($sites1);$j++)
        { echo"<b>". $sites1[$j]."</b>,";
        }
        echo"?";
        $_SESSION["Events"]=$events;
        $_SESSION["Site"]=$sites;
   ?>
   </td></tr><tr>
    <td align=right><input type="submit" value=" Confirm?"  ONCLICK="Confirm();return false;"></td>
   </tr>

</table>
</div>   
      <?
    }
    
    
   }
   
   
   function phpFunctionLinkMembers($v1)
   {
	$db= $_SESSION["connect"];
    $Img2=array();
    $Img2=$_SESSION["ImageTag"];
    
	$varArray = explode(",", $v1);
   $img=$Img2[ $varArray[0]];//the image linked
    
 $varArray2=explode(" ", $varArray[1]);
  
 //insert data in database
      for($i=0;$i<count($varArray2);$i++)
       {// prepare statement 
  $memid=$varArray2[$i];
  
  $stmt= $db->prepare("INSERT INTO membersinimages VALUES (?,$img)");
 $stmt->bind_param("i",$memid);
 $stmt->execute();
 $stmt->close();

    }
   
   }

   function phpFunctionLinkSites($v1)
   {
	$db= $_SESSION["connect"];
    $Img2=array();
    $Img2=$_SESSION["ImageTag"];
    
	$varArray = explode(",", $v1);
   $img=$Img2[ $varArray[0]];//the image linked
    
  
 //insert data in database
  
$result = $db->query("INSERT INTO imagetakeninsites VALUES($img,$varArray[1])");


    }
 
   
      function phpFunctionInsertSiteDetails($v1)
    {
$db= $_SESSION["connect"];
$loc=$_SESSION["Country"];
	$var = explode(",", $v1);
    
    
      
$result=$db->query("SELECT * FROM sites");
$count = $result->num_rows;
$sid=$count+1;

$result=$db->query("INSERT INTO sites Values($sid,'$var[0]','$var[1]','$var[2]','$var[3]')");

$result=$db->query("INSERT INTO locationcontainsites Values($loc,$sid)");

   }
   
  function phpFunctionLinkEvents($v1)
   {
	$db= $_SESSION["connect"];
    $Img2=array();
    $Img2=$_SESSION["ImageTag"];
    
	$varArray = explode(",", $v1);
   $img=$Img2[ $varArray[0]];//the image linked
    
 $varArray2=explode(" ", $varArray[1]);
  
 //insert data in database
        for($i=0;$i<count($varArray2);$i++)
       {// prepare statement 
  $eventid=$varArray2[$i];
  
  $stmt= $db->prepare("INSERT INTO imagetakenonevent VALUES ($img,?)");
 $stmt->bind_param("i",$eventid);
 $stmt->execute();
 $stmt->close();

    }
   
   }
   
   
   
function phpFunctionInsertEventDetails($v1)
   {
$db= $_SESSION["connect"];
$loc=$_SESSION["Country"];
	$var = explode(",", $v1);
    
    
      
$result=$db->query("SELECT * FROM events");
$count = $result->num_rows;
$eid=$count+1;

$result=$db->query("INSERT INTO events Values($eid,'$var[0]','$var[1]')");


   }


?>

