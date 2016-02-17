<?php
require_once('../include/config.php');
require_once('../include/session.php');

$authorityID=$_GET['authorityID'];


//query to delete login details of the authority
$query="DELETE FROM `login`
		 WHERE `login_id`=".$authorityID."
		 ";
		 
$exec=mysql_query($query);


//query to delete the authority
$query="DELETE FROM `committeemember`
		 WHERE `committeeMember_id`=".$authorityID."
		 ";
		 
$exec=mysql_query($query);

if($exec)
	header('Location: ../admin_editDeleteAuthority.php?success');
	
else
	header('Location: ../admin_editDeleteAuthority.php?error');
?>