<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	include("config.lib.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php
session_start();
$flag = 0;
$email = addslashes($_POST['email']);
$check = mysql_query("SELECT * FROM userDetails WHERE ppl_teamName='$email'", $connection);
if(!$check){
	die ("Database query failed: " . mysql_error());
	}
$check2 = mysql_num_rows($check);
if($check2 == 0){
	$flag=1;
	}
while($info = mysql_fetch_array($check)){
	$_POST['pwd'] = stripslashes($_POST['pwd']);
	$info['ppl_password'] = stripslashes($info['ppl_password']);
	$_POST['pwd'] = md5($_POST['pwd']);
	if ($_POST['pwd'] != $info['ppl_password'])
		$flag=1;
	}
if($flag!=1){
	$_SESSION['username'] = $email;
	header("location: .././");
	}
?>
<body>
</body>
</html>