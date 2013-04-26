<?php
//clear all div on the page

function ShowGallery()

{$objResponse = new xajaxResponse();
//$objResponse->addAssign("UserAccountDiv","className","hidemsg");//clear useraccount
$objResponse->addAssign("HomeTable","className","hidemsg");//clear home page
$objResponse->addAssign("option","className","slidetext");
$objResponse->addAssign("registerdiv","className","hidemsg");
$objResponse->addAssign("mysearch","className","hidemsg");
$objResponse->addAssign("orderby","className","hidemsg");

return $objResponse->getXML();
}//end of function

function showRegister()
{
$objResponse = new xajaxResponse();
$objResponse->addAssign("HomeTable","className","hidemsg");//clear home page

//$objResponse->addAssign("UserAccountDiv","className","hidemsg");//clear useraccount


$objResponse->addAssign("option","className","hidemsg");
$objResponse->addAssign("formcomments","className","hidemsg");
$objResponse->addAssign("mysearch","className","hidemsg");
$objResponse->addClear("table","innerHTML");
$objResponse->addClear("comments","innerHTML");
$objResponse->addAssign("orderby","className","hidemsg");

return $objResponse->getXML();
}//end of function


function showAlbums()
{

$objResponse = new xajaxResponse();
$objResponse->addAssign("HomeTable","className","hidemsg");//clear home page
//$objResponse->addAssign("UserAccountDiv","className","hidemsg");//clear useraccount
$objResponse->addAssign("registerdiv","className","hidemsg");
$objResponse->addAssign("option","className","hidemsg");
$objResponse->addAssign("formcomments","className","hidemsg");
$objResponse->addAssign("mysearch","className","hidemsg");
$objResponse->addClear("table","innerHTML");
$objResponse->addClear("comments","innerHTML");

return $objResponse->getXML();
}//end of function
function showsearch()

{$objResponse = new xajaxResponse();



$objResponse->addAssign("HomeTable","className","hidemsg");//clear home page

$objResponse->addAssign("option","className","hidemsg");
$objResponse->addAssign("orderby","className","hidemsg");
$objResponse->addAssign("loginform","className","hidemsg");

return $objResponse->getXML();
}

function hideRegisterForm()

{$objResponse = new xajaxResponse();

$objResponse->addAssign("registerdiv","className","hidemsg");
return $objResponse->getXML();
}

function hidehomepage()

{$objResponse = new xajaxResponse();
$objResponse->addAssign("HomeTable","className","hidemsg");//clear home page

return $objResponse->getXML();
}





function showHome()
{
//show div homepage
$objResponse = new xajaxResponse();
$objResponse->addAssign("HomeTable","className","showmsg2");//clear home page

return $objResponse->getXML();
}

function HideImageDetailDiv()
{
//show div homepage
$objResponse = new xajaxResponse();
$objResponse->addAssign("imageDetails","innerHTML","");//clear imagesdetails
$objResponse->addAssign("imagecomments","innerHTML","");//clear imagesdetails
return $objResponse->getXML();

}
function showImageDetailDiv()
{
//show div homepage
$objResponse = new xajaxResponse();
$objResponse->addAssign("imageDetails","className","");//clear imagesdetails
$objResponse->addAssign("imagecomments","className","");//clear imagesdetails
return $objResponse->getXML();

}
?>

<script type="text/javascript">
    //keep around the old call function
    xajax.realCall = xajax.call;
    //override the call function to bend to our wicked ways
    xajax.call = function(sFunction, aArgs, sRequestType)
    {
        //show the spinner
        this.$('spinner').style.display = 'inline';
        //call the old call function
        return this.realCall(sFunction, aArgs, sRequestType);
    }
	
	
	
    //save the old processResponse function for later
    xajax.realProcessResponse = xajax.processResponse;
    //override the processResponse function
    xajax.processResponse = function(xml)
    {
        //hide the spinner
        //this.$('spinner').style.display = 'none';
        //call the real processResponse function
        return this.realProcessResponse(xml);
    }

</script>
<META NAME="Generator" CONTENT="TextPad 4.6">
<META NAME="Author" CONTENT="?">
<META NAME="Keywords" CONTENT="?">
<META NAME="Description" CONTENT="?">
<script src="history.js"> 
</script>