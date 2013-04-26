<?php require ("viewalbum2.php");?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<HTML>
<HEAD>
<link href="css/style.css" type="text/css" rel="stylesheet">

<TITLE></TITLE>
<?php $xajax->printJavascript(); ?>
<SCRIPT LANGUAGE="JavaScript"   src="autocomplete/actb.js">

</script>
<script language="javascript" type="text/javascript" src="autocomplete/common.js"></script>
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
<SCRIPT LANGUAGE="JavaScript">


<!-- Begin
function textCounter(field, countfield, maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else 
countfield.value = maxlimit - field.value.length;
}







    
// End -->


</script>
</HEAD >

<BODY onload = "xajax_checkstatus();xajax_loadArrayTag();" > 

<!--Start of logo table-->
<table id="wapper" border=0 >
 <tr>
       <td id="topleft">&nbsp;</td>
       <td id="top">&nbsp;</td>
       <td id="topright">&nbsp;</td>
     </tr>


<tr><td id="left"></td>

<td id="logocenter">
       <p><span id="title"><img src="css/logo.jpg"width="300" height="60"></span><span id ="logosmall"> ...for people</span>
       
     
       
 <span id="logosearch">&nbsp;&nbsp;&nbsp;Search Picture &nbsp;<input type="text" size =20 id="search">&nbsp;in <select name="Choice" id = "albumchoice">
<option Selected value="albums">Albums</option>
<option value="events">Events</option>
<option value="members">People</option>
<option value="sites">Places</option>
</select>
<script>
</script>
<INPUT type="image" alt= "Search" src="css/button_go.gif"
                  value="lookin" id ="mybut" width="32" height="21" name="go"  onclick ="init();xajax_hide();
				  xajax_hideform('formcomments');xajax_ListRelated(document.getElementById('search').value,document.getElementById('albumchoice').value,'');"></span>
				 <span id="error"class="showmsg"></span>
				  </p> 
       </td>


       <td id="right">&nbsp;</td>
     </tr>
     <tr>
       <td id="bottomleft">&nbsp;</td>
       <td id="bottom">&nbsp;</td>
       <td id="bottomright">&nbsp;</td>
     </tr>
</table>


<!--End of logo table-->
<!--Start of Menu-->
<?php include ("menu.php");?>
<!--End of Menu-->

<!--Start of Middle tables-->


	
	
	
	
	
	
	
	<!--Start of main table-->
	
	
	<table id="wapper" border=0>
	 <tr> 
	 
	       
	       <td id="topleft">&nbsp;</td>
	       
	       <td id="top">&nbsp;</td>
	       
	       
	       <td id="topright">&nbsp;</td>
	       
	     </tr>
	
	
	<tr>
	<td id="left">&nbsp;</td>
	
	
	<td id="center">
	<!--here i will include a table to hold all the divs in this part  -->
	
	<table cellpadding="0" cellspacing="0" style="border-collapse: collapse; border-width: 0; text-align:center" bordercolor="#111111" width="100%" id="AutoNumber1" align="center" height="298">
  <tr>
  
    <td width="20%" style="border-style: none; border-width: medium" align="center" ><div id="title1" ></div></td>
    <td width="20%" style="border-style: none; border-width: medium" align="center" ><div id ="back"></div></td>
    <td width="20%" style="border-style: none; border-width: medium" align="center" ><div id= "option" class ="slidetext"></div> </td>
    <td width="20%" style="border-style: none; border-width: medium" align="center" ><div id="orderby" class ="ordertext">Sort by:
	 
	 <select id="orderselect" name="select" onchange="xajax_DisplayAlbums('',document.getElementById('orderselect').value);">
				<option selected="selected" value="">none</option>
				<option value="Date">By date</option>
				<option value="View">Most viewed</option>
				</select></div></td>
				
				
    <td width="20%" style="border-style: none; border-width: medium" align="center" height="17"></td>
  </tr>
  <tr>
    <td width="20%" style="border-style: none; border-width: medium" align="center" height="17"><div id= "loginform" class="hidemsg"><?php include("Sign_In/signin.php"); ?></div></td>
    <td width="20%" style="border-style: none; border-width: medium" align="center" height="17"></td>
    <td width="20%" style="border-style: none; border-width: medium" align="center" height="17"></td>
    <td width="20%" style="border-style: none; border-width: medium" align="center" height="17">
   <div id ="mysearch" class="hidemsg">
			<!--will include the search page here-->
			<?php include ("search/form.php");	?>


			</div>
			</td>
    <td width="20%" style="border-style: none; border-width: medium" align="center" ></td>
  </tr>
  <tr>
    <td width="20%" style="border-style: none; border-width: medium" align="center"></td>
    <td width="20%" style="border-style: none; border-width: medium" align="center" ></td>
    <td width="20%" style="border-style: none; border-width: medium" align="center" ></td>
    <td width="40%" style="border-style: none; border-width: medium" align="center" colspan="2">
   <div id ="Form100" class="hidemsg">
   <?php include("imageDetails/imagecommentform.php");?></div></td>
  </tr>
  <tr>
    <td width="60%" style="border-style: none; border-width: medium" align="center" colspan="3" rowspan="2" >
   <div id ="table"></div></td>
   
   
    <td width="40%" style="border-style: none; border-width: medium" align="center" colspan="2" >
    <div id ="imageDetails"></div></td>
  </tr>
  <tr>
    <td width="40%" style="border-style: none; border-width: medium" align="center" height="51" colspan="2" rowspan="3">
    <div id ="imagecomments" class ="hidemsg"> </div>
	<div id ="imageEditAreaBox" class ="hidemsg">
	<table class="table-wrapper-comment"  height="76" bgcolor="#C4E1FF" style="border-collapse: collapse" bordercolor="#111111" cellpadding="0" cellspacing="0" width = 30>
	
	<tr><td  class ="td-thumbnailsHeader" height="12">
      <p align="center"><b>Edit Comment</b></td></tr>
	  <tr><td  class ="td-thumbnailsHeader" height="12"><form>
	<textarea rows="4" cols="20" name ="Editmyimagecomments" id ="com3"onKeyDown="textCounter(this.form.Editmyimagecomments,this.form.remLen,50);"
		onKeyUp="textCounter(this.form.Editmyimagecomments,this.form.remLen,50);"></textarea></td></tr>
		<tr><td><input readonly type=text name=remLen size=3 maxlength=3 value="50"> characters left</tr></td>
	<tr><td  class ="td-thumbnailsHeader" height="12">
	 <input id="submitButton6" type="button" value="Edit" onclick="xajax_EditImagecomment(document.getElementById('com3').value);return false;">
	 <input id="submitButton7" type="button" value="Hide" onclick="xajax_HideImageEditFormDIV();return false;"></form>
	</td></tr></table>
	</div></td>
  </tr>
  <tr>
    <td width="60%" style="border-style: none; border-width: medium" align="center" colspan="3" height="17">
     <div id ="HomeTable" ><?php include ("HomeFunction/home.php");	?></div></td>
	 
  </tr>
  <tr>
    <td width="60%" style="border-style: none; border-width: medium" align="center" colspan="3" height="17">
    <div ></div></td>
	
  </tr>
  <tr>
    <td width="60%" style="border-style: none; border-width: medium" align="center" colspan="3" height="17">
   <div id ="comments">
	</div></td>
    <td width="40%" style="border-style: none; border-width: medium" align="center" height="49" colspan="2" rowspan="3">
     <div id ="imagetools"></div></td>
  </tr>
  <tr>
    <td width="60%" style="border-style: none; border-width: medium" align="center" colspan="3" height="15">
    <div id ="comment_Form" >
	<?php include ("Comment_form.php");?>
	</div></td>
	
  </tr>
  <tr>
    <td width="60%" style="border-style: none; border-width: medium" align="center" colspan="3" height="17">
	
   <div id ="registerdiv" class="hidemsg">
	<!--will include the register page here-->
	<?php include ("Register/Register.php");?>
	</td>
	
    <td width="20%" style="border-style: none; border-width: medium" align="center" height="17"></td>
    <td width="20%" style="border-style: none; border-width: medium" align="center" height="17"></td>
  </tr>
</table>

	

	

	
	
	       </td><!-- End of table tht will contain all the divs-->
	
	
	       <td id="right">&nbsp;</td>
	     </tr>
	     <tr>
	     
	       <td id="bottomleft">&nbsp;</td>
	       
	       <td id="bottom">&nbsp;</td>
	       <td id="bottomright">&nbsp;</td>
	     </tr>
	</table>
	

<!--End of main table-->
	
	

	
	


<!--End of Middle tables-->


<!--Start of footer table-->
<table id="wapper" border=0>
 <tr>
       <td id="topleft">&nbsp;</td>
       <td id="top">&nbsp;</td>
       <td id="topright">&nbsp;</td>
     </tr>


<tr><td id="left"></td>

<td id="logocenter">
       <p align = "center"><span id="title"><a name="abtus"><?php include("Footer.html"); ?></span></p>
 
       </td>


       <td id="right">&nbsp; </td>
     </tr>
	
     <tr>
       <td id="bottomleft">&nbsp;</td>
       <td id="bottom">&nbsp;</td>
       <td id="bottomright">&nbsp;</td>
     </tr>
</table>


<!--End of footer table-->


</BODY>
</HTML>
