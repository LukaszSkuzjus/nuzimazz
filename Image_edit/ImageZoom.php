<?php
session_start();
$memFolder=$_SESSION['userId'];
global $img;
include("dbconn.php");


$flag=$_GET["flag"];
if(empty($flag)) 
{ $flag=0;
}


   if (isset($_GET[p])){
	// Retrieve the GET parameters and executes the function
	  $funcName	 = $_GET[p];
	  $vars	  = $_GET[vars];
      if(!$vars)
      {  $vars=$_GET[Undo];
            }
     
  // getting the value as a string via url and building them in a way to call the function in php as shown below
	      $funcName($vars); 
       
       } 
  



?>
<html>
<head><title>Image editing</title>
   <style>
      #colordiv{
    position:absolute;
    left:10px;
    top:310px;
    z-Index:60;
    visibility:hidden;
    }
    
        #clipdiv{
    position:absolute;
    left:210px;
    top:390px;
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
    
    #resizediv{
    position:absolute;
    right:20px;
    top:250px;
    z-Index:40;
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
   
   <script language="javascript">

    //Browsercheck (needed) ***************
    function lib_bwcheck(){
      this.ver=navigator.appVersion
      this.agent=navigator.userAgent
      this.dom=document.getElementById?1:0
      this.opera5=this.agent.indexOf("Opera 5")>-1
      this.ie5=(this.ver.indexOf("MSIE 5")>-1 && this.dom && !this.opera5)?1:0;
      this.ie6=(this.ver.indexOf("MSIE 6")>-1 && this.dom && !this.opera5)?1:0;
      this.ie4=(document.all && !this.dom && !this.opera5)?1:0;
      this.ie=this.ie4||this.ie5||this.ie6
      this.mac=this.agent.indexOf("Mac")>-1
      this.ns6=(this.dom && parseInt(this.ver) >= 5) ?1:0;
      this.ns4=(document.layers && !this.dom)?1:0;
      this.bw=(this.ie6||this.ie5||this.ie4||this.ns4||this.ns6||this.opera5)
      return this
    }
    bw=new lib_bwcheck() //Browsercheck object
     //Debug function ******************
    function lib_message(txt){alert(txt); return false}
  
  //Document size object ********
    function lib_doc_size(){
      this.x=0;this.x2=bw.ie && document.body.offsetWidth-20||innerWidth||0;
      this.y=0;this.y2=bw.ie && document.body.offsetHeight-5||innerHeight||0;
      if(!this.x2||!this.y2) return message('Document has no width or height')
      this.x50=this.x2/2;this.y50=this.y2/2;
      return this;
    }

    
    //Lib objects  ********************
    function lib_obj(obj,nest){
      if(!bw.bw) return lib_message('Old browser')
      nest=(!nest) ? "":'document.'+nest+'.'
      this.evnt=bw.dom? document.getElementById(obj):
        bw.ie4?document.all[obj]:bw.ns4?eval(nest+"document.layers." +obj):0;
      if(!this.evnt) return lib_message('The layer does not exist ('+obj+')'
        +'- \nIf your using Netscape please check the nesting of your tags!')
      this.css=bw.dom||bw.ie4?this.evnt.style:this.evnt;
      this.ref=bw.dom||bw.ie4?document:this.css.document;
      this.x=parseInt(this.css.left)||this.css.pixelLeft||this.evnt.offsetLeft||0;
      this.y=parseInt(this.css.top)||this.css.pixelTop||this.evnt.offsetTop||0
      this.w=this.evnt.offsetWidth||this.css.clip.width||
        this.ref.width||this.css.pixelWidth||0;
      this.h=this.evnt.offsetHeight||this.css.clip.height||
        this.ref.height||this.css.pixelHeight||0
      this.c=0 //Clip values
      if((bw.dom || bw.ie4) && this.css.clip) {
      this.c=this.css.clip; this.c=this.c.slice(5,this.c.length-1);
      this.c=this.c.split(' ');
      for(var i=0;i<4;i++){this.c[i]=parseInt(this.c[i])}
      }
      this.ct=this.css.clip.top||this.c[0]||0;
      this.cr=this.css.clip.right||this.c[1]||this.w||0
      this.cb=this.css.clip.bottom||this.c[2]||this.h||0;
      this.cl=this.css.clip.left||this.c[3]||0
      this.obj = obj + "Object"; eval(this.obj + "=this")
      return this
    }
        //Showing object ************
    lib_obj.prototype.showIt = function(){this.css.visibility="visible"}

    //Hiding object **********
    lib_obj.prototype.hideIt = function(){this.css.visibility="hidden"}
    
        function init(){
     
      objresize=new lib_obj('resizediv');
      objrotate=new lib_obj('rotatediv');
       objclip=new lib_obj('clipdiv');
      
        
      }

 
       
  function javaFunction()
  { 
	// In the varArray are all the variables you want to give with the function
	var varArray = new Array();
	if(document.Image.Width.value==" " || document.Image.Width.value==0 && document.Image.Height.value==" " || document.Image.Height.value==0)
       {	    alert('Unsupported Values: Width/height !'); 
                 return false;       
       }
          else
          {  varArray[0] = document.Image.Width.value;
               varArray[1] = document.Image.Height.value;
          }
	// the url which you have to reload is this page, but you add an action to the GET- or POST-variable
	var url="<?php echo $_SERVER[PHP_SELF];?>?p=phpFunctionResize&vars="+varArray+"&flag=1";
	
	// Opens the url in the same window
	   window.open(url, "_self");
	  
      }
      
   

      function javaFunctionUndo()
   {  // In the varArray are all the variables you want to give with the function
      //read query from url to get the counter for undo from vars
            <?php $ImageArray=$_SESSION["imgArray"];
             $num=count($ImageArray);
            ?>;
      
       // create JavaScript variable, fill it with Php variable
   var recordImages = "<? print $num; ?>";
   
   // output to screen
  var counter=1;

          
    query = location.search.substring(1);
    pairs = query.split("&");
    for(i=0; i<pairs.length; i++){
        key   = pairs[i].split("=")[0];
        value = pairs[i].split("=")[1];
        if(key =='Undo' ){
            value++;
            counter=value;
        }
        
    }
    
        var varArray = new Array();
      varArray[0]=counter;
   
           if(recordImages==1 || counter>=recordImages) 
           {       varArray[0]=1;
            alert('No undo Event');
            return false;
	// the url which you have to reload is this page, but you add an action to the GET- or POST-variable
	//var url="<?php echo $_SERVER[PHP_SELF];?>?p=phpFunctionUndo&vars="+varArray+"&flag=1";
	}
    
    else
    { 
    var url="<?php echo $_SERVER[PHP_SELF];?>?p=phpFunctionUndo&Undo="+varArray+"&flag=2";
    }
	// Opens the url in the same window
	   window.open(url, "_self");
	   
       
       
      }
             
  function javaFunctionRotate()
  { 
	// In the varArray are all the variables you want to give with the function
	var varArray = new Array();
	if(document.Image.angle.value==" " && document.Image.mirror.value==" ")
    {	     alert('Unselected Angle/mirror Fields!');
          return false;
       }
          else
          {  varArray[0] = document.Image.angle.value;
               varArray[1] = document.Image.mirror.value;
          }
	// the url which you have to reload is this page, but you add an action to the GET- or POST-variable
	var url="<?php echo $_SERVER[PHP_SELF];?>?p=phpFunctionRotate&vars="+varArray+"&flag=1";
	
	// Opens the url in the same window
	   window.open(url, "_self");
	  
      }
      
 function javaFunctionSave()
  { 
   <?php $ImageArray=$_SESSION["imgArray"];
             $num=count($ImageArray);
            ?>;
      
       // create JavaScript variable, fill it with Php variable
   var recordImages = "<? print $num; ?>";
   
	

if (recordImages==1)
 {
   alert('No edited image to save!');
 }
 else
 {
 var  ans= confirm("Save Changes?");

    if(ans==true)
    {
      //save edited image to original image folder uploaded 
     
   <?php  $ImageArray=$_SESSION["imgArray"];   $num=count($ImageArray)-1;?>
  var edited="<?print $ImageArray[$num];?>";
           
	// the url which you have to reload is this page, but you add an action to the GET- or POST-variable
	var url="<?php echo $_SERVER[PHP_SELF];?>?p=phpFunctionSave&vars="+edited+"&flag=1";
	
	// Opens the url in the same window
	   window.open(url, "_self");
     }

}

    
      }
       
      
      
      
      
      
      
      
      
       
       function javaFunctionCrop()
  { 
	// In the varArray are all the variables you want to give with the function
	var varArray = new Array();
	if(document.Image.offset_left.value=="" || document.Image.offset_top.value=="" || document.Image.offset_left.value==""|| document.Image.offset_top.value=="")
    {	     alert('Required Fields Blank!');
          return false;
       }
          else
          {  varArray[0] = document.Image.offset_left.value;
               varArray[1] = document.Image.offset_top.value;
               varArray[2] = document.Image.offset_right.value;
               varArray[3] = document.Image.offset_bottom.value;
          }
	// the url which you have to reload is this page, but you add an action to the GET- or POST-variable
	var url="<?php echo $_SERVER[PHP_SELF];?>?p=phpFunctionCrop&vars="+varArray+"&flag=1";
	
	// Opens the url in the same window
	   window.open(url, "_self");
	  
      }
      
  
  

  
    </script>

 
</head>
<body onload="init();" >
<?php


echo"<h2 align=right>Edit Image Options</h2><br><br><br>";

?>
<br>


<div id="tooldiv">
<table border="1" width="800px" cellspacing="2" cellpadding="2"class="white">
   <th rowspan=2>Image Modify Toolbars                             
     </th>
      <tr>
           <td align="center"><A href="#"  onclick="objresize.showIt();return false;">Resize</a></td>
  
           <td align="center"><A href="#" onclick="objrotate.showIt();return false;">Rotate - Mirror</a></td>
      
           <td align="center"><A href="#" onclick="objclip.showIt();return false;">Cropping</a></td>
                
                 
          <td align="center"><A href="#" onclick="javaFunctionUndo();return false;"><img src="icon.gif" alt="Undo action" border=0> </a>Undo</td>
              
           <td align="center"><A href="#" onclick="javaFunctionSave();return false;"><img src="icon_save.gif" alt="Save Current viewing image" border=0> </a>Save</td>
      </tr>
 </table>  
</div> 
     
<?




if($flag==0)
{ global  $ImageArray;
$ImageArray=array();

$img=$_GET["ImgId"];
$result=$db->query("SELECT * FROM images WHERE ImageId=$img");


while ($row = $result->fetch_assoc()) 
{
      $string=$row["Url"];
       $add = "../Images/".$row["Url"];
       $info= getimagesize("$add"); 
       //rounding figure
   $size = ceil(filesize($add)/1024);
       $filename=substr($string,2,strlen($string)-1); 
copyImageFile($filename,$string);                            
 $_SESSION["OriginalPath"]= $string;

 $ImageArray[]=$filename;

 
   $_SESSION["imgArray"]= $ImageArray;
   
       ?>
       
<div id="tooldiv2">
<table border="1" width="200px" cellspacing="2" cellpadding="2"class="white">
<th align="right">Image Properties</th>
  <tr> 
  <td align="center">Name: <?php echo $row["ImageName"];?></td></tr>
   <tr><td align="center">Date Uploaded: <?php echo $row["DateUploaded"];?></td></tr>
   <tr><td align="right">Description: <?php echo $row["Description"];?></td></tr>
   <tr><td align="right">attr: <?php echo $info[3];?></td></tr>
  <tr><td align="right">Size: <?php echo $size;?> Kb</td></tr>
   <tr><td align="Left">Status:<?php checkEditSupport($filename)?></td></tr>

  
</table> 
      
     <?}
     $result->free();
$db->close();
     }
 
if($flag==1)
{ 
    displayImage();
}

if($flag==2)
{ //undo event

$ImageArray=$_SESSION["imgArray"];
       $num=count($ImageArray);
       $undoCount=$_SESSION["CurrentCount"];
       $index=$num-$undoCount;
    
          
       if($num<=$undoCount)
       {  return;
       }
           else
             {
            
              displayImageInfo($ImageArray[$index-1]);
             }
	


}

 
?>    
 <form name="Image">
  
     
  <div id="resizediv">
<table border="0" cellspacing="2" cellpadding="2" class="white">
  <th colspan="3">
    Resize
  </th>
  <th>
   <A href="#" onclick="objresize.hideIt();return false;">CLOSE</a>
  </th>
  <tr>
   <td>
       Width <input type="text" size="3" name="Width" value=" ">&nbsp;px   </td>

   <td>
     Height <input type="text" size="3" name="Height" value=" ">&nbsp;px   </td>
   
   <td><input type="submit" value=" APPLY "  ONCLICK="javaFunction();return false;"></td>

   </tr>

</table>
</div>   
     
 </div>

<div id="rotatediv">
<table border="0" cellspacing="2" cellpadding="2" class="white">
  <th colspan="2">
    Rotate
  </th>
  <th>
   <A href="#" onclick="objrotate.hideIt();return false;">CLOSE</a>
  </th>
  <tr>
    <td>
      <select name="angle">
      <option value=" " selected>Rotate
      <option value="90">Left (-90&#176;)
      <option value="180">Flip (180&#176;)
      <option value="270">Right (+90&#176;)
      </select>
   </td>
   <td>
    <input valign="bottom" type="checkbox" name="mirror" value=" " onchange="document.Image.mirror.value=true";>
      Mirror
    </td>

   <td><input type="submit" value=" APPLY " ONCLICK="javaFunctionRotate();return false;"></td>
   </tr>

</table>
</div>
     
     
<div id="clipdiv">
<table cellspacing="2" cellpadding="2" class="white">
   <th colspan="4">
    Cropping
   </th>
   <th>
     <A href="#" onclick="objclip.hideIt();return false;">CLOSE</a>
   </th>

   <tr>
    <td>Left</td><td><input name="offset_left" type="text" value="" size="2"> px</td>
    <td>Top</td><td><input name="offset_top" type="text" value="" size="2"> px</td>
    <td><input type="hidden" name="tocrop"></td>
   </tr>
   <tr>
     <td>Right</td><td><input name="offset_right" type="text" value="<?php echo $info[0]; ?>" size="2"> px</td>
     <td>Bottom</td><td><input name="offset_bottom" type="text" value="<?php echo $info[1];?>" size="2"> px</td>
     <td><input type="submit" value=" APPLY " ONCLICK="javaFunctionCrop();return false;"></td>
   </tr>

</table>
</div>
     
     
     

     
     
     
     
     
     
     
     
     
   </form>  
     
     </body>
     </html>
     
<?     
     




?>