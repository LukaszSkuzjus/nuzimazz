  <?php

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
	$objResponse->AddAssign("error","innerHTML","sorry no result found!!");
	$objResponse->addAssign("mysearch","className","hidemsg");
  }
 else if($_SESSION['depth1'] ==2 && $_SESSION['number1']==count($maps) )
  {//records are same
  //tell the user
  $objResponse->AddAssign("error","innerHTML","No new images");
  //no need to update screen
  }
  
  else if($_SESSION['depth1'] ==3 && $_SESSION['number2']==count($maps) )
  {//records are same
  //tell the user
  $objResponse->AddAssign("error","innerHTML","No new images!");
  //no need to update screen
  }
  else if($_SESSION['depth1'] ==4 && $_SESSION['number3']==count($maps) )
  {//records are same
  //tell the user
  $objResponse->AddAssign("error","innerHTML","No new images");
  //no need to update screen
  }
  else if($_SESSION['depth1'] ==5 && $_SESSION['number4']==count($maps) )
  {//records are same
  //tell the user
  $objResponse->AddAssign("error","innerHTML","No new images");
  //no need to update screen
  }
  else {
         for($m=0;$m<count($maps);$m++)
              {  $img=$maps[$m] ;
                  $result=$db->query("SELECT * FROM images WHERE ImageId=$img");
                 if(!empty($result))
                 {
                  While($row= $result->fetch_assoc())

                   {
                     $path ="../Images/";
				  $path .=$row["Url"];
                  $imageId =$row["ImageId"];
				$msg.="<a href=\"javascript:void(null);\"onclick=\"\"><IMG SRC=\"".$path."\"width=120 height=120></a>&nbsp;";

                    }

                    }
					$objResponse-> AddAssign("result","innerHTML",$msg);//show the result in the div table
               }
}

return $objResponse->getXML();

}








?>