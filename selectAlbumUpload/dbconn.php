<?php
 
    global $db;

//Connect to the database. (host,username,password,database)

$db = new mysqli('localhost', 'root', '', 'album'); 



// Report connection error.
if (mysqli_connect_errno()) {
die('Connect failed: Database server is down. Please be patient while it\'s restored.');
}

 function getCurrentDate() 
{
$date = getDate();
foreach($date as $item=>$value) {
if ($value < 10)
$date[$item] = "0".$value;
}
return $date['year']."-".$date['mon']."-".$date['mday'];
}
      
//check if image of the same name present in the specified member folder
//note it doesnot check if its the same image
function checkAlreadyExists($memberFolder,$filename)
{			
      //path  image uploaded
					$add = "../Images/$memberFolder/$filename";
                   
	//if the image is already in the folder mentioned, return 1 i.e true		                   
		       	if(file_exists("$add"))  return 1;                         
                      else return 0;                         

 
}
 //creates a random name for an image  
 function  RandomFile() 
 { 
                 
                  $allchar = "abcdefghijklmnopqrstuvwxyz" ;  
                    $str = "" ;  
                  mt_srand (( double) microtime() * 1000000 );  
                  for ( $i = 0; $i<12; $i++ )  
                  $str .= substr( $allchar, mt_rand (0,25), 1 ) ;  
                  return $str ;  
                   
        }      
      
      
      
  
?>