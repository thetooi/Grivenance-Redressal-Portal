<?php
require_once('../include/session.php');
require_once('../include/config.php');

$username=$_POST['username'];
$password=$_POST['password'];
$userType=$_GET['utype'];

$encpass = md5($password);

$query_select = "SELECT * FROM `login`
WHERE `username` LIKE '$username'
AND `password` LIKE '$encpass'
";

$result = mysql_query($query_select);

$user = mysql_fetch_array($result);
$rows = mysql_num_rows($result);

//to check that an authority does not enter its username and password in admin column and vice versa
if($user['priv']==1 && $userType!="admin")
{
	
	session_unset();
	session_destroy();
	header('Location: ../index.php?error');
	//echo "1";
	
}
elseif($user['priv']==2 && $userType!="authority")
{
	
	session_unset();
	session_destroy();
	header('Location: ../index.php?error');
	//echo "2";
}

//echo $rows;
elseif($rows) {

$_SESSION['login_id'] = $user['login_id'];
$_SESSION['username'] = $user['username'];
$_SESSION['priv'] = $user['priv'];
//echo"HEY";
header('Location: ../dashboard.php');
}
else
header('Location: ../index.php?error');


?>