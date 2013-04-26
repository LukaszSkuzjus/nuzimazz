<?php

    function phpFunctionChangeAlbum($v1)
    {

include("dbconn.php");
	$varArray = explode(",", $v1);
    $img=$varArray[0];
    $album=$varArray[1];
	// makes an array from the passed variable 
	// (note: $vars = 1 string while it used to be a javascript Array)
	// with explode you can make an array from 1 string. The seperator is a , 
	   
   $result=$db->query(" UPDATE albumcontainsimages SET AlbumId=$album WHERE ImageId=$img");
	  echo"<script>alert('Image Transfered Successfully!');</script>";
                       //using javascript to redirect to select another image page
                  print "<script>";
                  print " self.location='SelectAlbum.php';";
                  print "</script>";        
   }
   

 function phpFunctionDelete($v1)
  {

include("dbconn.php");
	$varArray = explode(",", $v1);
    $img=$varArray[0];

 $result=$db->query("SELECT * FROM images WHERE ImageId=$img");

while ($row = $result->fetch_assoc()) 
{
      $string=$row["Url"];
       $add = "../Images/".$row["Url"];
      
   }
          
         //delete Image entry in database also
          $result= $db->query("DELETE FROM images WHERE ImageId=$img");
          delDirFiles($add);
  }
   
   function delDirFiles ($file)
   {
      
if(file_exists($file))
       {     
             
           unlink($file);
           
           echo"<script>alert('Image deleted Successfully!');</script>";
                       //using javascript to redirect to select another image page
                  print "<script>";
                  print " self.location='SelectAlbum.php';";
                  print "</script>";        
          }
          else
          {
            echo"<script>alert('Image deletion error!');</script>";
           
          }
          
         
   }//End of function

   
?>
