<?php
session_start();
$memid=$_SESSION['userId'];
include("delete.inc.php");

   if (isset($_GET[p])){
	// Retrieve the GET parameters and executes the function
	  $funcName	 = $_GET[p];
	  $vars	  = $_GET[vars];
     
       // getting the value as a string via url and building them in a way to call the function in php as shown below
	      $funcName($vars); 
       
       } 

 include("dbconn.php");

echo"<h3>Select an album</h3>";

$result = $db->query("SELECT * From album where AlbumId IN(Select AlbumId From ownalbum WHERE OwnerId=$memid)");


?>
<html><head><title>Select Album</title>
    <script language="javascript">

      
 function javaFunctionDelete()
  { 
     var varArray = new Array();
len = document.select.AlbumName.length;
 i = 0;
 chosen = "";

for (i = 0; i < len; i++) 
{
if (document.select.AlbumName[i].selected) 
{ 

chosen = chosen + document.select.AlbumName[i].value +" ";
 }
 }
 
  
 var  ans= confirm("Delete Album?");

    if(ans==true)
    {
      	// the url which you have to reload is this page, but you add an action to the GET- or POST-variable
	var url="<?php echo $_SERVER[PHP_SELF];?>?p=phpFunctionDeleteAlbum&vars="+chosen;
	
	// Opens the url in the same window
	   window.open(url, "_self");
     }

}
</script>
<link rel = "stylesheet" type = "text/css" href = "../css/style.css">
</head><body>
<form name="select" action="<?php echo $PHP_SELF ?>" method="GET">

Choose Album: <select name="AlbumName">

<?php 
while ($row = $result->fetch_assoc()) 
{

?>

<option value="<?php echo $row["AlbumId"] ?>">

<?                                     
echo $row["AlbumName"];

}//end of while loop
                           
?>
                                
</option>

 </select>
 
 <A href="#"> <img SRC="icon_delete.gif"  BORDER=0 ALT="Delete Album" onclick="javaFunctionDelete();"</a> 

</form>




<?


$db->close()


?>
</body>
</html>