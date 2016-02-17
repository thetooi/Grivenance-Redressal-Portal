<?php
require_once('../include/config.php');
require_once('../include/session.php');

$catName = $_POST['name'];	//category name
$catDescription = $_POST['description'];	//category description

//query to add category in table category
$query="INSERT into `category`
(`category_name`, `category_description`) VALUES
('".$catName."','".$catDescription."')
";
$exec=mysql_query($query);

if($exec)
header('Location: ../admin_addCategories.php?success');

else
header('Location: ../admin_addCategories.php?error');

?>