<?php
require_once('../include/config.php');
require_once('../include/session.php');

$subcatName = $_POST['name'];	//category name
$subcatDescription = $_POST['description'];	//category description
$catId = $_POST['category'];

//query to add category in table category
$query="INSERT into `sub_category`
(`sub_category_name`, `sub_category_description`,`category_id`) VALUES
('".$subcatName."','".$subcatDescription."','".$catId."')";

$exec=mysql_query($query);

if($exec)
header('Location: ../admin_addSubCategories.php?success');

else
header('Location: ../admin_addSubCategories.php?error');

?>