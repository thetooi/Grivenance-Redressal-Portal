<?php
require_once('../include/config.php');
require_once('../include/session.php');

$catName = $_POST['name'];	//category name
$catDescription = $_POST['description'];	//category description

//query to edit/update category in table category
echo $query="UPDATE `sub_category` SET `sub_category_name`='".$catName."',`sub_category_description`='".$catDescription."' 
		WHERE `sub_category`=".$_GET['categoryID']."";
$exec=mysql_query($query);

if($exec)
	header('Location: ../admin_editDeleteSubCategories.php?success');
else
	header('Location: ../admin_editDeleteSubCategories.php?error');

?>