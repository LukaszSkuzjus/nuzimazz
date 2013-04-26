<?php
session_start();
$memberFolder=$_SESSION['userId'];
?>
<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<link href="../css/style.css" type="text/css" rel="stylesheet">
<title>Profile image upload</title>
<meta name="GENERATOR" content="Arachnophilia 4.0">
<meta name="FORMATTER" content="Arachnophilia 4.0">
</head>

<body bgcolor="#ffffff" text="#000000" link="#0000ff" vlink="#800080" alink="#ff0000">
<?php
include("dbconn.php");


$value=$_FILES[uploadfile][name];
$extension=$_FILES[uploadfile][type];

			if(!empty($value))
			{
				$filename = $value;

                //path to upload image
					$add = "../Images/profile/$filename";
                     // echo $_FILES[images][type][$key];


                 if(checkAlreadyExists(profile,$filename)==1)
                 {
                     echo"Image Name ".$filename." already exists! ";
                     echo"<br>Renaming the File in Progress...";
                    //or rename it here

                    //getting extension of image file
                     switch($extension)
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
     }


                   $name=RandomFile();
                    $filename=$name.".".$ext;
                    $add = "../Images/profile/$filename";
                    // exit();

                 }


        copy($_FILES[uploadfile][tmp_name], $add);

                    chmod("$add",0777);
                    //change file mode

		       	if(file_exists("$add"))
              { $info= getimagesize("$add");
              //e.g list($width, $height, $type, $attr) = getimagesize("img/flag.jpg");

                  print("upload successful for $filename - $info[3] <br>\n");

                $result=$db->query("SELECT * FROM images");
               
                  $db->query("UPDATE memprofile SET Image_Url='$filename' Where Mem_id=$memberFolder");   

       
                
echo"Please Wait...You will be directed to the Tag image Page.";
                  echo"<p>If you are not redirected,<a href='../useraccount/Holder.php'>Click Here</a></p>";
                  //using javascript to redirect to tag image page
                  print "<script>";


                  print " self.location='../useraccount/content.php';";
                  print "</script>";         




 }
               else
            {
                    print("error: upload failed<br>\n");
                 }

			}





//$result->close();
//$db->close();

?>


</body>

</html>
