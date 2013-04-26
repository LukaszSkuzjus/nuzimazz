<?php
session_start();
$memid=$_SESSION["Userid"];

global $Img;
$Img=array();
$Img=$_SESSION["ImageTag"];
$count=count($Img);
include("dbconn.php");
include("ImageFunctions.inc.php");




   if (isset($_GET[p])){
	// Retrieve the GET parameters and executes the function
	  $funcName	 = $_GET[p];
	  $vars	  = $_GET[vars];
     
       // getting the value as a string via url and building them in a way to call the function in php as shown below
	      $funcName($vars); 
       
       } 

  


?>
<html>
<head><title>Image Tagging</title>
  <style>
        #esdiv{
    position:absolute;
    right:25px;
    top:370px;
    z-Index:40;
      }
  
    
  
     #tagdiv{
    position:absolute;
    right:24px;
    top:150px;
    z-Index:40;
      }
  #resizediv{
    position:absolute;
    right:20px;
    top:250px;
    z-Index:40;
    visibility:hidden;
    }
    
    #infodiv{
    position:absolute;
    right:10px;
    top:290px;
    z-Index:10;
    visibility:hidden;
    }
   
    
   #opendiv{
   position:absolute;
    right:10px;
    top:300px;
    z-Index:10;
    visibility:hidden;
    }
  
  
  
  #colordiv{
    position:absolute;
    left:10px;
    top:310px;
    z-Index:60;
    visibility:hidden;
    }
   
    
  #clipdiv{
    position:absolute;
    left:10px;
    top:350px;
    z-Index:70;
    visibility:hidden;
    }
    
    #rotatediv{
    position:absolute;
    left:10px;
    top:255px;
    z-Index:30;
    visibility:hidden;
    }
    
      
     #tooldiv2{
    position:absolute;
    right:25px;
    top:125px;
     z-Index:9999;
    }
    
   #tooldiv{
    position:absolute;
    right:135px;
    top:65px;
   z-Index:9999;
      
    }
    
    BODY
    {
    color : Black;
    font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;
    font-size : 9pt;
    text-align : left;
   background : #B0C4DE; 
    }
    
   TABLE.white {
    border-style: solid;
    border-color: black;
    border-width: 1px;
    background-color : White;
    }
    
    TH{
    font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;
    font-size : 8pt;
    border-style: solid;
    border-color: black;
    border-width: 1px;
    background-color: #778899;
    color : White;
    }
        
    TD{
    font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;
    font-size : 8pt;
    }

    .bordered{
    border-style: solid;
    border-color: black;
    border-width: 1px;
    width:60px;
    }
    
    H3{
    font-family : Verdana, Geneva, Arial, Helvetica, sans-serif;
    text-align : center;
    font-style : normal;
    font-size : 9pt;
    }
    
    H2{
    font-family :Dolphin,Times New Roman, sans-serif;
    font-size : 24pt;
    border-style: solid;
    border-color: black;
    border-width: 1px;
    background-color: #778899;
    color : White;
  
    }
    
     a{
    font-weight : bold;
    text-decoration: none;
    color:#000A59;
    font-family : "verdana", "sans-serif";
    font-size : 8pt;
    }
    
    a:hover{
    font-weight : bold;
    text-decoration: underline;
    color: #87CEFA;
    
 }
 </style>
     
<script language="JavaScript">
<!-- Original:  Ricocheting (ricocheting@hotmail.com) -->
<!-- Web Site:  http://www.ricocheting.com -->

<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->

function showIT(object) {

   if (document.getElementById) {
    document.getElementById(object).style.visibility = 'visible';
  }
  else if (document.layers && document.layers[object]) {
    document.layers[object].visibility = 'visible';
  }
  else if (document.all) {
    document.all[object].style.visibility = 'visible';
  }


}



function showITC() {
var len = document.Places.Country.length;
var i = 0;
var choice;

for (i = 0; i < len; i++) {
if (document.Places.Country[i].selected) {
choice = document.Places.Country.value
}

}

   // the url which you have to reload is this page, but you add an action to the GET- or POST-variable
	var url="<?php echo $_SERVER[PHP_SELF];?>?Country="+choice;
	
	// Opens the url in the same window
	   window.open(url, "_self");
 

}

function hideIT(object) {
  if (document.getElementById) {
    document.getElementById(object).style.visibility = 'hidden';
  }
  else if (document.layers && document.layers[object]) {
    document.layers[object].visibility = 'hidden';
  }
  else if (document.all) {
    document.all[object].style.visibility = 'hidden';
  }
}


current =0;

function next() 
{
if (document.slideform.slide[current+1]) 
{
document.images.show.src = document.slideform.slide[current+1].value;
document.slideform.slide.selectedIndex = ++current;

   }
   
else first();

}

function previous() 
{
if (current-1 >= 0) {
document.images.show.src = document.slideform.slide[current-1].value;
document.slideform.slide.selectedIndex = --current;
  
   }
else last();

}

function first() 
{
current = 0;

  
	document.images.show.src = document.slideform.slide[0].value;
    document.slideform.slide.selectedIndex = 0;

}

function last() 
{
current = document.slideform.slide.length-1;
  
    document.images.show.src = document.slideform.slide[current].value;
    document.slideform.slide.selectedIndex = current;

  
}

function change() 
{
current = document.slideform.slide.selectedIndex;
   
document.images.show.src = document.slideform.slide[current].value;

}
 
 function Confirm()
  { 
  <?php 
            $events=array();
            $sites=array();
             $events=$_SESSION["Events"];
             $sites=$_SESSION["Site"];           
            
            ?>;
     

 var  ans= confirm("Save Entries?");

    if(ans==true)
    {
    //insert entries in database
<?php
//2 events realated to 1 site
if(count($events)>count($sites) && count(sites)==1)
  { for($i=0;$i<count($events);$i++)
       {// prepare statement 
  $eventid=$events[$i];
  
  $stmt= $db->prepare("INSERT INTO eventoccursinsites VALUES (?,$sites[0])");
 $stmt->bind_param("i",$eventid);
 $stmt->execute();
 $stmt->close();

    }
}

else
//2 sites related to 1 event
     if(count($events)<count($sites) && count(events)==1)
  { for($i=0;$i<count($sites);$i++)
       {// prepare statement 
  $siteid=$sites[$i];
  
  $stmt= $db->prepare("INSERT INTO eventoccursinsites VALUES ($events[0],?)");
 $stmt->bind_param("i",$siteid);
 $stmt->execute();
 $stmt->close();

    }
}

else
if(count($events)==1 && count(sites)==1)
{ 
 $result=$db->query("INSERT INTO eventoccursinsites VALUES ($events[0],$sites[0])");
    }
      
         
         
         

?>
     }

}

 
  
function javaFunctionLinkMembers()
 { 
    var varArray = new Array();
len = document.Image.member.length;
 i = 0;
 chosen = "";

for (i = 0; i < len; i++) 
{
if (document.Image.member[i].selected) 
{ 

chosen = chosen + document.Image.member[i].value +" ";
 }
 }

 if(chosen=="")
 { 
	     alert('No Member selected!');
          return false;
    
 }
 else
 {
 
  varArray[0] = document.slideform.slide.selectedIndex; //image position in array
  varArray[1] = chosen;
 
 // the url which you have to reload is this page, but you add an action to the GET- or POST-variable
	var url="<?php echo $_SERVER[PHP_SELF];?>?p=phpFunctionLinkMembers&vars="+varArray;
	
	// Opens the url in the same window
	   window.open(url, "_self");
     }
}

function javaFunctionLinkSites()
 {   var varArray = new Array();
len = document.Image.Site.length;
 i = 0;
 chosen = "";

for (i = 0; i < len; i++) 
{
if (document.Image.Site[i].selected) 
{ 

chosen = chosen + document.Image.Site[i].value +" ";
 }
 }
 if(chosen=="")
 { 
	     alert('No Site selected!');
          return false;
    
 }
 else
 {
 varArray[0] = document.slideform.slide.selectedIndex; //image position in array
 varArray[1] = chosen;//site id
 
 // the url which you have to reload is this page, but you add an action to the GET- or POST-variable
	var url="<?php echo $_SERVER[PHP_SELF];?>?p=phpFunctionLinkSites&vars="+varArray;
	
	// Opens the url in the same window
	   window.open(url, "_self");
 
   }   
}

function ImageDetails()
{
// In the varArray are all the variables you want to give with the function
	var varArray = new Array();
	if(document.Image.ImgName.value=="" || document.Image.desc.value=="")
    {	     alert('Name/Description Fields Blank!');
          return false;
       }
          else
          {  varArray[0] = document.slideform.slide.selectedIndex; //image position in array
               varArray[1] = document.Image.ImgName.value;
                varArray[2] = document.Image.desc.value;
               
          }

// the url which you have to reload is this page, but you add an action to the GET- or POST-variable
	var url="<?php echo $_SERVER[PHP_SELF];?>?p=phpFunctionInsertDetails&vars="+varArray;
	
	// Opens the url in the same window
	   window.open(url, "_self");

}

function ImageInfo()
{
// In the varArray are all the variables you want to give with the function
	var varArray = new Array();
	 varArray[0] = document.slideform.slide.selectedIndex; //image position in array
             
 // the url which you have to reload is this page, but you add an action to the GET- or POST-variable
	var url="<?php echo $_SERVER[PHP_SELF];?>?p=phpFunctionImageInfo&vars="+varArray;
	
	// Opens the url in the same window
	   window.open(url, "_self");

}

function javaFunctionNewSite()
 { 
    
   	var varArray = new Array();
	if(document.Image.SiteName.value=="" || document.Image.description.value=="" || document.Image.add1.value=="")
    
    {	     alert('Name/address/ Description Fields Blank!');
          return false;
       }
          else
          {   
               varArray[0] = document.Image.SiteName.value;
               varArray[1] = document.Image.add1.value;
               varArray[2] = document.Image.add2.value;
               varArray[3] = document.Image.description.value;
               
          }

// the url which you have to reload is this page, but you add an action to the GET- or POST-variable
	var url="<?php echo $_SERVER[PHP_SELF];?>?p=phpFunctionInsertSiteDetails&vars="+varArray;
	
	// Opens the url in the same window
	   window.open(url, "_self");
     
}

function javaFunctionLinkEvents()
 {     var varArray = new Array();
len = document.Image.event.length;
 i = 0;
 chosen = "";

for (i = 0; i < len; i++) 
{
if (document.Image.event[i].selected) 
{ 

chosen = chosen + document.Image.event[i].value +" ";
 }
 }
 if(chosen=="")
 { 
	     alert('Unselected Event!');
          return false;
    
 }
 else
 {
  varArray[0] = document.slideform.slide.selectedIndex; //image position in array
  varArray[1] = chosen;
 
 // the url which you have to reload is this page, but you add an action to the GET- or POST-variable
	var url="<?php echo $_SERVER[PHP_SELF];?>?p=phpFunctionLinkEvents&vars="+varArray;
	
	// Opens the url in the same window
	   window.open(url, "_self");
      }
}

function javaFunctionNewEvent()
 { 
    
   	var varArray = new Array();
	if(document.Image.EventName.value=="" || document.Image.descript.value=="")
    
    {	     alert('Name/Description Fields Blank!');
          return false;
       }
          else
          {   
               varArray[0] = document.Image.EventName.value;
               varArray[1] = document.Image.descript.value;
               
          }

// the url which you have to reload is this page, but you add an action to the GET- or POST-variable
	var url="<?php echo $_SERVER[PHP_SELF];?>?p=phpFunctionInsertEventDetails&vars="+varArray;
	
	// Opens the url in the same window
	   window.open(url, "_self");
     
}


</script>

</head>
<body>    





<h2 align=right>Tag Image</h2><br><br><br>
<?
global $Url;
$Url=array();


if(!empty($Img))
{
for($t=0;$t<$count;$t++) 
{ 
    $imagetag=$Img[$t];
/* prepare statement */
    $stmt= $db->prepare("SELECT Url FROM images WHERE ImageId=?");

   $stmt->bind_param("i",$imagetag);

    $stmt->execute();

    /* bind variables to prepared statement */
    $stmt->bind_result($item);

    /* fetch values */
    while ($stmt->fetch()) {
             $Url[]=$item;
 }

/* close statement and connection */
$stmt->close();

}
 
$result = $db->query("Select * from location order by Country");
?>
<center>
<div id="tooldiv">
<table border="1" width="800px" cellspacing="2" cellpadding="2"class="white">
   <th rowspan=2>Tag Image By                             
     </th>
      <tr>
           <td align="center"><A href="#"  onclick="showIT('resizediv');">Name-Description</a></td>
  
           <td align="center"><A href="#" onclick="showIT('infodiv');">Events</a></td>
      
           <td align="center"><A href="#" onclick="showIT('rotatediv');">Members</a></td>
                 
           <td align="center"><form name=Places>SELECT <select name="Country" onchange="showITC();">
             <option value=0>COUNTRY</option>
 <?     while ($row = $result->fetch_assoc()) { ?>
<option value="<?echo $row["LocationId"] ?>"><?echo $row["Country"];}//end of while loop  ?> </option></select>
<A href="#" onclick="showIT('colordiv')">Show Places</a></td></td>
 <td align="center"><A href="#" onclick="ImageInfo();">View Tag Info</a></td>
 </form>        
          
 </table>  
</div>

 <center>
  <? $add = "../Images/".$Url[$count-1];?>
  
 <center>
<form name=slideform>
<table cellspacing=1 cellpadding=4 bgcolor="#000000">
<tr>
<td align=center bgcolor="white">
<b>Image Tag Window</b>
</td>
</tr>
<tr>
<td align=center bgcolor="white" width=200 height=150>
<img src="<?php echo $add ?>"  width="320" height="213" name="show">
</td>
</tr>
<tr>
<td align=center bgcolor="#C0C0C0">
<select name="slide" onChange="change();">

<? for($i=0;$i<$count;$i++) 
{  $add = "../Images/".$Url[$i];
   
?>
<option value="<?php echo $add ?>" selected><?php echo $i+1;?></option>
<?
  

}


?>

</select>

</td>
</tr>
<tr>
<td align=center bgcolor="#C0C0C0">
<input type=button onClick="first();" value="|<<" title="Beginning">
<input type=button onClick="previous();" value="<<" title="Previous">
<input type=textbox name="Info" value="Please Choose Image">
<input type=button onClick="next();" value=">>" title="Next">
<input type=button onClick="last();" value=">>|" title="End">
</td>
</tr>
</table>
</form>
</center>

<form name="Image">
<?php
$result = $db->query("Select * from events order by EventName");
?>




<div id="infodiv">
<table border="0" cellspacing="2" cellpadding="2" class="white">
  <th colspan="2">
   Link to Events By Selecting
  </th>
  <th>
   <A href="#" onclick="hideIT('infodiv');">CLOSE</a>
  </th>
  <tr>
    <td>
      <select name="event" size=5 multiple>
    
 <?     while ($row = $result->fetch_assoc()) { ?>
<option value="<?echo $row["EventId"] ?>"><?echo $row["EventName"];}//end of while loop  ?> </option></select>

   <td><input type="submit" value=" APPLY " ONCLICK="javaFunctionLinkEvents();return false;"></td></tr>
   <td colspan="3" class="small">To select multiple members use "Ctrl" key </td></tr>

   
<td colspan="3" class="small">Event Not Available.. Click Here To Create
<input type="button" value=" New event" ONCLICK="hideIT('infodiv'); showIT('opendiv'); "></td>
</table>
</div>


<div id="opendiv">
<table border="0" cellspacing="2" cellpadding="2" class="white">
  <th >
    Input Event Details Below:
  </th>
  <th>
   <A href="#" onclick="hideIT('opendiv');">CLOSE</a>
  </th>
  <tr>
   <td>
     Event Name:&nbsp;<input type="text"  name="EventName" value=""> </td></tr>
     <tr>
   <td>Description: &nbsp;<input type="text"  name="descript" value=""></td>
   
   <td><input type="submit" value=" SAVE"  ONCLICK="javaFunctionNewEvent();return false;"></td>

   </tr>

</table>
</div>   


    
  <div id="resizediv">
<table border="0" cellspacing="2" cellpadding="2" class="white">
  <th colspan="3">
    Input Image Details Below:
  </th>
  <th>
   <A href="#" onclick="hideIT('resizediv')">CLOSE</a>
  </th>
  <tr>
   <td>
     Image Name:&nbsp;<input type="text"  name="ImgName" value=""> </td></tr>
   <tr>
   <td>
     Description: &nbsp;&nbsp;&nbsp;<input type="text"  name="desc" value=""></td>
   
   <td><input type="submit" value=" APPLY "  ONCLICK="ImageDetails();return false;"></td>

   </tr>

</table>
</div>   
<?php
$result = $db->query("Select * from member where Member_Id IN(SELECT RelatedId From relatedmembers WHERE MemberId=$memid) order by L_Name");
?>
<div id="rotatediv">
<table border="0" cellspacing="2" cellpadding="2" class="white">
  <th colspan="2">
   Link to Members By Selecting
  </th>
  <th>
   <A href="#" onclick="hideIT('rotatediv')">CLOSE</a>
  </th>
  <tr>
    <td>
      <select name="member" size=2 multiple>
 <?     while ($row = $result->fetch_assoc()) { ?>
<option value="<?echo $row["Member_Id"] ?>"><?echo $row["L_Name"]." ".$row["F_Name"];}//end of while loop  ?> </option></select>

   <td><input type="submit" value=" APPLY " ONCLICK="javaFunctionLinkMembers();return false;"></td>
   </tr>
<td colspan="3" class="small">To select multiple members use "Ctrl" key </td></td></td>
</table>
</div>



<?php
$loc=$_GET["Country"];
$_SESSION["Country"]=$loc;
$result = $db->query("Select * from sites as s where s.SiteId IN
(SELECT l.SiteId From locationcontainsites as  l WHERE LocationId=$loc)");
?>
<div id="colordiv">
<table border="0" cellspacing="2" cellpadding="2" class="white">
  <th colspan="2">
   Link to Sites By Selecting
  </th>
  <th>
   <A href="#" onclick="hideIT('colordiv')">CLOSE</a>
  </th>
  <tr>
    <td>
      <select name="Site" size=5 multiple>
    
 <?     while ($row = $result->fetch_assoc()) { ?>
<option value="<?echo $row["SiteId"] ?>"><?echo $row["SiteName"];}//end of while loop  ?> </option></select>

   <td><input type="submit" value=" APPLY " ONCLICK="javaFunctionLinkSites();return false;"></td>
   </tr>
<td colspan="3" class="small">Sites Not Available.. Click Here To Create
<input type="button" value=" New Site" ONCLICK="hideIT('colordiv');showIT('clipdiv');"></td>
</table>
</div>


<div id="clipdiv">
<table border="0" cellspacing="2" cellpadding="2" class="white">
  <th >
    Input Site Details Below:
  </th>
  <th>
   <A href="#" onclick="hideIT('clipdiv')">CLOSE</a>
  </th>
  <tr>
   <td>
     Site Name:&nbsp;&nbsp;<input type="text"  name="SiteName" value=""> </td></tr>
    <tr><td>Address Line 1:&nbsp;<input type="text"  name="add1" value=""></td></tr>
    <tr><td>Address Line 2: <input type="text"  name="add2" value=""></td></tr>
    <tr><td>
     Description: &nbsp;<input type="text"  name="description" value=""></td>
   
   <td><input type="submit" value=" SAVE"  ONCLICK="javaFunctionNewSite();return false;"></td>

   </tr>

</table>
</div>   

 
 </form>

     <?         
       }

    $db->close();
     ?>
      </body>
     </html>
