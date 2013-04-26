<?php
function ReturnArray()
{

$objResponse = new xajaxResponse();
$myarray = array('sea','sun');


$objResponse->addScript("setArray('$myarray[0]')");
		return $objResponse->getXML();
}//function

?>

