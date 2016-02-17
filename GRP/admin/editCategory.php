<?php
require_once('../include/config.php');
require_once('../include/session.php');

$catName = $_POST['name'];	//category name
$catDescription = $_POST['description'];	//category description

//query to edit/update category in table category
$query="UPDATE `category` SET `category_name`='".$catName."',`category_description`='".$catDescription."' 
		WHERE `category_id`=".$_GET['categoryID']."";
$exec=mysql_query($query);

if($exec)
	header('Location: ../admin_editDeleteCategories.php?success');
else
	header('Location: ../admin_editDeleteCategories.php?error');

?>