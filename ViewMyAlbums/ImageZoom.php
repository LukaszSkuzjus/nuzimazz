<?php
session_start();
global $img;
$img=$_GET["ImgId"];
include("dbconn.php");
include("delete.inc.php");


$memid=$_SESSION["Userid"];


   if (isset($_GET[p])){
	// Retrieve the GET parameters and executes the function
	  $funcName	 = $_GET[p];
	  $vars	  = $_GET[vars];
     
       // getting the value as a string via url and building them in a way to call the function in php as shown below
	      $funcName($vars); 
       
       } 
       
?>
<html>
<head><title>Image Zoom</title>
   <style>
    
    #transferdiv{
    position:absolute;
    left:610px;
    top:25px;
    z-Index:40;
     visibility:hidden;
      }
      
     #tooldiv{
    
    right:90px;
    top:180px;
     
    }

#tooldiv2{
    position:absolute;
    right:275px;
    top:225px;
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
   
    <script language="javascript">

      
 function javaFunctionDelete()
  { 
  
       // create JavaScript variable, fill it with Php variable
   var Imgid= "<? print $img; ?>";
  
 var  ans= confirm("Delete Image?");

    if(ans==true)
    {
      	// the url which you have to reload is this page, but you add an action to the GET- or POST-variable
	var url="<?php echo $_SERVER[PHP_SELF];?>?p=phpFunctionDelete&vars="+Imgid;
	
	// Opens the url in the same window
	   window.open(url, "_self");
     }

}


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


function javaFunctionChangeAlbum()
 { 
    var varArray = new Array();
      
len = document.Image.album.length;
 i = 0;
 chosen = "";

for (i = 0; i < len; i++) 
{
if (document.Image.album[i].selected) 
{ 

chosen = chosen + document.Image.album[i].value +" ";
 }
 }

 if(chosen=="")
 { 
	     alert('No album selected!');
          return false;
    
 }
 else
 {
 
  varArray[0] ="<? print $img; ?>";
  varArray[1] = chosen;
 
 // the url which you have to reload is this page, but you add an action to the GET- or POST-variable
	var url="<?php echo $_SERVER[PHP_SELF];?>?p=phpFunctionChangeAlbum&vars="+varArray;
	
	// Opens the url in the same window
	   window.open(url, "_self");
     }
}


</script>
 
</head>
<body>
<?php


echo"<h2 align=right>View Image Options</h2>";


 global  $ImageArray;
$ImageArray=array();




if(!empty($img))
{

$result=$db->query("SELECT * FROM images WHERE ImageId=$img");


     
while ($row = $result->fetch_assoc()) 
{
      $string=$row["Url"];
       $add = "../Images/".$row["Url"];
       $info= getimagesize("$add"); 
       //rounding figure
   $size = ceil(filesize($add)/1024);
       $filename=substr($string,2,strlen($string)-1); 
                           
 
   $_SESSION["imageId"]= $img;
   
       ?>
<center><img src=<?php echo $add ?> width="320" height="213"></center>        
<div id="tooldiv2">

<table border="1" width="200px" cellspacing="2" cellpadding="2"class="white">
<th align="right">Image Properties</th>
  <tr> 
  <td align="center">Name: <?php echo $row["ImageName"];?></td></tr>
   <tr><td align="center">Date Uploaded: <?php echo $row["DateUploaded"];?></td></tr>
   <tr><td align="right">Description: <?php echo $row["Description"];?></td></tr>
   <tr><td align="right">attr: <?php echo $info[3];?></td></tr>
  <tr><td align="right">Size: <?php echo $size;?> Kb</td></tr>
 
</table> 
 
  
     <?
     
     
     }
     
  
 
?>    
<div id="tooldiv">
<table border="1" width="800px" cellspacing="2" cellpadding="2"class="white">
      <tr>
           <td align="center"><A href="../Image_edit/ImageZoom.php?ImgId=<?php echo $img?>"><img src="icon_add.gif" alt="edit image" border=0> </a>Edit Image</td>
  
           <td align="center"><A href="#"onclick="showIT('transferdiv');"><img src="icon_folder.gif" alt="transfer image" border=0> </a>Transfer Image</td>
      
           <td align="center"><A href="../ReTagImage/ImageReTag.php?ImgId=<?php echo $img?>"><img src="icon_edit.gif" border=0 alt="Re-Tag Image" ></a>Re-Tag Image</td>
                 
           <td align="center"><a href="#"><img src="icon_delete.gif" alt="delete image" border=0 onclick="javaFunctionDelete();"></a>Delete Image</td></tr></table></div> 

<form name="Image">
<?php

$result=$db->query("SELECT AlbumId FROM albumcontainsimages WHERE ImageId=$img");
   
while ($row = $result->fetch_assoc()) 
{
      $a=$row["AlbumId"];
}

$result = $db->query("Select * from album where album.AlbumId NOT LIKE $a AND album.AlbumId IN(Select ownalbum.AlbumId From ownalbum where ownalbum.OwnerId=$memid) order by AlbumName");
?>

<div id="transferdiv">
<table border="0" cellspacing="2" cellpadding="2" class="white">
  <th colspan="2">
  Select Destination album
  </th>
  <th>
   <A href="#" onclick="hideIT('transferdiv');">CLOSE</a>
  </th>
  <tr>
    <td>
      <select name="album" size=5>
    
 <? while ($row = $result->fetch_assoc()) { ?>
<option value="<?echo $row["AlbumId"] ?>"><?echo $row["AlbumName"];}//end of while loop  ?> </option></select>

<td><input type="submit" value=" APPLY " ONCLICK="javaFunctionChangeAlbum();return false;"></td>
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
