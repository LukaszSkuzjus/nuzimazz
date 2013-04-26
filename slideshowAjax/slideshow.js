//<script language="javascript">
var i,speed =5000;
var t;
function callMeAgain(albumid,jumpto)

{//call an xajax function at regular interval


i=parseInt(jumpto);
 //jump =parseInt('jumpto');
xajax_GetImage(albumid,i);
}
 var counter,albumid;
function count(album,value)
{counter=parseInt(value);
albumid=parseInt(album);

callMeAgain(albumid,counter);
counter--;
if(counter>0)
 t=window.setTimeout("count(albumid,counter)",speed);

}
function setspeed( amount)
{ speed =amount;
return false;

}
function stop()
{clearTimeout(t);
}



//</script>




//<script type="text/javascript"><!--
function init() {
  // - Slider 1 -----------------------------------------
  mySlider = new Bs_Slider();
  mySlider.attachOnChange(bsSliderChange);
  mySlider.width         = 121;
  mySlider.height        = 26;
  mySlider.minVal        = 1;
  mySlider.maxVal        = 5;
  mySlider.valueInterval = 1;
  mySlider.arrowAmount   = 1;
	mySlider.arrowKeepFiringTimeout = 500;
  mySlider.valueDefault  = 4;
  mySlider.imgDir   = 'javascript/components/slider/img/';
  mySlider.setBackgroundImage('bob/background.gif', 'no-repeat');
  mySlider.setSliderIcon('bob/slider.gif', 13, 18);
  mySlider.setArrowIconLeft('img/arrowLeft.gif', 16, 16);
  mySlider.setArrowIconRight('img/arrowRight.gif', 16, 16);
  mySlider.useInputField = 2;
  mySlider.styleValueFieldClass = 'sliderInput';
  mySlider.colorbar = new Object();
  mySlider.colorbar['color']           = '#d0d0d0';
  mySlider.colorbar['height']          = 5;
  mySlider.colorbar['widthDifference'] = -12;
  mySlider.colorbar['offsetLeft']      = 5;
  mySlider.colorbar['offsetTop']       = 9;
  mySlider.drawInto('sliderDiv1');

  }

/**
* @param object sliderObj
* @param int val (the value)
*/
function bsSliderChange(sliderObj, val, newPos){
  //document.test.attachedFieldValue.value = val;
  var Amplify =1000* val
  setspeed(Amplify); return false;
  
}
/**
* @param object sliderObj
* @param int val (the value)
*/
// --></script>
