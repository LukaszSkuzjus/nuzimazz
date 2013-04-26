<?php
session_start();
  global $tag,$depth,$merge;
  

?>

<?php


include("functions.php");

 function ListRelated($Search,$Choice,$depth)
 {
 $objResponse = new xajaxResponse();
 
 //delcaration og msg
 $msg;
 $tag=$Search;
  $selection=$Choice;
  $_SESSION['Choice']=$selection;

  $merge=array();

  if ($tag == "")    {
		$objResponse->addAssign("error","innerHTML","Missing text");
		//need not hide the screen
		
		return $objResponse->getXML();
exit();
    }
  $tag = strtolower ($tag);
  //assign session to tag so tht i can get it again next time i call function processdata
  $_SESSION['tagging']=$tag;
 $keywords = explode(" ", $tag);


  // check for keyword matches, loop through each word
while (list($key, $onekeyword) = each($keywords))
{  $flag=0;
if (($onekeyword == "") || ($onekeyword == "with") || ($onekeyword == " ") ||  ($onekeyword == "and") || ($onekeyword == "to") || ($onekeyword == "for") || ($onekeyword == "the") || ($onekeyword == "a") || ($onekeyword == "or") || ($onekeyword == "it"))
{ $flag=1;
 
  $objResponse->addAssign("title1","innerHTML","Search Result");
     }

if($flag==0)

{ //merge the string
  $merge[]=$onekeyword;

}


} // ends loop

 $_SESSION['mergers']=$merge;
 
 //argument Depth
 $depth=$depth;

if(empty($depth))
 { $depth=1;}

include("dbconn.php");
 $_SESSION['Connect']=$db;

 
 
 
 
 
 
 
 
 
 $selection=$_SESSION['Choice'];
$db=$_SESSION['Connect'];
$_SESSION['records'];


//create a connection

global $record,$maps;

$record= array();
$maps=array();

if($selection=='albums')
{
switch($depth)
{
    case 1:
                     $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= "SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'Order By ImageId ";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        /* Destroy the result set and free the memory used for it */
             $result->close();

}

  $objResponse->loadXML(display());


                 break;

    case 2:
                      $record=$_SESSION['records'];
                     $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql="Select distinct ac2.ImageId From albumcontainsimages as ac2 Where ac2.AlbumId in(
Select distinct ac.AlbumId FROM albumcontainsimages as ac WHERE ac.ImageId IN(
SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%')) ORDER BY ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;
                           /* Destroy the result set and free the memory used for it */
             $result->close();

}

   $objResponse->loadXML(display());



                      break;


                       //images isnot related to images but an album contains  contain many images that's all the relation is about so
                      //no need to query further, results won't iterate in depth for 3 to 5..just need to get all images found in the related albums
    case 3:
    case 4:
    case 5:
           $record=$_SESSION['records'];
           $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];

    $sql="Select distinct ac4.ImageId From albumcontainsimages as ac4 Where ac4.AlbumId in(
Select distinct ac3.AlbumId FROM albumcontainsimages as ac3 WHERE ac3.ImageId IN(
Select distinct ac2.ImageId From albumcontainsimages as ac2 Where ac2.AlbumId in(
Select distinct ac.AlbumId FROM albumcontainsimages as ac WHERE ac.ImageId IN(
SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%')))) ORDER BY ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;
                           /* Destroy the result set and free the memory used for it */
             $result->close();

}

     $objResponse->loadXML(display());

   break;

  default:  $msg= "depth not in range";
 $objResponse->addAssign("title1","innerHTML",$msg);
}


}
else
if($selection=='events')
{ //for events we can have related images of events i.e graduation day and birthday can be on same day
switch($depth)
{
    case 1:
          $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= "Select distinct e2.ImageId FROM imagetakenonevent as e2 WHERE e2.EventId IN(
SELECT distinct e.EventId FROM imagetakenonevent as e WHERE e.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%')) ORDER BY ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        /* Destroy the result set and free the memory used for it */
             $result->close();

}

  $objResponse->loadXML(display());;

                 break;
    case 2:
    $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= "SELECT distinct e3.ImageId FROM imagetakenonevent as e3 WHERE e3.EventId IN(
Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(
SELECT distinct e.EventId FROM imagetakenonevent as e WHERE e.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))) ORDER BY ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        /* Destroy the result set and free the memory used for it */
             $result->close();

}

  $objResponse->loadXML(display());;





                      break;
    case 3:
    $record=$_SESSION['records'];
       $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];

    $sql= "SELECT distinct e4.ImageId FROM imagetakenonevent as e4 WHERE e4.EventId IN(
SELECT distinct e3.ERelatedId  FROM relatedevents as e3 WHERE e3.EventId IN(
Select distinct e2.ERelatedId  FROM relatedevents as e2 WHERE e2.EventId IN(
SELECT distinct e.EventId FROM imagetakenonevent as e WHERE e.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%')))) ORDER BY ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {  //storing the retrieved rows in  array

                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        /* Destroy the result set and free the memory used for it */
             $result->close();

}

  $objResponse->loadXML(display());;





                      break;
   case 4:
                        $record=$_SESSION['records'];
                        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= "SELECT distinct e5.ImageId FROM imagetakenonevent as e5 WHERE e5.EventId IN(
SELECT distinct e4.ERelatedId  FROM relatedevents as e4 WHERE e4.EventId IN(
SELECT distinct e3.ERelatedId  FROM relatedevents as e3 WHERE e3.EventId IN(
Select distinct e2.ERelatedId  FROM relatedevents as e2 WHERE e2.EventId IN(
SELECT distinct e.EventId FROM imagetakenonevent as e WHERE e.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))))) ORDER BY ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        /* Destroy the result set and free the memory used for it */
             $result->close();

}

  $objResponse->loadXML(display());;








                     break;
   case 5:
                       $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= "SELECT distinct e6.ImageId FROM imagetakenonevent as e6 WHERE e6.EventId IN(
SELECT distinct e5.ERelatedId  FROM relatedevents as e5 WHERE e5.EventId IN(
SELECT distinct e4.ERelatedId  FROM relatedevents as e4 WHERE e4.EventId IN(
SELECT distinct e3.ERelatedId  FROM relatedevents as e3 WHERE e3.EventId IN(
Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(
SELECT distinct e.EventId FROM imagetakenonevent as e WHERE e.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%')))))) ORDER BY ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        /* Destroy the result set and free the memory used for it */
             $result->close();

}

  $objResponse->loadXML(display());;





                                break;
  default:   $msg= "depth not in range";
 $objResponse->addAssign("title1","innerHTML",$msg);
}



}
else
if($selection=='members')
{

switch($depth)
{
    case 1:
     $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= "Select distinct m2.Img_id FROM membersinimages  as m2 WHERE m2.Mem_id IN(
SELECT distinct m.Mem_id FROM membersinimages as m WHERE m.Img_id IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%')) Order by Img_id";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array

                    $record[]=$row["Img_id"];

                                        }


                      $_SESSION['records']=$record;

                        /* Destroy the result set and free the memory used for it */
             $result->close();

}

  $objResponse->loadXML(display());;



                 break;
    case 2:
    $record=$_SESSION['records'];
     $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= "SELECT distinct m3.Img_id FROM membersinimages as m3 WHERE m3.Mem_id IN(
Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(
SELECT distinct m.Mem_id FROM membersinimages as m WHERE m.Img_id IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))) ORDER BY Img_id";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                     $record[]=$row["Img_id"];

                                        }


                      $_SESSION['records']=$record;

                        /* Destroy the result set and free the memory used for it */
             $result->close();

}

  $objResponse->loadXML(display());;



                      break;
    case 3:
    $record=$_SESSION['records'];
     $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= "SELECT distinct m4.Img_id FROM membersinimages as m4 WHERE m4.Mem_id IN(
Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(
Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(
SELECT distinct m.Mem_id FROM membersinimages as m WHERE m.Img_id IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%')))) Order By Img_id";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                     $record[]=$row["Img_id"];

                                        }


                      $_SESSION['records']=$record;

                        /* Destroy the result set and free the memory used for it */
             $result->close();

}

  $objResponse->loadXML(display());;






                      break;
   case 4:
   $record=$_SESSION['records'];
                       $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= "SELECT distinct m5.Img_id FROM membersinimages as m5 WHERE m5.Mem_id IN(Select distinct m4.RelatedId FROM relatedmembers as m4 WHERE m4.MemberId IN(
Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(
Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(
SELECT distinct m.Mem_id FROM membersinimages as m WHERE m.Img_id IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))))) Order By Img_id";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["Img_id"];

                                        }


                      $_SESSION['records']=$record;

                        /* Destroy the result set and free the memory used for it */
             $result->close();

}

  $objResponse->loadXML(display());;







                      break;
   case 5:
   $record=$_SESSION['records'];
   $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= "SELECT distinct m6.Img_id FROM membersinimages as m6 WHERE m6.Mem_id IN(
Select distinct m5.RelatedId FROM relatedmembers as m5 WHERE m5.MemberId
IN(Select distinct m4.RelatedId FROM relatedmembers as m4 WHERE m4.MemberId IN(
Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(
Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(
SELECT distinct m.Mem_id FROM membersinimages as m WHERE m.Img_id IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%')))))) Order By Img_id";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                     $record[]=$row["Img_id"];

                                        }


                      $_SESSION['records']=$record;

                        /* Destroy the result set and free the memory used for it */
             $result->close();

}

  $objResponse->loadXML(display());;




                                 break;
  default:   $msg= "depth not in range";
 $objResponse->addAssign("title1","innerHTML",$msg);
}




}
else
if($selection=='sites')
{
switch($depth)
{
    case 1:

          $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= "Select distinct s2.ImageId FROM imagetakeninsites as s2 WHERE s2.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%')) ORDER BY ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        /* Destroy the result set and free the memory used for it */
             $result->close();

}

  $objResponse->loadXML(display());;
                 break;
    case 2:
    $record=$_SESSION['records'];
         $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= "SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%')))) ORDER BY ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        /* Destroy the result set and free the memory used for it */
             $result->close();

}

  $objResponse->loadXML(display());;


                      break;
                      //sites isnot related to sites but a location that is a country can contain many sites that's all the relation is about so
                      //no need to query further, results won't iterate in depth for 3 to 5

    case 3:
    case 4:
    case 5:
    $record=$_SESSION['records'];
     $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= " SELECT distinct s5.ImageId FROM imagetakeninsites as s5 WHERE s5.SiteId IN(
Select distinct s4.SiteId FROM locationcontainsites as s4 WHERE s4.LocationId IN(
SELECT distinct s3.LocationId FROM locationcontainsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%')))))) ORDER BY ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        /* Destroy the result set and free the memory used for it */
             $result->close();

}

  $objResponse->loadXML(display());;


                                 break;

  default:   $msg= "depth not in range";
 $objResponse->addAssign("title1","innerHTML",$msg);
}

}
//$msg= "<h2>Search Results with Depth $depth</h2>";
 $db->close();

return $objResponse->getXML();

}//end function

 


//ListRelated($depth);

function processData($formvalue)
{
$objResponse = new xajaxResponse();
$depth = $formvalue;
$_SESSION['depth1']=$depth;
$mytag=$_SESSION['tagging'];
$myalbumoption1 = $_SESSION['Choice'];

 $objResponse->loadXML(ListRelated($mytag,$myalbumoption1,$depth));
 // $objResponse->AddAlert($depth .$mytag);

return $objResponse->getXML();
}



?>
</body>
</html>