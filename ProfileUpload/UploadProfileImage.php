<html>

<head><title>Check Upload if image</title>
<link href="../css/style.css" type="text/css" rel="stylesheet">
<link href="../icons/spgm_style.css" type="text/css" rel="stylesheet">
<SCRIPT LANGUAGE="JavaScript">
 function BrowserCheck()
 {
 if(navigator.appName == "Netscape")
{
 alert("Image Preview Is not available.")
}


}
/* This script and many more are available free online at
The JavaScript Source!! http://javascript.internet.com
Created by: Abraham Joffe :: http://www.abrahamjoffe.com.au/ */
/***** CUSTOMIZE THESE VARIABLES *****/ // width to resize large images to
var maxWidth=100; // height to resize large images to
var maxHeight=100; // valid file types
var fileTypes=["bmp","gif","png","jpg","jpeg"]; // the id of the preview image tag
var outImage="previewField"; // what to display when the image is not valid
var defaultPic="default.gif";
/***** DO NOT EDIT BELOW *****/
function preview(what){ 
var source=what.value;
 var ext=source.substring(source.lastIndexOf(".")+1,source.length).toLowerCase();
for (var i=0; i<fileTypes.length; i++) 
if (fileTypes[i]==ext) break;
globalPic=new Image(); if (i<fileTypes.length) globalPic.src=source;
else { 
globalPic.src=defaultPic; 
alert("THAT IS NOT A VALID IMAGE\nPlease load an image with an extention of one of the following:\n\n"+fileTypes.join(", ")); 
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
 if (LimitAttach(upload.uploadfile.value)==false || upload.uploadfile.value=="")
 {alert("Unsupported File/Blank Field For Image");
upload.uploadfile.focus();

return false;
 
 }
}
</script>
</head>
<body onload="BrowserCheck();">

<center ><p class ="showmsg">
Please upload a profile image that end only in:
<script>
document.write(fileTypes.join("  "));
</script>
</p>

<form name=upload method=post action="addimg.php" enctype="multipart/form-data">

<input type=file name=uploadfile id="picField" onchange="preview(this)" >
<img alt="Graphic will preview here" id="previewField"src="spacer.gif">
<p>
<input type=submit value="Upload"  onclick="return Validate();">
</form>
</center>


</body>
</html>