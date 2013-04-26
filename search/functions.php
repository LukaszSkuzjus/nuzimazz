<?php
session_start();

 function display()
 {	
	$objResponse= new xajaxResponse();

 $db=$_SESSION['Connect'];
 $record=$_SESSION['records'];
 
   $maps=array_unique($record);

   if($_SESSION['depth1'] ==1)
   $_SESSION['number1'] = count($maps);
   
   if($_SESSION['depth1'] ==2)
   $_SESSION['number2'] = count($maps);
    if($_SESSION['depth1'] ==3)
   $_SESSION['number3'] = count($maps);
    if($_SESSION['depth1'] ==4)
    $_SESSION['number4']= count($maps);
    if($_SESSION['depth1'] ==5)
    $_SESSION['number5'] = count($maps);
	
	
  if(empty($maps))
  {
    //if no result found
	$objResponse->AddAssign("error","innerHTML","No result found!!");
  }
  else if($_SESSION['depth1'] ==2 && $_SESSION['number1']==count($maps) )
  {//records are same
  //tell the user
  $objResponse->AddAssign("error","innerHTML","No Depth 2");
  //no need to update screen
  }
  
  else if($_SESSION['depth1'] ==3 && $_SESSION['number2']==count($maps) )
  {//records are same
  //tell the user
  $objResponse->AddAssign("error","innerHTML","No Depth 3!!");
  //no need to update screen
  }
  else if($_SESSION['depth1'] ==4 && $_SESSION['number3']==count($maps) )
  {//records are same
  //tell the user
  $objResponse->AddAssign("error","innerHTML","No Depth 4!!");
  //no need to update screen
  }
  else if($_SESSION['depth1'] ==5 && $_SESSION['number4']==count($maps) )
  {//records are same
  //tell the user
  $objResponse->AddAssign("error","innerHTML","No Depth 5!!");
  //no need to update screen
  }
  
  else{

         for($m=0;$m<count($maps);$m++)
              {  $img=$maps[$m] ;
                  $result=$db->query("SELECT * FROM images WHERE ImageId=$img");
                 if(!empty($result))
                 {
                  While($row= $result->fetch_assoc())

                   {
				   $path ="./Images/";
				  $path .=$row["Url"];
                  $imageId =$row["ImageId"];
				$msg.="<a href=\"javascript:void(null);\"onclick=\"xajax_GetAllPictureDetails($imageId);xajax_GetImageComments($imageId,'','');xajax_RateImage($imageId);\"><IMG SRC=\"".$path."\"width=120 height=120></a>&nbsp;";

                    }

                    }
					
					//to minimise the response time i will show these only when depth1 <depth2
					
				
					
					$myform="<h3>Search Results</h3>";//end of $myform
			//clear the page to make space for the search to display
						$objResponse->addAssign("HomeTable","className","hidemsg");//clear home page
						$objResponse->addAssign("option","className","hidemsg");//hides the slideshow link
						$objResponse->addAssign("orderby","className","hidemsg");//hides the select for order
						$objResponse->addAssign("loginform","className","hidemsg");//hides the loginform
						//hides register from
						$objResponse->addAssign("registerdiv","className","hidemsg");
					$objResponse->addAssign("title1","innerHTML",$myform);//show header
					$objResponse->AddAssign("error","innerHTML","Found!!");//tell the user that we found the answer
					$objResponse->addAssign("mysearch","className","showmsg");//show the select
				
					 
					 
					$objResponse-> AddAssign("table","innerHTML",$msg);//show the result in the div table
               }
}//else


return $objResponse->getXML();
}








?>