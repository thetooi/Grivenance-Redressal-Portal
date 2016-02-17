<?php
require_once('../include/config.php');
require_once('../include/session.php');

$categoryID=$_GET['categoryID'];

//query to delete category from category table
$query="DELETE FROM `category`
		WHERE `category_id`=".$categoryID."
		";
$exec=mysql_query($query);

if($exec)
	header('Location: ../admin_editDeleteCategories.php?success');
else
	header('Location: ../admin_editDeleteCategories.php?error');

?>