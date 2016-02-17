<?php
require_once('../include/config.php');
require_once('../include/session.php');

$name=$_POST['name'];
$email=$_POST['email'];
$pass=$_POST['password'];
$repass=$_POST['repassword'];
$category=$_POST['category'];
$department=$_POST['department'];

$authorityID=$_GET['authorityID'];

if($pass!=$repass)//if password and confirm password are different
	header('Location: ../admin_editAuthority.php?authorityID='.$authorityID.'&passNotMatch');
	

else{
	
	$encpass = md5($pass);	
	//query to update authority email and password in login table
	$query="UPDATE `login` SET `username`='".$email."',`password`='".$encpass."'
			WHERE `login_id` = ".$authorityID."
	";
	$exec=mysql_query($query);
	
	//query to edit/update the authority info in table committeemember
	$query="UPDATE `committeemember` SET`committeemember_name`='".$name."',`committeemember_email`='".$email."',
			`committeeMember_category_id`=".$category.",`committeeMember_department_id`=".$department."
			WHERE `committeemember_id` = ".$authorityID."
	";
	$exec=mysql_query($query);
	
	if($exec)
		header('Location: ../admin_editDeleteAuthority.php?success');
	else
	header('Location: ../admin_editDeleteAuthority.php?error');

}
?>