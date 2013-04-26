
<html>



<link rel="Stylesheet" href="../icons/spgm_style.css" />
<meta http-equiv="Content-Language" content="en-us">
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">





<div align="center">
  <center>
  <table border="5" cellpadding="0" cellspacing="0" style="border: 1px solid #10ca0bf;" bordercolor="#C0C0C0" width="95%" >
    <tr>
    <td align=right></td></tr>
    <tr>
      <td >  


<table cellpadding="0" cellspacing="0"   align = "center"id="AutoNumber1" height="232">
  <tr>
    <td width="25%" height="19"class ="latestcell">Welcome</td>
    <td width="25%" height="19"class ="latestcell"><?php echo $username ; ?></td>
    <td width="25%" height="19"class ="latestcell"></td>
    <td width="25%" height="19"class ="latestcell">my Buddylist</td>
  </tr>
  <tr>
    <td width="5%" height="84">
    <p align="center"><?php echo GetUserPicture($userid); ?></td>
    <td width="28%" height="84"class ="logo" >
	
    <p align="center">&nbsp;</td>
    <td width="5%" height="30">&nbsp;</td>
    <td width="15%" height="30" align =center class ="searchmembercell" ><div id ="buddylist"></div>&nbsp;</td>
  </tr>
  <tr>
    <td width="25%" height="19"class ="latestcell"></td>
    <td width="25%" height="19"class ="latestcell"></td>
    <td width="25%" height="19"class ="latestcell">&nbsp;</td>
    <td width="25%" height="19"class ="latestcell" >Users in my group<div  id ="yourfriends"></div></td>
  </tr>
  <tr>
    <td width="25%" height="19"class ="latestcell"><a href="../selectAlbumUpload/SelectAlbum.php">Upload pictures</a></td>
    <td width="25%" height="19"class ="latestcell">Set privacy</td>
    <td width="25%" height="19"class ="latestcell">Delete Album</td>
    <td width="25%" height="114" rowspan="6"align ="center"class ="searchmembercell">
	
	<form id ="Searchmember" action="javascript:void(null);"onsubmit= "xajax_SearchMember(xajax.getFormValues('Searchmember'),'');">
<table width = 30% class = "searchmemberform" style="border-collapse: collapse" bordercolor="#111111" cellpadding="0" cellspacing="0" height="145">
<tr> <td  colspan = 2 height="14"> 
 <p align="center"><strong><font size="4" color="#FFFFFF">Search member<div id = "memerror"></div></font></strong></td></tr>
<tr> <td height="22" class ="mysearchtext">Username</td><td height="22"><font color="#C0C0C0"><input type = "text" size = "12" id ="memname"name ="mem01"  ></font></td></tr>

<tr> <td height="22"class ="mysearchtext" >Country <font size="1">(</font><i><font size="1">optional)</font></i></td>
  <td height="22"><font color="#C0C0C0"><input type = "text" size = "12" id = "memcountry" name ="mem02"></font></td></tr>
<tr> <td  colspan="2" height="30"><i><font size="2"class ="mysearchtext">if you know the album name please enter it below</font></i></td></tr>

<tr> <td height="31"class ="mysearchtext" >OwnAlbum <i><font size="1">(optional)</font></i></td>
  <td height="31"><font color="#C0C0C0"><input type = "text" size = "12" id = "memAlbum"name ="mem03" ></font></td></tr>
<tr> <td height="26" >
  <p align="center"><font size="1"><input type = "submit"  value ="Go" id ="mem04"></font></td>
  <td height="26">
  <p align="center"><font size="1"><u><i><b><input type = "reset"  value ="Clear"></b></i></u></font></td></tr>


</table>
</form>


</td>
  </tr>
  <tr>
    <td width="25%" height="19"class ="latestcell"><a href = "../createAlbumUpload/CreateAlbum.php" >Create a new  album</a></td>
    <td width="25%" height="19"class ="latestcell"><a href = "selectalbum.php">Edit my Albums</a></td>
    <td width="25%" height="19"class ="latestcell">No of Albums :<?php echo countnoofalbums($userid) ;?></td>
  </tr>
  <tr>
   
    
  </tr>
  <tr>
    <td width="25%" height="19"class ="latestcell">Your Albums</td>
    <td width="25%" height="19"class ="latestcell">&nbsp;</td>
    <td width="25%" height="19"class ="latestcell">&nbsp;</td>
  </tr>
  
  <tr>
    <td width="75%" height="86" colspan="3" rowspan="2"class ="latestcell"><div id ="mytable"> </div></td>
  </tr>
  <tr>
    
  </tr>
  <tr>
    <td width="25%" height="19"class ="latestcell">&nbsp;</td>
    <td width="25%" height="19"colspan="0"class ="latestcell">&nbsp;</td>
    <td width="25%" height="19"class ="latestcell"></td>
    <td width="25%" height="19"class ="latestcell">Sample latest Albums <div id ="latestalbums"></div></td>
  </tr>
  
</table>



	  
	  

	  </td>
    </tr>
  </table>
  </center>
</div>


</html>

