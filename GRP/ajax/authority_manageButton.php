<?php
require_once('../include/session.php');
require_once('../include/config.php');

$id=$_POST['id'];
$griev_id=$_POST['griev_id'];


if($id=="solved")
{
	$query_select = "UPDATE `grievance` SET `grievance_externalFlag` = 0
					WHERE `grievance_id` = $griev_id
	";
		$result = mysql_query($query_select);
		if($result)
		{
			echo 'pending';
			
		}
}
if($id=="pending")
{
		$query_select = "UPDATE `grievance` SET `grievance_externalFlag` = 1
					WHERE `grievance_id` = $griev_id
					";
		$result = mysql_query($query_select);
		if($result)
		{
			echo 'solved';
			
		}
}

?>