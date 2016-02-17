<?php
require_once('../include/session.php');
require_once('../include/config.php');
require_once('../include/dashboardFunctions.php');
require_once('../include/check.php');
require_once('../include/authorityFunctions.php');

	$grie_id=$_POST['id'];//...
	$grie_reply=$_POST['reply'];
	
	$username=$_SESSION['username'];
	$committee_memberId=$_SESSION['login_id'];
	// to insert redressal for corresponding grievance
	$query_select = "INSERT INTO `redressal`(`grievance_id`, `redressal_description`, `redressal_committeeMember_id`) VALUES($grie_id,'$grie_reply',$committee_memberId)
	";
		$result = mysql_query($query_select);
		
	 //to set internal flags when an authority replies to a grievance
	$query_select_1 = "UPDATE grievance SET `grievance_internalFlag`= 2
		WHERE `grievance_id` LIKE '$grie_id'
		";
	$result_1 = mysql_query($query_select_1); 
		
	$query_select_2 = "SELECT * FROM `redressal`
		WHERE `grievance_id` LIKE '$grie_id'
		";
		$result_2 = mysql_query($query_select_2); 
		$user_2 = mysql_fetch_array($result_2);	
		
		$timestamp=$user_2['timestamp'];
		
		
		//query to get the name of committeemember from login id from table committeemember
		$query="SELECT `committeemember_name` FROM `committeemember`
				WHERE `committeemember_id`=".$_SESSION['login_id']."
				";
		$exec=mysql_query($query);
		$authority_name=mysql_fetch_array($exec);
		$authority_name=$authority_name[0];
		echo '<hr> <h5>FROM - '.$authority_name.' : '.$username.'<span class="mailbox-read-time pull-right">'.$timestamp.'</span></h5><p>'.$grie_reply.'</p><hr>' ;

	
	

?>