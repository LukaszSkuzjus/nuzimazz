
<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>Multiple image upload</title>
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

var maxWidth=100; // height to resize large images to
var maxHeight=100; // valid file types
var fileTypes=["bmp","gif","png","jpg","jpeg"]; // the id of the preview image tag
//var outImage="previewField1";  what to display when the image is not valid
var defaultPic="default.gif";

function preview(what)
{ 
var source=what.value;
 var ext=source.substring(source.lastIndexOf(".")+1,source.length).toLowerCase();

 for (var i=0; i<fileTypes.length; i++) 
if (fileTypes[i]==ext) break;
globalPic=new Image(); if (i<fileTypes.length) globalPic.src=source;
else 
{ 
globalPic.src=defaultPic; 

}
setTimeout("applyChanges()",200);
}
var globalPic;


function applyChanges()
{ var field;

    field=document.getElementById("previewField1");

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

function preview1(what)
{ 
var source=what.value;
 var ext=source.substring(source.lastIndexOf(".")+1,source.length).toLowerCase();

 for (var i=0; i<fileTypes.length; i++) 
if (fileTypes[i]==ext) break;
globalPic=new Image(); if (i<fileTypes.length) globalPic.src=source;
else 
{ 
globalPic.src=defaultPic; 

}
setTimeout("applyChanges1()",200);
}
var globalPic;


function applyChanges1()
{ var field;

    field=document.getElementById("previewField2");

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

function preview2(what)
{ 
var source=what.value;
 var ext=source.substring(source.lastIndexOf(".")+1,source.length).toLowerCase();

 for (var i=0; i<fileTypes.length; i++) 
if (fileTypes[i]==ext) break;
globalPic=new Image(); if (i<fileTypes.length) globalPic.src=source;
else 
{ 
globalPic.src=defaultPic; 

}
setTimeout("applyChanges2()",200);
}
var globalPic;


function applyChanges2()
{ var field;

    field=document.getElementById("previewField3");

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

function preview3(what)
{ 
var source=what.value;
 var ext=source.substring(source.lastIndexOf(".")+1,source.length).toLowerCase();

 for (var i=0; i<fileTypes.length; i++) 
if (fileTypes[i]==ext) break;
globalPic=new Image(); if (i<fileTypes.length) globalPic.src=source;
else 
{ 
globalPic.src=defaultPic; 

}
setTimeout("applyChanges3()",200);
}
var globalPic;


function applyChanges3()
{ var field;

    field=document.getElementById("previewField4");

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

function preview4(what)
{ 
var source=what.value;
 var ext=source.substring(source.lastIndexOf(".")+1,source.length).toLowerCase();

 for (var i=0; i<fileTypes.length; i++) 
if (fileTypes[i]==ext) break;
globalPic=new Image(); if (i<fileTypes.length) globalPic.src=source;
else 
{ 
globalPic.src=defaultPic; 

}
setTimeout("applyChanges4()",200);
}
var globalPic;


function applyChanges4()
{ var field;

    field=document.getElementById("previewField5");

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




extArray = new Array(".gif", ".jpg");
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
 {alert("Unsupported File/Blank Field For Image 1");
upload.image1.focus();

return false;
 
 }
 
 else
  if (LimitAttach(upload.image2.value)==false|| upload.image2.value=="")
 {alert("Unsupported File/Blank Field For Image 2");
upload.image2.focus();

return false;
 
 }
else
 if (LimitAttach(upload.image3.value)==false || upload.image3.value=="")
 {alert("Unsupported File/Blank Field For Image 3");
upload.image3.focus();

return false;
 
 }
 else
  if (LimitAttach(upload.image4.value)==false || upload.image4.value=="")
 {alert("Unsupported File/Blank Field For Image 4");
upload.image4.focus();

return false;
 
 }
 else
  if (LimitAttach(upload.image5.value)==false || upload.image5.value=="")
 {alert("Unsupported File/Blank Field For Image 5");
upload.image5.focus();

return false;
 
 }
 else
  if (upload.image1.value==upload.image2.value || upload.image1.value==upload.image3.value || upload.image1.value==upload.image4.value || upload.image1.value==upload.image5.value)
 {alert("Duplicate Images Found For Image 1!");
upload.image1.focus();

return false;
 
 }
  else
  if (upload.image2.value==upload.image3.value || upload.image2.value==upload.image4.value || upload.image2.value==upload.image5.value)
 {alert("Duplicate Images Found For Image 2!");
upload.image2.focus();

return false;
 
 }
 
  else
  if (upload.image3.value==upload.image4.value || upload.image3.value==upload.image5.value)
 {alert("Duplicate Images Found For Image 3!");
upload.image3.focus();

return false;
 
 }
 
 if (upload.image4.value==upload.image5.value)
 {alert("Duplicate Images Found For Image 4!");
upload.image4.focus();

return false;
 
 }
}






</script>


</head>

<body onload="BrowserCheck();" bgcolor="#ffffff" text="#000000" link="#0000ff" vlink="#800080" alink="#ff0000">
<center>
<h2>Please upload only images that end in:  
<script>
document.write(extArray.join("  "));
</script></h2>
<?php

$i=0;  // Maximum number of images value to be set here
echo "<form name=upload method=post action=addimgck5.php enctype='multipart/form-data'>";
echo "<table border='0' width='400' cellspacing='0' cellpadding='0' align=center>";
?>

<tr><td>Image 1&nbsp;<input type=file name=image1 id="picField1" onchange="preview(this)"></td>
<td align=center><img alt="Graphic will preview here" id="previewField1" src="spacer.gif"></td>
</tr>
 <tr><td>Image 2&nbsp;<input type=file name=image2 id="picField2" onchange="preview1(this)"></td>
 <td align=center><img alt="Graphic will preview here" id="previewField2" src="spacer.gif"></td>
 </tr>
	<tr><td>Image 3&nbsp;<input type=file name=image3 id="picField3" onchange="preview2(this)"></td>
    <td align=center><img alt="Graphic will preview here" id="previewField3" src="spacer.gif"></td>
    </tr>
<tr><td>Image 4&nbsp;<input type=file name=image4 id="picField4" onchange="preview3(this)"></td>
<td align=center><img alt="Graphic will preview here" id="previewField4" src="spacer.gif"></td>
</tr>
    <tr><td>Image 5&nbsp;<input type=file name=image5 id="picField5" onchange="preview4(this)"></td>
    <td align=center><img alt="Graphic will preview here" id="previewField5" src="spacer.gif"></td>
    </tr>
     


<tr><td colspan=2 align=center><input type=submit value='Add Image' onclick="return Validate();"></td></tr>

</form> </table>


</body>

</html>
