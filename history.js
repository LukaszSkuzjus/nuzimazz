

var expectedHash = "";
var Albumid;


function makeHistory(newHash)
{	
  window.location.hash = newHash;
  expectedHash = window.location.hash;
  return true;
}

function reportOptionValue(value)
{
  return value;
}

function setOptionValue(value)
{
  var myForm = document.make_history;
  var mySelect = myForm.change_year;
  mySelect.options[value-1].selected = true;
  return true;
}

function handleHistory()
{
  if ( window.location.hash != expectedHash )
  {
    expectedHash = window.location.hash;
    var newoption = expectedHash.substring(1);
	
   CallMyFunction(newoption);
  }
 
  
  return true;
 
}

function pollHash() {
  handleHistory();
  window.setInterval("handleHistory()", 1000);
  return true;
}

function CallMyFunction(value)

{	var option=value;
 
switch(option)
	{
	case "1":
	
	{
	
	
	
		return false;
	
	}
	break;
    case "2":
	{
	
	xajax_showRegister();
	xajax_showDiv('registerdiv','Register');
	
	return false;
	}
	break;
	case "3":
	
	{
	xajax_showAlbums();
	xajax_hideRegisterForm();
	xajax_DisplayAlbums('','');
	return false;
	}
		break;
	xajax_drawTable();
		return false;
	

	}//switch

}


