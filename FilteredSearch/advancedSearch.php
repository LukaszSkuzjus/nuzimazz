<?php
session_start();
include("../xajax.inc.php");

$mid=$_SESSION['Member']=$_SESSION['userId'];
include("dbconn.php");
$_SESSION['Connect']=$db;
function loadArrayTag()
{include("../dbinfo.inc.php");
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
mysql_close();
return $objResponse->getXML();

}		

$xajax = new xajax();
//$xajax->debugOn(); 
//register functions here
$xajax->registerFunction("loadArrayTag");//loads a php arrat to a js array-- in home.php
$xajax->registerExternalFunction("ListRelated","ProcessAdvSearch.php");
$xajax->registerExternalFunction("processData","ProcessAdvSearch.php");
$xajax->registerExternalFunction("display","functions.php");

$xajax->processRequests();


 ?>
<html><head>

<?php $xajax->printJavascript("../");?>
<title>Filtered Search</title>

<SCRIPT LANGUAGE="JavaScript"   src="../autocomplete/actb.js">

</script>
<script language="javascript" type="text/javascript" src="../autocomplete/common.js"></script>
<script language="javascript">
var customarray= new Array();
function myJSFunction(myarray)
{
//var myarray = new Array('an apple','alligator','elephant','pear','kingbird','kingbolt', 'kingcraft','kingcup','kingdom','kingfisher','kingpin');
var customarray=myarray;
var obj = actb(document.getElementById('search'),customarray);
 //alert(customarray[0]);
}


</script>
<link href="../icons/spgm_style.css" type="text/css" rel="stylesheet">
 <style>
       
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
<script type="text/javascript">
<!--
function Validate(){
if(document.adv.album.value=='none' && document.adv.Event.value=='none' && document.adv.Site.value=='none' && document.adv.Member.value=='none')
{ alert('Please Specify a Filter Category!');
 return false;
}
else
xajax_ListRelated(xajax.getFormValues("myform"),'');//call ajax function to process the form
//xajax_hello();
return true;
}
//-->
</script>
<script type="text/javascript" src="slider.js"></script>
<script type="text/javascript" src="javascript/lib/LibCrossBrowser.js"></script>
<script type="text/javascript" src="javascript/lib/EventHandler.js"></script>
<script type="text/javascript" src="javascript/core/form/Bs_FormUtil.lib.js"></script>
<script type="text/javascript" src="javascript/core/gfx/Bs_ColorUtil.lib.js"></script>
<script type="text/javascript" src="javascript/components/slider/Bs_Slider.class.js"></script>

</head>
<body onLoad="init();xajax_loadArrayTag();">
<H2 align=Center>Advanced Search Options</h1>

<form name="adv" id ="myform" action="javascript:void(null);" >
<table border=1>
<tr><th colspan=5>Find Related Images </th>
<td align=middle><input type="text" name="tags" id ="search" Value=""> <input type="submit" Value="Search" onclick="return Validate();">
</td>
<th colspan=2><img src="logoSearch.jpg"  width=200 height=50 alt="nuZimazz logo">
</th>
</tr>

<tr><th colspan=4>
Filters &nbsp;
</th>
<td>
Album: <select name="album">
<?php
 $result =$db->query("SELECT * FROM album");
 $countAlbum=0;
while ($row = $result->fetch_assoc())
{
?>
<option value="<?php echo $row["AlbumId"] ?>">
<?
 $countAlbum++;
echo $row["AlbumName"];
}//end of while loop
?>
</option>
<option value="none">none</option>
</select>
<input type="hidden" name="count"  Value="<?php echo $countAlbum ?>">
</td><td>

Event: <select name="Event">
<option value="none">none</option>
<?php

 $result =$db->query("SELECT * FROM events");
while ($row = $result->fetch_assoc())
{
?>

<option value="<?php echo $row["EventId"] ?>">
<?
echo $row["EventName"];
}//end of while loop
?>

</option>

</select>&nbsp;&nbsp;


</td><td>
Site: <select name="Site">
<option value="none">none</option>
<?php

 $result =$db->query("SELECT * FROM sites");
while ($row = $result->fetch_assoc())
{
?>

<option value="<?php echo $row["SiteId"] ?>">
<?
echo $row["SiteName"];
}//end of while loop

?>

</option>

</select>&nbsp;&nbsp;
</td><td>

Member:  <select name="Member">
<option value="none">none</option>
<?php
$mid=$_SESSION['Member'];
 $result =$db->query("SELECT * FROM member WHERE Member_Id IN(SELECT distinct RelatedId FROM relatedmembers where MemberId =$mid)");
while ($row = $result->fetch_assoc())
{
?>

<option value="<?php echo $row["Member_Id"] ?>">
<?
echo $row["F_Name"]."&nbsp;";
echo $row["L_Name"];
}//end of while loop


?>

</option>

</select></td></tr>

</table>
</form>
<div id = "error" class = "showmsg"></div>
<div id ="mysearch" class="hidemsg">
<?php include("form.php");?>

</div>
<br>
<br>
<div id = "result"></div>
</div>
</body>
</html>
