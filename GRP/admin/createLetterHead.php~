<?php
require_once('../include/config.php');
require_once('../include/session.php');

$head = $_POST['header'];	//category name
$foot = $_POST['footer'];	//category description

//query to add category in table category
$query="INSERT into `printletterhead`
(`header`, `footer`) VALUES
('".$head."','".$foot."')
";
$exec=mysql_query($query);

if($exec)
header('Location: ../admin_createLetterHead.php?success');

else
header('Location: ../admin_createLetterHead.php?error');

?>
