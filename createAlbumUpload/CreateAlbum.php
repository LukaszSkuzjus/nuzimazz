<html>

<head><title>Create Album</title>
<link href="../css/style.css" type="text/css" rel="stylesheet">
<script type="text/javascript">
function Validate()
{
   if(document.createAlbum.AlbumName.value=="")
   {
     alert('Album Name Field Blank!');
     return false;
   }
   else
   
   if(document.createAlbum.AlbumDescription.value=="")
   {
     alert('Description Field Blank!');
     return false;
   }
}
</script>
</head>
<body>
<h3> Create an Album</h3>
<form name="createAlbum" action="addimg.php" method="GET">

Name: <input type="text" name="AlbumName">
<p>Description: <input type="text" name="AlbumDescription">
<input type="submit" Value="Create" onclick="return Validate();">

</form>

<br><br>

</body>
</html>