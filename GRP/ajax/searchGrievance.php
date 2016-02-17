<?php
require_once('../include/config.php');
require_once('../include/session.php');


$searchType=$_POST['searchType'];
$searchValue=$_POST['value'];


echo'
	<div id="example1_wrapper" class="dataTables_wrapper form-inline" role="grid">
		
		<table id="grievanceTable" class="table table-bordered table-striped">
			<thead>
				<tr>
				<th>Ticket Number</th>
				<th>User</th>
				<th>Date</th>
				<th>Category</th>
				<th>Status</th>
				<th>Title</th>
				</tr>
			</thead>
			<tbody>
						  ';
						  

if($searchValue!=NULL){
//if search value no null


	if($searchType=="searchDate"){
	//search by date
	
		//query to search by date
		$query="SELECT * FROM `grievance`
				WHERE `grievance_added_timestamp` LIKE '".$searchValue."%'
				";	
	}//end if date
	
	if($searchType=="searchCategory"){
	//search by category
	
		//query to search by category
		$query="SELECT * FROM `grievance`
				WHERE `grievance_category_id` = ".$searchValue."
				";	
	}//end if category
	
	if($searchType=="searchStatus"){
	//search by status
	
		//query to search by status
		$query="SELECT * FROM `grievance`
				WHERE `grievance_externalFlag` = ".$searchValue."
				";	
	}//end if status
	
	if($searchType=="searchTicketno"){
	//search by ticket number
	
		$value=substr($searchValue,2);
		$value=substr($value,0,-2);
		//print_r(array_slice($searchValue,2,2));
	
		//query to search by ticket number
		$query="SELECT * FROM `grievance`
				WHERE `grievance_id` = ".$value."
				ORDER BY `grievance_id` DESC
				";	
	}//end if ticket number
	
	
	
	//display result in table
	$exec=mysql_query($query);
	while($grievance=mysql_fetch_array($exec)){
								
		//query to get the category name
		$querycategory="SELECT * FROM `category`
				WHERE `category_id`=".$grievance['grievance_category_id']."
				";
		$execcategory=mysql_query($querycategory);
		$category=mysql_fetch_array($execcategory);
						 
		echo'<tr onclick="slide('.$grievance['grievance_id'].')">
		<td class="">RV'.$grievance['grievance_id'].'GR</td>
		<td class=" ">'.$grievance['grievance_sender_name'].'</td>
		<td class=" ">'.$grievance['grievance_added_timestamp'].'</td>
		<td>'.$category['category_name'].'</td> ';
		
		//to display pending/solved
		switch($grievance['grievance_externalFlag']){
			case 0:	$status="solved&nbsp;";$label="label label-success";break;
			case 1:	$status="pending";$label="label label-warning";break;
		}
		
		//to display seen/unseen/replied
		switch($grievance['grievance_internalFlag']){
			case 0:	$flag="not seen";break;
			case 1:	$flag="seen";break;
			case 2:	$flag="replied";break;
		}
		
		echo'<td class=" "><span class="'.$label.'">'.$status.'</span></td>
			<td class=" ">'.$grievance['grievance_title'].'
			<div style="font-size:x-small; float:right">'.$flag.'</div></td>
	  </tr>
							  
		
		<!--tr to display full description of the grievance-->
		
		<tr>
		<td style="display:none" class="" id="displayme'.$grievance['grievance_id'].'" colspan="6" >
		<h4>'.$grievance['grievance_title'].'</h4>
		<hr>
		<pre style="border:none; font-family:inherit;
		background-color:white;">'.$grievance['grievance_description'].'</pre>';
		//if image is uploaded
		if($grievance['grievance_image_name']!="NULL"){
			echo'<a href="grievances/images/'.$grievance['grievance_image_name'].'">
				<img height="200px" width="200px" 
				src="grievances/images/'.$grievance['grievance_image_name'].'"/></a>';
		}
		
		//query to get the reply for the grievance
		$queryReply="SELECT * FROM `redressal`
					WHERE `grievance_id`=".$grievance['grievance_id']."
					";
		$execute=mysql_query($queryReply);
		//if reply is there
		if(mysql_num_rows($execute)){
			echo'<hr>
					<h4>Replies</h4>';
			while($redressal=mysql_fetch_array($execute)){
				
				//query to get committee member details
				$queryAuthority="SELECT * FROM `committeemember`
							WHERE `committeeMember_id`=".$redressal['redressal_committeeMember_id']."
							";
				$execAuthoriy=mysql_query($queryAuthority);
				$authority=mysql_fetch_array($execAuthoriy);
			
			   echo'By - '.$authority['committeeMember_name'].' : '.$authority['committeeMember_email'].'
				<br>On - '.$redressal['timestamp'].'
				<pre style="border:none; font-family:inherit;
						background-color:white;">'.$redressal['redressal_description'].'
				</pre>
						';
			}//end of while for redressal
		}
		//if no reply
		else
			echo'<hr><h4>No Replies</h4>';
		echo'</td>
		<td style="display:none" class=" "></td>
		<td style="display:none" class=" "></td>
		<td style="display:none" class=" "></td>
		<td style="display:none" class=" "></td>
		</tr>';
		
	}//end while grievance
	
}//end if search value not null



echo' 
		</tbody>
	</table>
		
</div>
							  
';

?>