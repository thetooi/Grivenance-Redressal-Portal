<?php
function logged_in()
{
	if(!isset($_SESSION['login_id']))	//Whether the user id is set or not
	{
		header("Location: index.php");
	}
}
//logged_in();
function logged_in_login_page()
{
	if(isset($_SESSION['login_id']))		//Redirect directly to dashboard if the user is already logged in
	{
		header("Location: dashboard.php");
	}
}
?>