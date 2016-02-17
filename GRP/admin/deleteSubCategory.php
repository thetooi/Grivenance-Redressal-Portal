<?php
require_once('../include/config.php');
require_once('../include/session.php');

$categoryID=$_GET['categoryID'];

//query to delete category from category table
$query="DELETE FROM `sub_category`
		WHERE `sub_category`=".$categoryID."
		";
$exec=mysql_query($query);

if($exec)
	header('Location: ../admin_editDeleteSubCategories.php?success');
else
	header('Location: ../admin_editDeleteSubCategories.php?error');

?>