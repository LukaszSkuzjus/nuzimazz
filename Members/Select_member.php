<?php


function DisplayMembers($jumpto)
 {	
	$objResponse = new xajaxResponse();
	// how many rows to show per page 
	$rowsPerPage = 5;
	
	// if $jumpto  defined, use it as page number 
	if($jumpto!="") 
 
			$pageNum = $jumpto;
	else
			// by default show first page 
			$pageNum = 1;
	$start = ($pageNum -1) * $rowsPerPage;
	
	// enter  query and display stuff
	
	$objResponse->addAssign("title1","innerHTML","Members");
	
	$query="select member.Member_Id,member.F_Name,member.L_Name,memprofile.Image_Url
	from member,memprofile where member.Member_Id = memprofile.Mem_Id limit $start, $rowsPerPage";
	
	
	
	
	$result=mysql_query($query)or die(mysql_error());
	$num=mysql_numrows($result);
	$msg;
	if($num==0)
		{$msg= "No Records founds";
		$objResponse->addAssign("table","innerHTML",$msg);
		}
	else
		{
			
			
			//create a table to display album pictures now
			$msg.="<table class=\"table-wrapper\">";//echo
			

			for($S=0;$S<$num;$S++)
				{	//get path of image
					$path= "/Images/profile/".mysql_result($result,$S,"memprofile.Image_Url");
					
					//get name of member
					$name= mysql_result($result,$S,"member.F_Name");
					
					$name.=" ".mysql_result($result,$S,"member.L_Name");
					
					
					$msg.="<tr><td rowspan=\"3\">";//end of echo
					$MemID =mysql_result($result,$S,"member.member_Id");
					$msg.="<table class=\"table-shadows\" >
					<tr>
					<td class=\"td-shadows-main\">
    		
					<a href=\"javascript:void(null);\"onclick=\"xajax_ShowGallery();xajax_viewAlbumOfMem($MemID,'');\" >";//end of echo
					//GetImage path 
					$msg.="<IMG SRC=\".$path\"width=100 height=100
					align=bottom alt=$name>
					</a>
					</td>
					<td class=\"td-shadows-right\"></td>
					</tr>
					<tr>
					<td class=\"td-shadows-bottom\"></td>
					<td class=\"td-shadows-bottomright\">
					<td class=\"Register\">$name</td>
					</td>
					</tr>
					
					</table><!--end of  table shadows-->
					
					

					</td>";//end of echo	
			}//for
			$msg.="<table>";
			//############## End of display stuff
			// how many rows we have in database 

		$query="select  COUNT(*) AS numrows from member,memprofile where member.Member_Id = memprofile.Mem_Id";
				
		$result  = mysql_query($query) or die('Error, query failed'); 
				$row     = mysql_fetch_array($result, MYSQL_ASSOC); 
				$numrows = $row['numrows'];
				
				// how many pages we have when using paging? 
				
				$maxPage = ceil($numrows/$rowsPerPage);
				//#################################### 
				// creating 'previous' and 'next' link 
				if ($pageNum > 1) 
						{ 
							$page = $pageNum -1; 
							$prev="<input type=\"button\" name=\"prev\" onclick =\"xajax_DisplayMembers($page);\" value=\"Prev\">"; 

							$first = "<input type=\"button\" name=\"first\" onclick =\"xajax_DisplayMembers(1);\" value=\"First\">";  

						} 
				else 
						{ 
							$prev  = ' ';       // we're on page one, don't enable 'previous' link 
							$first = '  '; // nor 'first page' link 
						} 

				// print 'next' link only if we're not 
				// on the last page 
				if ($pageNum < $maxPage) 
						{ 
						$page = $pageNum + 1; 
						$next = "<input type=\"button\" name=\"next\"onclick=\"xajax_DisplayMembers($page);\"value=\"Next\">";  
						$last = "<input type=\"button\" name=\"Last\"onclick=\"xajax_DisplayMembers($maxPage);\"value=\"Last\">";   
 
						} 
				else 
						{ 
						$next = '  ';      // we're on the last page, don't enable 'next' link 
						$last = '  '; // nor 'last page' link 
						} 
				// print the page navigation link	
				$msg.=$first . $prev . " Page <strong>$pageNum</strong> of <strong>$maxPage</strong> pages " . $next . $last; 				
			
			//*********now display a select box in div orderby*********//
				
			//****************END******************//

			$objResponse->addAssign("table","innerHTML",$msg);
			
			
		}//else
		return $objResponse->getXML();
}//end of function


 
 
?>
