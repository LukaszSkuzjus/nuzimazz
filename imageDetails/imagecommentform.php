<HEAD>

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
</HEAD>
<form id ="fimagecomments" name =myform onsubmit="return false;">
	
	<table class="table-wrapper-comment" id= "uimagetable" height="50" bgcolor="#C4E1FF" style="border-collapse: collapse" bordercolor="#111111" cellpadding="0" cellspacing="0" width = 30>
	
	<tr><td  class ="td-thumbnailsHeader" height="19">
      <p align="center"><b>Post Comment</b></td></tr>
		<tr><td class="td-comments" width = "20 "height="15"><textarea rows="4" cols="20" size ="20"name ="myimagecomments" id ="com2"
		onKeyDown="textCounter(this.form.myimagecomments,this.form.remLen,50);"
		onKeyUp="textCounter(this.form.myimagecomments,this.form.remLen,50);"></textarea></td></tr>
		<tr><td><input readonly type=text name=remLen size=3 maxlength=3 value="50"> characters left</tr></td>
		<tr><td height="26">
          <p align="center">
          <input id="submitButton5" type="button" value="Done" onclick="xajax_postimagecomment(document.getElementById('com2').value);return false;"><input id="CancelButton2" type="button" value="Hide" onclick="xajax_hideform('Form100');"><input id="ResetButton2" type="Reset" value="Clear"></td>
		
		</tr>
		
		</table>
		</form>
