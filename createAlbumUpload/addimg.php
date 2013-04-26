<?php 
session_start();
$memid=$_SESSION["Userid"];
$aName=$_GET["AlbumName"];
$desc=$_GET["AlbumDescription"];
include("dbconn.php");


$result=$db->query("SELECT * FROM album");
$count = $result->num_rows;


$albumid=$count+1;
$_SESSION["Aid"]=$albumid;
$date=getCurrentDate();


$db->query("INSERT INTO album VALUES ($albumid, '$aName','$date','$desc')");

$result=$db->query("SELECT * FROM album");
$count = $result->num_rows;



if($Aid==$count)
{
  echo"<h3>Album Created Successfully...</h3>";
}
//insert into owner table also
$db->query("INSERT INTO ownalbum VALUES ($memid,$albumid)");

$result->close();
$db->close();
?>
<html>

<head>
<title>Choose Number of fields to upload</title>
<link href="../css/style.css" type="text/css" rel="stylesheet">
<script type="text/javascript">
<!--
function go(){
location=document.Unum.UploadNum.options[document.Unum.UploadNum.selectedIndex].value
}
//-->
</script>

</head>

<body bgcolor="#ffffff" text="#000000" link="#0000ff" vlink="#800080" alink="#ff0000">

<form name="Unum" action="<?php echo $PHP_SELF ?>" method="POST">

Select Upload Number &nbsp; &nbsp;
<select name="UploadNum">
<option Selected value="1.php">Only One</option>
<option value="5.php">5 at go</option>
<option value="10.php">10 suits me</option>
</select>
<input type="button" name="test" value="Go!" onClick="go()">

</form>

</body>

</html>
