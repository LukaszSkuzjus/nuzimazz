<?php
session_start();
 
include("functions.php");


function processData($formvalue)
{
$objResponse = new xajaxResponse();
$depth = $formvalue;
$_SESSION['depth1']=$depth;
$mytag=$_SESSION['Formvalues'];
unset($_SESSION['Formvalues']);


 $objResponse->loadXML(ListRelated($mytag,$depth));
 // $objResponse->AddAlert($depth .$mytag);

return $objResponse->getXML();
}
 function ListRelated($aFormValues,$depth)
 { 
 $objResponse = new xajaxResponse();
 
 if(empty($depth))
 { $depth=1;}
 include("dbconn.php");
 
 $_SESSION['Connect']=$db;

 
 
 $db=$_SESSION['Connect'];
 
 $tag=trim($aFormValues['tags']);
$_SESSION['member']=trim($aFormValues['Member']);
$_SESSION['event']=trim($aFormValues['Event']);
$_SESSION['sites']=trim($aFormValues['Site']);
$_SESSION['album']=trim($aFormValues['album']);
//$objResponse->addAssign("error","innerHTML",$tag." ".$_SESSION['member']." ".$_SESSION['event']." ".$_SESSION['sites']." ".$_SESSION['album']);

$merge=array();

  if ($tag == "")    {
  
  $objResponse->addAssign("error","innerHTML","Missing text");
  $objResponse->addAssign("mysearch","className","hidemsg");
		//need not hide the screen
		
		return $objResponse->getXML();
		exit();
    }
$_SESSION['Formvalues']=$aFormValues;
  $tag = strtolower ($tag);
 $keywords = explode(" ", $tag);


  // check for keyword matches, loop through each word
while (list($key, $onekeyword) = each($keywords))
{  $flag=0;
if (($onekeyword == "") || ($onekeyword == "with") || ($onekeyword == " ") ||  ($onekeyword == "and") || ($onekeyword == "to") || ($onekeyword == "for") || ($onekeyword == "the") || ($onekeyword == "a") || ($onekeyword == "or") || ($onekeyword == "it"))
{ $flag=1;
  $objResponse->addAssign("error","innerHTML","<h2>Common Word neglected</h2>");
   }
   //show slider
$objResponse->addAssign("mysearch","className","showmsg");
if($flag==0)
{ //merge the string
  $merge[]=$onekeyword;

}


} // ends loop



 $_SESSION['mergers']=$merge;


global $record,$maps,$data,$recordMember,$recordEvent,$recordSites;
$_SESSION['records'];
$albumid=$_SESSION['album'];
$eventid=$_SESSION['event'];
$siteid=$_SESSION['sites'];
$memberid=$_SESSION['member'];



$record=array();
//check for possibilities to query
 if($albumid!='none' && $eventid=='none' && $siteid=='none' && $memberid=='none')
    {//search in albums only
    
            //depth starts here
switch($depth)
{
    case 1:
                     $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];

$sql ="Select distinct i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct a.ImageId FROM albumcontainsimages as a WHERE a.AlbumId=$albumid) ORDER BY ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it 
             $result->close();

}






 $objResponse->loadXML(display());


                 break;

    case 2:
                      //$record=$_SESSION['records'];
                      //no need to store here as querying whole allbums i.e all images tags
                     $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];

//query in all images in database
 $sql= "SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'Order By ImageId ";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        //Destroy the result set and free the memory used for it 
             $result->close();

   
}
   $objResponse->loadXML(display());



                      break;


                       //images isnot related to images but an album contains  many images that's all the relation is about so
                      //no need to query further, results won't iterate in depth for 3 to 5..just need to get all images found in the related albums
    case 3:
    case 4:
    case 5:
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
                           // Destroy the result set and free the memory used for it 
            // $result->close();

}

    $objResponse->loadXML(display());

   break;

  default:   $objResponse->addAssign("error","innerHTML" ,"depth not in range");

}
        
                 }//end if
    

else
       if($albumid=='none' && $eventid!='none' && $siteid=='none' && $memberid=='none')
       {//search in events only

switch($depth)
{
    case 1:
          $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
   
$sql ="Select distinct i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid) ORDER BY ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it 
            // $result->close();

}

 $objResponse->loadXML(display());

                 break;
    case 2:
    $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    
       $sql= "Select distinct e2.ImageId FROM imagetakenonevent as e2 WHERE e2.EventId IN
       (Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(
SELECT distinct e.EventId FROM imagetakenonevent as e WHERE e.ImageId IN (Select distinct i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid)))) ORDER BY ImageId";


  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        //Destroy the result set and free the memory used for it 
            // $result->close();

}

 $objResponse->loadXML(display());





                      break;
    case 3:
    $record=$_SESSION['records'];
       $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
  
         $sql= "SELECT distinct e4.ImageId FROM imagetakenonevent as e4 WHERE e4.EventId IN(
Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(SELECT distinct e.EventId FROM imagetakenonevent as e WHERE e.ImageId IN (Select distinct i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid))))) ORDER BY ImageId";
 
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {  //storing the retrieved rows in  array

                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it 
            // $result->close();

}

$objResponse->loadXML(display());




                      break;
   case 4:
                        $record=$_SESSION['records'];
                        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= "SELECT distinct e5.ImageId FROM imagetakenonevent as e5 WHERE e5.EventId IN(
SELECT distinct e4.ERelatedId  FROM relatedevents as e4 WHERE e4.EventId IN(
Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(SELECT distinct e.EventId FROM imagetakenonevent as e WHERE e.ImageId IN (Select distinct i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid)))))) ORDER BY ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it 
            // $result->close();

}

 $objResponse->loadXML(display());








                     break;
   case 5:
                       $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= "SELECT distinct e6.ImageId FROM imagetakenonevent as e6 WHERE e6.EventId IN(
SELECT distinct e5.ERelatedId  FROM relatedevents as e5 WHERE e5.EventId IN(
SELECT distinct e4.ERelatedId  FROM relatedevents as e4 WHERE e4.EventId IN(
Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(SELECT distinct e.EventId FROM imagetakenonevent as e WHERE e.ImageId IN (Select distinct i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid))))))) ORDER BY ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
            // $result->close();

}

 $objResponse->loadXML(display());





                                break;
  default:$objResponse->addAssign("error","innerHTML","depth not in range");

}// end event depth


       }//end if


else
       if($albumid=='none' && $eventid=='none' && $siteid!='none' && $memberid=='none')
       {//search in sites only

        

switch($depth)
{
    case 1:

          $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
     
     $sql ="Select distinct i.ImageId From  images as i where  i.ImageName Like '%$i%' or i.description LIKE '%$i%' and i.ImageId IN(SELECT a.ImageId FROM imagetakeninsites as a WHERE a.SiteId=$siteid) ORDER BY ImageId";
   //results of depth 1 are filtered but as depth increases more indirectly related images are retrieved,so queries of depth >1 need not be too restrictive 
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
            // $result->close();

}

 $objResponse->loadXML(display());
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

                        // Destroy the result set and free the memory used for it //
            // $result->close();

}

 $objResponse->loadXML(display());


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

                        // Destroy the result set and free the memory used for it //
            // $result->close();

}

 $objResponse->loadXML(display());


                                 break;

  default:   $objResponse->addAssign("error","innerHTML", "depth not in range");

}//end depth

       }//end if

else
       if( $albumid=='none' && $eventid=='none' && $siteid=='none' && $memberid!='none')
       {//search in members only

switch($depth)
{
    case 1:
     $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];

         $sql ="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct a.Img_id FROM membersinimages as a WHERE a.Mem_id=$memberid) order by ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array

                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
            // $result->close();

}

 $objResponse->loadXML(display());



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

                        // Destroy the result set and free the memory used for it //
            // $result->close();

}

 $objResponse->loadXML(display());



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

                        // Destroy the result set and free the memory used for it //
            // $result->close();

}

$objResponse->loadXML(display());






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

                        // Destroy the result set and free the memory used for it //
            // $result->close();

}

 $objResponse->loadXML(display());


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

                        // Destroy the result set and free the memory used for it //
            // $result->close();

}

 $objResponse->loadXML(display());




                                 break;
  default:   $objResponse->addAssign("error","innerHTML", "depth not in range");



}//end depth


       }//end if


       else
       if( $albumid!='none' && $eventid!='none' && $siteid=='none' && $memberid=='none')
       {//search with albums and events





switch($depth)
{
    case 1:
          $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
                  
                  $sql ="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN(SELECT distinct a.ImageId FROM albumcontainsimages as a WHERE a.AlbumId=$albumid)) ORDER BY ImageId";
                  


  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
            // $result->close();

}

 $objResponse->loadXML(display());

                 break;
    case 2:
    $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
  // $sql ="Select distinct i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid) ORDER BY ImageId";
//query all albums but in same album is less precise and preferred to query related events with all images 
  //
       $sql= "Select distinct e2.ImageId FROM imagetakenonevent as e2 WHERE e2.EventId IN
       (Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(
SELECT distinct e.EventId FROM imagetakenonevent as e WHERE e.ImageId IN (Select distinct i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid)))) ORDER BY ImageId";


  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
            // $result->close();

}

 $objResponse->loadXML(display());





                      break;
    case 3:
    $record=$_SESSION['records'];
       $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
  
         $sql= "SELECT distinct e4.ImageId FROM imagetakenonevent as e4 WHERE e4.EventId IN(
Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(SELECT distinct e.EventId FROM imagetakenonevent as e WHERE e.ImageId IN (Select distinct i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid))))) ORDER BY ImageId";
 
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {  //storing the retrieved rows in  array

                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
            // $result->close();

}

 $objResponse->loadXML(display());





                      break;
   case 4:
                        $record=$_SESSION['records'];
                        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= "SELECT distinct e5.ImageId FROM imagetakenonevent as e5 WHERE e5.EventId IN(
SELECT distinct e4.ERelatedId  FROM relatedevents as e4 WHERE e4.EventId IN(
Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(SELECT distinct e.EventId FROM imagetakenonevent as e WHERE e.ImageId IN (Select distinct i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid)))))) ORDER BY ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
            // $result->close();

}

 $objResponse->loadXML(display());



                     break;
   case 5:
                       $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    $sql= "SELECT distinct e6.ImageId FROM imagetakenonevent as e6 WHERE e6.EventId IN(
SELECT distinct e5.ERelatedId  FROM relatedevents as e5 WHERE e5.EventId IN(
SELECT distinct e4.ERelatedId  FROM relatedevents as e4 WHERE e4.EventId IN(
Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(SELECT distinct e.EventId FROM imagetakenonevent as e WHERE e.ImageId IN (Select distinct i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid))))))) ORDER BY ImageId";

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());





                                break;
  default:   $objResponse->addAssign("error","innerHTML", "depth not in range");

}// end  depth

 
              }//end if


       else
       if( $albumid!='none' && $eventid=='none' && $siteid!='none' && $memberid=='none')
       {//search with albums and sites

    

switch($depth)
{
    case 1:

          $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
     
         $sql ="SELECT distinct e.ImageId FROM imagetakeninsites as e WHERE e.SiteId=$siteid and e.ImageId IN(SELECT distinct a.ImageId FROM albumcontainsimages as a WHERE a.AlbumId=$albumid and a.ImageId IN(Select distinct i.ImageId From  images as i where i.description LIKE '%$i%' or i.ImageName Like '%$i%')) ORDER BY ImageId";


   //results of depth 1 are filtered but as depth increases more indirectly related images are retrieved,so queries of depth >1 need not be too restrictive 
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());
                 break;
    case 2:
    $record=$_SESSION['records'];
         $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
//query in all images for tags in other words query is based on all albums now
     $sql ="Select distinct i.ImageId From  images as i where  i.ImageName Like '%$i%' or i.description LIKE '%$i%' and i.ImageId IN(SELECT a.ImageId FROM imagetakeninsites as a WHERE a.SiteId=$siteid) ORDER BY ImageId";
     
   $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());


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

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());


                                 break;

  default:  $objResponse->addAssign("error","innerHTML", "depth not in range");

}//end depth


       }//end if

       else
       if( $albumid!='none' && $eventid=='none' && $siteid=='none' && $memberid!='none')
       { //search with albums and members


switch($depth)
{
    case 1:
     $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];

//only in specific album
                 $sql ="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE m.Mem_id=$memberid and m.Img_id IN(SELECT distinct a.ImageId FROM albumcontainsimages as a WHERE a.AlbumId=$albumid)) ORDER BY ImageId";


  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array

                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());



                 break;
    case 2:
    $record=$_SESSION['records'];
     $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
   //query in all albums 
    $sql ="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct a.Img_id FROM membersinimages as a WHERE a.Mem_id=$memberid) order by ImageId";


  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                     $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());



                      break;
    case 3:
    $record=$_SESSION['records'];
     $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    //query for related members now
       $sql= "SELECT distinct m3.Img_id FROM membersinimages as m3 WHERE m3.Mem_id IN(
Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(
SELECT distinct m.Mem_id FROM membersinimages as m WHERE m.Img_id IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))) ORDER BY Img_id";
    
   
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                     $record[]=$row["Img_id"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());






                      break;
   case 4:
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

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

$objResponse->loadXML(display());


                      break;
                      
   case 5:
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

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());




                                 break;
  default:  $objResponse->addAssign("error","innerHTML", "depth not in range");



}//end depth

                 
                 
              }//end if



       else
       if( $albumid=='none' && $eventid!='none' && $siteid!='none' && $memberid=='none')
       {//search with  events and sites


        

 switch($depth)
{
    case 1:
          $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
                  
                 
    $sql ="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN(SELECT distinct s.ImageId FROM imagetakeninsites as s WHERE s.SiteId=$siteid)) ORDER BY ImageId";
    
 

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());

                 break;
    case 2:
    $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
//get images from all sites having the image description keywords but occured in the same event
$sql="SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN( 
SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))))) ORDER BY ImageId";


  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());





                      break;
    case 3:
    $record=$_SESSION['records'];
       $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
  
  //get images from all sites having the image description keywords but occured in the related event of the eventid enetered
  
$sql="Select distinct e2.ImageId FROM imagetakenonevent as e2 WHERE e2.EventId IN
       (Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.EventId IN( 
SELECT distinct s3.EventId FROM eventoccursinsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))))))) ORDER BY ImageId";
  

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {  //storing the retrieved rows in  array

                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());





                      break;
   case 4:
                        $record=$_SESSION['records'];
                        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    
    $sql="SELECT distinct e4.ImageId FROM imagetakenonevent as e4 WHERE e4.EventId IN(
Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.EventId IN( 
SELECT distinct s3.EventId FROM eventoccursinsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%')))))))) ORDER BY ImageId";
  

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());








                     break;
   case 5:
                       $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    
    
    
    $sql="SELECT distinct e5.ImageId FROM imagetakenonevent as e5 WHERE e5.EventId IN(
SELECT distinct e4.ERelatedId  FROM relatedevents as e4 WHERE e4.EventId IN(
Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.EventId IN( 
SELECT distinct s3.EventId FROM eventoccursinsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))))))))) ORDER BY ImageId";
  
    
 
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());





                                break;
  default:   $objResponse->addAssign("error","innerHTML", "depth not in range");

}// end  depth





       }//end if

        else
       if( $albumid=='none' && $eventid!='none' && $siteid=='none' && $memberid!='none')
       {//search with  events and members

         

 switch($depth)
{
    case 1:
          $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
                  
             $sql ="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE m.Mem_id=$memberid)) ORDER BY ImageId";      
 
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());

                 break;
    case 2:
    $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];


$sql= "Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(Select distinct e3.ImageId FROM imagetakenonevent as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(Select distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN( SELECT distinct m3.Img_id FROM membersinimages as m3 WHERE m3.Mem_id IN(Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId=$memberid))))) ORDER BY ImageId";


  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());





                      break;
    case 3:
    $record=$_SESSION['records'];
       $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
  
 $sql="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e4.ImageId FROM imagetakenonevent as e4 WHERE e4.EventId IN(Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(Select distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN( SELECT distinct m4.Img_id FROM membersinimages as m4 WHERE m4.Mem_id IN(
Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId=$memberid))))))) ORDER BY ImageId";
  
  

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {  //storing the retrieved rows in  array

                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());





                      break;
   case 4:
                        $record=$_SESSION['records'];
                        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    
     $sql="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e5.ImageId FROM imagetakenonevent as e5 WHERE e5.EventId IN(SELECT distinct e4.ERelatedId  FROM relatedevents as e4 WHERE e4.EventId IN(
Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(Select distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN(SELECT distinct m5.Img_id FROM membersinimages as m5 WHERE m5.Mem_id IN(Select distinct m4.RelatedId FROM relatedmembers as m4 WHERE m4.MemberId IN(Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId=$memberid))))))))) ORDER BY ImageId";
  
  
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());








                     break;
   case 5:
                       $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
     
     $sql="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e6.ImageId FROM imagetakenonevent as e6 WHERE e6.EventId IN(SELECT distinct e5.ERelatedId  FROM relatedevents as e5 WHERE e5.EventId IN(SELECT distinct e4.ERelatedId  FROM relatedevents as e4 WHERE e4.EventId IN(Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(Select distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN(SELECT distinct m6.Img_id FROM membersinimages as m6 WHERE m6.Mem_id IN(Select distinct m5.RelatedId FROM relatedmembers as m5 WHERE m5.MemberId IN(Select distinct m4.RelatedId FROM relatedmembers as m4 WHERE m4.MemberId IN(Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId=$memberid))))))))))) ORDER BY ImageId";
    
  
 
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());




                                break;
  default:   $objResponse->addAssign("error","innerHTML", "depth not in range");
}// end  depth


       }//end if

        else
       if( $albumid=='none' && $eventid=='none' && $siteid!='none' && $memberid!='none')
       {//search with sites and members


  switch($depth)
{
    case 1:
          $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
                  
                           $sql ="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct s.ImageId FROM imagetakeninsites as s WHERE s.SiteId=$siteid and s.ImageId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE m.Mem_id=$memberid)) ORDER BY ImageId";
                           
    
 

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());

                 break;
    case 2:
    $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
//get images from all sites having the image description keywords but occured in the same member
$sql="SELECT distinct m.Img_id FROM membersinimages as m WHERE m.Mem_id=$memberid and m.Img_id IN( 
SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))))) ORDER BY Img_id";


  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["Img_id"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

$objResponse->loadXML(display());





                      break;
    case 3:
    $record=$_SESSION['records'];
       $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
  

  
$sql="SELECT distinct m3.Img_id FROM membersinimages as m3 WHERE m3.Mem_id IN(
Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE m.Mem_id=$memberid and m.Img_id IN( 
SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))))))) ORDER BY Img_id";
  

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {  //storing the retrieved rows in  array

                    $record[]=$row["Img_id"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());





                      break;
   case 4:
                        $record=$_SESSION['records'];
                        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    
  
$sql="SELECT distinct m4.Img_id FROM membersinimages as m4 WHERE m4.Mem_id IN(Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(
Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE m.Mem_id=$memberid and m.Img_id IN( 
SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%')))))))) ORDER BY Img_id";


  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["Img_id"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());








                     break;
   case 5:
                       $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    
    
    
$sql="SELECT distinct m5.Img_id FROM membersinimages as m5 WHERE m5.Mem_id IN(Select distinct m4.RelatedId FROM relatedmembers as m4 WHERE m4.MemberId IN(Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(
Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE m.Mem_id=$memberid and m.Img_id IN( 
SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))))))))) ORDER BY Img_id";

  
    
 
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["Img_id"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());





                                break;
  default:   $objResponse->addAssign("error","innerHTML", "depth not in range");

}// end  depth

       }//end if
        else
       if( $albumid!='none' && $eventid!='none' && $siteid!='none' && $memberid=='none')
       {//search with albums,events and sites

  

 switch($depth)
{
    case 1:
          $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
                  
                         $sql ="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct
      e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN(SELECT distinct s.ImageId FROM imagetakeninsites as s WHERE s.SiteId=$siteid and s.ImageId IN(SELECT distinct a.ImageId FROM albumcontainsimages as a WHERE a.AlbumId=$albumid))) Order By ImageId";
 
  
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

  $objResponse->loadXML(display());

                 break;
    case 2:
    $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
//get images from all sites having the image description keywords but occured in the same event
//we are queryin all images now not only a specific album
$sql="SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN( 
SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))))) ORDER BY ImageId";


  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

  $objResponse->loadXML(display());





                      break;
    case 3:
    $record=$_SESSION['records'];
       $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
  
  //get images from all sites having the image description keywords but occured in the related event of the eventid enetered
  
$sql="Select distinct e2.ImageId FROM imagetakenonevent as e2 WHERE e2.EventId IN
       (Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.EventId IN( 
SELECT distinct s3.EventId FROM eventoccursinsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))))))) ORDER BY ImageId";
  

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {  //storing the retrieved rows in  array

                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

  $objResponse->loadXML(display());





                      break;
   case 4:
                        $record=$_SESSION['records'];
                        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    
    $sql="SELECT distinct e4.ImageId FROM imagetakenonevent as e4 WHERE e4.EventId IN(
Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.EventId IN( 
SELECT distinct s3.EventId FROM eventoccursinsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%')))))))) ORDER BY ImageId";
  

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

  $objResponse->loadXML(display());








                     break;
   case 5:
                       $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    
    
    
    $sql="SELECT distinct e5.ImageId FROM imagetakenonevent as e5 WHERE e5.EventId IN(
SELECT distinct e4.ERelatedId  FROM relatedevents as e4 WHERE e4.EventId IN(
Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.EventId IN( 
SELECT distinct s3.EventId FROM eventoccursinsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))))))))) ORDER BY ImageId";
  
    
 
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

  $objResponse->loadXML(display());





                                break;
  default:   $objResponse->addAssign("error","innerHTML", "depth not in range");

}// end  depth
  
  
              }//end if


        else
       if( $albumid!='none' && $eventid!='none' && $siteid=='none' && $memberid!='none')
       {
//search with albums,events and members

    

 switch($depth)
{
    case 1:
          $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
                  
                  $sql ="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct
      e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE m.Mem_id=$memberid and m.Img_id IN(SELECT distinct a.ImageId FROM albumcontainsimages as a WHERE a.AlbumId=$albumid))) ORDER BY ImageId";
 
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

  $objResponse->loadXML(display());

                 break;
    case 2:
    $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];

//query is based on all images now
$sql="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(Select distinct e3.ImageId FROM imagetakenonevent as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(Select distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN( SELECT distinct m3.Img_id FROM membersinimages as m3 WHERE m3.Mem_id IN(
Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId=$memberid))))) ORDER BY ImageId";


  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

  $objResponse->loadXML(display());





                      break;
    case 3:
    $record=$_SESSION['records'];
       $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
  
 $sql="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e4.ImageId FROM imagetakenonevent as e4 WHERE e4.EventId IN(Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(Select distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN( SELECT distinct m4.Img_id FROM membersinimages as m4 WHERE m4.Mem_id IN(
Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId=$memberid))))))) ORDER BY ImageId";
  
  

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {  //storing the retrieved rows in  array

                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

  $objResponse->loadXML(display());





                      break;
   case 4:
                        $record=$_SESSION['records'];
                        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    
     $sql="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e5.ImageId FROM imagetakenonevent as e5 WHERE e5.EventId IN(SELECT distinct e4.ERelatedId  FROM relatedevents as e4 WHERE e4.EventId IN(
Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(Select distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN(SELECT distinct m5.Img_id FROM membersinimages as m5 WHERE m5.Mem_id IN(Select distinct m4.RelatedId FROM relatedmembers as m4 WHERE m4.MemberId IN(Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId=$memberid))))))))) ORDER BY ImageId";
  
  
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

  $objResponse->loadXML(display());








                     break;
   case 5:
                       $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
     
     $sql="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct e6.ImageId FROM imagetakenonevent as e6 WHERE e6.EventId IN(SELECT distinct e5.ERelatedId  FROM relatedevents as e5 WHERE e5.EventId IN(SELECT distinct e4.ERelatedId  FROM relatedevents as e4 WHERE e4.EventId IN(Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(Select distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN(SELECT distinct m6.Img_id FROM membersinimages as m6 WHERE m6.Mem_id IN(Select distinct m5.RelatedId FROM relatedmembers as m5 WHERE m5.MemberId IN(Select distinct m4.RelatedId FROM relatedmembers as m4 WHERE m4.MemberId IN(Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId=$memberid))))))))))) ORDER BY ImageId";
    
  
 
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

  $objResponse->loadXML(display());




                                break;
  default:  $objResponse->addAssign("error","innerHTML", "depth not in range");

}// end  depth
      

       }//end if

        else
       if( $albumid=='none' && $eventid!='none' && $siteid!='none' && $memberid!='none')
       {//search with ,events,sites and members

       
  switch($depth)
{
    case 1:
          $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
                  
      $sql ="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN ( SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE  EventId=$eventid and e.ImageId IN( SELECT distinct s.ImageId FROM imagetakeninsites as s WHERE  SiteId=$siteid and s.ImageId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE  Mem_id=$memberid))) ORDER BY ImageId";
 

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());

                 break;
    case 2:
    $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];


$sql="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN (SELECT distinct e3.ImageId FROM imagetakenonevent as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(Select distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN( SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(SELECT distinct s.ImageId FROM imagetakeninsites as s WHERE  s.SiteId=$siteid and s.ImageId IN( SELECT distinct m3.Img_id FROM membersinimages as m3 WHERE m3.Mem_id IN(
Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE  Mem_id=$memberid)))))))))) ORDER BY ImageId";


  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());





                      break;
    case 3:
    $record=$_SESSION['records'];
       $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
  

  
$sql="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN (SELECT distinct e4.ImageId FROM imagetakenonevent as e4 WHERE e4.EventId IN(Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(Select distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN( SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(SELECT distinct s.ImageId FROM imagetakeninsites as s WHERE  s.SiteId=$siteid and s.ImageId IN(SELECT distinct m4.Img_id FROM membersinimages as m4 WHERE m4.Mem_id IN(Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE  Mem_id=$memberid)))))))))))) ORDER BY ImageId";



  

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {  //storing the retrieved rows in  array

                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());





                      break;
   case 4:
                        $record=$_SESSION['records'];
                        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    
  

$sql="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN (SELECT distinct e5.ImageId FROM imagetakenonevent as e5 WHERE e5.EventId IN(Select distinct e4.ERelatedId FROM relatedevents as e4 WHERE e4.EventId IN(Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(Select distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN( SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(SELECT distinct s.ImageId FROM imagetakeninsites as s WHERE  s.SiteId=$siteid and s.ImageId IN(SELECT distinct m5.Img_id FROM membersinimages as m5 WHERE m5.Mem_id IN(Select distinct m4.RelatedId FROM relatedmembers as m4 WHERE m4.MemberId IN(Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE  Mem_id=$memberid)))))))))))))) ORDER BY ImageId";



  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());








                     break;
   case 5:
                       $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
       
    

$sql="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN (SELECT distinct e6.ImageId FROM imagetakenonevent as e6 WHERE e6.EventId IN(Select distinct e5.ERelatedId FROM relatedevents as e5 WHERE e5.EventId IN(Select distinct e4.ERelatedId FROM relatedevents as e4 WHERE e4.EventId IN(Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(Select distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN( SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(SELECT distinct s.ImageId FROM imagetakeninsites as s WHERE  s.SiteId=$siteid and s.ImageId IN(SELECT distinct m6.Img_id FROM membersinimages as m6 WHERE m6.Mem_id IN(Select distinct m5.RelatedId FROM relatedmembers as m5 WHERE m5.MemberId IN(Select distinct m4.RelatedId FROM relatedmembers as m4 WHERE m4.MemberId IN(Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE  Mem_id=$memberid)))))))))))))))) ORDER BY ImageId";

  
   
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

$objResponse->loadXML(display());





                                break;
								
  default:   $objResponse->addAssign("error","innerHTML", "depth not in range");

}// end  depth

       }//end if

       else
       if( $albumid!='none' && $eventid=='none' && $siteid!='none' && $memberid!='none')
       {//search with albums,sites and members

//code repeats itseld for depth 2-5 with the code for sites and members as we need to query all images hence no specific album


 
  switch($depth)
{
    case 1:
          $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
                  
                  $sql ="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN(SELECT distinct
      m.Img_id FROM membersinimages as m WHERE m.Mem_id=$memberid and m.Img_id IN(SELECT distinct s.ImageId FROM imagetakeninsites as s WHERE s.SiteId=$siteid and s.ImageId IN(SELECT distinct a.ImageId FROM albumcontainsimages as a WHERE a.AlbumId=$albumid))) ORDER BY ImageId";
    
 

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

$objResponse->loadXML(display());

                 break;
    case 2:
    $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
//get all images from all sites having the image description keywords but occured with the same member

$sql="SELECT distinct m.Img_id FROM membersinimages as m WHERE m.Mem_id=$memberid and m.Img_id IN( 
SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))))) ORDER BY Img_id";


  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["Img_id"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());





                      break;
    case 3:
    $record=$_SESSION['records'];
       $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
  

  
$sql="SELECT distinct m3.Img_id FROM membersinimages as m3 WHERE m3.Mem_id IN(
Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE m.Mem_id=$memberid and m.Img_id IN( 
SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))))))) ORDER BY Img_id";
  

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {  //storing the retrieved rows in  array

                    $record[]=$row["Img_id"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());





                      break;
   case 4:
                        $record=$_SESSION['records'];
                        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    
  
$sql="SELECT distinct m4.Img_id FROM membersinimages as m4 WHERE m4.Mem_id IN(Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(
Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE m.Mem_id=$memberid and m.Img_id IN( 
SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%')))))))) ORDER BY Img_id";


  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["Img_id"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());








                     break;
   case 5:
                       $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    
    
    
$sql="SELECT distinct m5.Img_id FROM membersinimages as m5 WHERE m5.Mem_id IN(Select distinct m4.RelatedId FROM relatedmembers as m4 WHERE m4.MemberId IN(Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(
Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE m.Mem_id=$memberid and m.Img_id IN( 
SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(
Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(
SELECT distinct s.SiteId FROM imagetakeninsites as s WHERE s.ImageId IN (SELECT distinct i.ImageId FROM images as i WHERE i.description LIKE '%$i%'))))))))) ORDER BY Img_id";

  
    
 
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["Img_id"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

 $objResponse->loadXML(display());





                                break;
  default:   $objResponse->addAssign("error","innerHTML", "depth not in range");

}// end  depth


              }//end if



else
       if( $albumid!='none' && $eventid!='none' && $siteid!='none' && $memberid!='none')
       { //search with albums,events,sites and members

//here also code repeats itself for query on events,sites,members except depth one wwill be restricted to 1 album
       
  switch($depth)
{
    case 1:
          $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
                  
      $sql ="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN (SELECT distinct m.Img_id FROM membersinimages as m WHERE  Mem_id=$memberid and m.Img_id IN ( SELECT distinct e.ImageId FROM imagetakenonevent as e WHERE  EventId=$eventid and e.ImageId IN( SELECT distinct s.ImageId FROM imagetakeninsites as s WHERE  SiteId=$siteid and s.ImageId IN(SELECT distinct a.ImageId FROM albumcontainsimages as a WHERE AlbumId=$albumid))))";

 

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

  $objResponse->loadXML(display());

                 break;
    case 2:
    $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];


$sql="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN (SELECT distinct e3.ImageId FROM imagetakenonevent as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(Select distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN( SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(
Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(SELECT distinct s.ImageId FROM imagetakeninsites as s WHERE  s.SiteId=$siteid and s.ImageId IN( SELECT distinct m3.Img_id FROM membersinimages as m3 WHERE m3.Mem_id IN(
Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE  Mem_id=$memberid)))))))))) ORDER BY ImageId";


  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

  $objResponse->loadXML(display());





                      break;
    case 3:
    $record=$_SESSION['records'];
       $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
  

  
$sql="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN (SELECT distinct e4.ImageId FROM imagetakenonevent as e4 WHERE e4.EventId IN(Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(Select distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN( SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(SELECT distinct s.ImageId FROM imagetakeninsites as s WHERE  s.SiteId=$siteid and s.ImageId IN(SELECT distinct m4.Img_id FROM membersinimages as m4 WHERE m4.Mem_id IN(Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE  Mem_id=$memberid)))))))))))) ORDER BY ImageId";



  

  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {  //storing the retrieved rows in  array

                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

  $objResponse->loadXML(display());





                      break;
   case 4:
                        $record=$_SESSION['records'];
                        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
    
  

$sql="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN (SELECT distinct e5.ImageId FROM imagetakenonevent as e5 WHERE e5.EventId IN(Select distinct e4.ERelatedId FROM relatedevents as e4 WHERE e4.EventId IN(Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(Select distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN( SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(SELECT distinct s.ImageId FROM imagetakeninsites as s WHERE  s.SiteId=$siteid and s.ImageId IN(SELECT distinct m5.Img_id FROM membersinimages as m5 WHERE m5.Mem_id IN(Select distinct m4.RelatedId FROM relatedmembers as m4 WHERE m4.MemberId IN(Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE  Mem_id=$memberid)))))))))))))) ORDER BY ImageId";



  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
             $result->close();

}

  $objResponse->loadXML(display());








                     break;
   case 5:
                       $record=$_SESSION['records'];
        $merge=$_SESSION['mergers'];

for($mer=0;$mer<count($merge);$mer++)
{  $i=$merge[$mer];
       
    

$sql="Select i.ImageId From  images as i where i.description LIKE '%$i%' and i.ImageId IN (SELECT distinct e6.ImageId FROM imagetakenonevent as e6 WHERE e6.EventId IN(Select distinct e5.ERelatedId FROM relatedevents as e5 WHERE e5.EventId IN(Select distinct e4.ERelatedId FROM relatedevents as e4 WHERE e4.EventId IN(Select distinct e3.ERelatedId FROM relatedevents as e3 WHERE e3.EventId IN(Select distinct e2.ERelatedId FROM relatedevents as e2 WHERE e2.EventId IN(Select distinct e.ImageId FROM imagetakenonevent as e WHERE e.EventId=$eventid and e.ImageId IN( SELECT distinct s3.ImageId FROM imagetakeninsites as s3 WHERE s3.SiteId IN(Select distinct s2.SiteId FROM locationcontainsites as s2 WHERE s2.LocationId IN(Select distinct l.LocationId FROM locationcontainsites as l WHERE l.SiteId IN(SELECT distinct s.ImageId FROM imagetakeninsites as s WHERE  s.SiteId=$siteid and s.ImageId IN(SELECT distinct m6.Img_id FROM membersinimages as m6 WHERE m6.Mem_id IN(Select distinct m5.RelatedId FROM relatedmembers as m5 WHERE m5.MemberId IN(Select distinct m4.RelatedId FROM relatedmembers as m4 WHERE m4.MemberId IN(Select distinct m3.RelatedId FROM relatedmembers as m3 WHERE m3.MemberId IN(Select distinct m2.RelatedId FROM relatedmembers as m2 WHERE m2.MemberId IN(SELECT distinct m.Img_id FROM membersinimages as m WHERE  Mem_id=$memberid)))))))))))))))) ORDER BY ImageId";

  
   
  $result =$db->query($sql);


               While($row = $result->fetch_assoc())

                   {                    //storing the retrieved rows in  array
                    $record[]=$row["ImageId"];

                                        }


                      $_SESSION['records']=$record;

                        // Destroy the result set and free the memory used for it //
						
             $result->close();

}

  $objResponse->loadXML(display());





                                break;
  default:   $objResponse->addAssign("error","innerHTML", "depth not in range");

}// end  depth

            

}//end if

$db->close();
return $objResponse->getXML();
}//end function

 //echo "<h2>Search Results with Depth $depth</h2>";


//ListRelated($depth);








?>
</body>
</html>