<?php
//rate pictures 


function Ratepictures($imageid,$userid,$value)

{
include("../dbinfo.inc.php");

$objResponse = new xajaxResponse();
//first need to check wherether the user has not rated the picture before
$query = "SELECT * FROM userrated WHERE MemberId =$userid AND ImageId =$imageid"; 
$result =mysql_query($query)or die(mysql_error());// die('Retriving the data from table userrated  failed');
$num = mysql_numrows($result);
if($num)//means tht the user has already rated this image

	{
	//do somefing
	$objResponse ->addAlert("You have already rated this image");
	}

	else//user has not rate this image

		{//query the table rate where  imageid = $image id
			$query = "select * from rate where ImageId = $imageid";
			$result = mysql_query($query)or die('Retriving the data from table rate  failed');
			$num = mysql_numrows($result);

				if ($num)//means tht rating on the image already exits and thus we just have  to update the fields
					{ 
			
						$Ratecount =mysql_result($result,0,"RateCount");
						$RatedUsers = mysql_result($result,0,"UsersRated");
						$imageid =mysql_result($result,0,"ImageId");
						//update ratecout
						$Ratecount +=$value;
						//increment $rateduers
						$RatedUsers +=1;
			
						//update the table 
						
						//now add entry in table  userrated
						$query2 = "INSERT INTO userrated  VALUES ('$userid', '$imageid')";

						mysql_query($query2)or die('userrate1');
			
						$query ="update rate set RateCount =$Ratecount,UsersRated =$RatedUsers where ImageId = $imageid";
						mysql_query($query)or die('update the data from table rate  failed');
			
						
						$objResponse->addAssign("ratingtable","className","showmsg2");
					}//if
			
				else //means tht rating on the image does not exist and thus we just have  to insert in the table rate
					{
			
			
			
						$Ratecount =$value;
						//add $rateduers
						$RatedUsers =1;
			
						//insert in  the table 
						//now add entry in table  userrated
						$query2 = "INSERT INTO userrated VALUES('$userid','$imageid')";
						mysql_query($query2)or die('hello');
						
						$query ="INSERT INTO rate  VALUES ('$imageid', '$Ratecount', '$RatedUsers')";
						//"insert into  rate('ImageId','RateCount','UsersRated') values ('$imageid','$Ratecount','$RatedUsers')";
						mysql_query($query)or die(mysql_error());
			
						
			
						//now we can update the screen
						$objResponse->addAssign("ratingtable","className","showmsg2");
			
					}//else


		}






return $objResponse->getXML();
mysql_close();
}


function showCurrentRating($imageid)
{
//show the current rating ontheimage
//display the rating images depending upon the ratecout / no of ratedpersons
//i.e determine the averageRate


//make a query t oretireve the Rate cout and the N of  ratepersons

$query = "select * from rate where ImageId = $imageid";
$result = mysql_query($query )or die('Retriving the data from table rate  failed');
$num = mysql_numrows($result);
if ( $num)

{
$Ratecount = mysql_result($result,0,"RateCount");
$RatedUsers = mysql_result($result,0,"UsersRated");
$imageid =mysql_result($result,0,"ImageId");

//now calculate the AverageRate
$Avg = $Ratecount/$RatedUsers;

//now determine the range

if($Avg>0 &&$Avg <=1)
{//poor show only 1 icon
$msg ="<p><img src =\"./Ratings/glossaryIcon.gif\"width=\"11\" height=\"11\">Poor</p>"; 
}
if($Avg>1 &&$Avg <=2)
{//good
$msg = "<p><img src =\"./Ratings/glossaryIcon.gif\"width=\"11\" height=\"11\"><img src =\"./Ratings/glossaryIcon.gif\"width=\"11\" height=\"11\">Good</p>"; 
}
if($Avg >2 &&$Avg <=3)
{//very good

$msg = "<p><img src =\"./Ratings/glossaryIcon.gif\"width=\"11\" height=\"11\"><img src =\"./Ratings/glossaryIcon.gif\"width=\"11\" height=\"11\"><img src =\"./Ratings/glossaryIcon.gif\"width=\"11\" height=\"11\">Excellent</p>"; 
}

}//if

else

{//no record found
$msg = "Not Rated";
//picture not rated
}//else

return $msg;
}//function

?>