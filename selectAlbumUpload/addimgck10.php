<?php
session_start();
$memberFolder=$_SESSION['userId'];
$albumid=$_SESSION["Aid"];

?>
<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>Multiple image upload</title>
<meta name="GENERATOR" content="Arachnophilia 4.0">
<meta name="FORMATTER" content="Arachnophilia 4.0">
</head>

<body bgcolor="#ffffff" text="#000000" link="#0000ff" vlink="#800080" alink="#ff0000">
<?php
include("dbconn.php");

for($i=1;$i<=10;$i++)
     {   $value=$_FILES[image.$i][name];
			if(!empty($value))
			{
				$filename = $value;
                //path to upload image
					$add = "../Images/$memberFolder/$filename";
                     // echo $_FILES[images][type][$key];
			  
                 
                 if(checkAlreadyExists($memberFolder,$filename)==1)
                 { 
                     echo"Image Name ".$filename." already exists! ";
                     echo"<br>Renaming the File in Progress...";
                    //or rename it here 
                    
                    //getting extension of image file
                     switch($_FILES[image.$i][type]) 
                     { 
       
       case 'image/gif'; 
       $ext="gif"; 
       break; 
        
        case 'image/jpeg'; 
       $ext="jpg"; 
       break; 
        
        case 'image/pjpeg'; 
       $ext="jpg"; 
       break; 
        
        case 'image/png'; 
       $ext="png"; 
       break; 
        
        case 'application/x-shockwave-flash'; 
       $ext="swf"; 
       break; 
        
       case 'image/psd'; 
       $ext="psd"; 
       break; 
      
       case 'image/bmp'; 
       $ext="bmp"; 
       break; 
     } 
      
                    $name=RandomFile(); 
                    $filename=$name.".".$ext;
                    $add = "Images/$memberFolder/$filename";
                    // exit();
                     
                 }
					copy($_FILES[image.$i][tmp_name], $add);
					                  
                    
                    chmod("$add",0777);
                    //change file mode
                    
		       	if(file_exists("$add")) 
              { $info= getimagesize("$add"); 
              //e.g list($width, $height, $type, $attr) = getimagesize("img/flag.jpg");
              
                  print("upload successful for $filename - $info[3] <br>\n"); 
                  $result=$db->query("SELECT * FROM images");
                  $count = $result->num_rows;
                   $result=$db->query("SELECT * FROM images where ImageId=$count");
                  
                  while ($row = $result->fetch_assoc()) 
                    {
                         $Imgid=$row["ImageId"];
                     }                         
                  $Imgid=$Imgid+1;

                  $date=getCurrentDate();

                  $db->query("INSERT INTO images VALUES ($Imgid, '','$date','$memberFolder/$filename','')");
                   
                  $db->query("INSERT INTO albumcontainsimages VALUES ($albumid,$Imgid )");                    
                 
                 
                 
                 
                 $_SESSION["ImageTag"]=array();

//replace later with sesion userid
$userid=$_SESSION['userId'];
$_SESSION["Userid"]=$userid;

global $Img;
$Img=array();


$result = $db->query('SELECT distinct i.ImageId FROM images as i WHERE i.ImageId In(select a.ImageId From albumcontainsimages as a Where a.AlbumId IN( Select o.AlbumId From ownalbum as o Where o.OwnerId='."$userid".')) and (i.ImageName="" or i.Description="") ');

$count = $result->num_rows;
      
if(!empty($count))
{ echo" You have $count new Images to be tagged!";

while ($row = $result->fetch_assoc()) 
{
        $Img[]=$row["ImageId"];                            


}//end of while loop
                           
    $_SESSION["ImageTag"]=$Img;

echo"<br><a href=../tagImage/ImageTag.php?ImgId=".$Img[0].">Click here to tag Images </a> &nbsp;"; 
  

}

else
{
 echo" You have 0 Images to be tagged!";
}


                 
                 
                 
                 } 
               else 
            { 
                    print("error: upload failed<br>\n"); 
                 } 

			}
		

}
 
        
$result->close();
$db->close();  
        
?>


</body>

</html>
