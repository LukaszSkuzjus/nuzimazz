<?php
require ('../xajax.inc.php');
include("Ratingsystem.php");
$imageid =$_GET["imageid"];
$userid =$_GET["userid"]; 
function ShowRateOptions($imageid,$userid)

{
//need to get the $imageid,$userid



//show the rating options good poor super

//draw table
$table="
<table border=\"1\" cellpadding=\"0\" cellspacing=\"0\" style=\"border-collapse: collapse\" bordercolor=\"#111111\" align = center width=\"80%\" id=\"AutoNumber1\" bordercolorlight=\"#00FF00\" bordercolordark=\"#00FF00\" bgcolor=\"#CDE8FC\">
  <tr>
    <td width=\"50%\" align=\"center\"><i><b><font color=\"#B5B5B5\" face=\"Garamond\">Poor</font></b></i></td>
    <td width=\"25%\" align=\"center\">
    <i><b><font color=\"#B5B5B5\" face=\"Garamond\">
    <img border=\"0\" src=\"glossaryIcon.gif\" width=\"11\" height=\"11\"></font></b></i></td>
    <td width=\"25%\" align=\"center\"><i><b><font color=\"#B5B5B5\" face=\"Garamond\">
    <a href=\"javascript:void(null);\"onclick = \" xajax_Ratepictures($imageid,$userid,1);  \">Rate</a></font></b></i></td>
  </tr>
  <tr>
    <td width=\"50%\" align=\"center\"><i><b><font color=\"#0000FF\" face=\"Garamond\">Good</font></b></i></td>
    <td width=\"25%\" align=\"center\">
    <i><b><font color=\"#B5B5B5\" face=\"Garamond\">
    <img border=\"0\" src=\"glossaryIcon.gif\" width=\"11\" height=\"11\"><img border=\"0\" src=\"glossaryIcon.gif\" width=\"11\" height=\"11\"></font></b></i></td>
    <td width=\"25%\" align=\"center\"><i><b><font color=\"#B5B5B5\" face=\"Garamond\">
    <a href=\"javascript:void(null);\"onclick = \" xajax_Ratepictures($imageid,$userid,2); \">Rate</a></font></b></i></td>
  </tr>
  <tr>
    <td width=\"50%\" align=\"center\"><i><b><font color=\"#FF6600\" face=\"Garamond\">Super</font></b></i></td>
    <td width=\"25%\" align=\"center\">
    <i><b><font color=\"#B5B5B5\" face=\"Garamond\">
    <img border=\"0\" src=\"glossaryIcon.gif\" width=\"11\" height=\"11\"><img border=\"0\" src=\"glossaryIcon.gif\" width=\"11\" height=\"11\"><img border=\"0\" src=\"glossaryIcon.gif\" width=\"11\" height=\"11\"></font></b></i></td>
    <td width=\"25%\" align=\"center\"><i><b><font color=\"#B5B5B5\" face=\"Garamond\">
    <a href=\"javascript:void(null);\"onclick = \" xajax_Ratepictures($imageid,$userid,3); \">Rate</a></font></b></i></td>
  </tr>
  <tr>
    <td width=\"100%\" align=\"center\" colspan=\"3\"><i><b>
    <font color=\"#B5B5B5\" face=\"Garamond\"><a href = \"javascript: self.close ()\" >Close Window </a></font></b></i></td>
  </tr>
</table>";//end of $table






return $table;
}
$xajax = new xajax();
//$xajax->debugOn(); 


$xajax->registerFunction("Ratepictures");
$xajax->processRequests();
?>

<html>
<head><?php $xajax->printJavascript();?>

<SCRIPT LANGUAGE="JavaScript">


<!-- hide from old browsers

var init_msg = "Nu Zimazz Ajax photo Album" 

var str = "" 
var msg = "" 
var leftmsg = "" 


function setMessage()
{
    if (msg == "") 
    {
        str = " "         
        msg = init_msg    
        leftmsg = ""      
    }
    
    if (str.length == 1) 
    {
        
        while (msg.substring(0, 1) == " ")
        {
            leftmsg = leftmsg + str            
            str = msg.substring(0, 1)           
            msg = msg.substring(1, msg.length) 
        }
        leftmsg = leftmsg + str            
        str = msg.substring(0, 1)           
        msg = msg.substring(1, msg.length) 
        for (var ii = 0; ii < 120; ii++) 
            {str = " " + str}           
                        }
    else
    {
        str = str.substring(10, str.length) // decrease str little by little
    }


    window.status = leftmsg + str
    JSCTimeOutID = window.setTimeout('setMessage()',50)
}

<!-- done hiding -->

</SCRIPT>



 

<title>Rating Image</title>
<link rel="Stylesheet" href="../css/style.css" type="text/css"/>
<link rel="Stylesheet" href="../icons/spgm_style.css" />
</head>


<body onload="JSCTimeOutID = window.setTimeout('setMessage()',500);">
<?php 


echo ShowRateOptions($imageid,$userid);

?>
<div align="center" id = "ratingtable" class ="hidemsg">
  <center>
  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#B7B7B7" width="80%" id="AutoNumber1" height="36" background="head_right.gif">
    <tr>
      <td width="100%" height="54">
      <p align="center"><i><b>
      <font color="#0000FF" face="Monotype Corsiva" size="4">Nu Zimazz</font><font color="#00FF00">Thank you for voting</font></b></i></p>
      <p>&nbsp;</p>
     </td>
    </tr>
  </table>
  </center>
</div>

</body>
</html