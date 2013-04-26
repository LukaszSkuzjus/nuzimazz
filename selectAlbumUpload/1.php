

<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>One image upload</title>
<link href="../css/style.css" type="text/css" rel="stylesheet">
<meta name="GENERATOR" content="Arachnophilia 4.0">
<meta name="FORMATTER" content="Arachnophilia 4.0">



<SCRIPT LANGUAGE="JavaScript">
 
 function BrowserCheck()
 {
 if(navigator.appName == "Netscape")
{
 alert("Image Preview Is not available.")
}


}
<!-- Original:  ArjoGod, Shauna Merritt -->
<!-- Modified By:  Ronnie T. Moore, Editor -->

<!-- Begin

/* The script for preview image
The JavaScript Source!! http://javascript.internet.com
Created by: Abraham Joffe :: http://www.abrahamjoffe.com.au/ */

/***** CUSTOMIZE THESE VARIABLES *****/ // width to resize large images to
var maxWidth=100; // height to resize large images to
var maxHeight=100; // valid file types
var fileTypes=["bmp","gif","png","jpg","jpeg"]; // the id of the preview image tag
var outImage="previewField"; // what to display when the image is not valid
var defaultPic="default.gif";

function preview(what){ 
var source=what.value;
 var ext=source.substring(source.lastIndexOf(".")+1,source.length).toLowerCase();
for (var i=0; i<fileTypes.length; i++) 
if (fileTypes[i]==ext) break;
globalPic=new Image(); if (i<fileTypes.length) globalPic.src=source;
else { 
globalPic.src=defaultPic; 

}
setTimeout("applyChanges()",200);
}
var globalPic;

function applyChanges()
{ var field=document.getElementById(outImage);
var x=parseInt(globalPic.width); 
var y=parseInt(globalPic.height); 
if(x>maxWidth)
 { y*=maxWidth/x; x=maxWidth; } 
 if (y>maxHeight) {
x*=maxHeight/y; y=maxHeight; } 
field.style.display=(x<1 ||y<1)?"none":""; 
field.src=globalPic.src; 
field.width=x;
field.height=y;
}

extArray = new Array(".bmp",".png",".jpeg",".gif", ".jpg");
function LimitAttach(file) 
{
allowSubmit = false;
while (file.indexOf("\\") != -1)
file = file.slice(file.indexOf("\\") + 1);
ext = file.slice(file.indexOf(".")).toLowerCase();
for (var i = 0; i < extArray.length; i++) {
if (extArray[i] == ext) { allowSubmit = true; break; }
}
if (allowSubmit) return true;
else  return false;

}

function Validate()
{
 if (LimitAttach(upload.image1.value)==false || upload.image1.value=="")
 {alert("Unsupported File/Blank Field For Image");
upload.image1.focus();

return false;
 
 }


}






</script>


</head>

<body onload="BrowserCheck();" bgcolor="#ffffff" text="#000000" link="#0000ff" vlink="#800080" alink="#ff0000">
<center>
Please upload only images that end in:  
<script>
document.write(extArray.join("  "));
</script>
<?php


echo "<form name=upload method=post action=addimgck.php enctype='multipart/form-data'>";
echo "<table border='0' width='400' cellspacing='0' cellpadding='0' align=center>";
?>

<tr><td align=center>Image <input type=file name=image1 id="picField" onchange="preview(this)"></td>
<td align=center><img alt="Graphic will preview here" id="previewField" src="spacer.gif"></td>
</tr>
 
<tr><td colspan=2  align=center><input type=submit value='Add Image' onclick="return Validate();"></td></tr>

</form> </table>


</body>

</html>
