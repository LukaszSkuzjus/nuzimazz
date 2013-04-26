<?php
session_start();


function checkEditSupport($filename)
{$memFolder=$_SESSION['userId'];

  $add = "../Images/$memFolder/temp/$filename";
  $info= getimagesize("$add"); 
 
 if($info[2]==2)
 {echo"Editing is Supported!";
     }
     else
     {
     echo"Editing is not supported!";
       }               
}


function recursive_delete( $dir )
{
       if (is_dir($dir)) {
          if ($dh = opendir($dir)) {
              while (($file = readdir($dh)) !== false ) {
                       if( $file != "." && $file != ".." )
                       {
                               if( is_dir( $dir . $file ) )
                               {
                                       echo "Entering Directory: $dir$file<br/>";
                                       recursive_delete( $dir . $file . "/" );
                                       echo "Removing Directory: $dir$file<br/><br/>";
                                       rmdir( $dir . $file );
                               }
                               else
                               {
                                       
                                       unlink( $dir . $file );
                               }
                       }
              }
              closedir($dh);
          }
       }
}




   function cropImage($top,$right,$bottom,$left)
        {
           $new_w = $right - $left;
           $new_h = $bottom - $top;
        
        $ImageArray=$_SESSION["imgArray"];
       $num=count($ImageArray)-1;
        //$num is the last position to be edited in the array 
               
        $Imagefile= $ImageArray[$num];
             
        $memFolder=$_SESSION["userId"];
        
          $path = "../Images/$memFolder/temp/$Imagefile";
  
//get original image         
         $im = imagecreatefromjpeg($path);
         
         $dst_img =imagecreatetruecolor($new_w, $new_h);
                     
             imagecopyresampled($dst_img,$im,0,0,$left, $top, $new_w, $new_h, $new_w, $new_h);
             
           createUnique($dst_img);
        }


function rotateImage($degrees)
         {
             $ImageArray=$_SESSION["imgArray"];
       $num=count($ImageArray)-1;
        //$num is the last position to be edited in the array 
       $Imagefile= $ImageArray[$num];
        


        $memFolder=$_SESSION["userId"];
         
          $path = "../Images/$memFolder/temp/$Imagefile";
       
       chmod("$path",0777);      
       list($width_orig, $height_orig) = getimagesize($path);
//get original image         
         $im = imagecreatefromjpeg($path);
         
             if ($degrees == 180)
             {
              $dst_img = @imagerotate($im, $degrees, 0);
                 }
                 else{
                  $width = $width_orig;
                  $height = $height_orig;
                  if ($width > $height)                  
                  $size = $width;
      
                 else   
                 
                 $size = $height;
                 
                  $dst_img =imagecreatetruecolor($size, $size);
                  
       
                  imagecopyresampled($dst_img,$im,0,0,0,0,$width, $height,$width, $height);
                  
                  $dst_img  = @imagerotate($dst_img, $degrees, 0);
                   $im = $dst_img;
                  $dst_img = imagecreatetruecolor($height, $width);
                 
                  if ((($degrees == 90) && ($width > $height)) || (($degrees == 270) && ($width < $height)))
                                     imagecopyresampled($dst_img,$im,0,0,0,0, $size, $size, $size, $size);
                        
                  if ((($degrees == 270) && ($width > $height)) || (($degrees == 90) && ($width < $height)))
                              imagecopyresampled($dst_img,$im,0,0,$size - $height, $size - $width, $size, $size, $size, $size);
                           }

              createUnique($dst_img);
    imagedestroy($dst_img);

         }


             
         
         
         
         
 function  RandomFile() 
 { 
                 
                  $allchar = "abcdefghijklmnopqrstuvwxyz" ;  
                    $str = "" ;  
                  mt_srand (( double) microtime() * 1000000 );  
                  for ( $i = 0; $i<12; $i++ )  
                  $str .= substr( $allchar, mt_rand (0,25), 1 ) ;  
                  return $str ;  
                   
        }      
        
  function checkAlreadyExists($filename)
{			
      //path  image to be transfered
					$add = "$workingDir/$filename";
                   
	//if the image is already in the folder mentioned, return 1 i.e true		                   
		       	if(file_exists("$add"))  return 1;                         
                      else return 0;                         

 
}      
       

   function phpFunctionResize($v1){
	// makes an array from the passed variable 
	// (note: $vars = 1 string while it used to be a javascript Array)
	// with explode you can make an array from 1 string. The seperator is a , 
	$varArray = explode(",", $v1);

    resizeImage($varArray[0],$varArray[1] );
	
	
   }

     function deleteTempFiles()
     {$memFolder=$_SESSION["userId"];
	   $_SESSION["imgArray"]=array();
       //need to de;ete all image created also during editing
      $dir = "../Images/$memFolder/temp/";
      recursive_delete($dir);
   } 
   
   
   
   
   
   
   
    function phpFunctionUndo($v1){
	// makes an array from the passed variable 
	// (note: $vars = 1 string while it used to be a javascript Array)
	// with explode you can make an array from 1 string. The seperator is a , 
	$varArray = explode(",", $v1);
   $_SESSION["CurrentCount"]=$varArray[0];
 
	
   }
   
   function phpFunctionSave($v1){
	
	$varArray = explode(",", $v1);
    //get orignal image
    $ImageArray=$_SESSION["imgArray"];
        
   $img_origin=$ImageArray[0];
        $memFolder=$_SESSION["userId"];
        //image edited
        $Imagefile= $varArray[0];
       
       $path = "../Images/$memFolder/temp/$Imagefile";         
       chmod("$path",0777);      
 
 list($width_orig, $height_orig) = getimagesize($path);
       //create a new image
      $image_p = imagecreatetruecolor($width_orig, $height_orig);
      //get original image
        
         $im = imagecreatefromjpeg($path);
          //making a copy of same image
       imagecopyresampled($image_p,$im,0,0,0,0,$width_orig,$height_orig,$width_orig,$height_orig);
       
       //copying or renaming the edited image with this original image file name
         $path2 = "../Images/$memFolder/temp/$img_origin";
         imagejpeg($im,$path2,80);
       
        $Url=$_SESSION["OriginalPath"];
           $completeUrl="../Images/$Url";
         
         chmod("$completeUrl",0777);      
   //copy the edited file with the original file i.e in the directory it came from
   
       if (!copy($path,$completeUrl)) {
            echo "failed to save $file...\n";
             }
                
	   deleteTempFiles();
       
                    
   }
   
   function phpFunctionCrop($v1){
	// makes an array from the passed variable 
	// (note: $vars = 1 string while it used to be a javascript Array)
	// with explode you can make an array from 1 string. The seperator is a , 
	$varArray = explode(",", $v1);

    //echo $varArray[0];left
    //echo $varArray[1]; top
    //echo $varArray[2]; right
    //echo $varArray[3]; bottom
    
    cropImage($varArray[1],$varArray[2],$varArray[3],$varArray[0] );
	
	
   }
   

   function phpFunctionRotate($v1){
	// makes an array from the passed variable 
	// (note: $vars = 1 string while it used to be a javascript Array)
	// with explode you can make an array from 1 string. The seperator is a , 
	$varArray = explode(",", $v1);


   if($varArray[0]!=" " && $varArray[1]==" ")
    {
     
     rotateImage($varArray[0]);
    }
   else
         if($varArray[1]==true)
         { 
          mirrorImage();
         }
         else
         { //both rotate & mirror
                   mirrorImage();
                   rotateImage($varArray[0]);
	       }
	
   }

function mirrorImage()
        {  
       $ImageArray=$_SESSION["imgArray"];
       $num=count($ImageArray)-1;
      $memFolder=$_SESSION["userId"];
        //$num is the last position to be edited in the array , -1 as array starts on position 0
        $Imagefile= $ImageArray[$num];
        
          $path = "../Images/$memFolder/temp/$Imagefile";
          chmod("$path",0777);      
       list($width, $height) = getimagesize($path);
        $imagenew = imagecreatetruecolor($width, $height);

        //get original image         
         $im = imagecreatefromjpeg($path);
           // horizontal
           for ($i=0;$i<$height;$i++){
                 // vertical
                 for ($j=0;$j<$width;$j++){
                    $color = imagecolorat($im, $j, $i);
                    imagesetpixel($imagenew,$width-$j-1,$i,$color);
                    }
                 }
            createUnique($imagenew);
            imagedestroy($imagenew);
         }
         
function displayImage()
{
  $ImageArray=$_SESSION["imgArray"];
  $num=count($ImageArray)-1;
   if(empty($_SESSION["imgArray"]))
     {
          echo"<script language=javascript> alert('Image Saved Successfully!');</script>";
             //using javascript to redirect to tag image page
                  print "<script>";
                  print " self.location='SelectAlbum.php';";
                  print "</script>";     
        }
   else     displayImageInfo($ImageArray[$num]);

}

       
        function displayImageInfo($filename)
        {   $memFolder=$_SESSION["userId"];
        $add = "../Images/$memFolder/temp/$filename";
             $info= getimagesize("$add"); 
             $size = ceil(filesize($add)/1024);
               ?>
  <div id="tooldiv2">
<table border="1" width="200px" cellspacing="2" cellpadding="2"class="white">
<th align="right">Modified Image Properties</th>
  
  <tr><td align="right">Name: <?php echo $filename?></td></tr>
   <tr><td align="right">attr: <?php echo $info[3];?></td></tr>
  <tr><td align="right">Size: <?php echo $size;?> Kb</td></tr>
   <tr><td align="Left">Status:<?php checkEditSupport($filename)?></td></tr>

  </table> </div>
  
  <center><img src=<?php echo $add ?> </center>

  <? 
         
        
        }
        
        
    

        //transfer image to be edit to temp directory
        function copyImageFile($file,$completeAdd)
        { $memFolder=$_SESSION['userId'];
          $OriginalPath = "../Images/$completeAdd";
          $path = "../Images/$memFolder/temp/$file";
            
            
       if (!copy($OriginalPath,$path)) {
            echo "failed to copy $file...\n";
             }
             else
             {   chmod("$path",0777);      
                    echo"<center> <img src=".$path." width=480 height=360></center> "; 
             }
             
        }

        function createUnique($imgnew)
        {  $file =RandomFile();
           $memFolder=$_SESSION["userId"];
           $path = "../Images/$memFolder/temp/$file.jpg";
           
            imagejpeg($imgnew,$path,80);
            
       $ImageArray=$_SESSION["imgArray"];
       $ImageArray[]=$file.".jpg";
       
       $_SESSION["imgArray"]=$ImageArray;
       
             }


  function resizeImage($newwidth,$newheight)
         {    
         $ImageArray=$_SESSION["imgArray"];
       $num=count($ImageArray);
        //$num is the last position to be edited in the array 
        $Imagefile= $ImageArray[$num-1];
         
         $memFolder=$_SESSION["userId"];
         
         
          $path = "../Images/$memFolder/temp/$Imagefile";
       
       chmod("$path",0777);      
       list($width_orig, $height_orig) = getimagesize($path);
//create a new image
      $image_p = imagecreatetruecolor($newwidth, $newheight);
      //get original image
        $im = imagecreatefromjpeg($path);
  
     imagecopyresampled($image_p,$im,0,0,0,0,$newwidth,$newheight,$width_orig,$height_orig);
 
    createUnique($image_p);      
    imagedestroy($image_p);

    }






//testing if Gd library is enabled

if (isset($_REQUEST["phpinfo"]) && $_REQUEST["phpinfo"] == 1) {
	phpinfo();
	die();
}

$set_up = array();

if (!extension_loaded("gd")) {
	$set_up[] = "<b>Error:</b> The 'gd2' PHP extension is not loaded. <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To enable the 'gd2' extension, PHP must have been compiled/installed with gd enabled and you must enable it in your PHP.ini file.";
}


if (count($set_up) > 0) {
?>

<html>
<head>
	<title>Library/Files Not Found!</title>
     
</head>
<body>

<?
foreach ($set_up as $temp) {

echo "<img src= 'icons/icon_delete.gif'>&nbsp;".$temp."\n";

}

?>

</body>
</html>
<?
	die();
}

?>