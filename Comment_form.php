<html>
<head>
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
</head>
<form id ="formcomments" class="hidemsg" onsubmit="return false;">
	
	<table class="table-wrapper-comment" id= "utable" height="76" bgcolor="#C4E1FF" style="border-collapse: collapse" bordercolor="#111111" cellpadding="0" cellspacing="0" width = 30>
	
	<tr><td  class ="td-thumbnailsHeader" height="19">
      <p align="center"><b>Post Comment</b></td></tr>
		<tr><td class="td-comments" width = "20 "height="19"><textarea rows="4"  cols="20" name="ucomment" id ="com"
		onKeyDown="textCounter(this.form.ucomment,this.form.remLen,50);"
		onKeyUp="textCounter(this.form.ucomment,this.form.remLen,50);"></textarea></td></tr>
		<tr><td><input readonly type=text name=remLen size=3 maxlength=3 value="50"> characters left</tr></td>
		<tr><td height="26">
          <p align="center">
          <input id="submitButton" type="submit" value="Done" onclick="xajax_EnterUserComments(xajax.getFormValues('formcomments'));return false;"><input id="CancelButton" type="button" value="Hide" onclick="xajax_hideform('formcomments');"><input id="ResetButton" type="Reset" value="Clear"></td>
		
		</tr>
		
		</table>
		</form>
		</html>