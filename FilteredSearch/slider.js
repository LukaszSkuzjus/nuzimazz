//<script type="text/javascript"><!--
function init() {
  // - Slider 1 -----------------------------------------
  mySlider = new Bs_Slider();
  mySlider.attachOnChange(bsSliderChange);
  mySlider.width         = 125;
  mySlider.height        = 26;
  mySlider.minVal        = 1;
  mySlider.maxVal        = 5;
  mySlider.valueInterval = 1;
  mySlider.arrowAmount   = 1;
	mySlider.arrowKeepFiringTimeout = 1000;
  mySlider.valueDefault  = 1;
  mySlider.imgDir   = 'javascript/components/slider/img/';
  mySlider.setBackgroundImage('bob/background.gif', 'no-repeat');
  mySlider.setSliderIcon('bob/slider.gif', 20, 18);
  mySlider.setArrowIconLeft('img/arrowLeft.gif', 20, 20);
  mySlider.setArrowIconRight('img/arrowRight.gif', 20, 20);
  mySlider.useInputField = 2;
  mySlider.styleValueFieldClass = 'sliderInput';
  mySlider.colorbar = new Object();
  mySlider.colorbar['color']           = '#d0d0d0';
  mySlider.colorbar['height']          = 5;
  mySlider.colorbar['widthDifference'] = -5;
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
  
  xajax_processData(val);return false;
  
}
/**
* @param object sliderObj
* @param int val (the value)
*/
// --></script>
