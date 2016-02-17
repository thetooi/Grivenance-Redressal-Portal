<?php
//Find the session
require_once('../include/session.php');

//unset all the session variable
$_SESSION = array();

//Destroy the session cookie
if(isset($_COOKIE[session_name()]))
{
	setcookie(session_name(),'',time()-42000,'/');
}

//Destroy the session
session_destroy();

//Redirect to successful logout page
header("Location: ../index.php");
?>