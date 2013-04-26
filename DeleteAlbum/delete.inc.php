<?php

    
 function phpFunctionDeleteAlbum($v1)
  { include("dbconn.php");
     $varArray = explode(",", $v1);
    $album=$varArray[0];
   
if(!empty($album))
{
global $albumArray;
 $albumArray=array();
 $result=$db->query("SELECT distinct ImageId  FROM albumcontainsimages WHERE AlbumId=$album");
 $count = $result->num_rows;

if($count==0)
{ //no images in albums
      //delete album
$result=$db->query("DELETE FROM album WHERE AlbumId=$album");
  echo"<script>alert('Album deleted Successfully!');</script>";
}

else
{ //album contains images

while ($row = $result->fetch_assoc()) 
{
      $albumArray[]=$row["ImageId"];
     
      
   }
   

       
         for($i=0;$i<count($albumArray);$i++)
          {// prepare statement 
             $img=$albumArray[$i];
                          
               //delete the file itself
    $stmt= $db->prepare("SELECT Url FROM images WHERE ImageId=?");

   $stmt->bind_param("i",$img);
    $stmt->execute();

    /* bind variables to prepared statement */
    $stmt->bind_result($item);

    /* fetch values */
    while ($stmt->fetch()) {
              $add = "../Images/".$item;
                    delDirFiles($add);

          }
/* close statement and connection */

$stmt->close();


//delete images in database

 
 $stmt= $db->prepare("DELETE FROM images WHERE ImageId=?");
 $stmt->bind_param("i",$img);
 $stmt->execute();
 $stmt->close();

  //delete album
$result=$db->query("DELETE FROM album WHERE AlbumId=$album");
  echo"<script>alert('Album deleted Successfully!');</script>";
  
  }
}//end else
}

}

 function delDirFiles ($file)
   {
      
if(file_exists($file))
       {     
             unlink($file);
                      
          }
          else
          {
            echo"<script>alert('Image deletion error!');</script>";
           
          }
                     
   }//End of function



   
?>
