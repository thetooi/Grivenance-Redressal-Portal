<?php
require_once('include/config.php');
require_once('include/session.php');

$id=$_POST['id'];
$category_id=$_POST['department'];
$sub_category_id=$_POST['subcategory'];

echo $query="UPDATE `grievance` SET `grievance_category_id`='".$category_id."',`grievance_subcategory_id`='".$sub_category_id."',
			`grievance_internalFlag`=0, `grievance_externalFlag`=1  WHERE `grievance_id`=".$id."";
$exec=mysql_query($query);

if($exec)
	header('Location: authority_grievance.php');
else
	header('Location: authority_grievance.php');

?>
